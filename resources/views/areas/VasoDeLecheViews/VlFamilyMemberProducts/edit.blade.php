@extends('adminlte::page')

@section('title', 'Editar Asignación de Producto')

@section('content_header')
@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Estilos personalizados -->
    <style>
        /* Colores de la paleta */
        :root {
            --color-primary: #3B1E54;
            --color-secondary: #9B7EBD;
            --color-accent: #D4BEE4;
            --color-background: #EEEEEE;
        }
    
        /* Estilos generales */
        .card {
            border: 1px solid var(--color-accent);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .container {
            padding-top: 20px;
        }
    
        /* Header */
        .card-header {
            background: linear-gradient(135deg, var(--color-primary), #5A2E7A);
            color: #FFFFFF;
            padding: 25px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    
        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
    
        .card-title {
            font-size: 1.75rem;
            margin: 0;
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }
    
        .card-subtitle {
            font-size: 1rem;
            color: var(--color-accent);
            margin-top: 5px;
            font-weight: 400;
        }
    
        .header-logo {
            height: 50px;
            width: auto;
            transition: opacity 0.3s ease;
        }
    
        .header-logo:hover {
            opacity: 0.8;
        }
    
        /* Estilos para las etiquetas */
        label {
            color: var(--color-primary);
            font-weight: bold;
        }
    
        /* Estilos para los campos de formulario */
        .form-control {
            border: 1px solid var(--color-accent);
            border-radius: 6px;
            padding: 10px;
            font-size: 14px;
            color: var(--color-primary);
        }
    
        .form-control::placeholder {
            color: #999;
            font-style: italic;
        }
    
        .form-control:focus {
            border-color: var(--color-secondary);
            box-shadow: 0 0 5px rgba(155, 126, 189, 0.5);
        }
    
        /* Estilos para los select */
        .form-control option {
            color: var(--color-primary);
        }
    
        .form-control option.placeholder-option {
            color: #999;
            font-style: italic;
        }
    
        /* Estilos para los íconos */
        .fas {
            color: var(--color-secondary);
        }
    
        /* Estilos para los mensajes de error */
        .invalid-feedback {
            color: #dc3545;
            font-size: 12px;
        }
    
        /* Estilos personalizados para el botón "Guardar" */
        .btn-custom {
            background-color: #9B7EBD;
            border-color: #9B7EBD;
            color: white;
        }

        .btn-custom:hover,
        .btn-danger:hover {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Línea divisoria vertical */
        .vertical-divider {
            width: 1px;
            height: 100%;
            background-color: var(--color-accent);
        }
    
        /* Estilos personalizados para Select2 */
        .select2-container--default .select2-selection--single {
            height: 45px !important;
            line-height: 45px !important;
            font-size: 16px !important;
            background-color: #ffffff !important;
            border: 2px solid #9B7EBD !important;
            border-radius: 12px !important;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1) !important;
        }

        .select2-container--default .select2-selection__rendered {
            padding-top: 5px !important;
            padding-bottom: 5px !important;
            color: #3B1E54 !important;
        }

        .select2-dropdown {
            max-height: 300px !important;
            overflow-y: auto !important;
            background-color: #D4BEE4 !important;
            border: 2px solid #9B7EBD !important;
            border-radius: 12px !important;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1) !important;
        }

        .select2-results__option {
            padding: 10px !important;
            font-size: 16px !important;
            color: #3B1E54 !important;
        }

        .select2-results__option--highlighted {
            background-color: #9B7EBD !important;
            color: white !important;
        }

        .select2-container--default .select2-selection__arrow {
            height: 43px !important;
        }

        /* Estilos responsivos */
        @media (max-width: 768px) {
            .col-md-6, .col-md-4, .col-md-8, .col-md-5, .col-md-1 {
                width: 100%;
            }
    
            .vertical-divider {
                display: none;
            }
    
            .header-content {
                flex-direction: column;
                text-align: center;
            }
    
            .header-logo {
                margin-top: 10px;
            }

            .card-title {
                font-size: 1.5rem;
            }

            .card-subtitle {
                font-size: 0.9rem;
            }
    
            .card-footer {
                text-align: center;
            }
    
            .btn {
                width: 100%;
                margin-bottom: 10px;
            }

            .btn-custom, .btn-danger {
                width: 100%;
                margin-bottom: 10px;
            }

            .btn-danger {
                margin-left: 0 !important;
            }
        }

        /* Estilos para select 2 */
        .select2-container .select2-selection--single {
            height: 36px;
            padding: 10px;
            font-size: 16px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 20px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 20px;
        }
    </style>
@stop

@section('content')
<div class="container">
    <form action="{{ route('vl_family_member_products.update', $familyMemberProduct->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card">
            <!-- Card Header -->
            <div class="card-header">
                <div class="header-content">
                    <div>
                        <h1 class="card-title">Editar Asignación de Producto</h1>
                        <p class="card-subtitle">Modifique los campos necesarios.</p>
                    </div>
                    <img src="{{ asset('Images/Logomunicipalidad_tambo.png') }}" alt="Escudo El Tambo" class="header-logo">
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <!-- Sección Principal -->
                    <div class="col-md-12">
                        <div class="row">
                            <!-- Columna izquierda -->
                            <div class="col-md-6">
                                <!-- Campo: Miembro de Familia (solo lectura) -->
                                <div class="form-group mb-4">
                                    <label class="font-weight-bold">
                                        <i class="fas fa-users mr-2"></i>Miembro de Familia
                                    </label>
                                    <input type="text" class="form-control" 
                                        value="{{ $familyMemberProduct->vlFamilyMember->id }} - {{ $familyMemberProduct->vlFamilyMember->given_name }} {{ $familyMemberProduct->vlFamilyMember->paternal_last_name }}" 
                                        readonly>
                                    <input type="hidden" name="vl_family_member_id" value="{{ $familyMemberProduct->vl_family_member_id }}">
                                </div>

                                <!-- Campo: Producto -->
                                <div class="form-group mb-4">
                                    <label for="product_id" class="font-weight-bold">
                                        <i class="fas fa-shopping-basket mr-2"></i>Producto
                                    </label>
                                    <span class="text-danger">*</span>
                                    <select name="product_id" id="product_id" class="form-control select2 @error('product_id') is-invalid @enderror" required>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" 
                                                {{ $familyMemberProduct->product_id == $product->id ? 'selected' : '' }}>
                                                {{ $product->name }}
                                            </option>
                                        @endforeach
                                    </select>                        
                                    @error('product_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Línea divisoria -->
                            <div class="col-md-1 d-flex justify-content-center align-items-center">
                                <div class="vertical-divider"></div>
                            </div>

                            <!-- Columna derecha -->
                            <div class="col-md-5">
                                <!-- Campo: Cantidad -->
                                <div class="form-group mb-4">
                                    <label for="quantity" class="font-weight-bold">
                                        <i class="fas fa-cubes mr-2"></i>Cantidad
                                    </label>
                                    <span class="text-danger">*</span>
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                                        id="quantity" name="quantity" 
                                        value="{{ old('quantity', $familyMemberProduct->quantity) }}" 
                                        placeholder="Ej: 2" min="1" required>
                                    @error('quantity')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo oculto para committee_id -->
                                <input type="hidden" name="committee_id" value="{{ $committee_id }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Card Footer -->
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-custom">Actualizar Asignación</button>
                <a href="{{ route('vl_family_member_products.index', ['committee_id' => $committee_id]) }}" class="btn btn-danger ml-2">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@stop

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicialización de Select2 para miembros de familia con estilo similar al primer formulario
            $('#vl_family_member_id').select2({
                placeholder: "Buscar por ID o nombre",
                allowClear: true,
                minimumInputLength: 0,
                matcher: function(params, data) {
                    if ($.trim(params.term) === '') {
                        return data;
                    }

                    if (!data.id || !data.element) {
                        return null;
                    }

                    // Convertir los valores a cadenas y a minúsculas para evitar errores
                    const term = params.term.toLowerCase();
                    const id = String(data.id).toLowerCase();
                    const givenName = (data.element.getAttribute('data-given-name') || '').toLowerCase();
                    const paternalLastName = (data.element.getAttribute('data-paternal') || '').toLowerCase();

                    // Comparar con el término de búsqueda
                    if (id.includes(term) || 
                        givenName.includes(term) || 
                        paternalLastName.includes(term)) {
                        return data;
                    }

                    return null;
                },
                templateResult: formatMember,
                templateSelection: formatMemberSelection
            });

            // Inicialización de Select2 para productos con estilo similar
            $('#product_id').select2({
                placeholder: "Buscar producto por nombre",
                allowClear: true,
                minimumInputLength: 0,
                templateResult: formatProduct,
                templateSelection: formatProductSelection
            });

            // Función para formatear cómo se muestran los resultados de búsqueda (miembros)
            function formatMember(member) {
                if (!member.id) return member.text;
                
                const givenName = member.element.getAttribute('data-given-name') || '';
                const paternalLastName = member.element.getAttribute('data-paternal') || '';
                const maternalLastName = member.element.getAttribute('data-maternal') || '';

                return $(
                    `<div>
                        <strong>ID: ${member.id}</strong><br>
                        <small>Nombre: ${givenName} ${paternalLastName} ${maternalLastName}</small>
                    </div>`
                );
            }

            // Función para formatear cómo se muestra la selección (miembros)
            function formatMemberSelection(member) {
                if (!member.id) return member.text;

                const givenName = member.element.getAttribute('data-given-name') || '';
                const paternalLastName = member.element.getAttribute('data-paternal') || '';
                const maternalLastName = member.element.getAttribute('data-maternal') || '';

                return `${member.id} - ${givenName} ${paternalLastName} ${maternalLastName}`;
            }

            // Función para formatear cómo se muestran los resultados de búsqueda (productos)
            function formatProduct(product) {
                if (!product.id) return product.text;
                
                return $(
                    `<div>
                        <strong>${product.text}</strong>
                    </div>`
                );
            }

            // Función para formatear cómo se muestra la selección (productos)
            function formatProductSelection(product) {
                if (!product.id) return product.text;
                return product.text;
            }

            // Manejar el evento clear
            $('#vl_family_member_id').on('select2:clear', function() {
                $(this).select2('close');
            });

            let preventOpening = false;
            $('#vl_family_member_id').on('select2:unselecting', function() {
                preventOpening = true;
            });

            $('#vl_family_member_id').on('select2:opening', function(e) {
                if (preventOpening) {
                    e.preventDefault();
                    preventOpening = false;
                }
            });
        });
    </script>
@endpush