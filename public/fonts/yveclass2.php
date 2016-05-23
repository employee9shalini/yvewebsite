<?php
session_start();
require_once 'PassHash.php';
class yveclass

{
    public function checkuser($email,$pwd)
    {


        $q="select password,user_type_id,user_id,qb_login from users where email_id='".$email."' and approval_flag='1';";
        $result=mysqli_query(GetMyConnection(),$q);
        $row=mysqli_fetch_row($result);
        $pwd1 = $row[0];
        $type=$row[1];
        $user_id=$row[2];
        $qb_login=$row[3];
        $blank='';
        if (PassHash::check_password($pwd1, $pwd)) {
            $_SESSION["uemail"] = $email;
            $_SESSION["qblogin"] = $qb_login;

            return $type . "$" . $user_id."$".$qb_login."$".$email;


        }
        else
        {
            return $blank;

        }


    }

    public function getinactiveuser()
    {

        $q="select first_name,last_name,email_id,user_type_id,user_id from users where user_type_id=2 and approval_flag=0";
//$result=mysql_query($q,GetMyConnection());
        $result=mysqli_query(GetMyConnection(),$q);
        $tractive='';
        $trdelete='';
        $trinactive='';

        while($row=mysqli_fetch_array($result))
            //while($row=mysqli_fetch_array($result))
        {

            $name=$row[0]." ".$row[1];
            $tractive=$tractive. '<tr class="tblrow"><td class="">'.$name.'</td><td>'.$row[2].'</td><td>coach</td><td><a  alt='.$row[4].' class=active><img alt='.$row[2].' src=images/thumbs.png height=20></a></td></tr>';

        }


        return $tractive;
    }

    public function getcoach()
    {

        $q2="select first_name,last_name,email_id,user_type_id,user_id from users where user_type_id=2";
//$result=mysql_query($q,GetMyConnection());
        $result2=mysqli_query(GetMyConnection(),$q2);

        $trcoach='';

        while($row2=mysqli_fetch_array($result2))
            //while($row=mysqli_fetch_array($result))
        {

            $name2=$row2[0]." ".$row2[1];
            $trcoach=$trcoach. '<tr class="tblrow"><td class="">'.$name2.'</td><td>'.$row2[2].'</td><td>coach</td><td><a  alt='.$row2[4].' class=delete><img alt='.$row2[2].' src=images/delete.png height=20></a></td></tr>';

        }


        return $trcoach;
    }

    public function getslots()
    {

        $booked_slots=array();

        $q2="SELECT slot_id,start_datetime,end_datetime FROM slots WHERE booked_flag=1 ORDER BY start_datetime ASC";
//$result=mysql_query($q,GetMyConnection());
        $result2=mysqli_query(GetMyConnection(),$q2);

        $trslot='';
$i=0;
        while($row2=mysqli_fetch_array($result2))
            //while($row=mysqli_fetch_array($result))
        {
            $slot_id=$row2[0];
            $start_time=$row2[1];
            $end_time=$row2[2];
            $res[id]=$slot_id;
            $res[start]=$start_time;
            $res[end]=$end_time;
            $res[allday]=true;
            $res[backgroundColor]='#0073b7';
            $res[allday]='#0073b7';

            array_push($booked_slots,$res);

            $i++;

        }


        return json_encode($booked_slots);
    }


    public function getactiveuser()
    {

        $q3="select first_name,last_name,email_id,user_type_id,user_id from users where user_type_id=2 and approval_flag=1";
//$result=mysql_query($q,GetMyConnection());
        $result3=mysqli_query(GetMyConnection(),$q3);

        $trinactive='';

        while($row3=mysqli_fetch_array($result3))
            //while($row=mysqli_fetch_array($result))
        {

            $name3=$row3[0]." ".$row3[1];
            $trinactive=$trinactive. '<tr class="tblrow"><td class="">'.$name3.'</td><td>'.$row3[2].'</td><td>coach</td><td><a  alt='.$row3[4].' class=inactive><img alt='.$row3[2].' src=images/reject.png height=20></a></td></tr>';

        }


        return $trinactive;
    }

    public function activeuser($user_id)
    {

        $q="update users set approval_flag='1' where user_id='".$user_id."';";
        $result=mysqli_query(GetMyConnection(),$q);
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
    public function deleteuser($user_id)
    {

        $q="DELETE from users where user_id='".$user_id."';";
        $result=mysqli_query(GetMyConnection(),$q);
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
    public function inactiveuser($user_id)
    {

        $q="update users set approval_flag='0' where user_id='".$user_id."';";
        $result=mysqli_query(GetMyConnection(),$q);
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

    public function getcatlist()
    {

        $q="select * from categories";
        //$result=mysql_query($q,GetMyConnection());
        $result=mysqli_query(GetMyConnection(),$q);
        $list='';
        $list1='';
        //while($row=mysql_fetch_array($result))
        while($row=mysqli_fetch_array($result))
        {

            $list=$list."<option value=".$row[0].">".$row[1]."</option>";
        }

if($list!='')
{
    $list1="<option value='-Select-'>-Select-</option>".$list;
}

        return $list;


    }

    public function checkfuser($email)
    {
        $status='';
        $q="select contact,first_name,last_name,user_type_id from users where email_id='".$email."';";
        $result=mysqli_query(GetMyConnection(),$q);
        $row=mysqli_fetch_row($result);
        $name=$row[1];
        $contact=$row[0];
        $type=$row[2];
        if($name=='') {
            $status = "false"."#";
        }

        else
        {
            $status = "true".  "#" . $type;
        }
        return $status;

    }

    public function getuserid($email) {
        $q="SELECT user_id FROM users WHERE email_id ='".$email."';";
        $result=mysqli_query(GetMyConnection(),$q);
        $row=mysqli_fetch_row($result);
        $user_id=$row[0];

        return $user_id;
    }

    public function getqbid($uid) {
        $q="SELECT qb_login FROM users WHERE user_id ='".$uid."';";
        $result=mysqli_query(GetMyConnection(),$q);
        $row=mysqli_fetch_row($result);
        $qb_id=$row[0];
        return $qb_id;
    }

    public function updatefbid($email,$fbid)
    {
        $q="update users set facebook_id='".$fbid."' where email_id='".$email."';";
        $result=mysqli_query(GetMyConnection(),$q);
        $status='';
        return $status;
    }

    public function updateqid($qid,$userid)
    {
        $q="update users set qb_login='".$qid."' where user_id=".$userid.";";
        $result=mysqli_query(GetMyConnection(),$q);
        $status='';
        if($result)
        {
            $status="true";
        }
        return $status;
    }

    public function resetpwd($email,$pwd)
    {
        $pwd1 = PassHash::hash(pwd);
        $q="update users set password='".$pwd1."' where email_id='".$email."';";
        $result=mysqli_query(GetMyConnection(),$q);
        $status="";
        if($result)
        {
            $status="true";
        }
return $status;
    }

    public function registeruser($email,$fname,$lname,$pwd,$typeid,$contact,$company,$adr,$place,$cperson,$cmpnumber,$vat,$fbid,$twid,$catid,$approvalid)
    {

        $q="select email_id,about_info from users where email_id='".$email."';";
        $result=mysqli_query(GetMyConnection(),$q);
        $row=mysqli_fetch_row($result);
        $emailid=$row[0];
        $about_info=$row[1];
        $screen='';
        $pwd1 = PassHash::hash($pwd);
        $auth_token=md5(uniqid(rand(), true));
        if($email!=$emailid && $about_info=='') {
            $screen='insert';
            $q2 = "insert into users(user_id,email_id,password,user_type_id,auth_token,first_name,last_name,contact,company,address,place,company_contact_person,company_contact_number,vat,facebook_id,twitter_id,category_id,about_info,profile_pic,intro_video,gender,age,language,approval_flag,date_created,level_id) Values('','" . $email . "','" . $pwd1 . "','" . $typeid . "','" . $auth_token . "','" . $fname . "','" . $lname . "','" . $contact . "','" . $company . "','" . $adr . "','" . $place . "','" . $cperson . "','" . $cmpnumber . "','" . $vat . "','" . $fbid . "','" . $twid . "','" . $catid . "','','','','','','','".$approvalid."',UTC_TIMESTAMP(),'')";
            $result2 = mysqli_query(GetMyConnection(), $q2);


            if ($result2) {
                $status = "true";
                $_SESSION["uemail"] = $email;
                $_SESSION["qblogin"] = '';

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

    public function updateprofile($email,$gender,$age,$lang,$profiletxt,$picpath)
    {
        $q="update users set about_info='".$profiletxt."',gender='".$gender."',age='".$age."',language='".$lang."',profile_pic='".$picpath."'
        where email_id='".$email."';";
        //$result=mysqli_query(GetMyConnection(),$q);
        $result=mysqli_query(GetMyConnection(),$q);
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

    public function sendmail($user_email,$from,$fromName,$subject,$recipient,$body)
    {

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1rn' . "\r\n";
        $headers .= "From: $fromName <$from>\r\n".
            "CC: patle@agicent.com";

       if (mail($recipient, $subject, $body, $headers))

            $status='true';
        else
            $status='false';
        //return 'Your Account has been created & will be activated soon';
        //return $status;

        return 'Your Account has been created & will be activated soon';
    }
}

?>