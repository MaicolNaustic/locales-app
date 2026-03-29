@extends('layout')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Crear Nuevo Local</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('locales.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nombre del Local</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dirección</label>
                            <input type="text" name="direccion" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select name="estado" class="form-select" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">LatLong (opcional)</label>
                            <input type="text" name="latLong" class="form-control" placeholder="-0.2541, -79.1718">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tipo Documento</label>
                            <select name="tipo_documento" class="form-select">
                                <option value="">Ninguno</option>
                                <option value="RUC">RUC</option>
                                <option value="CEDULA">Cédula</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">N° Documento</label>
                            <input type="text" name="nro_documento" class="form-control">
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('locales.index') }}" class="btn btn-secondary me-md-2">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar Local</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection