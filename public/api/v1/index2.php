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

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

// User id from db - Global Variable
$user_id = NULL;

/**
 * ------------------------------ Helping URLs -------------------------------------
 */



$app->get('/get_user_profile/:param/:help',function(){
	$help_data["params"] = "No param required";
	echoResponse(SUCCESS,$help_data);
});


$app->get('/update_last_sync_date/:param/:help',function(){
    $help_data["params"] = "No param required";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/get_all_categories/:param/:help',function(){
    $help_data["params"] = "No param required";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/get_client_profile_data/:param/:help',function(){
    $help_data["params"] = "No param required";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/get_all_coaches/:param/:help',function(){
    $help_data["params"] = "page_no";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/get_my_coaches/:param/:help',function(){
    $help_data["params"] = "page_no";
    echoResponse(SUCCESS,$help_data);
});




$app->get('/update_profile/:param/:help',function(){
    $help_data["params"] = "first_name, last_name,email,biography_text";
	echoResponse(SUCCESS,$help_data);
});


/***************************************************************************************/

$app->get('/get_favourite_coaches/:param/:help',function(){
    $help_data["params"] = "page_no";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/get_coach_reviews/:param/:help',function(){
    $help_data["params"] = "page_no";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/get_my_schedule/:param/:help',function(){
    $help_data["params"] = "No param required";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/get_timeline/:param/:help',function(){
    $help_data["params"] = "No param required";
    echoResponse(SUCCESS,$help_data);
});


$app->get('/make_appointment/:param/:help',function(){
    $help_data["params"] = "coach_email, start_datetime,end_datetime";
    echoResponse(SUCCESS,$help_data);

});


$app->get('/user_signup_via_phone/:param/:help',function(){
    $help_data["params"] = "user_email, user_pwd,user_phone";
    echoResponse(SUCCESS,$help_data);

});

$app->get('/user_signup_via_facebook/:param/:help',function(){
    $help_data["params"] = "user_full_name, user_email,device_type_id,user_phone, country_calling_code, country_short_code";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/user_signup_via_google/:param/:help',function(){
    $help_data["params"] = "user_full_name, user_email,device_type_id,user_phone, country_calling_code, country_short_code";
    echoResponse(SUCCESS,$help_data);
});

$app->get('/user_signin_via_phone/:param/:help',function(){
    $help_data["params"] = "user_email, user_pwd";
    echoResponse(SUCCESS,$help_data);

});

$app->get('/send_forgot_pwd_link/:param/:help',function(){
    $help_data["params"] = "user_email";
    echoResponse(SUCCESS,$help_data);

});

/**
 * **************************************************************************************
 */


/**
 * ----------- METHODS WITHOUT AUTHENTICATION ---------------------------------
 */

/* API URL Description */
$app->get('/',function(){
    /*...........................................GET WITH AUTHORIZATION REQUESTS.......................................................*/

    $result_data["yve"]["GET WITH AUTHORIZATION REQUESTS"]["get_my_schedule"]["help_url"] = API_BASE_URL . "/get_my_schedule/param/help";
    $result_data["yve"]["GET WITH AUTHORIZATION REQUESTS"]["get_timeline"]["help_url"] = API_BASE_URL . "/get_timeline/param/help";
    $result_data["yve"]["GET WITH AUTHORIZATION REQUESTS"]["get_client_profile_data"]["help_url"] = API_BASE_URL . "/get_client_profile_data/param/help";

    /*...........................................GET WITHOUT AUTHORIZATION REQUESTS.......................................................*/

    $result_data["YVE"]["GET WITHOUT AUTHORIZATION REQUESTS"]["get_all_categories"]["help_url"] = API_BASE_URL . "/get_all_categories/param/help";


    /*...........................................POST WITH AUTHORIZATION REQUESTS.......................................................*/

    $result_data["yve"]["POST WITH AUTHORIZATION REQUESTS"]["update_profile"]["help_url"] = API_BASE_URL . "/update_profile/param/help";
    $result_data["yve"]["POST WITH AUTHORIZATION REQUESTS"]["get_favourite_coaches"]["help_url"] = API_BASE_URL . "/get_favourite_coaches/param/help";
    $result_data["yve"]["POST WITH AUTHORIZATION REQUESTS"]["get_my_coaches"]["help_url"] = API_BASE_URL . "/get_my_coaches/param/help";
    $result_data["yve"]["POST WITH AUTHORIZATION REQUESTS"]["get_coach_reviews"]["help_url"] = API_BASE_URL . "/get_coach_reviews/param/help";
    $result_data["yve"]["POST WITH AUTHORIZATION REQUESTS"]["make_appointment"]["help_url"] = API_BASE_URL . "/make_appointment/param/help";

    /*...........................................POST WITHOUT AUTHORIZATION REQUESTS.......................................................*/


    $result_data["yve"]["POST WITHOUT AUTHORIZATION REQUESTS"]["get_all_coaches"]["help_url"] = API_BASE_URL . "/get_all_coaches/param/help";

    $result_data["yve"]["POST WITHOUT AUTHORIZATION REQUESTS"]["user_signup_via_phone"]["help_url"] = API_BASE_URL . "/user_signup_via_phone/param/help";
    $result_data["yve"]["POST WITHOUT AUTHORIZATION REQUESTS"]["user_signin_via_phone"]["help_url"] = API_BASE_URL . "/user_signin_via_phone/param/help";
    $result_data["yve"]["POST WITHOUT AUTHORIZATION REQUESTS"]["send_forgot_pwd_link"]["help_url"] = API_BASE_URL . "/send_forgot_pwd_link/param/help";

    echoResponse(200,$result_data);
});


$app->get('/get_all_categories',function() {
    //verify Required Params

    $db = new DbHandler();

    $res = $db->getAllCategories();

    if($res){
        echoResponse(SUCCESS,$res);
    }
    else{
        echoResponse(NO_CONTENT,$res);
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


$app->post('/get_all_coaches',function() use ($app) {
    //verify Required Params
    verifyRequiredParams(array('page_no'));
    $page_no = $app->request()->post('page_no');
    $row_count      =   COACH_LIMIT;
    $db = new DbHandler();

    $res = $db->getAllCoaches($page_no,$row_count);

    if($res){
        echoResponse($res[status],$res);
    }
    else{
        echoResponse($res[status],$res);
    }
});

$app->post('/get_my_coaches','authenticate',function()use($app){
    //verify Required Params
    global $user_id;
    verifyRequiredParams(array('page_no'));
    $page_no = $app->request()->post('page_no');
    $row_count      =   COACH_LIMIT;
    $db = new DbHandler();


    $res = $db->getMyCoaches($page_no,$row_count,$user_id);

    if($res){
        echoResponse($res[status],$res);
    }
    else{
        echoResponse($res[status],$res);
    }
});


$app->post('/user_signup_via_phone',function() use ($app){

    // check for required params
    verifyRequiredParams(array('user_email', 'user_pwd', 'user_phone'));

    // reading post params
    $user_email = $app->request()->post('user_email');
    $user_pwd = $app->request()->post('user_pwd');
    $user_phone = $app->request()->post('user_phone');


    $db = new DbHandler();


        if(!$db->isUserExists($user_email)){
            $res = $db->userSignUpViaPhone($user_email, $user_pwd, $user_phone);
            if($res["status"]!=REQUEST_ACCEPTED)
                echoResponse($res["status"],$res,$res["msg"]);
            else
                echoResponse($res["status"],$res["msg"]);


    }
    else{
        $res1["status"]=CONFLICT;
        $res1["msg"]="Email Already registered";

        echoResponse($res1["status"],$res1);
    }




});

$app->post('/user_signin_via_phone',function() use ($app) {

    // check for required params
    verifyRequiredParams(array('user_email', 'user_pwd'));

    // reading post params
    $user_email = $app->request()->post('user_email');
    $user_pwd = $app->request()->post('user_pwd');

    $db = new DbHandler();


    $res = $db->userSignInViaPhone($user_email, $user_pwd);

  if ($res["status"] != NOT_FOUND)
    {
       echoResponse($res["status"], $res,$res["msg"]);
}
   else
{
    echoResponse($res["status"], $res,$res["msg"]);
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

        echoResponse(SUCCESS,$mail_sent,$mail_sent["msg"]);

    }
    else{

echoResponse(NOT_FOUND,$res,$res["msg"]);
        //echoStatus(FORBIDDEN);
    }




});






/**
 * User Registration Via Facebook
 * url - /user_signup_via_facebook
 * method - POST
 * params - user_full_name, user_email,device_type_id,user_phone, country_calling_code, country_short_code
 */
$app->post('/user_signup_via_facebook', function() use ($app){
    // Check for the Required Params
    verifyRequiredParams(array('user_full_name','user_email','device_type_id','user_phone','country_calling_code','country_short_code'));

    // Reading Required params
    $user_full_name         = $app->request->post('user_full_name');
    $user_email             = $app->request->post('user_email');
    $user_phone             = $app->request->post('user_phone');
    $country_calling_code   = $app->request->post('country_calling_code');
    $country_short_code     = $app->request->post('country_short_code');
    $device_type_id         = $app->request->post('device_type_id');


    validateEmail($user_email);

    validateInteger($device_type_id);
    if (!($device_type_id == DEVICE_TYPE_iPhone_iPod || $device_type_id == DEVICE_TYPE_iPad || $device_type_id == DEVICE_TYPE_Android_Phone || $device_type_id == DEVICE_TYPE_Android_Tablet)){
        echoStatus(BAD_REQUEST);
        $app->stop();
    }

    $db = new DbHandler();

    if(!$db->isUserBlocked($user_email,AUTH_TYPE_FACEBOOK)){
	    $res = $db->userSignUpViaFacebook($user_full_name,$user_email,$user_phone,$device_type_id,$country_calling_code,$country_short_code);

	    if($res["status"]!=REQUEST_ACCEPTED)
		    echoResponse($res["status"],$res);
	    else
		    echoStatus($res["status"]);
    }
	else{
		echoStatus(FORBIDDEN);
	}
});


/**
 * User Registration Via Google
 * url - /user_signup_via_google
 * method - POST
 * params - user_full_name, user_email,device_type_id,user_phone, country_calling_code, country_short_code,
 */



/**
 * ------------------------ METHODS WITH AUTHENTICATION ------------------------
 */


$app->post('/get_favourite_coaches','authenticate',function() use ($app){
	global $user_id;

    verifyRequiredParams(array('page_no'));
    $row_count      =   COACH_LIMIT;
    // Reading Required params
    $page_id         = $app->request->post('page_no');

	$db     =   new DbHandler();
	$res    =   $db->getfavourite($user_id,$page_id,$row_count);

	if($res['status']==SUCCESS){
		echoResponse(SUCCESS,$res['response']);
	}
	else{
		echoStatus($res['status']);
	}
});



$app->post('/get_coach_reviews','authenticate',function() use ($app){
	global $user_id;

    verifyRequiredParams(array('page_no'));
    $row_count      =   COACH_LIMIT;
    // Reading Required params
    $page_id         = $app->request->post('page_no');

	$db     =   new DbHandler();
	$res    =   $db->getreviews($user_id,$page_id,$row_count);

	if($res["status"]==SUCCESS){
		echoResponse($res["status"],$res["response"]);
	}else{
		echoStatus($res["status"]);
	}
});

$app->get('/get_my_schedule','authenticate',function(){
    global $user_id;
    $db     =   new DbHandler();
    $res    =   $db->getschedule($user_id);

    if($res["status"]==SUCCESS){
        echoResponse($res["status"],$res["response"]);
    }else{
        echoStatus($res["status"]);
    }
});

$app->get('/get_timeline','authenticate',function(){
    global $user_id;
    $db     =   new DbHandler();
    $res    =   $db->gettimeline($user_id);

    if($res["status"]==SUCCESS){
        echoResponse($res["status"],$res["response"]);
    }else{
        echoStatus($res["status"]);
    }
});


/**
 * Sync App Data
 * url - /sync_app_data
 * method - POST
 */



/**
 * Mark message as read
 * url - /mark_as_read/:msg_id
 * method - GET
 * param - msg_id
 */


$app->post('/update_profile','authenticate',function()use($app){

    verifyRequiredParams(array('first_name','last_name','email','biography_text'));

    /* Reading Params*/
    $first_name = $app->request->post('first_name');
    $last_name     = $app->request->post('last_name');
    $email     = $app->request->post('email');
    $biography_text     = $app->request->post('biography_text');

   global $user_id;
   $db = new DbHandler();

   $res = $db->updateProfile($user_id, $first_name, $last_name,$email,$biography_text);

   //if($res)
       echoResponse($res["status"],$res);
  //else
        //echoStatus(REQUEST_ACCEPTED);


});

$app->post('/make_appointment','authenticate',function()use($app){

    verifyRequiredParams(array('coach_email','start_datetime','end_datetime','available_slot_id'));

    /* Reading Params*/
    $coach_email = $app->request->post('coach_email');
    $start    = $app->request->post('start_datetime');
    $end     = $app->request->post('end_datetime');
    $available_slot_id=$app->request->post('available_slot_id');

    global $user_id;
    $db = new DbHandler();

    $coach_id = $db->getCoachId($coach_email);

    $res = $db->makeAppointment($user_id, $coach_id, $start,$end,$available_slot_id);

    //if($res)
    echoResponse($res["status"],$res);
    //else
    //echoStatus(REQUEST_ACCEPTED);


});


$app->post('/add_to_favorite','authenticate', function() use ($app){
    //verify required parameter
    verifyRequiredParams(array('business_id'));

    //reading post param
    $business_id = $app->request()->post('business_id');

    global $user_id;
    $db = new DbHandler();

    if(!$db->isAlreadyInFavorite($business_id, $user_id)){
        $res = $db->addToFavorite($business_id, $user_id);
        if($res){
            echoStatus(SUCCESS);
        }
        else{
            echoStatus(REQUEST_ACCEPTED);
        }
    }else{
	    $res = $db->updateUserFavorite($business_id, $user_id);
	    if($res){
		    echoStatus(SUCCESS);
	    }
	    else{
		    echoStatus(REQUEST_ACCEPTED);
	    }

    }

});


/**
 * Remove Business From Favorite
 * url - /remove_from_favorite
 * method - POST
 * param business_id
 */
$app->post('/remove_from_favorite','authenticate', function() use ($app){
    //verify required parameter
    verifyRequiredParams(array('business_id'));

    //reading post param
    $business_id = $app->request()->post('business_id');

    global $user_id;
    $db = new DbHandler();

    $res = $db->removeFromFavorite($business_id,$user_id);
    if($res){
        echoStatus(SUCCESS);
    }
    else{
        echoStatus(REQUEST_ACCEPTED);
    }
});


/**
 * Get Business Rating & Review
 * url - /get_business_rating_and_review
 * method - POST
 * params - business_id,
 */
$app->post('/get_business_rating_and_review','authenticate',function() use ($app){
    //Verify Required Params
    verifyRequiredParams(array('business_id','time_zone'));

    //Reading Post Params
    $businessId =   $app->request->post('business_id');
	$timezone   =   $app->request->post('time_zone');
    global $user_id;

    $db = new DbHandler();
    $res    =   $db->getBusinessReviewAndRating($businessId,$user_id,$timezone);

    echoResponse(SUCCESS,$res);
});


/**
 * Get Inbox Message
 * url - /get_inbox_message
 * method - POST
 * param - page_no,time_zone
 */
$app->post('/get_inbox_message/', 'authenticate', function() use ($app){

    //verify required parameters
    verifyRequiredParams(array('page_no','time_zone'));

    //reading post params
    $page_no = $app->request()->post('page_no');
    $time_zone = $app->request()->post('time_zone');

    validateInteger($page_no);

    global $user_id;

    $db = new DbHandler();
    $row_count = MSG_LIMIT;

    $res = $db->getInboxMessage($user_id, $page_no, $row_count, $time_zone);
    if($res["status"]==SUCCESS){
        echoResponse($res["status"],$res["response"]);
    }
    else{
        echoStatus($res["status"]);
    }
});


/**
 * Delete Msg
 * url - /delete_msg/:msg_id
 * method - POST
 * param msg_id
 */
$app->post('/delete_msg','authenticate',function()use($app){
    //verify Required Params
	verifyRequiredParams(array('msg_id'));

	//Reading Post Param
	$msg_id =   $app->request->post('msg_id');

	validateInteger($msg_id);

    global $user_id;
    $db = new DbHandler();
    $res = $db->deleteMsg($user_id,$msg_id);

    if($res)
        echoStatus(SUCCESS);
    else
        echoStatus(REQUEST_ACCEPTED);
});


/**
 * Share App
 * url - /share_app
 * method - POST
 * params - social_network_id
 */
$app->post('/share_app','authenticate',function() use ($app){

	verifyRequiredParams(array('social_network_id'));
	$social_network_id  =   $app->request->post('social_network_id');

	validateInteger($social_network_id);

    if (!($social_network_id == SHARE_ON_FACEBOOK || $social_network_id == SHARE_ON_TWITTER || $social_network_id == SHARE_ON_EMAIL || $social_network_id == SHARE_ON_SMS || $social_network_id == SHARE_ON_WHATS_APP || $social_network_id == SHARE_ON_GOOGLE)){
        echoStatus(BAD_REQUEST);
        $app->stop();
    }

    global $user_id;

    $db = new DbHandler();
    $res = $db->shareApp($user_id,$social_network_id);

    if($res)
        echoStatus(SUCCESS);
    else
        echoStatus(REQUEST_ACCEPTED);
});


/**
 * Add User Feedback
 * url - /add_user_feedback
 * method - POST
 * param - user_feedback
 */
$app->post('/add_user_feedback','authenticate',function() use ($app){
    //Verify Required Params
    verifyRequiredParams(array('user_feedback'));

    //Reading POST param
    $user_feedback = $app->request->post('user_feedback');

    global $user_id;
    $db = new DbHandler();

    $res = $db->addUserFeedback($user_id, $user_feedback);

    if($res)
        echoStatus(SUCCESS);
    else
        echoStatus(REQUEST_ACCEPTED);

});


/**
 * Update user Location
 * url - /update_last_visit
 * method - post
 * param - latitude(optional),longitude(optional)
 */
$app->post('/update_last_visit', 'authenticate', function() use ($app){

    //verifyRequiredParams(array('latitude','longitude'));

    //reading post params
    $latitude = $app->request()->post('latitude');
    $longitude = $app->request()->post('longitude');

    if(!isset($latitude))
        $latitude = "NULL";

    if(!isset($longitude))
        $longitude = "NULL";

    global $user_id;
    $db = new DbHandler();

    //Update User Location
    $res = $db->updateUserLocation($user_id, $latitude, $longitude);

    if($res){
        echoStatus(SUCCESS);
    }
    else{
        echoStatus(REQUEST_ACCEPTED);
    }
});


/**
 * Track user Activity
 * url - /track_ser_activity
 * method - POST
 * params - category_id,business_id,event_type_id,event_data(optional),device_type_id,latitude(optional),longitude(optional)
 */
$app->post('/track_user_activity','authenticate',function() use ($app){
    //Verify Required Params
    verifyRequiredParams(array('category_id','business_id','event_type_id','device_type_id'));

    //Reading POST Params
    $category_id    = $app->request->post('category_id');
    $business_id    = $app->request->post('business_id');
    $event_type_id  = $app->request->post('event_type_id');
    $event_data     = $app->request->post('event_data');
    $device_type_id = $app->request->post('device_type_id');
    $latitude       = $app->request->post('latitude');
    $longitude      = $app->request->post('longitude');

    validateInteger($category_id);
    validateInteger($business_id);
    validateInteger($event_type_id);
    validateInteger($device_type_id);

    global $user_id;
    $db = new DbHandler();
    $res = $db->trackUserActivity($user_id, $category_id, $business_id, $event_type_id, $event_data, $device_type_id, $latitude, $longitude);

    if($res){
        echoStatus(SUCCESS);
    }
    else{
        echoStatus(REQUEST_ACCEPTED);
    }
});


/**
 * Post Business Review
 * url - /post_business_review
 * method - POST
 * param - business_id, user_review
 */
$app->post('/post_business_review','authenticate',function() use ($app){
   //Verifying Post Param
    verifyRequiredParams(array('business_id','user_review'));

    //Reading Post Param
    $business_id    =   $app->request->post('business_id');
    $user_review    =   $app->request->post('user_review');

    global $user_id;
    $db = new DbHandler();

    $res = $db->reviewBusiness($business_id,$user_review,$user_id);

    if($res){
        echoStatus(SUCCESS);
    }
    else{
        echoStatus(REQUEST_ACCEPTED);
    }


});


/**
 * Rate Business
 * url - /rate_business
 * method - POST
 * params - business_id, user_rating
 */
$app->post('/rate_business','authenticate',function() use ($app){
    //Verify Required Params
    verifyRequiredParams(array('business_id','user_rating'));

    //Reading POST Params
    $business_id    =   $app->request->post('business_id');
    $user_rating    =   $app->request->post('user_rating');

	if(($user_rating < 0) || ($user_rating >5)){
		echoStatus(BAD_REQUEST);
		$app->stop();
	}
    global $user_id;

    $db     =   new DbHandler();
    $res    =   $db->rateBusiness($business_id,$user_rating,$user_id);
    if($res){
        echoStatus(SUCCESS);
    }
    else{
        echoStatus(REQUEST_ACCEPTED);
    }

});


/**************************************************************************************************/

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
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
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
    if((!filter_var($mobile,FILTER_VALIDATE_INT)) && (strlen($mobile) < 8 && strlen($mobile) > 20) ){
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