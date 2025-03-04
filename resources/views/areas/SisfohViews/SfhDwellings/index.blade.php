@extends('adminlte::page')

@section('title', 'Listado de Viviendas')

@section('content_header')
<div class="py-3 d-flex align-items-center" style="background: green; border-radius: 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="img-fluid" style="max-height: 80px;">
            </div>
            <div class="col-md-9 d-flex align-items-center justify-content-end">
                <h1 class="perpetua-titling text-dorado" style="background: green; padding: 10px; border-radius: 0;">
                    Registro de Viviendas
                </h1>
            </div>
        </div>
    </div>
</div>
<br>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background-color: #228B22; color:white;">
                    <h3 class="card-title">Lista de Viviendas</h3>
                    <div class="card-tools">
                        <a href="{{ route('sfh_dwelling.create') }}" class="btn btn-primary btn-sm btn-with-border btn-primary-custom">
                            <i class="fas fa-plus"></i> Crear Nueva Vivienda
                        </a>
                        <a href="{{ route('sfhdashboard') }}" class="btn btn-secondary btn-sm btn-with-border btn-secondary-custom" style="margin-left: 10px;">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
                <div class="card-body card-body-con-fondo">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    @endif
                    <table id="dwellings-table" class="table table-bordered table-hover" style="width:100%">
                        <thead class="bg-celeste">
                            <tr>
                                <th>ID</th>
                                <th>Dirección</th>
                                <th>Referencia</th>
                                <th>Vecindario</th>
                                <th>Distrito</th>
                                <th>Provincia</th>
                                <th>Región</th>
                                <th class="no-export">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sfhDwellings as $dwelling)
                                <tr>
                                    <td>{{ $dwelling->id }}</td>
                                    <td>{{ $dwelling->street_address }}</td>
                                    <td>{{ $dwelling->reference }}</td>
                                    <td>{{ $dwelling->neighborhood }}</td>
                                    <td>{{ $dwelling->district }}</td>
                                    <td>{{ $dwelling->provincia }}</td>
                                    <td>{{ $dwelling->region }}</td>
                                    <td>
                                        <a href="{{ route('sfh_dwelling.show', $dwelling) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="{{ route('sfh_dwelling.edit', $dwelling) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <form action="{{ route('sfh_dwelling.destroy', $dwelling) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta vivienda?')">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <!-- Estilos para DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

    <style>
        /* Estilos personalizados */
        .bg-celeste {
            background-color: #D3D3D3 !important;
        }
        .wittenberger-fraktur {
            font-family: 'Wittenberger Fraktur';
        }
        .text-dorado {
            color: gold;
        }
        .perpetua-titling {
            font-family: 'Perpetua Titling' !important; /* Nombre de la fuente que definiste con @font-face */
        }
        /* Estilos adicionales para que la fuente se vea correctamente */
        @font-face {
            font-family: 'Perpetua Titling';
                src: url('/fonts/PerpetuaTitling-Regular.woff2') format('woff2'),
                    url('/fonts/PerpetuaTitling-Regular.woff') format('woff'),
                    url('/fonts/PerpetuaTitling-Regular.ttf') format('truetype'); /* Ajusta las rutas y formatos */
            font-weight: normal;
            font-style: normal;
        }
        .btn-with-border {
            border: 1px solid; /* Borde genérico */
        }
        /* Estilos personalizados para botones primarios */
        .btn-primary-custom {
            border-color: #007bff; /* Color del borde (azul primario) */
        }
        .btn-primary-custom:hover {
            background-color: #0069d9; /* Color de fondo hover (azul primario más oscuro) */
            border-color: #005cbf; /* Color del borde hover (azul primario más oscuro) */
            color: white;
        }
        /* Estilos personalizados para botones secundarios */
        .btn-secondary-custom {
            border-color: #6c757d; /* Color del borde (gris secundario) */
        }
        .btn-secondary-custom:hover {
            background-color: #5a6268; /* Color de fondo hover (gris secundario más oscuro) */
            border-color: #494f54; /* Color del borde hover (gris secundario más oscuro) */
            color: white;
        }
        /* Estilo opcional para el estado "activo" (click) */
        .btn-with-border:active {
            background-color: #ddd; /* Gris más oscuro al hacer clic */
        }
        /* Estilo opcional para deshabilitar el botón (si es necesario) */
        .btn-with-border:disabled {
            background-color: #eee; /* Gris muy claro cuando está deshabilitado */
            color: #aaa; /* Texto gris claro cuando está deshabilitado */
            border-color: #ccc; /* Borde gris claro cuando está deshabilitado */
            cursor: not-allowed; /* Cursor de "prohibido" cuando está deshabilitado */
        }
        .card-body-con-fondo {
            background-color: whitesmoke; /* Color de fondo gris claro */
        }
    </style>
@stop

@section('js')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<!-- Dependencias de exportación -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>  <!-- Para Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>  <!-- Para PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>  <!-- Fuentes para PDF -->
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>  <!-- Botones HTML5 -->
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>  <!-- Botón de impresión -->

<script>
    $(document).ready(function () {
        $('#dwellings-table').DataTable({
            "language": {
                url: "//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json", // Archivo de idioma español
            },
            dom: 'Bfrtip', // B = Botones, f = Filtro, r = Información, t = Tabla, i = Info, p = Paginación
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: 'Copiar',
                    className: 'btn btn-secondary',
                    exportOptions: {
                        columns: ':not(.no-export)'
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Exportar a Excel',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: ':not(.no-export)'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'Exportar a PDF',
                    className: 'btn btn-danger',
                    orientation: 'portrait',  // PDF en orientación vertical
                    pageSize: 'A4',  // Tamaño de la página
                    exportOptions: {
                        columns: ':not(.no-export)',
                    },
                    customize: function(doc) {
                        // Centrando todas las celdas
                        doc.content[1].table.body.forEach(function(row) {
                            row.forEach(function(cell) {
                                cell.alignment = 'center';  // Centra el contenido de cada celda
                            });
                        });
                        // Agregar bordes a la tabla
                        doc.content[1].layout = {
                            hLineWidth: function(i, node) { return 0.5; },  // Grosor de línea horizontal
                            vLineWidth: function(i, node) { return 0.5; },  // Grosor de línea vertical
                            hLineColor: function(i, node) { return '#000000'; },  // Color negro para líneas horizontales
                            vLineColor: function(i, node) { return '#000000'; }   // Color negro para líneas verticales
                        };
                        // Estilos de encabezado
                        doc.styles.tableHeader = {
                            alignment: 'center',
                            bold: true,
                            fontSize: 12,
                            fillColor: [52, 152, 219], // Color azul en encabezados
                            color: 'white' // Texto en blanco
                        };
                    }
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    className: 'btn btn-primary',
                    exportOptions: {
                        columns: ':not(.no-export)'
                    }
                }
            ],
            pageLength: 4,
            lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"] ]
        });
    });
</script>
@stop