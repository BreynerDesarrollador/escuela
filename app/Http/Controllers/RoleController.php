<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Permission;
use App\Models\PermissionRole;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function index(Request $request)
    {
        $opcion = $request->input('opcion');
        $datos = [];
        if ($opcion == "permiso")
            $datos = Permission::all();
        elseif ($opcion == "roles")
            $datos = Role::all();
        elseif ($opcion == "obtenerdatospermisosrol")
            $datos = PermissionRole::join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
                ->join('roles', 'roles.id', '=', 'permission_role.role_id')
                ->select('permissions.id as permisoid', 'roles.id as roleid', 'roles.name as permisonombre',
                    'permissions.name', 'permissions.slug', 'permissions.description')
                ->get();
        else
            $datos = Role::all();

        return response()->json($datos);
    }

    public function store(Request $request)
    {
        $opcion = $request->input('opcion');

        $request->validate(["name" => "required"]);
        $role = [];
        if ($opcion == "permiso")
            $role = new Permission();
        else
            $role = new Role();

        $role->name = $request->input('name');
        $role->slug = $request->input('slug');
        $role->description = $request->input('description');
        $role->save();

        return response()->json(true);
    }

    public function savepermisorol(Request $request)
    {
        $permisos = $request->input('permisos');
        $role = $request->input('roles');

        $rol = Role::find($role);
        $rol->syncPermissions($permisos);
        $rol->save();

        return response()->json(true);
    }

    public function destroy(Request $request, $role)
    {
        $rol = $request->input('role');
        $permiso = $request->input('permiso');
        $opcion = $request->input('opcion');
        if ($opcion == "eliminarpermisorol") {
            $eli = Role::find($rol);
            $eli->perms()->sync($permiso);
        }

        return response()->json(['rol' => $rol, "permiso" => $permiso]);
    }
}
