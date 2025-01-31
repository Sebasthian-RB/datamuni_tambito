@extends('adminlte::page')

@section('title', 'Lista de Guardianes')

@section('content_header')
<h1 style="color: #6E8E59;">Lista de Guardianes</h1>
@stop

@section('content')
<div class="container">
    <div class="mb-3">
        <a href="{{ route('guardians.create') }}" class="btn" style="background-color: #6E8E59; color: white;">
            <i class="fas fa-plus-circle"></i> Agregar Nuevo Guardián
        </a>
        <a href="{{ route('ciamdashboard') }}" class="btn btn-secondary" style="background-color: #CAE0BC; color: black;">
            <i class="fas fa-arrow-left"></i> Volver al Dashboard
        </a>
    </div>

    {{-- Mensajes de éxito y error --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card" style="border-color: #CAE0BC;">
        <div class="card-header" style="background-color: #6E8E59; color: white;">
            <h3 class="card-title"><i class="fas fa-user-shield"></i> Guardianes Registrados</h3>
        </div>
        <div class="card-body" style="background-color: #EAFAEA;">
            @if ($guardians->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> No hay guardianes registrados.
            </div>
            @else
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
                        <td>
                            @if ($guardian->phone_number)
                            {{ $guardian->phone_number }}
                            @else
                            <i class="fas fa-phone-slash" style="color: gray;"></i> No registrado
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('guardians.show', $guardian->id) }}" class="btn btn-sm" style="background-color: #6E8E59; color: white;" aria-label="Ver detalles">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('guardians.edit', $guardian->id) }}" class="btn btn-sm" style="background-color: #CAE0BC; color: black;" aria-label="Editar guardián">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('guardians.destroy', $guardian->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background-color: #780C28; color: white;" onclick="return confirm('¿Está seguro de eliminar este guardián?')" aria-label="Eliminar guardián">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@stop