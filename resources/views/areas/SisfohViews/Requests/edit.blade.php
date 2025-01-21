@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Editar Solicitud</h1>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario para editar solicitud --}}
    <form action="{{ route('sfh_requests.update', $sfhRequest->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Fecha de Solicitud -->
        <div class="form-group">
            <label for="request_date">Fecha de la Solicitud</label>
            <input type="date" id="request_date" name="request_date" class="form-control @error('request_date') is-invalid @enderror" value="{{ old('request_date', $sfhRequest->request_date->format('Y-m-d')) }}">
            @error('request_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo de Descripción --}}
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea id="description" name="description" class="form-control" rows="3" required>{{ old('description', $sfhRequest->description) }}</textarea>
        </div>

        {{-- Campo de Persona relacionada --}}
        <div class="form-group">
            <label for="sfh_person_id">Persona relacionada</label>
            <select id="sfh_person_id" name="sfh_person_id" class="form-control @error('sfh_person_id') is-invalid @enderror" required>
                <option value="" disabled>Selecciona una persona</option>
                @foreach($people as $person)
                    <option value="{{ $person->id }}" {{ old('sfh_person_id', $sfhRequest->sfh_person_id) == $person->id ? 'selected' : '' }}>
                        {{ $person->given_name }} {{ $person->last_name }}
                    </option>
                @endforeach
            </select>
            @error('sfh_person_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        {{-- Botón de envío --}}
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('sfh_requests.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
