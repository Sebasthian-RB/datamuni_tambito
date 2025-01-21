<!-- resources/views/sfh_people/index.blade.php -->

@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Lista de Personas</h2>

    <a href="{{ route('sfh_people.create') }}" class="mb-3 btn btn-primary">Crear Persona</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Documento de Identidad</th>
                <th>Primer Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Estado Civil</th>
                <th>Fecha de Nacimiento</th>
                <th>Sexo</th>
                <th>Número de Teléfono</th>
                <th>Nacionalidad</th>
                <th>Grado Académico</th>
                <th>Ocupación</th>
                <th>Categoría SISFOH</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($people as $person)
                <tr>
                    <td>{{ $person->id }}</td>
                    <td>{{ $person->identity_document }}</td>
                    <td>{{ $person->given_name }}</td>
                    <td>{{ $person->paternal_last_name }}</td>
                    <td>{{ $person->maternal_last_name }}</td>
                    <td>{{ $person->marital_status }}</td>
                    <td>{{ $person->birth_date }}</td>
                    <td>{{ $person->sex_type == 0 ? 'Femenino' : 'Masculino' }}</td>
                    <td>{{ $person->phone_number }}</td>
                    <td>{{ $person->nationality }}</td>
                    <td>{{ $person->degree }}</td>
                    <td>{{ $person->occupation }}</td>
                    <td>{{ $person->sfh_category }}</td>
                    <td>
                        <a href="{{ route('sfh_people.show', $person) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('sfh_people.edit', $person) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('sfh_people.destroy', $person) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta persona?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

