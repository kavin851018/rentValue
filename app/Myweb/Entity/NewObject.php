<?php

namespace App\Myweb\Entity;

use Illuminate\Database\Eloquent\Model;

class NewObject extends Model{
    protected $table ='object';
    protected $primaryKey = 'oid';

    protected $fillable = [
        "price",
        "description",
    ];

    public function images(){
        return $this->hasMany('App\Myweb\Entity\NewImage','objectId');
    }
}


?>