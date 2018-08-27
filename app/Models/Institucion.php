<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 21 Aug 2018 14:06:23 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Institucion
 * 
 * @property int $id
 * @property string $nombre
 * @property string $nit
 * @property string $codigo_dane
 * @property string $rector
 * @property string $direccion
 * @property string $telefono
 * @property string $celular
 * @property int $num_estudiantes
 * @property int $usuario
 * @property int $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $acudientes
 * @property \Illuminate\Database\Eloquent\Collection $estudiantes
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package App\Models
 */
class Institucion extends Eloquent
{
	protected $table = 'institucion';

	protected $casts = [
		'num_estudiantes' => 'int',
		'usuario' => 'int',
		'type' => 'int'
	];

	protected $fillable = [
		'nombre',
		'nit',
		'codigo_dane',
		'rector',
		'direccion',
		'telefono',
		'celular',
		'num_estudiantes',
		'usuario',
		'type'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class, 'usuario');
	}

	public function acudientes()
	{
		return $this->hasMany(\App\Models\Acudiente::class, 'institucion');
	}

	public function estudiantes()
	{
		return $this->hasMany(\App\Models\Estudiante::class, 'institucion');
	}

	public function users()
	{
		return $this->belongsToMany(\App\Models\User::class)
					->withPivot('id');
	}
}
