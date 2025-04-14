@extends('adminlte::page')

@section('title', 'Crear Sesión Psicológica')

@section('content_header')
    <h1>Registrar Sesión Psicológica</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('psychological-sessions.store') }}" method="POST">
                @csrf

                {{-- Diagnóstico --}}
                <div class="form-group">
                    <label for="diagnosis_id">Diagnóstico</label>
                    <select name="diagnosis_id" id="diagnosis_id" class="form-control" required>
                        <option value="">-- Seleccione un diagnóstico --</option>
                        @foreach ($diagnoses as $diagnosis)
                            <option value="{{ $diagnosis->id }}" data-recommended="{{ $diagnosis->recommended_sessions }}">
                                {{ $diagnosis->person->given_name }} {{ $diagnosis->person->paternal_last_name }}
                                {{ $diagnosis->person->maternal_last_name }}
                                @if ($diagnosis->diagnosis)
                                    || {{ Str::limit($diagnosis->diagnosis, 50) }} ||
                                @endif
                                {{ \Carbon\Carbon::parse($diagnosis->diagnosis_date)->format('d/m/Y') }}
                            </option>
                        @endforeach
                    </select>
                </div>


                {{-- Número de Sesión --}}
                <div class="form-group">
                    <label for="session_number">Número de Sesión</label>
                    <select name="session_number" id="session_number" class="form-control" required>
                        <option value="">-- Seleccione el número de sesión --</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="scheduled_date">Fecha Programada</label>
                    <input type="date" name="scheduled_date" id="scheduled_date" class="form-control"
                        value="{{ now()->toDateString() }}" required>
                </div>

                {{-- Estado de Asistencia --}}
                <div class="form-group">
                    <label for="attendance_status">Estado de Asistencia</label>
                    <select name="attendance_status" id="attendance_status" class="form-control" required>
                        <option value="">-- Seleccione el estado de asistencia --</option>
                        <option value="Asistió">Asistió</option>
                        <option value="No asistió">No asistió</option>
                        <option value="Justificó">Justificó</option>
                    </select>
                </div>

                {{-- Descripción --}}
                <div class="form-group">
                    <label for="description">Descripción de la sesión</label>
                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Detalles sobre la sesión (opcional)"></textarea>
                </div>


                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('psychological-sessions.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
    
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const diagnosisSelect = document.getElementById('diagnosis_id');
        const sessionSelect = document.getElementById('session_number');

        diagnosisSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const recommended = selectedOption.getAttribute('data-recommended');

            // Limpiar el select de sesiones
            sessionSelect.innerHTML = '<option value="">-- Seleccione el número de sesión --</option>';

            if (recommended) {
                const total = parseInt(recommended);
                for (let i = 1; i <= total; i++) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.textContent = i;
                    sessionSelect.appendChild(option);
                }
            }
        });
    });
</script>
@endsection
