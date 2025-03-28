@extends('adminlte::page')

@section('title', 'Eventos')

@section('content_header')
    <!-- Imagen superior -->
    <div class="d-flex justify-content-center align-items-center py-3"
        style="background: #c06c84; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="max-height: 80px;">
    </div>
    <br>
    <h1 class="text-white" style="background: #355c7d; padding: 10px; border-radius: 8px; text-align: center;">
        Eventos Registrados
    </h1>
@stop

@section('content')
    <div class="container">
        <!-- Botones de acción -->
        <div class="mb-3 d-flex">
            @can('crear')
                <a href="{{ route('events.create') }}" class="btn text-white shadow-sm"
                    style="background: #f67280; border-radius: 8px;">
                    <i class="fa fa-plus"></i> Agregar Nuevo Evento
                </a>
            @endcan
            <a href="{{ route('amdashboard') }}" class="btn btn-secondary shadow-sm" style="border-radius: 8px;">
                <i class="fa fa-arrow-left"></i> Volver
            </a>
        </div>

        <!-- Formulario de búsqueda -->
        <div class="d-flex justify-content-start mb-3">
            <form method="GET" action="{{ route('events.index') }}" class="d-flex" style="max-width: 1000px;">
                <input type="text" name="search" class="form-control ms-3" placeholder="Buscar por nombre o lugar"
                    value="{{ request('search') }}" style="border-radius: 8px; max-width: 250px;">
                <button type="submit" class="btn text-white shadow-sm" style="background: #f67280; border-radius: 8px;">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success shadow-sm" style="border-radius: 8px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla de datos -->
        <div class="card shadow-lg" style="border-radius: 15px;">
            <div class="card-header text-white" style="background: #6c5b7b; border-radius: 15px 15px 0 0;">
                <h3 class="card-title mb-0">Eventos Registrados</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="text-white" style="background: #355c7d;">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Lugar</th>
                            <th>Programa</th>
                            <th>Estado</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $event->id }}</td>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->place }}</td>
                                <td>{{ $event->program->name }}</td>
                                <td>
                                    <span class="badge text-white"
                                        style="font-size: 16px; padding: 8px; border-radius: 8px;
                                                 background: {{ $event->status === 'En proceso'
                                                     ? '#f39c12'
                                                     : ($event->status === 'Finalizado'
                                                         ? '#28a745'
                                                         : ($event->status === 'Cancelado'
                                                             ? '#dc3545'
                                                             : '#f0ad4e')) }};">
                                        {{ $event->status }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</td>
                                <td>
                                    @can('ver detalles')
                                        <a href="{{ route('events.show', $event) }}" class="btn btn-info btn-sm shadow-sm">
                                            <i class="fa fa-eye"></i> Ver
                                        </a>
                                    @endcan
                                    @can('editar')
                                        <a href="{{ route('events.edit', $event) }}" class="btn btn-warning btn-sm shadow-sm">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                    @endcan
                                    <form action="{{ route('events.destroy', $event) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        @can('eliminar')
                                            <button type="button" class="btn btn-danger btn-sm shadow-sm delete-btn"
                                                data-id="{{ $event->id }}">
                                                <i class="fa fa-trash"></i> Eliminar
                                            </button>
                                        @endcan
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Paginador -->
                <div class="mt-3">
                    {{ $events->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
<style>
    /* Estilos para SweetAlert */
    .custom-swal {
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .swal2-confirm-btn {
        border-radius: 8px;
        padding: 10px 20px;
        transition: all 0.3s ease;
    }
    
    .swal2-cancel-btn {
        border-radius: 8px;
        padding: 10px 20px;
        transition: all 0.3s ease;
    }
    
    .swal2-icon.swal2-error {
        border-color: #FF3B30;
        color: #FF3B30;
    }
    
    .swal2-x-mark-line-left,
    .swal2-x-mark-line-right {
        background-color: #FF3B30;
    }
</style>
@stop
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Eliminación con confirmación mejorada
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const eventId = this.dataset.id;
                    const eventName = this.closest('tr').querySelector('td:nth-child(2)')
                        .textContent;

                    Swal.fire({
                        title: '¿Eliminar Evento?',
                        html: `<div class="swal2-icon-container">
                                <div class="swal2-icon-shadow"></div>
                                <div class="swal2-icon swal2-error">
                                    <div class="swal2-error-circular-line"></div>
                                    <div class="swal2-error-x-mark">
                                        <span class="swal2-x-mark-line-left"></span>
                                        <span class="swal2-x-mark-line-right"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="swal2-html-container">
                                <p>Se eliminará permanentemente el evento:</p>
                                <strong>${eventName}</strong>
                                <p class="text-muted mt-2">Esta acción también eliminará todas las asistencias relacionadas</p>
                            </div>`,
                        showCancelButton: true,
                        confirmButtonColor: '#FF3B30',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Confirmar Eliminación',
                        cancelButtonText: 'Cancelar',
                        background: '#f8f9fa',
                        customClass: {
                            popup: 'custom-swal',
                            confirmButton: 'swal2-confirm-btn',
                            cancelButton: 'swal2-cancel-btn'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = this.closest('form');
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
