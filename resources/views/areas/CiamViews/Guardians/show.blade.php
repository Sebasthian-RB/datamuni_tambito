@extends('adminlte::page')

@section('title', 'Detalles del Guardián')

@section('content_header')
<h1 style="color: #6E8E59;">Detalles del Guardián: {{ $guardian->given_name }} {{ $guardian->paternal_last_name }}</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <!-- Encabezado con el logotipo -->
        <div class="card-header text-center" style="background-color: #6E8E59; color: white;">
            <h3 class="card-title">
                <i class="fas fa-user-shield"></i> {{ $guardian->given_name }} {{ $guardian->paternal_last_name }} {{ $guardian->maternal_last_name }}
            </h3>
        </div>

        <!-- Información del Guardián -->
        <div class="card-body" style="background-color: #EAFAEA;">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="background-color: #CAE0BC;">ID</th>
                        <td><span class="badge badge-success">{{ $guardian->id }}</span></td>
                    </tr>
                    <tr>
                        <th style="background-color: #CAE0BC;">Tipo de Documento</th>
                        <td>{{ $guardian->document_type }}</td>
                    </tr>
                    <tr>
                        <th style="background-color: #CAE0BC;">Nombre Completo</th>
                        <td>{{ $guardian->given_name }} {{ $guardian->paternal_last_name }} {{ $guardian->maternal_last_name }}</td>
                    </tr>
                    <tr>
                        <th style="background-color: #CAE0BC;">Relación con el Adulto Mayor</th>
                        <td>{{ $guardian->relationship }}</td>
                    </tr>
                    <tr>
                        <th style="background-color: #CAE0BC;">Teléfono</th>
                        <td>
                            @if ($guardian->phone_number)
                            <i class="fas fa-phone"></i> {{ $guardian->phone_number }}
                            @else
                            <i class="fas fa-phone-slash" style="color: gray;"></i> No registrado
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Botones de acción -->
        <div class="card-footer text-center" style="background-color: #CAE0BC;">
            <a href="{{ route('guardians.edit', $guardian->id) }}" class="btn text-white" style="background-color: #780C28;">
                <i class="fas fa-edit"></i> Editar
            </a>
            <a href="{{ route('guardians.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>
@stop