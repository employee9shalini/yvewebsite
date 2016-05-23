<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Model\loaddata;
use DateTime;
//use app/config/database.php;
class slots extends Model
{

    public function makeslot($email,$sdt,$edt,$m)
    {
        $log = 'true';
        $logmsg = '';
        $u = new loaddata();
        $coach_id = $u->getuserid($email);
        $slot_id = '';
        $client_id = '';
        $start_dt = '';
        $end_dt = '';
        $r = DB::table('slots')->select('slot_id', 'start_datetime', 'end_datetime')->where('coach_user_id', $coach_id)->get();
        foreach ($r as $res) {

                $slot_id = $res->slot_id;
            $start_dt = $res->start_datetime;
            $end_dt = $res->end_datetime;


            if ($start_dt == $sdt) {

                $log = 'false';
                $logmsg = "Please start with other time slot";

            }


            if ($start_dt == $sdt && $end_dt == $edt) {

                $log = 'false';
                $logmsg = 'Same time slot for the coach already created. ';

            }


            if ($log == 'true') {
                if ($m < '45' || $m > '120') {
                    $log = 'false';
                    $logmsg = 'Time slot should be in between 45 minutes and 2 hours';
                   // $logmsg = 'Time slot should be in between one hour only';


                } else {
                    $log = 'true';
                }
            }
        }


            if ($log == 'true') {

                $result = DB::table('slots')->insert(
                    array('slot_id' => '',
                        'coach_user_id' => $coach_id,
                        'client_user_id' => '',
                        'start_datetime' => $sdt,
                        'end_datetime' => $edt,
                        'booked_flag' => '0'
                    ));

                $status = "";
                if ($result) {



                    $status = "true";
                } else {
                    $status = "false";
                }

                $res2 = DB::table('slots')->select('slot_id')->where('start_datetime', $sdt)->where('end_datetime', $edt)->where('coach_user_id', $coach_id)->first();

                $slot_id = $res2->slot_id;


            }


        if($log=='false')
        {
            $status='false';
        }

        return $slot_id."#".$status."#".$log."#".$logmsg;
    }

    public function cancelappointment($slot_id,$timezone)
    {


        $res = DB::table('slots')->select('coach_user_id','client_user_id','start_datetime','end_datetime')->where('slot_id', $slot_id)->first();

        $coach_id='';
        $client_id='';
        $start_dt='';
        $end_dt='';
if($res)
{
    $coach_id=$res->coach_user_id;
    $client_id=$res->client_user_id;
    $start_dt=$res->start_datetime;
    $end_dt=$res->end_datetime;

}
        //$sdt=$res->start_datetime;

        $result2= DB::table('slots')->where('slot_id',$slot_id )
            ->update(array('booked_flag' => '0',
                'client_user_id'=> '0'

            ));

        DB::table('sessions')->where('slot_id', $slot_id)->delete();

        $result = DB::table('slots')->insert(
            array('slot_id' => '',
                'coach_user_id' => $coach_id,
                'client_user_id' => $client_id,
                'start_datetime' => $start_dt,
                'end_datetime' => $end_dt,
                'booked_flag' => -1
            ));

        $status = "";

        if ($result) {
            $status = "true";
            $l=new loaddata();
            $data = $l->getuserdata($coach_id);

            $dataarr = explode("#", $data);
            $coach_name = $dataarr[0];
            $data1 = $l->getuserdata($client_id);

            $dataarr1 = explode("#", $data1);
            $client_name = $dataarr1[0];

            $from       =   "harvinder.kaur@agicent.com";
            $fromName   =   "YVE";
            $subject    =   $subject    =   "YVE : Appointment Cancel confirmation ";

            $l=new loaddata();
            $start_dt1=$l->ConvertGMTToLocalTimezone($start_dt,$timezone);
            $d= strtotime($start_dt1);

            $d1=  date("l jS F Y g:i a" ,$d);

            $body='<html>
    <head>
    </head>
    <body style="">
    <div style="background: #ffffff; width:600px; height:400px;position: relative">
    <div style="height: 40px;background: #E9E9E9; width:96%;padding: 2%;color:#484848; font-size: 15px; font-family: arial, helvetica, sans-serif;  border-bottom: 1px solid #c0c0c0">
    <h2>YVE</h2>
    <div style="background: #ffffff; padding:2%;width:96%; font-family: arial, helvetica, sans-serif; font-size: 13px; color:#484848">
        <p><strong>Hi</strong></p><p>Your Appointment has been canceled that was with coach <strong><span style="text-transform: capitalize">'.$coach_name.'</span></strong> on '.$d1.'. Please feel free to contact us for any future assistance.<p><br/><br/>Thanks<br/><br/><strong>Administrator</strong></p>
    </div>
</div>
<div style="position: absolute; background-color: #E9E9E9;bottom: 0; height: 40px;padding: 2%; width:96%"></div>
</div>

</body>
</html>';

            $body2='<html>
    <head>
    </head>
    <body style="">
    <div style="background: #ffffff; width:600px; height:400px;position: relative">
    <div style="height: 40px;background: #E9E9E9; width:96%;padding: 2%;color:#484848; font-size: 15px; font-family: arial, helvetica, sans-serif;  border-bottom: 1px solid #c0c0c0">
    <h2>YVE</h2>
    <div style="background: #ffffff; padding:2%;width:96%; font-family: arial, helvetica, sans-serif; font-size: 13px; color:#484848">
        <p><strong>Hi</strong></p><p>Your Appointment has been canceled that was with client <strong><span style="text-transform: capitalize">'.$client_name.'</span></strong> on '.$d1.'. Please feel free to contact us for any future assistance.<p><br/><br/>Thanks<br/><br/><strong>Administrator</strong></p>
    </div>
</div>
<div style="position: absolute; background-color: #E9E9E9;bottom: 0; height: 40px;padding: 2%; width:96%"></div>
</div>

</body>
</html>';




            $client_email='';
            $coach_email='';

            $mysql_query= DB::table('users')->select('email_id')->where('user_id', $client_id)->first();

            if($mysql_query) {
                $client_email = $mysql_query->email_id;
            }


            $mysql_query1= DB::table('users')->select('email_id')->where('user_id', $coach_id)->first();

            if($mysql_query1) {
                $coach_email = $mysql_query1->email_id;
            }

            $u=new users();
            $mail=$u->sendmail($from,$fromName,$subject,$client_email,$body);

            $mail2=$u->sendmail($from,$fromName,$subject,$coach_email,$body2);





        } else {
            $status = "false";
        }

    }


    public function updatestarttime($slotid)
    {

    $res = DB::table('sessions')->select('start_datetime')->where('slot_id', $slotid)->first();


    $sdt=$res->start_datetime;
    $status = "";
    if(trim($sdt)=='0000-00-00 00:00:00')
    {
        date_default_timezone_set('UTC');
        $sdate= date('Y-m-d H:i:s');

        $result= DB::table('sessions')->where('slot_id',$slotid )
            ->update(array('start_datetime' => $sdate

            ));


        if ($result) {
            $status = "true";
        } else {
            $status = "false";
        }

    }
return  $status;
}

    public function updateendtime($slotid)
{

    date_default_timezone_set('UTC');
    $edate= date('Y-m-d H:i:s');

    $result= DB::table('sessions')->where('slot_id',$slotid )
        ->update(array('end_datetime' => $edate

        ));

    if ($result) {
        $result2 = DB::table('slots')->where('slot_id', $slotid)
            ->update(array('booked_flag' => '2'

            ));
        if ($result2) {
            $status = "true";
        } else {
            $status = "false";
        }
    }

    return  $status;
}

    public function updatenotes($slotid,$notes)
    {

        $result= DB::table('sessions')->where('slot_id',$slotid )
            ->update(array('notes' => $notes

            ));

        if ($result) {
            $status = "true";
        } else {
            $status = "false";
        }

        return  $status;
    }

    public function updatestatus($slotid)
    {
        $result= DB::table('slots')->where('slot_id',$slotid )
            ->update(array('booked_flag' => '2'

            ));

        if ($result) {
            $status = "true";
        } else {
            $status = "false";
        }

        return  $status;
    }

    public function deleteslot($slot_id,$timezone)
    {
        $res = DB::table('slots')
            ->select('coach_user_id','start_datetime','end_datetime','booked_flag')
            ->where('slot_id', $slot_id)
            ->first();

        $coach_id='';
        $booked_flag='';
        $start_dt='';
        $end_dt='';
        $status='';
        $coach_email='';

        if($res){
            $coach_id=$res->coach_user_id;
            $booked_flag=$res->booked_flag;
            $start_dt=$res->start_datetime;
            $end_dt=$res->end_datetime;
        }

        DB::table('slots')->where('slot_id', $slot_id)->delete();

        $result = DB::table('slots')->insert(
            array('slot_id' => '',
                'coach_user_id' => $coach_id,
                'start_datetime' => $start_dt,
                'end_datetime' => $end_dt,
                'booked_flag' => -2
            ));

        if($result){
            $status="true";
            $from       =   "harvinder.kaur@agicent.com";
            $fromName   =   "YVE";
            $subject    =   $subject    =   "YVE : Available Time Slot Cancel Confirmation ";

            $l=new loaddata();
            $start_dt1=$l->ConvertGMTToLocalTimezone($start_dt,$timezone);
            $d= strtotime($start_dt1);

            $d1=  date("l jS F Y g:i a" ,$d);

            $body='<html>
						<head>
						</head>
						<body style="">
						<div style="background: #ffffff; width:600px; height:400px;position: relative">
						<div style="height: 40px;background: #E9E9E9; width:96%;padding: 2%;color:#484848; font-size: 15px; font-family: arial, helvetica, sans-serif;  border-bottom: 1px solid #c0c0c0">
						<h2>YVE</h2>
						<div style="background: #ffffff; padding:2%;width:96%; font-family: arial, helvetica, sans-serif; font-size: 13px; color:#484848">
							<p><strong>Hi</strong></p><p>Your Available Time Slot '.$d1.' for the appointment has been canceled. Please feel free to contact us for any future assistance.<p><br/><br/>Thanks<br/><br/><strong>Administrator</strong></p>
						</div>
					</div>
					<div style="position: absolute; background-color: #E9E9E9;bottom: 0; height: 40px;padding: 2%; width:96%"></div>
					</div>

					</body>
					</html>';

            $mysql_query= DB::table('users')->select('email_id')->where('user_id', $coach_id)->first();

            if($mysql_query) {
                $coach_email = $mysql_query->email_id;
            }

            $u=new users();
            $mail2=$u->sendmail($from,$fromName,$subject,$coach_email,$body);

        }
        else{
            $status='false';

        }
        return $status;
    }



}


