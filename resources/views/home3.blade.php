<?php
$uname='';
$uemail=Session::get('cemail');
$qblogin=Session::get('qblogin');
$qbpwd=Session::get('qbpwd');
$uid=Session::get('uid');
$qbdid=Session::get('qb_id');
$uname=Session::get('uname');
$pwd=substr(md5(uniqid(rand(1,6))), 0, 8);
if($uemail=='')
{
    header('Location:index.php');
}
else
{
    // $obj=new yveclass();
    //$obj1=new yveclass();
    //$uid=$obj->getuserid($uemail);
    //$udata=$obj1->getuserdata($uid);
    //$uarr=explode("#",$udata);
    //$uname=$uarr[0];

}

date_default_timezone_set('UTC');
//$timestamp = strtotime($sdt);
$tdate=  gmdate('D, M d Y H:i:s T', time());

//echo "http://$_SERVER[HTTP_HOST]";
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
    <link rel="stylesheet" href="css/common/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="css/common/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="css/common/plugins/fullcalendar/fullcalendar.print.css" media="print">
    <!-- Theme style -->

    <link rel="stylesheet" href="css/common/dist/css/Admin.css">
    <link rel="stylesheet" href="css/common/dist/css/common.css">
    <link rel="stylesheet" href="css/common/dist/css/templatemo_main.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="css/common/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="css/common/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="css/common/plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="css/common/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="css/common/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="css/common/plugins/select2/select2.min.css">

    <!--                          calendar                       -->


    <script src="css/common/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <link rel='stylesheet' type='text/css' href='css/common/libs/css/smoothness/jquery-ui-1.8rc3.custom.css' />
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript" src="js/bootstrap2.min.js"></script>
    <link href="css/bootstrap2.min.css" rel="stylesheet" type="text/css">

    <script type="text/javascript " src="js/bootstrap-multiselect.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <link href="css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/rating.js"></script>
    <link rel="stylesheet" href="css/rating.css" type="text/css" media="screen" title="Rating CSS">




    <script type="text/javascript">
        var jq=jQuery.noConflict();
        jq(document).ready(function(){
            jq("#ratingsection").click(function() {


                reviewdata=callajax(data, 'getreviewdata',false,'GET');
                if(reviewdata!='')
                {
                    $("#rating").html(reviewdata);

                }

                else {
                }

                jq('.container').rating();


            });




        });
    </script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header header-bg">
        <!-- Logo -->
        <a href="../index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img src="css/common/dist/img/logo.png" class="" alt="User Image"></span>
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
                            <img src="css/common/dist/img/fullsize.png">

                        </a>

                    </li>
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="css/common/dist/img/Messages.png">

                        </a>

                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="css/common/dist/img/notifications.png">
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
                <a class="logout" href="logout">logout</a>
                <div class="pull-left image">
                    <img src="images/default_profile.png" class="img-circle" alt="User Image" id="primg" style="height: 45px;width:45px;">
                </div>
                <div class="pull-left info">
                    <p id="uname"></p>

                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->

            <ul class="sidebar-menu">

                <li class="sidebar-border">
                    <a  style="border-bottom: 1px solid #fff" id="coachsection" class="coach-menu">
                        <span>Calendar</span>
                        <i class="fa fa-fw fa-angle-right calendarfinancial"></i>
                    </a>

                    <!--    <a style="border-bottom: 1px solid #fff;cursor: pointer" id="profilesection" class="coach-menu">
                            <span>Profile</span>
                            <i class="fa fa-fw fa-angle-right calendarfinancial" style="width:41px"></i>
                        </a>
-->
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
                <li class="trg">Calendar</li>
            </ol>
            <div class="row">
                <div class="col-md-9 coach-header">
                    <div class="content-bg coach-bg" style="padding-left: 14px;">
                        <h3 class="profile-coach">
                            Calendar
                        </h3>

                        <div id="hprofilesection" class="hsection">
                            <a class="coach-hmenu" id="pr"  style="margin-left: 2%">View Profile</a>

                            <a class="coach-hmenu" id="ratingsection" >Ratings & reviews</a>
                        </div>

                    </div>

                </div>
                <div class="col-md-2 coach-side">

                </div>
            </div>
        </section>

        <!-- Main content -->
        <div class="modal fade" id="income_call" tabindex="-1" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Call from <strong class="j-ic_initiator"></strong></h4>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default j-decline">Decline</button>
                        <button type="button" class="btn btn-primary j-accept">Accept</button>
                    </div>
                </div>
            </div>
        </div>

        <section class="content contentcoach" style="display: block" id="calendersection">

            <div class="row">

                <div class="col-md-9 col-sm-12 cldata">

                    <div class="box-body no-padding">
                        <div id='calendar'></div>
                    </div>

                </div><!-- /.col -->
                <div class="col-md-2 col-sm-12 sidespace">

                    <div class="form-group">

                    </div><!-- /.form group --></p>


                </div>



            </div><!-- /.row -->
        </section >

        <section class="content contentcoach"  id="videosection">
            <form>
                <div class="row">

                    <div class="col-md-9 col-sm-12 cldata">

                        <div class="box-body no-padding">

                            <div class="wrapper j-wrapper">


                                <aside class="msg_board" id="msg_board"></aside>

                                <main class="main j-main">
                                    <div class="fw-inner">


                                        <div class="pl j-pl hidden">
                                            <div class="clearfix">
                                                <aside class="caller">

                                                    <div class="caller__inner">
                                                        <p class="caller__name">
                                                            You
                                                        </p>

                                                        <div class="caller__action">
                                                            <video id="localVideo" class="fw-video">
                                                            </video>



                                                        </div>
                                                    </div>
                                                </aside>

                                                <div class="main_video">
                                                    <div class="main_video__timer hidden" id="timer">
                                                    </div>

                                                    <video id="main_video" class="j-main_video_vid main_video_vid fw-video">
                                                    </video>
                                                </div>
                                            </div>

                                            <div class="callees j-callees">
                                            </div>
                                        </div>
                                    </div>
                                </main>



                                <!-- SOUNDS -->
                                <audio id="callingSignal" loop preload="auto">
                                    <source src="audio/calling.ogg"></source>
                                    <source src="audio/calling.mp3"></source>
                                </audio>

                                <audio id="ringtoneSignal" loop preload="auto">
                                    <source src="audio/ringtone.ogg"></source>
                                    <source src="audio/ringtone.mp3"></source>
                                </audio>

                                <audio id="endCallSignal" preload="auto">
                                    <source src="audio/end_of_call.ogg"></source>
                                    <source src="audio/end_of_call.mp3"></source>
                                </audio>
                            </div>

                            <!-- MODALS -->
                            <div class="modal fade" id="error_no_calles" tabindex="-1">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Error</h4>
                                        </div>

                                        <div class="modal-body">
                                            <p class="text-danger">Please choose users to call</p>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- TEMPLATES -->
                            <script type="text/template" id="user_tpl">
                                <li class="users__item">
                                    <button class="users__user j-user" data-id="<%= id %>" data-login="<%= login %>" data-password="<%= password %>" data-name="<%= full_name %>">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="33" height="32" viewBox="0 0 33 32" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g transform="translate(-84.000000, -152.000000)" fill="#000000">
                                                    <g transform="translate(84.000000, 152.000000)">
                                                        <path fill="#<%=colour%>" d="M16.75 16C21.17 16 24.75 12.42 24.75 8 24.75 3.58 21.17 0 16.75 0 12.33 0 8.75 3.58 8.75 8 8.75 12.42 12.33 16 16.75 16L16.75 16ZM16.75 20C11.41 20 0.75 22.68 0.75 28L0.75 32 32.75 32 32.75 28C32.75 22.68 22.09 20 16.75 20L16.75 20Z" />
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>

                                        <p class="user__name"><%= full_name %></p>
                                        <i class="users__btn_unchecked"></i>
                                    </button>
                                </li>
                            </script>

                            <script type="text/template" id="accept_call">
                                <%  _.each(users, function(el, i, list) { %>
                                <% if(list.length === 1){ %>
                                <b><%= el.full_name %></b> has accepted the call
                                <% } else { %>
                                <% if( (i+1) === list.length) { %>
                                <b><%= el.full_name %></b> have accepted the call
                                <% } else { %>
                                <b><%= el.full_name %></b>,
                                <% } %>
                                <% } %>
                                <% }); %>
                            </script>


                            <script type="text/template" id="device_not_found">
                                Error: devices (camera or microphone) are not found.


                            </script>

                            <script type="text/template" id="callee_video">
                                <div class="callees__callee j-callee">
                                    <div class="callees__callee_inner">

                                        <video class="j-callees__callee_video callees__callee_video fw-video fw-video-wait" id="remote_video_<%=userID%>" data-user="<%=userID%>"></video>
                                    </div>


                                </div>
                            </script>

                            <script type="text/template" id="call_stop">
                                Call is stopped.&emsp;


                            </script>

                            <script type="text/template" id="p2p_call_stop">
                                <%=name%> has <%=reason%>. Call is stopped.&emsp;


                            </script>


                        </div>

                    </div><!-- /.col -->
                    <div class="col-md-2 col-sm-12 sidespace">


                    </div>



                </div><!-- /.row -->
            </form>
        </section>


    </div><!-- /.content-wrapper -->



    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->




<!-- jQuery 2.1.4 -->
<script src="css/common/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="css/common/bootstrap/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->

<!-- Slimscroll -->
<script src="css/common/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="css/common/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="css/common/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="css/common/dist/js/demo.js"></script>

<!-- fullCalendar 2.2.5 -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="css/common/plugins/fullcalendar/fullcalendar.min.js"></script>


<script src="css/common/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="css/common/plugins/input-mask/jquery.inputmask.js"></script>
<script src="css/common/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="css/common/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="css/common/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="css/common/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="css/common/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="css/common/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="css/common/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="css/common/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="css/common/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="css/common/dist/js/demo.js"></script>
<script type="text/javascript" src="js/custom.js"></script>

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
    var qblogin="<?php echo $qblogin ?>";
    var qbdid="<?php echo $qbdid?>";
    var uid = "<?php echo $uid ?>";
    var uname = "<?php echo $uname ?>";

</script>


<script src="js/modernizr.js"></script>
<link rel="stylesheet" href="css/style.css" />

<link rel="stylesheet" href="css/jquery-ui.css" />
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>


<script src="quickblox2/config.js"></script>
<script src="js/msgBoard.js"></script>
<script src="js/app.js"></script>
<script type="text/javascript" src="quickblox2/quickblox.min.js"></script>

<link rel="stylesheet" href="quickblox2/styles.css">

<link rel="stylesheet" href="libs/cssgram.min.css">


<script>
    $(function () {


        timezone = jstz.determine();
        var tz = timezone.name();


        data = {
            qemail: email,
            timezon:tz

        };


        eventarray = callajax(data, 'getslotsbyclient', false, 'GET');

        var qblogin = "<?php echo $qblogin ?>";

        var uid = "<?php echo $uid ?>";




        if (uname != '') {
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

                eventMouseover: function (calEvent, jsEvent, view) {
                    jsEvent.preventDefault();

                    // Go to and show day view for start date of clicked event

                    var booked_flag = calEvent.booked_flag;

                    // Popup with information of clicked event

                    if (booked_flag == '1') {



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


        $('.coach-menu').click(function () {
            $(".background2").css("display", "none")
            $(".loader").css("display", "none");
            var id = $(this).attr("id");
            $('.contentcoach').hide();
            $('.hsection').hide();
            var nid = "i" + id;
            var hid = "h" + id;
            $("#" + nid).show();
            $("#" + hid).show();
            var txt=$(this).children("span").html();
            $(".trg").html(txt);
        });





        $('#ratingsection').click(function () {


            $(".background2").css("display", "none")
            $(".loader").css("display", "none");
            $("#iprofilesection").hide();
            $("#iratingsection").show();
            $("#ieditsection").hide();

        });

        $('#pr').click(function () {


            $(".background2").css("display", "none")
            $(".loader").css("display", "none");
            $("#iprofilesection").show();
            $("#iratingsection").hide();
            $("#ieditsection").hide();

        });


        var coachcategories = callajax('', 'getcatlist', false, 'GET');

        var catarr = JSON.parse(coachcategories);
        var catlist = '';
        $.each($(catarr), function (key, value) {
            catlist = catlist + "<option value=" + value.category_id + ">" + value.category_name + "</option>";

        });

        $("#coach-category").html(catlist);


        var lang_list=callajax('', 'getlanglist',false,'GET');

        var langarr= JSON.parse(lang_list);
        var langlist='';

        $.each($(langarr),function(key,value){
            langlist=langlist+"<option value="+value.lang_id+">"+value.lang_text+"</option>";

        });

        $("#coach-lang").html(langlist);



        $("#saveprofile").click(function () {

            cid = 'coach-category';
            var vals = [];
            var textvals = '';

            $('#' + cid + ' :selected').each(function (i, selected) {

                textvals = textvals + $(selected).val();

                if (textvals != '') {
                    textvals = textvals + ',';
                }

            });

            var coachcategory = textvals;
            $("#cat").val(coachcategory);


            lid = 'coach-lang';
            var vals = [];
            var textvals = '';

            $('#' + lid + ' :selected').each(function (i, selected) {

                textvals = textvals + $(selected).text();

                if (textvals != '') {
                    textvals = textvals + ',';
                }

            });

            var lang_list = textvals;
            $("#lang_selected").val(lang_list);

            // $("#updatedata").attr("method", "post");
            // $("#updatedata").submit();


        });



        $('#updatedata').submit(function (e) {

            $(".background2").css("display", "none");
            $(".loader").css("display", "none");
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

                success: function (data) {

                    $(".background2").css({'display': 'none'});
                    $('.loader').css({'display': 'none'});

                    //If the request is successfull we will get the scripts output in data variable
                    //Showing the result in our html element

                    if (data == true) {
                        $('#msg').html("Your profile updated successfully");
                    }


                },
                error: function () {
                }
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
                timezone = jstz.determine();
                var tz = timezone.name();

                data = {

                    "email": email,
                    "sdt": sdt,
                    "edt": edt,
                    "timezone": tz
                };
                var createslot = callajax(data, 'createslot', false, 'GET');

                var r = createslot.split("$");
                var rarr0 = r[0].split("#");
                var st = rarr0[0];
                var et = rarr0[1];
                var rarr = r[0].split("#");
                var status = rarr[1];

                var slotid = rarr[0];
                var log = rarr[2];
                var logmsg = rarr[3];

                var t="true";



                if ($.trim(status) == t) {

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
                                booked_flag: '0'
                            },
                            true // make the event "stick"
                    );

                }

                if ($.trim(status) == 'false') {
                    $(".smsg").html(logmsg);
                }
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

            $("#iprofilesection").css("display", "none");
            $("#ieditsection").css("display", "block");

        });


        $('#uploaddata').submit(function (e) {
            $(".background2").css("display", "none");
            $(".loader").css("display", "none");
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

                success: function (data) {
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
                error: function () {
                }
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
        var data= {
            qemail: email

        };

        var profileimg=callajax(data, 'getprofileimg',false,'GET');

if(profileimg!='') {
    $("#primg").attr("src", profileimg);
}
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
            $("#imgmsg").html(msg);


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
    var profiledata='';
    var reviewdata='';

    var clientdata='';
    $(document).ready(function() {

        data= {
            qemail: email

        };


        $("#profilesection").click(function()
        {

            $('.profile-coach').html('Profile');

            data1= {
                qemail: email

            };

            profiledata=callajax(data1, 'getprofiledata',false,'GET');
            var result=profiledata;

            var arr = result.split("#");
            var fname = arr[0];
            var lname = arr[1];
            var catname = arr[2];
            var catid=arr[3];
            var contact = arr[4];
            var gender = arr[5];
            var dob = arr[6];
            var lang = arr[7];
            var about_info = arr[8];
            var profile_pic = arr[9];

            var userid = arr[10];
            var bankname = arr[11];
            var accountnumber = arr[12];
            var bic = arr[13];
            var langtext=arr[14];;
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
            $("#dob").html(dob);
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

            var jq4=jQuery.noConflict();

            jq4("#coach-category").multiselect("refresh");


            var dataarray2=langtext.split(",");
            $("#coach-lang").val(dataarray2);


            var jq5=jQuery.noConflict();

            jq5("#coach-lang").multiselect("refresh");

            $("#coach-gender").val(gender);
            $("#coach-dob").val(dob);

            $("#profile").val(about_info);

            $("#primg").attr("src", profile_pic);
            $("#coach-bankname").val(bankname);
            $("#coach-accnumber").val(accountnumber);
            $("#coach-bic").val(bic);


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
        var jq5=jQuery.noConflict();
        var progressbox     = $('#progressbox');
        var progressbar     = $('#progressbar');
        var statustxt       = $('#statustxt');

        var progressbox2     = $('#progressbox2');
        var progressbar2     = $('#progressbar2');
        var statustxt2      = $('#statustxt2');

        var submitbutton    = $("#savevideo");
        var myform          = $("#uploadvideo");
        var output          = $("#message");
        var completed       = '0%';
        var log='true';
        var submitbutton2=$("#updateimg");
        var myform2          = $("#updateimage");
        var output2          = $("#imgmsg");

        jq5(myform).ajaxForm({
            beforeSend: function() { //brfore sending form
                var size=jq5('#ivideo')[0].files[0].size;
                var type=jq5('#ivideo')[0].files[0].type;
                output.html('');
                submitbutton.attr('disabled', '');
                jq5('#ivideo').attr('disabled', 'disabled');
                jq5('#closepop').attr('disabled', 'disabled');
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
                jq5('#ivideo').attr('disabled', 'disabled');
                jq5('#closepop').attr('disabled', 'disabled');
            },
            complete: function(response) { // on complete
                var r=response.responseText;
                var r1= r.split("#");

                output.html(r1[0]);
                //update element with received data
                //myform.resetForm();  // reset form
                submitbutton.removeAttr('disabled'); //enable submit button
                progressbox.slideUp(); // hide progressbar
                jq5('#ivideo').removeAttr('disabled', 'disabled');
                jq5('#closepop').removeAttr('disabled', 'disabled');
            }
        });

        jq5(myform2).ajaxForm({
            beforeSend: function() { //brfore sending form

                output2.html('');
                submitbutton2.attr('disabled', '');
                jq5('#changeimg').attr('disabled', 'disabled');
                jq5('#closepop').attr('disabled', 'disabled');
                // disable upload button
                statustxt2.empty();
                progressbox2.slideDown(); //show progressbar
                progressbar2.width(completed); //initial value 0% of progressbar
                statustxt2.html(completed); //set status text
                statustxt2.css('color','#000'); //initial color of status text
            },
            uploadProgress: function(event, position, total, percentComplete) { //on progress
                progressbar2.width(percentComplete + '%') //update progressbar percent complete
                statustxt2.html(percentComplete + '%'); //update status text
                if(percentComplete>50)
                {
                    statustxt2.css('color','#fff'); //change status text to white after 50%
                }
                jq5('#changeimg').attr('disabled', 'disabled');
                jq5('#changeimg').attr('disabled', 'disabled');
            },
            complete: function(response) { // on complete
                var r=response.responseText;

                var r1= r.split("#");
                var imgsrc=r1[1];
                var msg=r1[0];


                //update element with received data

                //myform2.resetForm();  // reset form
                submitbutton2.removeAttr('disabled'); //enable submit button
                progressbox2.slideUp(); // hide progressbar
                jq5('#changeimg').removeAttr('disabled', 'disabled');
                jq5('#closepop').removeAttr('disabled', 'disabled');

                if(imgsrc!='') {
                    jq5("#profileimg").attr("src", imgsrc);
                    jq5("#primg").attr("src", imgsrc);
                    output2.html(msg);
                }

                else
                {
                    output2.html(msg);
                }


            }
        });


        $(document).on('click', '.showprofile', function(){

            var uid=$(this).attr("alt");

            $("#clientemail").val('');
            var data5={'userid':uid}
            var clientprofile=callajax(data5, 'getclientprofile',false,'GET');


            $("#iclientsection").css("display","none");
            $("#iclientprofilesection").css("display","block");
            $("#prclientfname").html('');
            $("#prclientlname").html('');
            $("#about").html('');
            $("#clientprofileimg").attr('src', 'images/default_profile.png');
            $("#timelineimg").attr('src', 'images/default_profile.png');
            $("#timelinetext").html('');
            $("#clientemail").val('');

            var arr = clientprofile.split("#");
            var fname = arr[0];
            var lname = arr[1];
            var contact = arr[2];
            var img = arr[3];
            var about_info = arr[4];
            var email = arr[5];

            var fname1 = fname.toUpperCase();
            var lname1 = lname.toUpperCase();
            var name = fname1 + " " + lname1;

            $("#prclientfname").html(fname);
            $("#prclientlname").html(lname);
            $("#about").html(about_info);
            $("#clientprofileimg").attr('src', img);
            $("#timelineimg").attr('src', img);
            $("#timelinetext").html(name);
            $("#clientemail").val(email);


        });
    });

</script>


<script type="text/javascript" src="js/popup.js"></script>

<script src="js/timeline.js"></script>

<script>
    var jq2=jQuery.noConflict();

    jq2(document).ready(

            /* This is the function that will get executed after the DOM is fully loaded */
            function () {
                jq2( "#coach-dob" ).datepicker({
                    changeMonth: true,//this option for allowing user to select month
                    changeYear: true, //this option for allowing user to select from year range
                    dateFormat: "mm/dd/yy",
                    yearRange: "1920:2005"
                });
            }

    );
</script>

</body>
</html>

