<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UserController extends Controller
{
    //
    public function createValuation(){

    }

    public function showUploadPage(){


    }
    public function uploadObject(Request $request){

        if($request->hasFile('fileToUpload')){
            foreach($request->fileToUpload as $file){
                $filename = $file->getClientOriginalName();
                $filesize = $file->getClientSize();
                $file->storeAs('image2',$filename);
                print_r($filename."<br>");
            }
        }
        return 'yes';
//        $path = $request->file('fileToUpload')->store('image');
//        return $path;
    }
}
