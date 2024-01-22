<?php

namespace App\Http\Controllers;

use App\Area;
use App\Familia;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function obtener_familias(Request $request)
    {
        if ($request->ajax()) {
            try {
                // Mensajes de depuración
            // dd($request->segmento_id);
                $familias = Familia::where('segmento_id', $request->segmento_id)->get();
                return response()->json($familias);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
    public function obtener_codigo(Request $request)
    {
        if ($request->ajax()) {
            try{
                $area = Area::where('area_id', $request->area_id)->get();
                return response()->json($area);
            } catch (\Exception $e){
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
}
