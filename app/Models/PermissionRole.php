<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 21 Aug 2018 14:06:23 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PermissionRole
 * 
 * @property int $id
 * @property int $permission_id
 * @property int $role_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Permission $permission
 * @property \App\Models\Role $role
 *
 * @package App\Models
 */
class PermissionRole extends Eloquent
{
	protected $table = 'permission_role';

	protected $casts = [
		'permission_id' => 'int',
		'role_id' => 'int'
	];

	protected $fillable = [
		'permission_id',
		'role_id'
	];

	public function permission()
	{
		return $this->belongsTo(\App\Models\Permission::class);
	}

	public function role()
	{
		return $this->belongsTo(\App\Models\Role::class);
	}
}
