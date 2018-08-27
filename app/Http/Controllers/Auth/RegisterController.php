<?php

namespace App\Http\Controllers\Auth;

use App\Models\Institucion;
use App\Models\RoleUser;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home/app';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'name' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'celular' => 'required|numeric|min:10',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['nombre'] . ' ' . $data['apellido'],
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'celular' => $data['celular'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            "imagen" => "images/avatar3.png",
            'type' => 0,
            'user' => 0
        ]);
        //Le asignamos el rol
        $rol = new RoleUser();
        $rol->user_id = $user->id;
        $rol->role_id = 1;
        $rol->save();

        return $user;
    }

    protected function registerinstitucion(array $datos)
    {
        return Institucion::create([
            "nombre" => $datos['nombre'],
            "nit" => $datos["nit"],
            "codigo_dane" => 0,
            "rector" => "",
            "direccion" => "",
            "usuario" => 0,
            "type" => 0
        ]);
    }
}
