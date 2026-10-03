import 'package:dio/dio.dart';

import '../../../core/constants/app_constants.dart';
import '../models/story.dart';

class StoryRepository {
  Dio _dio;

  StoryRepository({Dio? dio}) : _dio = dio ?? Dio(
    BaseOptions(
      baseUrl: AppConstants.apiBaseUrl,
      connectTimeout: const Duration(seconds: 10),
      receiveTimeout: const Duration(seconds: 10),
      headers: {'Accept': 'application/json'},
    ),
  );

  Future<List<Story>> fetchStories() async {
    final response = await _dio.get('/stories');

    final data = response.data['data'] as List<dynamic>?;
    if (data == null) {
      return [];
    }
    return data.map((item) => Story.fromJson(item as Map<String, dynamic>)).toList();
  }

  Future<Story> fetchStoryById(String storyId) async {
    final response = await _dio.get('/stories/$storyId');
    final data = response.data['data'] as Map<String, dynamic>?;
    if (data == null) {
      throw Exception('Story not found');
    }
    return Story.fromJson(data);
  }

  Future<void> updateProgress({
    required String storyId,
    required int lastPage,
    required int secondsRead,
    required double completion,
  }) async {
    await _dio.post(
      '/stories/$storyId/progress',
      data: {
        'page_number': lastPage,
        'last_page_number': lastPage,
        'seconds_read': secondsRead,
        'completion_percentage': completion,
      },
      options: Options(headers: {'Accept': 'application/json'}),
    );
  }

  Future<Map<String, dynamic>> submitQuiz({
    required String storyId,
    required Map<String, int> answers,
  }) async {
    final response = await _dio.post(
      '/stories/$storyId/quiz-submit',
      data: {'answers': answers},
      options: Options(headers: {'Accept': 'application/json'}),
    );
    return Map<String, dynamic>.from(response.data);
  }
}
