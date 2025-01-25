<!-- resources/views/areas/SisfohViews/SfhDwellingSfhPerson/create.blade.php -->
@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Añadir Persona a la Vivienda</h1>
        <form action="{{ route('sfh_dwelling_sfh_people.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="sfh_person_id" class="form-label">ID de Persona</label>
                <input type="text" name="sfh_person_id" id="sfh_person_id" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Estado</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="update_date" class="form-label">Fecha de Actualización</label>
                <input type="date" name="update_date" id="update_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="sfh_dwelling_id" class="form-label">ID de Vivienda</label>
                <input type="text" name="sfh_dwelling_id" id="sfh_dwelling_id" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('sfh_dwelling_sfh_people.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
