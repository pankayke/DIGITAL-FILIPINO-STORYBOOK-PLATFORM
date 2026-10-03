import 'package:flutter/material.dart';

import '../core/theme/app_theme.dart';
import 'router.dart';

class DigitalFilipinoStorybookApp extends StatelessWidget {
  const DigitalFilipinoStorybookApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp.router(
      title: 'Digital Filipino Storybook',
      theme: AppTheme.lightTheme,
      routerConfig: appRouter,
      debugShowCheckedModeBanner: false,
    );
  }
}
