@extends('adminlte::page')

@section('title', 'Listado de Viviendas')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center py-3"
        style="background: #930813; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="max-height: 60px;">
    </div>
@stop

@section('content')
    <div class="card shadow-lg" style="border-radius: 15px; border-left: 5px solid #99050f;">

        <!-- Encabezado de la tarjeta con botón al lado del título -->
        <div class="card-header d-flex align-items-center"
            style="background: #f00e1c; color: white; border-radius: 15px 15px 0 0;">

            <h3 class="mb-0 d-flex align-items-center">
                Viviendas Registradas
                <a href="{{ route('om-people.index') }}" class="btn btn-custom btn-sm ms-1">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </h3>
        </div>

        <!-- Cuerpo de la tarjeta -->
        <div class="card-body">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Localización</th>
                        <th>Referencia</th>
                        <th>Agua/Luz</th>
                        <th>Tipo</th>
                        <th>Ocupantes</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dwellings as $dwelling)
                        <tr>
                            <td>{{ $dwelling->id }}</td>
                            <td>{{ $dwelling->exact_location }}</td>
                            <td>{{ $dwelling->reference ?? 'N/A' }}</td>
                            <td>{{ $dwelling->water_electricity }}</td>
                            <td>{{ $dwelling->type }}</td>
                            <td>{{ $dwelling->permanent_occupants }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('om-dwellings.show', $dwelling->id) }}" class="btn btn-info btn-sm mx-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('om-dwellings.edit', $dwelling->id) }}"
                                    class="btn btn-warning btn-sm mx-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Botón de eliminar con SweetAlert -->
                                <button class="btn btn-danger btn-sm delete-button" data-id="{{ $dwelling->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- Formulario oculto para la eliminación -->
                                <form id="delete-form-{{ $dwelling->id }}"
                                    action="{{ route('om-dwellings.destroy', $dwelling->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-3">
            {{ $dwellings->links('pagination::bootstrap-4') }}
        </div>

    </div>
@stop

@section('css')
    <style>
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

        .table-striped tbody tr:hover {
            background-color: #f8d7da !important;
        }

        .table-dark th {
            background-color: #930813 !important;
            color: white;
        }
    </style>
    <style>
        /* Contenedor de la paginación */
        .pagination {
            justify-content: center;
            margin-top: 10px;
        }

        /* Estilos para los botones de paginación */
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
                    const dwellingId = this.getAttribute("data-id");
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
                            document.getElementById(`delete-form-${dwellingId}`).submit();
                        }
                    });
                });
            });
        });
    </script>
@stop