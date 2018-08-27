<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComboController extends Controller
{
    //
    public function index(Request $request)
    {
        $opcion = $request->input('opcion');
        $codigo=!empty($request->input('codigo'))? $request->input('codigo'):0;
        $buscar=$request->input('buscar');
        $datos = DB::select("call sp_combos('$opcion',$codigo,'$buscar')");

        return response()->json(["datos"=>$datos,"opcion"=>$opcion]);
    }
}
