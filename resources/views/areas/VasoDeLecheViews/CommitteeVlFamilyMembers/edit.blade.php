@extends('adminlte::page')

@section('title', 'Editar Miembro de Familia del Comité')

@section('content_header')
    <h1>Editar Miembro de Familia del Comité</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('committee_vl_family_members.update', $committeeVlFamilyMember->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulario para editar miembro de familia del comité</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="committee_id">Número de Comité</label>
                    <select class="form-control @error('committee_id') is-invalid @enderror" id="committee_id" name="committee_id" required>
                        @foreach ($committees as $committee)
                            <option value="{{ $committee->id }}" {{ old('committee_id', $committeeVlFamilyMember->committee_id) == $committee->id ? 'selected' : '' }}>
                                {{ $committee->id }} - {{ $committee->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('committee_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="vl_family_member_id">Miembro de Familia</label>
                    <select class="form-control @error('vl_family_member_id') is-invalid @enderror" id="vl_family_member_id" name="vl_family_member_id" required>
                        @foreach ($vlFamilyMembers as $familyMember)
                            <option value="{{ $familyMember->id }}" {{ old('vl_family_member_id', $committeeVlFamilyMember->vl_family_member_id) == $familyMember->id ? 'selected' : '' }}>
                                {{ $familyMember->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('vl_family_member_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="change_date">Fecha de Cambio</label>
                    <input type="date" class="form-control @error('change_date') is-invalid @enderror" id="change_date" name="change_date" value="{{ old('change_date', $committeeVlFamilyMember->change_date) }}" required>
                    @error('change_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $committeeVlFamilyMember->description) }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input @error('status') is-invalid @enderror" id="status" name="status" value="1" {{ old('status', $committeeVlFamilyMember->status) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Activo</label>
                    @error('status')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="{{ route('committee_vl_family_members.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop
