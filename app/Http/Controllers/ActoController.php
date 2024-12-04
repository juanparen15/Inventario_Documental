<?php

namespace App\Http\Controllers;

use App\Acto;
use App\Clase;
use App\Clasificacion;
use Illuminate\Http\Request;
use App\Http\Requests\Mese\StoreRequest;
use App\Http\Requests\Mese\UpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ActoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showOnlyAdmin()
    {
        $adminId = auth()->user()->id;
        $actos = Acto::get();
        $clasificacion = Clasificacion::get();
        session()->put('showOnlyAdmin', true);

        return view('admin.actos.index', compact('actos',  'clasificacion'));
    }

    public function index()
    {
        $actos = Acto::get();
        $clasificacion = Clasificacion::get();
        return view('admin.actos.index', compact('actos', 'clasificacion'));
    }

    public function create()
    {
        $clasificaciones = Clasificacion::all();
        return view('admin.actos.create', compact('clasificaciones'));
    }


    public function store(StoreRequest $request)
    {

        $slug = Str::slug($request->asunto);

        // Verificar si ya existe un Acto con el mismo slug
        $counter = 1;
        while (Acto::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->asunto . '-' . $counter);
            $counter++;
        }

        // Obtén el último ID en la tabla y agrega 1 para generar un número de orden único
        $ultimoId = Acto::max('id') + 1;

        // Combina el slug con el último ID
        $slugWithId = $slug . '-' . $ultimoId;

        // Asigna el slug con ID al campo slug del Acto
        $acto = new Acto();
        $acto->slug = $slugWithId;
        $acto->asunto = $request->asunto;
        // (Agrega los demás campos que sean necesarios)
        // $acto->save();

        Acto::create($request->all());
        return redirect()->route('actos.index')->with('info', 'El Acto se Creó con Exito');
    }

    public function show(Acto $acto, Clasificacion  $clasificacion)
    {
        return view('admin.actos.show', compact('acto',  'clasificacion'));
    }


    public function edit(Acto $acto, Clasificacion $clasificacion)
    {
        return view('admin.actos.show', compact('acto', 'clasificacion'));
    }


    public function update(UpdateRequest $request, Acto $acto)
    {
        $acto->update($request->all());
        return redirect()->route('actos.index')->with('info', 'El Acto se Actualizó con Exito');
    }


    public function destroy(Acto $acto)
    {
        $acto->delete();
        return redirect()->route('admin.actos.index')->with('info', 'El Acto se Eliminó con Exito');
    }
}
