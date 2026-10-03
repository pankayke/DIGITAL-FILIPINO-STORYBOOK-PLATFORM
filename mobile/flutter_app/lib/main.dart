import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import 'app/app.dart';
import 'features/progress/providers/progress_provider.dart';
import 'features/stories/providers/story_provider.dart';

void main() {
  runApp(
    MultiProvider(
      providers: [
        ChangeNotifierProvider(create: (_) => StoryProvider()),
        ChangeNotifierProvider(create: (_) => ProgressProvider()),
      ],
      child: const DigitalFilipinoStorybookApp(),
    ),
  );
}
