@extends('adminlte::page')

@section('title', 'Crear Tipo de Violencia')

@section('content_header')
    <!-- Imagen superior -->
    <div class="d-flex justify-content-center align-items-center py-3"
        style="background: #c06c84; border-radius: 0 0 15px 15px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="max-height: 80px;">
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="card shadow-lg" style="border-radius: 15px; max-width: 800px; margin: 2rem auto;">
            <div class="card-header" style="background: #355c7d; color: white; border-radius: 15px 15px 0 0;">
                <h3 class="card-title mb-0">Nueva Violencia</h3>
            </div>
            <div class="card-body" style="background: linear-gradient(135deg, #f8b19550 0%, #f6728050 100%);">
                <form action="{{ route('violences.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="kind_violence" class="font-weight-bold" style="color: #355c7d;">Tipo de
                            Violencia</label>
                        <input type="text" name="kind_violence" id="kind_violence" class="form-control shadow-sm"
                            style="border: 2px solid #c06c84; border-radius: 8px;" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="description" class="font-weight-bold" style="color: #355c7d;">Descripción</label>
                        <textarea name="description" id="description" class="form-control shadow-sm" rows="4"
                            style="border: 2px solid #c06c84; border-radius: 8px;" required></textarea>
                    </div>
                    <!-- Botones de Acción -->
                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-lg shadow-sm"
                            style="background: #f67280; border-color: #f67280; color: white; border-radius: 8px;">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                        <a href="{{ route('violences.index') }}" class="btn btn-lg btn-secondary shadow-sm"
                            style="border-radius: 8px;">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('css')
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <style>
        .form-control:focus {
            border-color: #f67280 !important;
            box-shadow: 0 0 0 0.2rem rgba(246, 114, 128, 0.25) !important;
        }

        .card {
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .btn {
            border-radius: 8px !important;
        }
    </style>
@stop
