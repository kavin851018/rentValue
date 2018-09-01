<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Validator;
use App\Myweb\Entity\NewObject;
use App\Myweb\Entity\NewImage;
use App\Myweb\Entity\NewUser;
use Image;
use Hash;
use DB;


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
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];//代理伺服器的使用者真實ip
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];//代理伺服器proxy的ip
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

    public function signInpage(){
    	return view('auth.signIn');
    }

    public function signInProcess(){
    	$input = request()->all();
    	$rules = [
    		'email'=>['required','max:150','email',],
		    'password'=>['required','min:6'],
	    ];

    	$validator = Validator::make($input,$rules);

    	if($validator->fails()){
    		return redirect('/user/auth/sign-in')->withErrors($validator)->withInput();
	    }

	    $User = NewUser::where('email',$input['email'])->firstOrFail();
    	$is_password_correct = Hash::check($input['password'],$User->password);
    	if(!$is_password_correct){
    		$error_message=['msg'=>['密碼驗證錯誤'],];
    		return redirect('/user/auth/sign-in')->withErrors($error_message)->withInput();
	    }

	    session()->put('user_id',$User->id);
    	return redirect()->intended('/');

    }

    public function signUpPage(){
    	return view('auth.signUp');
    }

    public function signUpProcess(){
    	$input = request()->all();

    	$rules =['email'=>['required','max:150','email',],'password'=>['required','same:password_confirmation','min:6',],'select'=>['required','in:G,A'],];
    	$validator = Validator::make($input,$rules);
    	if($validator->fails()){
    		return redirect('/user/auth/sign-up')->withErrors($validator)->withInput();
	    }

	    $input['password']=Hash::make($input['password']);

    	$NewUser = NewUser::create($input);
	    return redirect('/');
    	var_dump($input);
    	exit;

    }

    public function signOut(){
    	session()->forget('user_id');
    	return redirect('/');
    }

    public function manageObject(){
	    $row_per_page = 12 ;
	    $ObjectPaginate = NewObject::OrderBy('oid','desc')->paginate($row_per_page);
	    $ObjectAll = NewObject::OrderBy('oid','desc')->paginate($row_per_page);


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
	    ];
	    return view('manage',$binding);
    }
    public function deleteObject(){
    	$data['cool']=true;
	    echo json_encode($data);
    }
}

