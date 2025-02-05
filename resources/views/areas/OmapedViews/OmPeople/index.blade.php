@extends('adminlte::page')

@section('title', 'Listado de Personas')

@section('content_header')
    <h1>Listado de Personas</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('om-people.create') }}" class="btn btn-success mb-3">Registrar Nueva Persona</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre Completo</th>
                <th>Estado Civil</th>
                <th>DNI</th>
                <th>Edad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($people as $person)
                <tr>
                    <td>{{ $person->paternal_last_name }} {{ $person->maternal_last_name }} {{ $person->given_name }}</td>
                    <td>{{ $person->marital_status }}</td>
                    <td>{{ $person->dni }}</td>
                    <td>{{ $person->age }}</td>
                    <td>
                        <a href="{{ route('om-people.show', $person->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('om-people.edit', $person->id) }}" class="btn btn-warning">Editar</a>

                        <!-- Botón de Eliminar con alerta -->
                        <button class="btn btn-danger delete-button" data-id="{{ $person->id }}">Eliminar</button>

                        <!-- Formulario oculto para enviar la solicitud DELETE -->
                        <form id="delete-form-{{ $person->id }}" action="{{ route('om-people.destroy', $person->id) }}" method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Seleccionar todos los botones de eliminar
            const deleteButtons = document.querySelectorAll(".delete-button");

            deleteButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const personId = this.getAttribute("data-id");
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
                            document.getElementById(`delete-form-${personId}`).submit();
                        }
                    });
                });
            });
        });
    </script>
@stop
