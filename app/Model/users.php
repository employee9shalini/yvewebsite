<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use PassHash;
use Session;
use App\Model\loaddata;
DEFINE('QB_API_ENDPOINT', "https://api.quickblox.com");
DEFINE('QB_PATH_SESSION', "session.json");


//use app/config/database.php;
class users extends Model
{

    public function checkuser($email,$pwd)
    {
        include('lib/PassHash.php');
        $res = DB::table('users')->select('password', 'user_type_id', 'user_id', 'qb_login', 'qb_pwd','qb_id','first_name','last_name','company')->where('approval_flag', '1')->where('email_id',$email)->first();


        $result='false';
if($res) {

    $pwd1 = trim($res->password);
    $type=$res->user_type_id;
    $user_id=$res->user_id;
    $qb_login=$res->qb_login;
    $qb_pwd=$res->qb_pwd;
    $first_name=$res->first_name;
    $last_name=$res->last_name;
    $user_name=$first_name." ".$last_name;
    $company_name=$res->company;

    $qb_id=$res->qb_id;
    $pwd=trim($pwd);

    if (PassHash::check_password($pwd1, $pwd)) {

        if($type=='1')
        {
            Session::set('cemail', $email);
            Session::set('qblogin', $qb_login);
            Session::set('qb_id', $qb_id);
            Session::set('qbpwd', $qb_pwd);
            Session::set('uid', $user_id);
            Session::set('uname', $user_name);
            Session::set('utype', $type);
        }

        if($type=='2')
        {
            Session::set('uemail', $email);
            Session::set('qblogin1', $qb_login);
            Session::set('qb_id1', $qb_id);
            Session::set('qbpwd1', $qb_pwd);
            Session::set('uid1', $user_id);
            Session::set('uname1', $user_name);
            Session::set('utype', $type);
        }

        if($type=='3')
        {
            Session::set('coemail', $email);
            Session::set('uid2', $user_id);
            Session::set('company', $company_name);
            Session::set('utype', $type);
        }

        if($type=='4')
        {

            Session::set('cemail', $email);
            Session::set('qblogin', $qb_login);
            Session::set('qb_id', $qb_id);
            Session::set('qbpwd', $qb_pwd);
            Session::set('uid', $user_id);
            Session::set('uname', $user_name);
            Session::set('utype', $type);
        }


        $result = $type . "$" . $user_id . "$" . $qb_login . "$" . $email."$".$qb_id;


    } else {
        $result = 'false';

    }
}

        return $result;

    }

    public function check_email($email,$type)
    {
        $res = DB::table('users')->select('email_id')->where('email_id', $email)->first();
        $emailid='';
        $status='';
        if($res)
        {
            $status='false';
            $emailid = $res->email_id;

        }
        else
        {
            $status='true';
        }
        return $status;
    }

    public function checkadminuser($email,$pwd)
    {

        $res = DB::table('users')->select('user_id', 'user_type_id')->where('approval_flag', '1')->where('email_id',$email)->where('password',$pwd)->where('user_type_id','5')->first();


        $result='false';
        $user_id='';
        $type='';
        if($res) {

            $type=$res->user_type_id;
            $user_id=$res->user_id;


            if ($user_id!='') {

                Session::set('aemail', $email);
                $result = $type . "$" . $user_id. "$" .$email;


            } else {
                $result = 'false';

            }
        }

        return $result;

    }



    //public function registeruser($email,$fname,$lname,$pwd,$typeid,$contact,$company,$adr,$place,$cperson,$cmpnumber,$vat,$fbid,$twid,$catid,$approvalid,$picpath,$compid)

    public function registeruser($email,$fname,$lname,$pwd,$typeid,$contact,$function,$company,$adr,$place,$cperson,$cmpnumber,$vat,$fbid,$twid,$catid,$approvalid,$picpath,$compid)
    {
        include('lib/PassHash.php');
        $res = DB::table('users')->select('email_id', 'about_info')->where('email_id', $email)->first();

        $emailid='';
        $about_info='';
        if($res)
        {
            $emailid = $res->email_id;
            $about_info = $res->about_info;
        }
        $screen = '';
        $status='';
        $pwd1 = PassHash::hash($pwd);
        $auth_token=md5(uniqid(rand(), true));
        date_default_timezone_set('UTC');

        $date= date('Y-m-d H:i:s');

        if ($email != $emailid && $about_info == '') {
            $screen = 'insert';
            $res2= DB::table('users')->insert(
                array('user_id' => '',
                    'email_id' => $email,
                    'password' => $pwd1,
                    'user_type_id' => $typeid,
                    'auth_token' => $auth_token,
                    'first_name' => $fname,
                    'last_name' => $lname,
                    'contact' => $contact,
                    'company' => $company,
                    'address' => $adr,
                    'place' => $place,
                    'company_contact_person' => $cperson,
                    'company_contact_number' => $cmpnumber,
                    'vat' => $vat,
                    'facebook_id' => $fbid,
                    'twitter_id' => $twid,
                    'category_id' => $catid,
                    'about_info' => '',
                    'profile_pic' => $picpath,
                    'intro_video' => '',
                    'gender' => '',
                    'dob' => '',
                    'language' => '',
                    'approval_flag' => $approvalid,
                    'date_created' => $date,
                    'company_id' => $compid,
                    'function' => $function

                )
            );

            if ($res2) {
                $status = "true";
$user_name=$fname." ".$lname;

                $d=new loaddata();

                $user_id=$d->getuserid($email);

                if($typeid=='1')
                {

                    Session::set('cemail', $email);
                    Session::set('qblogin', '');
                    Session::set('qb_id', '');
                    Session::set('qbpwd', '');
                    Session::set('uid',$user_id);
                    Session::set('uname', $user_name);
                    Session::set('utype', $typeid);
                }

                if($typeid=='2')
                {
                    Session::set('uemail', $email);
                    Session::set('qblogin1', '');
                    Session::set('qb_id1', '');
                    Session::set('qbpwd1', '');
                    Session::set('uid1', $user_id);
                    Session::set('uname1', $user_name);
                    Session::set('utype', $typeid);
                }

                if($typeid=='3')
                {
                    Session::set('coemail', $email);
                    Session::set('uid2', $user_id);
                    Session::set('company', $company);
                    Session::set('utype', $typeid);
                }

                if($typeid=='4')
                {
                    //$from       =   "harvinder.kaur@agicent.com";
                    $from       =   "noreply@yve.today";
                    $fromName   =   "YVE";
                    $subject    =   "YVE : Reset Password ";

                    $text2 = $email;
                    $ciphertext_base64 = base64_encode($text2);


                    $body="<html>
        <head>
        </head>
        <body style=''>
        <div style='background: #ffffff; width:600px; height:400px;position: relative'>
        <div style='height: 40px;background: #E9E9E9; width:96%;padding: 2%;color:#484848; font-size: 15px; font-family: arial, helvetica, sans-serif;  border-bottom: 1px solid #c0c0c0'>
        <h2>YVE</h2>
        <div style='background: #ffffff; padding:2%;width:96%; font-family: arial, helvetica, sans-serif; font-size: 13px; color:#484848'>
            <p><strong>Hi</strong></p><p>Your account has been created with YVE and you can now use YVE as a company client.</p><p>Please find your login credentials as below</p><p><strong>Login :  </strong>$email</p><p><strong>Password :  </strong>$pwd</p>Please visit the link below or copy and paste it into your browser to create a new password.</p><p><a href=http://$_SERVER[HTTP_HOST]/forgot?email=$ciphertext_base64>http://$_SERVER[HTTP_HOST]/forgot?email=$ciphertext_base64</a><p>Thanks<br/>Administrator</p>
        </div>
    </div>
    <div style='position: absolute; background-color: #E9E9E9;bottom: 0; height: 40px;padding: 2%; width:96%'></div>
    </div>

    </body>
    </html>";

                    $recipient=$email;

                    $mail=$this->sendmail($from,$fromName,$subject,$recipient,$body);
                    session_reset();
                    Session::set('cemail', $email);
                    Session::set('qblogin', '');
                    Session::set('qb_id', '');
                    Session::set('qbpwd', '');
                    Session::set('uid',$user_id);
                    Session::set('uname', $user_name);
                    Session::set('utype', $typeid);


                }


            }
            else {
                $status = "false";
            }
        }

        if($email==$emailid && $about_info=='')
        {
            $screen='update';
            $status='false';
        }

        if($email==$emailid && $about_info!='')
        {
            $screen='registered';
            $status='false';
        }



        return $status."#".$screen;
    }

public function checkfuser($email,$name)
{
    $status='';
    $res = DB::table('users')->select('user_id','contact', 'first_name', 'last_name', 'user_type_id')->where('email_id',$email)->first();
    $name='';
    $user_id='';
    if($res) {
        $fname = $res->first_name;
        $lname = $res->last_name;
        $name = $fname . "" . $lname;
        $contact = $res->contact;
        $type = $res->user_type_id;
        $user_id=$res->user_id;
    }
        if ($user_id == 'null' || $user_id == '') {
            $status = "false" . "#";

            Session::set('femail', $email);
            Session::set('fname ', $name );


        } else {
            $status = "true" . "#" . $type;

            Session::set('uemail', $email);
        }

    return $status;
}

    public function checktuser($email,$name)
    {
        $status='';
        $res = DB::table('users')->select('user_id','contact', 'first_name', 'last_name', 'user_type_id')->where('email_id',$email)->first();
        $name='';
        if($res) {
            $fname = $res->first_name;
            $lname = $res->last_name;
            $name = $fname . "" . $lname;
            $contact = $res->contact;
            $type = $res->user_type_id;
            $user_id=$res->user_id;

        }
        if ($user_id == 'null' || $user_id == '') {
            $status = "false" . "#";

            Session::set('temail', $email);
            Session::set('tname ', $name );


        } else {
            $status = "true" . "#" . $type;

            Session::set('uemail', $email);
        }

        return $status;
    }

    public function updateprofile($email,$gender,$dob,$lang,$profiletxt,$picpath,$bankname,$accno,$bic)
    {
        $result = DB::table('users')->where('email_id',$email)
            ->update(array('gender' => $gender,
                'about_info' => $profiletxt,
                'dob' => $dob,
                'language' => $lang,
                'profile_pic' => $picpath,
                'bank_name' => $bankname,
                'account_number' => $accno,
                'bic'=> $bic

            ));


        $status="";
        if($result)
    {
        $status='true';
        $from       =   "harvinder.kaur@agicent.com";
        $from       =   "noreply@yve.today";
		
        $fromName   =   "YVE";
        $subject    =   "YVE : Coach Account Activation Request ";
        $body='<html>
        <head>
        </head>
        <body style="">
        <div style="background: #ffffff; width:600px; height:400px;position: relative">
        <div style="height: 40px;background: #E9E9E9; width:96%;padding: 2%;color:#484848; font-size: 15px; font-family: arial, helvetica, sans-serif;  border-bottom: 1px solid #c0c0c0">
        <h2>YVE</h2>
        <div style="background: #ffffff; padding:2%;width:96%; font-family: arial, helvetica, sans-serif; font-size: 13px; color:#484848">
            <p><strong>Hi</strong></p><p>You received request for the activation of new coach account with the emailid  '.$email.'. Please go to the admin panel for the activation.<p><br/><br/><br/>Thanks<br/><br/><strong>Administrator</strong></p>
        </div>
    </div>
    <div style="position: absolute; background-color: #E9E9E9;bottom: 0; height: 40px;padding: 2%; width:96%"></div>
    </div>

    </body>
    </html>';

        $recipient=$email;

        $mail=$this->sendmail($from,$fromName,$subject,$recipient,$body);

    }

return $status;

    }

    public function insertvideo($email,$videopath)
    {

        $result = DB::table('users')->where('email_id',$email)
            ->update(array('intro_video' => $videopath
            ));

        $status="";
        if($result)
        {
            $status="true";
        }
        else
        {
            $status="false";
        }

        return $status;

    }

public function updatecompanydata($email, $cmpname,$addr,$place,$contact,$coperson,$conumber,$vat)
{
    $result = DB::table('users')->where('email_id',$email)
        ->update(array('company' => $cmpname,
            'address' => $addr,
            'place' => $place,
            'contact' => $contact,
            'company_contact_person' => $coperson,
            'company_contact_number' => $conumber,
            'vat' => $vat


        ));


    $status="";
    if($result) {
        $status = 'true';
    }
    else{
        $status='false';
    }
}

    public function updateclientdata($email, $user_fname,$user_lname,$contact,$function)
    {
        $result = DB::table('users')->where('email_id',$email)
            ->update(array('first_name' => $user_fname,
                'last_name' => $user_lname,
                'contact' => $contact,
                'function' => $function

            ));


        $status="";
        if($result) {
            $status = 'true';
$user_name=$user_fname." ".$user_lname;
            Session::set('uname', $user_name);
        }
        else{
            $status='false';
        }
        return $status;
    }

    public function sendmail($from,$fromName,$subject,$recipient,$body)
    {

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1rn' . "\r\n";
        //$headers .= "From: $fromName <$from>\r\n". "CC: harvinder.kaur@agicent.com";
		$headers .= "From: $fromName <$from>\r\n". "CC: noreply@yve.today";

        if (mail($recipient, $subject, $body, $headers))

            $status='true';
        else
            $status='false';
        //return 'Your Account has been created & will be activated soon';
        //return $status;

        return $status;
    }

    public function registeruserbyadmin($email,$pwd,$typeid,$auth_token,$fname,$lname,$contact,$company,$adr,$place,$cperson,$cmpnumber,$vat,$fbid,$twid,$catid,$profile,$picpath,$intro_video,$gender,$dob,$lang,$approvalid,$bankname,$accno,$bic,$coach_level)
    {
        include('lib/PassHash.php');
        $pwd1 = PassHash::hash($pwd);
        date_default_timezone_set('UTC');
$emailid='';
        $res = DB::table('users')->select('email_id')->where('email_id',$email)->first();

if($res)
{
    $emailid = $res->email_id;
}

        if($emailid=='') {
            $date = date('Y-m-d H:i:s');
            $result = DB::table('users')->insert(
                array('user_id' => '',
                    'email_id' => $email,
                    'password' => $pwd1,
                    'user_type_id' => $typeid,
                    'auth_token' => $auth_token,
                    'first_name' => $fname,
                    'last_name' => $lname,
                    'contact' => $contact,
                    'company' => $company,
                    'address' => $adr,
                    'place' => $place,
                    'company_contact_person' => $cperson,
                    'company_contact_number' => $cmpnumber,
                    'vat' => $vat,
                    'facebook_id' => $fbid,
                    'twitter_id' => $twid,
                    'category_id' => $catid,
                    'about_info' => $profile,
                    'profile_pic' => $picpath,
                    'intro_video' => $intro_video,
                    'gender' => $gender,
                    'dob' => $dob,
                    'language' => $lang,
                    'approval_flag' => $approvalid,
                    'date_created' => $date,
                    'level_id' => '',
                    'bank_name' => $bankname,
                    'account_number' => $accno,
                    'bic' => $bic,
                    'level_id' => $coach_level

                )
            );


            if ($result) {
                $status = "true";
                $user_name = $fname . " " . $lname;

                $d = new loaddata();
                $user_id = $d->getuserid($email);

                if ($typeid == '1') {

                    Session::set('cemail', $email);
                    Session::set('qblogin', '');
                    Session::set('qb_id', '');
                    Session::set('qbpwd', '');
                    Session::set('uid', $user_id);
                    Session::set('uname', $user_name);
                }

                if ($typeid == '2') {
                    Session::set('uemail', $email);
                    Session::set('qblogin1', '');
                    Session::set('qb_id1', '');
                    Session::set('qbpwd1', '');
                    Session::set('uid1', $user_id);
                    Session::set('uname1', $user_name);
                }

                if ($typeid == '3') {
                    Session::set('coemail', $email);
                    Session::set('uid2', $user_id);
                    Session::set('company', $company);
                }


            } else {
                $status = "false";
            }
        }
        else
        {
$status="false";
        }
        return $status;
    }


    public function updateimg($user_email,$picpath)
    {

        $result = DB::table('users')->where('email_id',$user_email)
            ->update(array('profile_pic' => $picpath


            ));

        if($result)
        {
            $status="true";
        }
        else
        {
            $status="false";
        }

        return $status;

    }

    public function insertmentality($uid, $typeid, $gendor,$approach,$spirit, $philosphy,$mentor,$board,$setting,$pd,$prd,$age,$lang)
    {

       $res = DB::table('mentality_match')->select('serial_number')->where('user_id', $uid)->where('user_type_id',$typeid)->first();

$sno='';
        if($res)
        {
            $sno= $res->serial_number;
        }

        if($sno=='')
        {
            $result = DB::table('mentality_match')->insert(
                array('serial_number' => '',
                    'user_id' => $uid,
                    'user_type_id' => $typeid,
                    'q1_ans' => $gendor,
                    'q2_ans' => $approach,
                    'q3_ans' => $spirit,
                    'q4_ans' => $philosphy,
                    'q5_ans' => $mentor,
                    'q6_ans' => $board,
                    'q7_ans' => $setting,
                    'q8_ans' => $pd,
                    'q9_ans' => $prd,
                    'q10_ans' => $age,
                    'q11_ans' => $lang

                )
            );


            if ($result) {
                $status = "true";
            }
        }

        else
        {
            $status = "false";
        }
echo $status;
    }


    public function resetpwd($email,$pwd)
    {
        include('lib/PassHash.php');

        $pwd1 = PassHash::hash($pwd);

      $result=  DB::table('users')->where('email_id',$email)
            ->update(array(
                'password' => $pwd1,

            ));

        $status="";
        if($result) {
            $status = 'true';
        }
        else{
            $status = 'false';
        }

        return $status;

}

    public function updateprofile2($user_email, $user_fname, $user_lname,$contact,$cat, $profile,$gender, $dob, $lang,$bankname,$accno,$bic)
{

    $result = DB::table('users')->where('email_id',$user_email)
        ->update(array(
            'first_name' => $user_fname,
            'last_name' => $user_lname,
            'contact' => $contact,
            'about_info' => $profile,
            'category_id' => $cat,
            'gender' => $gender,
            'dob' => $dob,
            'language' => $lang,
            'bank_name' => $bankname,
            'account_number' => $accno,
            'bic'=> $bic

        ));


    $status="";
    if($result) {
        $status = 'true';
    }
    else{
        $status = 'false';
    }

    return $status;

}

    public function updateprofile3($user_email, $user_fname, $user_lname,$contact,$cat, $profile,$gender, $dob, $lang,$bankname,$accno,$bic,$level)
    {

        $result = DB::table('users')->where('email_id',$user_email)
            ->update(array(
                'first_name' => $user_fname,
                'last_name' => $user_lname,
                'contact' => $contact,
                'about_info' => $profile,
                'category_id' => $cat,
                'gender' => $gender,
                'dob' => $dob,
                'language' => $lang,
                'bank_name' => $bankname,
                'account_number' => $accno,
                'bic'=> $bic,
                'level_id'=>$level

            ));


        $status="";
        if($result) {
            $status = 'true';
        }
        else{
            $status = 'false';
        }

        return $status;

    }

    public  function  updateqid($qlogin,$userid,$qpwd)
    {
        $appId=31919;
        $authKey="EhV9Sqb7Gc4LZz5";
        $authSecret= "sPUTkeEOZc2ntCA";
        $login="ravindra.gupta";
        $password="ravi@agicent";

        $session = $this->createSession($appId, $authKey, $authSecret, $login, $password);
        $token = $session->token;

        $request = '{"user": {"login": "'.$qlogin.'", "password": "'.$qpwd.'"}}';

        $ch = curl_init('http://api.quickblox.com/users.json');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'QuickBlox-REST-API-Version: 0.1.0',
            'QB-Token: ' . $token
        ));

        $resultJSON = curl_exec($ch);
        $pretty = json_encode(json_decode($resultJSON), JSON_PRETTY_PRINT);
        $qb_id='';
        $status="";
        $json = json_decode($pretty, true);
        foreach ($json as $key => $obj) { // This will search in the 2 jsons
            foreach($obj as $key => $value) {
                if($key == 'id'){
                    $qb_id=$value;

                }
            }


        }

        if($qb_id!='')
        {
            $result = DB::table('users')->where('user_id',$userid)
                ->update(array('qb_login' => $qlogin,
                    'qb_id' => $qb_id,
                    'qb_pwd' => $qpwd


                ));



            if($result) {
                $status = 'true';

                Session::set('qblogin', $qlogin);
                Session::set('qbpwd', $qpwd);
                Session::set('uid', $userid);
            }
            else
            {
                $status = 'false';
            }



        }

        return $status."#".$qb_id;

    }

    public function sendmsg()
    {
        $appId=31919;
        $authKey="EhV9Sqb7Gc4LZz5";
        $authSecret= "sPUTkeEOZc2ntCA";
        $login="ravindra.gupta";
        $password="ravi@agicent";

        $session = $this->createSession($appId, $authKey, $authSecret, $login, $password);
        $token = $session->token;
        $chat_dialog_id = '5513e91f535c12b98f0212f1';

        $attachment = array( array(
            type => 'image',
            url => 'https://qbprod.s3.amazonaws.com/70a9a896466f44b2b70ee79386e86f3e00',
            id => 10908538
        ));

        $data = array(
            'chat_dialog_id' => $chat_dialog_id,
            'message' => 'This is a message',
            'attachments' => (object) $attachment,
        );

        $request = json_encode($data);

        $ch = curl_init('https://api.quickblox.com/chat/Message.json');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'QuickBlox-REST-API-Version: 0.1.0',
            'QB-Token: ' . $token
        ));

        $resultJSON = curl_exec($ch);
        $pretty = json_encode(json_decode($resultJSON), JSON_PRETTY_PRINT);

        echo $pretty;


    }


    public  function  updatefbid($email,$fbid)
    {
        $result = DB::table('users')->where('email_id',$email)
            ->update(array('facebook_id' => $fbid

            ));


        $status="";
        if($result) {
            $status = 'true';

            $_SESSION["uemail"] = $email;
        }
        else
        {
            $status = 'false';
        }

        return $status;

    }

    public function createSession($appId, $authKey, $authSecret, $login, $password) {

        if (!$appId || !$authKey || !$authSecret || !$login || !$password) {
            return false;
        }

        // Generate signature
        $nonce = rand();
        $timestamp = time(); // time() method must return current timestamp in UTC but seems like hi is return timestamp in current time zone
        $signature_string = "application_id=" . $appId . "&auth_key=" . $authKey . "&nonce=" . $nonce . "&timestamp=" . $timestamp . "&user[login]=" . $login . "&user[password]=" . $password;

        $signature = hash_hmac('sha1', $signature_string , $authSecret);

        // Build post body
        $post_body = http_build_query( array(
            'application_id' => $appId,
            'auth_key' => $authKey,
            'timestamp' => $timestamp,
            'nonce' => $nonce,
            'signature' => $signature,
            'user[login]' => $login,
            'user[password]' => $password
        ));

        // Configure cURL
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT . '/' . QB_PATH_SESSION); // Full path is - https://api.quickblox.com/session.json
        curl_setopt($curl, CURLOPT_POST, true); // Use POST
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_body); // Setup post body
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Receive server response

        // Execute request and read response
        $response = curl_exec($curl);
        $responseJSON = json_decode($response)->session;

        // Check errors
        if ($responseJSON) {
            return $responseJSON;
        } else {
            $error = curl_error($curl). '(' .curl_errno($curl). ')';
            return $error;
        }

        // Close connection
        curl_close($curl);

    }

}


