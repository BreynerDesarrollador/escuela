<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 21 Aug 2018 14:06:23 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PermissionUser
 * 
 * @property int $id
 * @property int $permission_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Permission $permission
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class PermissionUser extends Eloquent
{
	protected $table = 'permission_user';

	protected $casts = [
		'permission_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'permission_id',
		'user_id'
	];

	public function permission()
	{
		return $this->belongsTo(\App\Models\Permission::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
