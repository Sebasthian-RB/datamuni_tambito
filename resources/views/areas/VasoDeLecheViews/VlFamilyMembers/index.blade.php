@extends('adminlte::page')

@section('title', 'Miembros de Familia')

@section('content_header')
    <h1>Lista de Miembros de Familia</h1>
@stop

@section('content')
<div class="container">
    <a href="{{ route('vl_family_members.create') }}" class="btn btn-info mb-3">Agregar Miembro</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Miembros Registrados</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>ID</th>
                        <th>Tipo de Documento</th>
                        <th>Nombre Completo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vlFamilyMembers as $member)
                        <tr>
                            <td>{{ $member->id }}</td>
                            <td>{{ $member->identity_document }}</td>
                            <td>{{ $member->given_name }} {{ $member->paternal_last_name }} {{ $member->maternal_last_name }}</td>
                            <td>
                                <a href="{{ route('vl_family_members.show', $member->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('vl_family_members.edit', $member->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('vl_family_members.destroy', $member->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este miembro?')">Eliminar</button>
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
