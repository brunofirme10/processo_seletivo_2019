<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'nome', 'email', 'password', 'data_nascimento',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'data_nascimento' => 'date',
	];

	public static function criarUsuario(array $data)
	{
		return self::create($data);
	}

	public static function listarUsuario()
	{
		return self::all();
	}

	public static function atualizarUsuario(int $id, array $data)
	{
		return self::findOrFail($id)->update($data);
	}

	public static function deletarUsuario(int $id)
	{
		return self::findOrFail($id)->delete();
	}

}
