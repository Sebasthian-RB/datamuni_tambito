<!-- resources/views/areas/AreaDeLaMujerViews/AmPersons/edit.blade.php -->
@extends('adminlte::page')

@section('title', 'Editar Persona')

@section('content_header')
    <h1>Editar Persona</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('amPerson.update', $amPerson->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulario para editar persona</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ $amPerson->id }}" disabled>
                </div>

                <div class="form-group">
                    <label for="identity_document">Documento de Identidad</label>
                    <select class="form-control @error('identity_document') is-invalid @enderror" id="identity_document" name="identity_document" required>
                        <option value="DNI" @selected($amPerson->identity_document == 'DNI')>DNI</option>
                        <option value="Pasaporte" @selected($amPerson->identity_document == 'Pasaporte')>Pasaporte</option>
                        <option value="Carnet" @selected($amPerson->identity_document == 'Carnet')>Carnet</option>
                        <option value="Cedula" @selected($amPerson->identity_document == 'Cedula')>Cedula</option>
                    </select>
                    @error('identity_document')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Otros campos similares al formulario de creación -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Actualizar Persona</button>
                </div>
            </div>
        </div>
    </form>
</div>
@stop
