@extends('adminlte::page')

@section('title', 'Padrón de Beneficiarios')

@section('content_header')
    <h1>Padrón de Beneficiarios</h1>
@stop

@section('content')
<div class="container">
    <a href="{{ route('committee_vl_family_members.create') }}" class="btn mb-3" style="background-color: #9B7EBD; color: white;">Agregar Beneficiario</a>
    <a href="{{ route('vaso-de-leche.index') }}" class="btn btn-secondary mb-3">Volver</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Miembros Registrados</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>N°</th>
                        <th>APELLIDOS Y NOMBRES DE LA MADRE Y/O APODERADO</th>
                        <th>APELLIDOS Y NOMBRES DEL BENEFICIARIO</th>
                        <th>TIPO DE DOCUMENTO DE IDENTIDAD</th>
                        <th>PARENTESCO</th>
                        <th>SEXO</th>
                        <th>FECHA DE NACIMIENTO</th>
                        <th>EDAD</th>
                        <th>CONDICIÓN</th>
                        <th>FECHA DE EMPADRONAMIENTO</th>
                        <th>FECHA DE RETIRO</th>
                        <th>GRADO DE INSTRUCCIÓN</th>
                        <th>VIVIENDA</th>
                        <th>DOMICILIO</th>
                        <th>OBSERVACIONES</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($committeeVlFamilyMembers as $register)
                        <tr>
                            <td>{{ $register->id }}</td>
                            <td>
                                <div>
                                    {{ $register->vlFamilyMember->paternal_last_name }} {{ $register->vlFamilyMember->maternal_last_name }}
                                </div>
                                <div>
                                    {{ $register->vlFamilyMember->given_name }}
                                </div>
                            </td>                            
                            <td>{{ $register->committee->id }} - {{ $register->committee->name }}</td>
                            
                            <td>{{ $register->change_date }}</td>
                            <td>{{ $register->description }}</td>
                            <td>{{ $register->status ? 'Activo' : 'Inactivo' }}</td>
                            <td>
                                <a href="{{ route('committee_vl_family_members.show', $register->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('committee_vl_family_members.edit', $register->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('committee_vl_family_members.destroy', $register->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este miembro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop