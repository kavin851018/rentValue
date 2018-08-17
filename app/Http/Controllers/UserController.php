<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Validator;
use App\Myweb\Entity\NewObject;
use App\Myweb\Entity\NewImage;


class UserController extends Controller
{
    //
    public function createValuation(){

    }

    public function showUploadPage(){

        return view('upload');
    }
    public function uploadObject(Request $request){
        $object = NewObject::create($request->all());
        $lastInsertId =  $object->oid;


        if($request->hasFile('fileToUpload')){
            foreach($request->fileToUpload as $file){
                
                $filename = $file->getClientOriginalName();
                $filesize = $file->getClientSize();
//                $file->storeAs('image2',$filename);
                $path = $file->store('image');
//                print_r($filename."<br>");
//                print_r($path);
                $path="storage/".$path;
                $data = new imageTable;
                $data->objectId = $lastInsertId;
                $data->imagePath = $path;
                NewImage::create(['objectId'=>$lastInsertId,'imagePath'=>$path]);
            }
        }

        return redirect('/');
//        return 'yes';
//        $path = $request->file('fileToUpload')->store('image');
//        return $path;
    }
}

class imageTable{
    public $objectId ;
    public $imagePath ;
}