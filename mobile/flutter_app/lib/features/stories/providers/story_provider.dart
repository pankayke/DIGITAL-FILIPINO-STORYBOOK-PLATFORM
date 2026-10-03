import 'package:flutter/material.dart';

import '../data/story_repository.dart';
import '../models/story.dart';

class StoryProvider extends ChangeNotifier {
  final StoryRepository _repository = StoryRepository();
  bool isLoading = false;
  List<Story> stories = [];
  Story? selectedStory;

  Future<void> loadStories() async {
    isLoading = true;
    notifyListeners();

    try {
      stories = await _repository.fetchStories();
    } finally {
      isLoading = false;
      notifyListeners();
    }
  }

  Future<void> loadStory(String storyId) async {
    isLoading = true;
    notifyListeners();

    try {
      selectedStory = await _repository.fetchStoryById(storyId);
    } finally {
      isLoading = false;
      notifyListeners();
    }
  }
}
