import 'package:go_router/go_router.dart';

import '../features/admin/screens/admin_dashboard_screen.dart';
import '../features/parent/screens/parent_dashboard_screen.dart';
import '../features/stories/screens/story_detail_screen.dart';
import '../features/stories/screens/story_list_screen.dart';
import '../features/stories/screens/reader_screen.dart';

final appRouter = GoRouter(
  initialLocation: '/',
  routes: [
    GoRoute(
      path: '/',
      name: 'home',
      builder: (context, state) => const StoryListScreen(),
    ),
    GoRoute(
      path: '/story/:storyId',
      name: 'story-detail',
      builder: (context, state) {
        final storyId = state.pathParameters['storyId'];
        return StoryDetailScreen(storyId: storyId ?? '');
      },
    ),
    GoRoute(
      path: '/reader/:storyId',
      name: 'reader',
      builder: (context, state) {
        final storyId = state.pathParameters['storyId'];
        return ReaderScreen(storyId: storyId ?? '');
      },
    ),
    GoRoute(
      path: '/parent',
      name: 'parent-dashboard',
      builder: (context, state) => const ParentDashboardScreen(),
    ),
    GoRoute(
      path: '/admin',
      name: 'admin-dashboard',
      builder: (context, state) => const AdminDashboardScreen(),
    ),
  ],
);
