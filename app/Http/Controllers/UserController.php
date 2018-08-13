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
        $path = $request->file('fileToUpload')->store('image');
        return $path;
    }
}
