<?php

/**
 * Created by PhpStorm.
 * User: Narendra
 * Date: 3/25/2015
 * Time: 3:47 PM
 */
require_once 'PassHash.php';
require_once 'createsession.php';

class DbHandler
{

    private $conn;

    function __construct()
    {
        require_once dirname(__FILE__) . '/DbConnect.php';
        require_once dirname(__FILE__) . '/Constants.php';

        // opening db connection
        $db = new DbConnect();
        $this->conn = $db->connect();
    }

    public function userSignUpViaEmail($user_email, $user_pwd, $user_phone,$user_fname,$user_lname){

        // Generating API key
        $token = $this->generateApiKey();


// Encrypt $string
        $user_pwd1 = PassHash::hash($user_pwd);

            $query  =  "insert into users(user_id,
            email_id,
            password,
            user_type_id,
            auth_token,
            first_name,
            last_name,
            contact,
            company,
            address,
            place,
            company_contact_person,
            company_contact_number,
            vat,
            facebook_id,
            twitter_id,
            category_id,
            about_info,
            profile_pic,
            intro_video,
            gender,
            dob,
            language,
            approval_flag,
            date_created,
            level_id,
            qb_login,
            qb_id)
Values('',
?,
?,
1,
'".$token."',
?,
?,
?,
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
'',
1,
UTC_TIMESTAMP(),
'',
'',
'')";

            // Check for successful insertion
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sssss',$user_email,$user_pwd1,$user_fname,$user_lname,$user_phone);
        $res = $stmt->execute();
        $stmt->close();

        $user_id=$this->getUserId($token);


        $qb_log1="yveqb".$user_id;
        $qb_pwd1=substr(md5(uniqid(rand(1,6))), 0, 8);
        $qb_id1=$this->qbsignup($qb_log1,$qb_pwd1,$user_id);

        if($res){

            $response["Token"] = $token;
            $response["quickblox_login"]=$qb_log1;
            $response["quickblox_pwd"]=$qb_pwd1;

            $response["user_type_id"]="1";
            $response["name"]=$user_fname." ".$user_lname;
			
			


        }
       else {
           $response["status"] = REQUEST_ACCEPTED;

       }

        return $response;
    }

    public function userSignInViaEmail($user_email, $user_pwd1){

        $query  =  "select user_id,password,auth_token,qb_login,qb_id,qb_pwd,user_type_id,first_name,last_name,profile_pic from users where email_id=?";

        $stmt   =   $this->conn->prepare($query);
        $stmt->bind_param('s',$user_email);
        $stmt->execute();
       $stmt->bind_result($user_id,$user_pwd,$auth_token,$qb_login,$qb_id,$qb_pwd,$user_type_id,$fname,$lname,$pic);
        $stmt->fetch();
        $stmt->close();

        $qb_id1='';
        $qb_log1='';
        $user_type='';

        $pwd=$user_pwd;

        if (PassHash::check_password($pwd, $user_pwd1)) {

            if($qb_login=='')
            {
                $qb_log1="yveqb".$user_id;
                $qb_pwd1=substr(md5(uniqid(rand(1,6))), 0, 8);
                $qb_id1=$this->qbsignup($qb_log1,$qb_pwd1,$user_id);

            }


        else
            {
                $qb_id1=$qb_id;
                $qb_log1=$qb_login;
                $qb_pwd1=$qb_pwd;
            }

            if($user_type_id=='1')
            {
                $user_type='Private Client';
            }

            if($user_type_id=='4')
            {
                $user_type='Corporate Client';
            }

            $response["Token"] = $auth_token;
            $response["quickblox_login"]=$qb_log1;
            $response["quickblox_pwd"]=$qb_pwd1;
            $response["user_type_id"]=$user_type_id;
            $response["name"]=$fname." ".$lname;
            if($pic=='')
            {
                $response["profile_image"] ='';
            }

            else {
                $response["profile_image"] = "http://$_SERVER[HTTP_HOST]/" . $pic;
            }
			$response["status"] = SUCCESS;

        } else {
            // user password is incorrect
            $response["status"] = UNAUTHORIZED;

        }

        return $response;
    }

    public function save_mentality_match($user_id, $typeid, $gendor,$approach,$spirit, $philosphy,$mentor,$board,$setting,$pd,$prd,$age,$lang)
    {
        $stmt = $this->conn->prepare("SELECT serial_number FROM mentality_match WHERE user_id = ".$user_id);

        if($stmt->execute()) {
            $stmt->bind_result($sno);
            $stmt->fetch();
            $stmt->close();
        }
if($sno!='') {
    $response["status"] = CONFLICT;
}

else
{
    $query2 = "insert into mentality_match(serial_number,
            user_id,
            user_type_id,
            q1_ans,
            q2_ans,
            q3_ans,
            q4_ans,
            q5_ans,
            q6_ans,
            q7_ans,
            q8_ans,
            q9_ans,
            q10_ans,
            q11_ans

            )
Values('',
$user_id,
$typeid,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?,
?
)";

    $stmt2 = $this->conn->prepare($query2);
    $stmt2->bind_param('sssssssssss', $gendor, $approach, $spirit, $philosphy, $mentor, $board, $setting, $pd, $prd, $age, $lang);
    $res = $stmt2->execute();

    $stmt2->close();

    if ($res) {
        $response["status"] = SUCCESS;
    } else {
        $response["status"] = REQUEST_ACCEPTED;
    }


}

return $response;

        }

    public function sendforgotpwdlink($user_email)
    {
        $stmt = $this->conn->prepare("SELECT email_id from users WHERE email_id = ?");
        $stmt->bind_param('s', $user_email);
        $stmt->execute();
        $stmt->bind_result($user_email1);
        $stmt->fetch();
        $stmt->close();

        if ($user_email1 != '') {
            $response["status"] = SUCCESS;

        } else {
            $response["status"] = NOT_FOUND;



        }
return $response;
    }


    public function qbsignup($login1,$pwd1,$user_id)
    {
        $appId=31919;
        $authKey="EhV9Sqb7Gc4LZz5";
        $authSecret= "sPUTkeEOZc2ntCA";
        $login="ravindra.gupta";
        $password="ravi@agicent";

        $session = createSession($appId, $authKey, $authSecret, $login, $password);
        $token = $session->token;

        $request = '{"user": {"login": "'.$login1.'", "password": "'.$pwd1.'"}}';

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

        $json = json_decode($pretty, true);
        foreach ($json as $key => $obj) { // This will search in the 2 jsons
            foreach($obj as $key => $value) {
                if($key == 'id'){
                    $qb_id=$value;

                }
            }


        }


        $query =   "UPDATE users
                    SET    qb_login = ?,
                           qb_id = ?,
                           qb_pwd=?
                    WHERE  user_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sisi',$login1,$qb_id,$pwd1,$user_id);
        $result = $stmt->execute();
        $stmt->close();

        return  $qb_id;
    }


    public function sendmail($user_email,$subject,$body)
    {

        $from       =   "harvinder.kaur@agicent.com";
        $fromName   =   "YVE";

        $recipient=$user_email;

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1rn' . "\r\n";
        $headers .= "From: $fromName <$from>\r\n".
            "CC:patle@agicent.com";


        if (mail($recipient, $subject, $body, $headers)) {

            $response["status"] = SUCCESS;
        }

        else
        {
            $response["status"] = REQUEST_ACCEPTED;
        }

               return $response;
    }

    public function getCoachCategories(){

        $query =   "SELECT category_id,
                           category_name
                           FROM   categories ORDER BY category_id";

        $stmt   =   $this->conn->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->bind_result($category_id,$category_name);
        $stmt->store_result();


        $coach_categories["coach_categories"] = array();

        while($stmt->fetch()) {
            $res["category_id"] = $category_id;
            $res["category_name"] = $category_name;
            array_push($coach_categories["coach_categories"], $res);

        }

        $stmt->close();

        $response=$coach_categories;
        return $response;

    }



    public function searchCoach($page_no,$row_count,$timezone,$searched_text,$uid){

        $offset     = ($row_count)*($page_no - 1);
        $query =   "SELECT user_id,email_id,
                           IFNULL(first_name,''),
                           IFNULL(last_name,''),
                            IFNULL(about_info,''),
                            IFNULL(profile_pic,''),
                            IFNULL(gender,''),
                            IFNULL(dob,''),
                            IFNULL(language,''),
                            IFNULL(intro_video,''),
							IFNULL(level_id,''),
                           IFNULL(category_id,''),
                           date_created
                    FROM   users where user_type_id='2' AND approval_flag='1' AND
                    (first_name LIKE '%$searched_text%' OR last_name LIKE '%$searched_text%')
        ORDER  BY date_created DESC
                    LIMIT  $offset , " . ($row_count + 1);



        $stmt   =   $this->conn->prepare($query);
        $stmt->execute();
        //$stmt->bind_param('s',$searched_text);
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->bind_result($user_id,$email_id,$first_name,$last_name,$about_info,$profile_pic,$gender,$dob,$language,$intro_video,$level_id,$cat_id,$date_created);
        $stmt->store_result();


        $coach_list["coaches"] = array();
        $counter    =   0;


        if ($num_rows > ($row_count))
            $coach_list["next_page"] = "true";
        else
            $coach_list["next_page"] = "false";

        while($stmt->fetch()) {
            $res["user_id"] = $user_id;
            $res["email_id"] = $email_id;
            $res["name"] = $first_name." ".$last_name;
            $res["about_info"] = $about_info;

            $res["profile_pic"]='';
            if($profile_pic!='') {
                $res["profile_pic"] = "http://$_SERVER[HTTP_HOST]/" . $profile_pic;
            }
            $res["gender"]=$gender;
            $res["dob"]=$dob;
            $res["language"]=$language;
            $res["into_video"]='';
            if($intro_video!='') {
                $res["into_video"]="http://$_SERVER[HTTP_HOST]/" .$intro_video;
            }
			$res["level"]=$level_id;
            $res["category_id"]=$cat_id;
            $res["favourite_flag"]=$this->getfavflag($uid,$user_id);

            if($date_created=='0000-00-00 00:00:00')
            {
                $res["date_created"]=$date_created;
            }
            else
            {
                $res["date_created"]=$this->ConvertGMTToLocalTimezone($date_created,$timezone);
            }

            array_push($coach_list["coaches"], $res);
            $counter++;
            if ($counter == ($row_count))
                break;

        }

        $stmt->close();

        if($num_rows>0){
            return $coach_list;
        }
        else{
            return false;
        }


    }

    public function getAllCoaches1($page_no,$row_count,$timezone){

        $offset     = ($row_count)*($page_no - 1);
        $query =   "SELECT user_id,email_id,
                            IFNULL(first_name,''),
                            IFNULL(last_name,''),
                            IFNULL(about_info,''),
                            IFNULL(profile_pic,''),
                            IFNULL(gender,''),
                            IFNULL(dob,''),
                            IFNULL(language,''),
                            IFNULL(intro_video,''),
                            IFNULL(category_id,''),
						    IFNULL(level_id,''),
                           date_created
                    FROM   users where user_type_id=2 AND approval_flag=1
            ORDER  BY date_created DESC
                    LIMIT  $offset , " . ($row_count + 1);

        $stmt   =   $this->conn->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->bind_result($user_id,$email_id,$first_name,$last_name,$about_info,$profile_pic,$gender,$dob,$language,$intro_video,$cat_id,$level_id,$date_created);
        $stmt->store_result();


        $coach_list["coaches"] = array();
        $counter    =   0;


        if ($num_rows > ($row_count))
            $coach_list["next_page"] = "true";
        else
            $coach_list["next_page"] = "false";

        while($stmt->fetch()) {

            $res["user_id"] = $user_id;
            $res["email_id"] = $email_id;
            $res["name"] = $first_name." ".$last_name;
            $res["about_info"] = $about_info;
            $res["profile_pic"]='';
            if($profile_pic!='') {
                $res["profile_pic"] = "http://$_SERVER[HTTP_HOST]/" . $profile_pic;
            }
            //$res["profile_pic"]="http://$_SERVER[HTTP_HOST]/".$profile_pic;
            $res["gender"]=$gender;
            $res["dob"]=$dob;
            $res["language"]=$language;
			$res["level_id"]=$level_id;
            $res["into_video"]='';
            if($intro_video!='') {
                $res["into_video"] = "http://$_SERVER[HTTP_HOST]/" . $intro_video;
            }
            $res["category_id"]=$cat_id;

           // $res["favourite_flag"]=$this->getfavflag($user_id);

            if($date_created=='0000-00-00 00:00:00')
            {
                $res["date_created"]=$date_created;
            }
            else
            {
                $res["date_created"]=$this->ConvertGMTToLocalTimezone($date_created,$timezone);
            }


            array_push($coach_list["coaches"], $res);
            $counter++;
            if ($counter == ($row_count))
                break;

        }

        $stmt->close();

        if($num_rows>0){
            return $coach_list;
        }
        else{
            return false;
        }


    }

    public function getAllCoaches($user_id,$page_no,$row_count,$timezone)
    {
        $query = "SELECT user_id,q1_ans,q2_ans,q3_ans,q4_ans,q5_ans,q6_ans,q7_ans,q8_ans,q9_ans,q10_ans,q11_ans from mentality_match
      where user_type_id=1 and user_id=?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        $stmt->bind_result($client_id,$q1_ans, $q2_ans, $q3_ans, $q4_ans, $q5_ans, $q6_ans, $q7_ans, $q8_ans, $q9_ans, $q10_ans, $q11_ans);
        $stmt->fetch();
        $stmt->close();

        $list = array();
        $matched="false";


        if($client_id!='') {
            $query2 = "SELECT user_id,q1_ans,q2_ans,q3_ans,q4_ans,q5_ans,q6_ans,q7_ans,q8_ans,q9_ans,q10_ans,q11_ans from mentality_match
      where user_type_id=2";

            $stmt2 = $this->conn->prepare($query2);
            $stmt2->execute();
            $stmt2->bind_result($coach_id, $q1_ans1, $q2_ans1, $q3_ans1, $q4_ans1, $q5_ans1, $q6_ans1, $q7_ans1, $q8_ans1, $q9_ans1, $q10_ans1, $q11_ans1);
            $stmt2->store_result();
            $coach_list["coaches"] = array();
            $q2arr=explode(",",$q2_ans);


            while ($stmt2->fetch()) {
                $sum = 0;
                $q2arr1=explode(",",$q2_ans1);
                $matched_string = array_intersect($q2arr1, $q2arr);
                $q2_matched_count=count($matched_string);

                if($q2_matched_count==0)
                {
                    $sum=0;
                }

                else
                {
                    $sum=$q2_matched_count;
                }

                if ($q1_ans1 == $q1_ans) {
                    $sum = (int)$sum + 1;

                }

                if ($q3_ans1 == $q3_ans) {
                    $sum = (int)$sum + 1;

                }
                if ($q4_ans1 == $q4_ans) {
                    $sum = (int)$sum + 1;

                }
                if ($q5_ans1 == $q5_ans) {
                    $sum = (int)$sum + 1;

                }
                if ($q6_ans1 == $q6_ans) {
                    $sum = (int)$sum + 1;

                }
                if ($q7_ans1 == $q7_ans) {
                    $sum = (int)$sum + 1;

                }

                if ($q8_ans1 == $q8_ans) {
                    $sum = (int)$sum + 1;

                }

                if ($q9_ans1 == $q9_ans) {
                    $sum = (int)$sum + 1;

                }

                if ($q10_ans1 == $q10_ans) {
                    $sum = (int)$sum + 1;

                }

                if ($q11_ans1 == $q11_ans) {
                    $sum = (int)$sum + 1;

                }

                if($sum!=0) {
                    $arr = array($sum, $coach_id);
                    array_push($list, $arr);
                }


            }
            arsort($list);



            for ($i = 0; $i < count($list); $i++) {
                $l = $list[$i];

                for ($j = 0; $j < count($l); $j++) {
                }
                $uid = $l[1];


                $offset = ($row_count) * ($page_no - 1);
                $query = "SELECT email_id,
               IFNULL(first_name,''),
               IFNULL(last_name,''),
                IFNULL(about_info,''),
                IFNULL(profile_pic,''),
                IFNULL(gender,''),
                IFNULL(dob,''),
                IFNULL(language,''),
                IFNULL(intro_video,''),
               IFNULL(category_id,''),
			   IFNULL(level_id,''),
               date_created
        FROM   users where user_type_id=2 AND approval_flag=1 AND user_id=?";


                $stmt = $this->conn->prepare($query);
                $stmt->bind_param('i', $uid);
                $stmt->execute();
                $stmt->store_result();
                $num_rows = $stmt->num_rows;
                $stmt->bind_result($email_id, $first_name, $last_name, $about_info, $profile_pic, $gender, $dob, $language, $intro_video, $cat_id,$level_id, $date_created);
                $stmt->store_result();
                $stmt->fetch();
                $res["user_id"] = $uid;
                $res["email_id"] = $email_id;
                $res["name"] = $first_name . " " . $last_name;
                $res["about_info"] = $about_info;
                $res["profile_pic"] = '';
                if ($profile_pic != '') {
                    $res["profile_pic"] = "http://$_SERVER[HTTP_HOST]/" . $profile_pic;
                }
                //$res["profile_pic"]="http://$_SERVER[HTTP_HOST]/".$profile_pic;
                $res["gender"] = $gender;
                $res["dob"] = $dob;
                $res["language"] = $language;
                $res["into_video"] = '';

                if ($intro_video != '') {
                    $res["into_video"] = "http://$_SERVER[HTTP_HOST]/" . $intro_video;
                }
                $res["category_id"] = $cat_id;
			    $res["favourite_flag"] = $this->getfavflag($user_id,$uid);
				$res["level"] = $level_id;
                
				if ($date_created == '0000-00-00 00:00:00') {
                    $res["date_created"] = $date_created;
                } else {
                    $res["date_created"] = $this->ConvertGMTToLocalTimezone($date_created, $timezone);
                }


                array_push($coach_list["coaches"], $res);
                $stmt->close();

            }

            if(count($l)>$row_count)
            {
                $coach_list["next_page"] = "true";
            }

            else
            {

                $coach_list["next_page"] = "false";
            }

            if (count($l) > 0) {

                $matched="true";
                return $coach_list;
            } else {
                $matched="false";
            }




        }

        if($client_id=='' || $matched=='false')
        {
            $offset     = ($row_count)*($page_no - 1);
            $query2 =  "SELECT user_id,email_id,
                       IFNULL(first_name,''),
                       IFNULL(last_name,''),
                        IFNULL(about_info,''),
                        IFNULL(profile_pic,''),
                        IFNULL(gender,''),
                        IFNULL(dob,''),
                        IFNULL(language,''),
                        IFNULL(intro_video,''),
                       IFNULL(category_id,''),
					   IFNULL(level_id,''),
					   
                       date_created
                FROM   users where user_type_id=2 AND approval_flag=1
        ORDER  BY date_created DESC
                LIMIT  $offset , " . ($row_count + 1);

            $stmt2   =   $this->conn->prepare($query2);
            $stmt2->execute();
            $stmt2->store_result();
            $num_rows2 = $stmt2->num_rows;
            $stmt2->bind_result($user_id1,$email_id,$first_name,$last_name,$about_info,$profile_pic,$gender,$dob,$language,$intro_video,$cat_id,$level_id,$date_created);
            $stmt2->store_result();


            $coach_list["coaches"] = array();
            $counter    =   0;
            if ($num_rows2 > ($row_count))
                $coach_list["next_page"] = "true";
            else
                $coach_list["next_page"] = "false";

            while($stmt2->fetch()) {

                $res["user_id"] = $user_id1;
                $res["email_id"] = $email_id;
                $res["name"] = $first_name . " " . $last_name;
                $res["about_info"] = $about_info;
                $res["profile_pic"] = '';
                if ($profile_pic != '') {
                    $res["profile_pic"] = "http://$_SERVER[HTTP_HOST]/" . $profile_pic;
                }
                //$res["profile_pic"]="http://$_SERVER[HTTP_HOST]/".$profile_pic;
                $res["gender"] = $gender;
                $res["dob"] = $dob;
                $res["language"] = $language;
                $res["into_video"] = '';
                if ($intro_video != '') {
                    $res["into_video"] = "http://$_SERVER[HTTP_HOST]/" . $intro_video;
                }
                $res["category_id"] = $cat_id;
			    $res["favourite_flag"] = $this->getfavflag($user_id,$user_id1);
				$res["level"] = $level_id;

                if ($date_created == '0000-00-00 00:00:00') {
                    $res["date_created"] = $date_created;
                } else {
                    $res["date_created"] = $this->ConvertGMTToLocalTimezone($date_created, $timezone);
                }


                array_push($coach_list["coaches"], $res);
                $counter++;
                if ($counter == ($row_count))
                    break;


            }

            return $coach_list;


        }


    }

    public function getMyCoaches($page_no,$row_count,$userid,$timezone){

    $offset     = ($row_count)*($page_no - 1);
    $query =   "SELECT DISTINCT coach_user_id
                    FROM   sessions where client_user_id=?
                    ORDER  BY start_datetime DESC
                    LIMIT  $offset , " . ($row_count + 1);

    $stmt   =   $this->conn->prepare($query);
    $stmt->bind_param('i',$userid);
    $stmt->execute();
    $num_rows = $stmt->num_rows;
    $stmt->bind_result($coach_user_id);
    $stmt->store_result();
    $coach_list["my_coaches"] = array();
    $counter    =   0;

    if ($num_rows > ($row_count))
        $coach_list["next_page"] = "true";
    else
        $coach_list["next_page"] = "false";

    while($stmt->fetch()) {
        $res["coach_user_id"] = $coach_user_id;

        $query2="select email_id,
            IFNULL(first_name,''),
            IFNULL(last_name,''),
            IFNULL(about_info,''),
            IFNULL(profile_pic,''),
            IFNULL(category_id,''),
            IFNULL(dob,''),
            IFNULL(language,'') from users WHERE user_id=?";

        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bind_param('i',$coach_user_id);
        $stmt2->execute();
        $stmt2->store_result();
        $num_rows2   =   $stmt2->num_rows;
        $stmt2->bind_result($email_id,$first_name,$last_name,$about_info,$profile_pic,$category_id,$dob,$language);

        $res["coach_name"] = '';
        $res["coach_about_info"] ='';
        $res["category_id"]='';
        $res["coach_profile_pic"]='';

        while($stmt2->fetch()) {

            $res["coach_name"] = $first_name." ".$last_name;
            $res["coach_about_info"] = $about_info;
            $res["category_id"]=$category_id;
            $res["coach_profile_pic"]='';

            if($profile_pic!='') {
                $res["coach_profile_pic"] = "http://$_SERVER[HTTP_HOST]/" . $profile_pic;
            }

        }

        $query3="select session_id,
 IFNULL(start_datetime,''),
 IFNULL(end_datetime,''),
 IFNULL(notes,'')
from sessions WHERE coach_user_id=? and client_user_id=?";
        $stmt3 = $this->conn->prepare($query3);
        $stmt3->bind_param('ii',$coach_user_id,$userid);
        $stmt3->execute();
        $stmt3->store_result();
        $num_rows3   =   $stmt3->num_rows;
        $stmt3->bind_result($session_id,$sdt,$ldt,$notes);
        $res["sessions"] = array();

        $res1["session_id"] = '';
        $res1["session_start"] = '';
        $res1["session_end"] = '';
        $res1["session_notes"] = '';

        while($stmt3->fetch()) {
            if (trim($sdt) != '0000-00-00 00:00:00' && trim($ldt) != '0000-00-00 00:00:00') {

                $res1["session_id"] = $session_id;
                $res1["session_start"] = $this->ConvertGMTToLocalTimezone($sdt,$timezone);
                $res1["session_end"] = $this->ConvertGMTToLocalTimezone($ldt,$timezone);
                $res1["session_notes"] = $notes;

                array_push($res["sessions"], $res1);
            }
        }



        array_push($coach_list["my_coaches"], $res);
        $counter++;
        if ($counter == ($row_count))
            break;

    }

    if($num_rows2>0){
        return $coach_list;
    }
    else{
        return false;
    }

}

     public function getproposedcoaches($category_id,$page_no,$timezone,$row_count,$uid){


        $offset     = ($row_count)*($page_no - 1);
        $query =   "SELECT user_id,email_id,
                           IFNULL(first_name,''),
                           IFNULL(last_name,''),
                            IFNULL(about_info,''),
                            IFNULL(profile_pic,''),
                            IFNULL(gender,''),
                            IFNULL(dob,''),
                            IFNULL(language,''),
                            IFNULL(category_id,''),
                            IFNULL(intro_video,''),
							IFNULL(level_id,''),
                            date_created
                    FROM   users WHERE FIND_IN_SET(?, category_id)
                    AND approval_flag=1
                    ORDER  BY date_created DESC
                    LIMIT  $offset , " . ($row_count + 1);

        $stmt   =   $this->conn->prepare($query);
        $stmt->bind_param('i',$category_id);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->bind_result($user_id,$email_id,$first_name,$last_name,$about_info,$profile_pic,$gender,$dob,$language,$cat_id,$intro_video,$level_id,$date_created);
        $stmt->store_result();


        $coach_list["proposed_coaches"] = array();
        $counter    =   0;


        if ($num_rows > ($row_count))
            $coach_list["next_page"] = "true";
        else
            $coach_list["next_page"] = "false";

        while($stmt->fetch()) {
            $res["user_id"] = $user_id;
            $res["email_id"] = $email_id;
            $res["name"] = $first_name." ".$last_name;
            $res["about_info"] = $about_info;

            $res["profile_pic"]='';

            if($profile_pic!='') {
                $res["profile_pic"] = "http://$_SERVER[HTTP_HOST]/" . $profile_pic;
            }

            $res["gender"]=$gender;
            $res["dob"]=$dob;
            $res["language"]=$language;
            $res["into_video"]='';
            if($intro_video!='') {
                $res["into_video"] ="http://$_SERVER[HTTP_HOST]/" . $intro_video;
            }
			$res["level"]=$level_id;
            $res["category_id"]=$cat_id;
           $res["favourite_flag"]=$this->getfavflag($uid,$user_id);

            if($date_created=='0000-00-00 00:00:00')
            {
                $res["date_created"]=$date_created;
            }
            else
            {
                $res["date_created"]=$this->ConvertGMTToLocalTimezone($date_created,$timezone);
            }

            array_push($coach_list["proposed_coaches"], $res);
            $counter++;
            if ($counter == ($row_count))
                break;

        }

        $stmt->close();

        if($num_rows>0){
            return $coach_list;
        }
        else{
            return false;
        }

    }

    public function getProfiledata($user_id){

        $query =   "Select IFNULL(first_name,''),
                    IFNULL(last_name,''),
                    IFNULL(email_id,''),
                    IFNULL(about_info,''),
                    IFNULL(profile_pic,'')
                            from users
                          WHERE  user_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;

        $stmt->bind_result($first_name,$last_name,$email,$biography_text,$profile_pic);



        while($stmt->fetch()) {
            $res["name"] = $first_name." ".$last_name;
            $res["email_id"]=$email;
            $res["biography_text"]=$biography_text;

            $res["profile_image"]='';

            if($profile_pic!='') {
                $res["profile_image"] = "http://$_SERVER[HTTP_HOST]/" . $profile_pic;
            }

        }
        $stmt->close();
        $response["client_profile"]=$res;

        if($num_rows>0){
            return $response;
        }
        else{
            return false;
        }
    }

    public function getPaymentMethodInfo($user_id){

    $query =  "Select card_id,card_type,cardholder_name,card_number,expiry_date,cvv_number,default_flag from card_info
                          WHERE  user_id = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('i',$user_id);
    $stmt->execute();
    $stmt->store_result();
    $num_rows = $stmt->num_rows;

    $stmt->bind_result($card_id,$card_type,$cardholder_name,$card_number,$expiry_date,$cvv_number,$default_flag);

    $usercreditinfo["credit_cards_info"] = array();

    while($stmt->fetch()) {
        $res["card_id"] = $card_id;
        $res["card_type"]=$card_type;
        $res["cardholder_name"]=$cardholder_name;
        $res["card_number"]=$card_number;
        $res["expiry_date"]=$expiry_date;
        $res["cvv_number"]=$cvv_number;
        $res["default_flag"]=$default_flag;
		array_push($usercreditinfo["credit_cards_info"], $res);
    }
    $stmt->close();
	
	
	$query2 =  "Select paypal_id,transaction_token, metadata from paypal_dump WHERE  user_id = ? and transaction_flag = '0'";

		$stmt2 = $this->conn->prepare($query2);
		$stmt2->bind_param('i',$user_id);
		$stmt2->execute();
		$stmt2->store_result();
		$num_rows2 = $stmt2->num_rows;
	
		$stmt2->bind_result($paypal_id,$transaction_token,$metadata);
	
		$usercreditinfo["paypal_info"] = array();
	
		while($stmt2->fetch()) {
			$res2["paypal_id"] = $paypal_id;
			$res2["transaction_token"]=$transaction_token;
			$res2["metadata"]=$metadata;
			array_push($usercreditinfo["paypal_info"], $res2);
		}
		$stmt2->close();
		
		$query3 =  "Select default_payment_method from users WHERE  user_id = ?";
		$stmt3 = $this->conn->prepare($query3);
		$stmt3->bind_param('i',$user_id);
		$stmt3->execute();
		$stmt3->store_result();
		$num_rows3 = $stmt3->num_rows;
		
		$payment_method["default_payment_method"] = array();
		
		$stmt3->bind_result($default_payment_method);
		$stmt3->fetch();
		$res3["default_payment_method"] = $default_payment_method;
		
		$stmt3->close();
		$usercredit["payment_methods"] = array();
		
		$usercreditinfo["default_payment_method"] = $default_payment_method;
	    $usercredit["payment_methods"] = $usercreditinfo;
	   
	    $response=$usercredit; 
        $response["credit_cards_info"]=$usercreditinfo;
	   
    if($num_rows>0){
        return  $response["credit_cards_info"];
    }
    else{
        return false;
    }
}

    public function savePaymentInfo($user_id,$session_id,$payment_method_id, $paypal_transaction_id,$card_id,$amount,$currency_type,$credit_qty)
    {
        $paypal_data="";
        $credit_cards_data="";

        $query="SELECT transaction_token FROM paypal_dump WHERE user_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute())
        {
            $stmt->bind_result($transaction_token);
            $stmt->fetch();
            $stmt->close();

            if($transaction_token=="")
            {
                $query3="SELECT card_number FROM card_info WHERE user_id=?";
                $stmt3 = $this->conn->prepare($query3);
                $stmt3->bind_param("i", $user_id);

                if ($stmt3->execute())
                {
                    $stmt3->bind_result($card_number);
                    $stmt3->fetch();
                    $stmt3->close();

                    if($card_number=="")
                    {
                        $query4 = "UPDATE users set default_payment_method=2 WHERE  user_id=?";
                        $stmt4 = $this->conn->prepare($query4);
                        $stmt4->bind_param('i',$user_id);
                        $stmt4->execute();
                        $stmt4->close();
                    }
                }
            }
        }


        $query =   "INSERT INTO payments(
            transaction_id,
            user_id,
            session_id,
            payment_method_id,
            paypal_transaction_id,
            card_id,
            amount,
	        currency_type,
            credit_qty,
            payment_date)

        VALUES
        (
        '',
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
	?,
	?,
	 UTC_TIMESTAMP())";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('iiiiisss',$user_id,$session_id,$payment_method_id,$paypal_transaction_id,$card_id,$amount,$currency_type,$credit_qty);
        $result = $stmt->execute();
        if($result)
            return TRUE;
        else
            return FALSE;



    }


    public function saveSessionInfo($slot_id,$coach_id,$client_id,$start_dt,$end_dt,$notes){

        $query = "INSERT INTO sessions(
            session_id,
            slot_id,
            coach_user_id,
            client_user_id,
            start_datetime,
            end_datetime,
            notes)
        VALUES
        (
        '',
        ?,
        ?,
        ?,
        ?,
        ?,
       ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('iiisss',$slot_id,$coach_id,$client_id,$start_dt,$end_dt,$notes);
        $result = $stmt->execute();
        if($result)
            return TRUE;
        else
            return FALSE;


    }

    public function saveReviews($coach_id,$client_id,$review,$rating){


        $query =   "INSERT INTO reviews(
            review_id,
            coach_user_id,
            client_user_id,
            review,
            rating,
            publish_flag,
            date_create)
        VALUES
        (
        '',
        ?,
        ?,
        ?,
        ?,
        1,
       UTC_TIMESTAMP())";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('iisi',$coach_id,$client_id,$review,$rating);
        $result = $stmt->execute();
        if($result)
            return TRUE;
        else
            return FALSE;



    }

    public function saveCreditCardInfo($user_id,$card_type,$cardholder_name,$card_number,$expiry_date,$cvv_number){

        $query="SELECT card_number from card_info WHERE user_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            $stmt->bind_result($card_no);
            $stmt->fetch();
            $stmt->close();

        }

        $default_flag=1;
            if($card_no!='')
            {
                $default_flag=0;

            }

        $query2 =   "INSERT INTO card_info(
            card_id,
            user_id,
            card_type,
            cardholder_name,
            card_number,
            expiry_date,
            cvv_number,
            default_flag)
        VALUES
        (
        '',
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
       ?)";

        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bind_param('isssssi',$user_id,$card_type,$cardholder_name,$card_number,$expiry_date,$cvv_number,$default_flag);
        $result2 = $stmt2->execute();
        if($result2)
            return TRUE;
        else
            return FALSE;



    }
	
	 public function savePaypalInfo($user_id,$transaction_token1,$metadata){

       /* $query="SELECT transaction_token from paypal_dump WHERE user_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            $stmt->bind_result($transaction_token);
            $stmt->fetch();
            $stmt->close();

        }*/

         $paypal_data="";
         $credit_cards_data="";

         $query="SELECT transaction_token FROM paypal_dump WHERE user_id=?";
         $stmt = $this->conn->prepare($query);
         $stmt->bind_param("i", $user_id);
         if ($stmt->execute())
         {
             $stmt->bind_result($transaction_token);
             $stmt->fetch();
             $stmt->close();

             if($transaction_token==null)
             {
                 $query3="SELECT card_number FROM card_info WHERE user_id=?";
                 $stmt3 = $this->conn->prepare($query3);
                 $stmt3->bind_param("i", $user_id);

                 if ($stmt3->execute())
                 {
                     $stmt3->bind_result($card_number);
                     $stmt3->fetch();
                     $stmt3->close();

                     if($card_number==null)
                     {
                         $query4 = "UPDATE users set default_payment_method=2 WHERE  user_id=?";
                         $stmt4 = $this->conn->prepare($query4);
                         $stmt4->bind_param('i',$user_id);
                         $stmt4->execute();
                         $stmt4->close();
                     }
                 }
             }
         }



         $query2 =   "INSERT INTO paypal_dump(
            paypal_id,
            user_id,
            transaction_token,
            metadata,
            transaction_flag
            )
        VALUES
        (
        '',
        ?,
        ?,
        ?,
        '0'
        )";

        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bind_param('iss',$user_id,$transaction_token1,$metadata);
        $result2 = $stmt2->execute();
        if($result2)
            return TRUE;
        else
            return FALSE;

    }

    public function deleteCreditCardInfo($card_id){

        $query="DELETE from card_info WHERE card_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $card_id);

        $result = $stmt->execute();
        if($result)
            return true;
        else
            return false;
return $card_id;
    }


    public function updateprofile($first_name,$last_name,$user_id,$pic){
    $query =   "UPDATE users
                    SET    first_name = ?,
                           last_name = ?,
                           profile_pic=?
                    WHERE  user_id = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('sssi',$first_name, $last_name,$pic,$user_id);
    $result = $stmt->execute();
    $stmt->close();
    if($result) {

        $response["name"] = $first_name. " ". $last_name;
        if($pic!='') {
            $response["profile_pic"] = "http://$_SERVER[HTTP_HOST]/" . $pic;
        }
        else
        {
            $response["profile_pic"]='';
        }

    }
    else {
        $response["status"] = REQUEST_ACCEPTED;

    }
        $resp["client_profile"]=$response;
    return $resp;
}

    public function updatename($first_name,$last_name,$user_id){

        $query =   "UPDATE users
                    SET    first_name = ?,
                           last_name = ?
                    WHERE  user_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ssi',$first_name, $last_name,$user_id);
        $result = $stmt->execute();
        $stmt->close();

        $query2="select
          IFNULL(profile_pic,'')
          from users WHERE user_id=?";

        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bind_param("i", $user_id);

        $stmt2->execute();
            $stmt2->bind_result($profile_pic);
            $stmt2->fetch();
            $stmt2->close();



        if($result) {

            $response["name"] = $first_name." ".$last_name;
            if($profile_pic!='') {
                $response["profile_pic"] = "http://$_SERVER[HTTP_HOST]/" . $profile_pic;
            }
            else
            {
                $response["profile_pic"]='';
            }

        }
        else {
            $response["status"] = REQUEST_ACCEPTED;

        }

        $resp["client_profile"]=$response;
       return $resp;
    }




    public function getUserId($api_key) {
        $stmt = $this->conn->prepare("SELECT user_id FROM users WHERE auth_token = ?");
        $stmt->bind_param("s", $api_key);
        if ($stmt->execute()) {
            $stmt->bind_result($user_id);
            $stmt->fetch();
            $stmt->close();
            return $user_id;
        } else {
            return NULL;
        }
    }

    public function getfavflag($client_id,$coach_id) {

        $stmt = $this->conn->prepare("SELECT  favourite_flag from favourites where client_user_id=? and coach_user_id=? and favourite_flag=1");
        $stmt->bind_param("ii", $client_id,$coach_id);
        if ($stmt->execute()) {
            $stmt->bind_result($fav_flag);
            $stmt->fetch();
            $stmt->close();
			if($fav_flag==null)
			{
				return $fav_flag = "";
			}
			else
			{
				return $fav_flag;
			}
	    } else {
            return $fav_flag = "";
        }
    }

    public function getCoachId($coach_email) {
        $stmt = $this->conn->prepare("SELECT user_id FROM users WHERE email_id = ? and user_type_id=2");
        $stmt->bind_param("s", $coach_email);
        if ($stmt->execute()) {
            $stmt->bind_result($user_id);
            $stmt->fetch();
            $stmt->close();
            return $user_id;
        } else {
            return NULL;
        }
    }

    public function getUserName($user_id) {
        $stmt = $this->conn->prepare("SELECT first_name,last_name FROM users WHERE user_id = ? ");
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            $stmt->bind_result($user_fname,$user_lname);
            $stmt->fetch();
            $stmt->close();
            return $user_fname." ".$user_lname;
        } else {
            return NULL;
        }
    }

    public function getemail($user_id) {
        $stmt = $this->conn->prepare("SELECT email_id FROM users WHERE user_id = ? ");
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            $stmt->bind_result($user_email);
            $stmt->fetch();
            $stmt->close();
            return $user_email;
        } else {
            return NULL;
        }
    }

    public function getfavourite($user_id, $page_no,$row_count,$timezone,$last_sync_date_time = ''){

        $offset     = ($row_count)*($page_no - 1);

        $Coach_Favorites["favourite_coaches"] = array();
        $query =   "SELECT coach_user_id,date_create
                    FROM   favourites
                    WHERE  client_user_id = ?
                    and favourite_flag=1
                     ORDER BY date_create DESC
                     LIMIT  $offset , " . ($row_count + 1);



        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        $stmt->store_result();
        $num_rows   =   $stmt->num_rows;
        $stmt->bind_result($coach_id,$date_created);
        $counter    =   0;
        if ($num_rows > ($row_count))
            $Coach_Favorites["next_page"] = "true";
        else
            $Coach_Favorites["next_page"] = "false";
        while($stmt->fetch()){

            $query2="select email_id,
          IFNULL(first_name,''),
          IFNULL(last_name,''),
          IFNULL(about_info,''),
           IFNULL(category_id,''),
          IFNULL(profile_pic,'')
          from users WHERE user_id=?";

            $stmt2 = $this->conn->prepare($query2);
           $stmt2->bind_param('i',$coach_id);
            $stmt2->execute();
           $stmt2->store_result();
            $num_rows2   =   $stmt2->num_rows;
            $stmt2->bind_result($email_id,$first_name,$last_name,$about_info,$category_id,$profile_pic);

            $res["coach_name"] = '';
            $res["coach_about_info"] = '';
            $res["coach_profile_pic"] = '';
            $res["coach_user_id"] = '';
            $res["date_set_favourite"] = '';
            $res["category_id"]='';
            while($stmt2->fetch()) {

    $res["coach_name"] = $first_name . " " . $last_name;
    $res["coach_about_info"] = $about_info;
                $res["category_id"]=$category_id;
    $res["coach_profile_pic"] = "http://$_SERVER[HTTP_HOST]/" . $profile_pic;
    $res["coach_user_id"] = $coach_id;

                if($date_created=='0000-00-00 00:00:00')
                {
                    $res["date_set_favourite"]=$date_created;
                }
                else
                {
                    $res["date_set_favourite"]=$this->ConvertGMTToLocalTimezone($date_created,$timezone);
                }


                array_push($Coach_Favorites["favourite_coaches"], $res);

}

            $counter++;
            if ($counter == ($row_count))
                break;


        }
        $stmt->close();


        if($num_rows>0){
            return $Coach_Favorites;
        }
        else{
            return false;
        }

    }

    public function getreviews($user_id,$page_no,$row_count,$timezone){

        $offset     = ($row_count)*($page_no - 1);

        $MyReviews["my_reviews"] = array();

        $query =   "SELECT coach_user_id,rating,review,date_create
                    FROM   reviews
                    WHERE  client_user_id = ?
                    ORDER  BY date_create DESC
                    LIMIT  $offset , " . ($row_count + 1);


        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        $stmt->store_result();
        $num_rows   =   $stmt->num_rows;
        $stmt->bind_result($coach_id,$rating,$review,$date_created);

        $counter    =   0;

        if ($num_rows > ($row_count))
            $MyReviews["next_page"] = "true";
        else
            $MyReviews["next_page"] = "false";

        while($stmt->fetch()){
            $res["coach_user_id"]=$coach_id;
            $res["coach_rating"]=$rating;
            $res["coach_reviews"]=$review;

            if($date_created=='0000-00-00 00:00:00')
            {
                $res["review_date_created"]=$date_created;
            }
            else
            {
                $res["review_date_created"]=$this->ConvertGMTToLocalTimezone($date_created,$timezone);
            }


            $query2="select email_id,
          IFNULL(first_name,''),
          IFNULL(last_name,''),
          IFNULL(profile_pic,'')
          from users WHERE user_id=?";;

            $stmt2 = $this->conn->prepare($query2);
            $stmt2->bind_param('i',$coach_id);
            $stmt2->execute();
            $stmt2->store_result();
            $num_rows2   =   $stmt2->num_rows;
            $stmt2->bind_result($email_id,$first_name,$last_name,$profile_pic);
            while($stmt2->fetch()) {

                $res["coach_name"] = $first_name." ".$last_name;

                $res["coach_profile_pic"]='';

                if($profile_pic!='') {
                    $res["coach_profile_pic"] = "http://$_SERVER[HTTP_HOST]/" . $profile_pic;
                }


            }
            array_push($MyReviews["my_reviews"],$res);
            $counter++;
            if ($counter == ($row_count))
                break;

        }
        $stmt->close();


        if($num_rows>0){
            return $MyReviews;
        }
        else{
            return false;
        }
    }

    public function getCoachReviews($coach_id,$page_no,$row_count,$timezone){

        $offset     = ($row_count)*($page_no - 1);

        $coachReviews["coach_reviews"] = array();

        $query =   "SELECT client_user_id,rating,review,date_create
                    FROM   reviews
                    WHERE  coach_user_id = ?
                    ORDER  BY date_create DESC
                    LIMIT  $offset , " . ($row_count + 1);


        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i',$coach_id);
        $stmt->execute();
        $stmt->store_result();
        $num_rows   =   $stmt->num_rows;
        $stmt->bind_result($client_id,$rating,$review,$date_created);

        $counter    =   0;

        if ($num_rows > ($row_count))
            $coachReviews["next_page"] = "true";
        else
            $coachReviews["next_page"] = "false";

        while($stmt->fetch()){
            $res["client_user_id"]=$client_id;
            $res["coach_rating"]=$rating;
            $res["coach_review_text"]=$review;

            if($date_created=='0000-00-00 00:00:00')
            {
                $res["review_date_created"]=$date_created;
            }
            else
            {
                $res["review_date_created"]=$this->ConvertGMTToLocalTimezone($date_created,$timezone);
            }


            $query2="select email_id,
          IFNULL(first_name,''),
          IFNULL(last_name,''),
          IFNULL(profile_pic,'')
          from users WHERE user_id=?";;

            $stmt2 = $this->conn->prepare($query2);
            $stmt2->bind_param('i',$client_id);
            $stmt2->execute();
            $stmt2->store_result();
            $num_rows2   =   $stmt2->num_rows;
            $stmt2->bind_result($email_id,$first_name,$last_name,$profile_pic);
            while($stmt2->fetch()) {

                $res["client_name"] = $first_name." ".$last_name;

                $res["client_profile_pic"]='';

                if($profile_pic!='') {
                    $res["client_profile_pic"] = "http://$_SERVER[HTTP_HOST]/" . $profile_pic;
                }


            }
            array_push($coachReviews["coach_reviews"],$res);
            $counter++;
            if ($counter == ($row_count))
                break;

        }
        $stmt->close();


        if($num_rows>0){
            return $coachReviews;
        }
        else{
            return false;
        }
    }

     public function makeAppointment($user_id, $coach_id,$slot_id,$timezone)
    {	
		$query5 = "SELECT user_type_id FROM users WHERE user_id=?";
		$stmt5 = $this->conn->prepare($query5); 
		$stmt5->bind_param('i', $user_id);
        $stmt5->execute();
        $stmt5->bind_result($user_type_id);
        $stmt5->fetch();
		$stmt5->close();
        
		if($user_type_id == 4)
		{ 
			$query4 = "SELECT credit_available_qty FROM credit_available WHERE user_id=?";
			$stmt4 = $this->conn->prepare($query4); 
			$stmt4->bind_param('i', $user_id);
			$stmt4->execute();
			$stmt4->bind_result($credit_available_qty);
			$stmt4->fetch();
			$stmt4->close();
			if($credit_available_qty <= 0)
			{
				$response["status"] = NO_CONTENT;
			}
			
			else
			{
				$query = "UPDATE slots set client_user_id=?,booked_flag=1 WHERE  slot_id=?";
				$stmt = $this->conn->prepare($query);
		
				$stmt->bind_param('ii', $user_id, $slot_id);
				$res = $stmt->execute();
				$stmt->close();
		
				if ($res) 
				{
					$stmt3 = $this->conn->prepare("SELECT slot_id FROM sessions WHERE  slot_id=?");
					$stmt3->bind_param("s", $slot_id);
					$stmt3->execute();
					$stmt3->bind_result($slotid2);
					$stmt3->fetch();
					$stmt3->close();
		
		
					if ($slotid2 == '') 
					{
						$query2 = "INSERT INTO sessions(
						session_id,
						slot_id,
						coach_user_id,
						client_user_id,
						start_datetime,
						end_datetime,
						notes)
			
						VALUES
						(
						'',
						?,
						?,
						?,
					   '',
						'',
					   '')";
						$stmt2 = $this->conn->prepare($query2);
						$stmt2->bind_param('iii', $slot_id, $coach_id, $user_id);
						$result2 = $stmt2->execute();
		
						$stmt = $this->conn->prepare("SELECT start_datetime FROM slots WHERE  slot_id=?");
						$stmt->bind_param("s", $slot_id);
						if ($stmt->execute()) 
						{
							$stmt->bind_result($sdt);
							$stmt->fetch();
							$stmt->close();
						}
		
						if($sdt=='0000-00-00 00:00:00')
						{
							$response["sdt"]=$sdt;
						}
						else
						{
							$response["sdt"]=$this->ConvertGMTToLocalTimezone($sdt, $timezone);
						}
						$response["status"] = SUCCESS;
		
					}
		
					else
					{
						$response["status"] = CONFLICT;
					}
		
				 }//if
			 } //else
 		 }//if
        else
        {
            $query6 = "SELECT default_payment_method FROM users WHERE user_id=?";
            $stmt6 = $this->conn->prepare($query6);
            $stmt6->bind_param('i', $user_id);
            $stmt6->execute();
            $stmt6->bind_result($default_payment_method);
            $stmt6->fetch();
            $stmt6->close();
            if($default_payment_method == 2)
            {
                $query7 = "SELECT transaction_token from paypal_dump WHERE user_id=? and transaction_flag= '0'";
                $stmt7 = $this->conn->prepare($query7);
                $stmt7->bind_param('i', $user_id);
                $stmt7->execute();
                $stmt7->bind_result($transaction_token);
                $stmt7->fetch();
                $stmt7->close();

                if($transaction_token != "")
                {
                    $query = "UPDATE slots set client_user_id=?,booked_flag=1 WHERE  slot_id=?";
                    $stmt = $this->conn->prepare($query);

                    $stmt->bind_param('ii', $user_id, $slot_id);
                    $res = $stmt->execute();
                    $stmt->close();

                    if ($res)
                    {
                        $stmt3 = $this->conn->prepare("SELECT slot_id FROM sessions WHERE  slot_id=?");
                        $stmt3->bind_param("s", $slot_id);
                        $stmt3->execute();
                        $stmt3->bind_result($slotid2);
                        $stmt3->fetch();
                        $stmt3->close();


                        if ($slotid2 == '')
                        {
                            $query2 = "INSERT INTO sessions(
								session_id,
								slot_id,
								coach_user_id,
								client_user_id,
								start_datetime,
								end_datetime,
								notes)

								VALUES
								(
								'',
								?,
								?,
								?,
							   '',
								'',
							   '')";
                            $stmt2 = $this->conn->prepare($query2);
                            $stmt2->bind_param('iii', $slot_id, $coach_id, $user_id);
                            $result2 = $stmt2->execute();

                            $stmt = $this->conn->prepare("SELECT start_datetime FROM slots WHERE  slot_id=?");
                            $stmt->bind_param("s", $slot_id);
                            if ($stmt->execute())
                            {
                                $stmt->bind_result($sdt);
                                $stmt->fetch();
                                $stmt->close();
                            }

                            if($sdt=='0000-00-00 00:00:00')
                            {
                                $response["sdt"]=$sdt;
                            }
                            else
                            {
                                $response["sdt"]=$this->ConvertGMTToLocalTimezone($sdt, $timezone);
                            }
                            $response["status"] = SUCCESS;

                        }
                        // if for $slotid2

                        else
                        {
                            $response["status"] = CONFLICT;
                        }

                    }
                    //if for $res
                }
                // if for transaction_token not null

                else
                {
                    $response["message"]="Please select a payment method";
                    $response["status"]=NO_CONTENT;
                }
                //if for transaction_token not null
            }
            //if for default_payment_method = 2

            else
            {
                $query = "UPDATE slots set client_user_id=?,booked_flag=1 WHERE  slot_id=?";
                $stmt = $this->conn->prepare($query);

                $stmt->bind_param('ii', $user_id, $slot_id);
                $res = $stmt->execute();
                $stmt->close();

                if ($res)
                {
                    $stmt3 = $this->conn->prepare("SELECT slot_id FROM sessions WHERE  slot_id=?");
                    $stmt3->bind_param("s", $slot_id);
                    $stmt3->execute();
                    $stmt3->bind_result($slotid2);
                    $stmt3->fetch();
                    $stmt3->close();


                    if ($slotid2 == '')
                    {
                        $query2 = "INSERT INTO sessions(
						session_id,
						slot_id,
						coach_user_id,
						client_user_id,
						start_datetime,
						end_datetime,
						notes)

						VALUES
						(
						'',
						?,
						?,
						?,
					   '',
						'',
					   '')";
                        $stmt2 = $this->conn->prepare($query2);
                        $stmt2->bind_param('iii', $slot_id, $coach_id, $user_id);
                        $result2 = $stmt2->execute();

                        $stmt = $this->conn->prepare("SELECT start_datetime FROM slots WHERE  slot_id=?");
                        $stmt->bind_param("s", $slot_id);
                        if ($stmt->execute())
                        {
                            $stmt->bind_result($sdt);
                            $stmt->fetch();
                            $stmt->close();
                        }

                        if($sdt=='0000-00-00 00:00:00')
                        {
                            $response["sdt"]=$sdt;
                        }
                        else
                        {
                            $response["sdt"]=$this->ConvertGMTToLocalTimezone($sdt, $timezone);
                        }
                        $response["status"] = SUCCESS;

                    }

                    else
                    {
                        $response["status"] = CONFLICT;
                    }

                }//if
            } //else

        }



        return $response;
    }

    public function cancelAppointment($user_id, $coach_id,$slot_id,$timezone)
    {
        $query = "SELECT start_datetime,end_datetime FROM slots WHERE slot_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i',$slot_id);
        $stmt->bind_result($start_time,$end_time);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();

        if($start_time=='' || $end_time=='') {

            $response["status"] = NOT_FOUND;
        }
        else
        {

            $query2 = "UPDATE slots set booked_flag='0', client_user_id='0' WHERE  slot_id=?";
            $stmt2 = $this->conn->prepare($query2);
            $stmt2->bind_param('i', $slot_id);
            $stmt2->execute();

            $query3 = "DELETE from sessions WHERE slot_id=?";
            $stmt3 = $this->conn->prepare($query3);
            $stmt3->bind_param("i", $slot_id);
            $result3 = $stmt3->execute();



            $query4 = "INSERT INTO slots(
     slot_id,
     coach_user_id,
     client_user_id,
     start_datetime,
     end_datetime,
     booked_flag
     )

 VALUES
 ('',
 ?,
 ?,
 ?,
 ?,
 '-1')";

            $stmt4 = $this->conn->prepare($query4);
            $stmt4->bind_param('iiss', $coach_id, $user_id, $start_time, $end_time);
            $stmt4->execute();
            $stmt4->close();

$start_time1=$this->ConvertGMTToLocalTimezone2($start_time,$timezone);
            $response["status"] = SUCCESS;
            $response["start_time"] = $start_time1;


        }

        return $response;
    }

    public function uploadimage($tmp_name,$path)
    {
        move_uploaded_file($tmp_name,$path);
        return "true";

    }



    public function set_favourite($client_id, $coach_id,$favourite_flag)
    {

        $query='';
        $coach_id2='';
        $query2 = "SELECT coach_user_id FROM favourites WHERE client_user_id=? and coach_user_id=?";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bind_param('ii',$client_id,$coach_id);

        $stmt2->bind_result($coach_id2);
        $stmt2->execute();
        $stmt2->fetch();
        $stmt2->close();

        if($favourite_flag==1)
        {

            if($coach_id2=='') {

                $query = "INSERT INTO favourites(
            favourite_id,
            client_user_id,
            coach_user_id,
            date_create,
            favourite_flag)

        VALUES
        (
        '',
        ?,
        ?,
        UTC_TIMESTAMP(),
        1)";

            }
            else
            {
                $query = "UPDATE favourites set favourite_flag='1' WHERE  client_user_id=? and coach_user_id=?";
            }


            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('ii', $client_id, $coach_id);
            $stmt->execute();
            $res["favourite_flag"]=$favourite_flag;


    }

if($favourite_flag==0) {

$query = "UPDATE favourites set favourite_flag='0' WHERE  client_user_id=? and coach_user_id=?";


$stmt = $this->conn->prepare($query);
$stmt->bind_param('ii', $client_id, $coach_id);
$stmt->execute();
$res["favourite_flag"]=$favourite_flag;

}

return $res;

}

public function setpaymentdefault($user_id,$card_id,$payment_method_id)
{	
		
if($payment_method_id == 1)
	{	
		$query6 = "UPDATE users set default_payment_method=1 WHERE user_id=?";
		$stmt6 = $this->conn->prepare($query6);
        $stmt6->bind_param('i',$user_id);
        $stmt6->execute();

	    $query='';
        $coach_id2='';
        $query2 = "SELECT card_id FROM card_info WHERE user_id=? and card_id=?";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bind_param('ii',$user_id,$card_id);

        $stmt2->bind_result($card_id1);
        $stmt2->execute();
        $stmt2->fetch();
        $stmt2->close();

        if($card_id1!='') {

           $query2 = "UPDATE card_info set default_flag=0 WHERE  user_id=?";
           $stmt2 = $this->conn->prepare($query2);
            $stmt2->bind_param('i',$user_id);
            $stmt2->execute();

            $query3 = "UPDATE card_info set default_flag=1 WHERE  user_id=? and card_id=?";
            $stmt3 = $this->conn->prepare($query3);
            $stmt3->bind_param('ii',$user_id,$card_id);
            $stmt3->execute();
			

       		$response["status"]=SUCCESS;
        }
        else
        {
            $response["status"] = NOT_FOUND;
        }
		
	}
	elseif($payment_method_id == 2)
		{	
			$query7 = "UPDATE card_info set default_flag=0 WHERE  user_id=?";
            $stmt7 = $this->conn->prepare($query7);
            $stmt7->bind_param('i',$user_id);
            $stmt7->execute();
			
			$query6 = "UPDATE users set default_payment_method=2 WHERE user_id=?";
			$stmt6 = $this->conn->prepare($query6);
			$stmt6->bind_param('i',$user_id);
			$stmt6->execute();
				
			$query5 = "SELECT transaction_token FROM paypal_dump WHERE user_id=?";
			$stmt5 = $this->conn->prepare($query5);
			$stmt5->bind_param('i',$user_id);
			
			$stmt5->execute();
			$stmt5->bind_result($transaction_token);
			$stmt5->fetch();
			$stmt5->close();
	
			if($transaction_token!='') {
	
				$response["status"]=SUCCESS;
			}
			else
			{
				$response["status"] = NOT_FOUND;
			}
		}

		
		if($response["status"] != NOT_FOUND)
		{
			 $query4 =  "SELECT card_id,card_type,cardholder_name,card_number,expiry_date,cvv_number,default_flag from card_info WHERE  user_id = ?";

			$stmt4 = $this->conn->prepare($query4);
			$stmt4->bind_param('i',$user_id);
			$stmt4->execute();
			$stmt4->store_result();
			$num_rows = $stmt4->num_rows;
		
		$stmt4->bind_result($card_id,$card_type,$cardholder_name,$card_number,$expiry_date,$cvv_number,$default_flag);
		
			$usercreditinfo["credit_cards_info"] = array();
		
			while($stmt4->fetch()) {
				$res["card_id"] = $card_id;
				$res["card_type"]=$card_type;
				$res["cardholder_name"]=$cardholder_name;
				$res["card_number"]=$card_number;
				$res["expiry_date"]=$expiry_date;
				$res["cvv_number"]=$cvv_number;
				$res["default_flag"]=$default_flag;
				array_push($usercreditinfo["credit_cards_info"], $res);
			}
			$stmt4->close();
			
			$query8 =  "Select paypal_id,transaction_token, metadata from paypal_dump WHERE  user_id = ? and transaction_flag='0'";

			$stmt8 = $this->conn->prepare($query8);
			$stmt8->bind_param('i',$user_id);
			$stmt8->execute();
			$stmt8->store_result();
			$num_rows8 = $stmt8->num_rows;
		
			$stmt8->bind_result($paypal_id,$transaction_token,$metadata);
		
			$usercreditinfo["paypal_info"] = array();
		
			while($stmt8->fetch()) {
				$res8["paypal_id"] = $paypal_id;
				$res8["transaction_token"]=$transaction_token;
				$res8["metadata"]=$metadata;
				array_push($usercreditinfo["paypal_info"], $res8);
			}
			$stmt8->close();
			
			$query9 =  "Select default_payment_method from users WHERE  user_id = ?";
			$stmt9 = $this->conn->prepare($query9);
			$stmt9->bind_param('i',$user_id);
			$stmt9->execute();
			$stmt9->store_result();
			$num_rows9 = $stmt9->num_rows;
			
			$usercreditinfo["default_payment_method"] = array();
			
			$stmt9->bind_result($default_payment_method);
			$stmt9->fetch();
			$res9["default_payment_method"] = $default_payment_method;
			
			$stmt9->close();
			//$usercredit["payment_methods"] = array();
			
			$usercreditinfo["default_payment_method"] = $default_payment_method;
			
			//$usercredit["payment_methods"] = $usercreditinfo; 
			//$response["credit_cards_info"]=$usercredit;
		
			if($num_rows>0){
				$response["status"] = SUCCESS;
				$response["payment_info"] = $usercreditinfo;
			}
			else{
				$response["status"] = NOT_FOUND;
			}
		}

        return $response;

    }

    public function getschedule($user_id,$timezone, $last_sync_date_time = ''){
  
    $mySchedule["my_schedule"] = array();
    $query =   "SELECT  slots.coach_user_id,slots.start_datetime,slots.end_datetime,IFNULL(sessions.notes,''),slots.slot_id from slots LEFT JOIN sessions
                    ON slots.slot_id=sessions.slot_id and slots.client_user_id=sessions.client_user_id WHERE
    slots.client_user_id = ? AND slots.booked_flag='1' ORDER BY slots.start_datetime DESC ";


    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('i',$user_id);
    $stmt->execute();
    $stmt->store_result();
    $num_rows   =   $stmt->num_rows;
    $stmt->bind_result($coach_id,$start_date,$end_date,$notes,$slot_id);
    while($stmt->fetch()){

        $res["coach_id"]=$coach_id;


        if($start_date=='0000-00-00 00:00:00')
        {
            $res["session_start"]=$start_date;
        }
        else
        {
            $res["session_start"]=$this->ConvertGMTToLocalTimezone($start_date, $timezone);
        }

        if($end_date=='0000-00-00 00:00:00')
        {
            $res["session_end"]=$end_date;
        }
        else
        {
            $res["session_end"]=$this->ConvertGMTToLocalTimezone($end_date, $timezone);
        }

        $res["slot_id"]=$slot_id;

        $query2="select email_id,
          IFNULL(first_name,''),
          IFNULL(last_name,'')
        from users WHERE user_id=?";

        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bind_param('i',$coach_id);
        $stmt2->execute();
        $stmt2->store_result();
        $num_rows2   =   $stmt2->num_rows;
        $stmt2->bind_result($coach_email_id,$first_name,$last_name);
        while($stmt2->fetch()) {

            $res["coach_name"]=$first_name." ".$last_name;

            //$res["coach_about_info"] = $about_info;
            //$res["coach_profile_pic"] = $profile_pic;

        }

    array_push($mySchedule["my_schedule"], $res);

    }
    $stmt->close();


        if($num_rows>0){
            return $mySchedule;
        }
        else{
            return false;
        }
}

    public function getcoachschedule($user_id,$coach_id,$date_schedule,$timezone){

        $slotdetails["slot_details"]=array();
        $slot["booked_slots"]=array();
        $slot["available_slots"]=array();
        $sdt = $this->ConvertLocalTimezoneToGMT($date_schedule,$timezone);

        $query="SELECT slot_id,start_datetime,end_datetime FROM slots WHERE coach_user_id=? and booked_flag=1 ORDER BY start_datetime ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i',$coach_id);
        $stmt->execute();
        $stmt->store_result();
        $num_rows   =   $stmt->num_rows;
        $stmt->bind_result($slot_id,$start_datetime,$end_datetime);
        $log='';
        $log2='';



        while($stmt->fetch()) {

            //$res["slot_id"] = $slot_id;
            //$res["session_start"] = $start_datetime;
            //$res["session_end"] =$end_datetime;
            $d=$this->ConvertGMTToLocalTimezone($start_datetime,$timezone);
            $d2=$this->ConvertGMTToLocalTimezone($end_datetime,$timezone);
            $date = date('Y-m-d',strtotime($d));
            $date2= date('Y-m-d',strtotime($d2));
            if($date==$sdt )
            {
                $res["slot_id"] = $slot_id;
               $res["session_start"] =$this->ConvertGMTToLocalTimezone($start_datetime,$timezone);
                $res["session_end"] =$this->ConvertGMTToLocalTimezone($end_datetime,$timezone);

                array_push($slot["booked_slots"],$res);
            }

            else
            {

                $res='';
            }



        }

        $query2="SELECT slot_id,start_datetime,end_datetime FROM slots WHERE coach_user_id=? and booked_flag=0 ORDER BY start_datetime ASC";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bind_param('i',$coach_id);
        $stmt2->execute();
        $stmt2->store_result();
        $num_rows2   =   $stmt2->num_rows;
        $stmt2->bind_result($slot_id2,$start_datetime2,$end_datetime2);

        while($stmt2->fetch()) {
            $d3=$this->ConvertGMTToLocalTimezone($start_datetime2,$timezone);
            $d4=$this->ConvertGMTToLocalTimezone($end_datetime2,$timezone);
           $date3 = date('Y-m-d',strtotime($d3));
           $date4 = date('Y-m-d',strtotime($d4));

            if($date3==$sdt)
            {
                $res1["slot_id"] = $slot_id2;
                $res1["session_start"] =$this->ConvertGMTToLocalTimezone($start_datetime2,$timezone);
                $res1["session_end"] =$this->ConvertGMTToLocalTimezone($end_datetime2,$timezone);


                array_push($slot["available_slots"],$res1);


            }
            else
            {
                $res1='';
            }


        }



        $stmt->close();


        array_push($slotdetails,$slot["available_slots"]);
        array_push($slotdetails,$slot["booked_slots"]);



       return $slot;
    }

    public function gettimeline($user_id,$page_no,$row_count,$timezone, $last_sync_date_time = ''){

        $offset     = ($row_count)*($page_no - 1);
        $userSchedule["user_sessions"] = array();

        $query =   "SELECT coach_user_id,session_id,start_datetime,end_datetime,IFNULL(notes,'')
from sessions where client_user_id=?  ORDER BY sessions.start_datetime DESC
    LIMIT  $offset , " . ($row_count + 1);

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        $stmt->store_result();
        $num_rows   =   $stmt->num_rows;
        $stmt->bind_result($coach_id,$session_id,$start_date,$end_date,$notes);

        $counter    =   0;

        $curdt=date("Y-m-d");

        $dt = strtotime($end_date);
        $edt=date("Y-m-d",$dt);



$nrow=0;
        while($stmt->fetch()){
            if($edt<=$curdt) {
                if (trim($start_date) != '0000-00-00 00:00:00' && trim($end_date) != '0000-00-00 00:00:00') {
                    $res["coach_id"] = $coach_id;
                    $res["session_notes"] = $notes;
                    $res["session_id"] = $session_id;


                    $res["session_start"] = $this->ConvertGMTToLocalTimezone($start_date, $timezone);
                    $res["session_end"] = $this->ConvertGMTToLocalTimezone($end_date, $timezone);

                    $query2="select email_id,
IFNULL(first_name,''),
IFNULL(last_name,''),
IFNULL(profile_pic,'')
from users WHERE user_id=?";

                    $stmt2 = $this->conn->prepare($query2);
                    $stmt2->bind_param('i',$coach_id);
                    $stmt2->execute();
                    $stmt2->store_result();
                    $num_rows2   =   $stmt2->num_rows;
                    $stmt2->bind_result($email_id,$first_name,$last_name,$profile_pic);
                    while($stmt2->fetch()) {

                        $res["coach_email_id"] = $email_id;
                        $res["coach_name"] = $first_name." ".$last_name;

                        $res["coach_profile_pic"]='';

                        if($profile_pic!='') {
                            $res["coach_profile_pic"] = "http://$_SERVER[HTTP_HOST]/" . $profile_pic;
                        }

                    }



                    array_push($userSchedule["user_sessions"],$res);
                    $nrow++;
                }
            }




            $counter++;
            if ($counter == ($row_count))
                break;
        }
        $stmt->close();

        if ($nrow > ($row_count))
            $userSchedule["next_page"] = "true";
        else
            $userSchedule["next_page"] = "false";


        if($num_rows>0){
            return $userSchedule;
        }
        else{
            return false;
        }
    }

    public function get_credits($user_id,$timezone){
        $usercredits["credit_detail"] = '';

       $query="SELECT credit_available.credit_available_id,credit_available.credit_available_qty,
               payments.session_id,payments.credit_qty from credit_available INNER JOIN payments ON credit_available.user_id=payments.client_user_id WHERE
    credit_available.user_id = ?";


        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        $stmt->store_result();
        $num_rows   =   $stmt->num_rows;
        $stmt->bind_result($credit_available_id,$credit_available_qty,$session_id,$consumed_qty);
        $sessions = array();
        while($stmt->fetch()){

            $query2="select session_id,
          coach_user_id,
          start_datetime,
          end_datetime
          from sessions WHERE session_id=?";

            $stmt2 = $this->conn->prepare($query2);
            $stmt2->bind_param('i',$session_id);
            $stmt2->execute();
            $stmt2->store_result();
            $num_rows2   =   $stmt2->num_rows;
            $stmt2->bind_result($session_id,$coach_id,$start_datetime,$end_datetime);
            while($stmt2->fetch()) {

                $res["session_id"] = $session_id;
                $res["coach_name"] = $this->getUserName($coach_id);

                if($start_datetime=='0000-00-00 00:00:00')
                {
                    $res["start_datetime"]=$start_datetime;
                }
                else
                {
                    $res["start_datetime"]=$this->ConvertGMTToLocalTimezone($start_datetime, $timezone);
                }

                if($end_datetime=='0000-00-00 00:00:00')
                {
                    $res["end_datetime"] =$end_datetime;
                }
                else
                {
                    $res["end_datetime"] =$this->ConvertGMTToLocalTimezone($end_datetime, $timezone);
                }

                $res["credit_consumed_qty"]=$consumed_qty;

            }


            array_push($sessions,$res);
        }
        $res1["credit_available_id"]=$credit_available_id;
        $res1["available_credit_qty"]=$credit_available_qty;

        $usercredits["credit_detail"]["available_credit_detail"]=$res1;;

       // if($num_rows2>0){
            //array_push($usercredits["credit_detail"],$sessions);

            $usercredits["credit_detail"]["consumed_credit_detail"]=$sessions;
        //}

        $stmt->close();


        if($num_rows>0){
            return $usercredits;
        }
        else{
            return false;
        }
    }

    function get_credit_type_name($credit_type_id)
    {
        $query="SELECT credit_type_name from credit_types WHERE credit_type_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $credit_type_id);
        if ($stmt->execute()) {
            $stmt->bind_result($credit_type_name);
            $stmt->fetch();
            $stmt->close();
            return $credit_type_name;
        } else {
            return '';
        }
}

    public function isUserExists($user_email)
    {
        $stmt = $this->conn->prepare("SELECT user_id from users WHERE email_id = ?");
        $stmt->bind_param('s', $user_email);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }

    public function isValidApiKey($api_key) {
        $stmt = $this->conn->prepare("SELECT user_id from users WHERE auth_token = ?");
        $stmt->bind_param("s", $api_key);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }

    private function generateApiKey()
    {
        return md5(uniqid(rand(), true));
    }




    /**
     * Conver the date format
     * @param $date
     */



    function convert_posted_on($date, $timezoneRequired){
        $date = ConvertGMTToLocalTimezone($date, $timezoneRequired);
        return $date->format('M,d Y G:i');
        return $date;
    }


    function ConvertGMTToLocalTimezone($gmttime, $timezoneRequired)
    {
        $system_timezone = date_default_timezone_get();

        date_default_timezone_set("GMT");
        $gmt = date("Y-m-d h:i:s A");

        $local_timezone = $timezoneRequired;
        date_default_timezone_set($local_timezone);
        $local = date("Y-m-d h:i:s A");

        date_default_timezone_set($system_timezone);
        $diff = (strtotime($local) - strtotime($gmt));

        $date = new DateTime($gmttime);
        $date->modify("+$diff seconds");

        $timestamp = $date->format("Y-m-d H:i");
        return $timestamp;

        //return $date;
    }

    function ConvertGMTToLocalTimezone2($gmttime, $timezoneRequired)
    {
        $system_timezone = date_default_timezone_get();

        date_default_timezone_set("GMT");
        $gmt = date("Y-m-d h:i:s A");

        $local_timezone = $timezoneRequired;
        date_default_timezone_set($local_timezone);
        $local = date("Y-m-d h:i:s A");

        date_default_timezone_set($system_timezone);
        $diff = (strtotime($local) - strtotime($gmt));

        $date = new DateTime($gmttime);
        $date->modify("+$diff seconds");

        $timestamp = $date->format("Y-m-d H:i:s");
        return $timestamp;

        //return $date;
    }


    function ConvertLocalTimezoneToGMT($gmttime, $timezoneRequired)
    {
        $system_timezone = date_default_timezone_get();

        $local_timezone = $timezoneRequired;
        date_default_timezone_set($local_timezone);
        $local = date("Y-m-d H:i:s");

        date_default_timezone_set("GMT");
        $gmt = date("Y-m-d H:i:s");

        date_default_timezone_set($system_timezone);
        $diff = (strtotime($gmt) - strtotime($local));

        $date = new DateTime($gmttime);
        $date->modify("+$diff seconds");

        //$timestamp = $date->format("Y-m-d");

        $timestamp = $date->format("Y-m-d");
        return $timestamp;

        //return $date;

    }

    function ConvertOneTimezoneToAnotherTimezone($time, $currentTimezone, $timezoneRequired)
    {
        $system_timezone = date_default_timezone_get();
        $local_timezone  = $currentTimezone;
        date_default_timezone_set($local_timezone);
        $local = date("Y-m-d H:i:s");

        date_default_timezone_set("GMT");
        $gmt = date("Y-m-d H:i:s");

        $require_timezone = $timezoneRequired;
        date_default_timezone_set($require_timezone);
        $required = date("Y-m-d H:i:s");

        date_default_timezone_set($system_timezone);

        $diff1 = (strtotime($gmt) - strtotime($local));
        $diff2 = (strtotime($required) - strtotime($gmt));

        $date = new DateTime($time);
        $date->modify("+$diff1 seconds");
        $date->modify("+$diff2 seconds");
        $timestamp = $date->format("m-d-Y H:i:s");
        //return $timestamp;

        return $date;

    }



}