<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Validator;
use App\Myweb\Entity\NewObject;
use App\Myweb\Entity\NewImage;
use Image;


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


                
//                $filename = $file->getClientOriginalName();
//                $filesize = $file->getClientSize();
//                $file->storeAs('image2',$filename);
//                $path = $file->store('image');
//                print_r($filename."<br>");
//                print_r($path);
//                $path="storage/".$path;

//                $resize = Image::make($file)->fit(1280,720)->encode('jpg');
                $resize = Image::make($file)->encode('jpg');
                $hash = md5($resize->__toString());
                $path = "storage/image/{$hash}.jpg";
                $resize->save(public_path($path));
                NewImage::create(['objectId'=>$lastInsertId,'imagePath'=>$path]);
            }
        }

        return redirect('/');
//        return 'yes';
//        $path = $request->file('fileToUpload')->store('image');
//        return $path;
    }

    public function getIP(){
        $data = array();
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        if(isset($_SERVER['REMOTE_HOST']))
	        $hostname=$_SERVER['REMOTE_HOST'];
        else
	        $hostname='UNKNOWN';

        $data['ipaddress']=$ipaddress;
        $data['hostname']=$hostname;
        return view('getIP',$data);

    }
}

