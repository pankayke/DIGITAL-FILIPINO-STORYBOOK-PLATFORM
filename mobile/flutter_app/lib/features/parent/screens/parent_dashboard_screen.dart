import 'package:flutter/material.dart';

class ParentDashboardScreen extends StatelessWidget {
  const ParentDashboardScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Parent Dashboard'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(18),
        child: Column(
          children: [
            _summaryCard('Kabuuang mga Bata', '2'),
            const SizedBox(height: 12),
            _summaryCard('Nakumpleto', '7 kwento'),
            const SizedBox(height: 12),
            _summaryCard('Average Quiz Score', '88%'),
            const SizedBox(height: 24),
            Expanded(
              child: ListView(
                children: const [
                  ListTile(
                    leading: CircleAvatar(child: Icon(Icons.child_care)),
                    title: Text('Lia'),
                    subtitle: Text('3 kwento na nakumpleto'),
                    trailing: Icon(Icons.chevron_right),
                  ),
                  ListTile(
                    leading: CircleAvatar(child: Icon(Icons.child_care)),
                    title: Text('Noah'),
                    subtitle: Text('4 kwento na nakumpleto'),
                    trailing: Icon(Icons.chevron_right),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _summaryCard(String label, String value) {
    return Card(
      child: ListTile(
        title: Text(label),
        trailing: Text(value, style: const TextStyle(fontSize: 18, fontWeight: FontWeight.w700)),
      ),
    );
  }
}
