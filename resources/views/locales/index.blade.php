<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locales App - Gestión de Locales</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body { 
            padding: 40px 20px; 
            background-color: #f8f9fa;
            font-family: system-ui, -apple-system, sans-serif;
        }
        .card { box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center mb-4">
            <h1>Gestión de Locales Comerciales</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <h5>Lista de Locales ({{ count($locales['data'] ?? $locales) }})</h5>
                <a href="{{ url('/locales') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-sync"></i> Actualizar
                </a>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Estado</th>
                                <th>Tipo Doc.</th>
                                <th>N° Doc</th>
                                <th>LatLong</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($locales['data'] ?? $locales as $local)
                                <tr>
                                    <td>{{ $local['id'] ?? $local->id }}</td>
                                    <td><strong>{{ $local['nombre'] ?? $local->nombre }}</strong></td>
                                    <td>{{ $local['direccion'] ?? $local->direccion }}</td>
                                    <td>
                                        @php $est = $local['estado'] ?? ($local->estado ?? 0); @endphp
                                        @if ($est == 1)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>{{ $local['tipo_documento'] ?? ($local->tipo_documento ?? '—') }}</td>
                                    <td>{{ $local['nro_documento'] ?? ($local->nro_documento ?? '—') }}</td>
                                    <td class="small text-muted">{{ $local['latLong'] ?? ($local->latLong ?? '—') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" onclick="editarLocal({{ json_encode($local) }})">
                                            Editar
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8" class="text-center py-4">No hay locales</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalEditar" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Local</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditar">
                        <input type="hidden" id="local_id">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" required>
                            </div>
                        </div>

                        <div class="row g-3 mt-3">
                            <div class="col-md-4">
                                <label class="form-label">Estado</label>
                                <select class="form-select" id="estado" required>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tipo Documento</label>
                                <select class="form-select" id="tipo_documento">
                                    <option value="">Ninguno</option>
                                    <option value="RUC">RUC</option>
                                    <option value="CEDULA">Cédula</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">N° Documento</label>
                                <input type="text" class="form-control" id="nro_documento">
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="form-label">LatLong (opcional)</label>
                            <input type="text" class="form-control" id="latLong">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="guardarCambios()">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function editarLocal(local) {
            document.getElementById('local_id').value = local.id;
            document.getElementById('nombre').value = local.nombre || '';
            document.getElementById('direccion').value = local.direccion || '';
            document.getElementById('estado').value = local.estado ?? 1;
            document.getElementById('tipo_documento').value = local.tipo_documento || '';
            document.getElementById('nro_documento').value = local.nro_documento || '';
            document.getElementById('latLong').value = local.latLong || '';

            new bootstrap.Modal(document.getElementById('modalEditar')).show();
        }

        async function guardarCambios() {
            const id = document.getElementById('local_id').value;
            if (!id) return;

            const data = {
                nombre: document.getElementById('nombre').value.trim(),
                direccion: document.getElementById('direccion').value.trim(),
                estado: parseInt(document.getElementById('estado').value),
                tipo_documento: document.getElementById('tipo_documento').value || null,
                nro_documento: document.getElementById('nro_documento').value.trim() || null,
                latLong: document.getElementById('latLong').value.trim() || null
            };

            try {
                const response = await fetch(`/api/locales/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (result.success) {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('modalEditar'));
                    if (modal) modal.hide();
                    
                    setTimeout(() => {
                        alert('✅ Local actualizado correctamente');
                        location.reload();
                    }, 300);
                } else {
                    alert('Error: ' + (result.message || 'No se pudo actualizar'));
                }
            } catch (error) {
                console.error(error);
                alert('Error de conexión. Revisa la consola (F12)');
            }
        }
    </script>
</body>
</html>