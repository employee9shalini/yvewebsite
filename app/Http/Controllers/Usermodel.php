<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
//use app/config/database.php;
class Usermodel extends Model
{

    public function checkAuthentication($request)
    {
        // Do something with $request
        echo 'model';
        //return $request;
    }

}