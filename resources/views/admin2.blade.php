<?php
session_start();
ob_start();
$uemail=Session::get('aemail');
if($uemail=='')
{
    header('Location:adminlogin');
}

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

      <link rel="stylesheet" href="css/jquery-ui.css" />
      <script src="js/jquery-1.9.1.js"></script>
      <script src="js/jquery-ui.js"></script>


      <script>
          var jq2=jQuery.noConflict();

          jq2(document).ready(

                  /* This is the function that will get executed after the DOM is fully loaded */
                  function () {
                      jq2( "#coach-dob" ).datepicker({
                          changeMonth: true,//this option for allowing user to select month
                          changeYear: true, //this option for allowing user to select from year range
                          dateFormat: "mm/dd/yy",
                          yearRange: "1970:2015"
                      });

                      jq2( "#coach-dob2" ).datepicker({
                          changeMonth: true,//this option for allowing user to select month
                          changeYear: true, //this option for allowing user to select from year range
                          dateFormat: "mm/dd/yy",
                          yearRange: "1970:2015"
                      });


                  }

          );
      </script>

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
            <a class="logout" href="adminlogout">logout</a>
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
              <a  class="admin-menu" id="allcoach" style="cursor:pointer">
                <span>Coaches Overview</span>
                <i class="fa fa-fw fa-angle-right financial" style="margin-left:94px;font-size:20px"></i>
              </a>

                 <a  class="admin-menu" id="appoint" style="cursor:pointer">
                     <span>Appointment Overview</span>
                     <i class="fa fa-fw fa-angle-right financial" style="margin-left:71px;font-size:20px;"></i>
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
            <li class="trg">Coaches Overview</li>
          </ol>
            <div class="col-md-9 coach-header">
          <div class="content-bg">
            <h3 class="htxt">
              Coaches Overview
            </h3>
              <div id="hallcoach" class="hsection">
              <a class="profile-act" id="addcoach"  style="margin-left: 2%">Add Coach</a>

              <a class="profile-act" id="deletecoach" >Delete Coach</a>
              <a class="profile-act" id="inactive" >Set Coach non-active</a>
              <a class="profile-act" id="monitor" >Monitor Changes</a>
                  </div>
          </div>
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
            <div class="loader"  style="top:80%"><img src="images/status.gif" border="0" > </div>
            <div id="popup" class="popup" style="z-index: 999999">
                <form action="{{ url('uploadvideobyadmin') }}" method="post" name="uploadvideo" id="uploadvideo">
                    <div class="border">
                        <a id="closepop" class="closepop">x</a></div>
                    <div id="wrapper" class="wrapper1" align="center">

                        <p style="margin:20px"></p>
                        <span style=" font-size:24px;letter-spacing:1px;">Please choose video file to upload</span><p style="margin:10px"></p>

                        <p style="margin:20px"></p>
                        <div align="center">
                            <input type='file' name='ivideo' id="ivideo"  style="background-color: #BB8057"/>
                            <span>Mp4 format Video size 100 mb is allowed</span>
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

                <div class="admin-content"  id="icoachprofile" >

                    <div class="coach-div" style="margin: 0">

                        <div class="background2" style="z-index: 9999"></div>
                        <div class="loader" style="top:48%;z-index:9999999"><img src="images/status.gif" border="0" > </div>
                        <div id="popup2" class="popup" style="z-index: 999999; ">
                            <form  method="post" name="updateimage2" id="updateimage2" action="{{ url('updateimage2') }}">
                                <div class="border">
                                    <a id="closepop2" class="closepop">x</a></div>
                                <div id="wrapper" class="wrapper1" align="center">

                                    <p style="margin:20px"></p>
                                    <span style=" font-size:24px;letter-spacing:1px;">Please choose image file to upload</span><p style="margin:10px"></p>

                                    <p style="margin:20px"></p>
                                    <div align="center">
                                        <input type='file' name='changeimg2' id="changeimg2"  style="background-color: #BB8057"/>
                                        <span>Image size 5 mb is allowed</span>
                                        <input type="submit" id="updateimg2" value="update image" style="background-color: #826048;">

                                    </div>

                                    <div align="center">
                                        <div id="progressbox3"><div id="progressbar3"></div><div id="statustxt3">0%</div></div>
                                    </div>

                                    <span id="imgmsg2"></span>
                                    <input type="hidden" name="coachemail2" id="coachemail2">
                                </div>
                            </form>

                        </div>

                        <div class="lprofile" style="margin-left: 60px">
                            <div class="pull-left image" style="margin-top: 15px;margin-left:10px">
                                <img src="images/default_profile.png" class="img-circle" alt="User Image" style="height: 120px;width:120px" id="profileimg">
                                <div style="width:120px;  margin-top:10px;" align="center"><a id="ppchange" class="picchange">Change Picture</a></div>

                            </div>


                        </div>

                        <div class="mprofile">
                            <div><span class="prheader">Coach Profile</span></div>

                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">First Name:</span></div><div class="prtextdiv"><span id="prfname" class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Last Name:</span></div><div class="prtextdiv"><span id="prlname" class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Contact:</span></div><div class="prtextdiv"><span id="prmob" class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Gender:</span></div><div class="prtextdiv"><span id="gender"  class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">DOB:</span></div><div class="prtextdiv"><span id="dob" class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Language:</span></div><div class="prtextdiv"><span id="lg" class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Profile Text:</span></div><div class="prtextdiv" style="width:261px"><span id="about" class="prtxt"></span></div></div></p>
                            <div style="height: 20px;margin-bottom:20px"><div class="prlabeldiv"><span class="prlabel">Category:</span></div><div class="prtextdiv" style="width:261px"><span id="catname"></span></div></div>

                            <div><span class="prheader" style="width:261px">Bank Account</span></div>
                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Bank Name:</span></div><div class="prtextdiv"><span id="bank" class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Accountnumber:</span></div><div class="prtextdiv"><span id="accno" class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">BIC:</span></div><div class="prtextdiv"><span id="bicno"></span></div></div>


                        </div>

                        <div class="rprofile"><a class="edit" style="cursor: pointer"><img src="images/edit_icon.png" height="50px" width="50px"></a> </div>



                    </div>


                </div>

                <div class="admin-content"  id="ieditprofile" >

                    <div class="background2" style="z-index: 999"></div>

                    <div id="vpopup" class="popup" style="z-index: 999999">
                        <form action="{{ url('uploadvideo2') }}" method="post" name="uploadvideo2" id="uploadvideo2">
                            <div class="border">
                                <a id="closepop3" class="closepop">x</a></div>
                            <div id="wrapper" class="wrapper1" align="center">

                                <p style="margin:20px"></p>
                                <span style=" font-size:24px;letter-spacing:1px;">Please choose video file to upload</span><p style="margin:10px"></p>

                                <p style="margin:20px"></p>
                                <div align="center">
                                    <input type='file' name='ivideo2' id="ivideo2"  style="background-color: #BB8057"/>
                                    <span>Mp4 format Video size 100 mb is allowed</span>
                                    <input type="submit" id="savevideo2" value="upload" style="background-color: #826048;">
                                </div>

                                <div align="center">
                                    <div id="progressbox4"><div id="progressbar4"></div><div id="statustxt4">0%</div></div>
                                </div>
                                <div id="message2"></div>
                            </div>

                            <input type="hidden" name="coachemail3" id="coachemail3">
                        </form>
                    </div>

                    <form name="updatedata" id="updatedata"  method='post'  action="{{ url('updatedata2') }}">
                    <div class="coach-div" style="margin-left:50px;width:92%">

                                    <div class="cldiv" align="left">
                                        <label>First Name</label></p>
                                        <input type="text" class="txt3" id="coach-fname2" name="coach-fname2">
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Last Name</label></p>
                                        <input type="text" class="txt3"  id="coach-lname2" name="coach-lname2">
                                    </div>


                                    <div class="cldiv" align="left">
                                        <label>Contact</label></p>
                                        <input type="text" class="txt3" id="coach-contact2" name="coach-contact2">
                                    </div>

                                    <div class="cldiv" align="left" style="height:81px;">
                                        <label >Category</label><p></p>
                                        <div id="catlabel"><select id="coach-category2" name="coach-category2" multiple="multiple"> </select></div>

                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>DOB</label></p>
                                        <input type="text" class="txt3" id="coach-dob2" name="coach-dob2">
                                    </div>
                                    <div class="cldiv" align="left">
                                        <label>Gender</label></p>
                                        <select class="txt3" id="coach-gender2" name="coach-gender2">
                                            <option value="-Select-">-Select-</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>


                                    <div class="cldiv" align="left">
                                        <label>Language</label></p>

                                        <div id="langlabel" style="width:100%"> <select id="coach-lang2" multiple="multiple" name="coach-lang2"> </select></div>

                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Profile Information</label></p>
                                        <textarea class="txt3" id="profile2" style="resize:vertical; max-height: 200px" name="profile2"></textarea>
                                    </div>


                                    <div class="cldiv" align="left">
                                        <label>Bank Name</label></p>
                                        <input type="text" class="txt3" id="coach-bankname2" name="coach-bankname2">

                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Bank Account Number</label></p>
                                        <input type="text" class="txt3" id="coach-accnumber2" name="coach-accnumber2">

                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>BIC</label></p>
                                        <input type="text" class="txt3" id="coach-bic2" name="coach-bic2">

                                    </div>

                                    <div class="cldiv" align="left" style="margin-top: 35px;height:80px">
                                        <input type="button" id="videopop2" value="Upload Video">
                                    </div>


                                    <div class="cldiv" align="left" style="margin-top: 30px">
                                        <input type="submit" id="saveprofile2" value="Update Profile ">

                                    </div>

                                    <span id='msg' style="margin-top: 140px; color:#fff; font-size: 13px; float:none"></span>

                                    <input type="hidden" id="cat2" name="cat2">

                                    <input type="hidden" id="lang_selected2" name="lang_selected2">
                        <input type="hidden" name="coachemail" id="coachemail">
                                </div>
                            </form>
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
                                    <label>DOB*</label></p>
                                        <input type="text" class="txt3" id="coach-dob" name="coach-dob">
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

                                        <div id="langlabel" style="width:100%"> <select id="lang" multiple="multiple" name="language"> </select></div>

                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Profile Information*</label></p>
                                        <textarea class="txt3" id="profile" style="resize:vertical; max-height: 200px" name="profile"></textarea>
                                    </div>

                                    <div class="cldiv" align="left" style="height: 84px">
                                        <label>profile image*</label></p>

                                        <input type='file' name='photo' id="pimg" />
                                        <span style="color:#fff;">Image size is only 5 mb  allowed</span>
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

                                    <input type="hidden" id="lang_selected" name="lang_selected">

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

                <div class="admin-content" align="center" id="iappoint" align="left" style="width: 82%">

                    <div class="coach-div" style="margin: 0">

                        <div id="appointdiv">

                            <table id="appointtab">
                                <thead>
                                <tr class="atabheading">
                                    <th>Session</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Coach</th>
                                    <th>Client</th>

                                </tr>
                                </thead>
                                <tbody>
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

            $("#coach-category2").html(catlist);

            var lang_list=callajax('', 'getlanglist',false,'GET');

            var langarr= JSON.parse(lang_list);
            var langlist='';

            $.each($(langarr),function(key,value){
                langlist=langlist+"<option value="+value.lang_id+">"+value.lang_text+"</option>";

            });

            $("#lang").html(langlist);
            $("#coach-lang2").html(langlist);

            $("#monitor").click(function()
            {

                var inactiveuser=callajax('', 'getinactiveusers',false,'GET');


                        $('#activate tbody').html(inactiveuser);
            });

            $(".edit").click(function () {

                $("#icoachprofile").css("display", "none");
                $("#ieditprofile").css("display", "block");

            });

            $("#allcoach").click(function () {

                var coachdata = callajax('', 'getallcoaches', false, 'GET');

                $("#dcoach").html(coachdata);

            });



            $("#appoint").click(function () {

                var appointdata = callajax('', 'getappointdata', false, 'GET');
                $("#appointtab tbody").html(appointdata);


                //$("#dcoach").html(coachdata);

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
                temp = act('coach-dob', 'Please enter birth date', 'D');
                if (temp == true) { cont = false; }
                temp = act('lang', 'Please  select language', 'SE');
                if (temp == true) { cont = false; }
                temp = act('pimg', 'Please choose image', 'blank');
                if (temp == true) { cont = false; }

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

                    lid = 'lang';
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


                    $("#uploaddata").attr("method", "POST");
                    $("#uploaddata").submit();

                    $(".background2").css({'display': 'block'});
                    $('.loader').css({'display': 'block'});

                }

            });


            $("#saveprofile2").click(function () {

                cid = 'coach-category2';
                var vals = [];
                var textvals = '';

                $('#' + cid + ' :selected').each(function (i, selected) {

                    textvals = textvals + $(selected).val();

                    if (textvals != '') {
                        textvals = textvals + ',';
                    }

                });

                var coachcategory2 = textvals;
                $("#cat2").val(coachcategory2);


                lid = 'coach-lang2';
                var vals = [];
                var textvals = '';

                $('#' + lid + ' :selected').each(function (i, selected) {

                    textvals = textvals + $(selected).text();

                    if (textvals != '') {
                        textvals = textvals + ',';
                    }

                });

                var lang_list2 = textvals;
                $("#lang_selected2").val(lang_list2);

                // $("#updatedata").attr("method", "post");
                // $("#updatedata").submit();


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


            $('.admin-menu').click(function () {
                $(".background2").css("display", "none")
                $(".loader").css("display", "none");
                var id = $(this).attr("id");
                $('.admin-content').hide();
                $('.hsection').hide();
                var nid = "i" + id;
                var hid = "h" + id;
                $("#" + nid).show();
                $("#" + hid).show();
                var txt=$(this).children("span").html();
                $(".htxt").html(txt);
                $(".trg").html(txt);
            });

            $(document).on('click', '.showprofile', function(){

                var eid=$(this).attr("alt");

                $("#coachemail").val('');
                $("#coachemail2").val('');
                $("#coachemail3").val('');
                var dat={'emailid':eid}

                $("#iallcoach").css("display","none");
                $("#icoachprofile").css("display","block");

                $("#prfname").html('');
                $("#prlname").html('');
                $("#catname").html('');
                $("#prmob").html('');
                $("#gender").html('');
                $("#dob").html('');
                $("#lg").html('');
                $("#about").html('');
                $("#profileimg").attr("src", 'images/default_profile.png');
                $("#primg").attr("src", 'images/default_profile.png');
                $("#bank").html('');
                $("#accno").html('');
                $("#bicno").html('');




                var coachprofile=callajax(dat, 'getcoachprofile',false,'GET');

//alert(coachprofile);
                var arr = coachprofile.split("#");
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
                $("#catname").html('');
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
                $("#lg").html(lang);
                $("#about").html(about_info);
                $("#profileimg").attr("src", profile_pic);
                $("#primg").attr("src", profile_pic);
                $("#bank").html(bankname);
                $("#accno").html(accountnumber);
                $("#bicno").html(bic);


                $("#coach-fname2").val(fname);
                $("#coach-lname2").val(lname);
                $("#coach-contact2").val(contact);

                var dataarray=catid.split(",");
                $("#coach-category2").val(dataarray);

                var jq4=jQuery.noConflict();

                jq4("#coach-category2").multiselect("refresh");


                var dataarray2=langtext.split(",");
                $("#coach-lang2").val(dataarray2);


                var jq5=jQuery.noConflict();

                jq5("#coach-lang2").multiselect("refresh");

                $("#coach-gender2").val(gender);
                $("#coach-dob2").val(dob);

                $("#profile2").val(about_info);

                $("#primg").attr("src", profile_pic);
                $("#coach-bankname2").val(bankname);
                $("#coach-accnumber2").val(accountnumber);
                $("#coach-bic2").val(bic);
                $("#coachemail").val(eid);
                $("#coachemail2").val(eid);
                $("#coachemail3").val(eid);

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




            $('#videopop2').click(function()
            {
                $(".error").css("display","none");
                $(".background2").css("display","block");

                var id="vpopup";
                centerPopup(id);
                loadPopup(id);
                $('#statustxt4').html('0%');
            });

            $('#ppchange').click(function()
            {

                $(".error").css("display","none");
                $(".background2").css("display","block");
                $("#popup2").css("display","block");
                var id="popup2";
                centerPopup(id);
                loadPopup(id);

                $('#statustxt3').html('0%');

            });

            /*Call function on time of Close popup box & background click */
            $("#closepop").click(function() {
                var id="popup";
                disablePopup(id);
                $(".background2").css("display","none");


            });


            $(".closepop").click(function() {
                var id="popup2";
                disablePopup();
                $(".background2").css("display","none");
               //$("#imgmsg").html(msg);


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

        $(function () {
            $('#lang').multiselect({
                includeSelectAllOption: true
            });
            $('#btnSelected').click(function () {
                var selected = $("#lang option:selected");
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
                temp = act('coach-dob', 'Please enter birth date', 'D');
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

            var submitbutton2=$("#updateimg");
            var myform2          = $("#updateimage");
            var output2          = $("#imgmsg");
            var progressbox2     = $('#progressbox2');
            var progressbar2     = $('#progressbar2');
            var statustxt2      = $('#statustxt2');

            var submitbutton3=$("#updateimg2");
            var myform3          = $("#updateimage2");
            var output3          = $("#imgmsg2");
            var progressbox3     = $('#progressbox3');
            var progressbar3     = $('#progressbar3');
            var statustxt3      = $('#statustxt3');

            var submitbutton4=$("#savevideo2");
            var myform4         = $("#uploadvideo2");
            var output4          = $("#message2");
            var progressbox4     = $('#progressbox4');
            var progressbar4     = $('#progressbar4');
            var statustxt4      = $('#statustxt4');

            var log='true';
            var jq5=jQuery.noConflict();
            jq5(myform).ajaxForm({
                beforeSend: function() { //brfore sending form
                    var size=jq5('#ivideo')[0].files[0].size;
                    var type=jq5('#ivideo')[0].files[0].type;

                    fval=jq5("#ivideo").val();

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

                    output.html(r1[0]); //update element with received data
                    myform.resetForm();  // reset form
                    submitbutton.removeAttr('disabled'); //enable submit button
                    progressbox.slideUp(); // hide progressbar

                    jq5('#ivideo').removeAttr('disabled', 'disabled');
                    jq5('#closepop').removeAttr('disabled', 'disabled');

                    fval=r1[1];
                    jq5("#vid").val(fval);
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

            jq5(myform3).ajaxForm({
                beforeSend: function() { //brfore sending form

                    output3.html('');
                    submitbutton3.attr('disabled', '');
                    jq5('#changeimg2').attr('disabled', 'disabled');
                    jq5('#closepop2').attr('disabled', 'disabled');
                    // disable upload button
                    statustxt3.empty();
                    progressbox3.slideDown(); //show progressbar
                    progressbar3.width(completed); //initial value 0% of progressbar
                    statustxt3.html(completed); //set status text
                    statustxt3.css('color','#000'); //initial color of status text
                },
                uploadProgress: function(event, position, total, percentComplete) { //on progress
                    progressbar3.width(percentComplete + '%') //update progressbar percent complete
                    statustxt3.html(percentComplete + '%'); //update status text
                    if(percentComplete>50)
                    {
                        statustxt3.css('color','#fff'); //change status text to white after 50%
                    }
                    jq5('#changeimg2').attr('disabled', 'disabled');
                    jq5('#changeimg2').attr('disabled', 'disabled');
                },
                complete: function(response) { // on complete

                    var r=response.responseText;
                    //alert(r);
                    var r1= r.split("#");
                    var imgsrc=r1[1];
                    var msg=r1[0];


                    //update element with received data

                    //myform2.resetForm();  // reset form
                    submitbutton3.removeAttr('disabled'); //enable submit button
                    progressbox3.slideUp(); // hide progressbar
                    jq5('#changeimg2').removeAttr('disabled', 'disabled');
                    jq5('#closepop2').removeAttr('disabled', 'disabled');

                    if(imgsrc!='') {
                        jq5("#profileimg").attr("src", imgsrc);

                        output3.html(msg);
                    }

                    else
                    {
                        output3.html(msg);
                    }


                }
            });

            jq5(myform4).ajaxForm({
                beforeSend: function() { //brfore sending form
                    var size=jq5('#ivideo2')[0].files[0].size;
                    var type=jq5('#ivideo2')[0].files[0].type;

                    fval=jq5("#ivideo2").val();

                    output.html('');
                    submitbutton4.attr('disabled', '');
                    jq5('#ivideo2').attr('disabled', 'disabled');
                    jq5('#closepop3').attr('disabled', 'disabled');
                    // disable upload button
                    statustxt4.empty();
                    progressbox4.slideDown(); //show progressbar
                    progressbar4.width(completed); //initial value 0% of progressbar
                    statustxt4.html(completed); //set status text
                    statustxt4.css('color','#000'); //initial color of status text
                },
                uploadProgress: function(event, position, total, percentComplete) { //on progress
                    progressbar4.width(percentComplete + '%') //update progressbar percent complete
                    statustxt4.html(percentComplete + '%'); //update status text
                    if(percentComplete>50)
                    {
                        statustxt4.css('color','#fff'); //change status text to white after 50%
                    }
                    jq5('#ivideo2').attr('disabled', 'disabled');
                    jq5('#closepop3').attr('disabled', 'disabled');
                },
                complete: function(response) { // on complete
                    var r=response.responseText;
                    var r1= r.split("#");

                    output4.html(r1[0]); //update element with received data
                    myform4.resetForm();  // reset form
                    submitbutton4.removeAttr('disabled'); //enable submit button
                    progressbox4.slideUp(); // hide progressbar

                    jq5('#ivideo2').removeAttr('disabled', 'disabled');
                    jq5('#closepop3').removeAttr('disabled', 'disabled');

                    fval=r1[1];
                    jq5("#vid").val(fval);
                }
            });

        });

    </script>
    <script type="text/javascript" src="js/popup.js"></script>


  </body>
</html>
