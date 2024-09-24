<table>
    <thead>
        <tr>
            <th>NÚMERO DE ORDEN</th>
            <th>ENTIDAD PRODUCTORA</th>
            <th>UNIDAD ADMINISTRATIVA</th>
            <th>OFICINA PRODUCTORA</th>
            <th>OBJETO</th>
            <th>CODIGO</th>
            <th>NOMBRE DE LA SERIE</th>
            <th>NOMBRE DE LA SUBSERIE O ASUNTOS</th>
            <th>FECHA INICIAL</th>
            <th>FECHA FINAL</th>
            <th>CAJA</th>
            <th>CARPETA</th>
            <th>TOMO</th>
            <th>OPCIÓN OTRO</th>
            <th>OTRO</th>
            <th>NÚMERO DE FOLIOS</th>
            <th>SOPORTE</th>
            <th>FRECUENCIA DE CONSULTA</th>
            <th>USUARIO INSTITUCIONAL</th>
            <th>REGISTRO DE ENTRADA</th>
            <th>ARCHIVO ELECTRÓNICO</th>
            <th>UBICACIÓN (URL)</th>
            <th>CANTIDAD DE DOCUMENTOS ELECTRÓNICOS</th>
            <th>TAMAÑO DE LOS DOCUMENTOS ELECTRÓNICOS</th>
            <th>DESCARGAR ARCHIVO PDF</th>
            <th>NOTAS</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $plan->id }}</td>
            <td>ALCALDIA MUNICIPAL DE PUERTO BOYACA, BOYACA</td>
            <td>{{ $plan->area->dependencia->nomdependencia }}</td>
            <td>{{ $plan->area->nomarea }}</td>
            <td>{{ $plan->modalidad->detmodalidad }}</td>
            <td>{{ $plan->requiproyecto->detproyecto ?? 'N/A' }}</td>
            <td>{{ $plan->segmento->detsegmento }}</td>
            <td>{{ $plan->familias->detfamilia }}</td>
            <td>{{ $plan->fechaInicial }}</td>
            <td>{{ $plan->fechaFinal }}</td>
            <td>{{ $plan->caja }}</td>
            <td>{{ $plan->carpeta }}</td>
            <td>{{ $plan->tomo }}</td>
            <td>{{ $plan->requipoais->detpoai == 'si' ? 'Sí' : 'NO' }}</td>
            <td>{{ $plan->requipoais->detpoai == 'si' ? $plan->otro ?? 'N/A' : '' }}</td>
            <td>{{ $plan->folio }}</td>
            <td>
                @php
                    $formatos = explode(',', $plan->soporte_formato);
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
            <td>{{ $plan->tipoprioridade->detprioridad ?? 'N/A' }}</td>
            <td>{{ $plan->user->email }}</td>
            <td>{{ $plan->updated_at->format('d-m-Y') }}</td>

            <!-- Si hay ubicación de archivo electrónico -->
            <td>{{ $plan->archivoSelect == 'si' ? 'Sí' : 'NO' }}</td>
            @if ($plan->archivoSelect == 'si')
                <td>{{ $plan->ubicacion }}</td>
                <td>{{ $plan->cantidad_documentos }}</td>
                <td>{{ $plan->tamano_documentos }}</td>
            @else
                <td colspan="3">N/A</td>
            @endif

            <!-- Descargar archivo PDF -->
            <td>
                @if ($plan->archivo_pdf)
                    <a href="{{ asset('storage/' . $plan->archivo_pdf) }}">Descargar PDF</a>
                @else
                    N/A
                @endif
            </td>
            <td>{{ $plan->nota }}</td>
        </tr>
    </tbody>
</table>
