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
    $res = DB::table('users')->select('first_name', 'last_name', 'email_id', 'category_id', 'profile_pic','level_id')->where('approval_flag', '1')->where('user_type_id','2')->get();
    $trcoach = '';

    foreach ($res as $r) {

        $category_id = $r->category_id;
        $emailid=$r->email_id;
        $img = $r->profile_pic;
        $level_id = $r->level_id;
        $catarr = explode(',', $category_id);
        $catname = '';
        if($level_id == '2')
        {
           // $name = $r->first_name . " " . $r->last_name." <span style='background:#A78873; border-radius:50%; padding:2px 2px; color:#000; font-weight:bold; margin-left:2px; font-size:11px;'>+1</span>";
            $name = $r->first_name ." <span style='background:#A78873; border-radius:50%; padding:2px 2px; color:#000; font-weight:bold; margin-left:2px; font-size:11px;'>+1</span>";
        }
        elseif($level_id == '1')
        {
            //$name = $r->first_name . " " . $r->last_name." <span style='background:#A78873; border-radius:50%; padding:2px 6px; color:#000; font-weight:bold; margin-left:2px;'>+</span>" ;
            $name = $r->first_name ." <span style='background:#A78873; border-radius:50%; padding:2px 6px; color:#000; font-weight:bold; margin-left:2px;'>+</span>" ;
        }

        else
        {
            //$name = $r->first_name . " " . $r->last_name;
            $name = $r->first_name ;
        }

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

    public function getfavcoachdata($cid)
    {
        $trcoach = '';


        $res =DB::table('favourites')
            ->select('favourite_id','coach_user_id')
            ->where('favourite_flag', '1')
            ->where('client_user_id','556')
            ->get();

        foreach($res as $rs){
            $coach_id=$rs->coach_user_id;


            $fav = DB::table('users')
                ->select('first_name', 'last_name', 'email_id', 'category_id', 'profile_pic')
                ->where('approval_flag', '1')
                ->where('user_id', $coach_id)
                ->first();


            if($fav!= ''){
               // $name = $fav->first_name . " " . $fav->last_name;
                $name = $fav->first_name ;
                $category_id = $fav->category_id;
                $emailid=$fav->email_id;
                $img = $fav->profile_pic;
                $catarr = explode(',', $category_id);
                $catname = '';
                foreach ($catarr as $cat) {
                    if ($cat != '') {
                        $catarr = DB::table('categories')
                            ->select('category_name')
                            ->where('category_id', $cat)
                            ->first();

                        $catname1=$catarr->category_name;
                        $catname = $catname . $catname1 . ",";

                    }
                }


                if ($img == '') {
                    $img = "images/default_profile.png";
                }

                $trcoach = $trcoach . ' <li alt="' . $catname . '" style="float:left; margin-right:20px;"  ><div><a alt='.$emailid.' class=showprofile><span class="label">' . $name . '</span><img style="height:168px;width:155px;" src="' . $img . '" ></a></div></li>';
            }

        }

        return $trcoach ;

    }


    public function getclientdata($email)
    {

        $coach_id=$this->getuserid($email);

        $r=DB::table('slots')->select('client_user_id')->where('booked_flag','2')->where('coach_user_id',$coach_id)->distinct()->get();

          $trclient = '';

        foreach ($r as $r1) {

            $client_id=$r1->client_user_id;

            $res = DB::table('users')->select('first_name', 'last_name', 'user_id', 'profile_pic')->where('approval_flag', '1')->where('user_type_id','1')->where('user_id',$client_id)->first();

            $name = '';
            $userid = '';
            $img = '';

            if($res) {
                $name = $res->first_name . " " . $res->last_name;
                $userid = $res->user_id;
                $img = $res->profile_pic;


            if ($img == '') {
                $img = "images/default_profile.png";
            }

            if($userid!='') {
                $trclient = $trclient . ' <li alt="' . $userid . '" class=showprofile><div><a><span class="label">' . $name . '</span><img style="height:168px;width:155px;" src="' . $img . '" ></a></div></li>';
            }
        }
        }
        return $trclient ;
    }

    public function getclientdatabyadmin()
    {
        $trclient='';
        $r = DB::table('users')->select('first_name', 'last_name', 'user_id', 'profile_pic')->where('approval_flag', '1')->where('user_type_id','1')->orWhere('user_type_id','4')->get();
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

        $res = DB::table('users')->select('first_name', 'last_name', 'contact', 'profile_pic','about_info','email_id','function')->where('approval_flag', '1')->where('user_type_id','1')->where('user_type_id','4')->orwhere('user_id',$uid)->first();
        $trclient = '';
        $fname = '';
        $lname = '';
        $emailid = '';
        $img = '';
        $contact = '';
        $about ='';
        $function = '';


        if($res) {
                $fname = $res->first_name;
                $lname = $res->last_name;
                $emailid = $res->email_id;
                $img = $res->profile_pic;
                $contact = $res->contact;
                $about = $res->about_info;
                $function = $res->function;

                if ($img == '') {
                    $img = "images/default_profile.png";
                }
            }
        $trclient=$fname."#".$lname."#".$contact."#".$img."#".$about."#".$emailid."#".$function;;



        return $trclient ;
    }

    public function getcorpclientprofile($uid)
    {

        $res = DB::table('users')->select('first_name', 'last_name', 'contact', 'profile_pic','about_info','email_id','function')->where('approval_flag', '1')->where('user_type_id','4')->where('user_id',$uid)->first();
        $trclient = '';

        $fname = "";
        $lname ="";
        $emailid = "";
        $img = "";
        $contact = "";
        $about = "";
        $function="";

        if($res) {
            $fname = $res->first_name;
            $lname = $res->last_name;
            $emailid = $res->email_id;
            $img = $res->profile_pic;
            $contact = $res->contact;
            $about = $res->about_info;
            $function=$res->function;
        }
        if ($img == '') {
            $img = "images/default_profile.png";
        }

        $trclient=$fname."#".$lname."#".$contact."#".$img."#".$about."#".$emailid."#".$function;


        return $trclient ;
    }

    public function getcompanyprofile($uid)
    {

        $res = DB::table('users')->select('email_id','company', 'address', 'place', 'contact','company_contact_person','company_contact_number','vat','profile_pic')->where('approval_flag', '1')->where('user_type_id','3')->where('user_id',$uid)->first();
        $tr = '';
        $company ='';
        $adr = '';
        $place = '';
        $contact = '';
        $img ='';
        $comp_cperson = '';
        $comp_number ='';
        $vat = '';
        $email='';

if($res) {
    $company = $res->company;
    $adr = $res->address;
    $place = $res->place;
    $contact = $res->contact;
    $img = $res->profile_pic;
    $comp_cperson = $res->company_contact_person;
    $comp_number = $res->company_contact_number;
    $vat = $res->vat;
    $email=$res->email_id;

    if ($img == '') {
        $img = "images/logoplaceholder.png";
    }
}
        $tr=$company."#".$adr."#".$place."#".$img."#".$contact."#".$comp_cperson."#".$comp_number."#".$vat."#".$email;

        return $tr;
    }

    public function getcompanydata()
    {
        $trcompany='';
        $r = DB::table('users')->select('company', 'user_id', 'profile_pic')->where('approval_flag', '1')->where('user_type_id','3')->get();
        $client_id='';
        $name = '';
        $userid = '';
        $img = '';
        foreach ($r as $r1) {

            $company=$r1->company;
            $userid = $r1->user_id;
            $img = $r1->profile_pic;

            if ($img == '') {
                $img = "images/logoplaceholder.png";
            }
            $trcompany = $trcompany . ' <li alt="' . $userid . '" class=showcompprofile><div class=thumbnail align=center><img  src="'.$img.'"></div><span class="label2">' . $company . '</span></li>';


        }

        return $trcompany;

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
    $client_id='';
    $client_id3='';
    $client_id2='';
if($r) {
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
            $start_time = $this->ConvertGMTToLocalTimezone($obj->start_datetime, $timezone);
            $end_time = $this->ConvertGMTToLocalTimezone($obj->end_datetime, $timezone);


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
}
    $r2 = DB::table('slots')->select('slot_id','start_datetime','end_datetime','client_user_id')->where('coach_user_id', $user_id)->where('booked_flag','0')->get();

    if($r2) {
        foreach ($r2 as $obj2) {
            if ($obj2 != '') {

                $client_id2 = $obj2->client_user_id;
                $name2 = '';
                $qb_login2 = '';
                $qb_id2 = '';
                if ($client_id2 != '0') {

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
                $start_time2 = $this->ConvertGMTToLocalTimezone($obj2->start_datetime, $timezone);
                $end_time2 = $this->ConvertGMTToLocalTimezone($obj2->end_datetime, $timezone);


                $res1['id'] = $slot_id2;
                $res1['start'] = $start_time2;
                $res1['end'] = $end_time2;
                $res1['title'] = $name2;
                $res1['allday'] = true;
                $res1['backgroundColor'] = '#FFFFFF';
                $res1['textColor'] = '#C3AE9F';
                $res1['borderColor'] = '#C3AE9F';
                $res1['booked_flag'] = '0';
                $res1['user_id'] = $client_id2;
                $res1['qb_login'] = $qb_login2;
                $res1['qb_id'] = $qb_id2;


                array_push($slots, $res1);


            }
        }
    }
    $r3= DB::table('slots')->select('slot_id','start_datetime','end_datetime','client_user_id')->where('coach_user_id', $user_id)->where('booked_flag','2')->get();

    if($r3) {
        foreach ($r3 as $obj3) {
            if ($obj3 != '') {

                $client_id3 = $obj3->client_user_id;
                $name3 = '';
                $qb_login3 = '';
                $qb_id3 = '';
                if ($client_id3 != '0') {

                    $data3 = $this->getuserdata($client_id3);
                    $dataarr3 = explode("#", $data3);
                    $name3 = $dataarr3[0];
                    $qb_login3 = $dataarr3[1];
                    $qb_id3 = $dataarr3[2];
                }
                if ($name3 == '#') {
                    $name3 = '';
                }
                $slot_id3 = $obj3->slot_id;
                $start_time3 = $this->ConvertGMTToLocalTimezone($obj3->start_datetime, $timezone);
                $end_time3 = $this->ConvertGMTToLocalTimezone($obj3->end_datetime, $timezone);


                $res3['id'] = $slot_id3;
                $res3['start'] = $start_time3;
                $res3['end'] = $end_time3;
                $res3['title'] = $name3;
                $res3['allday'] = true;
                $res3['backgroundColor'] = 'gray';
                $res3['textColor'] = '#FFFFFF';
                $res3['borderColor'] = '#C3AE9F';
                $res3['booked_flag'] = '2';
                $res3['user_id'] = $client_id3;
                $res3['qb_login'] = $qb_login3;
                $res3['qb_id'] = $qb_id3;


                array_push($slots, $res3);


            }
        }

    }
    return json_encode($slots);

}

    public function getslotinfobyclient($email,$timezone)
    {
        $slots=array();
        $user_id=$this->getuserid($email);
        $r = DB::table('slots')->select('slot_id','start_datetime','end_datetime','coach_user_id')->where('client_user_id', $user_id)->where('booked_flag','1')->get();


        $name ='';
        $qb_login = '';
        $qb_id = '';

        foreach ($r as $obj) {
            if ($obj != '') {

                $coach_id = $obj->coach_user_id;
                $data = $this->getuserdata($coach_id);
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
                $res['user_id'] = $coach_id;
                $res['qb_login'] = $qb_login;
                $res['qb_id'] = $qb_id;

                array_push($slots, $res);


            }
        }

        $r2 = DB::table('slots')->select('slot_id','start_datetime','end_datetime','coach_user_id')->where('client_user_id', $user_id)->where('booked_flag','0')->get();
        foreach ($r2 as $obj2) {
            if ($obj2 != '') {

                $coachid2 = $obj2->coach_user_id;
                $name2='';
                $qb_login2='';
                $qb_id2='';
                if($coachid2!='0' ) {

                    $data2 = $this->getuserdata($coachid2);
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
                $res1['user_id'] = $coachid2;
                $res1['qb_login'] = $qb_login2;
                $res1['qb_id'] = $qb_id2;


                array_push($slots, $res1);


            }
        }



        return json_encode($slots);

    }

    public function getuserid($email) {
       $res= DB::table('users')->select('user_id')->where('email_id', $email)->first();

        $user_id=$res->user_id;

        return $user_id;
    }

    public function getslottime($slotid,$timezone)
    {
        $res= DB::table('slots')->select('start_datetime')->where('slot_id', $slotid)->first();

        $st=$res->start_datetime;
        $st1=$this->ConvertGMTToLocalTimezone($st,$timezone);

        $d= strtotime($st1);

        $d1=  date("l jS F Y g:i a" ,$d);

        return $d1;
    }

    public function getuserimg($email) {
        $res= DB::table('users')->select('profile_pic')->where('email_id', $email)->first();

        $pic=$res->profile_pic;

        return $pic;
    }

    public function getprimg($email) {
    $res= DB::table('users')->select('profile_pic')->where('email_id', $email)->first();

    $pic=$res->profile_pic;

    return $pic;
}

    public function getprdata($email) {
        $res= DB::table('users')->select('first_name','last_name','user_id','category_id','profile_pic','gender','dob','language','intro_video','about_info','contact','bank_name','account_number','bic','level_id')
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
        $level_id='';

if($res) {
    $fname = $res->first_name;
    $lname = $res->last_name;
    $user_id = $res->user_id;
    $category_id = $res->category_id;
    $catarr = explode(',', $category_id);
    $catname = '';
    $level_id = $res->level_id;
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
        $d=$fname."#".$lname."#".$catname."#".$category_id."#".$contact."#".$gender."#".$dob."#".$language."#".$about_info."#".$img."#".$user_id."#".$bankname."#".$account_number."#".$bic."#".$langname."#".$level_id;

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
        $client_user_id='';
        foreach ($res as $obj) {
            if ($obj != '') {
                $review_id = $obj->review_id;
                $client_user_id = $obj->client_user_id;
                $review = $obj->review;
                $rating = $obj->rating;
                $fname ='';
                $lname = '';
                $profile_pic = '';
                $client_name = '';
                $client_pic ='http://yve.ibuildmart.in/images/default_profile.png';

                $dataarr = DB::table('users')->select('first_name','last_name','profile_pic')->where('user_id', $client_user_id)->first();
if($dataarr) {
    $fname = $dataarr->first_name;
    $lname = $dataarr->last_name;
    $profile_pic = $dataarr->profile_pic;
    $client_name = $fname . "" . $lname;
    $rlist = '';
    $client_pic = $profile_pic;

    for ($i = 1; $i <= $rating; $i++) {
        $rlist = $rlist . '<input type="radio"  class="rating" value="' . $i . '"  checked="checked"/>';

    }

    $ratings = $rlist;
    if ($client_pic == '') {
        $client_pic = "http://yve.ibuildmart.in/images/default_profile.png";
    }
}
                $d=$d.'<div id="ratingdiv"><ul align="center" id="rating"><li><div class="leftrate" ><a><span class="label">'.$client_name.'</span><img style="height:168px;width:155px;" src='.$client_pic.' > </a></div><div  class="rightrate"><p class="reviewheader">My Rating</p>
<div class="reviewcontent">'.$review.'</div><div class="cornerdiv"><section class="container">'.$ratings.'</section></div></div></li></ul></div>';



            }
        }



                return $d ;


    }

    public function getclientreviews($email) {

        $client_id=$this->getuserid($email);

        $res= DB::table('reviews')->select('review_id','coach_user_id','review','rating')
            ->where('client_user_id', $client_id)->where('publish_flag', '1')->get();

        $d='';
        $coach_pic='';
        $ratings='';
        foreach ($res as $obj) {
            if ($obj != '') {
                $review_id = $obj->review_id;
                $coach_user_id = $obj->coach_user_id;
                $review = $obj->review;
                $rating = $obj->rating;

                $fname ='';
                $lname = '';
                $profile_pic = '';
                $coach_name = '';
                $coach_pic ='http://yve.ibuildmart.in/images/default_profile.png';

                $dataarr = DB::table('users')->select('first_name','last_name','profile_pic')->where('user_id', $coach_user_id)->first();
                if($dataarr) {
                    $fname = $dataarr->first_name;
                    $lname = $dataarr->last_name;
                    $profile_pic = $dataarr->profile_pic;
                    $coach_name = $fname . " " . $lname;
                    $rlist = '';
                    $coach_pic = $profile_pic;

                    for ($i = 1; $i <= $rating; $i++) {
                        $rlist = $rlist . '<input type="radio"  class="rating" value="' . $i . '"  checked="checked"/>';

                    }

                    $ratings = $rlist;
                    if ($coach_pic == '') {
                        $coach_pic = "http://yve.ibuildmart.in/images/default_profile.png";
                    }
                }
                $d=$d.'<div id="ratingdiv"><ul align="center" id="rating"><li><div class="leftrate" ><a><span class="label">'.$coach_name.'</span><img style="height:168px;width:155px;" src='.$coach_pic.' > </a></div><div  class="rightrate"><p class="reviewheader">My Rating</p>
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
        $session_id = '';
        $client_id = '';
        $start_dt = '';
        $end_dt = '';
        $sdate1 = '';
        $edate1 = '';

        foreach ($res as $obj) {
            if ($obj != '') {
                $slot_id = $obj->slot_id;

                $dataarr = DB::table('sessions')->select('session_id', 'client_user_id', 'start_datetime', 'end_datetime')->where('slot_id', $slot_id)->first();

                if($dataarr) {
                    $session_id = $dataarr->session_id;
                    $client_id = $dataarr->client_user_id;
                    $start_dt = $dataarr->start_datetime;
                    $end_dt = $dataarr->end_datetime;

                    $sdate1 = date_create($start_dt);
                    $edate1 = date_create($end_dt);

                    $interval = date_diff($sdate1, $edate1);
                    $h = $interval->format('%H:%i');

                    $fname = '';
                    $lname = '';
                    $name = '';
                    $amount = '';
                    $dt = '';
                    $sdt = '';
                    $paystatus = '';


                    if (trim($start_dt) != '0000-00-00 00:00:00') {
                        $dataarr3 = DB::table('payments')->select('payment_status', 'amount')->where('session_id', $session_id)->first();

                        if($dataarr3) {
                            $payment_status = $dataarr3->payment_status;

                            if ($payment_status == 'F') {
                                $paystatus = 'Pending';
                            }

                            if ($payment_status == 'S') {
                                $paystatus = 'Paid';
                            }

                            $amount = $dataarr3->amount;

                            $dt = strtotime($start_dt);
                            $sdt = date('d-m-Y', $dt);

                            $dataarr2 = DB::table('users')->select('first_name', 'last_name')->where('user_id', $client_id)->first();

                            if ($dataarr2) {
                                $fname = $dataarr2->first_name;
                                $lname = $dataarr2->last_name;
                                $name = $fname . " " . $lname;
                            }

                            $d = $d . '<tr class="tblrow"><td class="">' . $sdt . '</td><td>' . $name . '</td>
<td>' . $h . '</td><td>$' . $amount . ',00</td><td>' . $paystatus . '</td></tr>';

                        }



                    }

                }

                }
        }

                return  $d;


}

    public function getfinancialdetails2($email) {

        $client_id=$this->getuserid($email);

        $res= DB::table('slots')->select('slot_id')
            ->where('client_user_id', $client_id)->where('booked_flag', '2')->get();

        $d='';
        $session_id = '';
        $coach_id = '';
        $start_dt = '';
        $end_dt = '';
        $sdate1 = '';
        $edate1 = '';

        foreach ($res as $obj) {
            if ($obj != '') {
                $slot_id = $obj->slot_id;

                $dataarr = DB::table('sessions')->select('session_id', 'coach_user_id', 'start_datetime', 'end_datetime')->where('slot_id', $slot_id)->first();

                if($dataarr) {
                    $session_id = $dataarr->session_id;
                    $coach_id = $dataarr->coach_user_id;
                    $start_dt = $dataarr->start_datetime;
                    $end_dt = $dataarr->end_datetime;

                    $sdate1 = date_create($start_dt);
                    $edate1 = date_create($end_dt);

                    $interval = date_diff($sdate1, $edate1);
                    $h = $interval->format('%H:%i');

                    $fname = '';
                    $lname = '';
                    $name = '';
                    $amount = '';
                    $dt = '';
                    $sdt = '';
                    $paystatus = '';                    if (trim($start_dt) != '0000-00-00 00:00:00') {
                        $dataarr3 = DB::table('payments')->select('payment_status', 'amount')->where('session_id', $session_id)->first();

                        if($dataarr3) {
                            $payment_status = $dataarr3->payment_status;

                            if ($payment_status == 'F') {
                                $paystatus = 'Pending';
                            }

                            if ($payment_status == 'S') {
                                $paystatus = 'Paid';
                            }

                            $amount = $dataarr3->amount;

                            $dt = strtotime($start_dt);
                            $sdt = date('d-m-Y', $dt);

                            $dataarr2 = DB::table('users')->select('first_name', 'last_name')->where('user_id', $coach_id)->first();

                            if ($dataarr2) {
                                $fname = $dataarr2->first_name;
                                $lname = $dataarr2->last_name;
                                $name = $fname . " " . $lname;
                            }

                            $d = $d . '<tr class="tblrow"><td class="">' . $sdt . '</td><td>' . $name . '</td>
<td>' . $h . '</td><td>$' . $amount . ',00</td><td>' . $paystatus . '</td></tr>';

                        }



                    }

                }


            }
        }

        return  $d;


    }

    public function getallfinancialdetails() {

        $arrlen='';
        $len1='';
        $len2="";

        $res1= DB::select("SELECT count(session_id) as privateaccount, Date(payment_date) as dt, sum(amount) as amt
FROM payments WHERE payment_method_id='1' GROUP BY date(payment_date) Desc");
        $len1=count($res1);


        $res2= DB::select("SELECT count(session_id) as companyaccount, Date(payment_date) as dt, sum(amount) as amt
FROM payments WHERE payment_method_id='3' GROUP BY date(payment_date) Desc");
        $len2=count($res2);
        //print_r($len2.$len1);die;

        //print_r($res1); die;

        $pdate='';
        $company_account=0;
        $company_amount=0;

        $pdate1='';
        $private_account=0;
        $private_amount=0;
        $d='';
        $dd='';
        $amount='10';

        if($len1>$len2 || $len1==$len2)
        {
            $arrlen1=$len1;
            $arrlen2=$len2;
        }
        else
        {
            $arrlen1=$len2;
            $arrlen2=$len1;
        }

        for($i=0; $i<$arrlen1; $i++)
        {
            for($j=0; $j<$arrlen2; $j++)
            {
                $pdate=$res1[$i]->dt;
                $private_account = $res1[$i]->privateaccount;
                $private_amount = $res1[$i]->amt;
                $pdate1=$res2[$j]->dt;
                $company_account = $res2[$j]->companyaccount;
                $company_amount = $res2[$j]->amt;
                $timestamp1 = strtotime($pdate);
                // echo $timestamp1."#";
                $timestamp2 = strtotime($pdate1);
                //echo $timestamp2; die;

                if($timestamp1 < $timestamp2)
                {
                    $total_amount=$company_amount;
                    $a =  '<tr class="tblrow"><td class="">' . $pdate1 . '</td><td>' . $company_account . '</td>
	<td>0</td><td>$' . $total_amount . ',00</td></tr>';

                    if (strpos($d, $a) !== false) {
                        echo 'true';
                    }

                    else
                    {
                        $aa ='<td class="">' . $pdate1 . '</td>';
                        $c =  '<tr class="tblrow"><td class="">' . $pdate . '</td><td>0</td>
	<td>' . $private_account . '</td><td>$' . $private_amount . ',00</td></tr>';

                        if (strpos($d, $aa) !== false) {

                            $d = $d . $c;

                        }
                        else{

                            $d =  $d . $a;
                        }
                    }

                }

                elseif($timestamp1 > $timestamp2)
                {
                    $total_amount=$private_amount;

                    $d =  $d . '<tr class="tblrow"><td class="">' . $pdate . '</td><td>0</td><td>' . $private_account . '</td><td>$' . $total_amount . ',00</td></tr>';

                    break;
                }

                elseif($timestamp1 == $timestamp2)
                {
                    $total_amount=$private_amount + $company_amount;
                    $d =  $d . '<tr class="tblrow"><td class="">' . $pdate1 . '</td><td>' . $company_account . '</td>
	<td>' . $private_account . '</td><td>$' . $total_amount . ',00</td></tr>';


                }
                else
                {
                    echo "error";
                }


            }//echo 'out of loop';
            //for $j loop

        }
        //for $i loop
        return $d;
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
        $user_id = '';
        $client_fname = '';
        $client_lname = '';
        $client_name = '';
        $coach_fname = '';
        $coach_lname = '';
        $coach_name = '';
        $dataarr = '';


        foreach ($res as $obj) {
            if ($obj != '') {

                $session_id = $obj->session_id;
                $client_id = $obj->client_user_id;
                $coach_id = $obj->coach_user_id;
                $start_dt = $obj->start_datetime;
                $end_dt = $obj->end_datetime;

                if (trim($start_dt) == '0000-00-00 00:00:00' && trim($end_dt) == '0000-00-00 00:00:00' )
                {

                }

                else{echo $client_id;
                    $u=DB::table('users')->select('first_name', 'last_name')->where('user_id', $client_id)->get();
                    //print_r($u);die;
                    $dataarr = DB::table('users')->select('first_name', 'last_name','user_id')->where('user_id', $client_id)->first();
                    if($dataarr){
                        $client_fname = $dataarr->first_name;
                        $client_lname = $dataarr->last_name;
                        $client_name = $client_fname . " " . $client_lname;
                        $user_id = $dataarr->user_id;
                    }
                    if($user_id!=''){
                        $dataarr2 = DB::table('users')->select('first_name', 'last_name')->where('user_id', $coach_id)->first();
                        if($dataarr2) {
                            $coach_fname = $dataarr2->first_name;
                            $coach_lname = $dataarr2->last_name;
                            $coach_name = $coach_fname . " " . $coach_lname;
                        }
                        $sdate1 = date_create($start_dt);
                        $edate1 = date_create($end_dt);
                        $interval = date_diff($sdate1, $edate1);
                        $h = $interval->format('%H:%i');

                        $dt = strtotime($start_dt);
                        $sdt=date('d-m-Y',$dt);
                        $d=$d.'<tr class="tblrow"><td class="">'.$session_id.'</td><td>'.$sdt.'</td>
		<td>'.$h.'</td>><td>'.$coach_name.'</td><td>'.$client_name.'</td></tr>';
                    }
                    else{}
                }

            }

        }
        return $d;
    }


    public function getavailablecredits($comp_email)
    {
        $comp_id=$this->getuserid($comp_email);
        $comp_credit_qty='0';
        $credits='';
        $res=DB::table('credit_available')->select('credit_available_qty')->where('user_id', $comp_id)->first();

        if($res)
        {
            $comp_credit_qty = $res->credit_available_qty;
        }

        $credits=$credits.'<label style="font-size:60px; color:#AC8F7B; font-weight:500;" >'.$comp_credit_qty.'</label><span style="font-size:13px; font-weight:bold;">credits</span>';
        return $credits;
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
        ->where('coach_user_id', $coach_id)->where('client_user_id', $client_id)->orderBy('start_datetime', 'desc')->get();

    foreach ($res as $obj) {
        if ($obj != '') {
            $session_id = $obj->session_id;
            $start_dt = $obj->start_datetime;
            $notes = $obj->notes;
            if (trim($start_dt) != '0000-00-00 00:00:00') {
                $dt = strtotime($start_dt);
                $sdt=date('l jS F Y',$dt);

                $sdt2=date('jS F Y',$dt);

                $d = $d . '<div class="cd-timeline-block"><div class="cd-timeline-img cd-picture"></div><div class="cd-timeline-content"><h6>' . $sdt . '</h6><h2>' . $name . '</h2><p class="notestext">' . $notes . '</p></div></div>';
            }
        }

    }

    if($d!='')
    {
        $d='<section id="cd-timeline" class="cd-container">'.$d.'</section>';
    }

    return $d;
}

    public function gettimelinedetails2($client_email)
    {
        $d='';

        $client_id=$this->getuserid($client_email);
$name='';


        $res= DB::table('sessions')->select('session_id','start_datetime','notes','coach_user_id')->where('client_user_id', $client_id)->orderBy('start_datetime', 'desc')->get();

        foreach ($res as $obj) {
            if ($obj != '') {
                $session_id = $obj->session_id;
                $start_dt = $obj->start_datetime;
                $notes = $obj->notes;
                $coach_id = $obj->coach_user_id;
                $data = $this->getuserdata($coach_id);
                $dataarr = explode("#", $data);
                $name = $dataarr[0];
                if (trim($start_dt) != '0000-00-00 00:00:00') {
                    $dt = strtotime($start_dt);
                    $sdt=date('l jS F Y',$dt);

                    $sdt2=date('jS F Y',$dt);

                    $d = $d . '<div class="cd-timeline-block"><div class="cd-timeline-img cd-picture"></div><div class="cd-timeline-content"><h6>' . $sdt . '</h6><h2>' . $name . '</h2><p class="notestext">' . $notes . '</p></div></div>';
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


                $dataarr = DB::select("SELECT MONTH(payment_date) as dt, SUM(AMOUNT) as amt FROM payments where YEAR(payment_date)='2016' and payment_status='S' and coach_user_id='".$coach_id."'  GROUP BY MONTH(payment_date);");

            $d=$dataarr;

        return  json_encode($d);


    }

    public function getcost2($email) {

        $client_id=$this->getuserid($email);
$d='';

                $dataarr = DB::select("SELECT MONTH(payment_date) as dt,AMOUNT as amt FROM payments where YEAR(payment_date)='2016' and payment_status='S' and client_user_id='".$client_id."' GROUP BY MONTH(payment_date);");
                $d=$dataarr;
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

    public function getcompanies()
    {
        $trcompany='';
        $res= DB::table('users')->select('company','email_id','user_id')->where('user_type_id', '3')->get();

        foreach ($res as $r) {
            if ($r != '') {

                $cname=$r->company;
                $email_id=$r->email_id;
                $user_id=$r->user_id;

                $trcompany=$trcompany. '<tr class="tblrow"><td class="">'.$cname.'</td><td>'.$email_id.'</td><td>company</td><td><a  alt='.$email_id.' class=delete><img alt='.$email_id.' src=images/delete.png height=20></a></td></tr>';


            }

        }

        return $trcompany;
    }

    public function getdclientdata()
    {
        $trcoach='';
        $res= DB::table('users')->select('first_name','last_name','email_id','user_id')->where('user_type_id', '1')->orWhere('user_type_id', '4')->get();

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

    public function getcorpclientdata($email)
    {
        $company_id=$this->getuserid($email);
        $trcoach='';
        $res= DB::table('users')->select('first_name','last_name','email_id','user_id')->where('user_type_id', '4')->where('company_id',$company_id)->get();

        foreach ($res as $r) {
            if ($r != '') {

                $fname=$r->first_name;
                $lname=$r->last_name;
                $name=$fname." ".$lname;
                $email_id=$r->email_id;
                $user_id=$r->user_id;

                $trcoach=$trcoach. '<tr class="tblrow"><td class="">'.$name.'</td><td>'.$email_id.'</td><td>Colleague</td><td><a  alt='.$email_id.' class=delete><img alt='.$email_id.' src=images/delete.png height=20></a></td></tr>';


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

    public function getallcorpclientdata($email)
    {
        $trclient='';
        $company_id=$this->getuserid($email);

        $res= DB::table('users')->select('first_name','last_name','email_id','user_id','profile_pic')->where('user_type_id', '4')->where('company_id', $company_id)->where('approval_flag', '1')->get();

        foreach ($res as $r) {
            if ($r != '') {

                $fname=$r->first_name;
                $lname=$r->last_name;
                $name=$fname." ".$lname;
                $email_id=$r->email_id;
                $user_id=$r->user_id;
                $img=$r->profile_pic;
                if ($img == '') {
                    $img = "images/default_profile.png";
                }

                $trclient = $trclient . ' <li ><div><a alt='.$user_id.' class=showclientprofile><span class="label">' . $name . '</span><img style="height:168px;width:155px;" src="' . $img . '" ></a></div></li>';

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
                $name=$fname." ".$lname;
                $type=$r->user_type_id;
                $user_id=$r->user_id;
                $email_id=$r->email_id;

                $tractive=$tractive. '<tr class="tblrow"><td class="">'.$name.'</td><td>'.$email_id.'</td><td>coach</td><td><a  alt='.$email_id.' class=inactive><img alt='.$email_id.' src=images/reject.png height=20></a></td></tr>';


            }

        }

        return $tractive;
    }

    public function getactiveclients()
    {
        $tractive='';
        $res= DB::table('users')->select('first_name','last_name','email_id','user_type_id','user_id')->where('user_type_id', '1')->orWhere('user_type_id', '4')->where('approval_flag', '1')->get();

        foreach ($res as $r) {
            if ($r != '') {

                $fname=$r->first_name;
                $lname=$r->last_name;
                $name=$fname." ".$lname;
                $type=$r->user_type_id;
                $user_id=$r->user_id;
                $email_id=$r->email_id;

                $tractive=$tractive. '<tr class="tblrow"><td class="">'.$name.'</td><td>'.$email_id.'</td><td>client</td><td><a  alt='.$email_id.' class=inactive><img alt='.$email_id.' src=images/reject.png height=20></a></td></tr>';


            }

        }

        return $tractive;
    }

    public function getactivecorpclients($email)
    {
        $company_id=$this->getuserid($email);
        $tractive='';
        $res= DB::table('users')->select('first_name','last_name','email_id','user_type_id','user_id')->where('user_type_id', '4')->where('approval_flag', '1')->where('company_id', $company_id)->get();

        foreach ($res as $r) {
            if ($r != '') {

                $fname=$r->first_name;
                $lname=$r->last_name;
                $name=$fname." ".$lname;
                $type=$r->user_type_id;
                $user_id=$r->user_id;
                $email_id=$r->email_id;

                $tractive=$tractive. '<tr class="tblrow"><td class="">'.$name.'</td><td>'.$email_id.'</td><td>Colleague</td><td><a  alt='.$email_id.' class=inactive><img alt='.$email_id.' src=images/reject.png height=20></a></td></tr>';


            }

        }

        return $tractive;
    }

    public function getinactivecorpclients($email)
    {
        $company_id=$this->getuserid($email);
        $tractive='';
        $res= DB::table('users')->select('first_name','last_name','email_id','user_type_id','user_id')->where('user_type_id', '4')->where('approval_flag', '0')->where('company_id',$company_id)->get();

        foreach ($res as $r) {
            if ($r != '') {

                $fname=$r->first_name;
                $lname=$r->last_name;
                $name=$fname." ".$lname;
                $type=$r->user_type_id;
                $user_id=$r->user_id;
                $email_id=$r->email_id;

                $tractive=$tractive. '<tr class="tblrow"><td class="">'.$name.'</td><td>'.$email_id.'</td><td>Colleague</td><td><a  alt='.$email_id.' class=active><img alt='.$email_id.' src=images/thumbs.png height=20></a></td></tr>';


            }

        }

        return $tractive;
    }

    public function getcreditoverview($comp_email)
    {
        $comp_id=$this->getuserid($comp_email);
        $comp_credit_qty='';
        $res=DB::table('credit_available')->select('credit_available_qty')->where('user_id', $comp_id)->first();

        if($res)
        {
            $comp_credit_qty = $res->credit_available_qty;
        }

        $res1= DB::table('client_credit_distribute')->select('client_user_id')->where('company_user_id', $comp_id)->distinct()->get();
        $client_id='';
        $name='';
        $list='';
        foreach ($res1 as $r) {
            if ($r != '') {

                $client_id=$r->client_user_id;

                $clientdata=$this->getuserdata($client_id);
                $clientarray=explode("#", $clientdata);
                $name = $clientarray[0];

                if($client_id!='')
                {
                    $res2=  DB::table('credit_available')->select('credit_available_qty')->where('user_id', $client_id)->first();

                    if($res2)
                    {
                        $client_credit_qty=$res2->credit_available_qty;
                    }


                }

                $list=$list. '<tr class="tblrow"><td class="">'.$name.'</td><td>'.$comp_credit_qty.'</td><td>'.$client_credit_qty.'</td></tr>';


            }
        }


        return $list;

    }

    public function getcreditoverview2($timezone)
    {

        $comp_credit_qty='';

        $res1= DB::table('company_credit_distribute')->select('company_user_id','credit_qty','date_created')->get();

        $comp_id='';
        $name='';

        $list='';
        $date='';
        $available_qty='';

        foreach ($res1 as $r) {
            if ($r != '') {

                $comp_id = $r->company_user_id;

                $dist_credit = $r->credit_qty;

                $date = $r->date_created;
                $date1=$this->ConvertGMTToLocalTimezone($date,$timezone);

                $compdata=DB::table('users')->select('company')->where('user_id', $comp_id)->first();
if($compdata) {

    $name = $compdata->company;

}
                else
                {
                    $name='';
                }

                $available_credit_data=DB::table('credit_available')->select('credit_available_qty')->where('user_id', $comp_id)->first();
if($available_credit_data)
{
    $available_qty=$available_credit_data->credit_available_qty;
}

                $list=$list. '<tr class="tblrow"><td class="">'.$name.'</td><td>'.$dist_credit.'</td><td>'.$available_qty.'</td><td>'.$date1.'</td></tr>';


            }
        }
                return $list;

    }

    public function getinactivecoaches()
    {

        $trinactive = '';

        $res= DB::table('users')->select('first_name','last_name','email_id','user_type_id','user_id')->where('user_type_id', '2')->where('approval_flag', '0')->get();

        foreach ($res as $r) {
            if ($r != '') {

                $fname=$r->first_name;
                $lname=$r->last_name;
                $name=$fname." ".$lname;
                $type=$r->user_type_id;
                $user_id=$r->user_id;
                $email_id=$r->email_id;

                $trinactive=$trinactive. '<tr class="tblrow"><td class="">'.$name.'</td><td>'.$email_id.'</td><td>coach</td><td><a  alt='.$email_id.' class=active><img alt='.$email_id.' src=images/thumbs.png height=20></a></td></tr>';


            }

        }



        return $trinactive;
    }

    public function bindcorpclientname($email)
    {

        $opt = '';
        $optstring='';
        $comp_id=$this->getuserid($email);

        $res= DB::table('users')->select('first_name','last_name','user_id')->where('approval_flag', '1')->where('company_id', $comp_id)->get();

        $fname='';
        $lname='';
        $name='';
        $user_id='';

        if($res) {
            foreach ($res as $r) {
                if ($r != '') {

                    $fname = $r->first_name;
                    $lname = $r->last_name;
                    $name = $fname . " " . $lname;

                    $user_id = $r->user_id;


                    $opt=$opt. '<option value='.$user_id.'>'.$name.'</option>';


                }

            }

            $optstring="<option value=-Select->-Select-</option>".$opt;


        }

        return $optstring;
    }

    public function bindcompanyname()
    {
        $opt = '';
        $optstring='';

        $res= DB::table('users')->select('company','user_id')->where('approval_flag', '1')->where('user_type_id', '3')->get();

        $cname='';

        if($res) {
            foreach ($res as $r) {
                if ($r != '') {

                    $cname = $r->company;

                    $user_id = $r->user_id;


                    $opt=$opt. '<option value='.$user_id.'>'.$cname.'</option>';


                }

            }

            $optstring="<option value=-Select->-Select-</option>".$opt;


        }

        return $optstring;

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


