<?php
session_start();
ob_start();
include("connection.php");
include("yveclass.php");
$uname='';
$uemail=$_SESSION["uemail"];
$qblogin=$_SESSION["qblogin"];
$qbpwd=$_SESSION["qbpwd"];
$pwd=substr(md5(uniqid(rand(1,6))), 0, 8);
if($uemail=='')
{
    header('Location:index.php');
}
else
{
    $obj=new yveclass();
    $obj1=new yveclass();
    $uid=$obj->getuserid($uemail);
    $udata=$obj1->getuserdata($uid);
    $uarr=explode("#",$udata);
    $uname=$uarr[0];

}



date_default_timezone_set('UTC');
$timestamp = strtotime($sdt);
$tdate=  gmdate('D, M d Y H:i:s T', time());

$obj1=new yveclass();
$list=$obj1->getcatlist();


// Uses STRIPE_PUBLIC_KEY from the config file.
   // echo '<script type="text/javascript">Stripe.setPublishableKey("' . STRIPE_PUBLIC_KEY . '");</script>';


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>YVE</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="admin/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="admin/plugins/fullcalendar/fullcalendar.print.css" media="print">
    <!-- Theme style -->

    <link rel="stylesheet" href="admin/dist/css/Admin.css">
    <link rel="stylesheet" href="admin/dist/css/common.css">
    <link rel="stylesheet" href="admin/dist/css/templatemo_main.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="admin/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="admin/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="admin/plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="admin/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="admin/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="admin/plugins/select2/select2.min.css">

    <!--                          calendar                       -->
    <script src="admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>


    <link rel='stylesheet' type='text/css' href='admin/libs/css/smoothness/jquery-ui-1.8rc3.custom.css' />

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript" src="js/bootstrap2.min.js"></script>
    <link href="css/bootstrap2.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript " src="js/bootstrap-multiselect.js"></script>
    <link href="css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" >

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header header-bg">
        <!-- Logo -->
        <a href="../index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img src="admin/dist/img/logo.png" class="" alt="User Image"></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">

            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">

                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="admin/dist/img/fullsize.png">

                        </a>

                    </li>
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="admin/dist/img/Messages.png">

                        </a>

                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="admin/dist/img/notifications.png">
                        </a>

                    </li>


                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <a class="logout" href="logout.php">logout</a>
                <div class="pull-left image">
                    <img src="" class="img-circle" alt="User Image" id="primg" style="height: 45px;width:45px;">
                </div>
                <div class="pull-left info">
                    <p id="uname"></p>

                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->

            <ul class="sidebar-menu">

                <li class="sidebar-border">
                    <a href="coach.php" style="border-bottom: 1px solid #fff" id="coachsection" class="coach-menu">
                        <span>Calendar</span>
                        <i class="fa fa-fw fa-angle-right calendarfinancial"></i>
                    </a>
                    <a style="border-bottom: 1px solid #fff;cursor: pointer" id="profilesection" class="coach-menu">
                        <span>Profile</span>
                        <i class="fa fa-fw fa-angle-right calendarfinancial" style="width:41px"></i>
                    </a>

                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ol class="c-breadcrumb">
                <li><a class="home" href="#" style="color: white;">Home</a>
                    <i class="fa fa-fw fa-angle-right"></i>
                </li>
                <li class="trg">Coach</li>
            </ol>
            <div class="row">
                <div class="col-md-9 coach-header">
                    <div class="content-bg coach-bg" style="padding-left: 14px;width: 824px;">
                        <h3 class="profile-coach">
                            Coach Profile
                        </h3>

                        <div id="hprofilesection" class="hsection">
                        <a class="coach-hmenu" id="pr"  style="margin-left: 2%">View Profile</a>

                        <a class="coach-hmenu" id="rating" >Ratings & reviews</a>
                        </div>

                    </div>

                </div>
                <div class="col-md-2 coach-side">

                </div>
            </div>
        </section>

        <!-- Main content -->


        <section class="content contentcoach" style="display: block" id="calendersection">
            <div class="row">

                <div class="col-md-9 col-sm-12 cldata">

                    <div class="box-body no-padding">
                        <div id='calendar'></div>
                    </div>

                </div><!-- /.col -->
                <div class="col-md-2 col-sm-12 sidespace">

                    <div class="form-group">
                        <label class="book">Create Slot</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="reservationtime">
                        </div>
                        <input type="button" value="Save" id="schedulesave" style="padding: 5px; font-family: arial; font-size: 13px; margin-top: 20px; width:100px;background: #ac8f7b; border-color: #ac8f7b">
                        <!-- /.input group -->
                    </div><!-- /.form group --></p>

                    <p class="smsg" style="color:#fff; font-family: arial;font-size: 14px; margin-left: 2px;"></p>
                </div>



            </div><!-- /.row -->
        </section >



        <section class="content contentcoach"  id="ivideosection">
            <form  method="POST" id="payment-form">
                <div class="row">

                    <div class="col-md-9 col-sm-12 cldata">

                        <div class="box-body no-padding">

                            <div class="streams" style="margin-top: 30px;">

                                <table style="border:0px;position: absolute;top:0;right:20px">

                                    <tr>
                                        <td colspan="4"><span id="given_date"></span></td>

                                    </tr>
                                </table>
                                <div class="flip-counter clock" id="vtimer"></div>
                                <div class="remoteControls">

                                    <video id="remoteVideo"></video><br>
                                    <span id="calleeName"></span><br>
                                    <p class="smsg" id="vmsg" style="color:#fff; font-family: arial;font-size: 14px; margin-left: 2px;"></p>

                                </div>

                                <div class="localControls">

                                    <video id="localVideo"></video>

                                    <div class="controls" align="center">

                                        <button id="videocall" type="button" class="btn btn-default" style="float:none;margin-top: 5px">
                                            <img class="icon-videocall" src="quickblox/images/icon-videocall.png" >Video call
                                        </button>
                                        <button id="hangup" type="button" style="float:none; margin-top: 25px" class="btn btn-default" disabled  >
                                            <img class="icon-hangup" src="quickblox/images/icon-hangup.png" >Hangup
                                        </button>

                                        <button id="callend" type="button" class="btn btn-default" style="float:none; margin-top: 25px; width:114px"  >
                                            <img class="icon-callend" src="quickblox/images/done_icon.png" >Mark call<br/>as completed
                                        </button>
                                        <input type='text' name='tempuid' id="tempuid"  style="display: none" />
                                    </div>

                                </div>

                            </div>


                            <section id="incomingCall" class="incoming modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                        </div>
                                        <div class="modal-body">
                                            <div class="incoming-call-controls l-flexbox l-flexbox_flexcenter">
                                                <button id="reject" class="btn btn-default btn_decline">Decline</button>
                                                <button id="accept" class="btn btn-default btn_accept">Accept</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <audio id="callingSignal" loop>
                                <source src="audio/calling.ogg"></source>
                                <source src="audio/calling.mp3"></source>
                            </audio>

                            <audio id="ringtoneSignal" loop>
                                <source src="audio/ringtone.ogg"></source>
                                <source src="audio/ringtone.mp3"></source>
                            </audio>

                            <audio id="endCallSignal">
                                <source src="audio/end_of_call.ogg"></source>
                                <source src="audio/end_of_call.mp3"></source>
                            </audio>

                        </div>

                    </div><!-- /.col -->
                    <div class="col-md-2 col-sm-12 sidespace">
                        <div class="form-group" style="margin-top:10px;">
                            <label class="book">Make Notes</label>
                            <div class="input-group" style="display: block; width:99%">
                                <textarea class="form-control pull-right" id="notes" style="width:100%; height: 400px;max-height: 500px;max-width: :100%"></textarea>

                            </div>
                            <input type="button" value="Save" id="notessave" style="padding:2%;width:96%; font-family: arial; font-size: 13px; margin-top: 20px; width:100px;background: #ac8f7b; border-color: #ac8f7b">
                            <!-- /.input group -->
                        </div><!-- /.form group --></p>

                        <p id="nmsg" style="color:#fff; font-family: arial;font-size: 14px; margin-left: 2px;"></p>

                    </div>



                </div><!-- /.row -->

            </form>
        </section>

        <section class="content contentcoach"  id="ieditsection" style="margin-left: 20px;">
            <div class="background2" style="z-index: 999"></div>
            <div class="loader" ><img src="images/status.gif" border="0" style="top:68%;z-index:9999999"> </div>


            <div id="popup" class="popup" style="z-index: 999999">
                <form action="uploadvideo.php" method="post" name="uploadvideo" id="uploadvideo">
                    <div class="border">
                        <a id="closepop" class="closepop">x</a></div>
                    <div id="wrapper" class="wrapper1" align="center">

                        <p style="margin:20px"></p>
                        <span style=" font-size:24px;letter-spacing:1px;">Please choose video file to upload</span><p style="margin:10px"></p>

                        <p style="margin:20px"></p>
                        <div align="center">
                            <input type='file' name='ivideo' id="ivideo"  style="background-color: #BB8057"/>
                            <span>Mp4 format Video size 5 mb is allowed</span>
                            <input type="submit" id="savevideo" value="upload" style="background-color: #826048;">
                        </div>

                        <div align="center">
                            <div id="progressbox"><div id="progressbar"></div><div id="statustxt">0%</div></div>
                        </div>
                        <div id="message"></div>
                    </div>
                </form>
            </div>
                <div class="row">

                    <div class="col-md-9 col-sm-12 cldata">

                        <div class="box-body no-padding">
                            <form name="updatedata" id="updatedata"  method='post'  action="updatedata.php">
                                <div class="coach-div" align="center"  style="width: 90%">

                                    <div class="cldiv" align="left">
                                        <label>First Name</label></p>
                                        <input type="text" class="txt3" id="coach-fname" name="coach-fname">
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Last Name</label></p>
                                        <input type="text" class="txt3"  id="coach-lname" name="coach-lname">
                                    </div>


                                    <div class="cldiv" align="left">
                                        <label>Contact</label></p>
                                        <input type="text" class="txt3" id="coach-contact" name="coach-contact">
                                    </div>

                                    <div class="cldiv" align="left" style="height:81px;">
                                        <label >Category</label><p></p>
                                        <div id="catlabel"><select id="coach-category" name="coach-category" multiple="multiple"> </select></div>

                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Age</label></p>
                                        <input type="text" class="txt3" id="coach-age" name="coach-age">
                                    </div>
                                    <div class="cldiv" align="left">
                                        <label>Gender</label></p>
                                        <select class="txt3" id="coach-gender" name="coach-gender">
                                            <option value="-Select-">-Select-</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>


                                    <div class="cldiv" align="left">
                                        <label>Language</label></p>
                                        <input type="text" class="txt3" id="coach-lang" name="coach-lang">
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Profile Information</label></p>
                                        <textarea class="txt3" id="profile" style="resize:vertical; max-height: 200px" name="profile"></textarea>
                                    </div>


                                    <div class="cldiv" align="left">
                                        <label>Bank Name</label></p>
                                        <input type="text" class="txt3" id="coach-bankname" name="coach-bankname">

                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Bank Account Number</label></p>
                                        <input type="text" class="txt3" id="coach-accnumber" name="coach-accnumber">

                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>BIC</label></p>
                                        <input type="text" class="txt3" id="coach-bic" name="coach-bic">

                                    </div>

                                    <div class="cldiv" align="left" style="margin-top: 35px;height:80px">
                                        <input type="button" id="videopop" value="Upload Video">
                                    </div>


                                    <div class="cldiv" align="left" style="margin-top: 30px">
                                        <input type="button" id="saveprofile" value="Update Profile ">

                                    </div>

                                    <span id='msg' style="margin-top: 140px; color:#fff; font-size: 13px; float:none"></span>

                                    <input type="hidden" id="cat" name="cat">
                                </div>
                            </form>

                        </div>

                    </div><!-- /.col -->
                    <div class="col-md-2 col-sm-12 sidespace" style="height: 980px">
                        <div class="form-group" style="margin-top:10px;">

                    </div>



                </div><!-- /.row -->


        </section>

        <section class="content contentcoach"  id="iprofilesection">

            <div class="background2" style="z-index: 9999"></div>
            <div class="loader" style="top:48%;z-index:9999999"><img src="images/status.gif" border="0" > </div>
            <div id="popup2" class="popup" style="z-index: 999999; ">
                <form  method="post" name="updateimage" id="updateimage">
                    <div class="border">
                        <a id="closepop2" class="closepop">x</a></div>
                    <div id="wrapper" class="wrapper1" align="center">

                        <p style="margin:20px"></p>
                        <span style=" font-size:24px;letter-spacing:1px;">Please choose image file to upload</span><p style="margin:10px"></p>

                        <p style="margin:20px"></p>
                        <div align="center">
                            <input type='file' name='changeimg' id="changeimg"  style="background-color: #BB8057"/>
                            <span>Image size 1 mb is allowed</span>
                            <input type="submit" id="updateimg" value="update image" style="background-color: #826048;">
                            <span id="msg"></span>
                        </div>



                    </div>
                </form>
            </div>

                <div class="row">

                    <div class="col-md-9 col-sm-12 cldata">

                        <div class="box-body no-padding">

                            <div class="lprofile">
                                <div class="pull-left image" style="margin-top: 15px;margin-left:10px">
                                    <img src="" class="img-circle" alt="User Image" style="height: 120px;width:120px" id="profileimg">
                                    <div style="width:120px;  margin-top:10px;" align="center"><a id="ppchange" class="picchange">Change Picture</a></div>

                                </div>


                            </div>

                            <div class="mprofile">
                                <div><span class="prheader">Coach Profile</span></div>

                                <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">First Name:</span></div><div class="prtextdiv"><span id="prfname" class="prtxt"></span></div></div></p>
                                <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Last Name:</span></div><div class="prtextdiv"><span id="prlname" class="prtxt"></span></div></div></p>
                                <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Contact:</span></div><div class="prtextdiv"><span id="prmob" class="prtxt"></span></div></div></p>
                                <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Gender:</span></div><div class="prtextdiv"><span id="gender"  class="prtxt"></span></div></div></p>
                                <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Age:</span></div><div class="prtextdiv"><span id="age" class="prtxt"></span></div></div></p>
                                <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Language:</span></div><div class="prtextdiv"><span id="lang" class="prtxt"></span></div></div></p>
                                <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Profile Text:</span></div><div class="prtextdiv"><span id="about" class="prtxt"></span></div></div></p>
                                <div style="height: 20px;margin-bottom:20px"><div class="prlabeldiv"><span class="prlabel">Category:</span></div><div class="prtextdiv"><span id="catname"></span></div></div>

                                <div><span class="prheader" style="">Bank Account</span></div>
                                <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Bank Name:</span></div><div class="prtextdiv"><span id="bankname" class="prtxt"></span></div></div></p>
                                <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Accountnumber:</span></div><div class="prtextdiv"><span id="accno" class="prtxt"></span></div></div></p>
                                <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">BIC:</span></div><div class="prtextdiv"><span id="bic"></span></div></div>


                            </div>

                            <div class="rprofile"><a class="edit" style="cursor: pointer"><img src="images/edit.png" height="50px" width="50px"></a> </div>

                        </div>

                    </div><!-- /.col -->
                    <div class="col-md-2 col-sm-12 sidespace">
                        <div class="form-group" style="margin-top:10px;">

                        </div>



                    </div><!-- /.row -->


        </section>
        <!-- /.content -->
    </div><!-- /.content-wrapper -->




    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="admin/bootstrap/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->

<!-- Slimscroll -->
<script src="admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="admin/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="admin/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="admin/dist/js/demo.js"></script>

<!-- fullCalendar 2.2.5 -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="admin/plugins/fullcalendar/fullcalendar.min.js"></script>


<script src="admin/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="admin/plugins/input-mask/jquery.inputmask.js"></script>
<script src="admin/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="admin/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="admin/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="admin/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="admin/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="admin/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="admin/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="admin/dist/js/demo.js"></script>
<script type="text/javascript" src="js/jstz-1.0.4.min.js"></script>
<script type="text/javascript" src="js/validation.js"></script>
<!-- Page script -->
<script>
var eventarray=[];
var activeslot=0;
var clientid='';
var sdate;
var email="<?php echo $uemail?>";
var pwd="<?php echo $pwd?>";
var qbpwd="<?php echo $qbpwd?>";
</script>

<script type="text/javascript" src="quickblox/quickblox.min.js"></script>
<script type="text/javascript" src="quickblox/config.js"></script>
<script type="text/javascript" src="quickblox/main.js"></script>
<style type="text/css" href="quickblox/main.css"></style>



<script>






    $(function () {


        timezone =  jstz.determine();
        var tz=timezone.name();


        $.ajax({
            type: 'POST',
            url: 'getdata.php',
            async: false,
            data: {

                dtype: 'slots',
                qemail: email,
                timezon:tz

            },

            success: function (result) {
                eventarray = result;


            }
        });

        var qblogin="<?php echo $qblogin ?>";

        if(qblogin=='') {

            var a = qbsignup(email,pwd);


        }

        else
        {

            var b = qbsignin(qblogin,qbpwd);


        }

        var uname="<?php echo $uname ?>";

        if(uname!='')
        {
$("#uname").html(uname);
        }




        /* initialize the external events
         -----------------------------------------------------------------*/
        $(function () {

            /* initialize the external events
             -----------------------------------------------------------------*/
            function ini_events(ele) {
                ele.each(function () {

                    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    };

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject);

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                    });

                });
            }
            ini_events($('#external-events div.external-event'));

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date();
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                buttonText: {
                    today: 'today',
                    month: 'month',
                    week: 'week',
                    day: 'day'
                },
                //Random default events
                events: JSON.parse(eventarray),
                eventClick: function(calEvent, jsEvent, view) {
                    jsEvent.preventDefault();

                    // Go to and show day view for start date of clicked event
                    var slotid= calEvent.id;
                    var booked_flag= calEvent.booked_flag;
                    var client= calEvent.title;
                    var start_datetime= calEvent.start;
                    var end_datetime= calEvent.end;
                    var user_id=calEvent.user_id;
                    var qb_login=calEvent.qb_login;
                    var qb_id=calEvent.qb_id;
                    // Popup with information of clicked event

                    if(booked_flag=='1')
                    {

                        $("#calendersection").css("display","none");
                        $("#ivideosection").css("display","block");
activeslot=slotid;
                        clientid=user_id;
                        sdate=start_datetime;

                        chooserecipient(qb_id,qb_login);

                        setrtimer(slotid,start_datetime,end_datetime);




                    }


                },
                eventMouseover:function(calEvent, jsEvent, view) {
                    jsEvent.preventDefault();

                    // Go to and show day view for start date of clicked event

                    var booked_flag= calEvent.booked_flag;

                    // Popup with information of clicked event

                    if(booked_flag=='1')
                    {
                        $(this).css("cursor","pointer");



                    }


                },

                editable: false,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function (date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);

                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;
                    copiedEventObject.backgroundColor = $(this).css("background-color");
                    copiedEventObject.borderColor = $(this).css("border-color");

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }

                }
            });



            /* ADDING EVENTS */

        });


        $('.coach-menu').click(function()
        {
            $(".background2").css("display","none")
            $(".loader").css("display","none");
            var id=$(this).attr("id");
            $('.contentcoach').hide();
            $('.hsection').hide();
            var nid="i"+id;
            var hid="h"+id;
            $("#"+nid).show();
            $("#"+hid).show();
        });

        var list="<?php echo $list;?>";

        $("#coach-category").html(list);

        $("#saveprofile").click(function()
        {

            cid='coach-category';
            var vals = [];
            var textvals ='';

            $( '#' +cid + ' :selected' ).each( function( i, selected ) {

                textvals = textvals+$( selected ).val();

                if(textvals!='')
                {
                    textvals= textvals+',';
                }

            });

            var coachcategory=textvals;
            $("#cat").val(coachcategory);

                $("#updatedata").attr("method","post");
                $("#updatedata").submit();


        });

        $("#updateimg").click(function()
        {

                $("#updateimage").attr("method", "post");
                $("#updateimage").attr('action','updateimage.php');
                $("#updateimage").submit();


        });

        $('#updatedata').submit(function(e){
            $(".background2").css("display","none");
            $(".loader").css("display","none");
            e.preventDefault();

            //Creating an ajax method


            $.ajax({

                url: $(this).attr('action'),

                //For file upload we use post request
                type: "POST",

                //Creating data from form
                data: new FormData(this),

                //Setting these to false because we are sending a multipart request
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {

                    $(".background2").css({'display': 'block'});
                    $('.loader').css({'display': 'block'});

                },

                success: function(data){

                    $(".background2").css({'display': 'none'});
                    $('.loader').css({'display': 'none'});

                    //If the request is successfull we will get the scripts output in data variable
                    //Showing the result in our html element

                    if(data==true) {
                        $('#msg').html("Your profile updated successfully");
                    }



                },
                error: function(){}
            });
        });

        $("#schedulesave").click(function () {
            var val = $("#reservationtime").val();
            if (val == '') {

                $(".smsg").html('Please choose date and time');
            }
            else {
                $(".smsg").html('');
                var dt = val.split("-");
                var sdt = $.trim(dt[0]);
                var edt = $.trim(dt[1]);
                var email = "<?php echo $uemail?>";
                timezone =  jstz.determine();
               var tz=timezone.name();

                $.ajax({
                    type: 'POST',
                    url: 'createslot.php',
                    data: {

                        "email": email,
                        "sdt": sdt,
                        "edt": edt,
                        "timezone":tz
                    },
                    beforeSend: function () {


                        $(".background2").fadeIn("slow");
                        //$('#wait').css({'display': 'block'});
                    },
                    success: function (result) {
//alert(result);
                        var r=result.split("$");
                        var rarr0=r[0].split("#");
                        var st=rarr0[0];
                        var et=rarr0[1];
                        var rarr = r[0].split("#");
                        var status = rarr[1];
                        var slotid = rarr[0];
                        var log = rarr[2];
                        var logmsg = rarr[3];


                        if ($.trim(status) == 'true') {

                            $('#calendar').fullCalendar('renderEvent',
                                {
                                    id: slotid,
                                    start: sdt,
                                    end: edt,
                                    title: 't',
                                    allday: 'true',
                                    backgroundColor: '#ffffff',
                                    borderColor: '#AC8F7B',
                                    textColor: '#C3AE9F',
                                    booked_flag:'0'
                                },
                                true // make the event "stick"
                            );

                        }

                        if ($.trim(status) == 'false') {
                            $(".smsg").html(logmsg);
                        }
                    }
                });

            }


        });

        $("#notessave").click(function () {
            var val = $("#notes").val();

            if (val == '') {

                $("#nmsg").html('Please type notes');
            }
            else {
                $("#nmsg").html('');


                updatenotes(val);

            }


        });


        $(".edit").click(function () {

            $("#iprofilesection").css("display","none");
            $("#ieditsection").css("display","block");

        });




        $('#uploaddata').submit(function(e){
            $(".background2").css("display","none");
            $(".loader").css("display","none");
            e.preventDefault();

            //Creating an ajax method


            $.ajax({

                url: $(this).attr('action'),

                //For file upload we use post request
                type: "POST",

                //Creating data from form
                data: new FormData(this),

                //Setting these to false because we are sending a multipart request
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {

                    $(".background2").css({'display': 'block'});
                    $('.loader').css({'display': 'block'});

                },

                success: function(data){
                    //alert(data);
                    $(".background2").css({'display': 'none'});
                    $('.loader').css({'display': 'none'});

                    //If the request is successfull we will get the scripts output in data variable
                    //Showing the result in our html element
                    $('#msg').html(data);

                    $('#coach-fname').val("");
                    $('#coach-lname').val("");
                    $('#coach-email').val("");
                    $('#coach-pwd').val("");
                    $('#coach-contact').val("");
                    $('#coach-age').val('');
                    $('#coach-gender').val('');

                    $('#lang').val('');
                    $('#profile').val('');
                    $('#pimg').val('');
                    $('#bankname').val('');
                    $('#accnumber').val('');
                    $('#bic').val('');
                    $('.multiselect-selected-text').html("None Selected");

                },
                error: function(){}
            });
        });



    });
</script>



<script>

    $(function () {


        //Initialize Select2 Elem

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {

                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {

                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

            }
        );

        //iCheck for checkbox and radio inputs

        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        //Red color scheme for iCheck

        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });

        //Flat red color scheme for iCheck

        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
            showInputs: false
        });
    });

    function setrtimer(slotid,sdate,edate)
    {


        $('#given_date').countdowntimer({

            startDate : "<?php echo $tdate?>",
            dateAndTime : sdate,
            size : "sm"
        });


        if ($("#given_date").html()=="00:00:00:00") {

            //$("#given_date").hide();
        }

        else
        {
            //$("#given_date").show();
        }

    }

</script>


<script type="text/javascript">



    $(document).ready(function()
    {
        $.ajax({
            type: 'POST',
            url: 'getdata.php',
            async: false,
            data: {

                dtype: 'profiledata',
                qemail: email


            },

            success: function (result) {

                var arr = result.split("#");

                var profile_pic = arr[9];

                $("#primg").attr("src", profile_pic);


            }
        });





        $('#videopop').click(function()
        {
            $(".error").css("display","none");
            $(".background2").css("display","block");

            var id="popup";
            centerPopup(id);
            loadPopup(id);
            $('#statustxt').html('0%');
        });

        $('#ppchange').click(function()
        {

            $(".error").css("display","none");
            $(".background2").css("display","block");
            $("#popup2").css("display","block");
            var id="popup2";
            centerPopup(id);
            loadPopup(id);

        });

        /*Call function on time of Close popup box & background click */
        $("#closepop").click(function() {
            var id="popup";
            disablePopup(id);
            $(".background2").css("display","none");


        });


        $("#closepop2").click(function() {
            var id="popup2";
            disablePopup(id);
            $(".background2").css("display","none");


        });

        $('#updateimage').submit(function(e) {

            e.preventDefault();

            var val=$("#changeimg").val();

            if(val=='')
            {

            }
else
            {
                $.ajax({

                    //Getting the url of the uploadphp from action attr of form
                    //this means currently selected element which is our form
                    url: $(this).attr('action'),

                    //For file upload we use post request
                    type: "POST",

                    //Creating data from form
                    data: new FormData(this),

                    //Setting these to false because we are sending a multipart request
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('.loader').css({'display': 'block'});

                    },


                    success: function (data) {

                        var r=data.split("#");
                        var imgsrc=r[1];
                        var status=r[0];
                        var msg=r[2];

                        alert(status);

                        $('.loader').css({'display': 'none'});
if($.trim(status)==true) {

    $("#profileimg").attr("src", imgsrc);
    $("#primg").attr("src", imgsrc);
}


                        //If the request is successfull we will get the scripts output in data variable
                        //Showing the result in our html element


                    },
                    error: function () {
                    }
                });
            }
        });
    });

</script>



<script type="text/javascript" src="countdown/jquery.countdownTimer.js"></script>
<link rel="stylesheet" type="text/css" href="countdown/jquery.countdownTimer.css" />
<script type="text/javascript" src="countdown/flipclock.min.js"></script>
<link rel="stylesheet" type="text/css" href="countdown/flipclock.css" />

<script type="text/javascript" src="js/bootstrap2.min.js"></script>

<link href="css/bootstrap2.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" >
<script type="text/javascript " src="js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="js/jquery.form.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#coach-category').multiselect({
            includeSelectAllOption: true
        });
        $('#btnSelected').click(function () {
            var selected = $("#coach-category option:selected");
            var message = "";
            selected.each(function () {
                message += $(this).text() + " " + $(this).val() + "\n";
            });
            alert(message);
        });

        $("#profilesection").click(function()
        {
            $.ajax({
                type: 'POST',
                url: 'getdata.php',
                async: false,
                data: {

                    dtype: 'profiledata',
                    qemail: email


                },

                success: function (result) {

                    var arr = result.split("#");
                    var fname = arr[0];
                    var lname = arr[1];
                    var catname = arr[2];
var catid=arr[3];
                    var contact = arr[4];
                    var gender = arr[5];
                    var age = arr[6];
                    var lang = arr[7];
                    var about_info = arr[8];
                    var profile_pic = arr[9];
                    var prvideo = arr[10];
                    var userid = arr[11];
                    var bankname = arr[12];
                    var accountnumber = arr[13];
                    var bic = arr[14];
                    var g = '';
                    if (gender == 'F') {
                        gender = 'Female'
                    }
                    if (gender == 'M') {
                        gender = 'Male';
                    }



                    $("#prfname").html(fname);
                    $("#prlname").html(lname);
                    $("#catname").html(catname);
                    $("#prmob").html(contact);
                    $("#gender").html(gender);
                    $("#age").html(age);
                    $("#lang").html(lang);
                    $("#about").html(about_info);
                    $("#profileimg").attr("src", profile_pic);
                    $("#primg").attr("src", profile_pic);
                    $("#bankname").html(bankname);
                    $("#accno").html(accountnumber);
                    $("#bic").html(bic);


                    $("#coach-fname").val(fname);
                    $("#coach-lname").val(lname);
                    $("#coach-contact").val(contact);

                    var dataarray=catid.split(",");
                    $("#coach-category").val(dataarray);

                    $("#coach-category").multiselect("refresh");

                    $("#coach-gender").val(gender);
                    $("#coach-age").val(age);
                    $("#coach-lang").val(lang);
                    $("#profile").val(about_info);

                    $("#primg").attr("src", profile_pic);
                    $("#coach-bankname").val(bankname);
                    $("#coach-accnumber").val(accountnumber);
                    $("#coach-bic").val(bic);

                }
            });



        });
    });

</script>

<script>

    $(document).ready(function()
    {

        $('#videopop').click(function()
        {
            $(".error").css("display","none");
            $(".background2").css("display","block");
            $(".popup").css("display","block");
            var id="popup";
            centerPopup(id);
            loadPopup(id);
            $('#statustxt').html('0%');
        });

        /*Call function on time of Close popup box & background click */
        $("#closepop").click(function() {
            var id="popup2";
            disablePopup(id);
            $(".background2").css("display","none");


        });





        var progress = $(".loading-progress");



    });

</script>

<script>
    $(document).ready(function() {
        //elements
        var progressbox     = $('#progressbox');
        var progressbar     = $('#progressbar');
        var statustxt       = $('#statustxt');
        var submitbutton    = $("#savevideo");
        var myform          = $("#uploadvideo");
        var output          = $("#message");
        var completed       = '0%';
        var log='true';

        $(myform).ajaxForm({
            beforeSend: function() { //brfore sending form
                var size=$('#ivideo')[0].files[0].size;
                var type=$('#ivideo')[0].files[0].type;
                output.html('');
                submitbutton.attr('disabled', '');
                $('#ivideo').attr('disabled', 'disabled');
                $('#closepop').attr('disabled', 'disabled');
                // disable upload button
                statustxt.empty();
                progressbox.slideDown(); //show progressbar
                progressbar.width(completed); //initial value 0% of progressbar
                statustxt.html(completed); //set status text
                statustxt.css('color','#000'); //initial color of status text
            },
            uploadProgress: function(event, position, total, percentComplete) { //on progress
                progressbar.width(percentComplete + '%') //update progressbar percent complete
                statustxt.html(percentComplete + '%'); //update status text
                if(percentComplete>50)
                {
                    statustxt.css('color','#fff'); //change status text to white after 50%
                }
                $('#ivideo').attr('disabled', 'disabled');
                $('#closepop').attr('disabled', 'disabled');
            },
            complete: function(response) { // on complete
                output.html(response.responseText); //update element with received data
                myform.resetForm();  // reset form
                submitbutton.removeAttr('disabled'); //enable submit button
                progressbox.slideUp(); // hide progressbar
                $('#ivideo').removeAttr('disabled', 'disabled');
                $('#closepop').removeAttr('disabled', 'disabled');
            }
        });
    });

</script>
<script type="text/javascript" src="js/popup.js"></script>

</body>
</html>
