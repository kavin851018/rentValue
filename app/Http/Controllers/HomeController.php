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
        $ObjectAll = NewObject::OrderBy('oid','desc')->paginate($row_per_page);


        foreach($ObjectAll as $object){
            $images=NewObject::find($object->oid)->images()->get();
            $object->images = $images;
            $object->firstImage = $images->get('0');
        }


        $binding = [
            'ObjectAll'=>$ObjectAll,
        ];
        return view('/index',$binding);
    }


}
