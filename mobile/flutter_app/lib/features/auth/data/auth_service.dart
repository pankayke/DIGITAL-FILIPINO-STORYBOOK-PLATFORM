class AuthService {
  Future<Map<String, dynamic>> login(String email, String password) async {
    await Future<void>.delayed(const Duration(milliseconds: 500));

    return {
      'user': {
        'id': 1,
        'name': 'Maria',
        'email': email,
        'role': 'parent',
      },
      'token': 'demo_token',
    };
  }

  Future<Map<String, dynamic>> register(String name, String email, String password) async {
    await Future<void>.delayed(const Duration(milliseconds: 500));

    return {
      'user': {
        'id': 1,
        'name': name,
        'email': email,
        'role': 'parent',
      },
      'token': 'demo_token',
    };
  }
}
