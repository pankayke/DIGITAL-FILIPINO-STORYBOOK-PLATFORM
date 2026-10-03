<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoryDetailResource;
use App\Http\Resources\StoryResource;
use App\Models\Achievement;
use App\Models\ReadingProgress;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::query()
            ->with(['author', 'category', 'language'])
            ->where('publication_status', 'published')
            ->orderByDesc('is_featured')
            ->orderByDesc('read_count')
            ->paginate(12);

        return StoryResource::collection($stories);
    }

    public function show(Story $story)
    {
        $story->load([
            'author',
            'category',
            'language',
            'pages',
            'vocabularyWords',
            'quiz.questions.options',
        ]);

        return new StoryDetailResource($story);
    }

    public function updateProgress(Request $request, Story $story)
    {
        $data = $request->validate([
            'child_profile_id' => ['nullable', 'integer', 'exists:child_profiles,id'],
            'last_page_number' => ['required', 'integer', 'min:1'],
            'seconds_read' => ['required', 'integer', 'min:0'],
            'completion_percentage' => ['required', 'numeric', 'between:0,100'],
        ]);

        $user = Auth::user();

        $progress = ReadingProgress::updateOrCreate(
            [
                'user_id' => $user->id,
                'story_id' => $story->id,
                'child_profile_id' => $data['child_profile_id'] ?? null,
            ],
            [
                'last_page_number' => $data['last_page_number'],
                'seconds_read' => $data['seconds_read'],
                'completion_percentage' => $data['completion_percentage'],
                'is_completed' => $data['completion_percentage'] >= 100,
            ]
        );

        return response()->json([
            'message' => 'Progress saved successfully.',
            'progress' => $progress,
        ]);
    }

    public function submitQuiz(Request $request, Story $story)
    {
        $data = $request->validate([
            'answers' => ['required', 'array'],
            'child_profile_id' => ['nullable', 'integer', 'exists:child_profiles,id'],
        ]);

        $quiz = $story->quiz()->with('questions.options')->firstOrFail();
        $score = 0;
        $total = 0;

        foreach ($quiz->questions as $question) {
            $total += $question->points;

            $selectedOptionId = $data['answers'][$question->id] ?? null;

            $selectedOption = $question->options->first(fn ($option) => (int) $option->id === (int) $selectedOptionId);

            if ($selectedOption && $selectedOption->is_correct) {
                $score += $question->points;
            }
        }

        $percentage = $total > 0 ? round(($score / $total) * 100) : 0;

        ReadingProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'story_id' => $story->id,
                'child_profile_id' => $data['child_profile_id'] ?? null,
            ],
            [
                'quiz_score' => $percentage,
                'completion_percentage' => max(100, $percentage),
                'is_completed' => $percentage >= 80,
            ]
        );

        $achievement = Achievement::query()
            ->where('story_id', $story->id)
            ->where('achievement_type', 'story_completion')
            ->first();

        if ($percentage >= 80 && $achievement) {
            Auth::user()->achievements()->syncWithoutDetaching([$achievement->id]);
        }

        return response()->json([
            'score' => $score,
            'total' => $total,
            'percentage' => $percentage,
            'passed' => $percentage >= 80,
        ]);
    }
}
