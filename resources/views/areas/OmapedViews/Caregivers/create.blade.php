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
                    <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="relationship">Relación</label>
                    <select class="form-control" id="relationship" name="relationship" required>
                        <option value="">Seleccione...</option>
                        <option value="Padre">Padre</option>
                        <option value="Madre">Madre</option>
                        <option value="Hermano/a">Hermano/a</option>
                        <option value="Tío/a">Tío/a</option>
                        <option value="Abuelo/a">Abuelo/a</option>
                        <option value="Tutor/a">Tutor/a</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="text" class="form-control" id="dni" name="dni" value="{{ old('dni') }}"
                        required maxlength="8">
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
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
@stop

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const fullNameInput = document.getElementById("full_name");
            const dniInput = document.getElementById("dni");
            const phoneInput = document.getElementById("phone");

            // Formatear el nombre con mayúsculas iniciales
            function formatName(name) {
                return name.toLowerCase().replace(/\b\w/g, char => char.toUpperCase());
            }

            fullNameInput.addEventListener("input", function() {
                this.value = formatName(this.value);
            });

            // Solo permitir números en DNI y Teléfono
            dniInput.addEventListener("input", function() {
                this.value = this.value.replace(/\D/g, "").slice(0, 8);
            });

            phoneInput.addEventListener("input", function() {
                this.value = this.value.replace(/\D/g, "").slice(0, 9);
            });
        });
    </script>
@stop
