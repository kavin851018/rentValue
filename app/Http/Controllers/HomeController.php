<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Myweb\Entity\NewObject;

class HomeController extends Controller
{

    //
    public function indexPage(){
        $row_per_page = 10 ;
        $ObjectPaginate = NewObject::OrderBy('oid','desc')->paginate($row_per_page);

        $binding = [
            'ObjectPaginate'=>$ObjectPaginate
        ];
        return view('/allObject',$binding);
    }
}
