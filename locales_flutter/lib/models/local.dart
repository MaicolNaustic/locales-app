class Local {
  final int id;
  final String nombre;
  final String direccion;
  final int estado;
  final String? latLong;
  final String? tipoDocumento;
  final String? nroDocumento;

  Local({
    required this.id,
    required this.nombre,
    required this.direccion,
    required this.estado,
    this.latLong,
    this.tipoDocumento,
    this.nroDocumento,
  });

  factory Local.fromJson(Map<String, dynamic> json) {
    // Manejo seguro del campo estado (puede venir como bool o int)
    int estadoValue = 0;
    if (json['estado'] is bool) {
      estadoValue = json['estado'] == true ? 1 : 0;
    } else if (json['estado'] is int) {
      estadoValue = json['estado'];
    }

    return Local(
      id: json['id'],
      nombre: json['nombre'] ?? '',
      direccion: json['direccion'] ?? '',
      estado: estadoValue,
      latLong: json['latLong'],
      tipoDocumento: json['tipo_documento'],
      nroDocumento: json['nro_documento'],
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'nombre': nombre,
      'direccion': direccion,
      'estado': estado,
      'latLong': latLong,
      'tipo_documento': tipoDocumento,
      'nro_documento': nroDocumento,
    };
  }

  String get estadoTexto => estado == 1 ? 'Activo' : 'Inactivo';
}