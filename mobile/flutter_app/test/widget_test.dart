import 'package:digital_filipino_storybook/features/stories/models/story.dart';
import 'package:digital_filipino_storybook/features/stories/providers/story_provider.dart';
import 'package:digital_filipino_storybook/features/stories/screens/story_list_screen.dart';
import 'package:flutter/material.dart';
import 'package:flutter_test/flutter_test.dart';
import 'package:provider/provider.dart';

class MockStoryProvider extends ChangeNotifier implements StoryProvider {
  bool isLoading = false;
  List<Story> stories = [
    Story(
      id: 1,
      title: 'Test Story',
      slug: 'test-story',
      description: 'Test description',
      coverImageUrl: 'url',
      author: 'Author',
      category: 'Category',
      language: 'fil',
      difficulty: 'easy',
      minAge: 5,
      maxAge: 8,
      estimatedReadingMinutes: 5,
      publicationStatus: 'published',
      isFeatured: false,
      readCount: 10,
      averageRating: 4.5,
    ),
  ];
  Story? selectedStory;

  @override
  Future<void> loadStories() async {
    isLoading = false;
    notifyListeners();
  }

  @override
  Future<void> loadStory(String storyId) async {}
}

void main() {
  testWidgets('story list loads without crashing', (WidgetTester tester) async {
    await tester.pumpWidget(
      MultiProvider(
        providers: [
          ChangeNotifierProvider<StoryProvider>(create: (_) => MockStoryProvider() as StoryProvider),
        ],
        child: const MaterialApp(home: StoryListScreen()),
      ),
    );

    await tester.pumpAndSettle();
    expect(find.byType(StoryListScreen), findsOneWidget);
  });
}
