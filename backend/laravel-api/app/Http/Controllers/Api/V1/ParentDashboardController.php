<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ChildProfile;
use Illuminate\Support\Facades\Auth;

class ParentDashboardController extends Controller
{
    public function index()
    {
        $parent = Auth::user();

        $children = ChildProfile::query()
            ->where('parent_id', $parent->id)
            ->with(['readingProgress.story'])
            ->get();

        return response()->json([
            'parent' => $parent,
            'children' => $children,
            'summary' => [
                'total_children' => $children->count(),
                'stories_completed' => $children->sum(fn ($child) => $child->readingProgress->filter(fn ($progress) => $progress->is_completed)->count()),
                'average_quiz_score' => round($children->flatMap->readingProgress->avg('quiz_score') ?? 0, 2),
            ],
        ]);
    }

    public function showChildProfile(ChildProfile $childProfile)
    {
        $this->authorize('view', $childProfile);

        return response()->json([
            'child' => $childProfile->load(['readingProgress.story']),
        ]);
    }
}
