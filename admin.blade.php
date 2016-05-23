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

    <!-- Theme style -->

    <link rel="stylesheet" href="css/common/dist/css/Admin.min.css">
    <link rel="stylesheet" href="css/common/dist/css/common.css">
    <link rel="stylesheet" href="css/common/dist/css/templatemo_main.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="css/common/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

      <script type="text/javascript" src="js/jquery.min.js"></script>

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header header-bg">
        <!-- Logo -->
        <a href="../index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->

          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg" style="margin-top: 5px;"><img src="images/logo.png" class="" alt="User Image"></span>
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
            <a class="logout" href="#">logout</a>
            <div class="pull-left image">
              <img src="css/common/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>YVE</p>
              <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
          </div>
         
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">

             <li class="sidebar-border">
              <a href="admin">
                <span>Coaches Overview</span>
                <i class="fa fa-fw fa-angle-right financial"></i>
                
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
            <li><a class="home" href="#">Admin</a>
              <i class="fa fa-fw fa-angle-right"></i>
            </li> 
            <li class="trg">Home</li>
          </ol>
          <div class="content-bg">
            <h3 class="profile-coach">
              Coaches Overview
            </h3>
              <a class="profile-act" id="addcoach"  style="margin-left: 2%">Add Coach</a>

              <a class="profile-act" id="deletecoach" >Delete Coach</a>
              <a class="profile-act" id="inactive" >Set Coach non-active</a>
              <a class="profile-act" id="monitor" >Monitor Changes</a>
          </div>
          
        </section>

        <!-- Main content -->
        <section class="content" style="padding: 0; padding-top: 20px;">

            @if(Session::has('message'))
                <div class="background2" style="z-index: 999;"></div>
                <div class="popup" style="display:block;z-index: 999999; left:30%">

                    <div class="border">
                        <a  class="closepop">x</a></div>
                    <div  class="wrapper1" align="center" style="margin-top: 10px">
                        <h6>{{ Session::get('message') }}</h6>

                    </div>
                </div>
            @endif


            <div class="background2" style="z-index: 999;"></div>
            <div class="loader" ><img src="images/status.gif" border="0" > </div>
            <div id="popup" class="popup" style="z-index: 999999">
                <form action="{{ url('uploadvideo') }}" method="post" name="uploadvideo" id="uploadvideo">
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
            
            <div class="col-md-12" style="padding: 0px">

                <div class="admin-content" align="center" id="iallcoach" style="display: block" >
                    <div class="coach-div" style="margin: 0">

                        <ul id="dcoach" align="center" style="margin: 0;width:100%">

                        </ul>


                    </div>


                </div>

                <div class="admin-content" align="center" id="icoachprofile" >

                    <div class="coach-div" style="margin: 0">

                        <ul id="dcoach" align="center" style="margin: 0;width:100%;padding: 0">

                        </ul>


                    </div>


                </div>

              <div class="admin-content" align="center" id="iaddcoach">

                                <h4 style="text-align: left; width:90%; color:#fff">
                                Join to us with your Coach Account</h4></p>

                  <form id='uploaddata'  method='POST' enctype='multipart/form-data' action="{{ url('uploaddata') }}">
                                <div class="coach-div" align="center"  style="width: 90%">

                                <div class="cldiv" align="left">
                                    <label>First Name*</label></p>
                                    <input type="text" class="txt3" id="coach-fname" name="coach-fname">
                                </div>

                                <div class="cldiv" align="left">
                                    <label>Last Name*</label></p>
                                    <input type="text" class="txt3"  id="coach-lname" name="coach-lname">
                                </div>

                                <div class="cldiv" align="left">
                                        <label>Email*</label></p>
                                        <input type="text" class="txt3" id="coach-email" name="coach-email">
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Password*</label></p>
                                        <input type="password" class="txt3" id="coach-pwd" name="coach-pwd">
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Contact*</label></p>
                                        <input type="text" class="txt3" id="coach-contact" name="coach-contact">
                                    </div>

                                    <div class="cldiv" align="left" style="height:81px;">
                                        <label >Category*</label><p></p>
                                        <div id="catlabel"><select id="coach-category" name="coach-category" multiple="multiple"> </select></div>

                                    </div>

                                    <div class="cldiv" align="left">
                                    <label>Age*</label></p>
                                        <input type="text" class="txt3" id="coach-age" name="coach-age">
                                    </div>
                                    <div class="cldiv" align="left">
                                        <label>Gender*</label></p>
                                        <select class="txt3" id="coach-gender" name="coach-gender">
                                            <option value="-Select-">-Select-</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>


                                    <div class="cldiv" align="left">
                                        <label>Language*</label></p>
                                        <input type="text" class="txt3" id="lang" name="lang">
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Profile Information*</label></p>
                                        <textarea class="txt3" id="profile" style="resize:vertical; max-height: 200px" name="profile"></textarea>
                                    </div>

                                    <div class="cldiv" align="left" style="height: 84px">
                                        <label>profile image*</label></p>

                                        <input type='file' name='photo' id="pimg" />
                                        <span style="color:#fff;">Image size is only 1 mb  allowed</span>
                                    </div>

                                    <div class="cldiv" align="left" style="margin-top:35px;height:80px">
                                        <input type="button" id="videopop" value="Upload Video">
                                    </div>


                                    <div class="cldiv" align="left">
                                        <label>Bank Name*</label></p>
                                        <input type="text" class="txt3" id="bankname" name="bankname">

                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Bank Account Number*</label></p>
                                        <input type="text" class="txt3" id="accnumber" name="accnumber">

                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>BIC*</label></p>
                                        <input type="text" class="txt3" id="bic" name="bic">

                                    </div>




                                    <div class="cldiv" align="left" style="margin-top: 30px">
                                        <input type="button" id="saveprofile" value="Sign Up">

                                    </div>

<input type="hidden" id="cat" name="cat">

                                    <input type="hidden" id="vid" name="vid">
                                </div>
</form>

                                </div>

                <div class="admin-content" align="center" id="ideletecoach" align="left" style="width: 82%">

                    <div class="coach-div" style="margin: 0">

                        <div class="tbldata" >
                        <table id="delete" class="table table-bordered table-striped">
                            <thead>
                            <tr class="tblheading">
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            </tbody>

                        </table>

                    </div>
                    </div>

                </div>

                <div class="admin-content" align="center" id="imonitor" align="left" style="width: 82%">

                    <div class="coach-div" style="margin: 0">

                        <div class="tbldata" >
                            <table id="activate" class="table table-bordered table-striped">
                                <thead>
                                <tr class="tblheading">
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>User Type</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                </tbody>

                            </table>

                        </div>
                    </div>

                </div>

                <div class="admin-content" align="center" id="iinactive" align="left" style="width: 82%">

                    <div class="coach-div" style="margin: 0">

                        <div class="tbldata" >
                            <table id="inactive" class="table table-bordered table-striped">
                                <thead>
                                <tr class="tblheading">
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>User Type</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                </tbody>

                            </table>

                        </div>
                    </div>

                </div>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      

      <!-- Control Sidebar -->
      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="css/common/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->

    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Slimscroll -->
    <script src="css/common/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="css/common/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="css/common/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="css/common/dist/js/demo.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="css/common/plugins/fullcalendar/fullcalendar.min.js"></script>
    <script type="text/javascript" src="js/validation.js"></script>
    <script type="text/javascript" src="js/bootstrap2.min.js"></script>
    <link href="css/bootstrap2.min.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" >
    <script type="text/javascript " src="js/bootstrap-multiselect.js"></script>
    <script type="text/javascript" src="js/jquery.form.min.js"></script>
    <!-- Page specific script -->

    <script type="text/javascript">
        var cont=true;


        $(document).ready(function(){

            var coachdata=callajax('', 'getallcoaches',false,'GET');

            $("#dcoach").html(coachdata);

            var coachcategories=callajax('', 'getcatlist',false,'GET');

            var catarr= JSON.parse(coachcategories);
            var catlist='';
            $.each($(catarr),function(key,value){
                catlist=catlist+"<option value="+value.category_id+">"+value.category_name+"</option>";

            });


            $("#coach-category").html(catlist);

            $("#monitor").click(function()
            {

                var inactiveuser=callajax('', 'getinactiveusers',false,'GET');


                        $('#activate tbody').html(inactiveuser);
            });

            $("#saveprofile").click(function()
            {

                temp = act('coach-fname', 'Please enter first name', 'blank');
                if (temp == true) { cont = false; }
                temp = act('coach-lname', 'Please enter last name', 'blank');
                if (temp == true) { cont = false; }
                temp = act('coach-email', 'Please enter email', 'E2');
                if (temp == true) { cont = false; }
                temp = act('coach-pwd', 'Please enter password', 'blank');
                if (temp == true) { cont = false; }
                temp = act('coach-contact', 'Please enter correct number', 'blank');
                if (temp == true) { cont = false; }

                temp = act('coach-category', 'Please select category', 'SE');
                if (temp == true) { cont = false; }

                temp = act('profile', 'Please enter profile text', 'blank');
                if (temp == true) { cont = false; }
                temp = act('coach-gender', 'Please select gender', 'SEL');
                if (temp == true) { cont = false; }
                temp = act('coach-age', 'Please enter age', 'K');
                if (temp == true) { cont = false; }
                temp = act('lang', 'Please enter language', 'blank');
                if (temp == true) { cont = false; }
                temp = act('pimg', 'Please choose image', 'blank');

                temp = act('bankname', 'Please enter bank name', 'blank');
                if (temp == true) { cont = false; }

                temp = act('accnumber', 'Please enter account number', 'blank');
                if (temp == true) { cont = false; }


                temp = act('bic', 'Please enter bic', 'blank');
                if (temp == true) { cont = false; }

                if(cont==true) {
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


                    $("#uploaddata").attr("method", "POST");
                    $("#uploaddata").submit();

                    $(".background2").css({'display': 'block'});
                    $('.loader').css({'display': 'block'});

                }

            });

            $("#deletecoach").click(function()
            {
                var dcoachdata=callajax('', 'getcoaches',false,'GET');

                $('#delete tbody').html(dcoachdata);


            });

            $("#inactive").click(function()
            {


                var activeuser=callajax('', 'getactiveusers',false,'GET');

                $('#inactive tbody').html(activeuser);
            });


            $('.profile-act').click(function()
            {
                var id=$(this).attr("id");
                $('.admin-content').hide();
                var nid="i"+id;

                $("#"+nid).show();

            });

            $('#dcoach li').click(function(){



                var html1='<h3 class="profile-coach">Coach Profile</h3><a class="profile-act" id="viewcoach" href="#coachprofile">Coach profile</a><a class="profile-act" href="#editcoach" id="editcoach">Edit coach profile</a>';

                $('.content-bg').html(html1);


            });

            $(document).on("click", "a.active", function(){

                var user_id=$(this).attr("alt");
                    var email_id=$(this).children().attr("alt");

                var $row = $(this).parent().parent();

                data={

                    "user_id": user_id,
                    "email_id":email_id


                };


                var a=callajax(data, 'activatecoach',false,'GET');

                $row.remove();

            });

            $(document).on("click", "a.delete", function(){

                var user_id=$(this).attr("alt");
                var email_id=$(this).children().attr("alt");
                data={

                    "user_id": user_id,
                            "email_id":email_id


                };

                var $row = $(this).parent().parent();

                var a=callajax(data, 'deletecoach',false,'GET');


                $row.remove();

            });

            $(document).on("click", "a.inactive", function(){

                var user_id=$(this).attr("alt");
                var email_id=$(this).children().attr("alt");

                var $row = $(this).parent().parent();

                data={

                    "user_id": user_id,
                    "email_id":email_id


                };


                var a=callajax(data, 'inactivatecoach',false,'GET');

                $row.remove();

            });

            $(window).bind('load', function()
            {

            });




        });

        $(function () {
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
        });

    </script>

    <script>

        $(document).ready(function()
        {

            $('#videopop').click(function()
            {

                var cont=true;
                temp = act('coach-fname', 'Please enter first name', 'blank');
                if (temp == true) { cont = false; }
                temp = act('coach-lname', 'Please enter last name', 'blank');
                if (temp == true) { cont = false; }
                temp = act('coach-email', 'Please enter email', 'E2');
                if (temp == true) { cont = false; }
                temp = act('coach-pwd', 'Please enter password', 'blank');
                if (temp == true) { cont = false; }
                temp = act('coach-contact', 'Please enter correct number', 'blank');
                if (temp == true) { cont = false; }

                temp = act('coach-category', 'Please select category', 'SE');
                if (temp == true) { cont = false; }

                temp = act('profile', 'Please enter profile text', 'blank');
                if (temp == true) { cont = false; }
                temp = act('coach-gender', 'Please select gender', 'SEL');
                if (temp == true) { cont = false; }
                temp = act('coach-age', 'Please enter age', 'K');
                if (temp == true) { cont = false; }
                temp = act('lang', 'Please enter language', 'blank');
                if (temp == true) { cont = false; }
                temp = act('pimg', 'Please choose image', 'blank');

                temp = act('bankname', 'Please enter bank name', 'blank');
                if (temp == true) { cont = false; }

                temp = act('accnumber', 'Please enter account number', 'blank');
                if (temp == true) { cont = false; }


                temp = act('bic', 'Please enter bic', 'blank');
                if (temp == true) { cont = false; }
                if(cont==true) {
                    $(".error").css("display", "none");
                    $(".background2").css("display", "block");

                    var id = "popup";
                    centerPopup(id);
                    loadPopup(id);
                    $('#statustxt').html('0%');
                }

                else
                {
                    alert('Please enter required info');
                }
            });

            /*Call function on time of Close popup box & background click */
            $(".closepop").click(function() {

                $('.popup').fadeOut("slow");
                $(".background2").css("display","none");

            });

        });

    </script>

    <script>
        $(document).ready(function() {

            var fval='';

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

                    fval=$("#ivideo").val();

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
                    var r=response.responseText;
                    var r1= r.split("#");

                    output.html(r1[0]); //update element with received data
                    myform.resetForm();  // reset form
                    submitbutton.removeAttr('disabled'); //enable submit button
                    progressbox.slideUp(); // hide progressbar

                    $('#ivideo').removeAttr('disabled', 'disabled');
                    $('#closepop').removeAttr('disabled', 'disabled');

                    fval=r1[1];
                    $("#vid").val(fval);
                }
            });
        });

    </script>
    <script type="text/javascript" src="js/popup.js"></script>


  </body>
</html>
