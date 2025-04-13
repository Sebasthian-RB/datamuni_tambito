@extends('adminlte::page')

@section('title', 'Asignación de Productos a Beneficiarios')

@section('content_header')
    <h1>ASIGNACIÓN DE PRODUCTOS A BENEFICIARIOS - {{ $committee->name }}</h1>
@stop

@section('content')
    <div class="container">
        <a href="{{ route('vl_family_member_products.create', $committee->id) }}" 
            class="btn mb-3" 
            style="background-color: #9B7EBD; color: white;">
             Nueva Asignación
         </a>
        <a href="{{ route('vaso-de-leche.index') }}" class="btn btn-secondary mb-3">Volver</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <section class="card shadow-sm"
            style="border-radius: 15px; border: none; overflow: hidden; background-color: #ffffff;">
            <div class="card-header"
                style="background: linear-gradient(135deg, #8E6AB8, #6A4A8E); border: none; padding: 20px;">
                <div class="row align-items-center">
                    <div class="col-md-9">
                        <h4 class="font-weight-bold text-white"
                            style="font-size: 1.8rem; letter-spacing: 1px; margin-bottom: 5px;">
                            <i class="fas fa-boxes"
                                style="font-size: 1.6rem; margin-right: 10px; vertical-align: middle;"></i>
                            Asignaciones de Productos - <span style="font-weight: 800; color: #f5f5f5;">{{ $committee->name }}</span>
                        </h4>
                        <p class="text-white" style="font-size: 1rem; opacity: 0.9; margin-bottom: 0;">
                            Registro de productos asignados a beneficiarios del comité
                        </p>
                    </div>
                    <div class="col-md-3 text-md-right">
                        <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid"
                            style="max-height: 60px; border-radius: 8px;">
                    </div>
                </div>
            </div>

            <!-- Información del Comité -->
            <div class="card-body" style="padding: 20px;">
                <div class="row">
                    <!-- Columna 1: Ubicación -->
                    <div class="col-md-3 mb-3">
                        <div class="info-card"
                            style="background-color: #f8f9fa; border-radius: 10px; padding: 15px; height: 100%; box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-map-marker-alt"
                                    style="font-size: 1.2rem; color: #8E6AB8; margin-right: 8px;"></i>
                                <label class="font-weight-semibold"
                                    style="color: #2c2c2c; font-size: 1rem; margin-bottom: 0;">Ubicación</label>
                            </div>
                            <p style="font-size: 1rem; color: #343a40; font-weight: 500; margin-bottom: 0;">
                                {{ $committee->location ?? 'No disponible' }}</p>
                        </div>
                    </div>

                    <!-- Columna 2: Presidente(a) -->
                    <div class="col-md-3 mb-3">
                        <div class="info-card"
                            style="background-color: #f8f9fa; border-radius: 10px; padding: 15px; height: 100%; box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-user-tie"
                                    style="font-size: 1.2rem; color: #8E6AB8; margin-right: 8px;"></i>
                                <label class="font-weight-semibold"
                                    style="color: #2c2c2c; font-size: 1rem; margin-bottom: 0;">Presidente(a)</label>
                            </div>
                            <p style="font-size: 1rem; color: #343a40; font-weight: 500; margin-bottom: 0;">
                                {{ $committee->president ?? 'No disponible' }}</p>
                        </div>
                    </div>
                    
                    <!-- Columna 3: Sector -->
                    <div class="col-md-3 mb-3">
                        <div class="info-card"
                            style="background-color: #f8f9fa; border-radius: 10px; padding: 15px; height: 100%; box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-bullseye"
                                    style="font-size: 1.2rem; color: #8E6AB8; margin-right: 8px;"></i>
                                <label class="font-weight-semibold"
                                    style="color: #2c2c2c; font-size: 1rem; margin-bottom: 0;">Sector</label>
                            </div>
                            <p style="font-size: 1rem; color: #343a40; font-weight: 500; margin-bottom: 0;">
                                {{ $committee->sector->name ?? 'No disponible' }}</p>
                        </div>
                    </div>

                    <!-- Columna 4: Exportar -->
                    <div class="col-md-3 mb-3">
                        <div class="info-card"
                            style="background-color: #f8f9fa; border-radius: 10px; padding: 15px; height: 100%; box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-download"
                                    style="font-size: 1.2rem; color: #8E6AB8; margin-right: 8px;"></i>
                                <label class="font-weight-semibold"
                                    style="color: #2c2c2c; font-size: 1rem; margin-bottom: 0;">Exportar</label>
                            </div>
                            <!-- Botón para exportar Excel -->
                            <div class="d-flex align-items-center justify-content-center mb-3">
                                <a href="{{ route('export.hoja-distribucion', $committee->id) }}" class="btn btn-success">Descargar Excel</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Nota informativa -->
                <div class="alert alert-info p-2 mb-0" style="font-size: 0.8rem; border-radius: 5px;">
                    <i class="fas fa-info-circle mr-1"></i> El documento exportado incluye solo familiares y menores activos en el comité.
                </div>
            </div>
        </section>

        <!-- Tabla de Asignaciones -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Beneficiario</th>
                                <th>Documento</th>
                                <th>Producto</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vlFamilyMemberProducts as $asignacion)
                                <tr>
                                    <td class="text-center">{{ $asignacion->id }}</td>
                                    <td>
                                        {{ $asignacion->vlFamilyMember->paternal_last_name }} 
                                        {{ $asignacion->vlFamilyMember->maternal_last_name }}, 
                                        {{ $asignacion->vlFamilyMember->given_name }}
                                    </td>
                                    <td>
                                        @if($asignacion->vlFamilyMember->identity_document == 'DNI')
                                            DNI: 
                                        @elseif($asignacion->vlFamilyMember->identity_document == 'Pasaporte')
                                            PAS: 
                                        @elseif($asignacion->vlFamilyMember->identity_document == 'Cédula')
                                            CED: 
                                        @endif
                                        {{ $asignacion->vlFamilyMember->id }}
                                    </td>
                                    <td>{{ $asignacion->product->name }}</td>
                                    <td class="text-center">{{ $asignacion->quantity }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('vl_family_member_products.show', [$asignacion->id, 'committee_id' => $committee->id]) }}" 
                                               class="btn btn-sm btn-info" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('vl_family_member_products.edit', [
                                                    'vl_family_member_product' => $asignacion->id,
                                                    'committee_id' => $committee->id
                                                    ]) }}" class="btn btn-sm btn-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('vl_family_member_products.destroy', [$asignacion->id, 'committee_id' => $committee->id]) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('¿Eliminar esta asignación?')" title="Eliminar">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

    <style>
        /* Estilos de tabla */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            font-size: 14px;
        }

        th {
            background-color: #3B1E54 !important;
            color: white;
            vertical-align: middle !important;
        }

        td {
            vertical-align: middle !important;
        }

        /* Mejora en la tabla */
        .table-hover tbody tr:hover {
            background-color: #f5e9ff !important;
        }

        /* Botones */
        .btn-sm {
            font-size: 12px;
            padding: 5px 8px;
        }

        /* Paginación */
        .pagination {
            justify-content: center;
        }

        .page-item.active .page-link {
            background-color: #6A4A8E;
            border-color: #6A4A8E;
        }

        .page-link {
            color: #6A4A8E;
        }
    </style>
@endsection