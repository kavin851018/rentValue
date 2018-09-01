<?php

namespace App\Myweb\Entity;
use Illuminate\Database\Eloquent\Model;

class NewUser extends Model{

	protected $table = 'users';
	protected $primaryKey = 'id';
	protected $fillable=[
		"email",
		"password",
		"select",
	];


}