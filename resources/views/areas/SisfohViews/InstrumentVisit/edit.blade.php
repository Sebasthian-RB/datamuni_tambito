@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Editar Instrumento/Visita</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('instrument_visits.update', $instrumentVisit) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="application_date">Fecha de Aplicación:</label>
            <input type="date" name="application_date" id="application_date" class="form-control" value="{{ old('application_date', $instrumentVisit->application_date) }}" required>
        </div>
        <div class="form-group">
            <label for="descriptions">Descripciones:</label>
            <textarea name="descriptions" id="descriptions" class="form-control" rows="4">{{ old('descriptions', $instrumentVisit->descriptions) }}</textarea>
        </div>
        <div class="form-group">
            <label for="instrument_id">Instrumento:</label>
            <select name="instrument_id" id="instrument_id" class="form-control" required>
                <option value="">Seleccione un Instrumento</option>
                @foreach($instruments as $instrument)
                    <option value="{{ $instrument->id }}" {{ old('instrument_id', $instrumentVisit->instrument_id) == $instrument->id ? 'selected' : '' }}>
                        {{ $instrument->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="visit_id">Visita:</label>
            <select name="visit_id" id="visit_id" class="form-control" required>
                <option value="">Seleccione una Visita</option>
                @foreach($visits as $visit)
                    <option value="{{ $visit->id }}" {{ old('visit_id', $instrumentVisit->visit_id) == $visit->id ? 'selected' : '' }}>
                        {{ $visit->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="mt-3 btn btn-success">Actualizar</button>
    </form>
</div>
@endsection

