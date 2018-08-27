<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 21 Aug 2018 14:06:23 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class InstitucionUser
 * 
 * @property int $id
 * @property int $institucion_id
 * @property int $user_id
 * 
 * @property \App\Models\Institucion $institucion
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class InstitucionUser extends Eloquent
{
	protected $table = 'institucion_user';
	public $timestamps = false;

	protected $casts = [
		'institucion_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'institucion_id',
		'user_id'
	];

	public function institucion()
	{
		return $this->belongsTo(\App\Models\Institucion::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
