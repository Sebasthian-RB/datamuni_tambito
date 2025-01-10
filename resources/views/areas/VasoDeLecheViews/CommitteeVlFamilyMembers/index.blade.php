@extends('adminlte::page')

@section('title', 'Miembros de Familia del Comité')

@section('content_header')
    <h1>Lista de Miembros de Familia del Comité</h1>
@stop

@section('content')
<div class="container">
    <a href="{{ route('committee_vl_family_members.create') }}" class="btn btn-info mb-3">Agregar Miembro</a>
    <a href="{{ route('committees.index') }}" class="btn btn-danger mb-3">Volver</a>

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
                        <th>Comité</th>
                        <th>Miembro de Familia</th>
                        <th>Fecha de Cambio</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($committeeVlFamilyMembers as $member)
                        <tr>
                            <td>{{ $member->committee->id }} - {{ $member->committee->name }}</td>
                            <td>{{ $member->vlFamilyMember->name }}</td>
                            <td>{{ $member->change_date }}</td>
                            <td>{{ $member->description }}</td>
                            <td>{{ $member->status ? 'Activo' : 'Inactivo' }}</td>
                            <td>
                                <a href="{{ route('committee_vl_family_members.show', $member->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('committee_vl_family_members.edit', $member->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('committee_vl_family_members.destroy', $member->id) }}" method="POST" style="display:inline-block;">
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
