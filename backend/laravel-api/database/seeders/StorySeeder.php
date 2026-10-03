<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Author;
use App\Models\Language;
use App\Models\Quiz;
use App\Models\QuizOption;
use App\Models\QuizQuestion;
use App\Models\Story;
use App\Models\StoryCategory;
use App\Models\StoryPage;
use App\Models\VocabularyWord;
use Illuminate\Database\Seeder;

class StorySeeder extends Seeder
{
    public function run(): void
    {
        $language = Language::firstOrCreate([
            'code' => 'fil',
        ], [
            'name' => 'Filipino',
            'native_name' => 'Filipino',
            'is_default' => true,
        ]);

        $category = StoryCategory::firstOrCreate([
            'slug' => 'paglalakbay',
        ], [
            'name' => 'Paglalakbay',
            'description' => 'Mga kwentong pang-aral at paglalakbay.',
            'icon' => 'map',
        ]);

        $author = Author::firstOrCreate([
            'name' => 'Arawan Studio',
        ], [
            'bio' => 'Isang grupo ng mga manunulat at illustrator na nakatuon sa mga kwentong pambata na may malaking halaga sa kulturang Pilipino.',
            'is_featured' => true,
        ]);

        $story = Story::firstOrCreate([
            'slug' => 'ang-bata-sa-bundok-ng-pag-asa',
        ], [
            'title' => 'Ang Bato sa Bundok ng Pag-asa',
            'description' => 'Isang kwento tungkol sa tapang, kabutihan, at pagkakaibigan sa gitna ng mga hamon.',
            'cover_image_url' => 'https://images.example.com/story-cover-1.jpg',
            'author_id' => $author->id,
            'category_id' => $category->id,
            'language_id' => $language->id,
            'min_age' => 5,
            'max_age' => 8,
            'estimated_reading_minutes' => 8,
            'difficulty' => 'easy',
            'publication_status' => 'published',
            'read_count' => 125,
            'average_rating' => 4.8,
        ]);

        $this->addPages($story);
        $this->addVocabulary($story);
        $this->addQuiz($story);
        $this->addAchievement($story);

        $stories = [
            'Ang Mahiwagang Puno ng Nayon',
            'Si Maya at ang Bulanang Parang',
            'Bahay ng mga Pusa sa Kalsada',
            'Kuwentong Pista ng Maynila',
            'Lutong Bahay ni Aling Rosa',
            'Ang Kambal na Ibon sa Dagat',
            'Sa ilalim ng Nayon',
            'Ang Ayos ng Puso',
            'Bahay ng mga Kuweentong Kulay',
            'Timpla ng Pasko sa Pamilya',
        ];

        foreach ($stories as $index => $title) {
            $slug = str($title)->slug()->value();

            $story = Story::firstOrCreate([
                'slug' => $slug,
            ], [
                'title' => $title,
                'description' => 'Isang original na pambata na kwento para sa Filipino literacy at pagkatuto.',
                'cover_image_url' => 'https://images.example.com/story-' . ($index + 2) . '.jpg',
                'author_id' => $author->id,
                'category_id' => $category->id,
                'language_id' => $language->id,
                'min_age' => 4,
                'max_age' => 10,
                'estimated_reading_minutes' => 7,
                'difficulty' => $index % 2 === 0 ? 'easy' : 'medium',
                'publication_status' => 'published',
                'read_count' => 40 + $index * 10,
                'average_rating' => 4.5,
            ]);

            $this->addPages($story, $index + 2);
            $this->addVocabulary($story);
            $this->addQuiz($story);
            $this->addAchievement($story);
        }
    }

    protected function addPages(Story $story, int $offset = 1): void
    {
        $pages = [
            [
                'page_number' => 1,
                'title' => 'Simula',
                'content' => 'Isang umaga, nagising si Lio na puno ng pag-asa. Naglakad siya papunta sa nayon upang matulungan ang mga magulang.',
                'illustration_url' => 'https://images.example.com/page-1.jpg',
                'narration_audio_url' => 'https://audio.example.com/page-1.mp3',
            ],
            [
                'page_number' => 2,
                'title' => 'Pagsisimula',
                'content' => 'Sa daan, nakita niya ang isang batang kalapati na naligaw. Tinulungan niya ito sa pagbalik sa kanyang pamilya.',
                'illustration_url' => 'https://images.example.com/page-2.jpg',
                'narration_audio_url' => 'https://audio.example.com/page-2.mp3',
            ],
            [
                'page_number' => 3,
                'title' => 'Tagumpay',
                'content' => 'Sa huli, lahat ay masaya at nakatuwa sa pagkilos ng kabutihan ng bata.',
                'illustration_url' => 'https://images.example.com/page-3.jpg',
                'narration_audio_url' => 'https://audio.example.com/page-3.mp3',
            ],
        ];

        foreach ($pages as $page) {
            StoryPage::firstOrCreate([
                'story_id' => $story->id,
                'page_number' => $page['page_number'],
            ], $page);
        }
    }

    protected function addVocabulary(Story $story): void
    {
        $words = [
            ['word' => 'pag-asa', 'translation' => 'hope', 'definition' => 'paniniwala na may magandang mangyayari sa hinaharap.', 'example_sentence' => 'Ang pag-asa ay nagsisilbing liwanag sa gitna ng dilim.'],
            ['word' => 'kabutihan', 'translation' => 'kindness', 'definition' => 'mabuting kilos sa iba.', 'example_sentence' => 'Ang kabutihan ay mahalaga sa bawat pamilya.'],
            ['word' => 'tapat', 'translation' => 'honest', 'definition' => 'walang pagkukunwari at laging totoo.', 'example_sentence' => 'Tapat siyang nagsasabi ng katotohanan.'],
        ];

        foreach ($words as $word) {
            VocabularyWord::firstOrCreate([
                'story_id' => $story->id,
                'word' => $word['word'],
            ], $word + ['difficulty_level' => 'easy']);
        }
    }

    protected function addQuiz(Story $story): void
    {
        $quiz = Quiz::firstOrCreate([
            'story_id' => $story->id,
        ], [
            'title' => 'Pagsusulit sa ' . $story->title,
            'description' => 'Suriin ang iyong pag-unawa sa kwento.',
            'passing_score' => 80,
            'time_limit_seconds' => 180,
        ]);

        $question = $quiz->questions()->firstOrCreate([
            'prompt' => 'Ano ang pangunahing aral ng kwento?',
        ], [
            'question_type' => 'multiple_choice',
            'points' => 1,
            'sort_order' => 1,
        ]);

        $question->options()->firstOrCreate([
            'option_text' => 'Magkaroon ng pag-asa at gumawa ng mabuti',
        ], ['is_correct' => true, 'sort_order' => 1]);

        $question->options()->firstOrCreate([
            'option_text' => 'Huwag magtrabaho',
        ], ['is_correct' => false, 'sort_order' => 2]);

        $question->options()->firstOrCreate([
            'option_text' => 'Umupo lamang sa bahay',
        ], ['is_correct' => false, 'sort_order' => 3]);
    }

    protected function addAchievement(Story $story): void
    {
        Achievement::firstOrCreate([
            'story_id' => $story->id,
            'name' => 'Tagapagturo ng Pag-asa',
        ], [
            'description' => 'Nakumpleto ang kwentong ito.',
            'icon' => 'star',
            'badge_color' => '#FBBF24',
            'achievement_type' => 'story_completion',
            'unlock_threshold' => 1,
        ]);
    }
}
