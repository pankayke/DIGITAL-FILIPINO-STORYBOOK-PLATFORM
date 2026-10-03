class Story {
  Story({
    required this.id,
    required this.title,
    required this.slug,
    required this.description,
    required this.coverImageUrl,
    required this.author,
    required this.category,
    required this.language,
    required this.difficulty,
    required this.minAge,
    required this.maxAge,
    required this.estimatedReadingMinutes,
    required this.publicationStatus,
    required this.isFeatured,
    required this.readCount,
    required this.averageRating,
  });

  final int id;
  final String title;
  final String slug;
  final String description;
  final String coverImageUrl;
  final String author;
  final String category;
  final String language;
  final String difficulty;
  final int minAge;
  final int maxAge;
  final int estimatedReadingMinutes;
  final String publicationStatus;
  final bool isFeatured;
  final int readCount;
  final double averageRating;

  factory Story.fromJson(Map<String, dynamic> json) {
    return Story(
      id: json['id'] as int? ?? 0,
      title: json['title'] as String? ?? 'Untitled story',
      slug: json['slug'] as String? ?? '',
      description: json['description'] as String? ?? '',
      coverImageUrl: json['cover_image_url'] as String? ?? '',
      author: json['author'] as String? ?? 'Unknown author',
      category: json['category'] as String? ?? 'General',
      language: json['language'] as String? ?? 'fil',
      difficulty: json['difficulty'] as String? ?? 'easy',
      minAge: json['min_age'] as int? ?? 4,
      maxAge: json['max_age'] as int? ?? 8,
      estimatedReadingMinutes: json['estimated_reading_minutes'] as int? ?? 5,
      publicationStatus: json['publication_status'] as String? ?? 'published',
      isFeatured: json['is_featured'] as bool? ?? false,
      readCount: json['read_count'] as int? ?? 0,
      averageRating: (json['average_rating'] as num?)?.toDouble() ?? 0.0,
    );
  }
}
