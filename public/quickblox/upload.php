<?php
session_start();
include("yveclass.php");
include("connection.php");


 if($_SERVER['REQUEST_METHOD']=='POST'){

     //Getting actual file name
     $picname = $_FILES['photo']['name'];
     $user_email=$_POST["tempemail"];

     $gender=$_POST["gender"];
     $age=$_POST["age"];
     $lang=$_POST["language"];
     $profile=$_POST["profile"];

     //Getting temporary file name stored in php tmp folder
     $tmp_name = $_FILES['photo']['tmp_name'];

     //Path to store files on server
     $path = 'images/profile/img-';

     //checking file available or not
     if(!empty($picname)){
         //Moving file to temporary location to upload path
         move_uploaded_file($tmp_name,$path.$picname);

         $obj=new yveclass();
         $status='';
         $picpath="http://yve.ibuildmart.in/".$path.$picname;
         $email="harvinder.kaur@agicent.com";

         $status=$obj->updateprofile($email,$gender,$age,$lang,$profile,$picpath);

         //Displaying success message
        if($status==true)
        {
            $obj2=new yveclass();
            $from       =   "harvinder.kaur@agicent.com";
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
            <p><strong>Hi</strong></p><p>You received request for the activation of new coach account with the emailid  '.$user_email.'. Please go to the admin panel for the activation.<p><br/><br/><br/>Thanks<br/><br/><strong>Administrator</strong></p>
        </div>
    </div>
    <div style="position: absolute; background-color: #E9E9E9;bottom: 0; height: 40px;padding: 2%; width:96%"></div>
    </div>

    </body>
    </html>';

            $recipient=$user_email;

            $mail=$obj->sendmail($email,$from,$fromName,$subject,$recipient,$body);

echo $mail;
        }
     }else{
         //If file not selected displaying a message to choose a file
         echo "Please choose a file";
     }

     echo 'Your Account has been created & will be activated soon';

 }