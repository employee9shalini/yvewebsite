<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
allaoau1526
15260500002417
*/

Route::get('/', function() {
return View("index");
});

Route::get('index', function() {
    return View("index");
});

Route::get('index3', function() {
    return View("index3");
});

Route::get('coach',  function() {
    return View("coach");
});

Route::get('coach5',  function() {
    return View("coach5");
});

Route::get('admin', function() {
    return View("admin");
});

Route::get('adminlogin', function() {
    return View("adminlogin");
});

Route::get('home', function() {
    return View("home");
});

Route::get('home2', function() {
    return View("home2");
});

Route::get('forgot', function() {
    return View("forgot");
});

Route::get('demo', function() {
    return View("demo");
});

Route::get('test', function() {
    return View("test");
});

Route::get('company', function() {
    return View("company");
});

Route::get('logout',  function() {
    Session::flush();
    return View("index");
});

Route::get('getcatlist','loaddatacontroller@getcatlist');

Route::get('getslottime','loaddatacontroller@getslottime');

Route::get('deleteslot', 'slotcontroller@deleteslot');

Route::get('getlanglist','loaddatacontroller@getlanglist');

Route::get('getallcoaches', 'loaddatacontroller@getallcoaches');

Route::get('getallcompanies', 'loaddatacontroller@getallcompanies');

Route::get('getallclientsbyadmin', 'loaddatacontroller@getallclientsbyadmin');

Route::get('getcompanyprofile', 'loaddatacontroller@getcompanyprofile');

Route::get('getallclients', 'loaddatacontroller@getallclients');

Route::get('getallcorpclients', 'loaddatacontroller@getallcorpclients');

Route::get('getslots', 'loaddatacontroller@getslots');

Route::get('getcorpclientprofile', 'loaddatacontroller@getcorpclientprofile');

Route::get('getslotsbyclient', 'loaddatacontroller@getslotsbyclient');

Route::get('getappointdata', 'loaddatacontroller@getappointdata');

Route::get('getcoaches', 'loaddatacontroller@getcoaches');

Route::get('getcompanies', 'loaddatacontroller@getcompanies');

Route::get('getclients', 'loaddatacontroller@getclients');

Route::get('getactivecoaches', 'loaddatacontroller@getactivecoaches');

Route::get('getinactivecoaches', 'loaddatacontroller@getinactivecoaches');

Route::get('getactiveclients', 'loaddatacontroller@getactiveclients');
Route::get('getactivecorpclients', 'loaddatacontroller@getactivecorpclients');

Route::get('getinactivecorpclients', 'loaddatacontroller@getinactivecorpclients');

Route::get('updatestartsession', 'slotcontroller@updatestartsession');

Route::get('updateendsession', 'slotcontroller@updateendsession');

Route::get('updatesessionnotes', 'slotcontroller@updatesessionnotes');

Route::get('createslot', 'slotcontroller@createslot');

Route::get('removeslot', 'slotcontroller@removeslot');

Route::get('updatesessionstatus', 'slotcontroller@updatesessionstatus');

Route::get('deletecoach', 'actionscontroller@deletecoach');

Route::get('deleteclient', 'loaddatacontroller@getallclientsbyadmin');

Route::get('getdclientdata', 'loaddatacontroller@getdclientdata');

Route::get('getcorpclientdata', 'loaddatacontroller@getcorpclientdata');

Route::get('activatecoach', 'actionscontroller@activatecoach');

Route::get('inactivatecoach', 'actionscontroller@inactivatecoach');

Route::get('getprofileimg', 'loaddatacontroller@getprofileimg');


Route::get('getprofiledata', 'loaddatacontroller@getprofiledata');

Route::get('getclientprofile', 'loaddatacontroller@getclientprofile');

Route::get('getcoachprofile', 'loaddatacontroller@getcoachprofile');

Route::get('getreviewdata', 'loaddatacontroller@getreviewdata');

Route::get('getclientreviewdata', 'loaddatacontroller@getclientreviewdata');

Route::get('getfinancedata', 'loaddatacontroller@getfinancedata');

Route::get('getallfinancedata', 'loaddatacontroller@getallfinancedata');

Route::get('getfinancedata2', 'loaddatacontroller@getfinancedata2');

Route::get('gettimelinedata', 'loaddatacontroller@gettimelinedata');

Route::get('gettimelinedata2', 'loaddatacontroller@gettimelinedata2');

Route::get('getcostpermonth', 'loaddatacontroller@getcostpermonth');

Route::get('getcostpermonth2', 'loaddatacontroller@getcostpermonth2');

Route::get('bindcorpclientname', 'loaddatacontroller@bindcorpclientname');

Route::get('bindcompanyname', 'loaddatacontroller@bindcompanyname');

Route::get('distributecredit', 'creditcontroller@distributecredit');

Route::get('distributecredit2', 'creditcontroller@distributecredit2');

Route::get('getcreditoverview', 'loaddatacontroller@getcreditoverview');

Route::get('getcreditoverview2', 'loaddatacontroller@getcreditoverview2');

Route::get('getfavcoaches', 'loaddatacontroller@getfavcoaches');

Route::get('signin', 'userscontroller@signin');
Route::get('fsignin', 'userscontroller@fsignin');
Route::get('tsignin', 'userscontroller@tsignin');
Route::get('signup', 'userscontroller@signup');
Route::get('adminlogout', 'userscontroller@adminlogout');

Route::get('sendmsg', 'userscontroller@sendmsg');


Route::get('chkemail', 'userscontroller@chkemail');

Route::get('logout', 'userscontroller@logout');

Route::get('adminsignin', 'userscontroller@adminsignin');

Route::get('fupdate', 'userscontroller@fupdate');

Route::get('tupdate', 'userscontroller@tupdate');

Route::get('reset', 'userscontroller@reset');

Route::get('sendmailfpwd', 'userscontroller@sendmailfpwd');

Route::get('updatecompanydata', 'userscontroller@updatecompanydata');

Route::get('updateclientdata', 'userscontroller@updateclientdata');

Route::post('uploadimgdata', 'userscontroller@uploadimgdata');

Route::post('uploadvideo', 'userscontroller@uploadvideo');

Route::post('uploadvideobyadmin', 'userscontroller@uploadvideobyadmin');

Route::post('uploadvideo2', 'userscontroller@uploadvideo2');

Route::post('uploaddata', 'userscontroller@uploaddata');

Route::post('uploaddata2', 'userscontroller@uploaddata2');

Route::post('uploaddata3', 'userscontroller@uploaddata3');

Route::post('uploadclientdata', 'userscontroller@uploadclientdata');

Route::post('updateimage', 'userscontroller@updateimage');

Route::post('insertmdata', 'userscontroller@insertmdata');

Route::post('updateclientimage', 'userscontroller@updateclientimage');

Route::post('updateimage2', 'userscontroller@updateimage2');

Route::post('updateimage3','userscontroller@updateimage3');

Route::post('updateimage4','userscontroller@updateimage4');

Route::post('updatedata', 'userscontroller@updatedata');

Route::post('updateclientdata', 'userscontroller@updateclientdata');

Route::post('updatedata2', 'userscontroller@updatedata2');

Route::post('charge', 'paymentcontroller@charge');

Route::get('deductpayment', 'paymentcontroller@deductpayment');

Route::get('qupdate', 'userscontroller@qupdate');

Route::get('getavailablecredits', 'loaddatacontroller@getavailablecredits');



Route::get('wittymessage', 'Wittymessage@wittymessagePage');

Route::post('usersfilter', 'Users@usersFilter');

//Route::get('article', 'Article@articlePage');

//Route::post('login', 'Login@loginPage');


