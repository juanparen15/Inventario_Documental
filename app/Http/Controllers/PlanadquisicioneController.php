<?php

namespace App\Http\Controllers;

use App\Planadquisicione;
use App\Requipoai;
use App\Area;
use App\Familia;
use App\Requiproyecto;
use App\Fuente;
use App\User;
use App\Mese;
use App\Modalidade;
use App\Estadovigencia;
use App\Exports\PlanadquisicioneAllExport;
use App\Exports\PlanadquisicioneExport;
use App\Producto;
use App\Segmento;
use App\Tipoadquisicione;
use App\TipoOtro;
use App\Tipoprioridade;
use App\Tipozona;
use App\Tipoproceso;
use App\Vigenfutura;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PlanadquisicioneController extends Controller
{
    public function __construct()
    {

        $this->middleware([
            'auth',
            // $this->middleware('role:supervisor', ['only' => ['index']]),
            // 'permission:planadquisiciones.index',
            // 'permission:supervisor.planadquisiciones.index',
        ]);
    }

    public function showOnlyAdmin()
    {
        $adminId = auth()->user()->id;
        $planadquisiciones = Planadquisicione::where('user_id', $adminId)->get();
        session()->put('showOnlyAdmin', true);

        return view('admin.planadquisiciones.index', compact('planadquisiciones'));
    }

    public function index()
    {

        // $user = auth()->user();
        // if ($user->hasRole('Admin')) {
        //     $planadquisiciones = Planadquisicione::get();
        // } else {
        //     $planadquisiciones = Planadquisicione::where('area_id', $user->area_id)->get();
        // }


        // if (session('showOnlyAdmin')) {
        //     $adminId = auth()->user()->id;
        //     $planadquisiciones = Planadquisicione::where('user_id', $adminId)->get();
        //     // $planadquisiciones = Planadquisicione::where('user_id', auth()->user()->id)->get();
        //     session()->forget('showOnlyAdmin');
        // } else {
        //     $planadquisiciones = Planadquisicione::get();
        //     $planadquisiciones = Planadquisicione::where('user_id', auth()->user()->id)->get();
        // }

        // $minutes = 60; //  duración de la caché en minutos
        if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Supervisor')) {
            // $planadquisiciones = Planadquisicione::get();
            $planadquisiciones = Planadquisicione::paginate(13);
            // $planadquisiciones = Cache::remember('planadquisiciones', $minutes, function () {
            //     return Planadquisicione::get();
            // });
            // $planadquisiciones = [];

            // Planadquisicione::chunk(200, function ($resultados) use (&$planadquisiciones) {
            //     $planadquisiciones = array_merge($planadquisiciones, $resultados->toArray());
            // });


            // $planadquisiciones = Cache::remember('planadquisiciones', $minutes, function () {
            //     return Planadquisicione::get();
            // });

            // $planadquisiciones = Planadquisicione::limit(50)->get();
            // $planadquisiciones = Planadquisicione::where('user_id', auth()->user()->id)->get();
        } else {
            // $planadquisiciones = Planadquisicione::where('user_id', auth()->user()->id)->limit(13)->get();
            // $planadquisiciones = Planadquisicione::where('user_id', auth()->user()->id)->get();
            $planadquisiciones = Planadquisicione::where('user_id', auth()->user()->id)->paginate(13);
            // $planadquisiciones = Planadquisicione::get();
        }
        return view('admin.planadquisiciones.index', compact('planadquisiciones'));
    }

    public function indexByArea($areaId)
    {
        $areas = Area::findOrFail($areaId);
        $planadquisiciones = Planadquisicione::where('area_id', $areaId)->get();

        return view('admin.planadquisiciones.index', compact('planadquisiciones', 'areas'));
    }




    public function create()
    {

        $userArea = auth()->user()->area; // Obtener el área asociada al usuario
        $segmentos = Segmento::get();
        $familias = Familia::get();
        $modalidades = Modalidade::get();
        $areas = collect([$userArea]); // Crear una colección con el área del usuario
        $fuentes = Fuente::get();
        $requiproyectos = Requiproyecto::get();
        $tipoprioridades = Tipoprioridade::get();
        $requipoais = Requipoai::get();
        $tipoOtros = TipoOtro::get();
        $requiproyectos = Requiproyecto::where('areas_id', auth()->user()->area->id)->pluck('detproyecto', 'id');

        return view('admin.planadquisiciones.create', compact('requipoais', 'modalidades', 'familias', 'segmentos', 'areas', 'fuentes', 'requiproyectos', 'tipoprioridades', 'tipoOtros'));
    }



    public function store(Request $request)
    {
        // $request->validate([
        //     'caja' => ['required'],
        //     'nombre_unidad' => ['required'],
        //     'carpeta' => ['required'],
        //     'tomo' => ['required'],
        //     'folio' => ['required'],
        //     'nota' => ['required'],
        //     'modalidad_id' => ['required'],
        //     'segmento_id' => ['required'],
        //     'familias_id' => ['required'],
        //     // 'fuente_id' => ['required'],
        //     'tipoprioridade_id' => ['required'],
        //     'requiproyecto_id' => ['required'],
        //     'fechaInicial' => ['required', 'date_format:d/m/Y'],
        //     'fechaFinal' => ['required', 'date_format:d/m/Y', 'after_or_equal:fechaInicial'],
        //     'requipoais_id' => ['required'],
        //     'area_id' => ['required'],
        //     'archivo_pdf' => ['nullable', 'file', 'mimes:pdf', 'max:5120'], // Validar archivo PDF
        // ]);

        // Convertir el array de checkboxes en una cadena separada por comas
        $soporteFormato = $request->input('soporte_formato', []);
        $soporteFormatoString = implode(', ', $soporteFormato);

        $slug = Str::slug($request->nota);

        // Verificar si ya existe un Inventario con el mismo slug
        $counter = 1;
        while (Planadquisicione::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->nota . '-' . $counter, '-');
            $counter++;
        }

        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = Planadquisicione::max('id') + 1;
        $slugWithId = $slug . '-' . $ultimoId;

        // Manejar archivo PDF
        $archivoPdfPath = null;
        if ($request->hasFile('archivo_pdf')) {
            try {
                $archivoPdfPath = $request->file('archivo_pdf')->store('archivos_pdf');
            } catch (\Exception $e) {
                Log::error('Error al subir el archivo PDF: ' . $e->getMessage());
                return back()->withErrors(['error' => 'Error al subir el archivo PDF.']);
            }
        }

        // Manejo de fechas, considerando "S.F."
        $fechaInicial = $request->input('fechaInicial');
        $fechaFinal = $request->input('fechaFinal');

        // Validar fechas
        if ($fechaInicial === 'S.F.') {
            $fechaInicial = 'S.F.'; // O puedes decidir cómo almacenarlo
        } else {
            // Convertir la fecha inicial de d/m/Y a Y-m-d
            try {
                $fechaInicial = \Carbon\Carbon::createFromFormat('d/m/Y', $fechaInicial)->format('Y-m-d');
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'Formato de fecha inicial inválido.']);
            }
        }

        if ($fechaFinal === 'S.F.') {
            $fechaFinal = 'S.F.'; // O puedes decidir cómo almacenarlo
        } else {
            // Convertir la fecha final de d/m/Y a Y-m-d
            try {
                $fechaFinal = \Carbon\Carbon::createFromFormat('d/m/Y', $fechaFinal)->format('Y-m-d');
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'Formato de fecha final inválido.']);
            }
        }

        // Crear el registro en la base de datos
        Planadquisicione::create([
            'nombre_unidad' => $request->input('nombre_unidad'),
            'soporte_formato' => $soporteFormatoString,
            'caja' => $request->input('caja'),
            'carpeta' => $request->input('carpeta'),
            'tomo' => $request->input('tomo'),
            'folio' => $request->input('folio'),
            'nota' => $request->input('nota'),
            'modalidad_id' => $request->input('modalidad_id'),
            'segmento_id' => $request->input('segmento_id'),
            'familias_id' => $request->input('familias_id'),
            'fuente_id' => $request->input('fuente_id'),
            'tipo_id' => $request->input('tipo_id'),
            'tipoprioridade_id' => $request->input('tipoprioridade_id'),
            'requiproyecto_id' => $request->input('requiproyecto_id'),
            'fechaInicial' => $fechaInicial,
            'fechaFinal' => $fechaFinal,
            'requipoais_id' => $request->input('requipoais_id'),
            'area_id' => $request->input('area_id'),
            'user_id' => auth()->user()->id,
            'slug' => $slugWithId,
            'archivo_pdf' => $archivoPdfPath, // Agregar ruta del archivo PDF
        ]);

        return redirect()->route('planadquisiciones.index')->with('flash', 'registrado');
    }



    // public function show(Planadquisicione $inventario)
    // {
    //     return view('admin.planadquisiciones.show', compact('inventario'));
    // }

    public function show(Planadquisicione $inventario)
    {
        $planadquisicione = Planadquisicione::with('user', 'requiproyecto', 'requipoais', 'tipoprioridade', 'area', 'segmento', 'modalidad', 'familias')
            ->find($inventario);

        return view('admin.planadquisiciones.show', compact('inventario'));
    }

    // Controlador para Editar un Plan de Adquisiciones
    public function edit(Planadquisicione $inventario)
    {
        // dd($inventario->soporte_formato);

        // Obtener el área del usuario asociado al inventario
        $userArea = $inventario->user->area;

        // Obtener todos los datos relacionados
        $segmentos = Segmento::get();
        $familias = Familia::get();
        $modalidades = Modalidade::get();
        $fuentes = Fuente::get();
        $tipoprioridades = Tipoprioridade::get();
        $requipoais = Requipoai::get();
        $tipoOtros = TipoOtro::get();

        // Obtener los proyectos del área del usuario autenticado
        $requiproyectos = Requiproyecto::where('areas_id', auth()->user()->area->id)->pluck('detproyecto', 'id');

        // Formatear las fechas para pasarlas a la vista
        // $inventario->fechaInicial = \Carbon\Carbon::createFromFormat('Y-m-d', $inventario->fechaInicial)->format('d/m/Y');
        // $inventario->fechaFinal = \Carbon\Carbon::createFromFormat('Y-m-d', $inventario->fechaFinal)->format('d/m/Y');

        // Devolver la vista con los datos
        return view('admin.planadquisiciones.edit', compact(
            'requipoais',
            'modalidades',
            'familias',
            'segmentos',
            'fuentes',
            'requiproyectos',
            'tipoprioridades',
            'inventario',
            'userArea',
            'tipoOtros'
        ));
    }

    // Controlador para Actualizar un Plan de Adquisiciones
    public function update(Request $request, Planadquisicione $inventario)
    {
        // Combinar los valores de soporte_formato en una cadena separada por comas
        $soporte_formato = implode(',', $request->input('soporte_formato', []));

        // Formatear las fechas desde el formato d/m/Y a Y-m-d
        $fechaInicial = \Carbon\Carbon::createFromFormat('d/m/Y', $request->fechaInicial)->format('Y-m-d');
        $fechaFinal = \Carbon\Carbon::createFromFormat('d/m/Y', $request->fechaFinal)->format('Y-m-d');

        // Crear un slug único basado en la nota
        $slug = Str::slug($request->nota);
        $counter = 1;
        while (Planadquisicione::where('slug', $slug)->where('id', '<>', $inventario->id)->exists()) {
            $slug = $slug . '-' . $counter;
            $counter++;
        }

        // Agregar el último ID al slug para asegurar unicidad
        $ultimoId = Planadquisicione::max('id');
        $slugWithId = $slug . '-' . $ultimoId;

        // Manejar la carga y eliminación del archivo PDF
        $archivoPdfPath = $inventario->archivo_pdf; // Mantener el archivo existente si no se actualiza
        if ($request->hasFile('archivo_pdf')) {
            try {
                // Eliminar el archivo existente si lo hay
                if ($archivoPdfPath) {
                    Storage::delete($archivoPdfPath);
                }
                // Subir el nuevo archivo y almacenar la ruta
                $archivoPdfPath = $request->file('archivo_pdf')->store('archivos_pdf');
            } catch (\Exception $e) {
                Log::error('Error al subir el archivo PDF: ' . $e->getMessage());
                return back()->withErrors(['error' => 'Error al subir el archivo PDF.']);
            }
        }

        // Actualizar el registro del inventario
        $inventario->update([
            'nombre_unidad' => $request->input('nombre_unidad'),
            'soporte_formato' => $soporte_formato,
            'caja' => $request->input('caja'),
            'carpeta' => $request->input('carpeta'),
            'tomo' => $request->input('tomo'),
            'folio' => $request->input('folio'),
            'nota' => $request->input('nota'),
            'modalidad_id' => $request->input('modalidad_id'),
            'segmento_id' => $request->input('segmento_id'),
            'familias_id' => $request->input('familias_id'),
            'fuente_id' => $request->input('fuente_id'),
            'tipo_id' => $request->input('tipo_id'),
            'tipoprioridade_id' => $request->input('tipoprioridade_id'),
            'requiproyecto_id' => $request->input('requiproyecto_id'),
            'fechaInicial' => $fechaInicial,
            'fechaFinal' => $fechaFinal,
            'requipoais_id' => $request->input('requipoais_id'),
            'area_id' => $request->input('area_id'),
            'user_id' => auth()->user()->id,
            'slug' => $slugWithId,
            'archivo_pdf' => $archivoPdfPath, // Actualizar la ruta del archivo PDF
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('planadquisiciones.index')->with('flash', 'actualizado');
    }



    public function destroy(Planadquisicione $planadquisicion)
    {
        $planadquisicion->delete();
        return redirect()->route('planadquisiciones.index')->with('flash', 'eliminado');
    }

    // public function retirar_producto(Planadquisicione $planadquisicione,Producto $producto){
    //     $producto_id = $producto->id;

    //     $planadquisicione->productos()->detach($producto_id);
    //     return redirect()->route('planadquisiciones.show', $planadquisicione)->with('flash','actualizado');
    // }

    public function exportar_planadquisiciones_excel(Planadquisicione $planadquisicion)
    {

        return Excel::download(new PlanadquisicioneExport($planadquisicion->id), 'Inventario Documental - ' . $planadquisicion->id . '.xlsx');
        // 
        // plan_de_adquisicion 
    }
    // public function agregar_producto(Planadquisicione $planadquisicion)
    // {
    //     $segmentos = Segmento::all();
    //     return view('admin.planadquisiciones.agregar_producto', compact('planadquisicion', 'segmentos'));
    // }
    // public function agregar_producto_store(Request $request, Planadquisicione $planadquisicion)
    // {
    //     $planadquisicion->productos()->attach($request->producto_id);
    //     return redirect()->route('planadquisiciones.show', $planadquisicion)->with('flash', 'actualizado');
    // }
    public function export()
    {



        return Excel::download(new PlanadquisicioneAllExport, 'Inventario Documental en General.xlsx');
    }

    // public function chart()
    // {
    //     $planadquisiciones = Planadquisicione::select(\DB::raw("COUNT(*) as count"))
    //         ->whereYear('created_at', date('Y'))
    //         ->groupBy(\DB::raw("Second(created_at)"))
    //         ->pluck('count');
    //     return view('planadquisiciones.chart', compact('planadquisiciones'));
    // }
}
