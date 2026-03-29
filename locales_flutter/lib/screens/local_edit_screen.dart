import 'package:flutter/material.dart';
import '../models/local.dart';
import '../services/api_service.dart';

class LocalEditScreen extends StatefulWidget {
  final Local local;

  const LocalEditScreen({super.key, required this.local});

  @override
  State<LocalEditScreen> createState() => _LocalEditScreenState();
}

class _LocalEditScreenState extends State<LocalEditScreen> {
  final ApiService _apiService = ApiService();
  final _formKey = GlobalKey<FormState>();

  late TextEditingController _nombreController;
  late TextEditingController _direccionController;
  late TextEditingController _latLongController;
  late TextEditingController _nroDocumentoController;

  String? _tipoDocumento;
  int _estado = 1;
  bool _isLoading = false;

  @override
  void initState() {
    super.initState();
    _nombreController = TextEditingController(text: widget.local.nombre);
    _direccionController = TextEditingController(text: widget.local.direccion);
    _latLongController = TextEditingController(text: widget.local.latLong ?? '');
    _nroDocumentoController = TextEditingController(text: widget.local.nroDocumento ?? '');
    _tipoDocumento = widget.local.tipoDocumento;
    _estado = widget.local.estado;
  }

  @override
  void dispose() {
    _nombreController.dispose();
    _direccionController.dispose();
    _latLongController.dispose();
    _nroDocumentoController.dispose();
    super.dispose();
  }

  Future<void> _updateLocal() async {
    if (!_formKey.currentState!.validate()) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Por favor completa los campos obligatorios')),
      );
      return;
    }

    setState(() => _isLoading = true);

    final updatedLocal = Local(
      id: widget.local.id,
      nombre: _nombreController.text.trim(),
      direccion: _direccionController.text.trim(),
      estado: _estado,
      latLong: _latLongController.text.trim().isEmpty ? null : _latLongController.text.trim(),
      tipoDocumento: _tipoDocumento,
      nroDocumento: _nroDocumentoController.text.trim().isEmpty ? null : _nroDocumentoController.text.trim(),
    );

    print('=== ENVIANDO A LA API ===');
    print('ID: ${widget.local.id}');
    print('Datos enviados: ${updatedLocal.toJson()}');
    print('========================');

    try {
      final success = await _apiService.updateLocal(widget.local.id, updatedLocal);

      setState(() => _isLoading = false);

      if (success) {
        if (mounted) {
          ScaffoldMessenger.of(context).showSnackBar(
            const SnackBar(
              content: Text('✅ Local actualizado correctamente'),
              backgroundColor: Colors.green,
            ),
          );
          Navigator.pop(context, true);
        }
      } else {
        if (mounted) {
          ScaffoldMessenger.of(context).showSnackBar(
            const SnackBar(
              content: Text('❌ Error al actualizar. Revisa los datos'),
              backgroundColor: Colors.red,
            ),
          );
        }
      }
    } catch (e) {
      setState(() => _isLoading = false);
      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Error de conexión: $e'),
            backgroundColor: Colors.red,
          ),
        );
      }
      print('Error detallado: $e');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Editar Local'),
        backgroundColor: Colors.blueAccent,
      ),
      body: _isLoading
          ? const Center(child: CircularProgressIndicator())
          : Padding(
              padding: const EdgeInsets.all(16.0),
              child: Form(
                key: _formKey,
                child: ListView(
                  children: [
                    TextFormField(
                      controller: _nombreController,
                      decoration: const InputDecoration(labelText: 'Nombre del Local *'),
                      validator: (value) => value!.isEmpty ? 'Obligatorio' : null,
                    ),
                    const SizedBox(height: 16),
                    TextFormField(
                      controller: _direccionController,
                      decoration: const InputDecoration(labelText: 'Dirección *'),
                      validator: (value) => value!.isEmpty ? 'Obligatorio' : null,
                    ),
                    const SizedBox(height: 16),
                    DropdownButtonFormField<int>(
                      value: _estado,
                      decoration: const InputDecoration(labelText: 'Estado *'),
                      items: const [
                        DropdownMenuItem(value: 1, child: Text('Activo')),
                        DropdownMenuItem(value: 0, child: Text('Inactivo')),
                      ],
                      onChanged: (value) => setState(() => _estado = value!),
                    ),
                    const SizedBox(height: 16),
                    DropdownButtonFormField<String?>(
                      value: _tipoDocumento,
                      decoration: const InputDecoration(labelText: 'Tipo de Documento'),
                      items: const [
                        DropdownMenuItem(value: null, child: Text('Ninguno')),
                        DropdownMenuItem(value: 'RUC', child: Text('RUC')),
                        DropdownMenuItem(value: 'CEDULA', child: Text('Cédula')),
                      ],
                      onChanged: (value) => setState(() => _tipoDocumento = value),
                    ),
                    const SizedBox(height: 16),
                    TextFormField(
                      controller: _nroDocumentoController,
                      decoration: const InputDecoration(labelText: 'N° Documento (opcional)'),
                    ),
                    const SizedBox(height: 16),
                    TextFormField(
                      controller: _latLongController,
                      decoration: const InputDecoration(
                        labelText: 'LatLong (opcional)',
                        hintText: '-0.2541, -79.1718',
                      ),
                    ),
                    const SizedBox(height: 40),
                    SizedBox(
                      width: double.infinity,
                      height: 50,
                      child: ElevatedButton(
                        onPressed: _updateLocal,
                        child: const Text('Guardar Cambios', style: TextStyle(fontSize: 16)),
                      ),
                    ),
                  ],
                ),
              ),
            ),
    );
  }
}