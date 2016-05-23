<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Database\Eloquent\Model;
use Input;
use Request;
use App\Usermodel;
//use app/config/database.php;
class Login extends Controller
{

	public function loginPage(){

		 $data = Input::all();

		 // print_r($data);

		 // die();
        $admin_model = new Usermodel();
        $respose = $admin_model->checkAuthentication($data);
 			print_r($respose);
	  	die();	   

		 $view = view('layout.article')->with('article' , $article);

		return $view;

	}

	
}