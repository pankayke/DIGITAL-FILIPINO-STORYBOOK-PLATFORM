import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import '../../progress/providers/progress_provider.dart';

class ReaderScreen extends StatefulWidget {
  const ReaderScreen({super.key, required this.storyId});

  final String storyId;

  @override
  State<ReaderScreen> createState() => _ReaderScreenState();
}

class _ReaderScreenState extends State<ReaderScreen> {
  int currentPage = 1;
  int secondsRead = 0;

  @override
  void initState() {
    super.initState();
    Future<void>.delayed(const Duration(seconds: 1), () {
      setState(() {
        secondsRead += 1;
      });
    });
  }

  @override
  Widget build(BuildContext context) {
    final progressProvider = context.watch<ProgressProvider>();

    return Scaffold(
      appBar: AppBar(
        title: const Text('Pagbasa'),
        actions: [
          IconButton(
            onPressed: () {},
            icon: const Icon(Icons.volume_up_rounded),
          ),
        ],
      ),
      body: Padding(
        padding: const EdgeInsets.all(18),
        child: Column(
          children: [
            Expanded(
              child: Card(
                child: Padding(
                  padding: const EdgeInsets.all(18),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        'Pahina $currentPage',
                        style: const TextStyle(
                          fontSize: 18,
                          fontWeight: FontWeight.w700,
                        ),
                      ),
                      const SizedBox(height: 18),
                      const Text(
                        'Isang umaga, nagising si Lio na puno ng pag-asa. Tinitingnan niya ang araw at sinimulan ang paglalakbay sa nayon kasama ang kanyang mga kaibigan.',
                        style: TextStyle(fontSize: 20, height: 1.8),
                      ),
                    ],
                  ),
                ),
              ),
            ),
            const SizedBox(height: 18),
            Row(
              children: [
                Expanded(
                  child: OutlinedButton.icon(
                    onPressed: () {
                      if (currentPage > 1) {
                        setState(() => currentPage--);
                      }
                    },
                    icon: const Icon(Icons.arrow_back_ios_new_rounded),
                    label: const Text('Nakaraan'),
                  ),
                ),
                const SizedBox(width: 12),
                Expanded(
                  child: FilledButton.icon(
                    onPressed: () async {
                      final nextPage = currentPage + 1;
                      setState(() => currentPage = nextPage);

                      await progressProvider.saveProgress(
                        storyId: widget.storyId,
                        page: currentPage,
                        secondsRead: secondsRead,
                        completion: (currentPage / 3) * 100,
                      );
                    },
                    icon: const Icon(Icons.arrow_forward_ios_rounded),
                    label: const Text('Susunod'),
                  ),
                ),
              ],
            ),
            if (progressProvider.isSaving)
              const Padding(
                padding: EdgeInsets.only(top: 12),
                child: LinearProgressIndicator(),
              ),
          ],
        ),
      ),
    );
  }
}
