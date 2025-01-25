<!-- resources/views/areas/SisfohViews/SfhDwellingSfhPerson/edit.blade.php -->
@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Editar Persona en la Vivienda</h1>
        <form action="{{ route('sfh_dwelling_sfh_people.update', $sfhDwellingSfhPerson->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="sfh_person_id" class="form-label">ID de Persona</label>
                <input type="text" name="sfh_person_id" id="sfh_person_id" class="form-control" value="{{ $sfhDwellingSfhPerson->sfh_person_id }}" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Estado</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Activo" {{ $sfhDwellingSfhPerson->status == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ $sfhDwellingSfhPerson->status == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="update_date" class="form-label">Fecha de Actualización</label>
                <input type="date" name="update_date" id="update_date" class="form-control" value="{{ $sfhDwellingSfhPerson->update_date }}" required>
            </div>

            <div class="mb-3">
                <label for="sfh_dwelling_id" class="form-label">ID de Vivienda</label>
                <input type="text" name="sfh_dwelling_id" id="sfh_dwelling_id" class="form-control" value="{{ $sfhDwellingSfhPerson->sfh_dwelling_id }}" required>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('sfh_dwelling_sfh_people.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection

