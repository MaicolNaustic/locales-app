import 'dart:convert';
import 'package:http/http.dart' as http;
import '../models/local.dart';

class ApiService {
  static const String baseUrl = 'http://127.0.0.1:8000';

  Future<List<Local>> getLocales() async {
    try {
      final response = await http.get(Uri.parse('$baseUrl/api/locales'));

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        final List<dynamic> localesList = data['data'] ?? data;
        return localesList.map((json) => Local.fromJson(json)).toList();
      } else {
        throw Exception('Error ${response.statusCode}: ${response.body}');
      }
    } catch (e) {
      throw Exception('No se pudo conectar con el servidor: $e');
    }
  }

  Future<bool> updateLocal(int id, Local local) async {
    try {
      print('Enviando PUT a: $baseUrl/api/locales/$id');
      print('Datos: ${local.toJson()}');

      final response = await http.put(
        Uri.parse('$baseUrl/api/locales/$id'),
        headers: {'Content-Type': 'application/json'},
        body: json.encode(local.toJson()),
      );

      print('Respuesta status: ${response.statusCode}');
      print('Respuesta body: ${response.body}');

      return response.statusCode == 200 || response.statusCode == 201;
    } catch (e) {
      print('Error en updateLocal: $e');
      return false;
    }
  }
}