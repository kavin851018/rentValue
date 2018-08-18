<?php

namespace App\Myweb\Entity;

use Illuminate\Database\Eloquent\Model;

class NewValue extends Model{
    protected $table ='value';
    protected $primaryKey = 'vid';

    protected $fillable = [
        "oid",
        "lowerPrice",
        "higherPrice"
    ];


}


?>