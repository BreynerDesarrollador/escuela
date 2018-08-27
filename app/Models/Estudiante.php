<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 21 Aug 2018 14:06:23 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Estudiante
 * 
 * @property int $id
 * @property string $nombre
 * @property string $segundo_nombre
 * @property string $apellido
 * @property string $segundo_apellido
 * @property int $tipo_documento
 * @property string $documento
 * @property string $lugar_expedicion
 * @property \Carbon\Carbon $fecha_expedicion
 * @property int $repitente
 * @property string $direccion
 * @property string $barrio
 * @property int $municipio
 * @property int $departamento
 * @property int $estrato
 * @property string $genero
 * @property \Carbon\Carbon $fecha_nac
 * @property int $edad
 * @property string $email
 * @property string $padre
 * @property string $madre
 * @property string $telefono
 * @property string $celular
 * @property int $eps_tipo
 * @property string $eps
 * @property int $sisben
 * @property float $calificacion
 * @property int $estado
 * @property \Carbon\Carbon $fecha_ingreso
 * @property \Carbon\Carbon $fecha_salida
 * @property int $institucion
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $acudientes
 *
 * @package App\Models
 */
class Estudiante extends Eloquent
{
	protected $table = 'estudiante';

	protected $casts = [
		'tipo_documento' => 'int',
		'repitente' => 'int',
		'municipio' => 'int',
		'departamento' => 'int',
		'estrato' => 'int',
		'edad' => 'int',
		'eps_tipo' => 'int',
		'sisben' => 'int',
		'calificacion' => 'float',
		'estado' => 'int',
		'institucion' => 'int'
	];

	protected $dates = [
		'fecha_expedicion',
		'fecha_nac',
		'fecha_ingreso',
		'fecha_salida'
	];

	protected $fillable = [
		'nombre',
		'segundo_nombre',
		'apellido',
		'segundo_apellido',
		'tipo_documento',
		'documento',
		'lugar_expedicion',
		'fecha_expedicion',
		'repitente',
		'direccion',
		'barrio',
		'municipio',
		'departamento',
		'estrato',
		'genero',
		'fecha_nac',
		'edad',
		'email',
		'padre',
		'madre',
		'telefono',
		'celular',
		'eps_tipo',
		'eps',
		'sisben',
		'calificacion',
		'estado',
		'fecha_ingreso',
		'fecha_salida',
		'institucion',
        'imagen'
	];

	public function institucion()
	{
		return $this->belongsTo(\App\Models\Institucion::class, 'institucion');
	}

	public function tipo_documento()
	{
		return $this->belongsTo(\App\Models\TipoDocumento::class, 'tipo_documento');
	}

	public function acudientes()
	{
		return $this->belongsToMany(\App\Models\Acudiente::class)
					->withPivot('id');
	}
}
