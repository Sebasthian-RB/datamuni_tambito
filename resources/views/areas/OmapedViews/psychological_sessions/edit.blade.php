@extends('adminlte::page')

@section('title', 'Editar Sesión Psicológica')

@section('content_header')
    <h1>Editar Sesión Psicológica</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('psychological-sessions.update', $session) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Diagnóstico --}}
                <div class="form-group">
                    <label for="diagnosis_id">Diagnóstico</label>
                    <select name="diagnosis_id" id="diagnosis_id" class="form-control" required>
                        <option value="">-- Seleccione un diagnóstico --</option>
                        @foreach ($diagnoses as $diagnosis)
                            <option value="{{ $diagnosis->id }}"
                                @if ($diagnosis->id == $session->diagnosis_id) selected @endif
                                data-recommended="{{ $diagnosis->recommended_sessions }}">
                                {{ $diagnosis->person->full_name }} || {{ Str::limit($diagnosis->diagnosis, 50) }} ||
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
                        {{-- Aquí vamos a insertar las opciones dinámicamente en el script --}}
                    </select>
                </div>

                {{-- Fecha Programada --}}
                <div class="form-group">
                    <label for="scheduled_date">Fecha Programada</label>
                    <input type="date" name="scheduled_date" id="scheduled_date" class="form-control"
                        value="{{ old('scheduled_date', $session->scheduled_date) }}" required>
                </div>

                {{-- Asistencia --}}
                <div class="form-group">
                    <label for="attendance_status">Asistencia</label>
                    <select name="attendance_status" id="attendance_status" class="form-control">
                        <option value="Asistió" @if ($session->attendance_status == 'Asistió') selected @endif>Asistió</option>
                        <option value="No asistió" @if ($session->attendance_status == 'No asistió') selected @endif>No asistió</option>
                        <option value="Justificó" @if ($session->attendance_status == 'Justificó') selected @endif>Justificó</option>
                    </select>
                </div>

                {{-- Descripción --}}
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $session->description) }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Guardar Cambios</button>
                <a href="{{ route('psychological-sessions.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const diagnosisSelect = document.getElementById('diagnosis_id');
        const sessionSelect = document.getElementById('session_number');

        // Rellenar las opciones de sesión al cargar la página
        const selectedDiagnosis = diagnosisSelect.options[diagnosisSelect.selectedIndex];
        const recommended = selectedDiagnosis.getAttribute('data-recommended');

        // Limpiar el select de sesiones
        sessionSelect.innerHTML = '<option value="">-- Seleccione el número de sesión --</option>';

        if (recommended) {
            const total = parseInt(recommended);
            for (let i = 1; i <= total; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                if (i === {{ $session->session_number }}) {
                    option.selected = true;
                }
                sessionSelect.appendChild(option);
            }
        }

        // Actualizar sesiones cuando se cambie el diagnóstico
        diagnosisSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const recommended = selectedOption.getAttribute('data-recommended');

            // Limpiar y rellenar nuevamente el select de sesiones
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
