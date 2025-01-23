@extends('adminlte::page')

@section('title', 'Discapacidades')

@section('content_header')
    <h1>Lista de Discapacidades</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('disabilities.create') }}" class="btn btn-success">Nueva Discapacidad</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>N° Certificado</th>
                        <th>Diagnóstico</th>
                        <th>Tipo</th>
                        <th>Gravedad</th>
                        <th>Fecha de Emisión</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($disabilities as $disability)
                        <tr>
                            <td>{{ $disability->id }}</td>
                            <td>{{ $disability->certificate_number }}</td>
                            <td>{{ $disability->diagnosis }}</td>
                            <td>{{ $disability->disability_type }}</td>
                            <td>{{ $disability->severity_level }}</td>
                            <td>{{ $disability->certificate_issue_date->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('disabilities.show', $disability) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('disabilities.edit', $disability) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('disabilities.destroy', $disability) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay discapacidades registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
