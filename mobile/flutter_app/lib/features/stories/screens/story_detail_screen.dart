import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:provider/provider.dart';

import '../providers/story_provider.dart';

class StoryDetailScreen extends StatefulWidget {
  const StoryDetailScreen({super.key, required this.storyId});

  final String storyId;

  @override
  State<StoryDetailScreen> createState() => _StoryDetailScreenState();
}

class _StoryDetailScreenState extends State<StoryDetailScreen> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      context.read<StoryProvider>().loadStory(widget.storyId);
    });
  }

  @override
  Widget build(BuildContext context) {
    final provider = context.watch<StoryProvider>();
    final story = provider.selectedStory;

    if (provider.isLoading || story == null) {
      return const Scaffold(body: Center(child: CircularProgressIndicator()));
    }

    return Scaffold(
      appBar: AppBar(
        title: Text(story.title),
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(18),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Container(
              height: 220,
              width: double.infinity,
              decoration: BoxDecoration(
                borderRadius: BorderRadius.circular(22),
                color: Colors.green.shade100,
              ),
              child: const Center(
                child: Icon(Icons.auto_stories_rounded, size: 80, color: Colors.green),
              ),
            ),
            const SizedBox(height: 18),
            Text(
              story.title,
              style: const TextStyle(fontSize: 28, fontWeight: FontWeight.w800),
            ),
            const SizedBox(height: 10),
            Text(
              story.description,
              style: const TextStyle(fontSize: 16, color: Colors.black87),
            ),
            const SizedBox(height: 18),
            Wrap(
              spacing: 10,
              runSpacing: 10,
              children: [
                _pill('Author: ${story.author}'),
                _pill('Category: ${story.category}'),
                _pill('Age ${story.minAge}-${story.maxAge}'),
                _pill('${story.estimatedReadingMinutes} min'),
              ],
            ),
            const SizedBox(height: 22),
            Row(
              children: [
                Expanded(
                  child: FilledButton.icon(
                    onPressed: () => context.go('/reader/${story.id}'),
                    icon: const Icon(Icons.play_arrow_rounded),
                    label: const Text('Basa ang Kwento'),
                  ),
                ),
              ],
            ),
            const SizedBox(height: 28),
            const Text(
              'Mga Salita sa Kwento',
              style: TextStyle(fontSize: 20, fontWeight: FontWeight.w700),
            ),
            const SizedBox(height: 12),
            const Wrap(
              spacing: 8,
              runSpacing: 8,
              children: [
                Chip(label: Text('pag-asa')),
                Chip(label: Text('kabutihan')),
                Chip(label: Text('tapat')),
                Chip(label: Text('kasiyahan')),
              ],
            ),
            const SizedBox(height: 28),
            const Text(
              'Pag-unawa sa Kwento',
              style: TextStyle(fontSize: 20, fontWeight: FontWeight.w700),
            ),
            const SizedBox(height: 12),
            const Text('1. Ano ang pangunahing mensahe ng kuwento?'),
            const Text('2. Ano ang ginawa ni Lio upang makatulong?'),
            const Text('3. Bakit mahalaga ang pagtutulungan?'),
          ],
        ),
      ),
    );
  }

  Widget _pill(String label) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 8),
      decoration: BoxDecoration(
        color: Colors.green.shade100,
        borderRadius: BorderRadius.circular(999),
      ),
      child: Text(label, style: const TextStyle(fontWeight: FontWeight.w600)),
    );
  }
}
