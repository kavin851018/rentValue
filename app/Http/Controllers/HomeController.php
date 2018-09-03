<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Myweb\Entity\NewObject;
use App\Myweb\Entity\NewValue;
use DB;

class HomeController extends Controller
{

    //
    public function indexPage(Request $request){
        $row_per_page = 12 ;
//        $ObjectPaginate = NewObject::OrderBy('oid','desc')->paginate($row_per_page);


        $keyword = $request->input('description');
        if($keyword!=""){
	        $ObjectAll =   NewObject::OrderBy('oid','desc')->where('description','like','%'.$keyword.'%')->paginate($row_per_page);
        }
        else{
	        $ObjectAll = NewObject::OrderBy('oid','desc')->paginate($row_per_page);
        }


        foreach($ObjectAll as $object){

            $images=NewObject::find($object->oid)->images()->get();
            $object->images = $images;
            $object->firstImage = $images->get('0');
            $lowerAvg = DB::table('value')->where('oid',$object->oid)->avg('lowerPrice');
            $higherAvg = DB::table('value')->where('oid',$object->oid)->avg('higherPrice');
            $object->lowerAvg=number_format($lowerAvg);
            $object->higherAvg=number_format($higherAvg);

        }


        $binding = [
            'ObjectAll'=>$ObjectAll,
	        'keyword'=>$keyword
        ];
        return view('/index',$binding);
    }
    public function sendValue(Request $request){

        try{
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

            $newValue = new NewValue;
            $newValue -> oid = $toDB['oid'];
            $newValue -> lowerPrice = $toDB['lowerPrice'];
            $newValue -> HigherPrice = $toDB['HigherPrice'];
            $newValue -> save();

            $lowerAvg = DB::table('value')->where('oid',$toDB['oid'])->avg('lowerPrice');
            $higherAvg = DB::table('value')->where('oid',$toDB['oid'])->avg('higherPrice');
            $realValue = DB::table('object')->where('oid',$toDB['oid'])->pluck('price');


            $data['amount']=$request->amount;
            $data['success']=true;
            $data['new']=$new;
            $data['lowerAvg']=number_format($lowerAvg);
            $data['higherAvg']=number_format($higherAvg);
            $data['realValue']=$realValue;


            echo json_encode($data);
        }
        catch(\Exeption $e){
            $data['success']=false;
            echo json_encode($data);
        }




    }

    public function searchPage(Request $request){
		$description = $request->input('description');

		$result =   NewObject::OrderBy('oid','desc')->where('description','like','%'.$description.'%')->get();
//		echo $description;
//		print($result);


		$binding = ["result"=>$result];

     	return view('search',$binding);
	}


}
