<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 21 Aug 2018 14:06:23 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class DepartamentosMunicipio
 * 
 * @property int $id
 * @property string $cod_departamento
 * @property string $cod_municipio
 * @property string $cod_poblado
 * @property string $nombre_departamento
 * @property string $nombre_municipio
 * @property string $centro_poblado
 *
 * @package App\Models
 */
class DepartamentosMunicipio extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'cod_departamento',
		'cod_municipio',
		'cod_poblado',
		'nombre_departamento',
		'nombre_municipio',
		'centro_poblado'
	];
}
