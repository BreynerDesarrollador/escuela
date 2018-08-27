<?php

namespace App\Http\Controllers;

use App\Models\AcudienteEstudiante;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\RequestValueResolver;

class EstudianteController extends Controller
{
    //
    public function index(Request $request)
    {
        $institucion = $request->input('institucion');
        $datos = DB::select("call estudiantes($institucion)");
        return response()->json($datos);
    }

    public function store(Request $request)
    {
        //se validan los datos
        $this->validardatos($request);

        $save = new Estudiante();
        $this->guardar($request, $save, "nuevo");

        return response()->json(["msj" => 'Se ha registrado con exito el estudiante.']);
    }

    public function validardatos(Request $request)
    {
        $request->validate(['nombre' => 'required', 'apellido' => 'required', 'segundo_apellido' => 'required'
            , 'tipo_documento' => 'required', 'documento' => 'required', 'lugar_expedicion' => 'required'
            , 'fecha_expedicion' => 'required', 'repitente' => 'required', 'direccion' => 'required'
            , 'barrio' => 'required', 'municipio' => 'required', 'departamento' => 'required'
            , 'estrato' => 'required', 'genero' => 'required', 'fecha_nac' => 'required', 'edad' => 'required'
            , 'email' => 'required', 'eps_tipo' => 'required', 'eps' => 'required', 'sisben' => 'required'
            , 'calificacion' => 'required', 'estado' => 'required', 'institucion' => "required"]);
    }

    public function guardar(Request $request, $save, $opcion)
    {
        $save->nombre = $request->input('nombre');
        $save->segundo_nombre = $request->input('segundo_nombre');
        $save->apellido = $request->input('apellido');
        $save->segundo_apellido = $request->input('segundo_apellido');
        $save->tipo_documento = $request->input('tipo_documento');
        $save->documento = $request->input('documento');
        $save->lugar_expedicion = $request->input('lugar_expedicion');
        $save->fecha_expedicion = $request->input('fecha_expedicion');
        $save->repitente = $request->input('repitente');
        $save->direccion = $request->input('direccion');
        $save->barrio = $request->input('barrio');
        $save->municipio = $request->input('municipio');
        $save->departamento = $request->input('departamento');
        $save->estrato = $request->input('estrato');
        $save->genero = $request->input('genero');
        $save->fecha_nac = $request->input('fecha_nac');
        $save->edad = $request->input('edad');
        $save->email = $request->input('email');
        $save->padre = $request->input('padre');
        $save->madre = $request->input('madre');
        $save->telefono = $request->input('telefono');
        $save->celular = $request->input('celular');
        $save->eps_tipo = $request->input('eps_tipo');
        $save->eps = $request->input('eps');
        $save->sisben = $request->input('sisben');
        $save->calificacion = $request->input('calificacion');
        $save->estado = !empty($request->input('estado')) ? $request->input('estado') : 0;
        $save->fecha_ingreso = date('Y-m-d H:i:s');
        $save->institucion = $request->input('institucion');
        //validamos la imagen

        $save->imagen = $this->validardatosimagen($request, $opcion, $save->imagen);
        $save->save();
    }

    public function validardatosimagen(Request $request, $opcion, $imagen = null)
    {
        $ruta = "";
        if ($opcion == "actualizar") {
            if ($imagen != "images/avatar1.png" && $imagen != "images/avatar2.png" && $imagen != "images/avatar3.png") {
                Storage::disk('public')->delete($imagen);
            }
        }
        if (!empty($request->file('imagen'))) {
            $ruta = $this->guardarimagen($request, 'images/estudiante/');
        } else {
            if ($request->input('genero') == "F")
                $ruta = "images/avatar1.png";
            else
                $ruta = "images/avatar2.png";
        }

        return $ruta;
    }

    public function guardarimagen(Request $request, $ruta)
    {
        /*$img = $request->input('imagen');
        //$folderPath = "images/";

        $image_parts = explode(";base64,", $img);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $file = $ruta .date('Y').date('m').date('d').date('H').date('i').date('s'). uniqid() . '.png';


        file_put_contents($file, $image_base64);
        //$ruta = Storage::disk('public')->put($ruta, $imagen);

        return $file;*/
        $this->validate($request, [
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);
        $photo = $request->file('imagen');
        $imagename = date('Y') . date('m') . date('d') . time() . uniqid() . '.' . $photo->getClientOriginalExtension();

        $destinationPath = public_path($ruta);
        $thumb_img = Image::make($photo->getRealPath())->resize(151, 189);
        $thumb_img->save($destinationPath . '/' . $imagename, 80);

        //$destinationPath = public_path('/normal_images');
        //$photo->move($destinationPath, $imagename);
        return $ruta . $imagename;
    }

    public function edit(Request $request, $estudiante)
    {
        $institucion = $request->input('institucion');

        $datos = Estudiante::where('id', $estudiante)->where('institucion', $institucion)->get();

        return response()->json($datos);
    }

    public function actualizarestudiante(Request $request, $estudiante)
    {
        //return response()->json($request->all());
        $this->validardatos($request);
        $datos = Estudiante::find($estudiante);
        $this->guardar($request, $datos, "actualizar");

        return response()->json($request->all());
    }

    public function guardaracudiente(Request $request)
    {
        $request->validate(["estudiante_id" => "required", "acudiente_id" => "required"]);
        $existe = AcudienteEstudiante::where('acudiente_id', $request->input('acudiente_id'))
            ->where("estudiante_id", $request->input('estudiante_id'))->get();
        if ($existe->count()) {
            return response()->json("El estudiante ya tiene registrado un acudiente con el id seleccionado");
        } else {
            $gua = new AcudienteEstudiante();
            $gua->acudiente_id = $request->input('acudiente_id');
            $gua->estudiante_id = $request->input('estudiante_id');
            $gua->save();

            return response()->json("OK");
        }

    }
}
