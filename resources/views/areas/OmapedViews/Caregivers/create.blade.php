@extends('adminlte::page')

@section('title', 'Agregar Cuidador')

@section('content_header')
    <h1>Agregar Cuidador</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('caregivers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="full_name">Nombre Completo</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
            </div>

            <div class="form-group">
                <label for="relationship">Relación</label>
                <input type="text" class="form-control" id="relationship" name="relationship" value="{{ old('relationship') }}" required>
            </div>

            <div class="form-group">
                <label for="dni">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni" value="{{ old('dni') }}" required maxlength="8">
            </div>

            <div class="form-group">
                <label for="phone">Teléfono</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Guardar
            </button>
            <a href="{{ route('caregivers.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Regresar
            </a>
        </form>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/vendor/adminlte/dist/css/adminlte.min.css">
@stop

@section('js')
    <script>
        console.log('Formulario de Agregar Cuidador cargado.');
    </script>
@stop
