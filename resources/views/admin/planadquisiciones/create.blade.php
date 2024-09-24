@extends('layouts.admin')
@section('title', 'Inventario')
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
                        <h1>Inventario</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('planadquisiciones.index') }}">Listado Inventario
                                </a></li>
                            <li class="breadcrumb-item active">Inventario</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            {!! Form::open(['route' => 'planadquisiciones.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="area_id">OFICINA PRODUCTORA:</label>
                                <i class="btn btn-primary fas fa-question"
                                    onclick="showInfo('Debe colocarse el nombre de la Unidad Administrativa que produce y conserva la documentación tramitada en ejercicio de sus funciones.')"></i>
                                <select class="select2 @error('area_id') is-invalid @enderror" name="area_id" id="area_id"
                                    style="width: 100%;">
                                    <option disabled selected>Seleccione una Unidad Administrativa</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}" selected>{{ $area->nomarea }}</option>
                                    @endforeach
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
                                <i class="btn btn-primary fas fa-question"
                                    onclick="showInfo('Se debe consignar la finalidad del inventario, que puede ser: Transferencias primarias, transferencias secundarias, valoración de fondos acumulados, fusión y supresión de entidades y/o dependencias, inventarios individuales.')">
                                </i>
                                <select class="select2 @error('modalidad_id') is-invalid @enderror" name="modalidad_id"
                                    id="modalidad_id" style="width: 100%;">
                                    <option disabled selected>Seleccione un Objeto</option>
                                    @foreach ($modalidades as $modalidad)
                                        <option value="{{ $modalidad->id }}"
                                            {{ old('modalidad_id') == $modalidad->id ? 'selected' : '' }}>
                                            {{ $modalidad->detmodalidad }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('modalidad_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="requiproyecto_id">CODIGO DE DEPENDENCIA:</label>
                                <i class="btn btn-primary fas fa-question"
                                    onclick="showInfo('Se debe diligenciar el código asignado para las oficinas productoras, de acuerdo con lo consignado en el Cuadro de Clasificación Documental – CCD, las Tablas de Retención Documental - TRD o Tablas de Valoración Documental -TVD.')"></i>
                                <select class="select2 @error('requiproyecto_id') is-invalid @enderror"
                                    name="requiproyecto_id" id="requiproyecto_id" style="width: 100%;">
                                    <option value="" disabled selected>Seleccione Codigo de Dependencia</option>
                                    @foreach ($requiproyectos as $requiproyectoId => $requiproyecto)
                                        <option value="{{ $requiproyectoId }}" selected>{{ $requiproyecto }}</option>
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
                                <i class="btn btn-primary fas fa-question"
                                    onclick="showInfo('Consignar el nombre de la serie, subserie o asunto según lo definido en el Cuadro de Clasificación Documental – CCD, las Tablas de Retención Documental - TRD o Tablas de Valoración Documental -TVD.')"></i>
                                <select class="select2 @error('segmento_id') is-invalid @enderror" name="segmento_id"
                                    id="segmento_id" style="width: 100%;">
                                    <option value="" disabled selected>Seleccione un Tipo de Series Documentales:
                                    </option>
                                    @foreach ($segmentos as $segmento)
                                        <option value="{{ $segmento->id }}"
                                            {{ old('segmento_id') == $segmento->id ? 'selected' : '' }}>
                                            {{ $segmento->id }} - {{ $segmento->detsegmento }}</option>
                                    @endforeach
                                </select>
                                @error('segmento_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="familias_id">TIPO DE SUBSERIE DOCUMENTAL:</label>
                                <i class="btn btn-primary fas fa-question"
                                    onclick="showInfo('Consignar el nombre de la serie, subserie o asunto según lo definido en el Cuadro de Clasificación Documental – CCD, las Tablas de Retención Documental - TRD o Tablas de Valoración Documental -TVD.')"></i>
                                <select id="familias_id" name="familias_id" class="form-control select2" style="width: 100%"
                                    required>
                                    <option value="" disabled selected>Seleccione un Tipo de Subserie Documental:
                                    </option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>NOMBRE DE LA UNIDAD DOCUMENTAL</label>
                            <i class="btn btn-primary fas fa-question"
                                onclick="showInfo(' Consignar el nombre con el cual se identifica la unidad documental.')"></i>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba el nombre de la unidad documental" type="text"
                                    class="form-control" name="nombre_unidad" id="nombre_unidad" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>FECHAS EXTREMAS | Fecha Inicial:</label>
                            <i class="btn btn-primary fas fa-question"
                                onclick="showInfo('Consignar la fecha inicial de cada unidad documental descrita. Deben colocarse los cuatro dígitos correspondientes al año, los dos dígitos correspondientes al mes y los dos dígitos correspondientes al día. Las fechas que se registren deben corresponder al documento principal con el cual se dio la ordenación y no a los anexos. Cuando la documentación no tenga fecha se anotarán las siglas “S.F.” que significan “sin fecha”.')"></i>
                            <div class="form-label-group">
                                <input placeholder="Escriba la fecha inicial o 'S.F.'" type="text"
                                    class="form-control datepicker" name="fechaInicial" id="fechaInicialInput" required>
                            </div>
                            <span id="fechaMostrada"></span>
                        </div>

                        <div class="col-md-4">
                            <label for="fechaFinal">FECHAS EXTREMAS | Fecha Final:</label>
                            <i class="btn btn-primary fas fa-question"
                                onclick="showInfo('Consignar la fecha inicial de cada unidad documental descrita. Deben colocarse los cuatro dígitos correspondientes al año, los dos dígitos correspondientes al mes y los dos dígitos correspondientes al día. Las fechas que se registren deben corresponder al documento principal con el cual se dio la ordenación y no a los anexos. Cuando la documentación no tenga fecha se anotarán las siglas “S.F.” que significan “sin fecha”.')"></i>
                            <div class="form-label-group">
                                <input placeholder="Escriba la fecha final o 'S.F.'" type="text"
                                    class="form-control datepicker" name="fechaFinal" id="fechaFinalInput" required>
                            </div>
                            <span id="fechaFinalMostrada"></span>
                        </div>


                        <div class="col-md-4">
                            <label>SOPORTE O FORMATO</label>
                            <i class="btn btn-primary fas fa-question"
                                onclick="showInfo('Marcar con una ‘X’ si la información está en físico (papel) y/o si se encuentra en formato electrónico.')"></i>
                            <div class="input-group mb-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="soporte_formato[]"
                                        id="fisico" value="fisico">
                                    <label class="custom-control-label" for="fisico">Físico (Papel)</label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="soporte_formato[]"
                                        id="electronico" value="electronico">
                                    <label class="custom-control-label" for="electronico">Electrónico</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>UNIDAD DE CONSERVACIÓN | CAJA:</label>
                            <i class="btn btn-primary fas fa-question"
                                onclick="showInfo('Se debe registrar el número asignado a cada caja en orden consecutivo.')"></i>
                            <div class="form-group mb-3">
                                <input placeholder="Escriba la unidad de las cajas" type="number" class="form-control"
                                    name="caja" id="caja" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>UNIDAD DE CONSERVACIÓN | CARPETA:</label>
                            <i class="btn btn-primary fas fa-question"
                                onclick="showInfo('Se debe registrar el número asignado a cada carpeta. La numeración se realiza de forma consecutiva iniciando en uno (1) en cada caja.')"></i>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba la unidad de las carpetas" type="number"
                                    class="form-control" name="carpeta" id="carpeta" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>UNIDAD DE CONSERVACIÓN | TOMO / LEGAJO / LIBRO:</label>
                            <i class="btn btn-primary fas fa-question"
                                onclick="showInfo('Se debe registrar el número asignado a cada material que se encuentra empastado ya sea un tomo, legajo o libro.')"></i>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba la unidad de tomos" type="number" class="form-control"
                                    name="tomo" id="tomo" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>NÚMERO DE FOLIOS:</label>
                            <i class="btn btn-primary fas fa-question"
                                onclick="showInfo('Se anotará el rango de folios contenidos en cada unidad de conservación descrita para el caso de los documentos en papel.')"></i>
                            <div class="input-group mb-3">

                                <input placeholder="Escriba el número de folios" type="text" class="form-control"
                                    name="folio" id="folio" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="requipoais_id">OPCIÓN OTRO:</label>
                                <select class="select2 @error('requipoais_id') is-invalid @enderror" name="requipoais_id"
                                    id="requipoais_id" style="width: 100%;">
                                    <option disabled selected>Seleccione si es otro</option>
                                    @foreach ($requipoais as $requipoai)
                                        <option value="{{ $requipoai->id }}"
                                            {{ old('requipoais_id') == $requipoai->id ? 'selected' : '' }}>
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
                        <div id="tipo_otro" class="col-md-4">
                            <div class="form-group">
                                <label for="tipo_otro">TIPO:</label>
                                <i class="btn btn-primary fas fa-question"
                                    onclick="showInfo('Consignar nombre del tipo de unidad de almacenamiento (rollo de microfilm, casettes, cintas de video, CD, DVD, entre otros).')"></i>
                                <select class="select2 @error('tipo_otro') is-invalid @enderror" name="tipo_otro"
                                    id="tipo_otro" style="width: 100%;">
                                    <option disabled selected>Seleccione el Tipo</option>
                                    @foreach ($tipoOtros as $tipoOtro)
                                        <option value="{{ $tipoOtro->id }}"
                                            {{ old('tipo_otro') == $tipoOtro->id ? 'selected' : '' }}>
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
                        <div id="otro" class="col-md-4">
                            <label>UNIDAD DE CONSERVACIÓN | CANTIDAD:</label>
                            <i class="btn btn-primary fas fa-question"
                                onclick="showInfo('Registrar la cantidad de unidades de almacenamiento. Consignar en el área de ‘Notas’ el número asignado a dicha(s) unidad(es).')"></i>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba la unidad de otros" type="text" class="form-control"
                                    name="otro">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>¿HAY UBICACIÓN DE ARCHIVO ELECTRÓNICO?</label>
                            <select class="select2 @error('archivoSelect') is-invalid @enderror" name="archivoSelect"
                                id="archivoSelect" style="width: 100%;" onchange="toggleFields()">
                                <option value="" disabled selected>Selecciona una opción</option>
                                <option value="si">SI</option>
                                <option value="no">NO</option>
                            </select>
                        </div>
                        <div id="archivoPdfField" class="col-md-4" style="display:none;">
                            <label>ARCHIVO PDF:</label>
                            <i class="btn btn-primary fas fa-question"
                                onclick="showInfo('Adjuntar el documento en formato PDF y no puede exceder los 5 MB')"></i>
                            <div class="input-group mb-3">
                                <input enctype="multipart/form-data" class="btn btn-primary form-control" type="file"
                                    name="archivo_pdf" id="archivoPdfInput" accept="application/pdf"
                                    onchange="validateFileTypeAndSize()">
                            </div>
                            <!-- Mensajes de error -->
                            <p id="fileTypeError" style="display:none; color:red;">El archivo debe ser un PDF.</p>
                            <p id="fileSizeError" style="display:none; color:red;">El archivo no debe exceder los 5 MB.
                            </p>

                        </div>

                        <div id="ubicacionFields" class="col-md-4" style="display:none;">
                            <label>UBICACIÓN (URL):</label>
                            <i class="btn btn-primary fas fa-question"
                                onclick="showInfo('Consignar la ubicación (URL) o ruta de acceso de los documentos o expediente electrónico.')"></i>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba la ubicación o ruta de acceso de los documentos"
                                    type="text" class="form-control" name="ubicacion">
                            </div>
                        </div>

                        <div id="cantidadDocumentosFields" class="col-md-4" style="display:none;">
                            <label>CANTIDAD DE DOCUMENTOS ELECTRONICOS:</label>
                            <i class="btn btn-primary fas fa-question"
                                onclick="showInfo('Consignar en números la cantidad de documentos que hacen parte del expediente.')"></i>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba la cantidad de documentos" type="text"
                                    class="form-control" name="cantidad_documentos">
                            </div>
                        </div>

                        <div id="tamanoDocumentosFields" class="col-md-4" style="display:none;">
                            <label>TAMAÑO DE LOS DOCUMENTOS ELECTRONICOS:</label>
                            <i class="btn btn-primary fas fa-question"
                                onclick="showInfo('Consignar en números el tamaño total del expediente, indicando la unidad de medida (Mb o Gb).')"></i>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba el tamaño de los documentos" type="text"
                                    class="form-control" name="tamano_documentos">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label>NOTAS:</label>
                            <i class="btn btn-primary fas fa-question"
                                onclick="showInfo('Se consignarán los datos que sean relevantes y no se hayan registrado en las columnas anteriores o NA (No Aplica). Registrar los faltantes, saltos por error en la numeración y/o repetición del número consecutivo en diferentes documentos. o Registrar información sobre el estado de conservación de la documentación objeto del inventario, especificando el tipo de deterioro: físico (rasgaduras, mutilaciones, perforaciones, dobleces y faltantes), químico (soporte débil) y biológico (ataque de hongos, insectos, roedores, etc.). o Identificar en el área de notas las unidades documentales que contengan documentos relativos a la protección y salvaguarda de los Derechos Humanos y el Derecho Internacional Humanitario, o que hagan referencia a las graves y manifiestas violaciones a los Derechos Humanos.')"></i>
                            <div class="input-group mb-3">
                                <input placeholder="Escriba una nota" type="text" class="form-control" name="nota"
                                    id="nota" required onkeypress="return validarCaracter(event)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Registrar" class="btn btn-primary float-right">
                </div>
            </div>
    </div>
    <!-- /.card -->

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
    <!-- Tu otro script personalizado aquí -->

    <script>
        $(function() {

            //Initialize Select2 Elements
            $('.select2').select2()

        });
    </script>
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
    <script>
        var otro = $('#otro');
        var tipo_otro = $('#tipo_otro');
        var requipoais_id = $('#requipoais_id');

        $(function() {
            $("#otro").prop("hidden", true);
            $("#tipo_otro").prop("hidden", true);

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
    </script>

    <!-- Incluye jQuery -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
    <!-- Incluye Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Incluye JS de Bootstrap Datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    {{-- <script>
        // Inicializar el datepicker
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: "dd/mm/yyyy", // Formato de fecha
                autoclose: true,
                language: "es" // Cambia esto si quieres otro idioma
            });
        });

        // Función para deshabilitar el datepicker cuando el valor es 'S.F.'
        function manejarEntrada(inputElement, datepickerInstance) {
            var inputValue = inputElement.value.toUpperCase();
            // Si el valor es 'SF', cambiar a 'S.F.'
            if (inputValue === 'SF') {
                inputElement.value = 'S.F.';
                datepickerInstance.datepicker('destroy'); // Destruir temporalmente el datepicker
                // inputElement.setAttribute('readonly', true); // Hacer el campo solo lectura
                return;
            }
        }

        // Función para aplicar el formato condicional y validar una fecha o 'S.F.'
        function validarYFormatearFecha(inputElement, outputElement) {
            var inputValue = inputElement.value.trim().toUpperCase();

            // Si es 'S.F.', no aplicar formato de fecha
            if (inputValue === 'S.F.') {
                outputElement.textContent = 'Sin fecha';
                outputElement.style.color = "green";
                return;
            }

            // Continuar con el formateo si no es 'S.F.'
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
            manejarEntrada(this, $('#fechaInicialInput'));
            // Validar solo si el valor no es 'S.F.'
            if (this.value.toUpperCase() !== 'S.F.') {
                validarYFormatearFecha(this, fechaMostrada);
            }
        });

        // Escuchar eventos de entrada para la fecha final
        fechaFinalInput.addEventListener("input", function() {
            manejarEntrada(this, $('#fechaFinalInput'));
            // Validar solo si el valor no es 'S.F.'
            if (this.value.toUpperCase() !== 'S.F.') {
                validarYFormatearFecha(this, fechaFinalMostrada);
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Inicializar el datepicker
            $('.datepicker').datepicker({
                format: "dd/mm/yyyy", // Formato de fecha
                autoclose: true,
                language: "es"
            });
    
            // Función para deshabilitar el datepicker cuando el valor es 'S.F.'
            function manejarEntrada(inputElement, datepickerInstance) {
                var inputValue = inputElement.value.toUpperCase();
    
                // Si el valor es 'S.F.', deshabilitar el datepicker y permitir solo ese valor
                if (inputValue === 'S.F.') {
                    datepickerInstance.datepicker('destroy');  // Destruir temporalmente el datepicker
                    inputElement.value = 'S.F.';
                    inputElement.setAttribute('readonly', true);  // Hacer que el campo sea solo lectura
                } else {
                    // Si el valor no es 'S.F.', volver a habilitar el datepicker
                    inputElement.removeAttribute('readonly');
                    // Re-inicializar el datepicker si se eliminó el valor 'S.F.'
                    if (!$(inputElement).data('datepicker')) {
                        $(inputElement).datepicker({
                            format: "dd/mm/yyyy",
                            autoclose: true,
                            language: "es"
                        });
                    }
                }
            }
    
            // Inicializar el comportamiento en los campos de fecha
            $('#fechaInicialInput').on('input', function() {
                manejarEntrada(this, $('#fechaInicialInput'));
            });
    
            $('#fechaFinalInput').on('input', function() {
                manejarEntrada(this, $('#fechaFinalInput'));
            });
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            // Inicializar el datepicker
            $('.datepicker').datepicker({
                format: "dd/mm/yyyy", // Formato de fecha
                autoclose: true,
                language: "es"
            });

            // Función para deshabilitar el datepicker cuando el valor es 'S.F.'
            function manejarEntrada(inputElement, datepickerInstance) {
                var inputValue = inputElement.value.toUpperCase();

                // Si el valor es 'S.F.', deshabilitar el datepicker y permitir solo ese valor
                if (inputValue === 'SF' || inputValue === 'S.') {
                    datepickerInstance.datepicker('destroy'); // Destruir temporalmente el datepicker
                    inputElement.value = 'S.F.';
                    inputElement.setAttribute('readonly', true); // Hacer que el campo sea solo lectura
                } else {
                    // Si el valor no es 'S.F.', volver a habilitar el datepicker
                    inputElement.removeAttribute('readonly');
                    // Re-inicializar el datepicker si se eliminó el valor 'S.F.'
                    if (!$(inputElement).data('datepicker')) {
                        $(inputElement).datepicker({
                            format: "dd/mm/yyyy",
                            autoclose: true,
                            language: "es"
                        });
                    }
                }
            }

            // Inicializar el comportamiento en los campos de fecha
            $('#fechaInicialInput').on('input', function() {
                manejarEntrada(this, $('#fechaInicialInput'));
            });

            $('#fechaFinalInput').on('input', function() {
                manejarEntrada(this, $('#fechaFinalInput'));
            });
        });
    </script>

    <!-- Agrega este script en la sección 'script' de tu vista -->

    <script>
        function validarCaracter(event) {
            var input = event.key;
            // Usar una expresión regular para permitir letras, números y el guión (-)
            // var regex = /^[a-zA-Z0-9\- ]$/;
            var regex = /^[a-zA-Z0-9ñÑ\- ]$/;
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
                if (fileSize > 5) { // Limitar a 5 MB
                    fileSizeError.style.display = 'block';
                    fileInput.value = ''; // Limpiar el campo de archivo
                } else {
                    fileSizeError.style.display = 'none';
                }
            }
        }
    </script>

    <script>
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

                // Verificar si el tamaño del archivo es mayor a 5 MB
                if (fileSize > 5 * 1024 * 1024) { // 5 MB en bytes
                    fileSizeError.style.display = 'block';
                    fileInput.value = ''; // Resetea el input para eliminar el archivo inválido
                    return;
                }
            }
        }
    </script>

    <script>
        function showInfo(message) {
            Swal.fire({
                title: 'Información del campo',
                text: message,
                icon: 'info',
                confirmButtonText: 'Entendido'
            });
        }
    </script>

@endsection
