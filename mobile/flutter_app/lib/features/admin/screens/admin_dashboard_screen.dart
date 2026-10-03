import 'package:flutter/material.dart';

class AdminDashboardScreen extends StatelessWidget {
  const AdminDashboardScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Admin CMS'),
      ),
      body: GridView.count(
        crossAxisCount: 2,
        padding: const EdgeInsets.all(18),
        mainAxisSpacing: 16,
        crossAxisSpacing: 16,
        children: const [
          _AdminTile(title: 'Stories', icon: Icons.book_rounded),
          _AdminTile(title: 'Pages', icon: Icons.menu_book_rounded),
          _AdminTile(title: 'Vocabulary', icon: Icons.translate_rounded),
          _AdminTile(title: 'Quizzes', icon: Icons.quiz_rounded),
          _AdminTile(title: 'Users', icon: Icons.people_alt_rounded),
          _AdminTile(title: 'Analytics', icon: Icons.analytics_rounded),
        ],
      ),
    );
  }
}

class _AdminTile extends StatelessWidget {
  const _AdminTile({required this.title, required this.icon});

  final String title;
  final IconData icon;

  @override
  Widget build(BuildContext context) {
    return Card(
      child: InkWell(
        borderRadius: BorderRadius.circular(18),
        child: Padding(
          padding: const EdgeInsets.all(18),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Icon(icon, size: 34, color: Colors.green.shade700),
              const SizedBox(height: 10),
              Text(title, textAlign: TextAlign.center, style: const TextStyle(fontWeight: FontWeight.w700)),
            ],
          ),
        ),
      ),
    );
  }
}
