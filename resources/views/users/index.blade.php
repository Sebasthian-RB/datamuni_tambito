@extends('adminlte::page')

@section('title', 'Gestión de Usuarios')

@section('content_header')
    <h1 class="m-0 text-dark"><i class="fas fa-users"></i> Gestión de Usuarios</h1>
@stop

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-gradient-primary">
            <h3 class="card-title">
                <i class="fas fa-user-cog"></i> Listado de Usuarios
            </h3>
            <div class="card-tools">
                <a href="{{ route('users.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-user-plus"></i> Nuevo Usuario
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="bg-secondary">
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Contraseña</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            {{-- <@if (!$user->hasRole('Super Administrador')) --}}
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-badge mr-3">
                                                <span class="user-initial">{{ substr($user->name, 0, 1) }}</span>
                                            </div>
                                            <div class="user-info">
                                                <div class="user-name">{{ $user->name }}</div>
                                                <div class="user-registered">Registrado:
                                                    {{ $user->created_at->format('d/m/Y') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="password-hidden">••••••••</span>
                                            <span class="password-visible d-none">{{ $user->password }}</span>
                                            <button class="btn btn-sm btn-secondary toggle-password ml-2"
                                                title="Mostrar/Ocultar contraseña">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Acciones
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('users.show', $user) }}">
                                                    <i class="fas fa-eye text-info"></i> Ver Detalles
                                                </a>
                                                <a class="dropdown-item" href="{{ route('users.edit', $user) }}">
                                                    <i class="fas fa-edit text-warning"></i> Editar
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger"
                                                        onclick="return confirm('¿Confirmar eliminación?')">
                                                        <i class="fas fa-trash-alt"></i> Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            {{-- @endif --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer clearfix">
            <div class="float-right">
                {{ $users->links() }}
            </div>
        </div>
    </div>

@section('css')
    <style>
        .password-hidden {
            font-family: monospace;
            background-color: #f1f1f1;
            padding: 2px 4px;
            border-radius: 4px;
        }

        .password-visible {
            font-family: monospace;
            background-color: #f1f1f1;
            padding: 2px 4px;
            border-radius: 4px;
        }

        .toggle-password {
            margin-left: 5px;
        }

        .symbol {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .user-badge {
            width: 50px;
            height: 50px;
            background-color: #f0f0f0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            color: #333;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .user-initial {
            text-transform: uppercase;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .user-registered {
            font-size: 13px;
            color: #6c757d;
        }
    </style>
@stop


@push('js')
    <script>
        // Alterna entre mostrar y ocultar la contraseña
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const hidden = this.parentElement.querySelector('.password-hidden');
                const visible = this.parentElement.querySelector('.password-visible');

                if (hidden.classList.contains('d-none')) {
                    hidden.classList.remove('d-none');
                    visible.classList.add('d-none');
                    this.innerHTML = '<i class="fas fa-eye"></i>';
                } else {
                    hidden.classList.add('d-none');
                    visible.classList.remove('d-none');
                    this.innerHTML = '<i class="fas fa-eye-slash"></i>';
                }
            });
        });
    </script>
@endpush

@stop
