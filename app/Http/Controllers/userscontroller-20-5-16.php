<?php

namespace App\Http\Controllers;

use App\Model\loaddata;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Request;
use App\Model\users;
use Session;
use Intervention\Image\Facades\Image;




class userscontroller extends Controller
{

    public function signin()

    {
     $data=Input::all();

        $email=$data["aemail"];
        $pwd=$data["apwd"];
        $u=new users();
        $res=$u->checkuser($email,$pwd);
        $status="";
        if($res=="false")
        {
            $status="false";
        }
        else{

            $status="true";

        }
        echo $status."#".$res;

    }

    public function adminsignin()

    {
        $data=Input::all();

        $email=$data["aemail"];
        $pwd=$data["apwd"];
        $u=new users();
        $res=$u->checkadminuser($email,$pwd);
        $status="";
        if($res=="false")
        {
            $status="false";
        }
        else{

            $status="true";

        }
        echo $status."#".$res;

    }

    public function fsignin()

    {
        $data=Input::all();
        $email=$data["aemail"];
        $name=$data["aname"];

        $u=new users();
       $res=$u->checkfuser($email,$name);

        echo  $res;

    }


    public function tsignin()

    {
        $data=Input::all();
        $email=$data["aemail"];
        $name=$data["aname"];

        $u=new users();
       $res=$u->checktuser($email,$name);

        echo  $res;

    }


    public function fupdate()
    {
        $data=Input::all();

        $emailid=$data["aemail"];
        $fbid=$data["afbid"];

        $u=new users();
       $d=$u->updatefbid($emailid,$fbid);

    }


    public function signup()

    {
        $data=Input::all();
        $email=$data["uemail"];
        $fname=$data["ufname"];
        $lname=$data["ulname"];
        $pwd=$data["upwd"];
        $type=$data["utype"];
        $contact=$data["ucontact"];
        $company=$data["ucomp"];
        $adr=$data["uadr"];
        $place=$data["uplace"];
        $cperson=$data["ucperson"];
        $cmpnumber=$data["ucmpnumber"];
        $vat=$data["uvat"];
        $fbid=$data["ufbid"];
        $twid=$data["utwid"];
        $ucatid=$data["ucatid"];
        $approval_id=$data["approvalid"];
        $picpath='';
        $compid='';
		$status='';
		$function = '';
        $u=new users();
        $res=$u->registeruser($email,$fname,$lname,$pwd,$type,$contact,$function,$company,$adr,$place,$cperson,$cmpnumber,$vat,$fbid,$twid,$ucatid,$approval_id,$picpath,$compid);
        $status="false";
        if($res=="")
        {
            $status="false";
        }
        else{

            $status="true";

        }


        echo $res;

    }

    /**
     *
     */
    public function uploadimgdata()
{
    include("tinypng.php");
    $data=Input::all();

    $picname = $_FILES['photo']['name'];
    $user_email=$_POST["tempemail"];

    $gender=$data["gender"];
    $dob=$data["birthdate"];
    $lang=$data["lang_selected"];
    $profile=$data["profile"];
    $bankname=$_POST["bankname"];
    $accno=$_POST["accnumber"];
    $bic=$_POST["bic"];

    //Getting temporary file name stored in php tmp folder
    $tmp_name = $_FILES['photo']['tmp_name'];

    //Path to store files on server
    $path = 'images/profile/img-';

    $u=new loaddata();
    $uid=$u->getuserid($user_email);
    $imgname=md5(uniqid(rand(), true));
    $log=true;
    $msg= '';

    $dob1=date('Y-m-d', strtotime($dob));
    //checking file available or not
    if(!empty($picname) && $_FILES['photo']['size']<=5242880) {
        //Moving file to temporary location to upload path
        $allowed =  array('gif','png' ,'jpg','jpeg');

        $ext = pathinfo($picname, PATHINFO_EXTENSION);
        if(!in_array($ext,$allowed) ) {
            $msg= 'Image File is not in valid image format';
            echo '</p>';
            $log=false;
            return redirect("index")->with('message',$msg);
        }

        else
        {

            //Moving file to temporary location to upload path
            move_uploaded_file($tmp_name,$path.$imgname.".".$ext);
            Image::make($path.$imgname.".".$ext)->resize(200, 200)->save();

            $tinypng=new \TinyPNG("h4jkc_z0_71qyCmk4orFRH0ZFOB6PWWg", true);
            $tinypng->compress($path.$imgname.".".$ext, $path.$imgname.".".$ext);


        }
    }
    else{
        //If file not selected displaying a message to choose a file
        $msg= "Image File is over 5 mb in size!";
        echo '</p>';
        $log=false;
        return redirect("index")->with('message',$msg);
    }


            if($log==true)
        {

            $u=new users();

            $picpath=$path.$imgname.".".$ext;

            $email= "noreply@yve.today"; //"harvinder.kaur@agicent.com";


            $status=$u->updateprofile($user_email,$gender,$dob1,$lang,$profile,$picpath,$bankname,$accno,$bic);

            if($status==true)
            {
                //$y= view('index')->with('message','Your Account has been created & will be activated soon');
                $msg= 'Your Account has been created & will be activated soon';
            }

        else
        {

        }



        return redirect("index")->with('message',$msg);
    }

}

    public function updateimage()
    {
        include("tinypng.php");
        $data=Input::all();
        $picname = $_FILES['changeimg']['name'];
        $user_email=Session::get('uemail');
        $l=new loaddata();
        $previous_img=$l->getuserimg($user_email);

        //Getting temporary file name stored in php tmp folder
        $tmp_name =$_FILES['changeimg']['tmp_name'];

        //Path to store files on server
        $path = 'images/profile/img-';

        $imgname=md5(uniqid(rand(), true));
        $log=true;
        $msg='';


        if(!empty($picname) && $_FILES['changeimg']['size']<=5242880) {
            //Moving file to temporary location to upload path
            $allowed =  array('gif','png' ,'jpg','jpeg');

            $ext = pathinfo($picname, PATHINFO_EXTENSION);
            if(!in_array($ext,$allowed) ) {
                echo 'Image File is not in valid image format';

                $log=false;
            }

            else
            {

                //Moving file to temporary location to upload path
                move_uploaded_file($tmp_name,$path.$imgname.".".$ext);

                unlink($previous_img);

                Image::make($path.$imgname.".".$ext)->resize(200, 200)->save();

                $tinypng=new \TinyPNG("h4jkc_z0_71qyCmk4orFRH0ZFOB6PWWg", true);
                $tinypng->compress($path.$imgname.".".$ext, $path.$imgname.".".$ext);

                $log=true;



            }
        }
        else{
            //If file not selected displaying a message to choose a file


            echo "Image File is over 5 mb in size!";
        }

        $picpath=$path.$imgname.".".$ext;
        if($log==true)
        {

            $u=new users();



            $email="noreply@yve.today"; //"harvinder.kaur@agicent.com";


            $status=$u->updateimg($user_email,$picpath);

            echo "image uploaded succesfully#".$picpath;


            //return redirect("index")->with('message',$msg);
        }




    }

    public function updateimage4()
    {
include("tinypng.php");
        $data=Input::all();
        $picname = $_FILES['changeimg']['name'];
        $user_email=Session::get('cemail');

        //Getting temporary file name stored in php tmp folder
        $tmp_name =$_FILES['changeimg']['tmp_name'];

        //Path to store files on server
        $path = 'images/profile/img-';

        $imgname=md5(uniqid(rand(), true));
        $log=true;
        $msg='';
        $l=new loaddata();
        $previous_img=$l->getuserimg($user_email);


        if(!empty($picname) && $_FILES['changeimg']['size']<=5242880) {
            //Moving file to temporary location to upload path
            $allowed =  array('gif','png' ,'jpg','jpeg');

            $ext = pathinfo($picname, PATHINFO_EXTENSION);
            if(!in_array($ext,$allowed) ) {
                echo 'Image File is not in valid image format';

                $log=false;
            }

            else
            {

                //Moving file to temporary location to upload path
                move_uploaded_file($tmp_name,$path.$imgname.".".$ext);
               Image::make($path.$imgname.".".$ext)->resize(200, 200)->save();

                $tinypng=new \TinyPNG("h4jkc_z0_71qyCmk4orFRH0ZFOB6PWWg", true);
                $tinypng->compress($path.$imgname.".".$ext, $path.$imgname.".".$ext);

unlink($previous_img);
                $log=true;

            }
        }
        else{
            //If file not selected displaying a message to choose a file


            echo "Image File is over 5 mb in size!";
        }

        $picpath=$path.$imgname.".".$ext;
        if($log==true)
        {

            $u=new users();

            $email="noreply@yve.today"; //"harvinder.kaur@agicent.com";


            $status=$u->updateimg($user_email,$picpath);

            echo "image uploaded succesfully#".$picpath;


            //return redirect("index")->with('message',$msg);
        }




    }

    public function updateclientimage()
    {
        include("tinypng.php");
        $data=Input::all();
        $picname = $_FILES['changeimg']['name'];
        $user_email=$data["clientemail3"];

        //Getting temporary file name stored in php tmp folder
        $tmp_name =$_FILES['changeimg']['tmp_name'];

        //Path to store files on server
        $path = 'images/profile/img-';

        $imgname=md5(uniqid(rand(), true));
        $log=true;
        $msg='';

        $l=new loaddata();
        $previous_img=$l->getuserimg($user_email);


        if(!empty($picname) && $_FILES['changeimg']['size']<=5242880) {
            //Moving file to temporary location to upload path
            $allowed =  array('gif','png' ,'jpg','jpeg');

            $ext = pathinfo($picname, PATHINFO_EXTENSION);
            if(!in_array($ext,$allowed) ) {
                echo 'Image File is not in valid image format';

                $log=false;
            }

            else
            {
           //Moving file to temporary location to upload path
                move_uploaded_file($tmp_name,$path.$imgname.".".$ext);
                Image::make($path.$imgname.".".$ext)->resize(200, 200)->save();

                $tinypng=new \TinyPNG("h4jkc_z0_71qyCmk4orFRH0ZFOB6PWWg", true);
                $tinypng->compress($path.$imgname.".".$ext, $path.$imgname.".".$ext);

unlink($previous_img);
                $log=true;

            }
        }
        else{
            //If file not selected displaying a message to choose a file
            echo "Image File is over 5 mb in size!";
        }

        $picpath=$path.$imgname.".".$ext;
        if($log==true)
        {

            $u=new users();
            $status=$u->updateimg($user_email,$picpath);

            echo "image uploaded succesfully#".$picpath;


            //return redirect("index")->with('message',$msg);
        }




    }

    public function reset()
    {
        $data=Input::all();
        $email=$data["email"];
        $pwd=$data["pwd"];
        $u=new users();
        $status=$u->resetpwd($email,$pwd);
        echo $status;

    }

    public function sendmsg()
    {
        $u=new users();
        $mail=$u->sendmsg();
    }

    public function sendmailfpwd()
    {
        $data=Input::all();
        $email=$data["femail"];
        $u=new users();

        $from       =   "noreply@yve.today"; //"harvinder.kaur@agicent.com";
        $fromName   =   "YVE";
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1rn' . "\r\n";
        $headers .= "From: $fromName <$from>\r\n".
            "CC:patle@agicent.com";
       $subject    =   "YVE : Reset Password ";

        $ciphertext_base64 = base64_encode($email);

        $recipient=$email;

        $body="<html>
        <head>
        </head>
        <body style=''>
        <div style='background: #ffffff; width:600px; height:400px;position: relative'>
        <div style='height: 40px;background: #E9E9E9; width:96%;padding: 2%;color:#484848; font-size: 15px; font-family: arial, helvetica, sans-serif;  border-bottom: 1px solid #c0c0c0'>
        <h2>YVE</h2>
        <div style='background: #ffffff; padding:2%;width:96%; font-family: arial, helvetica, sans-serif; font-size: 13px; color:#484848'>
            <p><strong>Hi</strong></p><p>You requested that your password be reset. Please visit the link below or copy and paste it into your browser to create a new password.</p><p><a href=http://$_SERVER[HTTP_HOST]/forgot?email=".$ciphertext_base64.">http://$_SERVER[HTTP_HOST]/forgot?email=".$ciphertext_base64."</a></p><br/><br/><br/>Thanks<br/><br/><strong>Administrator</strong></p>
        </div>
    </div>
    <div style='position: absolute; background-color: #E9E9E9;bottom: 0; height: 40px;padding: 2%; width:96%'></div>
    </div>

    </body>
    </html>";
$u=new users();
        $mail=$u->sendmail($from,$fromName,$subject,$headers,$body);




    }

    public function chkemail()

    {
        $data=Input::all();
        $email=$data["cemail"];
        $type=$data["ctype"];
        $u=new users();
        $res=$u->check_email($email,$type);
        $status='';
        if($res=='true')
        {
            $status='true';
        }
        else{

            $status='false';
        }
        return $status;
    }

    public function updateimage2()
    {
        include("tinypng.php");
        $data=Input::all();

        $picname = $_FILES['changeimg2']['name'];
        $user_email=$data["coachemail2"];

        //Getting temporary file name stored in php tmp folder
        $tmp_name =$_FILES['changeimg2']['tmp_name'];

        //Path to store files on server
        $path = 'images/profile/img-';


        $imgname=md5(uniqid(rand(), true));
        $log=true;
        $msg='';

        $l=new loaddata();
        $previous_img=$l->getuserimg($user_email);


        if(!empty($picname) && $_FILES['changeimg2']['size']<=5242880) {
            //Moving file to temporary location to upload path
            $allowed =  array('gif','png' ,'jpg','jpeg');

            $ext = pathinfo($picname, PATHINFO_EXTENSION);

            $picpath=$path.$imgname.".".$ext;

            if(!in_array($ext,$allowed) ) {
                echo 'Image File is not in valid image format';

                $log=false;
            }

            else
            {

                //Moving file to temporary location to upload path
                move_uploaded_file($tmp_name,$picpath);

                Image::make($picpath)->resize(200, 200)->save();

                $tinypng=new \TinyPNG("h4jkc_z0_71qyCmk4orFRH0ZFOB6PWWg", true);
                $tinypng->compress($picpath, $picpath);
unlink($previous_img);
                $log=true;

            }
        }
        else{
            //If file not selected displaying a message to choose a file


            echo "Image File is over 5 mb in size!";
        }


        if($log==true)
        {

            $u=new users();



            $email="noreply@yve.today"; //"harvinder.kaur@agicent.com";


            $status=$u->updateimg($user_email,$picpath);

            echo "image uploaded succesfully#".$picpath;


            //return redirect("index")->with('message',$msg);
        }




    }

    public function updateimage3()
    {
        include("tinypng.php");
        $data=Input::all();

        $picname = $_FILES['changeimg3']['name'];
        $user_email=$data["compemail2"];

        //Getting temporary file name stored in php tmp folder
        $tmp_name =$_FILES['changeimg3']['tmp_name'];

        //Path to store files on server
        $path = 'images/profile/company/img-';


        $imgname=md5(uniqid(rand(), true));
        $log=true;
        $msg='';

        $l=new loaddata();
        $previous_img=$l->getuserimg($user_email);

        if(!empty($picname) && $_FILES['changeimg3']['size']<=5242880) {
            //Moving file to temporary location to upload path
            $allowed =  array('gif','png' ,'jpg','jpeg');

            $ext = pathinfo($picname, PATHINFO_EXTENSION);

            $picpath=$path.$imgname.".".$ext;

            if(!in_array($ext,$allowed) ) {
                echo 'Image File is not in valid image format';

                $log=false;
            }

            else
            {

                //Moving file to temporary location to upload path
                move_uploaded_file($tmp_name,$picpath);
                unlink($previous_img);

                Image::make($picpath)->resize(200, 200)->save();

                $tinypng=new \TinyPNG("h4jkc_z0_71qyCmk4orFRH0ZFOB6PWWg", true);
                $tinypng->compress($picpath, $picpath);


                $log=true;

            }
        }
        else{
            //If file not selected displaying a message to choose a file


            echo "Image File is over 5 mb in size!";
        }


        if($log==true)
        {

            $u=new users();



            $email="noreply@yve.today"; //"harvinder.kaur@agicent.com";


            $status=$u->updateimg($user_email,$picpath);

            echo "image uploaded succesfully#".$picpath;


            //return redirect("index")->with('message',$msg);
        }




    }

    public function uploadvideobyadmin()
    {
        $data=Input::all();
        $ivideo=$_FILES['ivideo']['name'];
        $user_email=Session::get('aemail');


        //Getting temporary file name stored in php tmp folder
        $tmp_name=$_FILES['ivideo']['tmp_name'];

        $u=new loaddata();
        $uid=$u->getuserid($user_email);

        //Path to store files on server
        $path = 'video/profile/video-';

        $videoname="yvevid".$uid;
        $log=true;

        if(!empty($ivideo)) {
            if ($_FILES['ivideo']['size'] <= 104857600) {

                $allowed = array('mp4');

                $ext = pathinfo($ivideo, PATHINFO_EXTENSION);
                if (!in_array($ext, $allowed)) {
                    echo 'Video File is not in valid video format';
                    $log = false;
                } else {

                    //Moving file to temporary location to upload path
                    move_uploaded_file($tmp_name, $path . $videoname . "." . $ext);


                }
            } else {
                //If file not selected displaying a message to choose a file
                echo "Video File is over 100 mb in size!";
                $log = false;
            }
        }




        if($log==true) {
            $u = new users();
            $status = '';

            $videopath =$path . $videoname . "." . $ext;


            $status = $u->insertvideo($user_email, $videopath);

            //Displaying success message
            if ($status == true) {


                echo 'Video uploaded successfully#'.$videopath;

            }


        }

    }

    public function uploadvideo()
    {
        $data=Input::all();
        $ivideo=$_FILES['ivideo']['name'];
        $user_email=Session::get('uemail');


        //Getting temporary file name stored in php tmp folder
        $tmp_name=$_FILES['ivideo']['tmp_name'];

        $u=new loaddata();
        $uid=$u->getuserid($user_email);

        //Path to store files on server
        $path = 'video/profile/video-';

        $videoname="yvevid".$uid;
        $log=true;

        if(!empty($ivideo)) {
            if ($_FILES['ivideo']['size'] <= 104857600) {

                $allowed = array('mp4');

                $ext = pathinfo($ivideo, PATHINFO_EXTENSION);
                if (!in_array($ext, $allowed)) {
                    echo 'Video File is not in valid video format';
                    $log = false;
                } else {

                    //Moving file to temporary location to upload path
                    move_uploaded_file($tmp_name, $path . $videoname . "." . $ext);


                }
            } else {
                //If file not selected displaying a message to choose a file
                echo "Video File is over 100 mb in size!";
                $log = false;
            }
        }




        if($log==true) {
            $u = new users();
            $status = '';

            $videopath =$path . $videoname . "." . $ext;


            $status = $u->insertvideo($user_email, $videopath);

            //Displaying success message
            if ($status == true) {


                echo 'Video uploaded successfully#'.$videopath;

            }


        }

    }

    public function uploadvideo2()
    {
        $data=Input::all();
        $ivideo=$_FILES['ivideo2']['name'];
        $user_email=$data["coachemail3"];


        //Getting temporary file name stored in php tmp folder
        $tmp_name=$_FILES['ivideo2']['tmp_name'];

        $u=new loaddata();
        $uid=$u->getuserid($user_email);

        //Path to store files on server
        $path = 'video/profile/video-';

        $videoname="yvevid".$uid;
        $log=true;

        if(!empty($ivideo)) {
            if ($_FILES['ivideo2']['size'] <= 104857600) {

                $allowed = array('mp4');

                $ext = pathinfo($ivideo, PATHINFO_EXTENSION);
                if (!in_array($ext, $allowed)) {
                    echo 'Video File is not in valid video format';
                    $log = false;
                } else {

                    //Moving file to temporary location to upload path
                    move_uploaded_file($tmp_name, $path . $videoname . "." . $ext);


                }
            } else {
                //If file not selected displaying a message to choose a file
                echo "Video File is over 100 mb in size!";
                $log = false;
            }
        }




        if($log==true) {
            $u = new users();
            $status = '';

            $videopath =$path . $videoname . "." . $ext;


            $status = $u->insertvideo($user_email, $videopath);

            //Displaying success message
            if ($status == true) {


                echo 'Video uploaded successfully#'.$videopath;

            }


        }

    }

    public function uploaddata()
    {
        include("tinypng.php");
        $data=Input::all();
        $picname = $_FILES['photo']['name'];
        $user_email = $data["coach-email"];
        $user_fname = $data["coach-fname"];
        $user_lname = $data["coach-lname"];
        $contact = $data["coach-contact"];
        $user_pwd = $data["coach-pwd"];
        $gender = $data["coach-gender"];
        $dob = $data["coach-dob"];
        $lang = $data["lang_selected"];
        $profile = $data["profile"];
        $bankname=$_POST["bankname"];
        $accno=$_POST["accnumber"];
        $bic=$_POST["bic"];
        $cat = $data["cat"];
        $typeid='2';
        $approvalid='1';
        $imgname=md5(uniqid(rand(), true));
        $coach_level=$_POST["level"];
        $log=true;

        $dob1=date('Y-m-d', strtotime($dob));

        //Getting temporary file name stored in php tmp folder
        $tmp_name = $_FILES['photo']['tmp_name'];
$intro_video=$data["vid"];
        //Path to store files on server
        $path = 'images/profile/img-';

        if(!empty($picname) && $_FILES['photo']['size']<=5242880) {
            //Moving file to temporary location to upload path
            $allowed =  array('gif','png' ,'jpg','jpeg');

            $ext = pathinfo($picname, PATHINFO_EXTENSION);
            if(!in_array($ext,$allowed) ) {
                $msg= 'Image File is not in valid image format';
                echo '</p>';
                $log=false;
            }

            else
            {

                //Moving file to temporary location to upload path
                move_uploaded_file($tmp_name,$path.$imgname.".".$ext);
                Image::make($path.$imgname.".".$ext)->resize(200, 200)->save();

                $tinypng=new \TinyPNG("h4jkc_z0_71qyCmk4orFRH0ZFOB6PWWg", true);
                $tinypng->compress($path.$imgname.".".$ext, $path.$imgname.".".$ext);


            }
        }
        else{
            //If file not selected displaying a message to choose a file
            $msg= "Image File is over 5 mb in size!";
            echo '</p>';
            $log=false;
        }

        if($log==true) {

            $picpath =$path .$imgname.".".$ext;
            $auth_token = md5(uniqid(rand(), true));
            $company = '';
            $adr = '';
            $place = '';
            $cperson = '';
            $cmpnumber = '';
            $vat = '';
            $fbid = '';
            $twid = '';



            $u = new users();

            $status = $u->registeruserbyadmin($user_email, $user_pwd, $typeid, $auth_token, $user_fname, $user_lname, $contact, $company, $adr, $place, $cperson, $cmpnumber, $vat, $fbid, $twid, $cat, $profile, $picpath, $intro_video, $gender, $dob1, $lang, $approvalid,$bankname,$accno,$bic,$coach_level);


            if ($status == true) {
                //$y= view('index')->with('message','Your Account has been created & will be activated soon');
                $msg = 'Coach Account has been created';
            }

        }



            return redirect("admin")->with('message',$msg);


    }

    public function uploaddata2()
{
    include("tinypng.php");

    $data=Input::all();
    $picname = $_FILES['photo3']['name'];
    $user_email =$_POST["co-email"];
    $user_pwd = $_POST["co-pwd"];
    $company = $_POST["co-name"];
    $place = $_POST["co-place"];
    $adr= $_POST["co-adr"];
    $contact = $_POST["co-contact"];
    $cperson=$_POST["co-person"];
    $cmpnumber=$_POST["co-number"];
    $vat=$_POST["co-vat"];

    $typeid='3';
    $approvalid='1';
    $imgname=md5(uniqid(rand(), true));
    $log=true;
$msg='';


    //Getting temporary file name stored in php tmp folder
    $tmp_name = $_FILES['photo3']['tmp_name'];

    //Path to store files on server
    $path = 'images/profile/company/img-';

    if(!empty($picname) && $_FILES['photo3']['size']<=5242880) {
        //Moving file to temporary location to upload path
        $allowed =  array('gif','png' ,'jpg','jpeg');

        $ext = pathinfo($picname, PATHINFO_EXTENSION);
        if(!in_array($ext,$allowed) ) {
            $msg= 'Image File is not in valid image format';
            echo '</p>';
            $log=false;
        }

        else
        {

            //Moving file to temporary location to upload path
            move_uploaded_file($tmp_name,$path.$imgname.".".$ext);

            Image::make($path.$imgname.".".$ext)->resize(200, 200)->save();

            $tinypng=new \TinyPNG("h4jkc_z0_71qyCmk4orFRH0ZFOB6PWWg", true);
            $tinypng->compress($path.$imgname.".".$ext, $path.$imgname.".".$ext);


        }
    }
    else{
        //If file not selected displaying a message to choose a file
        $msg= "Image File is over 5 mb in size!";
        echo '</p>';
        $log=false;
    }

    if($log==true) {

        $picpath =$path .$imgname.".".$ext;
        $auth_token = md5(uniqid(rand(), true));
        $user_fname='';
        $user_lname='';

        $fbid='';
        $twid='';
        $cat='';
        $profile='';
        $intro_video='';
        $gender='';
        $dob1='';
        $lang='';
        $bank_name='';
        $accno='';
        $bic='';
        $bankname='';

        $u = new users();

        $status = $u->registeruserbyadmin($user_email, $user_pwd, $typeid, $auth_token, $user_fname, $user_lname, $contact, $company, $adr, $place, $cperson, $cmpnumber, $vat, $fbid, $twid, $cat, $profile, $picpath, $intro_video, $gender, $dob1, $lang, $approvalid,$bankname,$accno,$bic);


        if ($status =="true") {
            //$y= view('index')->with('message','Your Account has been created & will be activated soon');
            $msg = 'Company Account has been created';
        }
        else{
            //$y= view('index')->with('message','Your Account has been created & will be activated soon');
            $msg = 'Company Account already exists';
        }
    }



    return redirect("admin")->with('message',$msg);


}

    public function uploadclientdata()
    {
        include("tinypng.php");
        $data=Input::all();
        $picname = $_FILES['photo']['name'];
        $fname =$_POST["fname"];
        $lname = $_POST["lname"];
        $cemail = $_POST["cemail"];
        $pwd = substr(md5(uniqid(rand(1,6))), 0, 8);
        $contact= $_POST["ccontact"];
        $companyemail=$_POST["companyemail"];

        $function=$_POST["cfunction"];
        $typeid='4';
        $approvalid='1';
        $imgname=md5(uniqid(rand(), true));
        $log=true;
        $msg='';


        $u=new loaddata();
        $compid=$u->getuserid($companyemail);

        //Getting temporary file name stored in php tmp folder
        $tmp_name = $_FILES['photo']['tmp_name'];

        //Path to store files on server
        $path = 'images/profile/img-';

        if(!empty($picname) && $_FILES['photo']['size']<=5242880) {
            //Moving file to temporary location to upload path
            $allowed =  array('gif','png' ,'jpg','jpeg');

            $ext = pathinfo($picname, PATHINFO_EXTENSION);
            if(!in_array($ext,$allowed) ) {
                $msg= 'Image File is not in valid image format';
                echo '</p>';
                $log=false;
            }

            else
            {

                //Moving file to temporary location to upload path
                move_uploaded_file($tmp_name,$path.$imgname.".".$ext);
                Image::make($path.$imgname.".".$ext)->resize(200, 200)->save();

                $tinypng=new \TinyPNG("h4jkc_z0_71qyCmk4orFRH0ZFOB6PWWg", true);
                $tinypng->compress($path.$imgname.".".$ext, $path.$imgname.".".$ext);


            }
        }
        else{
            //If file not selected displaying a message to choose a file
            $msg= "Image File is over 5 mb in size!";
            echo '</p>';
            $log=false;
        }

        if($log==true) {

            $picpath =$path .$imgname.".".$ext;
            $auth_token = md5(uniqid(rand(), true));
            $company=  Session::get('company');;
            $adr='';
            $place='';
            $cperson='';
            $cmpnumber='';
            $vat='';

            $fbid='';
            $twid='';
            $ucatid='';
            $approval_id='1';
            $u = new users();

            //$status = $u->registeruser($cemail,$fname,$lname,$pwd,$typeid,$contact,$company,$adr,$place,$cperson,$cmpnumber,$vat,$fbid,$twid,$ucatid,$approval_id,$picpath,$compid);
            $status = $u->registeruser($cemail,$fname,$lname,$pwd,$typeid,$contact,$function,$company,$adr,$place,$cperson,$cmpnumber,$vat,$fbid,$twid,$ucatid,$approval_id,$picpath,$compid);
            if ($status ==true) {
                //$y= view('index')->with('message','Your Account has been created & will be activated soon');
                $msg = 'Colleague Account has been created';
            }

        }

        return redirect("company")->with('message',$msg);


    }

    public function uploaddata3()
    {
        include("tinypng.php");

        $data=Input::all();
        $picname = $_FILES['photo2']['name'];
        $user_email =$data["co-email"];
        $user_pwd = $data["co-pwd"];
        $company = $data["co-name"];
        $place = $data["co-place"];
        $adr= $data["co-adr"];
        $contact = $data["co-contact"];
        $cperson=$data["co-person"];
        $cmpnumber=$data["co-number"];
        $vat=$data["co-vat"];

        $typeid='3';
        $approvalid='1';
        $imgname=md5(uniqid(rand(), true));
        $log=true;
        $msg='';


        //Getting temporary file name stored in php tmp folder
        $tmp_name = $_FILES['photo2']['tmp_name'];

        //Path to store files on server
        $path = 'images/profile/company/img-';

        if(!empty($picname) && $_FILES['photo2']['size']<=5242880) {
            //Moving file to temporary location to upload path
            $allowed =  array('gif','png' ,'jpg','jpeg');

            $ext = pathinfo($picname, PATHINFO_EXTENSION);
            if(!in_array($ext,$allowed) ) {
                $msg= 'Image File is not in valid image format';
                echo '</p>';
                $log=false;
            }

            else
            {

                //Moving file to temporary location to upload path
                move_uploaded_file($tmp_name,$path.$imgname.".".$ext);

                Image::make($path.$imgname.".".$ext)->resize(200, 200)->save();

                $tinypng=new \TinyPNG("h4jkc_z0_71qyCmk4orFRH0ZFOB6PWWg", true);
                $tinypng->compress($path.$imgname.".".$ext, $path.$imgname.".".$ext);


            }
        }
        else{
            //If file not selected displaying a message to choose a file
            $msg= "Image File is over 5 mb in size!";
            echo '</p>';
            $log=false;
        }

        if($log==true) {

            $picpath =$path .$imgname.".".$ext;
            $auth_token = md5(uniqid(rand(), true));
            $user_fname='';
            $user_lname='';

            $fbid='';
            $twid='';
            $cat='';
            $profile='';
            $intro_video='';
            $gender='';
            $dob1='';
            $lang='';
            $bank_name='';
            $accno='';
            $bic='';
            $bankname='';

            $u = new users();

            $status = $u->registeruserbyadmin($user_email, $user_pwd, $typeid, $auth_token, $user_fname, $user_lname, $contact, $company, $adr, $place, $cperson, $cmpnumber, $vat, $fbid, $twid, $cat, $profile, $picpath, $intro_video, $gender, $dob1, $lang, $approvalid,$bankname,$accno,$bic);


            if ($status =="true") {
                //$y= view('index')->with('message','Your Account has been created & will be activated soon');
                $msg = 'Company Account has been created';
                return redirect("company");
            }

         else
         {
                //$y= view('index')->with('message','Your Account has been created & will be activated soon');
                $msg = 'Company Account already exists';
              return redirect("index")->with('message',$msg);

            }

        }






    }

    public function updatecompanydata()
    {
        $data = Input::all();
        $cmpname = $data["coname"];
        $addr = $data["coadr"];
        $place = $data["coplace"];
        $contact=$data['cocontact'];
        $conumber = $data["cnumber"];
        $vat = $data["vat"];
        $email = $data["email"];
        $coperson = $data["cperson"];

        $log=true;


        $u=new users();
        $status = '';
        $status = $u->updatecompanydata($email, $cmpname,$addr,$place,$contact,$coperson,$conumber,$vat);

        echo  $status;

    }

    public function updateclientdata()
    {
        $data = Input::all();
        $user_fname = $data["fname2"];
        $user_lname = $data["lname2"];
        $contact = $data["ccontact2"];
        $email=$data["clientemail2"];
        $function = $data["cfunction2"];

        $u=new users();
        $status = '';
        $status = $u->updateclientdata($email, $user_fname,$user_lname,$contact,$function);

        echo  $status;

    }


    public function updatedata()
    {
        $data = Input::all();
        $user_fname = $data["coach-fname"];
        $user_lname = $data["coach-lname"];
        $contact = $data["coach-contact"];
        $user_email=Session::get('uemail');
        $gender = $data["coach-gender"];
        $dob = $data["coach-dob"];
        $lang = $data["lang_selected"];
        $profile = $data["profile"];
        $cat = $data["cat"];
        $typeid='2';
        $approvalid='1';
        $bankname=$data["coach-bankname"];
        $accno=$data["coach-accnumber"];
        $bic=$data["coach-bic"];
        $dob1=date('Y-m-d', strtotime($dob));
        $log=true;
        //Getting temporary file name stored in php tmp folder


        //checking file available or not

        $u=new users();
        $status = '';




        $status = $u->updateprofile2($user_email, $user_fname, $user_lname,$contact,$cat, $profile,$gender, $dob1, $lang,$bankname,$accno,$bic);

        echo  $status;

    }

    public function updatedata2()
    {
        $data = Input::all();
        $user_fname = $data["coach-fname2"];
        $user_lname = $data["coach-lname2"];
        $contact = $data["coach-contact2"];
        $user_email=$data["coachemail"];
        $gender = $data["coach-gender2"];
        $dob = $data["coach-dob2"];
        $lang = $data["lang_selected2"];
        $profile = $data["profile2"];
        $cat = $data["cat2"];
        $typeid='2';
        $approvalid='1';
        $bankname=$data["coach-bankname2"];
        $accno=$data["coach-accnumber2"];
        $bic=$data["coach-bic2"];
        $dob1=date('Y-m-d', strtotime($dob));
        $level=$data["coach-level2"];
        $log=true;
        //Getting temporary file name stored in php tmp folder


        //checking file available or not

        $u=new users();
        $status = '';




        $status = $u->updateprofile3($user_email, $user_fname, $user_lname,$contact,$cat, $profile,$gender, $dob1, $lang,$bankname,$accno,$bic,$level);

        echo  $status;

    }

    public function insertmdata()
    {
        $data = Input::all();

        $gendor = $data["gender"];
        $approach = $data["mapproach"];
        $spirit = $data["msprit"];
        $user_email=Session::get('uemail');
        $l=new loaddata();
        $uid=$l->getuserid($user_email);
        $philosphy = $data["mphil"];
        $mentor = $data["mmentor"];
        $board = $data["mboard"];
        $setting = $data["msetting"];
        $pd = $data["mpd"];
        $typeid='2';
        $prd=$data["mprd"];
        $age=$data["mage"];
        $lang=$data["mlang"];


        $u=new users();
        $status = '';

        $status = $u->insertmentality($uid, $typeid, $gendor,$approach,$spirit, $philosphy,$mentor,$board,$setting,$pd,$prd,$age,$lang);

        echo  $status;

    }

    public function qupdate()
    {
        $data = Input::all();

        $qlogin = $data["qlogin"];
        $qpwd = $data["qpwd"];
        $userid = $data["userid"];

        $u = new users();
        $status = $u->updateqid($qlogin,$userid,$qpwd);
        return $status;

    }

    public function adminlogout()
    {
        Session::flush();

        return redirect("adminlogin");

    }

    public function logout()
    {
        Session::flush();

        return redirect("index");

    }

}