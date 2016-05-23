<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use DateTime;
//use app/config/database.php;
class loaddata extends Model
{

    public function getcoachdata()
{

    $res = DB::table('users')->select('first_name', 'last_name', 'email_id', 'category_id', 'profile_pic')->where('approval_flag', '1')->where('user_type_id','2')->get();
    $trcoach = '';

    foreach ($res as $r) {
        //$name = $r->first_name . " " . $r->last_name;
        $name = $r->first_name ;
        $category_id = $r->category_id;
        $emailid=$r->email_id;
        $img = $r->profile_pic;
        $catarr = explode(',', $category_id);
        $catname = '';
        foreach ($catarr as $cat) {
            if ($cat != '') {
                $catarr = DB::table('categories')->select('category_name')->where('category_id', $cat)->first();

                $catname1=$catarr->category_name;
                $catname = $catname . $catname1 . ",";

            }

        }


        if ($img == '') {
            $img = "images/default_profile.png";
        }
        $trcoach = $trcoach . ' <li alt="' . $catname . '"  ><div><a alt='.$emailid.' class=showprofile><span class="label">' . $name . '</span><img style="height:168px;width:155px;" src="' . $img . '" ></a></div></li>';

    }
    return $trcoach ;
}


    public function getclientdata($email)
    {

        $coach_id=$this->getuserid($email);

        $r=DB::table('slots')->select('client_user_id')->where('coach_user_id',$coach_id)->get();


          $trclient = '';

        foreach ($r as $r1) {

            $client_id=$r1->client_user_id;

            $res = DB::table('users')->select('first_name', 'last_name', 'user_id', 'profile_pic')->where('approval_flag', '1')->where('user_type_id','1')->where('user_id',$client_id)->first();

            $name = '';
            $userid = '';
            $img = '';

            if($res) {
                //$name = $res->first_name . " " . $res->last_name;
                $name = $res->first_name ;
                $userid = $res->user_id;
                $img = $res->profile_pic;
            }

            if ($img == '') {
                $img = "images/default_profile.png";
            }
            $trclient = $trclient . ' <li alt="' . $userid . '" class=showprofile><div><a><span class="label">' . $name . '</span><img style="height:168px;width:155px;" src="' . $img . '" ></a></div></li>';

        }
        return $trclient ;
    }

    public function getclientdatabyadmin()
    {
        $trclient='';
        $r = DB::table('users')->select('first_name', 'last_name', 'user_id', 'profile_pic')->where('approval_flag', '1')->where('user_type_id','1')->get();
        $client_id='';
        $name = '';
        $userid = '';
        $img = '';
        foreach ($r as $r1) {

            $client_id=$r1->user_id;
            $name = $r1->first_name . " " . $r1->last_name;
            $userid = $r1->user_id;
            $img = $r1->profile_pic;

            if ($img == '') {
                $img = "images/default_profile.png";
            }
            $trclient = $trclient . ' <li alt="' . $userid . '" class=showclientprofile><div><a><span class="label">' . $name . '</span><img style="height:168px;width:155px;" src="' . $img . '" ></a></div></li>';


        }

            return $trclient;

    }


    public function getclientprofile($uid)
    {

        $res = DB::table('users')->select('first_name', 'last_name', 'contact', 'profile_pic','about_info','email_id')->where('approval_flag', '1')->where('user_type_id','1')->where('user_id',$uid)->first();
        $trclient = '';

            $fname = $res->first_name;
        $lname=$res->last_name;
            $emailid=$res->email_id;
            $img = $res->profile_pic;
        $contact=$res->contact;
        $about=$res->about_info;

            if ($img == '') {
                $img = "images/default_profile.png";
            }

        $trclient=$fname."#".$lname."#".$contact."#".$img."#".$about."#".$emailid;



        return $trclient ;
    }


public function getcategories()
{
    $res = DB::table('categories')->select('category_name','category_id')->get();

    return json_encode($res);

}

    public function getlanguages()
    {
        $res = DB::table('language_list')->select('lang_id','lang_text')->get();

        return json_encode($res);

    }

    public function getslotinfo($email,$timezone)
    {
        $slots=array();
        $user_id=$this->getuserid($email);
        $r = DB::table('slots')->select('slot_id','start_datetime','end_datetime','client_user_id')->where('coach_user_id', $user_id)->where('booked_flag','1')->get();
        $name ='';
        $qb_login = '';
        $qb_id = '';

        foreach ($r as $obj) {
            if ($obj != '') {

                $client_id = $obj->client_user_id;
                $data = $this->getuserdata($client_id);
                $dataarr = explode("#", $data);
                $name = $dataarr[0];
                $qb_login = $dataarr[1];
                $qb_id = $dataarr[2];
                if ($name == '#') {
                    $name = '';
                }
                $slot_id = $obj->slot_id;
                $start_time = $this->ConvertGMTToLocalTimezone($obj->start_datetime,$timezone);
                $end_time = $this->ConvertGMTToLocalTimezone($obj->end_datetime,$timezone);


                $res['id'] = $slot_id;
                $res['start'] = $start_time;
                $res['end'] = $end_time;
                $res['title'] = $name;
                $res['allday'] = true;
                $res['backgroundColor'] = '#AC8F7B';
                $res['borderColor'] = '#AC8F7B';
                $res['booked_flag'] = '1';
                $res['user_id'] = $client_id;
                $res['qb_login'] = $qb_login;
                $res['qb_id'] = $qb_id;


                array_push($slots, $res);


            }
        }
            $r2 = DB::table('slots')->select('slot_id','start_datetime','end_datetime','client_user_id')->where('coach_user_id', $user_id)->where('booked_flag','0')->get();
            foreach ($r2 as $obj2) {
                if ($obj2 != '') {

                    $client_id2 = $obj2->client_user_id;
                    $name2='';
                    $qb_login2='';
                    $qb_id2='';
                    if($client_id2!='0' ) {

                        $data2 = $this->getuserdata($client_id2);
                        $dataarr2 = explode("#", $data2);
                        $name2 = $dataarr[0];
                        $qb_login2 = $dataarr[1];
                        $qb_id2 = $dataarr[2];
                    }
                    if ($name2 == '#') {
                        $name2 = '';
                    }
                    $slot_id2 = $obj2->slot_id;
                    $start_time2 = $this->ConvertGMTToLocalTimezone($obj2->start_datetime,$timezone);
                    $end_time2 = $this->ConvertGMTToLocalTimezone($obj2->end_datetime,$timezone);


                    $res1['id'] = $slot_id2;
                    $res1['start'] = $start_time2;
                    $res1['end'] = $end_time2;
                    $res1['title'] = $name2;
                    $res1['allday'] = true;
                    $res1['backgroundColor']='#FFFFFF';
                    $res1['textColor']='#C3AE9F';
                    $res1['borderColor']='#C3AE9F';
                    $res1['booked_flag'] = '0';
                    $res1['user_id'] = $client_id2;
                    $res1['qb_login'] = $qb_login2;
                    $res1['qb_id'] = $qb_id2;


                    array_push($slots, $res1);


                }
            }



        $r3= DB::table('slots')->select('slot_id','start_datetime','end_datetime','client_user_id')->where('coach_user_id', $user_id)->where('booked_flag','2')->get();
        foreach ($r3 as $obj3) {
            if ($obj3 != '') {

                $client_id3 = $obj3->client_user_id;
                $name3='';
                $qb_login3='';
                $qb_id3='';
                if($client_id3!='0' ) {

                    $data3 = $this->getuserdata($client_id3);
                    $dataarr3 = explode("#", $data2);
                    $name3 = $dataarr3[0];
                    $qb_login3 = $dataarr3[1];
                    $qb_id3 = $dataarr3[2];
                }
                if ($name3 == '#') {
                    $name3 = '';
                }
                $slot_id3 = $obj3->slot_id;
                $start_time3= $this->ConvertGMTToLocalTimezone($obj3->start_datetime,$timezone);
                $end_time3 = $this->ConvertGMTToLocalTimezone($obj3->end_datetime,$timezone);


                $res3['id'] = $slot_id3;
                $res3['start'] = $start_time3;
                $res3['end'] = $end_time3;
                $res3['title'] = $name3;
                $res3['allday'] = true;
                $res3['backgroundColor']='gray';
                $res3['textColor']='#C3AE9F';
                $res3['borderColor']='#C3AE9F';
                $res3['booked_flag'] = '2';
                $res3['user_id'] = $client_id3;
                $res3['qb_login'] = $qb_login3;
                $res3['qb_id'] = $qb_id3;


                array_push($slots, $res3);


            }
        }


        return json_encode($slots);

    }

    public function getuserid($email) {
       $res= DB::table('users')->select('user_id')->where('email_id', $email)->first();

        $user_id=$res->user_id;

        return $user_id;
    }

    public function getprimg($email) {
    $res= DB::table('users')->select('profile_pic')->where('email_id', $email)->first();

    $pic=$res->profile_pic;

    return $pic;
}

    public function getprdata($email) {
        $res= DB::table('users')->select('first_name','last_name','user_id','category_id','profile_pic','gender','dob','language','intro_video','about_info','contact','bank_name','account_number','bic')
            ->where('email_id', $email)->where('approval_flag', '1')->where('user_type_id', '2')->first();

        $d='';
        $fname='';
        $lname='';
        $user_id='';
        $category_id='';
        $catarr='';
        $catname = '';
        $gender ='';
        $dob ='';
        $language='';
        $about_info = '';
        $contact = '';
        $bankname = '';
        $account_number = '';
        $bic = '';
        $cat='';
        $langname = '';
        $langname1='';
        $langarr='';

if($res) {
    $fname = $res->first_name;
    $lname = $res->last_name;
    $user_id = $res->user_id;
    $category_id = $res->category_id;
    $catarr = explode(',', $category_id);
    $catname = '';
    foreach ($catarr as $cat) {
        if ($cat != '') {
            $catarr = DB::table('categories')->select('category_name')->where('category_id', $cat)->first();

            $catname1 = $catarr->category_name;


            $catname = $catname . $catname1 . ",";
        }

    }

    $img = $res->profile_pic;;
    if ($img == '') {
        $img = "http://yve.ibuildmart.in/images/default_profile.png";
    }


    $gender = $res->gender;
    $dob = $res->dob;
    $language = $res->language;
    $contact = $res->contact;
    $about_info = $res->about_info;
    $bankname = $res->bank_name;
    $account_number = $res->account_number;
    $bic = $res->bic;

    $langarr = explode(',', $language);


    foreach ($langarr as $lang) {
        if ($lang != '') {
            $l = DB::table('language_list')->select('lang_id')->where('lang_text', $lang)->first();
            $langname1 = $l->lang_id;
            $langname = $langname . $langname1 . ",";

        }

    }

}
        $d=$fname."#".$lname."#".$catname."#".$category_id."#".$contact."#".$gender."#".$dob."#".$language."#".$about_info."#".$img."#".$user_id."#".$bankname."#".$account_number."#".$bic."#".$langname;

        return $d;

    }

    public function getreviews($email) {

        $coach_id=$this->getuserid($email);

        $res= DB::table('reviews')->select('review_id','client_user_id','review','rating')
            ->where('coach_user_id', $coach_id)->where('publish_flag', '1')->get();

        $d='';
        $client_name = 'u';
        $client_pic='';
$ratings='';
        foreach ($res as $obj) {
            if ($obj != '') {
                $review_id = $obj->review_id;
                $client_user_id = $obj->client_user_id;
                $review = $obj->review;
                $rating = $obj->rating;

                $dataarr = DB::table('users')->select('first_name','last_name','profile_pic')->where('user_id', $client_user_id)->first();

                $fname = $dataarr->first_name;
                $lname = $dataarr->last_name;
                $profile_pic = $dataarr->profile_pic;
                $client_name=$fname."".$lname;
$rlist='';
                $client_pic=$profile_pic;

                    for($i=1;$i<=$rating;$i++)
                    {
                        $rlist=$rlist.'<input type="radio"  class="rating" value="'.$i.'"  checked="checked"/>';

                    }

$ratings=$rlist;
                if ($client_pic == '') {
                    $img = "http://yve.ibuildmart.in/images/default_profile.png";
                }

                $d=$d.'<div id="ratingdiv"><ul align="center" id="rating"><li><div class="leftrate" ><a><span class="label">'.$client_name.'</span><img style="height:168px;width:155px;" src='.$client_pic.' > </a></div><div  class="rightrate"><p class="reviewheader">My Rating</p>
<div class="reviewcontent">'.$review.'</div><div class="cornerdiv"><section class="container">'.$ratings.'</section></div></div></li></ul></div>';



            }
        }



                return $d ;


    }

    public function getfinancialdetails($email) {

    $coach_id=$this->getuserid($email);

    $res= DB::table('slots')->select('slot_id')
        ->where('coach_user_id', $coach_id)->where('booked_flag', '2')->get();

    $d='';
    foreach ($res as $obj) {
        if ($obj != '') {
            $slot_id = $obj->slot_id;

            $dataarr = DB::table('sessions')->select('session_id', 'client_user_id', 'start_datetime', 'end_datetime')->where('slot_id', $slot_id)->first();

            $session_id = $dataarr->session_id;
            $client_id = $dataarr->client_user_id;
            $start_dt = $dataarr->start_datetime;
            $end_dt = $dataarr->end_datetime;

            $sdate1=date_create($start_dt);
            $edate1=date_create($end_dt);

            $interval = date_diff($sdate1, $edate1);
            $h= $interval->format('%H:%i');
            //$m=$h*(int)60;

            $dataarr2 = DB::table('users')->select('first_name', 'last_name')->where('user_id', $client_id)->first();

            $fname = $dataarr2->first_name;
            $lname = $dataarr2->last_name;
            $name = $fname . "" . $lname;
            if (trim($start_dt) != '0000-00-00 00:00:00') {
                $dataarr3 = DB::table('payments')->select('payment_status','amount')->where('session_id', $session_id)->first();
                $payment_status = $dataarr3->payment_status;
                $paystatus='';
                if($payment_status=='F')
                {
                    $paystatus='Pending';
                }

                if($payment_status=='S')
                {
                    $paystatus='Paid';
                }

                $amount = $dataarr3->amount;

                $dt = strtotime($start_dt);
                $sdt=date('d-m-Y',$dt);


                $d=$d.'<tr class="tblrow"><td class="">'.$sdt.'</td><td>'.$name.'</td>
<td>'.$h.'</td><td>$'.$amount.',00</td><td>'.$paystatus.'</td></tr>';
            }
        }
//var_dump($dataarr3);



    }
    return  $d;


}

    public function getappointdata() {

        $res= DB::table('sessions')->select('session_id','start_datetime','end_datetime','coach_user_id','client_user_id')->get();

        $session_id = '';
        $client_id = '';
        $coach_id ='';
        $start_dt = '';
        $end_dt = '';
$d='';
        $sdt='';
        $dt='';
        $coach_fname = '';
        $coach_lname = '';
        $coach_name = '';


        foreach ($res as $obj) {
            if ($obj != '') {

                $session_id = $obj->session_id;
                $client_id = $obj->client_user_id;
                $coach_id = $obj->coach_user_id;
                $start_dt = $obj->start_datetime;
                $end_dt = $obj->end_datetime;

                if (trim($start_dt) != '0000-00-00 00:00:00' && trim($end_dt) != '0000-00-00 00:00:00' ) {

                    $sdate1 = date_create($start_dt);
                    $edate1 = date_create($end_dt);
                    $interval = date_diff($sdate1, $edate1);
                    $h = $interval->format('%H:%i');
                    $dataarr = DB::table('users')->select('first_name', 'last_name')->where('user_id', $client_id)->first();

                    $client_fname = $dataarr->first_name;
                    $client_lname = $dataarr->last_name;
                    $client_name = $client_fname . " " . $client_lname;

                    $dataarr2 = DB::table('users')->select('first_name', 'last_name')->where('user_id', $coach_id)->first();
if($dataarr2) {
    $coach_fname = $dataarr2->first_name;
    $coach_lname = $dataarr2->last_name;
    $coach_name = $coach_fname . " " . $coach_lname;
}
                   $dt = strtotime($start_dt);
                    $sdt=date('d-m-Y',$dt);

                    $d=$d.'<tr class="tblrow"><td class="">'.$session_id.'</td><td>'.$sdt.'</td>
<td>'.$h.'</td>><td>'.$coach_name.'</td><td>'.$client_name.'</td></tr>';


                }


            }


        }

return $d;
            }

    public function gettimelinedetails($coach_email,$client_email)
    {
$d='';
        $coach_id = $this->getuserid($coach_email);

        $client_id=$this->getuserid($client_email);

        $data = $this->getuserdata($coach_id);
        $dataarr = explode("#", $data);
        $name = $dataarr[0];

        $res= DB::table('sessions')->select('session_id','start_datetime','notes')
            ->where('coach_user_id', $coach_id)->where('client_user_id', $client_id)->get();

        foreach ($res as $obj) {
            if ($obj != '') {
                $session_id = $obj->session_id;
                $start_dt = $obj->start_datetime;
                $notes = $obj->notes;
                if (trim($start_dt) != '0000-00-00 00:00:00') {
                    $dt = strtotime($start_dt);
                    $sdt=date('l jS F Y',$dt);

                    $sdt2=date('jS F Y',$dt);

                    $d = $d . '<div class="cd-timeline-block"><div class="cd-timeline-img cd-picture"></div><div class="cd-timeline-content"><h6>' . $sdt . '</h6><p class="appointtext">Appointment made with ' . $name . ' for ' . $sdt2 . '.</p></div></div><div class="cd-timeline-block"><div class="cd-timeline-img cd-picture"></div><div class="cd-timeline-content"><h6>' . $sdt . '</h6><h2>' . $name . '</h2><p class="notestext">' . $notes . '</p></div></div>';
                }
            }

        }

        if($d!='')
        {
            $d='<section id="cd-timeline" class="cd-container">'.$d.'</section>';
        }

        return $d;
            }


        public function getcost($email) {

        $coach_id=$this->getuserid($email);

        $res= DB::table('sessions')->select('session_id')
            ->where('coach_user_id', $coach_id)->get();

        $d='';
        $payment_date = '';
        $amount='';

        foreach ($res as $obj) {
            if ($obj != '') {
                $session_id = $obj->session_id;

                $dataarr = DB::select("SELECT MONTH(payment_date) as dt, SUM(AMOUNT) as amt FROM payments where YEAR(payment_date)='2016' and payment_status='S' GROUP BY MONTH(payment_date);");


                }

            }


        if($dataarr)
        {
       // foreach($dataarr as $arr) {

           // $payment_date = $arr->dt;

           // $amount = $arr->amt;
           // $d = $d . '<tr class="tblrow"><td class="">' . $payment_date . '</td><td>' . $amount . '</td></tr>';

        //}
            $d=$dataarr;

        }
        return  json_encode($d);


    }

    public function getuserdata($user_id) {
        $res= DB::table('users')->select('first_name','last_name','qb_login','qb_id')->where('user_id', $user_id)->first();

        $name ='';
        $qb_login = '';
        $qb_id = '';

if($res) {
    $fname = $res->first_name;
    $lname = $res->last_name;
    $name = $fname . " " . $lname;
    $qb_login = $res->qb_login;
    $qb_id = $res->qb_id;
}
        return $name."#".$qb_login."#".$qb_id;
    }

    public function getcoaches()
{
    $trcoach='';
    $res= DB::table('users')->select('first_name','last_name','email_id','user_id')->where('user_type_id', '2')->get();

    foreach ($res as $r) {
        if ($r != '') {

            $fname=$r->first_name;
            $lname=$r->last_name;
            $name=$fname." ".$lname;
            $email_id=$r->email_id;
            $user_id=$r->user_id;

            $trcoach=$trcoach. '<tr class="tblrow"><td class="">'.$name.'</td><td>'.$email_id.'</td><td>coach</td><td><a  alt='.$email_id.' class=delete><img alt='.$email_id.' src=images/delete.png height=20></a></td></tr>';


        }

    }

    return $trcoach;
}


    public function getdclientdata()
    {
        $trcoach='';
        $res= DB::table('users')->select('first_name','last_name','email_id','user_id')->where('user_type_id', '1')->get();

        foreach ($res as $r) {
            if ($r != '') {

                $fname=$r->first_name;
                $lname=$r->last_name;
                $name=$fname." ".$lname;
                $email_id=$r->email_id;
                $user_id=$r->user_id;

                $trcoach=$trcoach. '<tr class="tblrow"><td class="">'.$name.'</td><td>'.$email_id.'</td><td>client</td><td><a  alt='.$email_id.' class=delete><img alt='.$email_id.' src=images/delete.png height=20></a></td></tr>';


            }

        }

        return $trcoach;
    }

    public function getclients()
    {
        $trclient='';
        $res= DB::table('users')->select('first_name','last_name','email_id','user_id')->where('user_type_id', '1')->get();

        foreach ($res as $r) {
            if ($r != '') {

                $fname=$r->first_name;
                $lname=$r->last_name;
                $name=$fname." ".$lname;
                $email_id=$r->email_id;
                $user_id=$r->user_id;

                $trclient=$trclient. '<tr class="tblrow"><td class="">'.$name.'</td><td>'.$email_id.'</td><td>coach</td><td><a  alt='.$email_id.' class=delete><img alt='.$email_id.' src=images/delete.png height=20></a></td></tr>';


            }

        }

        return $trclient;
    }

    public function getactivecoaches()
    {
        $tractive='';
        $res= DB::table('users')->select('first_name','last_name','email_id','user_type_id','user_id')->where('user_type_id', '2')->where('approval_flag', '1')->get();

        foreach ($res as $r) {
            if ($r != '') {

                $fname=$r->first_name;
                $lname=$r->last_name;
                $name=$fname."".$lname;
                $type=$r->user_type_id;
                $user_id=$r->user_id;
                $email_id=$r->email_id;

                $tractive=$tractive. '<tr class="tblrow"><td class="">'.$name.'</td><td>'.$email_id.'</td><td>coach</td><td><a  alt='.$email_id.' class=inactive><img alt='.$email_id.' src=images/reject.png height=20></a></td></tr>';


            }

        }

        return $tractive;
    }

    public function getinactivecoaches()
    {
        $trinactive = '';

        $res= DB::table('users')->select('first_name','last_name','email_id','user_type_id','user_id')->where('user_type_id', '2')->where('approval_flag', '0')->get();

        foreach ($res as $r) {
            if ($r != '') {

                $fname=$r->first_name;
                $lname=$r->last_name;
                $name=$fname."".$lname;
                $type=$r->user_type_id;
                $user_id=$r->user_id;
                $email_id=$r->email_id;

                $trinactive=$trinactive. '<tr class="tblrow"><td class="">'.$name.'</td><td>'.$email_id.'</td><td>coach</td><td><a  alt='.$email_id.' class=active><img alt='.$email_id.' src=images/thumbs.png height=20></a></td></tr>';


            }

        }



        return $trinactive;
    }
    public function ConvertGMTToLocalTimezone($gmttime, $timezoneRequired)
    {

        $system_timezone = date_default_timezone_get();

        date_default_timezone_set("GMT");
        $gmt = date("Y-m-d H:i:s");

        $local_timezone = $timezoneRequired;
        date_default_timezone_set($local_timezone);
        $local = date("Y-m-d H:i:s");

        date_default_timezone_set($system_timezone);
        $diff = (strtotime($local) - strtotime($gmt));

        $date = new DateTime($gmttime);
        $date->modify("+$diff seconds");

        $timestamp = $date->format("Y-m-d H:i:s");
        return $timestamp;

        //return $date;
    }

}


