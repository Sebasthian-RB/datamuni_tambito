@extends('adminlte::page')

@section('title', 'Lista de Guardianes')

@section('content_header')
<h1 style="color: #6E8E59;">Lista de Guardianes</h1>
@stop

@section('content')
<div class="container">
    <a href="{{ route('guardians.create') }}" class="btn mb-3" style="background-color: #6E8E59; color: white;">Agregar Nuevo Guardián</a>
    <a href="{{ route('ciamdashboard') }}" class="btn btn-secondary mb-3" style="background-color: #CAE0BC; color: black;">Volver al Dashboard</a>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card" style="border-color: #CAE0BC;">
        <div class="card-header" style="background-color: #6E8E59; color: white;">
            <h3 class="card-title">Guardianes Registrados</h3>
        </div>
        <div class="card-body" style="background-color: #EAFAEA;">
            <table class="table table-bordered table-striped">
                <thead style="background-color: #6E8E59; color: white;">
                    <tr>
                        <th>ID</th>
                        <th>Tipo de Documento</th>
                        <th>Nombre Completo</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guardians as $guardian)
                    <tr>
                        <td>{{ $guardian->id }}</td>
                        <td>{{ $guardian->document_type }}</td>
                        <td>{{ $guardian->given_name }} {{ $guardian->paternal_last_name }} {{ $guardian->maternal_last_name }}</td>
                        <td>{{ $guardian->phone_number ?? 'No registrado' }}</td>
                        <td>
                            <a href="{{ route('guardians.show', $guardian->id) }}" class="btn btn-sm" style="background-color: #6E8E59; color: white;">Ver</a>
                            <a href="{{ route('guardians.edit', $guardian->id) }}" class="btn btn-sm" style="background-color: #CAE0BC; color: black;">Editar</a>
                            <form action="{{ route('guardians.destroy', $guardian->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background-color: #780C28; color: white;" onclick="return confirm('¿Está seguro de eliminar este guardián?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop