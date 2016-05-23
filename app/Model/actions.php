<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
//use app/config/database.php;
class actions extends Model
{

    public function deletecoach($eid)
{

    $res =  DB::table('users')->where('email_id', $eid)->delete();
    $status='';

    if($res)
    {
        $status=true;
    }
    else
    {
        $status=false;
    }
    return $status;


}


    public function inactivatecoach($eid)
    {

        $result = DB::table('users')->where('email_id',$eid)
            ->update(array('approval_flag' => '0'

            ));

        $status='';

        if($result)
        {
            $status=true;
        }
        else
        {
            $status=false;
        }
        return $status;


    }


    public function activatecoach($eid)
    {

        $result = DB::table('users')->where('email_id',$eid)
            ->update(array('approval_flag' => '1'

            ));

        $status='';

        if($result)
        {
            $status=true;
        }
        else
        {
            $status=false;
        }
        return $status;


    }




}


