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
                <div class="form-group">
                    <label for="name" class="font-weight-bold">
                        <i class="fas fa-user-tag"></i> Nombre Completo
                    </label>
                    <input type="text" name="name" class="form-control form-control-lg" required
                        placeholder="Ej: Juan Pérez" autofocus>
                </div>

                <div class="form-group">
                    <label for="email" class="font-weight-bold">
                        <i class="fas fa-envelope"></i> Correo Electrónico
                    </label>
                    <input type="email" name="email" class="form-control form-control-lg" required
                        placeholder="ejemplo@dominio.com">
                </div>

                <div class="form-group">
                    <label for="password" class="font-weight-bold">
                        <i class="fas fa-lock"></i> Contraseña
                    </label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control form-control-lg" required
                            pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$"
                            title="Debe cumplir con los requisitos de seguridad">
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
                <div class="form-group">
                    <label>Seleccionar Rol</label>
                    <select name="role" class="form-control select2" required>
                        <option value="">-- Selecciona un Rol --</option>
                        @foreach ($roles as $id => $name)
                            <option value="{{ $name }}">{{ $name }}</option>
                        @endforeach
                    </select>
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

            #password-requirements li {
                margin: 0.5rem 0;
                font-size: 0.9rem;
            }

            .card-primary {
                border-top: 3px solid #007bff;
            }
        </style>
    @endpush

    @push('js')
        <script>
            $(document).ready(function() {
                // Validación de contraseña en tiempo real
                $('#password').on('keyup', function() {
                    const password = $(this).val();

                    toggleValidation('#length', password.length >= 8);
                    toggleValidation('#uppercase', /[A-Z]/.test(password));
                    toggleValidation('#number', /\d/.test(password));
                    toggleValidation('#special', /[@$!%*?&]/.test(password));
                });

                // Toggle para mostrar/ocultar contraseña
                $('.toggle-password').click(function() {
                    const input = $('#password');
                    const icon = $(this).find('i');

                    if (input.attr('type') === 'password') {
                        input.attr('type', 'text');
                        icon.removeClass('fa-eye').addClass('fa-eye-slash');
                    } else {
                        input.attr('type', 'password');
                        icon.removeClass('fa-eye-slash').addClass('fa-eye');
                    }
                });

                function toggleValidation(element, isValid) {
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
