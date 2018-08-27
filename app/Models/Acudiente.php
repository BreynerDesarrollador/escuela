<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 21 Aug 2018 14:06:23 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Acudiente
 * 
 * @property int $id
 * @property string $nombre
 * @property string $segundo_nombre
 * @property string $apellido
 * @property string $segundo_apellido
 * @property string $lugar_nacimiento
 * @property \Carbon\Carbon $fecha_nacimiento
 * @property string $direccion
 * @property string $ocupacion
 * @property string $parentesco
 * @property string $telefono
 * @property string $celular
 * @property string $email
 * @property int $institucion
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $estudiantes
 *
 * @package App\Models
 */
class Acudiente extends Eloquent
{
	protected $table = 'acudiente';

	protected $casts = [
		'institucion' => 'int'
	];

	protected $dates = [
		'fecha_nacimiento'
	];

	protected $fillable = [
		'nombre',
		'segundo_nombre',
		'apellido',
		'segundo_apellido',
		'lugar_nacimiento',
		'fecha_nacimiento',
		'direccion',
		'ocupacion',
		'parentesco',
		'telefono',
		'celular',
		'email',
		'institucion'
	];

	public function institucion()
	{
		return $this->belongsTo(\App\Models\Institucion::class, 'institucion');
	}

	public function estudiantes()
	{
		return $this->belongsToMany(\App\Models\Estudiante::class)
					->withPivot('id');
	}
}
