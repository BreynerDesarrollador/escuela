<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 21 Aug 2018 14:06:23 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TipoDocumento
 * 
 * @property int $id
 * @property string $nombre
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $estudiantes
 *
 * @package App\Models
 */
class TipoDocumento extends Eloquent
{
	protected $table = 'tipo_documento';

	protected $fillable = [
		'nombre'
	];

	public function estudiantes()
	{
		return $this->hasMany(\App\Models\Estudiante::class, 'tipo_documento');
	}
}
