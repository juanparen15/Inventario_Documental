<?php

namespace App\Http\Controllers;

use App\Area;
use App\Clase;
use App\Dependencia;
use App\Familia;
use App\Planadquisicione;
use App\Producto;
use App\Segmento;
use App\User;
use App\Acto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all()->count();
        $actos = Acto::all()->count();
        $products = Producto::all()->count();
        $clases = Clase::all()->count();
        $segmentos = Segmento::all()->count();
        $familias = Familia::all()->count();
        $dependencias = Dependencia::all()->count();
        $areas = Area::all()->count();
        $adquisiciones = Planadquisicione::all()->count();
        $adquisicionesDependencia = Planadquisicione::all()->count();
        $adquisiciones1 = Planadquisicione::all()->count();
        $adquisiciones3 = Planadquisicione::all()->count();
        $adquisiciones2 = Planadquisicione::with('area')->get();
        $adquisicionesSeries = Planadquisicione::all()->count();




        // return view("home", ["data" => json_encode($carpetas)]);

        $carpetas = [];


        if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Supervisor')) {
            $planes = Planadquisicione::select(
                DB::raw("count(*) as count"),
                DB::raw("count(*) as totalmes"),
                DB::raw("DATE_FORMAT(created_at,'%M %Y') as mes")
            )->groupBy('mes')->take(12)->get();


            $adquisiciones3 = Planadquisicione::select(
                DB::raw("count(*) as count"),
                DB::raw("count(carpeta) as adq"),
                DB::raw("DATE_FORMAT(fechaInicial, '%Y') as anyo")
            )
                ->orderBy('anyo', 'DESC')
                ->groupBy('anyo')->take(12)->get();


            // Accede a los datos de la relación
            foreach ($adquisiciones3 as $adq) {
                // $area = $adq->area; // "area" es el nombre del método de relación en el modelo Planadquisicione
                // $nombreArea = $area->nomarea; // Accede a los campos de la relación (ejemplo: "nomarea")
                $fechaInicial = $adq->fechaInicial;
                // Puedes usar $nombreArea en tu lógica aquí
            }

            $carpetas = [];

            foreach ($adquisiciones2 as $adq) {
                // $nombreArea = $adq->area->nomarea;
                $fechaInicial = $adq->fechaInicial;
                $carpetas[] = ['name' => $adq->carpeta, 'description' => $adq->$fechaInicial];
            }



            $adquisiciones = Planadquisicione::select(
                'area_id',
                DB::raw('count(*) as adq'),
                DB::raw('MAX(areas.nomarea) as area_name'),
                // ->groupby(DB::raw("carpeta"))
                // ->pluck('count')
                // DB::raw("DATE_FORMAT(fechaInicial,'%M %Y') as anyo"),
                DB::raw("count(carpeta) as adq")
            )
                ->join('areas', 'planadquisiciones.area_id', '=', 'areas.id') // Realiza una join con la tabla de áreas
                // DB::raw("count(area_id) as area_adq"))
                // DB::raw("DATE_FORMAT(fechaInicial,'%M %Y') as anyo"))
                ->groupBy(DB::raw("area_id"))
                ->get();
            // Accede a los datos de la relación
            foreach ($adquisiciones as $adq) {
                $area = $adq->area; // "area" es el nombre del método de relación en el modelo Planadquisicione
                $nombreArea = $area->nomarea; // Accede a los campos de la relación (ejemplo: "nomarea")
                // Puedes usar $nombreArea en tu lógica aquí
            }

            $adquisicionesDependencia = Planadquisicione::select(
                'areas.dependencia_id', // Seleccionamos dependencia_id a través de áreas
                DB::raw('count(*) as adq'), // Contamos las adquisiciones
                DB::raw('MAX(dependencias.nomdependencia) as dependencia_name'), // Nombre de la dependencia
                DB::raw("count(planadquisiciones.carpeta) as adq") // Contamos la cantidad de 'carpeta'
            )
                ->join('areas', 'planadquisiciones.area_id', '=', 'areas.id') // Unimos con la tabla 'areas' usando 'area_id'
                ->join('dependencias', 'areas.dependencia_id', '=', 'dependencias.id') // Unimos 'areas' con 'dependencias' usando 'dependencia_id'
                ->groupBy('areas.dependencia_id') // Agrupamos por 'dependencia_id'
                ->get();

            // Acceder a los datos
            foreach ($adquisicionesDependencia as $adq) {
                $dependencia = $adq->dependencia_name; // Nombre de la dependencia
                $cantidadAdquisiciones = $adq->adq; // Cantidad de adquisiciones
                // Aquí puedes utilizar $dependencia y $cantidadAdquisiciones
            }

            $adquisicionesSeries = Planadquisicione::select(
                'segmento_id',
                DB::raw('count(*) as adq'),
                // DB::raw('MAX(areas.nomarea) as area_name'),
                DB::raw('MAX(segmentos.detsegmento) as serie_name'),
                // ->groupby(DB::raw("carpeta"))
                // ->pluck('count')
                // DB::raw("DATE_FORMAT(fechaInicial,'%M %Y') as anyo"),
                DB::raw("count(carpeta) as adq")
            )
                ->join('segmentos', 'planadquisiciones.segmento_id', '=', 'segmentos.id') // Realiza una join con la tabla de áreas
                // DB::raw("count(area_id) as area_adq"))
                // DB::raw("DATE_FORMAT(fechaInicial,'%M %Y') as anyo"))
                ->groupBy(DB::raw("segmento_id"))
                ->get();
            // Accede a los datos de la relación
            foreach ($adquisicionesSeries as $adq) {
                $segmento = $adq->segmento; // "area" es el nombre del método de relación en el modelo Planadquisicione
                $nombreSerie = $segmento->detsegmento; // Accede a los campos de la relación (ejemplo: "nomarea")
                // Puedes usar $nombreArea en tu lógica aquí
            }

            $carpetas = [];

            foreach ($adquisiciones2 as $adq) {
                $nombreArea = $adq->area->nomarea;
                $carpetas[] = ['name' => $adq->carpeta, 'y' => floatval($nombreArea)];
            }
        } else {
            $planes = Planadquisicione::where('user_id', auth()->user()->id)->select(
                DB::raw("count(*) as count"),
                DB::raw("count(*) as totalmes"),
                DB::raw("DATE_FORMAT(created_at,'%M %Y') as mes")
            )->groupBy('mes')->take(12)->get();

            $adquisiciones3 = Planadquisicione::where('user_id', auth()->user()->id)->select(
                DB::raw("count(*) as count"),
                DB::raw("count(carpeta) as adq"),
                DB::raw("DATE_FORMAT(fechaInicial,'%Y') as anyo")
            )
                ->orderBy('anyo', 'DESC')
                ->join('areas', 'planadquisiciones.area_id', '=', 'areas.id')
                ->groupBy('anyo')->take(12)->get();

            // Accede a los datos de la relación
            foreach ($adquisiciones3 as $adq) {
                // $area = $adq->area; // "area" es el nombre del método de relación en el modelo Planadquisicione
                // $nombreArea = $area->nomarea; // Accede a los campos de la relación (ejemplo: "nomarea")
                $fechaInicial = $adq->fechaInicial;
                // Puedes usar $nombreArea en tu lógica aquí
            }

            $carpetas = [];

            foreach ($adquisiciones2 as $adq) {
                // $nombreArea = $adq->area->nomarea;
                $fechaInicial = $adq->fechaInicial;
                $carpetas[] = ['name' => $adq->carpeta, 'description' => $adq->$fechaInicial];
            }



            $adquisicionesSeries = Planadquisicione::where('user_id', auth()->user()->id)->select(
                'segmento_id',
                DB::raw('count(*) as adq'),
                // DB::raw('MAX(areas.nomarea) as area_name'),
                DB::raw('MAX(segmentos.detsegmento) as serie_name'),
                // ->groupby(DB::raw("carpeta"))
                // ->pluck('count')
                // DB::raw("DATE_FORMAT(fechaInicial,'%M %Y') as anyo"),
                DB::raw("count(carpeta) as adq")
            )
                ->join('segmentos', 'planadquisiciones.segmento_id', '=', 'segmentos.id') // Realiza una join con la tabla de áreas
                // DB::raw("count(area_id) as area_adq"))
                // DB::raw("DATE_FORMAT(fechaInicial,'%M %Y') as anyo"))
                ->groupBy(DB::raw("segmento_id"))
                ->get();
            // Accede a los datos de la relación
            foreach ($adquisicionesSeries as $adq) {
                $segmento = $adq->segmento; // "area" es el nombre del método de relación en el modelo Planadquisicione
                $nombreSerie = $segmento->detsegmento; // Accede a los campos de la relación (ejemplo: "nomarea")
                // Puedes usar $nombreArea en tu lógica aquí
            }

            $carpetas = [];

            foreach ($adquisiciones2 as $adq) {
                $nombreArea = $adq->area->nomarea;
                $carpetas[] = ['name' => $adq->carpeta, 'y' => floatval($nombreArea)];
            }

            $adquisicionesDependencia = Planadquisicione::select(
                'areas.dependencia_id', // Seleccionamos dependencia_id a través de áreas
                DB::raw('count(*) as adq'), // Contamos las adquisiciones
                DB::raw('MAX(dependencias.nomdependencia) as dependencia_name'), // Nombre de la dependencia
                DB::raw("count(planadquisiciones.carpeta) as adq") // Contamos la cantidad de 'carpeta'
            )
                ->join('areas', 'planadquisiciones.area_id', '=', 'areas.id') // Unimos con la tabla 'areas' usando 'area_id'
                ->join('dependencias', 'areas.dependencia_id', '=', 'dependencias.id') // Unimos 'areas' con 'dependencias' usando 'dependencia_id'
                ->groupBy('areas.dependencia_id') // Agrupamos por 'dependencia_id'
                ->get();

            // Acceder a los datos
            foreach ($adquisicionesDependencia as $adq) {
                $dependencia = $adq->dependencia_name; // Nombre de la dependencia
                $cantidadAdquisiciones = $adq->adq; // Cantidad de adquisiciones
                // Aquí puedes utilizar $dependencia y $cantidadAdquisiciones
            }
        }




        return view("home", ["data" => json_encode($carpetas)], compact('users', 'actos', 'products', 'clases', 'segmentos', 'familias', 'adquisiciones', 'adquisicionesSeries', 'adquisicionesDependencia', 'adquisiciones1',  'adquisiciones3', 'dependencias', 'areas', 'planes'));
    }
}
