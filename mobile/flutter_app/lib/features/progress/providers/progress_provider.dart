import 'package:flutter/material.dart';

import '../../stories/data/story_repository.dart';

class ProgressProvider extends ChangeNotifier {
  final StoryRepository _storyRepository = StoryRepository();
  bool isSaving = false;
  double lastCompletion = 0;

  Future<void> saveProgress({
    required String storyId,
    required int page,
    required int secondsRead,
    required double completion,
  }) async {
    isSaving = true;
    notifyListeners();

    try {
      await _storyRepository.updateProgress(
        storyId: storyId,
        lastPage: page,
        secondsRead: secondsRead,
        completion: completion,
      );
      lastCompletion = completion;
    } finally {
      isSaving = false;
      notifyListeners();
    }
  }

  Future<Map<String, dynamic>> submitQuiz({
    required String storyId,
    required Map<String, int> answers,
  }) async {
    isSaving = true;
    notifyListeners();

    try {
      return await _storyRepository.submitQuiz(storyId: storyId, answers: answers);
    } finally {
      isSaving = false;
      notifyListeners();
    }
  }
}
