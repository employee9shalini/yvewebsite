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
//use app/config/database.php;
class Wittymessage extends Controller
{

	public function wittymessagePage(){


    $witty_message = DB::table('witty_message')
            ->Join('wm_time_slab', 'witty_message.time_slab', '=', 'wm_time_slab.time_slab')->orderBy('wm_time_slab.id', 'asc')
            ->get();
    // echo '<pre>';
    // print_r($witty_message);
    // die;

		
		  //$witty_message = DB::table('witty_message')->select('msg_id', 'witty_message', 'time_slab', 'active_flag')->get();
	   
     //print_r($witty_message);
     

		 $view = view('layout.wittymessage')->with('witty_message', $witty_message);

		return $view;

	}

	
}