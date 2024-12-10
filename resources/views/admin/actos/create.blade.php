@extends('layouts.admin')
@section('title', 'Crear Actos')
@section('style')
    <!-- Select2 -->
    {!! Html::style('adminlte/plugins/select2/css/select2.min.css') !!}
    {!! Html::style('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}
    <!-- Bootstrap Datepicker -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        rel="stylesheet">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Crear Nuevo Acto Administrativo</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.actos.index') }}">Lista de Actos
                                    Administrativos</a></li>
                            <li class="breadcrumb-item active">Crear Nuevo Acto Administrativo</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            {!! Form::open(['route' => 'admin.actos.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="clasificacion_id">CLASIFICACIÓN</label>
                        <select class="select2 @error('clasificacion_id') is-invalid @enderror" name="clasificacion_id"
                            id="clasificacion_id" style="width: 100%;">
                            <option value="" disabled selected>Seleccione una Clasificación:
                            </option>
                            @foreach ($clasificaciones as $clasificacion)
                                <option value="{{ $clasificacion->id }}"
                                    {{ old('clasificacion_id') == $clasificacion->id ? 'selected' : '' }}>
                                    {{ $clasificacion->nom_clasificacion }}</option>
                            @endforeach
                        </select>
                        @error('clasificacion_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Fecha:</label>
                        <div class="form-label-group">
                            <input placeholder="Escriba la fecha" type="text" class="form-control datepicker"
                                name="fechaInicial" id="fechaInicialInput" required>
                        </div>
                        <span id="fechaMostrada"></span>
                    </div>

                    <div class="form-group">
                        {!! Form::label('asunto', 'Asunto del Acto Administrativo') !!}
                        {!! Form::text('asunto', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Ingrese el asunto del acto administrativo',
                        ]) !!}
                        @error('asunto')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div id="archivoPdfField" class="form-group">
                        <label>ARCHIVO PDF:</label>
                        {{-- <i class="btn btn-primary fas fa-question"
                            onclick="showInfo('Adjuntar el documento en formato PDF y no puede exceder los 20 MB')"></i> --}}
                        <div class="input-group mb-3">
                            <input enctype="multipart/form-data" class="btn btn-primary form-control" type="file"
                                name="pdf" id="archivoPdfInput" accept="application/pdf"
                                onchange="validateFileTypeAndSize()">
                        </div>
                        <!-- Mensajes de error -->
                        <p id="fileTypeError" style="display:none; color:red;">El archivo debe ser un PDF.</p>
                        <p id="fileSizeError" style="display:none; color:red;">El archivo no debe exceder los 20 MB.</p>
                    </div>

                    {{-- <div class="form-group">
                        {!! Form::label('slug', 'Slug') !!}
                        {!! Form::text('slug', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Ingrese el slug del acto administrativo',
                        ]) !!}
                        @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}
                </div>
            </div>
            <!-- /.card -->
            <div class="row">
                <div class="col-12 mb-2">
                    <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancelar</a>
                    <input type="submit" value="Registrar" class="btn btn-primary float-right">
                </div>
            </div>
            {!! Form::close() !!}
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('script')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- Select2 -->
    {!! Html::script('adminlte/plugins/select2/js/select2.full.min.js') !!}

    <script>
        $(document).ready(function() {
            // Initialize Select2 Elements
            $('.select2').select2();

            // Initialize Bootstrap Datepicker
            $('.datepicker').datepicker({
                format: "dd/mm/yyyy", // Formato de fecha
                autoclose: true,
                todayHighlight: true,
                language: "es"
            });
        });

        function validateFileTypeAndSize() {
            const fileInput = document.getElementById('archivoPdfInput');
            const file = fileInput.files[0];
            const fileTypeError = document.getElementById('fileTypeError');
            const fileSizeError = document.getElementById('fileSizeError');

            // Ocultar mensajes de error al principio
            fileTypeError.style.display = 'none';
            fileSizeError.style.display = 'none';

            if (file) {
                const fileType = file.type;
                const fileSize = file.size;

                // Verificar si el archivo es un PDF
                if (fileType !== 'application/pdf') {
                    fileTypeError.style.display = 'block';
                    fileInput.value = ''; // Resetea el input para eliminar el archivo inválido
                    return;
                }

                // Verificar si el tamaño del archivo es mayor a 20 MB
                if (fileSize > 20 * 1024 * 1024) { // 20 MB en bytes
                    fileSizeError.style.display = 'block';
                    fileInput.value = ''; // Resetea el input para eliminar el archivo inválido
                    return;
                }
            }
        }

        function showInfo(message) {
            alert(message);
        }
    </script>
@endsection
