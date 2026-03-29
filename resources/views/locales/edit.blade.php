@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@extends('layout')

@section('contenido')

<h2>Editar Local</h2>

<form action="{{ route('locales.update', $local->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{ $local->nombre }}" required>
    </div>

    <div class="mb-3">
        <label>Dirección</label>
        <input type="text" name="direccion" class="form-control" value="{{ $local->direccion }}" required>
    </div>

    <div class="mb-3">
        <label>Teléfono</label>
        <input type="text" name="telefono" class="form-control" value="{{ $local->telefono }}">
    </div>

    <button class="btn btn-primary">Actualizar</button>
    <a href="/locales" class="btn btn-secondary">Volver</a>
</form>

@endsection