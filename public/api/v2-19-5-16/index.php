<?php
/**
 * Created by PhpStorm.
 * User: Narendra
 * Date: 3/25/2015
 * Time: 3:47 PM
 */

require_once 'include/DbHandler.php';
require_once 'include/Constants.php';
require '.././libs/Slim/Slim.php';
require_once 'include/createsession.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

// User id from db - Global Variable
$user_id = NULL;


$app->get('/get_coach_categories/:param/:help',function(){
    $help_data["params"] = "No param required";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/get_client_profile_data/:param/:help',function(){
    $help_data["params"] = "No param required";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/search_coaches/:param/:help',function(){
    $help_data["params"] = "page_no,search_text";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/get_all_coaches1/:param/:help',function(){
    $help_data["params"] = "page_no";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/get_all_coaches/:param/:help',function(){
    $help_data["params"] = "page_no";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/get_my_schedule/:param/:help',function(){
    $help_data["params"] = "No param required";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/get_coach_schedule/:param/:help',function(){
    $help_data["params"] = "coach_id,date_schedule";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/get_timeline/:param/:help',function(){
    $help_data["params"] = "page_no";;
    echoResponse(SUCCESS,$help_data);
});

$app->get('/get_credits/:param/:help',function(){
    $help_data["params"] = "No param required";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/get_payment_methods/:param/:help',function(){
    $help_data["params"] ="No param required";
    echoResponse(SUCCESS,$help_data);
});


/**************************************************************************
 *************/


$app->get('/get_my_reviews/:param/:help',function(){
    $help_data["params"] = "page_no,time_zone";
    echoResponse(SUCCESS,$help_data);
});


$app->get('/user_signup_via_email/:param/:help',function(){
    $help_data["params"] = "user_email, user_pwd,user_phone,first_name,last_name";
    echoResponse(SUCCESS,$help_data);

});

$app->get('/get_my_coaches/:param/:help',function(){
    $help_data["params"] = "page_no";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/get_coach_reviews/:param/:help',function(){
    $help_data["params"] = "coach_id";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/update_profile/:param/:help',function(){
    $help_data["params"] = "first_name, last_name,biography_text";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/save_session_info/:param/:help',function(){
    $help_data["params"] = "slot_id, coach_id,client_id,start_dt,end_dt,notes";
    echoResponse(SUCCESS,$help_data);
});



$app->get('/save_payment_info/:param/:help',function(){
    $help_data["params"] = "session_id, payment_method_id',card_id,currency_type,credit_qty";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/select_payment_method_default/:param/:help',function(){
    $help_data["params"] = "card_id, payment_method_id";
    echoResponse(SUCCESS,$help_data);
});


$app->get('/update_profile_image/:param/:help',function(){
    $help_data["params"] = "JSON data";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/save_credit_card_info/:param/:help',function(){
    $help_data["params"] = "card_type,cardholder_name,card_number,expiry_date,cvv_number";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/save_paypal_info/:param/:help',function(){
    $help_data["params"] = "transaction_token,metadata";
    echoResponse(SUCCESS,$help_data);
});


$app->get('/save_reviews/:param/:help',function(){
        $help_data["params"] = "coach_id,review,rating";
        echoResponse(SUCCESS,$help_data);
    });

$app->get('/delete_credit_card_info/:param/:help',function(){
    $help_data["params"] = "card_id";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/user_signin_via_email/:param/:help',function(){
    $help_data["params"] = "user_email, user_pwd";
    echoResponse(SUCCESS,$help_data);

});

$app->get('/send_forgot_pwd_link/:param/:help',function(){
    $help_data["params"] = "user_email";
    echoResponse(SUCCESS,$help_data);

});

$app->get('/make_appointment/:param/:help',function(){
    $help_data["params"] = "coach_id,slot_id,timezone";
    echoResponse(SUCCESS,$help_data);

});

$app->get('/cancel_appointment/:param/:help',function(){
    $help_data["params"] = "coach_id,slot_id,timezone";
    echoResponse(SUCCESS,$help_data);

});

$app->get('/set_coach_favourite/:param/:help',function(){
    $help_data["params"] = "coach_id";
    echoResponse(SUCCESS,$help_data);

});

$app->get('/get_proposed_coaches/:param/:help',function(){
    $help_data["params"] = 'category_id,page_no';
    echoResponse(SUCCESS,$help_data);

});

$app->post('/update_profile/:param/:help',function(){
    $help_data["params"] = "first_name,last_name";
    echoResponse(SUCCESS,$help_data);

});

$app->post('/save_mentality_match/:param/:help',function(){
    $help_data["params"] = "answers";
    echoResponse(SUCCESS,$help_data);

});




/**
 *
 ***************************************************************************
 ***********
 */


/**
 * ----------- METHODS WITHOUT AUTHENTICATION
---------------------------------
 */

/* API URL Description */
$app->get('/',function(){
    /*...........................................GET WITH AUTHORIZATION 
REQUESTS.......................................................*/

    $result_data["yve"]["GET WITH AUTHORIZATION REQUESTS"]
    ["get_my_schedule"]["help_url"] = API_BASE_URL .
        "/get_my_schedule/param/help";
    $result_data["yve"]["GET WITH AUTHORIZATION REQUESTS"]
    ["get_coach_schedule"]["help_url"] = API_BASE_URL .
        "/get_coach_schedule/param/help";
    $result_data["yve"]["GET WITH AUTHORIZATION REQUESTS"]["get_timeline"]
    ["help_url"] = API_BASE_URL . "/get_timeline/param/help";
    $result_data["yve"]["GET WITH AUTHORIZATION REQUESTS"]
    ["get_client_profile_data"]["help_url"] = API_BASE_URL .
        "/get_client_profile_data/param/help";
    $result_data["yve"]["GET WITH AUTHORIZATION REQUESTS"]
    ["get_favourite_coaches"]["help_url"] = API_BASE_URL .
        "/get_favourite_coaches/param/help";
    $result_data["yve"]["GET WITH AUTHORIZATION REQUESTS"]
    ["get_my_reviews"]["help_url"] = API_BASE_URL .
        "/get_my_reviews/param/help";

    $result_data["yve"]["GET WITH AUTHORIZATION REQUESTS"]
    ["get_credits"]["help_url"] = API_BASE_URL .
        "/get_credits/param/help";

    $result_data["yve"]["GET WITH AUTHORIZATION REQUESTS"]
    ["get_payment_methods"]["help_url"] = API_BASE_URL .
        "/get_payment_methods/param/help";

    $result_data["yve"]["GET WITH AUTHORIZATION REQUESTS"]
    ["get_coach_reviews"]["help_url"] = API_BASE_URL .
        "/get_coach_reviews/param/help";

    $result_data["yve"]["GET WITH AUTHORIZATION REQUESTS"]
    ["get_proposed_coaches"]["help_url"] = API_BASE_URL .
        "/get_proposed_coaches/param/help";



    /*...........................................GET WITHOUT AUTHORIZATION 
REQUESTS.......................................................*/

    $result_data["YVE"]["GET WITHOUT AUTHORIZATION REQUESTS"]
    ["get_coach_categories"]["help_url"] = API_BASE_URL .
        "/get_coach_categories/param/help";

    $result_data["yve"]["GET WITHOUT AUTHORIZATION REQUESTS"]
    ["get_all_coaches1"]["help_url"] = API_BASE_URL .
        "/get_all_coaches1/param/help";

    $result_data["yve"]["GET WITHOUT AUTHORIZATION REQUESTS"]
    ["get_all_coaches"]["help_url"] = API_BASE_URL .
        "/get_all_coaches/param/help";

    $result_data["yve"]["GET WITHOUT AUTHORIZATION REQUESTS"]
    ["search_coaches'"]["help_url"] = API_BASE_URL .
        "/search_coaches'/param/help";



    /*...........................................POST WITH AUTHORIZATION 
REQUESTS.......................................................*/

    $result_data["yve"]["POST WITH AUTHORIZATION REQUESTS"]
    ["update_profile_image"]["help_url"] = API_BASE_URL .
        "/update_profile_image/param/help";
    $result_data["yve"]["POST WITH AUTHORIZATION REQUESTS"]
    ["update_profile"]["help_url"] = API_BASE_URL .
        "/update_profile/param/help";

    $result_data["yve"]["POST WITH AUTHORIZATION REQUESTS"]
    ["get_my_coaches"]["help_url"] = API_BASE_URL .
        "/get_my_coaches/param/help";

    $result_data["yve"]["POST WITH AUTHORIZATION REQUESTS"]
    ["make_appointment"]["help_url"] = API_BASE_URL .
        "/make_appointment/param/help";

    $result_data["yve"]["POST WITH AUTHORIZATION REQUESTS"]
    ["cancel_appointment"]["help_url"] = API_BASE_URL .
        "/cancel_appointment/param/help";


    $result_data["yve"]["POST WITH AUTHORIZATION REQUESTS"]
    ["set_coach_favourite"]["help_url"] = API_BASE_URL .
        "/set_coach_favourite/param/help";

    $result_data["yve"]["POST WITH AUTHORIZATION REQUESTS"]
    ["save_credit_card_info"]["help_url"] = API_BASE_URL .
        "/save_credit_card_info/param/help";
		
	$result_data["yve"]["POST WITH AUTHORIZATION REQUESTS"]
    ["save_paypal_info"]["help_url"] = API_BASE_URL .
        "/save_paypal_info/param/help";	

    $result_data["yve"]["POST WITH AUTHORIZATION REQUESTS"]
    ["delete_credit_card_info"]["help_url"] = API_BASE_URL .
        "/delete_credit_card_info/param/help";


    $result_data["yve"]["POST WITH AUTHORIZATION REQUESTS"]
    ["save_session_info"]["help_url"] = API_BASE_URL .
        "/save_session_info/param/help";

    $result_data["yve"]["POST WITH AUTHORIZATION REQUESTS"]
    ["save_reviews"]["help_url"] = API_BASE_URL .
        "/save_reviews/param/help";

    $result_data["yve"]["POST WITH AUTHORIZATION REQUESTS"]
    ["save_payment_info"]["help_url"] = API_BASE_URL .
        "/save_payment_info/param/help";

    $result_data["yve"]["POST WITH AUTHORIZATION REQUESTS"]
    ["save_mentality_match"]["help_url"] = API_BASE_URL .
        "/save_mentality_match/param/help";



    /*...........................................POST WITHOUT AUTHORIZATION 
REQUESTS.......................................................*/




    $result_data["yve"]["POST WITHOUT AUTHORIZATION REQUESTS"]
    ["user_signup_via_email"]["help_url"] = API_BASE_URL .
        "/user_signup_via_email/param/help";
    $result_data["yve"]["POST WITHOUT AUTHORIZATION REQUESTS"]
    ["user_signin_via_email"]["help_url"] = API_BASE_URL .
        "/user_signin_via_email/param/help";
    $result_data["yve"]["POST WITHOUT AUTHORIZATION REQUESTS"]
    ["send_forgot_pwd_link"]["help_url"] = API_BASE_URL .
        "/send_forgot_pwd_link/param/help";


    echoResponse(200,$result_data);
});


$app->get('/get_coach_categories',function() {
    //verify Required Params

    $db = new DbHandler();

    $res = $db->getCoachCategories();

    if($res){
        echoResponse(SUCCESS,$res);
    }
    else{
        echoStatus(NO_CONTENT);
    }
});

$app->get('/get_all_coaches','authenticate',function() use ($app) {
    //verify Required Params
    verifyRequiredParams(array('page_no','timezone'));
    $page_id = $app->request()->get('page_no');
    $timezone = $app->request()->get('timezone');
    $row_count      =   COACH_LIMIT;
    $db = new DbHandler();
    global $user_id;
    $res = $db->getAllCoaches($user_id,$page_id,$row_count,$timezone);

    if($res){
       echoResponse(SUCCESS,$res);
   }
   else
   {
      echoStatus(NO_CONTENT);
   }

});

$app->get('/get_all_coaches1',function() use ($app) {
    //verify Required Params
    verifyRequiredParams(array('page_no','timezone'));
    $page_id = $app->request()->get('page_no');
    $timezone = $app->request()->get('timezone');
    $row_count      =   COACH_LIMIT;
    $db = new DbHandler();

    $res = $db->getAllCoaches1($page_id,$row_count,$timezone);

    if($res){
        echoResponse(SUCCESS,$res);
    }
    else{
        echoStatus(NO_CONTENT);
    }
});

$app->get('/search_coaches','authenticate',function() use ($app) {
    //verify Required Params
    verifyRequiredParams(array('page_no','timezone','search_text'));
    $page_no = $app->request()->get('page_no');
    $timezone = $app->request()->get('timezone');
    $search_text = $app->request()->get('search_text');
    $row_count      =   COACH_LIMIT;
    $db = new DbHandler();
    global $user_id;
    $res = $db->searchCoach($page_no,$row_count,$timezone,$search_text,$user_id);

    if($res){
        echoResponse(SUCCESS,$res);
    }
    else{
        echoStatus(NO_CONTENT);
    }
});


$app->get('/get_coach_reviews',function() use ($app) {
    //verify Required Params
    verifyRequiredParams(array('coach_id','page_no','timezone'));
    $page_no = $app->request()->get('page_no');
    $coach_id = $app->request()->get('coach_id');
    $timezone = $app->request()->get('timezone');
    $row_count      =   REVIEW_LIMIT;
    $db = new DbHandler();

    $res = $db->getCoachReviews($coach_id,$page_no,$row_count,$timezone);

    if($res){
        echoResponse(SUCCESS,$res);
    }
    else{
        echoStatus(NO_CONTENT);
    }
});



$app->post('/user_signup_via_email',function() use ($app){

    // check for required params
    verifyRequiredParams(array('user_email', 'user_pwd', 'user_phone'));

    // reading post params
    $user_email = $app->request()->post('user_email');
    $user_pwd = $app->request()->post('user_pwd');
    $user_phone = $app->request()->post('user_phone');
    $user_fname = $app->request()->post('first_name');
    $user_lname = $app->request()->post('last_name');


    $db = new DbHandler();


    if(!$db->isUserExists($user_email)){
        $res = $db->userSignUpViaEmail($user_email, $user_pwd,
            $user_phone,$user_fname,$user_lname);

        if($res["status"]!=REQUEST_ACCEPTED)
            echoResponse(SUCCESS,$res);
        else
            echoStatus(REQUEST_ACCEPTED);


    }
    else{
        echoStatus(CONFLICT);
    }


});

$app->post('/user_signin_via_email',function() use ($app) {

    // check for required params
    verifyRequiredParams(array('user_email', 'user_pwd'));

    // reading post params
    $user_email = $app->request()->post('user_email');
    $user_pwd = $app->request()->post('user_pwd');

    $db = new DbHandler();

    $res = $db->userSignInViaEmail($user_email, $user_pwd);

    if ($res["status"] != UNAUTHORIZED)
    {
        echoResponse(SUCCESS, $res);
    }
    else
    {
        echoStatus(UNAUTHORIZED);
    }

});

$app->post('/send_forgot_pwd_link',function() use ($app){

    // check for required params
    verifyRequiredParams(array('user_email'));

    // reading post params
    $user_email = $app->request()->post('user_email');

    $db = new DbHandler();
    $res = $db->sendforgotpwdlink($user_email);

    if($res["status"]!=NOT_FOUND)
    {
        $subject    =   "YVE : Reset Password ";

        $text2 = $user_email;
        $ciphertext_base64 = base64_encode($text2);

        $body="<html><head></head><body><p>Hi</p><p>You requested that your password be reset. Please visit the link below or copy and paste it into your browser to create a new password.</p><p><a href=http://$_SERVER[HTTP_HOST]/forgot?email=".$ciphertext_base64.">http://$_SERVER[HTTP_HOST]/forgot?email=".$ciphertext_base64."</a><p>Thanks<br/>Administrator</p></body></html>";

        $mail_sent=$db->sendmail($user_email,$subject,$body);

        if($mail_sent["status"]!=REQUEST_ACCEPTED)
        {
            echoStatus(SUCCESS);
        }

        else
        {
            echoStatus(REQUEST_ACCEPTED);
        }


    }
   else{

       echoStatus(NOT_FOUND);

    }

});


$app->post('/save_mentality_match','authenticate',function() use ($app){

    // check for required params
   verifyRequiredParams(array('answers'));
   // header("Content-Type: application/json");
   $json = $app->request()->post('answers');

   // $json = "{\"ename\":\"user1\",\"id\":\"940\"}";

    $data = (Array)json_decode($json);

       $gendor = $data["ans1"];
    $approach = $data["ans2"];
    $spirit = $data["ans3"];
    $philosphy = $data["ans4"];
    $mentor = $data["ans5"];
    $board = $data["ans6"];
    $setting = $data["ans7"];
    $pd = $data["ans8"];
    $typeid='1';
    $prd=$data["ans9"];
    $age=$data["ans10"];
    $lang=$data["ans11"];

    global $user_id;
    $db = new DbHandler();


    $res = $db->save_mentality_match($user_id, $typeid, $gendor,$approach,$spirit, $philosphy,$mentor,$board,$setting,$pd,$prd,$age,$lang);

    if($res["status"]==SUCCESS){
        echoStatus(SUCCESS);
    }

    else{
      echoStatus($res["status"]);
    }

});


$app->post('/select_payment_method_default','authenticate',function() use ($app){

    // check for required params
    verifyRequiredParams(array('payment_method_id'));

    // reading post params
    $card_id = $app->request()->post('card_id');
	$payment_method_id = $app->request()->post('payment_method_id');

    global $user_id;
    $db = new DbHandler();
    $res = $db->setpaymentdefault($user_id,$card_id,$payment_method_id);

   if($res["status"]==SUCCESS){
	   echoResponse(SUCCESS,$res["payment_info"]);
       //echoStatus($res["status"]);
   }

    else{
		 echoStatus(NOT_FOUND);
        //echoStatus(NOT_FOUND);
   }

});

$app->post('/update_profile','authenticate',function() use ($app) {
    header('Content-Type: application/json; charset=utf-8');
    $fname = $app->request()->post('first_name');
    $lname = $app->request()->post('last_name');
    global $user_id;
    $db = new DbHandler();
    $msg = '';
    if($_FILES['profile_image'])
    {
    if ($_FILES['profile_image']['size'] <= 5242880) {

        $tmp_name = $_FILES['profile_image']['tmp_name'];
        $t = realpath('./') . '/';
        $tarr = explode('api', $t);

        $imgname="yveimgid".$user_id;

        $target_dir = $tarr[0] . "images/profile/" . $imgname;
$dist="images/profile/" . $imgname;
        $allowed = array('image/gif', 'image/png', 'image/jpg', 'image/jpeg');

        $ext = $_FILES['profile_image']['type'];

        if (!in_array($ext, $allowed)) {
            $log = false;
            $response['msg'] ="Image File is not in valid image format";
            echoResponse(SUCCESS,$response);

        } else {

            if (move_uploaded_file($tmp_name, $target_dir)) {
                //$r=$db->updateprofile($fname,$lname,$target_dir,$user_id);

                $msg = "The file " . basename($_FILES["profile_image"]["name"]) . " has been uploaded.";
                $res = $db->updateprofile($fname,$lname,$user_id,$dist );
                if($res["status"]!=REQUEST_ACCEPTED){
                    echoResponse(SUCCESS,$res);
                }
                else{
                    echoStatus(REQUEST_ACCEPTED);
                }

            } else {
                $response['msg'] ="Sorry, there was an error uploading your file.";
                echoResponse(SUCCESS,$response);
            }

        }
    } else {


        $msg ="Sorry, Image File is over 5 mb in size!";

    }

}
else
    {

        $res = $db->updatename($fname,$lname,$user_id );
        if($res!=REQUEST_ACCEPTED){
            echoResponse(SUCCESS,$res);
        }
        else{
            echoStatus(REQUEST_ACCEPTED);
        }

    }


      });



/**
 * ------------------------ METHODS WITH AUTHENTICATION
------------------------
 */

$app->get('/get_client_profile_data','authenticate',function() use ($app) {
    //verify Required Params
    global $user_id;
    $db = new DbHandler();

    $res = $db->getProfiledata($user_id);

    if($res){
        echoResponse(SUCCESS,$res);
    }
    else{
        echoResponse(NO_CONTENT,$res);
    }
});

$app->get('/get_proposed_coaches','authenticate',function() use ($app){
    //verify Required Params

    verifyRequiredParams(array('category_id','page_no','timezone'));

    $page_no = $app->request()->get('page_no');
    $category_id = $app->request()->get('category_id');
    $timezone = $app->request()->get('timezone');
    $row_count=MY_COACH_LIMIT;
    global $user_id;
    $db = new DbHandler();

    $res = $db->getproposedcoaches($category_id,$page_no,$timezone,$row_count,$user_id);

    if($res){
        echoResponse(SUCCESS,$res);
    }
    else{
        echoStatus(NO_CONTENT);
    }
});

$app->get('/get_client_profile_data','authenticate',function() use ($app) {
    //verify Required Params
    global $user_id;
    $db = new DbHandler();

    $res = $db->getProfiledata($user_id);

    if($res){
        echoResponse(SUCCESS,$res);
    }
    else{
        echoResponse(NO_CONTENT,$res);
    }
});

$app->get('/get_payment_methods','authenticate',function() use ($app) {
    //verify Required Params
    global $user_id;
    $db = new DbHandler();

    $res = $db-> getPaymentMethodInfo($user_id);

    if($res){
        echoResponse(SUCCESS,$res);
    }
    else{
        echoResponse(NO_CONTENT,$res);
    }
});





$app->get('/get_my_coaches','authenticate',function()use($app){
    //verify Required Params
    global $user_id;
    verifyRequiredParams(array('page_no','timezone'));
    $page_no = $app->request()->get('page_no');
    $timezone = $app->request()->get('timezone');

    $row_count      =   MY_COACH_LIMIT;
    $db = new DbHandler();

    $res = $db->getMyCoaches($page_no,$row_count,$user_id,$timezone);

    if($res){
        echoResponse(SUCCESS,$res);
    }
    else{
        echoStatus(NO_CONTENT);
    }
});



$app->get('/get_my_reviews','authenticate',function() use ($app){

    global $user_id;
    $row_count      =   REVIEW_LIMIT;
    // Reading Required params
    verifyRequiredParams(array('page_no','timezone'));
    $page_id = $app->request()->get('page_no');
    $timezone = $app->request()->get('timezone');

    $db     =   new DbHandler();
    $res    =   $db->getreviews($user_id,$page_id,$row_count,
        $timezone);

    if($res){
        echoResponse(SUCCESS,$res);
    }
    else{
        echoStatus(NO_CONTENT);
    }
});

$app->get('/get_my_schedule','authenticate',function() use($app){
    global $user_id;

    verifyRequiredParams(array('timezone'));

    $timezone = $app->request()->get('timezone');

    $db     =   new DbHandler();
    $res    =   $db->getschedule($user_id,$timezone);

    if($res){
        echoResponse(SUCCESS,$res);
    }
    else{
        echoStatus(NO_CONTENT);
    }
});

$app->get('/get_coach_schedule','authenticate',function() use($app){
    global $user_id;

    verifyRequiredParams(array('coach_id','date_schedule','timezone'));

    $coach_id = $app->request()->get('coach_id');
    $date_schedule = $app->request()->get('date_schedule');
    $timezone = $app->request()->get('timezone');

    $db     =   new DbHandler();
    //$coach_id=$db->getCoachId($coach_email);

    $res    =   $db->getcoachschedule($user_id,$coach_id,$date_schedule,$timezone);

  if($res){
      echoResponse(SUCCESS,$res);
    }
   else{
       echoStatus(NO_CONTENT);
    }
});


$app->get('/get_timeline','authenticate',function() use($app){
    global $user_id;

    verifyRequiredParams(array('page_no'));
    $timezone = $app->request()->get('timezone');
    $page_no=$app->request()->get('page_no');
    $row_count=TIMELINE_LIMIT;

    $db     =   new DbHandler();
    $res    =   $db->gettimeline($user_id,$page_no,$row_count,$timezone);

    if($res){
       echoResponse(SUCCESS,$res);
    }
    else{
        echoStatus(NO_CONTENT);
    }
});

$app->get('/get_credits','authenticate',function() use($app){
    global $user_id;

    verifyRequiredParams(array('timezone'));
    $timezone = $app->request()->get('timezone');

    $db     =   new DbHandler();
    $res    =   $db->get_credits($user_id,$timezone);

    if($res){
        echoResponse(SUCCESS,$res);
    }
    else{
        echoStatus(NO_CONTENT);
    }
});

$app->get('/get_favourite_coaches','authenticate',function() use ($app) {
    //verify Required Params
    global $user_id;
    verifyRequiredParams(array('page_no','timezone'));
    $page_no = $app->request()->get('page_no');
    $timezone = $app->request()->get('timezone');
    $row_count      =   FAVOURITE_COACH_LIMIT;

    $db = new DbHandler();

    $res = $db->getfavourite($user_id,$page_no,$row_count,$timezone);

    if($res){
        echoResponse(SUCCESS,$res);
    }
    else{
        echoStatus(NO_CONTENT);
    }
});




$app->post('/save_payment_info','authenticate',function() use ($app) {

    verifyRequiredParams(array('session_id','payment_method_id','paypal_transaction_id','card_id','currency_type','credit_qty','payment_date'));

    $session_id= $app->request->post('session_id');
    $payment_method_id= $app->request->post('payment_method_id');
    $pay_transaction_id = $app->request->post('paypal_transaction_id');
    $card_id = $app->request->post('card_id');

    $currency_type= $app->request->post('currency_type');
    $credit_qty= $app->request->post('credit_qty');

    global $user_id;
    $db = new DbHandler();

    $amount=(int)CREDIT_VALUE*(int)($credit_qty);



    $res = $db-> savePaymentInfo($user_id,$session_id,$payment_method_id, $paypal_transaction_id,$card_id,$amount,$currency_type,$credit_qty);

    if($res){
       echoStatus(SUCCESS);
    }

    else{
        echoStatus(CONFLICT);
    }

});

$app->post('/save_session_info','authenticate',function() use ($app) {

    verifyRequiredParams(array('slot_id','coach_id','client_id','start_dt','end_dt','notes'));

    $slot_id = $app->request->post('slot_id');
    $coach_id = $app->request->post('coach_id');
    $client_id = $app->request->post('client_id');
    $start_dt = $app->request->post('start_dt');
    $end_dt = $app->request->post('end_dt');
    $notes = $app->request->post('notes');

    global $user_id;
    $db = new DbHandler();

    $res = $db-> saveSessionInfo($slot_id,$coach_id,$client_id,$start_dt,$end_dt,$notes);

    if($res){
        echoStatus(SUCCESS);
        }

    else{
        echoStatus(CONFLICT);
    }
});

$app->post('/save_reviews','authenticate',function() use ($app) {

    verifyRequiredParams(array('coach_id','review','rating'));

    $coach_id = $app->request->post('coach_id');
    $review = $app->request->post('review');
    $rating = $app->request->post('rating');


    global $user_id;
    $db = new DbHandler();

    $res = $db-> saveReviews($coach_id,$user_id,$review,$rating);

    if($res){
        echoStatus(SUCCESS);
    }

    else{
        echoStatus(CONFLICT);
    }
});

$app->post('/save_credit_card_info','authenticate',function() use ($app) {

    verifyRequiredParams(array('card_type','cardholder_name','card_number','expiry_date','cvv_number'));

    /* Reading Params*/
    $card_type = $app->request->post('card_type');
    $cardholder_name = $app->request->post('cardholder_name');
    $card_number = $app->request->post('card_number');
    $expiry_date = $app->request->post('expiry_date');
    $cvv_number = $app->request->post('cvv_number');

    global $user_id;
    $db = new DbHandler();

    $res = $db-> saveCreditCardInfo($user_id,$card_type,$cardholder_name,$card_number,$expiry_date,$cvv_number);

    if($res)
        echoStatus(SUCCESS);

    else{
        echoStatus(CONFLICT);
    }
});

$app->post('/save_paypal_info','authenticate',function() use ($app) {

    verifyRequiredParams(array('transaction_token','metadata'));

    /* Reading Params*/
    $transaction_token = $app->request->post('transaction_token');
    $metadata = $app->request->post('metadata');
  
    global $user_id;
    $db = new DbHandler();

    $res = $db-> savePaypalInfo($user_id,$transaction_token,$metadata);

    if($res)
        echoStatus(SUCCESS);

    else{
        echoStatus(CONFLICT);
    }
});

$app->post('/delete_credit_card_info','authenticate',function() use ($app) {

    verifyRequiredParams(array('card_id'));

    /* Reading Params*/
    $card_id = $app->request->post('card_id');

    global $user_id;
    $db = new DbHandler();

    $res = $db-> deleteCreditCardInfo($card_id);

    if($res)
        echoStatus(SUCCESS);

    else{
        echoStatus(NOT_FOUND);
    }
});

$app->post('/make_appointment','authenticate',function()use($app){

    verifyRequiredParams(array('coach_id','slot_id','timezone'));

    /* Reading Params*/
    $coach_id = $app->request->post('coach_id');
    $slot_id = $app->request->post('slot_id');
    $timezone = $app->request()->post('timezone');

    global $user_id;
    $db = new DbHandler();
    //$coach_id=$db->getCoachId($coach_email);

    $coach_email=$db->getemail($coach_id);

    $client_email=$db->getemail($user_id);

    $coach_name=$db->getUserName($coach_id);

    $client_name=$db->getUserName($user_id);

    $res = $db->makeAppointment($user_id, $coach_id,$slot_id,$timezone);
		if($res['status'] == CONFLICT)
		{ 
			echoStatus(CONFLICT);
		}	
      else if ($res['status'] == NO_CONTENT) 
	  {
	  	$res['message'] = "Insufficent credits";
		echoResponse(NO_CONTENT,$res['message']);
	  }
	  else if($res['status'] != CONFLICT && $res['status'] != NO_CONTENT)
	  {
         $d= strtotime($res["sdt"]);

        $d1=  date("l jS F Y g:i a" ,$d);
          $subject    =   "YVE : Appointment booking confirmation ";

          $body='<html>
        <head>
        </head>
        <body style="">
        <div style="background: #ffffff; width:600px; height:400px;position: relative">
        <div style="height: 40px;background: #E9E9E9; width:96%;padding: 2%;color:#484848; font-size: 15px; font-family: arial, helvetica, sans-serif;  border-bottom: 1px solid #c0c0c0">
        <h2>YVE</h2>
        <div style="background: #ffffff; padding:2%;width:96%; font-family: arial, helvetica, sans-serif; font-size: 13px; color:#484848">
            <p><strong>Hi</strong></p><p>Your Appointment has been booked with coach <strong><span style="text-transform: capitalize">'.$coach_name.'</span></strong> on '.$d1.'. Please feel free to contact us for any future assistance.<p><br/><br/>Thanks<br/><br/><strong>Administrator</strong></p>
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
            <p><strong>Hi</strong></p><p>Your Appointment has been booked with client <strong><span style="text-transform: capitalize">'.$client_name.'</span></strong> on '.$d1.'. Please free feel to contact us for any future assistance.<p><br/><br/>Thanks<br/><br/><strong>Administrator</strong></p>
        </div>
    </div>
    <div style="position: absolute; background-color: #E9E9E9;bottom: 0; height: 40px;padding: 2%; width:96%"></div>
    </div>

    </body>
    </html>';

          $mail_sent=$db->sendmail($client_email,$subject,$body);

          $mail_sent=$db->sendmail($coach_email,$subject,$body2);

          echoStatus(SUCCESS);
      }
	  else
	  {}
    
});

$app->post('/cancel_appointment','authenticate',function()use($app){

    verifyRequiredParams(array('coach_id','slot_id','timezone'));

    /* Reading Params*/
    $coach_id = $app->request->post('coach_id');
    $slot_id = $app->request->post('slot_id');
    $timezone = $app->request()->post('timezone');

    global $user_id;
    $db = new DbHandler();
    //$coach_id=$db->getCoachId($coach_email);

    $coach_email=$db->getemail($coach_id);

    $client_email=$db->getemail($user_id);

    $coach_name=$db->getUserName($coach_id);

    $client_name=$db->getUserName($user_id);

    $res = $db->cancelAppointment($user_id, $coach_id,$slot_id,$timezone);
    $sdt=$res["start_time"];

    $d= strtotime($sdt);

    $d1=  date("l jS F Y g:i a" ,$d);

    if($res["status"]!=NOT_FOUND) {

        $subject    =   "YVE : Appointment Cancel confirmation ";

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

        $mail_sent=$db->sendmail($client_email,$subject,$body);

        $mail_sent=$db->sendmail($coach_email,$subject,$body2);

        echoStatus(SUCCESS);
    }
    else
        echoStatus(NOT_FOUND);

});

$app->post('/set_coach_favourite','authenticate',function()use($app){

    verifyRequiredParams(array('coach_id','favourite_flag'));

    /* Reading Params*/
    $coach_id = $app->request->post('coach_id');
    $favourite_flag = $app->request->post('favourite_flag');

    global $user_id;
    $db = new DbHandler();
    //$coach_id=$db->getCoachId($coach_email);

    $res = $db->set_favourite($user_id, $coach_id,$favourite_flag);

   if($res)
       echoResponse(SUCCESS,$res);
    else
      echoStatus(REQUEST_ACCEPTED);

});


/**************************************************************************
 ************************/

/**
 * Adding Middle Layer to authenticate every request
 * Checking if the request has valid api key in the 'Authorization' header
 */
function authenticate(\Slim\Route $route) {
    // Getting request headers
    $headers = apache_request_headers();

    $app = \Slim\Slim::getInstance();
    
    // Verifying Authorization Header
    if (isset($headers['Token'])) {
        $db = new DbHandler();

        // get the api key
        $api_key = $headers['Token'];
        // validating api key
        if (!$db->isValidApiKey($api_key)) {
            // api key is not present in users table
            echoStatus(UNAUTHORIZED);
            $app->stop();
        } else {
            global $user_id;
            // get user primary key id
            $user_id = $db->getUserId($api_key);
        }
    } else {
        // api key is missing in header
        echoStatus(BAD_REQUEST);
        $app->stop();
    }
}


/**
 * Verifying required params posted or not
 */
function verifyRequiredParams($required_fields) {
    $error = false;
    $error_fields = "";
    $request_params = array();
    $request_params = $_REQUEST;
    // Handling PUT request params
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $app = \Slim\Slim::getInstance();
        parse_str($app->request()->getBody(), $request_params);
    }
    foreach ($required_fields as $field) {
        if (!isset($request_params[$field]) || strlen(trim($request_params
            [$field])) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
        $app = \Slim\Slim::getInstance();
        echoStatus(BAD_REQUEST);
        $app->stop();
    }
}


/**
 * Validating email address
 */
function validateEmail($email) {
    $app = \Slim\Slim::getInstance();
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //$response["error"] = true;
        //$response["message"] = 'Email address is not valid';
        echoStatus(BAD_REQUEST);
        $app->stop();
    }
}


/**
 * Validating mobile number
 */
function validateMobile($mobile){
    $app =  \Slim\Slim::getInstance();
    if((!filter_var($mobile,FILTER_VALIDATE_INT)) && (strlen($mobile) < 8
            && strlen($mobile) > 20) ){
        echoStatus(BAD_REQUEST);
        $app->stop();
    }
}


/**
 * Validate float
 */
function validateFloat($float_value){
    $app =  \Slim\Slim::getInstance();
    if(!filter_var($float_value,FILTER_VALIDATE_FLOAT)){
        echoStatus(BAD_REQUEST);
        $app->stop();
    }
}


/**
 * Validate Integer
 */
function validateInteger($integer_value){
    $app =  \Slim\Slim::getInstance();
    if(!filter_var($integer_value,FILTER_VALIDATE_INT)){
        echoStatus(BAD_REQUEST);
        $app->stop();
    }
}


/**
 * Echoing json response to client
 * @param String $status_code Http response code
 */
function echoStatus($status_code){
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);
    // setting response content type to json
    $app->contentType('application/json; charset=utf-8');
}


/**
 * Echoing json response to client
 * @param String $status_code Http response code
 * @param Int $response Json response
 */
function echoResponse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);

    // setting response content type to json
    $app->contentType('application/json; charset=utf-8');
    echo json_encode($response);
}


/**
 * Conver the date format
 * @param $date
 */
function convert_posted_on($date,$timezoneRequired){
    $date = ConvertGMTToLocalTimezone($date, $timezoneRequired);
    //$newDate = date("M,d Y   g:iA", strtotime($date->date));
    return $date->format('M,d Y   g:iA');
}


/**
 * Conver GMT to Local timezone
 * @param $gmttime date and time
 * @para $timezoneRequired required timezone
 */
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


$app->run();
?>