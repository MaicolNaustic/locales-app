import 'package:flutter/material.dart';
import '../models/local.dart';
import '../services/api_service.dart';
import 'local_edit_screen.dart';

class LocalListScreen extends StatefulWidget {
  const LocalListScreen({super.key});

  @override
  State<LocalListScreen> createState() => _LocalListScreenState();
}

class _LocalListScreenState extends State<LocalListScreen> {
  final ApiService _apiService = ApiService();
  List<Local> _locales = [];
  bool _isLoading = true;
  String? _errorMessage;

  @override
  void initState() {
    super.initState();
    _loadLocales();
  }

  Future<void> _loadLocales() async {
    setState(() {
      _isLoading = true;
      _errorMessage = null;
    });

    try {
      _locales = await _apiService.getLocales();
    } catch (e) {
      _errorMessage = e.toString();
    } finally {
      setState(() => _isLoading = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Locales Comerciales'),
        backgroundColor: Colors.blueAccent,
      ),
      body: RefreshIndicator(
        onRefresh: _loadLocales,
        child: _isLoading
            ? const Center(child: CircularProgressIndicator())
            : _errorMessage != null
                ? Center(
                    child: Padding(
                      padding: const EdgeInsets.all(20),
                      child: Text('Error: $_errorMessage'),
                    ),
                  )
                : ListView.builder(
                    padding: const EdgeInsets.all(12),
                    itemCount: _locales.length,
                    itemBuilder: (context, index) {
                      final local = _locales[index];
                      return Card(
                        margin: const EdgeInsets.only(bottom: 10),
                        child: ListTile(
                          title: Text(
                            local.nombre,
                            style: const TextStyle(fontWeight: FontWeight.bold),
                          ),
                          subtitle: Text(local.direccion),
                          trailing: Row(
                            mainAxisSize: MainAxisSize.min,
                            children: [
                              Chip(
                                label: Text(local.estadoTexto),
                                backgroundColor: local.estado == 1 ? Colors.green : Colors.red,
                                labelStyle: const TextStyle(color: Colors.white),
                              ),
                              const SizedBox(width: 8),
                              IconButton(
                                icon: const Icon(Icons.edit, color: Colors.blue),
                                onPressed: () async {
                                  final updated = await Navigator.push(
                                    context,
                                    MaterialPageRoute(
                                      builder: (_) => LocalEditScreen(local: local),
                                    ),
                                  );
                                  if (updated == true) {
                                    _loadLocales();
                                  }
                                },
                              ),
                            ],
                          ),
                        ),
                      );
                    },
                  ),
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: _loadLocales,
        child: const Icon(Icons.refresh),
      ),
    );
  }
}