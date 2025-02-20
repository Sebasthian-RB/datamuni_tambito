@extends('adminlte::page')

@section('title', 'Listado de Personas')

@section('content_header')
    <div class="d-flex justify-content-center align-items-center py-3"
        style="background: #930813; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="max-height: 80px;">
    </div>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container-fluid">
        <h1 class="text-center mb-4" style="color: #f00e1c; font-weight: bold; text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">
            Gestión de Personas
        </h1>
        <div class="row mb-4">
            <div class="col text-center">
                <a href="{{ route('om-people.create') }}" class="btn btn-custom shadow">
                    <i class="fas fa-plus-circle mr-2"></i> Nueva Persona
                </a>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($people as $person)
                <div class="col">
                    <div class="card person-card animate__animated animate__fadeInUp hover-shadow">
                        <div class="card-header text-center position-relative" style="background: rgba(240, 14, 28, 0.2);">
                            <!-- Botón de eliminar como X -->
                            <button class="btn btn-link position-absolute end-0 top-0 p-1 delete-button" 
                                    data-id="{{ $person->id }}"
                                    data-toggle="tooltip" 
                                    title="Eliminar"
                                    style="color: #f00e1c;">
                                <i class="fas fa-times"></i>
                            </button>
                            
                            <h5 class="card-title mb-0 text-uppercase"
                                style="color: #f00e1c; font-weight: bold; font-size: 1.2rem;">
                                {{ $person->paternal_last_name }} {{ $person->given_name }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>DNI:</span>
                                    <strong>{{ $person->dni }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Edad:</span>
                                    <span class="badge badge-pill bg-custom">{{ $person->age }}</span>
                                </li>
                                <li class="list-group-item">
                                    <small class="text-muted">Estado Civil:</small>
                                    <div>{{ $person->marital_status }}</div>
                                </li>
                            </ul>
                        </div>
                        <!-- Botones inferiores -->
                        <div class="card-footer bg-transparent d-flex justify-content-center gap-2">
                            <a href="{{ route('om-people.show', $person->id) }}"
                                class="btn btn-outline-custom btn-sm"
                                data-toggle="tooltip" 
                                title="Ver detalles">
                                <i class="fas fa-eye mr-2"></i>Ver
                            </a>
                            <a href="{{ route('om-people.edit', $person->id) }}"
                                class="btn btn-outline-custom btn-sm"
                                data-toggle="tooltip" 
                                title="Editar">
                                <i class="fas fa-edit mr-2"></i>Editar
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $people->links() }}
        </div>
    </div>

    <form id="delete-form" action="{{ route('om-people.destroy', '') }}" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        :root {
            --primary-color: #f00e1c;
            --primary-hover: #d40c1a;
        }

        .btn-custom {
            background: var(--primary-color);
            color: white;
            transition: all 0.3s ease;
            border-radius: 30px;
            padding: 12px 25px;
        }

        .btn-custom:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 5px 15px rgba(240, 14, 28, 0.3);
        }

        .person-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(240, 14, 28, 0.1);
            border-radius: 15px;
            overflow: hidden;
        }

        .person-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(240, 14, 28, 0.1);
        }

        .custom-button {
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .custom-button:hover {
            transform: scale(1.1);
        }
    </style>
    <style>
        /* ... otros estilos anteriores ... */
    
        /* Botón de cierre personalizado */
        .btn-close-custom {
            color: var(--primary-color);
            opacity: 0.8;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
    
        .btn-close-custom:hover {
            opacity: 1;
            transform: rotate(90deg);
            color: var(--primary-hover);
        }
    
        /* Botones outline personalizados */
        .btn-outline-custom {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 8px;
            transition: all 0.3s ease;
            padding: 0.25rem 0.75rem;
        }
    
        .btn-outline-custom:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }
    
        /* Mejora posición del botón eliminar */
        .card-header .delete-button {
            right: 10px;
            top: 10px;
            z-index: 1;
        }
    
        .card-header .delete-button:hover {
            text-decoration: none;
        }
    
        .card-header .delete-button i {
            font-size: 1.2rem;
            transition: transform 0.2s ease;
        }
    
        .card-header .delete-button:hover i {
            transform: scale(1.2);
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('[data-toggle="tooltip"]').tooltip();

            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const form = document.getElementById('delete-form');
                    form.action = `om-people/${id}`;

                    Swal.fire({
                        title: '¿Confirmar eliminación?',
                        text: "¡Esta acción no se puede revertir!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#f00e1c',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@stop
