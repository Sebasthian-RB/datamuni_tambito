@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1 class="m-0 text-dark"><i class="fas fa-user-edit"></i> Editar Usuario</h1>
@stop

@section('content')
    <div class="card shadow-sm card-primary">
        <div class="card-header bg-gradient-primary">
            <h3 class="card-title">
                <i class="fas fa-user-cog"></i> Actualización de Usuario
            </h3>
        </div>
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold"><i class="fas fa-user-tag"></i> Nombre Completo</label>
                            <input type="text" name="name" class="form-control form-control-lg"
                                value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold"><i class="fas fa-envelope"></i> Correo Electrónico</label>
                            <input type="email" name="email" class="form-control form-control-lg"
                                value="{{ $user->email }}" required>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold"><i class="fas fa-lock"></i> Nueva Contraseña (opcional)</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control form-control-lg"
                                    placeholder="Dejar en blanco para mantener la actual">
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password" style="cursor: pointer">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
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
                                            {{ $user->roles->first()?->name === $role->name ? 'checked' : '' }}>
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

                <!-- SELECCIÓN DE PERMISOS -->
                <div class="form-group mt-4">
                    <label class="font-weight-bold mb-3"><i class="fas fa-shield-alt"></i> Permisos Adicionales</label>
                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-md-3 col-sm-6 mb-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                        class="custom-control-input" id="perm_{{ $permission->id }}"
                                        {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
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
                    <i class="fas fa-save"></i> Actualizar
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
        </style>
    @endpush

    @push('js')
        <script>
            $(document).ready(function() {
                // Toggle para mostrar/ocultar contraseña
                $('.toggle-password').click(function() {
                    const input = $('#password');
                    const icon = $(this).find('i');
                    input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
                    icon.toggleClass('fa-eye fa-eye-slash');
                });
            });
        </script>
    @endpush
@stop
