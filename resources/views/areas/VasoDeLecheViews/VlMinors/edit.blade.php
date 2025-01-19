@extends('adminlte::page')

@section('title', 'Editar Menor')

@section('content_header')
    <h1>Editar Menor</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('vl_minors.update', $vlMinor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header" style="background-color: #3B1E54; color: #FFFFFF;">
                <h3 class="card-title">Formulario para editar menor</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="id">Número de Documento</label>
                    <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" value="{{ old('id', $vlMinor->id) }}" required>
                    @error('id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="identity_document">Tipo de Documento</label>
                    <select class="form-control @error('identity_document') is-invalid @enderror" id="identity_document" name="identity_document" required>
                        <option value="" disabled>Seleccione un documento</option>
                        @foreach($documentTypes as $type)
                            <option value="{{ $type }}" {{ old('identity_document', $vlMinor->identity_document) == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('identity_document')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="given_name">Nombre</label>
                    <input type="text" class="form-control @error('given_name') is-invalid @enderror" id="given_name" name="given_name" value="{{ old('given_name', $vlMinor->given_name) }}" required>
                    @error('given_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="paternal_last_name">Apellido Paterno</label>
                    <input type="text" class="form-control @error('paternal_last_name') is-invalid @enderror" id="paternal_last_name" name="paternal_last_name" value="{{ old('paternal_last_name', $vlMinor->paternal_last_name) }}" required>
                    @error('paternal_last_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="maternal_last_name">Apellido Materno</label>
                    <input type="text" class="form-control @error('maternal_last_name') is-invalid @enderror" id="maternal_last_name" name="maternal_last_name" value="{{ old('maternal_last_name', $vlMinor->maternal_last_name) }}" required>
                    @error('maternal_last_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="birth_date">Fecha de Nacimiento</label>
                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date', \Carbon\Carbon::parse($vlMinor->birth_date)->format('Y-m-d')) }}" required>
                    @error('birth_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sex_type">Sexo</label>
                    <select class="form-control @error('sex_type') is-invalid @enderror" id="sex_type" name="sex_type" required>
                        <option value="" disabled>Seleccione el sexo</option>
                        @foreach($sexTypes as $key => $value)
                            <option value="{{ $key }}" {{ old('sex_type', $vlMinor->sex_type) === (string) $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('sex_type')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="registration_date">Fecha de Registro</label>
                    <input type="date" class="form-control @error('registration_date') is-invalid @enderror" id="registration_date" name="registration_date" value="{{ old('registration_date', \Carbon\Carbon::parse($vlMinor->registration_date)->format('Y-m-d')) }}" required>
                    @error('registration_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="withdrawal_date">Fecha de Retiro</label>
                    <input type="date" class="form-control @error('withdrawal_date') is-invalid @enderror" id="withdrawal_date" name="withdrawal_date" value="{{ old('withdrawal_date', \Carbon\Carbon::parse($vlMinor->withdrawal_date)->format('Y-m-d')) }}">
                    @error('withdrawal_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $vlMinor->address) }}" required>
                    @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dwelling_type">Tipo de Vivienda</label>
                    <select class="form-control @error('dwelling_type') is-invalid @enderror" id="dwelling_type" name="dwelling_type" required>
                        <option value="" disabled>Seleccione el tipo de vivienda</option>
                        @foreach($dwellingTypes as $type)
                            <option value="{{ $type }}" {{ old('dwelling_type', $vlMinor->dwelling_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('dwelling_type')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="education_level">Nivel Educativo</label>
                    <select class="form-control @error('education_level') is-invalid @enderror" id="education_level" name="education_level" required>
                        <option value="" disabled>Seleccione el nivel educativo</option>
                        @foreach($educationLevels as $level)
                            <option value="{{ $level }}" {{ old('education_level', $vlMinor->education_level) == $level ? 'selected' : '' }}>{{ $level }}</option>
                        @endforeach
                    </select>
                    @error('education_level')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="condition">Condición</label>
                    <select class="form-control @error('condition') is-invalid @enderror" id="condition" name="condition" required>
                        <option value="" disabled>Seleccione la condición</option>
                        @foreach($conditions as $condition)
                            <option value="{{ $condition }}" {{ old('condition', $vlMinor->condition) == $condition ? 'selected' : '' }}>{{ $condition }}</option>
                        @endforeach
                    </select>
                    @error('condition')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="disability">Discapacidad</label>
                    <select class="form-control @error('disability') is-invalid @enderror" id="disability" name="disability" required>
                        <option value="" disabled {{ old('disability', $vlMinor->disability) === null ? 'selected' : '' }}>Seleccione si tiene discapacidad</option>
                        @foreach($disabilities as $key => $value)
                            <option value="{{ $key }}" {{ old('disability', $vlMinor->disability) === (string)$key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('disability')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="vl_family_member_id">Miembro Familiar</label>
                    @if($vlFamilyMembers->isEmpty())
                        <p>No hay miembros familiares disponibles.</p>
                    @else
                        <select name="vl_family_member_id" id="vl_family_member_id" class="form-control @error('vl_family_member_id') is-invalid @enderror" required>
                            <option value="" disabled>Seleccione un miembro familiar</option>
                            @foreach($vlFamilyMembers as $member)
                                <option value="{{ $member->id }}" {{ old('vl_family_member_id', $vlMinor->vl_family_member_id) == $member->id ? 'selected' : '' }}>
                                    {{ $member->given_name }} {{ $member->paternal_last_name }} {{ $member->maternal_last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('vl_family_member_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    @endif
                </div>                                                                      
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success" style="background-color: #9B7EBD; color: white; border: #9B7EBD;">Actualizar Menor</button>
                <a href="{{ route('vl_minors.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop
