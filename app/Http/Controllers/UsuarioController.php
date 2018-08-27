<?php

namespace App\Http\Controllers;

use App\Models\InstitucionUser;
use App\Models\PermissionUser;
use App\Models\RoleUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    //
    public function index(Request $request)
    {
        $opcion = $request->input('opcion');
        $institucion = $request->input('institucion');
        $user = Auth::user()->id;
        $datos = [];
        if ($opcion == "listarusuarios")
            $datos = DB::select("call listarusuarios($user,$institucion)");
        elseif ($opcion == "actualizarshow")
            $datos = User::join("role_user", "role_user.user_id", "=", "users.id")
                ->where("users.user", Auth::user()->id)->where("users.id", $institucion)
                ->select("users.id", "users.name",'users.nombre','users.apellido','users.celular', "users.email", "role_user.role_id as role")
                ->get();
        elseif ($opcion == "datosusuariopermisos")
            $datos = PermissionUser::join("permissions", "permissions.id", "=", "permission_user.permission_id")
                ->where("user_id", $institucion)
                ->select("permission_user.id", "permissions.name", "permissions.description", "permission_user.created_at as fecha")->get();
        elseif ($opcion == "datosusuario")
            $datos = Auth::user();

        return response()->json($datos);
    }

    public function store(Request $request)
    {
        $this->validar($request);

        $user_id = $this->guardar($request, new User());

        //Asociamos la institucion con el usuario
        $ins = new InstitucionUser();
        $ins->user_id = $user_id;
        $ins->institucion_id = $request->input('institucion');
        $ins->save();

        $role = new RoleUser();
        $role->role_id = $request->input('role');
        $role->user_id = $user_id;
        $role->save();
        return response()->json(true);
    }

    public function destroy(Request $request, User $usuario)
    {
        $usuario->delete();
        return response()->json(true);
    }

    public function validar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'celular' => 'required|numeric|min:12',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            "role" => "required",
            "institucion" => "required"
        ]);
    }

    public function validarcambiarclave(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed'
        ]);
    }

    public function validaractualizar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'celular' => 'required|numeric|min:12',
            'email' => 'required|string|email|max:255|unique:users',
            "role" => "required"
        ]);
    }

    public function guardar(Request $request, User $user)
    {
        $user->name = $request->input('nombre') . ' ' . $request->input('apellido');
        $user->nombre = $request->input('nombre');
        $user->apellido = $request->input('apellido');
        $user->celular = $request->input('celular');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->type = 1;
        $user->user = Auth::user()->id;
        $user->save();

        return $user->id;
    }

    public function validarperfil(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'celular' => 'required|numeric|min:12',
            //'email' => 'required|string|email|max:255|unique:users',
        ]);
    }

    public function update(Request $request, User $usuario)
    {
        if (!empty($request->input('password'))) {
            $this->validarcambiarclave($request);
            $usuario->password = bcrypt($request->input('password'));
            $usuario->save();
        } else {
            $this->validarperfil($request);
            $usuario->name = $request->input('nombre') . ' ' . $request->input('apellido');
            $usuario->nombre = $request->input('nombre');
            $usuario->apellido = $request->input('apellido');
            $usuario->celular = $request->input('celular');
            $usuario->email = $request->input('email');
            $usuario->save();
        }

        return response()->json(true);
    }

    public function guardarimagenperfil(Request $request)
    {
        $request->validate([
            "imagen" => "required|mimes:jpeg,jpg,png|max:3500"
        ]);
        $img = Auth::user()->imagen;
        if ($img != "" && $img) {
            Storage::disk('public')->delete($img);
        }
        $imagen = $request->file('imagen');
        $ruta = Storage::disk('public')->put('images/perfil', $imagen);
        $user = User::find(Auth::user()->id);
        $user->imagen = $ruta;
        $user->save();

        return response()->json(true);
    }
}
