<?php

namespace App\Myweb\Entity;

use Illuminate\Database\Eloquent\Model;

class NewImage extends Model{
    protected $table ='newimage';
    protected $primaryKey = 'iid';

    protected $fillable = [
        "objectId",
        "imagePath",
    ];
}


?>