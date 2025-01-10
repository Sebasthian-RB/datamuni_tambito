@extends('adminlte::page')

@section('title', 'Agregar Miembro de Familia al Comité')

@section('content_header')
    <h1>Agregar Miembro de Familia al Comité</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('committee_vl_family_members.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulario para agregar miembro de familia al comité</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="committee_id">Número de Comité</label>
                    <select class="form-control @error('committee_id') is-invalid @enderror" id="committee_id" name="committee_id" required>
                        @foreach ($committees as $committee)
                            <option value="{{ $committee->id }}" {{ old('committee_id') == $committee->id ? 'selected' : '' }}>
                                {{ $committee->id }} - {{ $committee->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('committee_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="committee_id">Comité</label>
                    @if($committees->isEmpty())
                        <p>No hay comités disponibles.</p>
                    @else
                        <select name="committee_id" id="committee_id" class="form-control @error('committee_id') is-invalid @enderror" required>
                            <option value="" disabled selected>Seleccione un comité</option> <!-- Opción vacía por defecto -->
                            @foreach($committees as $committee)
                                <option value="{{ $committee->id }}" {{ old('committee_id') == $committee->id ? 'selected' : '' }}>
                                    {{ $committee->name }} <!-- Asume que el comité tiene un atributo 'name', ajusta según el campo real -->
                                </option>
                            @endforeach
                        </select>
                        @error('committee_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    @endif
                </div>                   

                <div class="form-group">
                    <label for="change_date">Fecha de Cambio</label>
                    <input type="date" class="form-control @error('change_date') is-invalid @enderror" id="change_date" name="change_date" value="{{ old('change_date') }}" required>
                    @error('change_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Estado</label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="" disabled selected>Seleccione un estado</option>
                        @foreach ($statusOptions as $value => $label)
                            <option value="{{ $value }}" {{ old('status') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>                             
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('committee_vl_family_members.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop
