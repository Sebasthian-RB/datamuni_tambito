@extends('adminlte::page')

@section('title', 'Comités')

@section('content_header')
    <h1>Lista de Comités</h1>
@stop

@section('content')
<div class="container">
    <a href="{{ route('committees.create') }}" class="btn mb-3" style="background-color: #9B7EBD; color: white;">Agregar Comité</a>
    <a href="{{ route('vaso-de-leche.index') }}" class="btn btn-secondary mb-3">Volver</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($committees->isEmpty())
        <div class="alert alert-secondary">
            No hay comités disponibles para mostrar.
        </div>
    @else
        <div class="row">
            @foreach($committees as $committee)
                <div class="col-md-4 mb-4">  <!-- Cambié la columna a 4 para que sean 3 por fila -->
                    <div class="card">
                        <div class="card-header p-0 d-flex align-items-center" style="background-color: #3B1E54; color:#ffffff; height: 60px;">
                            <h5 class="card-title m-0 flex-grow-1" style="padding-left: 20px; padding-right: 20px;">
                                {{ $committee->name }}
                            </h5>
                            <img src="{{ asset('Images/escudo-el-tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="height: 40px; width: auto; margin-left: 20px; padding-right: 15px;">
                        </div>
                        <div class="card-body">
                            <p><strong>Número de Comité:</strong> {{ $committee->id }}</p>
                            <p><strong>Sector:</strong> {{ $committee->sector->name }}</p>
                            <p><strong>Presidente(a):</strong> 
                                {{ strtoupper($committee->president_paternal_surname) }} 
                                {{ strtoupper($committee->president_maternal_surname) ?? '' }}, 
                                {{ $committee->president_given_name }}
                            </p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('committees.show', $committee->id) }}" class="btn btn-sm" style="background-color: #9B7EBD; color: white;">Ver</a>
                            <a href="{{ route('committees.edit', $committee->id) }}" class="btn btn-sm" style="background-color: #D4BEE4; color: white;">Editar</a>
                            <form action="{{ route('committees.destroy', $committee->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este comité?')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@stop
