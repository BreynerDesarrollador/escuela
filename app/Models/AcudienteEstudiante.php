<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 21 Aug 2018 14:06:23 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AcudienteEstudiante
 * 
 * @property int $id
 * @property int $estudiante_id
 * @property int $acudiente_id
 * 
 * @property \App\Models\Acudiente $acudiente
 * @property \App\Models\Estudiante $estudiante
 *
 * @package App\Models
 */
class AcudienteEstudiante extends Eloquent
{
	protected $table = 'acudiente_estudiante';
	public $timestamps = false;

	protected $casts = [
		'estudiante_id' => 'int',
		'acudiente_id' => 'int'
	];

	protected $fillable = [
		'estudiante_id',
		'acudiente_id'
	];

	public function acudiente()
	{
		return $this->belongsTo(\App\Models\Acudiente::class);
	}

	public function estudiante()
	{
		return $this->belongsTo(\App\Models\Estudiante::class);
	}
}
