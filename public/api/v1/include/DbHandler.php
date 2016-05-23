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

    public function userSignUpViaEmail($user_email, $user_pwd, $user_phone){

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
            age,
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
'',
'',
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
'',
UTC_TIMESTAMP(),
1,
'',
'')";

            // Check for successful insertion
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sss',$user_email,$user_pwd1,$user_phone);
        $res = $stmt->execute();
        $stmt->close();

        $user_id=$this->getUserId($token);


        $qb_log1="yveqb".$user_id;
        $qb_pwd1=substr(md5(uniqid(rand(1,6))), 0, 8);
        $qb_id1=$this->qbsignup($qb_log1,$qb_pwd1,$user_id);

        if($res){

            $response["Token"] = $token;
            $response["qb_login"]=$qb_log1;
            $response["qb_pwd"]=$qb_pwd1;

        }
       else {
           $response["status"] = REQUEST_ACCEPTED;

       }



        return$response;
    }

    public function userSignInViaEmail($user_email, $user_pwd1){

        $query  =  "select user_id,password,auth_token,qb_login,qb_id,qb_pwd from users where email_id=?";

        $stmt   =   $this->conn->prepare($query);
        $stmt->bind_param('s',$user_email);
        $stmt->execute();
       $stmt->bind_result($user_id,$user_pwd,$auth_token,$qb_login,$qb_id,$qb_pwd);
        $stmt->fetch();
        $stmt->close();

        $qb_id1='';
        $qb_log1='';

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
            $response["Token"] = $auth_token;
            $response["quickblox_login"]=$qb_log1;
            $response["quickblox_pwd"]=$qb_pwd1;



        } else {
            // user password is incorrect
            $response["status"] =UNAUTHORIZED;

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


    public function sendmail($user_email)
    {

        $from       =   "harvinder.kaur@agicent.com";
        $fromName   =   "YVE";
        $subject    =   "YVE : Reset Password ";
        $recipient=$user_email;

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1rn' . "\r\n";
        $headers .= "From: $fromName <$from>\r\n".
            "CC: patle@agicent.com";

        $code=rand(100,999);
        $salt='YVESALT';

        $user_email1=trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $user_email, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));

        $body="<html><head></head><body><p>Hi</p><p>You requested that your password be reset. Please visit the link below or copy and paste it into your browser to create a new password.</p><p><a href='http://yve.ibuildmart.in/forgot.php?email=".$user_email1."&code=".$code."'>http://yve.ibuildmart.in/forgot.php?email=".$user_email1."</a><p>Thanks<br/>Administrator</p></body></html>";



        if (mail($recipient, $subject, $body, $headers))

            $response["status"] = SUCCESS;
        $response["msg"] = "Your password has been reset. please login with new password";


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



    public function searchCoach($page_no,$row_count,$timezone,$searched_text){

        $offset     = ($row_count)*($page_no - 1);
        $query =   "SELECT user_id,email_id,
                           IFNULL(first_name,''),
                           IFNULL(last_name,''),
                            IFNULL(about_info,''),
                            IFNULL(profile_pic,''),
                            IFNULL(gender,''),
                            IFNULL(age,''),
                            IFNULL(language,''),
                            IFNULL(intro_video,''),
                           IFNULL(category_id,''),
                           date_created
                    FROM   users where first_name LIKE '%$searched_text%' OR last_name LIKE '%$searched_text%' and user_type_id='2'
        ORDER  BY date_created DESC
                    LIMIT  $offset , " . ($row_count + 1);



        $stmt   =   $this->conn->prepare($query);
        $stmt->execute();
        //$stmt->bind_param('s',$searched_text);
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->bind_result($user_id,$email_id,$first_name,$last_name,$about_info,$profile_pic,$gender,$age,$language,$intro_video,$cat_id,$date_created);
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
            $res["profile_pic"]=$profile_pic;
            $res["gender"]=$gender;
            $res["age"]=$age;
            $res["language"]=$language;
            $res["into_video"]=$intro_video;
            $res["category_id"]=$cat_id;
            $res["date_created"]=$this->convert_posted_on($date_created,$timezone);


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

    public function getAllCoaches($page_no,$row_count,$timezone){

    $offset     = ($row_count)*($page_no - 1);
    $query =   "SELECT user_id,email_id,
                           IFNULL(first_name,''),
                           IFNULL(last_name,''),
                            IFNULL(about_info,''),
                            IFNULL(profile_pic,''),
                            IFNULL(gender,''),
                            IFNULL(age,''),
                            IFNULL(language,''),
                            IFNULL(intro_video,''),
                           IFNULL(category_id,''),
                           date_created
                    FROM   users where user_type_id=2
            ORDER  BY date_created DESC
                    LIMIT  $offset , " . ($row_count + 1);

    $stmt   =   $this->conn->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $num_rows = $stmt->num_rows;
    $stmt->bind_result($user_id,$email_id,$first_name,$last_name,$about_info,$profile_pic,$gender,$age,$language,$intro_video,$cat_id,$date_created);
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
        $res["profile_pic"]=$profile_pic;
        $res["gender"]=$gender;
        $res["age"]=$age;
        $res["language"]=$language;
        $res["into_video"]=$intro_video;
        $res["category_id"]=$cat_id;
        $res["date_created"]=$this->convert_posted_on($date_created,$timezone);


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

    public function getMyCoaches($page_no,$row_count,$userid){


    $offset     = ($row_count)*($page_no - 1);
    $query =   "SELECT coach_user_id
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
            IFNULL(age,''),
            IFNULL(language,'') from users WHERE user_id=?";

        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bind_param('i',$coach_user_id);
        $stmt2->execute();
        $stmt2->store_result();
        $num_rows2   =   $stmt2->num_rows;
        $stmt2->bind_result($email_id,$first_name,$last_name,$about_info,$profile_pic,$category_id,$age,$language);
        while($stmt2->fetch()) {

            $res["coach_name"] = $first_name." ".$last_name;
            $res["coach_about_info"] = $about_info;
            $res["coach_profile_pic"] = $profile_pic;


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

    public function getproposedcoaches($category_id,$page_no,$timezone,$row_count){


        $offset     = ($row_count)*($page_no - 1);
        $query =   "SELECT user_id,email_id,
                           IFNULL(first_name,''),
                           IFNULL(last_name,''),
                            IFNULL(about_info,''),
                            IFNULL(profile_pic,''),
                            IFNULL(gender,''),
                            IFNULL(age,''),
                            IFNULL(language,''),
                            IFNULL(intro_video,''),
                            date_created
                    FROM   users WHERE FIND_IN_SET(?, category_id)
                    ORDER  BY date_created DESC
                    LIMIT  $offset , " . ($row_count + 1);

        $stmt   =   $this->conn->prepare($query);
        $stmt->bind_param('i',$category_id);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->bind_result($user_id,$email_id,$first_name,$last_name,$about_info,$profile_pic,$gender,$age,$language,$intro_video,$date_created);
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
            $res["profile_pic"]=$profile_pic;
            $res["gender"]=$gender;
            $res["age"]=$age;
            $res["language"]=$language;
            $res["into_video"]=$intro_video;
            $res["date_created"]=$this->convert_posted_on($date_created,$timezone);


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
            $res["profile_image"]=$profile_pic;

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

    public function getCreditCardInfo($user_id){

    $query =   "Select card_id,card_type,cardholder_name,card_number,expiry_date,cvv_number,default_flag from card_info
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


        $query =   "INSERT INTO sessions(
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


    public function updateProfile($user_id,$first_name,$last_name,$biography_text){
    $query =   "UPDATE users
                    SET    first_name = ?,
                           last_name = ?,
                           about_info=?
                    WHERE  user_id = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('sssi',$first_name, $last_name,$biography_text,$user_id);
    $result = $stmt->execute();
    $stmt->close();
    if($result) {
        $response["status"] = SUCCESS;

    }
    else {
        $response["status"] = REQUEST_ACCEPTED;

    }
    return $response;
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

    public function getCoachName($coach_id) {
        $stmt = $this->conn->prepare("SELECT first_name,last_name FROM users WHERE user_id = ? ");
        $stmt->bind_param("i", $coach_id);
        if ($stmt->execute()) {
            $stmt->bind_result($coach_fname,$coach_lname);
            $stmt->fetch();
            $stmt->close();
            return $coach_fname." ".$coach_lname;
        } else {
            return NULL;
        }
    }

    public function getfavourite($user_id, $page_no,$row_count,$timezone,$last_sync_date_time = ''){

        $offset     = ($row_count)*($page_no - 1);

        $Coach_Favorites["favourite_coaches"] = array();
        $query =   "SELECT coach_user_id,date_create
                    FROM   favourites
                    WHERE  client_user_id = ? ORDER BY date_create DESC
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
            $res["coach_user_id"]=$coach_id;
            $res["date_set_favourite"]=$this->convert_posted_on($date_created,$timezone);
            $query2="select email_id,
          IFNULL(first_name,''),
          IFNULL(last_name,''),
          IFNULL(about_info,''),
          IFNULL(profile_pic,'')
          from users WHERE user_id=?";

            $stmt2 = $this->conn->prepare($query2);
           $stmt2->bind_param('i',$coach_id);
            $stmt2->execute();
           $stmt2->store_result();
            $num_rows2   =   $stmt2->num_rows;
            $stmt2->bind_result($email_id,$first_name,$last_name,$about_info,$profile_pic);
            while($stmt2->fetch()) {

                $res["coach_name"] = $first_name." ".$last_name;
                $res["coach_about_info"] = $about_info;
                $res["coach_profile_pic"] = $profile_pic;


            }
            array_push($Coach_Favorites["favourite_coaches"],$res);
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
            $res["review_date_created"]=$this->convert_posted_on($date_created,$timezone);

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
                $res["coach_profile_pic"] = $profile_pic;


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
            $res["review_date_created"]=$this->convert_posted_on($date_created,$timezone);

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
                $res["client_profile_pic"] = $profile_pic;


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

    public function makeAppointment($user_id, $coach_id,$slot_id)
    {
        $query = "UPDATE slots set client_user_id=?,booked_flag=1 WHERE  slot_id=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param('ii', $user_id, $slot_id);
        $res = $stmt->execute();
        $stmt->close();
        if ($res) {

            $query2 =   "INSERT INTO sessions(
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
            $stmt2->bind_param('iii',$slot_id,$coach_id,$user_id);
            $result2 = $stmt2->execute();

            return true;
        }

        else
        {
            return false;
        }


    }

    public function getschedule($user_id,$timezone, $last_sync_date_time = ''){
    $mySchedule["my_schedule"] = array();
    $query =   "SELECT  slots.coach_user_id,slots.start_datetime,slots.end_datetime,IFNULL(sessions.notes,'') from slots LEFT JOIN sessions
                    ON slots.slot_id=sessions.slot_id and slots.client_user_id=sessions.client_user_id WHERE
    slots.client_user_id = ? ORDER BY slots.start_datetime DESC ";


    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('i',$user_id);
    $stmt->execute();
    $stmt->store_result();
    $num_rows   =   $stmt->num_rows;
    $stmt->bind_result($coach_id,$start_date,$end_date,$notes);
    while($stmt->fetch()){

        $res["coach_id"]=$coach_id;

        $res["session_start"]=$this->convert_posted_on($start_date,$timezone);
        $res["session_end"]=$this->convert_posted_on($end_date,$timezone);


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

        array_push($mySchedule["my_schedule"],$res);
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
        $schedule_date = new DateTime($date_schedule, new DateTimeZone($timezone) );
        //$schedule_date->setTimeZone(new DateTimeZone('UTC'));
        $sdt =  $schedule_date->format('Y-m-d');

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
            $date = date('Y-m-d',strtotime($start_datetime));

            if($date==$sdt )
            {
                $res["slot_id"] = $slot_id;
                $res["session_start"] =$this->convert_posted_on($start_datetime,$timezone);
                $res["session_end"] =$this->convert_posted_on($end_datetime,$timezone);

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
        $num_rows2   =   $stmt2->num_rows2;
        $stmt2->bind_result($slot_id2,$start_datetime2,$end_datetime2);
        while($stmt2->fetch()) {
            $date2 = date('Y-m-d',strtotime($start_datetime2));
            //$res["slot_id"] = $slot_id;
            //$res["session_start"] = $start_datetime;
            //$res["session_end"] =$end_datetime;
            if($date2==$sdt )
            {
                $res1["slot_id"] = $slot_id2;
                $res1["session_start"] =$this->convert_posted_on($start_datetime2,$timezone);
                $res1["session_end"] =$this->convert_posted_on($end_datetime2,$timezone);

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

        $query =   "SELECT sessions.coach_user_id,sessions.start_datetime,sessions.end_datetime,IFNULL(sessions.notes,'')
from sessions,slots where sessions.end_datetime<=CURRENT_DATE and
sessions.slot_id=slots.slot_id and sessions.client_user_id=? ORDER BY sessions.start_datetime DESC
    LIMIT  $offset , " . ($row_count + 1);

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i',$user_id);
        $stmt->execute();
        $stmt->store_result();
        $num_rows   =   $stmt->num_rows;
        $stmt->bind_result($coach_id,$start_date,$end_date,$notes);

        $counter    =   0;

        if ($num_rows > ($row_count))
            $userSchedule["next_page"] = "true";
        else
            $userSchedule["next_page"] = "false";

        while($stmt->fetch()){

            $res["coach_id"]=$coach_id;
            $res["session_notes"]=$notes;
            $res["session_start"]=$this->convert_posted_on($start_date,$timezone);
            $res["session_end"]=$this->convert_posted_on($end_date,$timezone);


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

                $res["coach_email_id"] = $email_id;
                $res["coach_name"] = $first_name." ".$last_name;
                $res["coach_profile_pic"] = $profile_pic;

            }

            array_push($userSchedule["user_sessions"],$res);

            $counter++;
            if ($counter == ($row_count))
                break;
        }
        $stmt->close();


        if($num_rows>0){
            return $userSchedule;
        }
        else{
            return false;
        }
    }

    public function get_credits($user_id,$timezone){
        $usercredits["credit_detail"] = '';

       echo  $query="SELECT credit_available.credit_available_id,credit_available.credit_available_qty,
                payments.session_id,payments.credit_qty from credit_available INNER JOIN payments ON credit_available.user_id=payments.user_id WHERE
    credit_available.user_id = ?";
exit;
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
                $res["coach_name"] = $this->getCoachName($coach_id);
                $res["start_datetime"] = convert_posted_on($start_datetime,$timezone);
                $res["end_datetime"] = convert_posted_on($end_datetime,$timezone);
                $res["credit_consumed_qty"]=$consumed_qty;

            }


            array_push($sessions,$res);
        }
        $res1["credit_available_id"]=$credit_available_id;
        $res1["available_credit_qty"]=$credit_available_qty;

        $usercredits["credit_detail"]["available_credit_detail"]=$res1;;

        if($num_rows2>0){
            //array_push($usercredits["credit_detail"],$sessions);

            $usercredits["credit_detail"]["consumed_credit_detail"]=$sessions;
        }

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


    function ConvertGMTToLocalTimezone($gmttime, $timezoneRequired){
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

        return $date;
    }



}