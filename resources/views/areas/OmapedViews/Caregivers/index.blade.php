@extends('adminlte::page')

@section('title', 'Listado de Cuidadores')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center py-3"
        style="background: #930813; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="max-height: 60px;">
    </div>

@stop

@section('content')
    <div class="card shadow-lg"
        style="border-radius: 15px; max-width: 1100px; margin: 2rem auto; border-left: 5px solid #99050f;">
        <!-- Cabecera con diseño -->
        <div class="card-header d-flex justify-content-between align-items-center"
            style="background: #f00e1c; color: white; border-radius: 15px 15px 0 0;">
            <h3 class="mb-0 d-flex align-items-center">
                Cuidadores Registradas
                <a href="{{ route('om-people.index') }}" class="btn btn-custom btn-sm ms-1">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </h3>
        </div>

        <!-- Cuerpo de la tarjeta -->
        <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-hover text-center">
                <thead style="background: #f00e1c; color: white;">
                    <tr>
                        <th>#</th>
                        <th>Nombre Completo</th>
                        <th>Relación</th>
                        <th>DNI</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($caregivers as $caregiver)
                        <tr>
                            <td>{{ $caregiver->id }}</td>
                            <td>{{ $caregiver->full_name }}</td>
                            <td>{{ $caregiver->relationship }}</td>
                            <td>{{ $caregiver->dni }}</td>
                            <td>{{ $caregiver->phone ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('caregivers.show', $caregiver) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('caregivers.edit', $caregiver) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Botón de eliminar con SweetAlert -->
                                <button class="btn btn-danger btn-sm delete-button" data-id="{{ $caregiver->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- Formulario oculto para la eliminación -->
                                <form id="delete-form-{{ $caregiver->id }}"
                                    action="{{ route('caregivers.destroy', $caregiver) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay cuidadores registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Paginación mejorada -->
            <div class="d-flex justify-content-center mt-3">
                {{ $caregivers->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Personalización de la tabla */
        .table-hover tbody tr:hover {
            background: rgba(255, 0, 0, 0.1);
        }

        /* Estilos para los botones */
        .btn-custom:hover {
            background-color: #ffffff;
            border-color: #ffffff;
            color: rgb(0, 0, 0);
        }
        .btn-custom {
            background-color: #930813;
            border: 1px solid #930813;
            color: white;
            border-radius: 8px;
            padding: 5px 12px;
            font-size: 14px;
            transition: all 0.3s;
            margin-left: 15px;
        }

        /* Personalización de la paginación */
        .pagination {
            justify-content: center;
            margin-top: 10px;
        }

        .page-link {
            color: #f00e1c;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
        }

        .page-item.active .page-link {
            background-color: #f00e1c;
            border-color: #f00e1c;
            color: white;
        }

        .page-link:hover {
            background-color: #930813;
            color: white;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const deleteButtons = document.querySelectorAll(".delete-button");

            deleteButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const caregiverId = this.getAttribute("data-id");
                    Swal.fire({
                        title: "¿Estás seguro?",
                        text: "Esta acción no se puede deshacer.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Sí, eliminar",
                        cancelButtonText: "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`delete-form-${caregiverId}`).submit();
                        }
                    });
                });
            });
        });
    </script>
@stop
