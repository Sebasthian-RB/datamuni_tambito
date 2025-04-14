@extends('adminlte::page')

@section('title', 'Sesiones Psicológicas')

@section('content_header')
    <h1>Sesiones Psicológicas</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('psychological-sessions.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Nueva Sesión
    </a>

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Persona</th>
                        <th>N° Sesión</th>
                        <th>Fecha</th>
                        <th>Asistencia</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sessions as $session)
                        <tr>
                            <td>{{ $session->id }}</td>
                            <td>
                                {{-- Persona y Diagnóstico --}}
                                {{ $session->diagnosis->person->full_name ?? 'Sin nombre' }} <br>
                                <strong>Diagnóstico:</strong> {{ Str::limit($session->diagnosis->diagnosis, 50) ?? 'No disponible' }}
                            </td>                            <td>{{ $session->session_number }}</td>
                            <td>{{ \Carbon\Carbon::parse($session->scheduled_date)->format('d/m/Y') }}</td>
                            <td>
                                @switch($session->attendance_status)
                                    @case('Asistió')
                                        <span class="badge bg-success">Asistió</span>
                                        @break
                                    @case('No asistió')
                                        <span class="badge bg-danger">No asistió</span>
                                        @break
                                    @case('Justificó')
                                        <span class="badge bg-warning">Justificó</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">Sin registro</span>
                                @endswitch
                            </td>
                            <td>{{ $session->description ? Str::limit($session->description, 40) : '—' }}</td>
                            <td>
                                <a href="{{ route('psychological-sessions.show', $session) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('psychological-sessions.edit', $session) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('psychological-sessions.destroy', $session) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Seguro que deseas eliminar esta sesión?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($sessions->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">No hay sesiones registradas.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
