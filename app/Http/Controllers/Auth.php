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
use Session;
//use App/config/session.php;

class Auth extends Controller
{


  public function login(){


    if (Session::has('user_id')) {

        return view('layout.index');
      

}else{

        return view('layout.login');
       }

   }


	public function usersPage(){


		// $users = DB::table('admin_panel_user')
  //           ->InnerJoin('admin_panel_user_type', 'admin_panel_user.user_type_id', '=', 'admin_panel_user_type.user_type_id')
  //           ->get();
		
		// print_r($users);
		// die;
		 $users = DB::table('admin_panel_user')->select('user_id', 'user_full_name', 'email_id', 'user_type_id', 'mobile_no', 'photo','recent_login_date', 'create_date_time')->get();
	

		 $view = view('layout.user')->with('users_detail', $users);

		return $view;

	}

	public function usersFilter(){

    // Getting all post data
   
      $data = Input::all();

      $type = $data['type'];
      $active = $data['active'];

      	if($active == 'all'){

      		$data = DB::table('admin_panel_user')->select('user_id', 'user_full_name', 'email_id', 'user_type_id', 'mobile_no', 'photo','recent_login_date', 'create_date_time')->where('user_type_id', $type)->get();

      			$view = view('layout.user')->with('users_detail', $data);

      			return $view;
      	}else{


      		$data = DB::table('admin_panel_user')->select('user_id', 'user_full_name', 'email_id', 'user_type_id', 'mobile_no', 'photo','recent_login_date', 'create_date_time')->where('user_type_id', $type)->where('active_flag', $active)->get();

      		$view = view('layout.user')->with('users_detail', $data);

      		return $view;
      		
      	}


}
}