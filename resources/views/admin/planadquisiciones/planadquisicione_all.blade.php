<table>
    <thead>
        <tr>
            <th>NÚMERO DE ORDEN</th>
            <th>ENTIDAD PRODUCTORA</th>
            <th>UNIDAD ADMINISTRATIVA</th>
            <th>OBJETO</th>
            <th>CODIGO DE DEPENDENCIA</th>
            <th>TIPO DE SERIES DOCUMENTALES</th>
            <th>TIPO DE SUBSERIE DOCUMENTAL</th>
            <th>FECHAS EXTREMAS | FECHA INICIAL</th>
            <th>FECHAS EXTREMAS | FECHA FINAL</th>
            <th>UNIDAD DE CONSERVACIÓN | CAJA</th>
            <th>UNIDAD DE CONSERVACIÓN | CARPETA</th>
            <th>UNIDAD DE CONSERVACIÓN | TOMO / LEGAJO / LIBRO</th>
            <th>NÚMERO DE FOLIOS</th>
            <th>SOPORTE O FORMATO</th>
            <th>OPCIÓN OTRO</th>
            <th>TIPO</th>
            <th>UNIDAD DE CONSERVACIÓN | CANTIDAD</th>
            <th>¿HAY UBICACIÓN DE ARCHIVO ELECTRÓNICO?</th>
            <th>UBICACIÓN (URL)</th>
            <th>CANTIDAD DE DOCUMENTOS ELECTRÓNICOS</th>
            <th>TAMAÑO DE LOS DOCUMENTOS ELECTRÓNICOS</th>
            <th>ARCHIVO PDF</th>
            <th>NOTAS</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($planadquisiciones as $planadquisicion)
            <tr>
                <td>{{ $planadquisicion->id }}</td>
                <td>{{ $planadquisicion->area->dependencia->nomdependencia }}</td>
                <td>{{ $planadquisicion->area->nomarea }}</td>
                <td>{{ $planadquisicion->modalidad->detmodalidad }}</td>
                <td>{{ $planadquisicion->requiproyecto->detproyecto ?? 'N/A' }}</td>
                <td>{{ $planadquisicion->segmento->detsegmento }}</td>
                <td>{{ $planadquisicion->familias->detfamilia }}</td>
                <td>{{ $planadquisicion->fechaInicial }}</td>
                <td>{{ $planadquisicion->fechaFinal }}</td>
                <td>{{ $planadquisicion->caja }}</td>
                <td>{{ $planadquisicion->carpeta }}</td>
                <td>{{ $planadquisicion->tomo }}</td>
                <td>{{ $planadquisicion->folio }}</td>
                <td>
                    @php
                        $formatos = explode(',', $planadquisicion->soporte_formato);
                        $resultado = [];

                        if (in_array('fisico', $formatos)) {
                            $resultado[] = 'Físico (Papel)';
                        }
                        if (in_array('electronico', $formatos)) {
                            $resultado[] = 'Electrónico';
                        }
                    @endphp
                    {{ implode(', ', $resultado) ?: 'N/A' }}
                </td>
                <td>{{ $planadquisicion->requipoais->detpoai == 'si' ? 'Sí' : 'NO' }}</td>
                <td>{{ $planadquisicion->requipoais->detpoai == 'si' ? $planadquisicion->tipo_otro->tipo ?? 'N/A' : '' }}
                </td>
                <td>{{ $planadquisicion->requipoais->detpoai == 'si' ? $planadquisicion->otro ?? 'N/A' : '' }}</td>
                <td>{{ $planadquisicion->archivoSelect == 'si' ? 'Sí' : 'NO' }}</td>
                <td>{{ $planadquisicion->archivoSelect == 'si' ? $planadquisicion->ubicacion : '' }}</td>
                <td>{{ $planadquisicion->archivoSelect == 'si' ? $planadquisicion->cantidad_documentos : '' }}</td>
                <td>{{ $planadquisicion->archivoSelect == 'si' ? $planadquisicion->tamano_documentos : '' }}</td>
                <td>
                    @if ($planadquisicion->archivoSelect != 'si')
                        <a href="{{ asset('storage/' . $planadquisicion->archivo_pdf) }}">Descargar</a>
                    @endif
                </td>
                <td>{{ $planadquisicion->nota }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
