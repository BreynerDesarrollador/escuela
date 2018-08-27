<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function datospermiso()
    {
        /*$datosroles = Auth::user()->roles;
        $datospermisos = Auth::user()->permissions;
        $roles = count($datosroles) > 0 ? Auth::user()->roles->pluck('name') : [];
        $permisos = count($datospermisos) > 0 ? Auth::user()->permissions->pluck('name') : [];*/

        //return response()->json(session('escuela'));
    }
}
