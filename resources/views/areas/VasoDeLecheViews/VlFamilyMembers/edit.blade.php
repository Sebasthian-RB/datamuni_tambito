@extends('adminlte::page')

@section('title', 'Editar Miembro de Familia')

@section('content_header')
    <h1>Editar Miembro de Familia</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('vl_family_members.update', $vlFamilyMember->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulario para editar miembro de familia</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="id">Número de Documento</label>
                    <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" value="{{ old('id', $vlFamilyMember->id) }}" required>
                    @error('id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="identity_document">Tipo de Documento</label>
                    <select class="form-control @error('identity_document') is-invalid @enderror" id="identity_document" name="identity_document" required>
                        <option value="" disabled selected>Seleccione un tipo de documento</option>
                        @foreach($identityDocumentTypes as $key => $label)
                            <option value="{{ $key }}" {{ old('identity_document', $vlFamilyMember->identity_document) == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('identity_document')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>                
                <div class="form-group">
                    <label for="given_name">Nombres</label>
                    <input type="text" class="form-control @error('given_name') is-invalid @enderror" id="given_name" name="given_name" value="{{ old('given_name', $vlFamilyMember->given_name) }}" required>
                    @error('given_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="paternal_last_name">Apellido Paterno</label>
                    <input type="text" class="form-control @error('paternal_last_name') is-invalid @enderror" id="paternal_last_name" name="paternal_last_name" value="{{ old('paternal_last_name', $vlFamilyMember->paternal_last_name) }}" required>
                    @error('paternal_last_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="maternal_last_name">Apellido Materno</label>
                    <input type="text" class="form-control @error('maternal_last_name') is-invalid @enderror" id="maternal_last_name" name="maternal_last_name" value="{{ old('maternal_last_name', $vlFamilyMember->maternal_last_name) }}" required>
                    @error('maternal_last_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Actualizar Miembro</button>
                <a href="{{ route('vl_family_members.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop
