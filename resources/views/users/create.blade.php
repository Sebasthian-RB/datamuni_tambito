@extends('adminlte::page')

@section('title', 'Crear Usuario')

@section('content_header')
    <h1 class="m-0 text-dark"><i class="fas fa-user-plus"></i> Crear Usuario</h1>
@stop

@section('content')
    <div class="card shadow-sm card-primary">
        <div class="card-header bg-gradient-primary">
            <h3 class="card-title">
                <i class="fas fa-user-cog"></i> Registro de Nuevo Usuario
            </h3>
        </div>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold"><i class="fas fa-user-tag"></i> Nombre Completo</label>
                            <input type="text" name="name" class="form-control form-control-lg"
                                value="{{ old('name') }}" required placeholder="Ej: Juan Pérez" autofocus>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold"><i class="fas fa-envelope"></i> Correo Electrónico</label>
                            <input type="email" name="email" class="form-control form-control-lg"
                                value="{{ old('email') }}" required placeholder="ejemplo@dominio.com">
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold"><i class="fas fa-lock"></i> Contraseña</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control form-control-lg"
                                    required pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$"
                                    title="Debe cumplir con los requisitos de seguridad" placeholder="********">
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password" style="cursor: pointer">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="mt-3" id="password-requirements">
                                <small class="text-muted">Requisitos de seguridad:</small>
                                <ul class="list-unstyled mt-2">
                                    <li class="text-danger" id="length">
                                        <i class="fas fa-times-circle"></i> Mínimo 8 caracteres
                                    </li>
                                    <li class="text-danger" id="uppercase">
                                        <i class="fas fa-times-circle"></i> Al menos una mayúscula
                                    </li>
                                    <li class="text-danger" id="number">
                                        <i class="fas fa-times-circle"></i> Al menos un número
                                    </li>
                                    <li class="text-danger" id="special">
                                        <i class="fas fa-times-circle"></i> Carácter especial (@$!%*?&)
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- SELECCIÓN DE ROL -->
                        <div class="form-group">
                            <label class="font-weight-bold mb-3"><i class="fas fa-user-tag"></i> Rol del Usuario</label>
                            <div class="role-container bg-light p-3 rounded">
                                @foreach ($roles as $role)
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" name="role" id="role_{{ $role->id }}"
                                            value="{{ $role->name }}" class="custom-control-input"
                                            {{ old('role') == $role->name ? 'checked' : '' }}>
                                        <label class="custom-control-label d-block p-2 rounded bg-white shadow-sm"
                                            for="role_{{ $role->id }}">
                                            <i class="fas fa-user-shield mr-2"></i>
                                            {{ ucfirst($role->name) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PERMISOS -->
                <div class="form-group mt-4">
                    <label class="font-weight-bold mb-3"><i class="fas fa-shield-alt"></i> Permisos Adicionales</label>
                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-md-3 col-sm-6 mb-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                        class="custom-control-input" id="perm_{{ $permission->id }}"
                                        {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}>
                                    <label class="custom-control-label d-block p-2 rounded bg-light shadow-sm"
                                        for="perm_{{ $permission->id }}">
                                        <i class="fas fa-key mr-2 text-muted"></i>
                                        {{ ucfirst($permission->name) }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card-footer bg-white">
                <button type="submit" class="btn btn-lg btn-primary">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <a href="{{ route('users.index') }}" class="btn btn-lg btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>

    @push('css')
        <style>
            .toggle-password:hover {
                background-color: #e9ecef;
                transition: background-color 0.3s ease;
            }

            .form-control-lg {
                border-radius: 0.5rem;
                padding: 1rem 1.5rem;
            }

            .role-container div:hover {
                transform: translateY(-2px);
                transition: transform 0.2s ease;
            }

            .custom-control-input:checked~.custom-control-label {
                background: #007bff !important;
                color: white !important;
                border-color: #007bff !important;
            }

            .custom-control-label {
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .card-primary {
                border-top: 3px solid #007bff;
            }

            #password-requirements li {
                margin: 0.5rem 0;
                font-size: 0.9rem;
            }

            .text-success i,
            .text-danger i {
                margin-right: 5px;
            }
        </style>
    @endpush

    @push('js')
        <script>
            $(document).ready(function() {
                const passwordInput = $('#password');

                // Validación de contraseña en tiempo real
                passwordInput.on('keyup', function() {
                    const password = $(this).val();

                    validateRequirement('#length', password.length >= 8);
                    validateRequirement('#uppercase', /[A-Z]/.test(password));
                    validateRequirement('#number', /\d/.test(password));
                    validateRequirement('#special', /[@$!%*?&]/.test(password));
                });

                // Toggle para mostrar/ocultar contraseña
                $('.toggle-password').click(function() {
                    const icon = $(this).find('i');
                    passwordInput.attr('type', passwordInput.attr('type') === 'password' ? 'text' : 'password');
                    icon.toggleClass('fa-eye fa-eye-slash');
                });

                function validateRequirement(element, isValid) {
                    $(element).toggleClass('text-success', isValid)
                        .toggleClass('text-danger', !isValid)
                        .find('i')
                        .toggleClass('fa-check-circle', isValid)
                        .toggleClass('fa-times-circle', !isValid);
                }
            });
        </script>
    @endpush
@stop
