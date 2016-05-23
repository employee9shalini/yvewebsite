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

$app->get('/get_credit_cards_info/:param/:help',function(){
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
    $help_data["params"] = "user_email, user_pwd,user_phone";
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




$app->get('/update_profile_image/:param/:help',function(){
    $help_data["params"] = "JSON data";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/save_credit_card_info/:param/:help',function(){
    $help_data["params"] = "card_type,cardholder_name,card_number,expiry_date,cvv_number";
    echoResponse(SUCCESS,$help_data);
});


$app->get('/save_reviews/:param/:help',function(){
        $help_data["params"] = "coach_id,client_id,review,rating";
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
    $help_data["params"] = "coach_id,slot_id";
    echoResponse(SUCCESS,$help_data);

});

$app->get('/get_proposed_coaches/:param/:help',function(){
    $help_data["params"] = 'category_id,page_no';
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
    ["get_credit_cards_info"]["help_url"] = API_BASE_URL .
        "/get_credit_cards_info/param/help";

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
    ["save_credit_card_info"]["help_url"] = API_BASE_URL .
        "/save_credit_card_info/param/help";

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

$app->get('/get_all_coaches',function() use ($app) {
    //verify Required Params
    verifyRequiredParams(array('page_no','timezone'));
    $page_id = $app->request()->get('page_no');
    $timezone = $app->request()->get('timezone');
    $row_count      =   COACH_LIMIT;
    $db = new DbHandler();

    $res = $db->getAllCoaches($page_id,$row_count,$timezone);

    if($res){
        echoResponse(SUCCESS,$res);
    }
    else{
        echoStatus(NO_CONTENT);
    }
});

$app->get('/search_coaches',function() use ($app) {
    //verify Required Params
    verifyRequiredParams(array('page_no','timezone','search_text'));
    $page_no = $app->request()->get('page_no');
    $timezone = $app->request()->get('timezone');
    $search_text = $app->request()->get('search_text');
    $row_count      =   COACH_LIMIT;
    $db = new DbHandler();

    $res = $db->searchCoach($page_no,$row_count,$timezone,$search_text);

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


    $db = new DbHandler();


    if(!$db->isUserExists($user_email)){
        $res = $db->userSignUpViaEmail($user_email, $user_pwd,
            $user_phone);

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

        $mail_sent=$db->sendmail($user_email);

        echoStatus(SUCCESS);

    }
    else{

        echoStatus(NOT_FOUND);
        //echoStatus(FORBIDDEN);
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

$app->get('/get_proposed_coaches',function() use ($app){
    //verify Required Params

    verifyRequiredParams(array('category_id','page_no','timezone'));

    $page_no = $app->request()->get('page_no');
    $category_id = $app->request()->get('category_id');
    $timezone = $app->request()->get('timezone');
    $row_count=MY_COACH_LIMIT;

    $db = new DbHandler();

    $res = $db->getproposedcoaches($category_id,$page_no,$timezone,$row_count);

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

$app->get('/get_credit_cards_info','authenticate',function() use ($app) {
    //verify Required Params
    global $user_id;
    $db = new DbHandler();

    $res = $db-> getCreditCardInfo($user_id);

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
    verifyRequiredParams(array('page_no'));
    $page_no = $app->request()->get('page_no');
    $row_count      =   MY_COACH_LIMIT;
    $db = new DbHandler();


    $res = $db->getMyCoaches($page_no,$row_count,$user_id);

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



$app->post('/update_profile','authenticate',function()use($app){

    verifyRequiredParams(array('first_name','last_name','biography_text'));

    /* Reading Params*/
    $first_name = $app->request->post('first_name');
    $last_name     = $app->request->post('last_name');
    $biography_text     = $app->request->post('biography_text');

    global $user_id;
    $db = new DbHandler();

    $res = $db->updateProfile($user_id, $first_name, $last_name,$biography_text);

    if($res)
        echoStatus(SUCCESS);
    else
        echoStatus(REQUEST_ACCEPTED);


});

$app->post('/update_profile_image','authenticate',function()use($app){

    $json   = $app->request->getBody();

    //$jsondata=parse_str($json,$imgarr);
    $imgdata   = json_decode($json, true);

    foreach($imgdata ["img"] as $imagetext){

        $imagetext =  $imgdata["imagedata"];

    }



    //$ch = base64_decode($json);

    //header('Content-Type: image/png');

    //$filepath="http://yve.ibuildmart.in/images/temp.png";
//$myfile=fopen($filepath,"w") or die("unable to open file");
//file_put_contents($filepath,base64_decode($json));

    //$ch = curl_init('http://example.com/image.php');
    //$fp = fopen('http://yve.ibuildmart.in/images/coach/temp.png', 'wb');
    //curl_setopt($ch, CURLOPT_FILE, $fp);
    //curl_setopt($ch, CURLOPT_HEADER, 0);
    //curl_exec($ch);
    //curl_close($ch);
    //fclose($fp);
    echo $imgdata;


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

    verifyRequiredParams(array('coach_id','client_id','review','rating'));


    $coach_id = $app->request->post('coach_id');
    $client_id = $app->request->post('client_id');
    $review = $app->request->post('review');
    $rating = $app->request->post('rating');


    global $user_id;
    $db = new DbHandler();

    $res = $db-> saveReviews($coach_id,$client_id,$review,$rating);

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

    verifyRequiredParams(array('coach_id','slot_id'));

    /* Reading Params*/
    $coach_id = $app->request->post('coach_id');
    $slot_id = $app->request->post('slot_id');

    global $user_id;
    $db = new DbHandler();
    //$coach_id=$db->getCoachId($coach_email);

    $res = $db->makeAppointment($user_id, $coach_id,$slot_id);

      if($res)
        echoStatus(SUCCESS);
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