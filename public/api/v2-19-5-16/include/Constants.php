<?php
/**
 * Created by PhpStorm.
 * User: Narendra
 * Date: 3/25/2015
 * Time: 3:47 PM
 */

/**
 * Constants for the Base path
 */
define("HOST_BASE_URL", strtolower(stristr($_SERVER["SERVER_PROTOCOL"], "/", true)) . "://" . $_SERVER["HTTP_HOST"] ."/");
define("API_BASE_URL", strtolower(stristr($_SERVER["SERVER_PROTOCOL"], "/", true)) . "://" . $_SERVER["HTTP_HOST"] ."/api/v2");
define("IMAGE_BASE_URL", strtolower(stristr($_SERVER["SERVER_PROTOCOL"], "/", true)) . "://" . $_SERVER["HTTP_HOST"] ."/data/icon/");


/**
 * Set the response code
 */
define("SUCCESS","200");
define("RECORD_CREATED","201");
define("REQUEST_ACCEPTED","202");
define("NO_CONTENT","204");
define("PARTIAL_CONTENT","206");
define("BAD_REQUEST","400");
define("UNAUTHORIZED","401");
define("FORBIDDEN","403");
define("NOT_FOUND", "404");
define("METHOD_NOT_ALLOWED","405");
define("CONFLICT","409");
define("PAYMENT_REQUIRED","402");



/**
 * AUTHENTICATION TYPE CONSTANTS
 */
define("AUTH_TYPE_EMAIL","1");
define('AUTH_TYPE_PHONE','2');
define('AUTH_TYPE_FACEBOOK','3');
define('AUTH_TYPE_GOOGLE','4');
define('AUTH_TYPE_GUEST','9');



/**
 * Current App Version
 */
define('DEVELOPMENT_CURRENT_IOS_VERSION','2.0.001');
define('DEVELOPMENT_CURRENT_ANDROID_VERSION','2.0.001');
define('PRODUCTION_CURRENT_IOS_VERSION','2.0.001');
define('PRODUCTION_CURRENT_ANDROID_VERSION','2.0.001');


/**
 * Show Message per API Call
 */
define('MSG_LIMIT',10);


/**
 * Show Coach per API Call
 */
define('COACH_LIMIT',40);

/**
 * Show favourite Coach per API Call
 */
define('FAVOURITE_COACH_LIMIT',40);

/**
 * Show My Coach per API Call
 */
define('MY_COACH_LIMIT',40);

/* Show Review per API Call
*/
define('REVIEW_LIMIT',40);

/* Show timeline per API Call
*/
define('TIMELINE_LIMIT',10);

/* Set Credit value
*/
define('CREDIT_VALUE',10);
