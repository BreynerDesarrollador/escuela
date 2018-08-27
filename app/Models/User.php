<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 21 Aug 2018 14:06:23 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $nombre
 * @property string $apellido
 * @property string $celular
 * @property string $email
 * @property string $password
 * @property string $type
 * @property int $user
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $institucions
 * @property \Illuminate\Database\Eloquent\Collection $permissions
 * @property \Illuminate\Database\Eloquent\Collection $roles
 *
 * @package App\Models
 */
class User extends Eloquent
{
	protected $casts = [
		'user' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'nombre',
		'apellido',
		'celular',
		'email',
		'password',
		'type',
		'user',
		'remember_token'
	];

	public function institucions()
	{
		return $this->belongsToMany(\App\Models\Institucion::class)
					->withPivot('id');
	}

	public function permissions()
	{
		return $this->belongsToMany(\App\Models\Permission::class)
					->withPivot('id')
					->withTimestamps();
	}

	public function roles()
	{
		return $this->belongsToMany(\App\Models\Role::class)
					->withPivot('id')
					->withTimestamps();
	}
}
