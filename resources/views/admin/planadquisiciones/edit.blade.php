@extends('layouts.admin')
@section('title', 'Editar Inventario Documental')
@section('style')
    <!-- Select2 -->
    {!! Html::style('adminlte/plugins/select2/css/select2.min.css') !!}
    {!! Html::style('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Editar Inventario Documental</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('planadquisiciones.index') }}">Inventario</a></li>
                            <li class="breadcrumb-item active">Editar Inventario Documental</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            {!! Form::model($inventario, [
                'route' => ['planadquisiciones.update', $inventario],
                'method' => 'PUT',
                'enctype' => 'multipart/form-data',
            ]) !!}
            @csrf
            <div class="card card-primary">
                {{-- <div class="card-header">
              <h3 class="card-title">General</h3>
            </div> --}}
                <div class="card-body">
                    <div class="form-row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="area_id">OFICINA PRODUCTORA:</label>
                                <select class="select2 @error('area_id') is-invalid @enderror" name="area_id" id="area_id"
                                    style="width: 100%;">
                                    <option disabled>Seleccione una Unidad Administrativa</option>
                                    <option value="{{ $userArea->id }}" selected>{{ $userArea->nomarea }}</option>
                                </select>
                                @error('area_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="modalidad_id">OBJETO:</label>
                                <select class="select2 @error('modalidad_id') is-invalid @enderror" name="modalidad_id"
                                    id="modalidad_id" style="width: 100%;">

                                    @foreach ($modalidades as $modalidad)
                                        <option value="{{ $modalidad->id }}"
                                            {{ old('modalidad_id', $inventario->modalidad_id) == $modalidad->id ? 'selected' : '' }}>
                                            {{ $modalidad->detmodalidad }}</option>
                                    @endforeach
                                </select>
                                @error('modalidad_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- {{-- <div class="col-md-4">
                        <div class="form-group">
                            <label for="objeto">Objeto:</label>
                            <input type="text" placeholder="Escriba el Objeto Documental" name="objeto" id="objeto"
                                value="{{ old('descripcioncont', $planadquisicione->descripcioncont) }}"
                                class="form-control" required>
                            </div>
                        </div> --}} -->

                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="requiproyecto_id">Codigo De Dependencia:</label>
                                <select class="select2 @error('requiproyecto_id') is-invalid @enderror"
                                    name="requiproyecto_id" id="requiproyecto_id" style="width: 100%;">
                                    @foreach ($requiproyectos as $requiproyecto)
                                        <option value="{{ $requiproyecto->id }}"
                                            {{ old('requiproyecto_id', $inventario->requiproyecto_id) == $requiproyecto->id ? 'selected' : '' }}>
                                            {{ $requiproyecto->detproyecto }}</option>
                                    @endforeach
                                </select>
                                @error('requiproyecto_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="requiproyecto_id">CODIGO DE DEPENDENCIA:</label>
                                <select class="select2 @error('requiproyecto_id') is-invalid @enderror"
                                    name="requiproyecto_id" id="requiproyecto_id" style="width: 100%;">
                                    <option value="" selected>Seleccione Codigo de Dependencia</option>
                                    @foreach ($requiproyectos as $requiproyectoId => $requiproyecto)
                                        <option value="{{ $requiproyectoId }}"
                                            {{ old('requiproyecto_id', $requiproyecto) }} selected>{{ $requiproyecto }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('requiproyecto_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="segmento_id">TIPO DE SERIE DOCUMENTAL:</label>
                                <select class="select2 @error('segmento_id') is-invalid @enderror" name="segmento_id"
                                    id="segmento_id" style="width: 100%;">
                                    @foreach ($segmentos as $segmento)
                                        <option value="{{ $segmento->id }}"
                                            {{ old('segmento_id', $inventario->segmento_id) == $segmento->id ? 'selected' : '' }}>
                                            {{ $segmento->id }} - {{ $segmento->detsegmento }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- {{-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="familias_id">Tipo de Subserie Documental:</label>
                            <select class="select2 @error('familias_id') is-invalid @enderror" name="familias_id"
                                id="familias_id" style="width: 100%;">
                                <option value="" disabled selected>Seleccione un Tipo de Subserie Documental:
                                </option>
                            </select>
                        </div>
                    </div> --}} -->

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="familias_id">TIPO DE SUBSERIE DOCUMENTAL:</label>
                                <select class="select2 @error('familias_id') is-invalid @enderror" name="familias_id"
                                    id="familias_id" style="width: 100%;">
                                    @foreach ($familias as $familia)
                                        <option value="{{ $familia->id }}"
                                            {{ old('familias_id', $inventario->familias_id) == $familia->id ? 'selected' : '' }}>
                                            {{ $familia->detfamilia }}</option>
                                    @endforeach
                                </select>
                                @error('familias_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>NOMBRE DE LA UNIDAD DOCUMENTAL</label>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba el nombre de la unidad documental" type="text"
                                    class="form-control" name="nombre_unidad" id="nombre_unidad"
                                    value="{{ old('nombre_unidad', $inventario->nombre_unidad) }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>FECHAS EXTREMAS | Fecha Inicial:</label>
                            <div class="form-group">
                                <input placeholder="Escriba la fecha inical" type="text" class="form-control"
                                    name="fechaInicial" id="fechaInicialInput"
                                    value="{{ old('fechaInicial', $inventario->fechaInicial) }}" required>
                            </div>
                            <span id="fechaMostrada"></span>
                        </div>

                        <div class="col-md-4">
                            <label for="fechaFinal">FECHAS EXTREMAS | Fecha Final:</label>
                            <div class="form-group">
                                <input placeholder="Escriba la fecha final" type="text" name="fechaFinal"
                                    id="fechaFinalInput" class="form-control"
                                    value="{{ old('fechaFinal', $inventario->fechaFinal) }}" required>
                            </div>
                            <span id="fechaFinalMostrada"></span>
                        </div>

                        <div class="col-md-4">
                            <label>SOPORTE O FORMATO</label>
                            <div class="input-group mb-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="soporte_formato[]"
                                        id="fisico" value="fisico"
                                        {{ in_array('fisico', array_map('trim', explode(',', $inventario->soporte_formato ?? ''))) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="fisico">Físico (Papel)</label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="soporte_formato[]"
                                        id="electronico" value="electronico"
                                        {{ in_array('electronico', array_map('trim', explode(',', $inventario->soporte_formato ?? ''))) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="electronico">Electrónico</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>UNIDAD DE CONSERVACIÓN | CAJA:</label>
                            <div class="form-group mb-3">
                                <input placeholder="Escriba la unidad de las cajas" type="number" class="form-control"
                                    name="caja" id="caja" value="{{ old('caja', $inventario->caja) }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>UNIDAD DE CONSERVACIÓN | CARPETA:</label>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba la unidad de las carpetas" type="number"
                                    class="form-control" name="carpeta" id="carpeta"
                                    value="{{ old('carpeta', $inventario->carpeta) }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>UNIDAD DE CONSERVACIÓN | TOMO / LEGAJO / LIBRO:</label>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba la unidad de tomos" type="number" class="form-control"
                                    name="tomo" id="tomo" value="{{ old('tomo', $inventario->tomo) }}" required>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="requipoais_id">OPCIÓN OTRO:</label>
                                <select class="select2 @error('requipoais_id') is-invalid @enderror" name="requipoais_id"
                                    id="requipoais_id" style="width: 100%;">
                                    <option disabled selected>Seleccione una opción</option>
                                    @foreach ($requipoais as $requipoai)
                                        <option value="{{ $requipoai->id }}"
                                            {{ old('requipoais_id', $inventario->requipoais_id) == $requipoai->id ? 'selected' : '' }}>
                                            {{ $requipoai->detpoai }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('requipoais_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Tipo Otro -->
                        <div id="tipo_otro" class="col-md-4" style="display: none;">
                            <div class="form-group">
                                <label for="tipo_otro">TIPO:</label>
                                <select class="select2 @error('tipo_otro') is-invalid @enderror" name="tipo_otro"
                                    id="tipo_otro" style="width: 100%;">
                                    <option value="" selected>Selecciona el Tipo</option>
                                    @foreach ($tipoOtros as $tipoOtro)
                                        <option value="{{ $tipoOtro->id }}"
                                            {{ old('tipo_otro', $inventario->tipo_otro_id) == $tipoOtro->id ? 'selected' : '' }}>
                                            {{ $tipoOtro->tipo }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tipo_otro')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4" id="otro-wrapper" style="display: none;">
                            <label>UNIDAD DE CONSERVACIÓN | OTRO:</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="otro" id="otro"
                                    placeholder="Escriba la unidad de otros"
                                    value="{{ old('otro', $inventario->otro) }}">
                            </div>
                        </div>


                        <div class="col-md-4">
                            <label>NUMERO DE FOLIOS:</label>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba el numero de folios" type="text" class="form-control"
                                    name="folio" id="folio" value="{{ old('folio', $inventario->folio) }}"
                                    required>
                            </div>
                        </div>

                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="fuente_id">SOPORTE DOCUMENTAL:</label>
                                <select class="select2 @error('fuente_id') is-invalid @enderror" name="fuente_id"
                                    id="fuente_id" style="width: 100%;">

                                    @foreach ($fuentes as $fuente)
                                        <option value="{{ $fuente->id }}"
                                            {{ old('fuente_id', $inventario->fuente_id) == $fuente->id ? 'selected' : '' }}>
                                            {{ $fuente->detfuente }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('fuente_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="tipoprioridade_id">FRECUENCIA DE CONSULTA:</label>
                                <select class="select2 @error('tipoprioridade_id') is-invalid @enderror"
                                    name="tipoprioridade_id" id="tipoprioridade_id" style="width: 100%;">

                                    @foreach ($tipoprioridades as $tipoprioridad)
                                        <option value="{{ $tipoprioridad->id }}"
                                            {{ old('tipoprioridade_id', $inventario->tipoprioridade_id) == $tipoprioridad->id ? 'selected' : '' }}>
                                            {{ $tipoprioridad->detprioridad }}</option>
                                    @endforeach
                                </select>
                                @error('tipoprioridade_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="col-md-4">
                            <label>¿HAY UBICACIÓN DE ARCHIVO ELECTRÓNICO?</label>
                            <select id="archivoSelect" class="select2 form-control" onchange="toggleFields()">
                                <option value="" selected>Selecciona una opción</option>
                                <option value="no">NO</option>
                                <option value="si">SI</option>
                            </select>
                        </div>
                        <div id="archivoPdfField" class="col-md-4" style="display:none;">
                            <label>ARCHIVO PDF:</label>
                            <div class="input-group mb-3">
                                @if ($inventario->archivo_pdf)
                                    <a href="{{ asset('storage/' . $inventario->archivo_pdf) }}" target="_blank"
                                        class="btn btn-primary form-control">
                                        Ver archivo PDF
                                    </a>
                                @endif
                                <input enctype="multipart/form-data" class="btn btn-primary form-control" type="file"
                                    name="archivo_pdf" id="archivoPdfInput" onchange="checkFileSize()">
                            </div>
                            <small id="fileSizeError" style="color: red; display: none;">El tamaño del archivo no debe
                                exceder 5 MB.</small>
                        </div>

                        <div id="ubicacionFields" class="col-md-4" style="display:none;">
                            <label>UBICACIÓN:</label>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba la ubicación o ruta de acceso de los documentos"
                                    type="text" class="form-control" name="ubicacion"
                                    value="{{ old('ubicacion', $inventario->ubicacion) }}">
                            </div>
                        </div>

                        <div id="cantidadDocumentosFields" class="col-md-4" style="display:none;">
                            <label>CANTIDAD DE DOCUMENTOS ELECTRONICOS:</label>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba la cantidad de documentos" type="text"
                                    class="form-control" name="cantidad_documentos"
                                    value="{{ old('cantidad_documentos', $inventario->cantidad_documentos) }}">
                            </div>
                        </div>

                        <div id="tamanoDocumentosFields" class="col-md-4" style="display:none;">
                            <label>TAMAÑO DE LOS DOCUMENTOS ELECTRONICOS:</label>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba el tamaño de los documentos" type="text"
                                    class="form-control" name="tamano_documentos"
                                    value="{{ old('tamano_documentos', $inventario->tamano_documentos) }}">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <label>NOTAS:</label>
                            <div class="input-group sm-3">
                                <input placeholder="Escriba una nota" type="text" class="form-control" name="nota"
                                    id="nota" value="{{ old('nota', $inventario->nota) }}" required
                                    onkeypress="return validarCaracter(event)">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- {{-- <div class="form-group">
                    <table class="table">
                        <thead class="thead-inverse">
                            <tr>
                                <th>CODIGO UNSPSC: </th>
                                <th>Producto:</th>
                                <th>Acciones:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($planadquisicione->productos as $producto)
                            <tr>
                                <td scope="row">{{$producto->id}}</td>
                                <td>{{$producto->detproducto}}</td>
                                <td>


                                    <a href="{{route('retirar_producto', [$planadquisicione,$producto])}}"
                                        class="btn btn-danger btn-sm">Eliminar</a>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div> --}} -->
            </div>
            <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div class="row">
        <div class="col-12 mb-2">
            <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Actualizar" class="btn btn-primary float-right">
        </div>
    </div>
    {!! Form::close() !!}
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <div class="modal fade" id="notaModal" tabindex="-1" role="dialog" aria-labelledby="notaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notaModalLabel">Mensaje de Validación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Por favor, ingrese solo letras, números o guión (-) en el campo de notas.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary float-right" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>





@endsection
@section('script')

    <!-- Select2 -->
    {!! Html::script('adminlte/plugins/select2/js/select2.full.min.js') !!}
    <script>
        $(function() {

            //Initialize Select2 Elements
            $('.select2').select2()

        })
    </script>
    <!-- <script>
        $(document).ready(function() {
            $('#valorestimadocont').mask("#.##0", {
                reverse: true
            });
            $('#valorestimadovig').mask("#.##0", {
                reverse: true
            });
        });
    </script> -->

    <script>
        var segmento_id = $('#segmento_id');
        var familias_id = $('#familias_id');

        $(document).ready(function() {
            segmento_id.change(function() {
                var segmento_id = $(this).val();
                console.log("Cambio en segmento_id detectado");
                if (segmento_id) {
                    $.get('/get-familias/' + segmento_id, function(data) {
                        $('#familias_id').empty();


                        $('#familias_id').append(
                            '<option disabled selected>Seleccione un Tipo de Subserie Documental:</option>'
                        );
                        $.each(data, function(key, value) {
                            $('#familias_id').append('<option value="' + value.id +
                                '" name="' + value.detfamilia + '">' + value
                                .detfamilia + '</option>');
                        });
                        // Selecciona automáticamente la primera opción
                        $('#familias_id').val($('#familias_id option:first').val());
                    });
                } else {
                    // Si no se selecciona ninguna ciudad, limpia la lista de estandares
                    $('#familias_id').empty();
                }
            });
        });
    </script>
    {{-- <script>
        var otro = $('#otro');
        var tipo_otro = $('#tipo_otro');
        var requipoais_id = $('#requipoais_id');

        $(function() {
            $("#requipoais_id").change(function() {
                if ($(this).val() == 2) {
                    $("#otro").prop("hidden", true);
                    $("#tipo_otro").prop("hidden", true);
                    document.getElementById("otro").value = " ";
                    document.getElementById("tipo_otro").value = " ";
                } else {
                    $("#otro").prop("hidden", false);
                    $("#tipo_otro").prop("hidden", false);

                }
            });
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            var otroWrapper = $('#otro-wrapper');
            var tipoOtroWrapper = $('#tipo_otro').closest('.col-md-4');
            var requipoaisId = $('#requipoais_id');

            // Función para mostrar u ocultar campos según el valor seleccionado
            function toggleOtroFields() {
                if (requipoaisId.val() == '2') { // Cambia '2' por el valor de "No" en tu base de datos
                    otroWrapper.hide(); // Oculta el campo "OTRO"
                    tipoOtroWrapper.hide(); // Oculta el select "TIPO"
                    $('#otro').val(''); // Limpia el valor del campo OTRO cuando se oculta
                    $('#tipo_otro').val(''); // Limpia el valor del select TIPO cuando se oculta
                } else {
                    otroWrapper.show(); // Muestra el campo "OTRO"
                    tipoOtroWrapper.show(); // Muestra el select "TIPO"
                }
            }

            // Ejecutar la función al cambiar el valor del select
            requipoaisId.change(function() {
                toggleOtroFields();
            });

            // Ejecutar la función al cargar la página (para manejar datos en formularios de edición)
            toggleOtroFields();
        });
    </script>


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const requipoaisSelect = document.getElementById('requipoais_id');
            const tipoOtroContainer = document.getElementById('tipo_otro_container');
            const unidadOtroContainer = document.getElementById('unidad_otro_container');

            // Función para manejar la visibilidad de los campos
            function toggleOtroFields() {
                const selectedValue = requipoaisSelect.value;

                if (selectedValue ==
                    'id_que_corresponde_a_si') { // Reemplaza con el valor del ID que corresponde a "Sí"
                    tipoOtroContainer.prop("hidden", false);
                    unidadOtroContainer.prop("hidden", false);
                } else {
                    tipoOtroContainer.prop("hidden", true);
                    unidadOtroContainer.prop("hidden", true);
                }
            }

            // Ejecutar cuando se cambie la selección
            requipoaisSelect.addEventListener('change', toggleOtroFields);

            // Ejecutar en la carga por si ya hay un valor seleccionado
            toggleOtroFields();
        });
    </script> --}}


    <script>
        // Función para aplicar el formato condicional y validar una fecha
        function validarYFormatearFecha(inputElement, outputElement) {
            var inputValue = inputElement.value;
            inputValue = inputValue.replace(/\D/g, ""); // Eliminar caracteres no numéricos
            if (inputValue.length > 0) {
                // Formatear la fecha con "/"
                if (inputValue.length > 2) {
                    inputValue = inputValue.slice(0, 2) + "/" + inputValue.slice(2);
                }
                if (inputValue.length > 5) {
                    inputValue = inputValue.slice(0, 5) + "/" + inputValue.slice(5, 9);
                }
                // Validar la fecha
                var parts = inputValue.split("/");
                if (parts.length === 3) {
                    var day = parseInt(parts[0]);
                    var month = parseInt(parts[1]);
                    var year = parseInt(parts[2]);
                    var date = new Date(year, month - 1, day);
                    if (date.getDate() === day && date.getMonth() === month - 1 && date.getFullYear() === year) {
                        // La fecha es válida, actualizar el valor del campo de entrada
                        inputElement.value = inputValue;
                        // Mostrar la fecha en el elemento de visualización
                        var options = {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        };
                        outputElement.textContent = date.toLocaleDateString(undefined, options);
                        outputElement.style.color = "green";
                        return;
                    }
                }
            }
            // Si la fecha es inválida, mostrar un mensaje de error en rojo
            outputElement.textContent = "Fecha inválida";
            outputElement.style.color = "red";
        }

        // Obtener los elementos de entrada y salida para la fecha inicial y final
        var fechaInicialInput = document.getElementById("fechaInicialInput");
        var fechaFinalInput = document.getElementById("fechaFinalInput");
        var fechaMostrada = document.getElementById("fechaMostrada");
        var fechaFinalMostrada = document.getElementById("fechaFinalMostrada");

        // Escuchar eventos de entrada para la fecha inicial
        fechaInicialInput.addEventListener("input", function() {
            validarYFormatearFecha(this, fechaMostrada);
        });

        // Escuchar eventos de entrada para la fecha final
        fechaFinalInput.addEventListener("input", function() {
            validarYFormatearFecha(this, fechaFinalMostrada);
        });
        // Obtener el elemento de entrada de fecha
        var fechaInicialInput = document.getElementById("fechaInicialInput");
        var fechaFinalInput = document.getElementById("fechaFinalInput");

        // Escuchar eventos de entrada para formatear automáticamente la fecha
        fechaFinalInput.addEventListener("input", function() {
            var inputValue = this.value;
            inputValue = inputValue.replace(/\D/g, ""); // Eliminar caracteres no numéricos
            if (inputValue.length > 0) {
                // Formatear la fecha con "/"
                if (inputValue.length > 2) {
                    inputValue = inputValue.slice(0, 2) + "/" + inputValue.slice(2);
                }
                if (inputValue.length > 5) {
                    inputValue = inputValue.slice(0, 5) + "/" + inputValue.slice(5, 9);
                }
            }
            this.value = inputValue; // Actualizar el valor del campo de entrada
        });
        // Escuchar eventos de entrada para formatear automáticamente la fecha
        fechaInicialInput.addEventListener("input", function() {
            var inputValue = this.value;
            inputValue = inputValue.replace(/\D/g, ""); // Eliminar caracteres no numéricos
            if (inputValue.length > 0) {
                // Formatear la fecha con "/"
                if (inputValue.length > 2) {
                    inputValue = inputValue.slice(0, 2) + "/" + inputValue.slice(2);
                }
                if (inputValue.length > 5) {
                    inputValue = inputValue.slice(0, 5) + "/" + inputValue.slice(5, 9);
                }
            }
            this.value = inputValue; // Actualizar el valor del campo de entrada
        });
    </script>


    <!-- Agrega este script en la sección 'script' de tu vista -->

    <script>
        function validarCaracter(event) {
            var input = event.key;
            // Usar una expresión regular para permitir letras, números y el guión (-)
            var regex = /^[a-zA-Z0-9\- ]$/;
            if (!regex.test(input)) {
                event.preventDefault(); // Prevenir la entrada del carácter no válido
                $('#notaModal').modal('show'); // Mostrar el modal de validación
            }
        }

        function validarNota() {
            var notaInput = document.getElementById("nota");
            var notaValue = notaInput.value;
            // Usar una expresión regular para permitir solo caracteres alfanuméricos y el guión (-)
            var regex = /^[a-zA-Z0-9\- ]+$/; // Permite letras, números, guiones y espacios

            if (!regex.test(notaValue)) {
                // alert("Por favor, la nota solo puede contener letras, números, guiones y espacios.");
                notaInput.value = ""; // Borrar el contenido no válido
                notaInput.focus(); // Colocar el foco en el campo de notas
                return false;
            }

            return true;
        }

        // Asigna la función de validación al evento submit del formulario
        var form = document.forms[0]; // Asegúrate de que este sea el índice correcto del formulario
        form.addEventListener("submit", function(event) {
            if (!validarNota()) {
                event.preventDefault(); // Evita que se envíe el formulario si la nota es inválida
            }
        });
    </script>

    <script>
        function toggleFields() {
            var selectValue = document.getElementById('archivoSelect').value;
            var archivoPdfField = document.getElementById('archivoPdfField');
            var ubicacionFields = document.getElementById('ubicacionFields');
            var tamanoDocumentosFields = document.getElementById('tamanoDocumentosFields');
            var cantidadDocumentosFields = document.getElementById('cantidadDocumentosFields');

            if (selectValue === 'no') {
                archivoPdfField.style.display = 'block';
                ubicacionFields.style.display = 'none';
                tamanoDocumentosFields.style.display = 'none';
                cantidadDocumentosFields.style.display = 'none';
            } else {
                archivoPdfField.style.display = 'none';
                ubicacionFields.style.display = 'block';
                tamanoDocumentosFields.style.display = 'block';
                cantidadDocumentosFields.style.display = 'block';
            }
        }
    </script>

    <script>
        function checkFileSize() {
            var fileInput = document.getElementById('archivoPdfInput');
            var fileSizeError = document.getElementById('fileSizeError');

            if (fileInput.files[0]) {
                var fileSize = fileInput.files[0].size / 1024 / 1024; // Convertir a MB
                if (fileSize > 5) { // Limitar a 2 MB
                    fileSizeError.style.display = 'block';
                    fileInput.value = ''; // Limpiar el campo de archivo
                } else {
                    fileSizeError.style.display = 'none';
                }
            }
        }
    </script>

@endsection
