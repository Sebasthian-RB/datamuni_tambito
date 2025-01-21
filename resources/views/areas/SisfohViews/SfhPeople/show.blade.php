<!-- resources/views/sfh_people/show.blade.php -->

@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Detalles de la Persona</h2>

    <div class="card">
        <div class="card-body">
            <div class="mb-3 row">
                <div class="col-md-6">
                    <p><strong>ID:</strong> {{ $sfhPerson->id }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Documento de Identidad:</strong> {{ $sfhPerson->identity_document }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <p><strong>Nombre Completo:</strong> {{ $sfhPerson->given_name }} {{ $sfhPerson->paternal_last_name }} {{ $sfhPerson->maternal_last_name }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Estado Civil:</strong> {{ $sfhPerson->marital_status }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <p><strong>Fecha de Nacimiento:</strong> {{ $sfhPerson->birth_date }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Sexo:</strong> {{ $sfhPerson->sex_type == 0 ? 'Femenino' : 'Masculino' }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <p><strong>Número de Teléfono:</strong> {{ $sfhPerson->phone_number }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Nacionalidad:</strong> {{ $sfhPerson->nationality }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <p><strong>Grado Académico:</strong> {{ $sfhPerson->degree }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Ocupación:</strong> {{ $sfhPerson->occupation }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <p><strong>Categoría SISFOH:</strong> {{ $sfhPerson->sfh_category }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Teléfono:</strong> {{ $sfhPerson->phone_number }}</p>
                </div>
            </div>
            <a href="{{ route('sfh_people.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('sfh_people.edit', $Person) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
</div>
@endsection
