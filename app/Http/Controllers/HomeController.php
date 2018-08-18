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
    public function sendValue(Request $request){


            $amount=$request->amount;
            $new = explode("-",$amount);
            $new[0]=trim($new[0]);
            $new[1]=trim($new[1]);
            $new[0]=explode("$",$new[0])[1];
            $new[1]=explode("$",$new[1])[1];
            $new[2]=$request->oid;

            $toDB['lowerPrice']=$new[0];
            $toDB['HigherPrice']=$new[1];
            $toDB['oid']=$request->oid;


            $data['amount']=$request->amount;
            $data['success']=true;
            $data['new']=$new;

            echo json_encode($data);



    }


}
