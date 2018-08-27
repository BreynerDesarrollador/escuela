<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstitucionController extends Controller
{
    //
    public function index(Request $request)
    {
        $opcion = $request->input('opcion');
        if ($opcion == "datosinstitucion") {
            $datos = Institucion::where("usuario", Auth::user()->id)->get();
        } else
            $datos = Institucion::where('usuario', '=', Auth::user()->id)->get();

        return response()->json($datos);
    }

    public function store(Request $request)
    {

        $this->validar($request);

        $save = new Institucion();

        $save->usuario = Auth::user()->id;
        $this->guardar($save, $request);

        return response()->json('Datos registrados exitosamente');
    }

    public function validar(Request $request)
    {
        $request->validate(["nombre" => "required", "nit" => "required", "rector" => "required", "codigo_dane" => "required"
            , "direccion" => "required", "telefono" => "required", "celular" => "required",
            "num_estudiantes" => "required", "type" => "required"]);
    }

    public
    function guardar(Institucion $save, Request $request)
    {
        $save->nombre = $request->input('nombre');
        $save->nit = $request->input('nit');
        $save->rector = $request->input('rector');
        $save->codigo_dane = $request->input('codigo_dane');
        $save->direccion = $request->input('direccion');
        $save->telefono = $request->input('telefono');
        $save->celular = $request->input('celular');
        $save->num_estudiantes = $request->input('num_estudiantes');
        $save->type = $request->input('type');

        $save->save();
    }

    public
    function edit(Request $request, $institucion)
    {
        $ins = Institucion::find($institucion);

        return response()->json($ins);
    }

    public
    function update(Request $request, Institucion $institucion)
    {
        $this->validar($request);

        $this->guardar($institucion, $request);

        return response()->json(true);
    }

    public function destroy(Request $request, $institucion)
    {
        $dele = Institucion::find($institucion);
        $dele->delete();

        return response()->json(true);
    }
}
