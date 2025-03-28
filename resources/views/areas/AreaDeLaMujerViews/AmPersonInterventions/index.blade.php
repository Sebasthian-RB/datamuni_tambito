@extends('adminlte::page')

@section('title', 'Relaciones Persona-Intervención')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center py-3"
        style="background: #c06c84; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="max-height: 80px;">
    </div>
    <br>
    <h1 class="text-white" style="background: #355c7d; padding: 10px; border-radius: 8px; text-align: center;">
        Intervención por Persona
    </h1>
@stop

@section('content')
    <div class="container">
        <!-- Botones de acción -->
        <div class="mb-3 d-flex">
            @can('crear')
                <a href="{{ route('am_person_interventions.create') }}" class="btn text-white shadow-sm"
                    style="background: #f67280; border-radius: 8px;">
                    <i class="fa fa-plus"></i> Crear Relación
                </a>
            @endcan
            <a href="{{ route('amdashboard') }}" class="btn btn-secondary shadow-sm" style="border-radius: 8px;">
                <i class="fa fa-arrow-left"></i> Volver
            </a>
        </div>

        <!-- Formulario de búsqueda -->
        <div class="d-flex justify-content-start mb-3">
            <form method="GET" action="{{ route('am_person_interventions.index') }}" class="d-flex"
                style="max-width: 1000px;">
                <input type="text" name="search" class="form-control ms-3" placeholder="Buscar por nombre"
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
                <h3 class="card-title mb-0">Relaciones Registradas</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="text-white" style="background: #355c7d;">
                        <tr>
                            <th>ID</th>
                            <th>Persona</th>
                            <th>Intervención</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($amPersonInterventions as $relation)
                            <tr>
                                <td>{{ $relation->id }}</td>
                                <td>{{ $relation->amPerson->given_name }} {{ $relation->amPerson->paternal_last_name }}</td>
                                <td>{{ Str::limit($relation->intervention->appointment, 50) }}</td>
                                <td>
                                    <span class="badge text-white"
                                        style="font-size: 16px; padding: 8px; border-radius: 8px; 
                                         background: {{ $relation->status == 'En progreso' ? '#f39c12' : ($relation->status == 'Completado' ? '#28a745' : '#dc3545') }};">
                                        {{ $relation->status }}
                                    </span>
                                </td>
                                <td>
                                    @can('ver detalles')
                                        <a href="{{ route('am_person_interventions.show', $relation->id) }}"
                                            class="btn btn-info btn-sm shadow-sm">
                                            <i class="fa fa-eye"></i> Ver
                                        </a>
                                    @endcan
                                    @can('editar')
                                        <a href="{{ route('am_person_interventions.edit', $relation->id) }}"
                                            class="btn btn-warning btn-sm shadow-sm">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                    @endcan
                                    <form action="{{ route('am_person_interventions.destroy', $relation->id) }}"
                                        method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        @can('eliminar')
                                            <button type="button" class="btn btn-danger btn-sm shadow-sm delete-btn"
                                                data-id="{{ $relation->id }}">
                                                <i class="fa fa-trash"></i> Eliminar
                                            </button>
                                        @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Paginador -->
                <div class="mt-3">
                    {{ $amPersonInterventions->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Eliminación con confirmación mejorada
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const relationId = this.dataset.id;
                    const personName = this.closest('tr').querySelector('td:nth-child(2)')
                        .textContent;

                    Swal.fire({
                        title: '¿Eliminar Relación?',
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
                                <p>Se eliminará permanentemente la relación de:</p>
                                <strong>${personName}</strong>
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
