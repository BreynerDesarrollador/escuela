<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 21 Aug 2018 14:06:23 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Permission
 * 
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $roles
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package App\Models
 */
class Permission extends Eloquent
{
	protected $fillable = [
		'name',
		'slug',
		'description'
	];

	public function roles()
	{
		return $this->belongsToMany(\App\Models\Role::class)
					->withPivot('id')
					->withTimestamps();
	}

	public function users()
	{
		return $this->belongsToMany(\App\Models\User::class)
					->withPivot('id')
					->withTimestamps();
	}
}
