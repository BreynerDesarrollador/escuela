<?php

namespace App\Http\Controllers;

use App\Models\Acudiente;
use Illuminate\Http\Request;

class AcudienteController extends Controller
{
    //
    public function index(Request $request)
    {
        $institucion = $request->input('institucion');
        $datos = Acudiente::where("institucion", $institucion)->get();

        return response()->json($datos);
    }

    public function store(Request $request)
    {
        $this->validar($request);

        $acu = new Acudiente();
        $this->guardar($request, $acu);

        return response()->json(true);
    }

    public function guardar(Request $request, Acudiente $acu)
    {
        $acu->nombre = $request->input('nombre');
        $acu->segundo_nombre = $request->input('segundo_nombre');
        $acu->apellido = $request->input('apellido');
        $acu->segundo_apellido = $request->input('segundo_apellido');
        $acu->lugar_nacimiento = $request->input('lugar_nacimiento');
        $acu->fecha_nacimiento = $request->input('fecha_nacimiento');
        $acu->direccion = $request->input('direccion');
        $acu->ocupacion = $request->input('ocupacion');
        $acu->parentesco = $request->input('parentesco');
        $acu->telefono = $request->input('telefono');
        $acu->celular = $request->input('celular');
        $acu->email = $request->input('email');
        $acu->institucion = $request->input('institucion');
        $acu->save();
    }

    public function validar(Request $request)
    {
        $request->validate(["nombre" => "required", "apellido" => "required", "segundo_apellido" => "required",
            "lugar_nacimiento" => "required", "fecha_nacimiento" => "required", "direccion" => "required",
            "ocupacion" => "required", "parentesco" => "required", "telefono" => "required",
            "celular" => "required", "email" => "required"]);
    }

    public function edit(Request $request, $acudiente)
    {
        $datos = Acudiente::find($acudiente);

        return response()->json($datos);
    }

    public function update(Request $request, $acudiente)
    {
        $this->validar($request);
        $acu = Acudiente::find($acudiente);
        $this->guardar($request, $acu);

        return response()->json(true);
    }

    public function destroy(Request $request, $acudiente)
    {
        $eli = Acudiente::find($acudiente);
        $eli->delete();

        return response()->json(["id" => $acudiente, "index" => $request->input('index')]);
    }
}
