<?php

namespace App\Imports;

use App\Planadquisicione;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PlanadquisicioneImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $slug = Str::slug($row[10]);

        // Verificar si ya existe un Planadquisicione con el mismo slug
        $counter = 1;
        while (Planadquisicione::where('slug', $slug)->exists()) {
            $slug = Str::slug($row[5] . '-' . $counter, '-');
            $counter++;
        }

        // Obtén el último ID en la tabla y agrégalo al slug
        $ultimoId = Planadquisicione::max('id') + 1;
        $slugWithId = $slug . '-' . $ultimoId;

        return new Planadquisicione([
            'caja' => $row[0],
            'carpeta' => $row[1],
            'tomo' => $row[2],
            'otro' => $row[3],
            'folio' => $row[4],
            'nota' => $row[5],
            'modalidad_id' => $row[6],
            'fuente_id' => $row[7],
            'tipoprioridade_id' => $row[8],
            'user_id' => $row[9],
            // 'slug' => $row[10],
            'slug' => $slugWithId,
            'requiproyecto_id' => $row[11],
            'requipoais_id' => $row[12],
            'segmento_id' => $row[13],
            'familias_id' => $row[14],

            // Conversión de las fechas al formato YYYY-MM-DD
            // 'fechaInicial' => $row[15],
            // 'fechaFinal' => $row[16],
            'fechaInicial' => $this->transformDate($row[15]),
            'fechaFinal' => $this->transformDate($row[16]),

            'area_id' => $row[17]
        ]);
    }

    /**
     * Convierte una fecha desde el formato 'DD/MM/YYYY' al formato 'YYYY-MM-DD'.
     *
     * @param string $value
     * @return string|null
     */
    public function transformDate($value)
    {
        try {
            return Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        } catch (\Exception $e) {
            try {
                // Intentar manejar otros formatos comunes
                return Carbon::parse($value)->format('Y-m-d');
            } catch (\Exception $e) {
                // Si falla, establecer una fecha predeterminada
                return '1970-01-01'; // Fecha predeterminada si no se puede parsear la fecha
            }
        }
    }
}
