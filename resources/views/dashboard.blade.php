@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<!-- Header con la imagen grande -->
<div class="card mb-4">
    <div class="card-header p-0 d-flex justify-content-center align-items-center"
        style="background-color: #3fa22f; height: 60px;">
        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
            style="height: 100%; width: auto;">
    </div>
</div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <!-- AM Dashboard -->
            <div class="col-md-4 col-lg-3 mb-4">
                <a href="{{ route('amdashboard') }}" class="btn btn-block btn-primary btn-lg p-4">
                    <i class="fas fa-tachometer-alt fa-2x mr-2"></i>
                    <span class="h4">AM Dashboard</span>
                </a>
            </div>

            <!-- Vaso de Leche -->
            <div class="col-md-4 col-lg-3 mb-4">
                <a href="{{ route('vaso-de-leche.index') }}" class="btn btn-block btn-success btn-lg p-4">
                    <i class="fas fa-mug-hot fa-2x mr-2"></i>
                    <span class="h4">Vaso de Leche</span>
                </a>
            </div>

            <!-- OM Dashboard -->
            <div class="col-md-4 col-lg-3 mb-4">
                <a href="{{ route('omdashboard') }}" class="btn btn-block btn-info btn-lg p-4">
                    <i class="fas fa-users-cog fa-2x mr-2"></i>
                    <span class="h4">OM Dashboard</span>
                </a>
            </div>

            <!-- SISFOH -->
            <div class="col-md-4 col-lg-3 mb-4">
                <a href="{{ route('sfhdashboard') }}" class="btn btn-block btn-warning btn-lg p-4">
                    <i class="fas fa-clipboard-list fa-2x mr-2"></i>
                    <span class="h4">SISFOH</span>
                </a>
            </div>

            <!-- CIAM -->
            <div class="col-md-4 col-lg-3 mb-4">
                <a href="{{ route('CiamHome') }}" class="btn btn-block btn-danger btn-lg p-4">
                    <i class="fas fa-building fa-2x mr-2"></i>
                    <span class="h4">CIAM</span>
                </a>
            </div>
        </div>
    </div>
@stop