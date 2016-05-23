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
                          yearRange: "1920:2005"
                      });

                      jq2( "#coach-dob2" ).datepicker({
                          changeMonth: true,//this option for allowing user to select month
                          changeYear: true, //this option for allowing user to select from year range
                          dateFormat: "mm/dd/yy",
                          yearRange: "1920:2005"
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
            <div class="pull-left image" >
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
             </li>

              <li class="sidebar-border">
                 <a  class="admin-menu" id="appoint" style="cursor:pointer">
                     <span>Appointment Overview</span>
                     <i class="fa fa-fw fa-angle-right financial" style="margin-left:71px;font-size:20px;"></i>
                 </a>

            </li>

              <li class="sidebar-border">
                  <a  class="admin-menu" id="allclient" style="cursor:pointer">
                      <span>Client Overview</span>
                      <i class="fa fa-fw fa-angle-right financial" style="margin-left:104px;font-size:20px;"></i>
                  </a>

              </li>


              <li class="sidebar-border">
                  <a  class="admin-menu" id="allcompany" style="cursor:pointer">
                      <span>Company Accounts</span>
                      <i class="fa fa-fw fa-angle-right financial" style="margin-left:85px;font-size:20px;"></i>
                  </a>

              </li>

              <li class="sidebar-border">
                  <a  class="admin-menu" id="financialoverview" style="cursor:pointer">
                      <span>Financial Overview</span>
                      <i class="fa fa-fw fa-angle-right financial" style="margin-left:86px;font-size:20px;"></i>
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

            <div class="row">
            <div class="col-md-9 coach-header" >
          <div class="content-bg" style="width:100%;padding-left: 14px;margin-left:0">
            <h3 class="htxt">
              Coaches Overview
            </h3>

              <div id="hallcoach" class="hsection" style="display: block;">
              <a class="profile-act" id="addcoach"  style="margin-left: 2%">Add Coach</a>

              <a class="profile-act" id="deletecoach" >Delete Coach</a>
              <a class="profile-act" id="inactive" >Set Coach non-active</a>
              <a class="profile-act" id="monitor" >Monitor Changes</a>
                  </div>

              <div id="hallclient" class="hsection">
                  <a class="profile-act" id="deleteclient"  style="margin-left: 2%">Delete Client</a>
                  <a class="profile-act" id="inactiveclient" >Set Client non-active</a>

              </div>

              <div id="hallcompany" class="hsection">
                  <a class="profile-act" id="addcompany"  style="margin-left: 2%">Add Company account</a>

                  <a class="profile-act" id="creditoverview"  style="margin-left: 2%">Credits</a>

                  <a class="profile-act" id="deletecompany"  style="margin-left: 2%">Delete Company account</a>


              </div>

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

                <div class="admin-content" align="center" id="iallcoach" style="display: block" align="center">
                    <div class="coach-div" style="margin: 0" >

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
                            <div style="height: 20px;margin-bottom:20px"><div class="prlabeldiv"><span class="prlabel">Level:</span></div><div class="prtextdiv" style="width:261px"><span id="coachlevel"></span></div></div>

							<?php //echo $uemail;?>
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
                            <label>Level*</label></p>
                            <input type="number" class="txt3" id="coach-level2" name="coach-level2">
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
                                Join us with your Coach Account</h4></p>

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
                                        <label>Telephone Number*</label></p>
                                        <input type="text" class="txt3" id="coach-contact" name="coach-contact">
                                    </div>

                                    <div class="cldiv" align="left" style="height:93px;">
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
                                        <label>Level*</label></p>
                                        <input type="number" class="txt3" id="level" name="level">
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


                <div class="admin-content" align="center" id="icreditoverview" align="left" >

                    <div class="coach-div" style="margin: 0">


                        <div class="tbldata" >

                            <div align="right"><input type="button" value="Supply credits" id="supply"></div>

                            <table id="allcredits" class="table table-bordered table-striped">
                                <thead>
                                <tr class="tblheading">
                                    <th>Company Name</th>
                                    <th>Distributed Credits</th>
                                    <th>Available credits</th>
                                    <th>Date</th>

                                </tr>
                                </thead>
                                <tbody>
                                </tbody>

                            </table>

                        </div>
                    </div>

                </div>

                <div class="admin-content" align="center" id="idistcredit" align="left" >

                    <div class="coach-div" style="width: 90%">

                        <div class="cldiv" align="left">
                            <label>Company Name*</label></p>
                            <select class="txt3" id="compname" name="compname">

                            </select>
                        </div>

                        <div class="cldiv" align="left">
                            <label>Credit qty*</label></p>
                            <input type="text" class="txt3" id="creditqty" name="creditqty" >
                        </div>


                        <div class="cldiv" align="left" style="margin-bottom: 50px">
                            <input type="button" id="save" value="save">
                            <p id="nmsg" style="color:#fff; font-family: arial;font-size: 13px; margin-left: 2px;letter-spacing: 1px"></p>
                        </div>


                        <input type="hidden" id="companyemail"  name="companyemail"/>

                    </div>

                </div>

                               <div class="admin-content" align="center" id="ideletecoach" align="left" >

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

                <div class="admin-content" align="center" id="imonitor" align="left" >

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

                <div class="admin-content" align="center" id="iinactive" align="left" >

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

                <div class="admin-content" align="center" id="iappoint" align="left" >

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

                <div class="admin-content" align="center" id="iallclient" style="display: block" align="center">
                    <div class="coach-div" style="margin: 0" >

                        <ul id="dclient" align="center" style="margin: 0;width:100%">

                        </ul>


                    </div>


                </div>

                <div class="admin-content"  id="iclientprofile" style="margin-left: 60px">

                    <div class="coach-div" style="margin: 0">

                        <div class="background2" style="z-index: 9999"></div>
                        <div class="loader" style="top:48%;z-index:9999999"><img src="images/status.gif" border="0" > </div>


                        <div class="lprofile">
                            <div class="pull-left image" style="margin-top: 15px;margin-left:10px">
                                <img src="images/default_profile.png" class="img-circle" alt="User Image" style="height: 120px;width:120px" id="clientprofileimg">

                            </div>


                        </div>

                        <div class="mprofile" style="margin-top:5px">
                            <div style="margin-bottom:7px"><span class="prheader" style="font-size:14px">Client Profile</span></div>

                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel" style="font-size:12px">First Name:</span></div><div class="prtextdiv"><span id="prclientfname" class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel" style="font-size:12px">Last Name:</span></div><div class="prtextdiv"><span id="prclientlname" class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel" style="font-size:12px">Profile Text:</span></div><div class="prtextdiv"><span id="about" class="prclienttxt"></span></div></div></p>

                            <input type="hidden" name="clientemail" id="clientemail">

                        </div>



                    </div>




                </div>


                <div class="admin-content" align="center" id="ideleteclient" align="left" >

                    <div class="coach-div" style="margin: 0">

                        <div class="tbldata" >
                            <table id="deleteclient" class="table table-bordered table-striped">
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

                <div class="admin-content" align="center" id="iinactiveclient" align="left" >

                    <div class="coach-div" style="margin: 0">

                        <div class="tbldata" >
                            <table id="inactiveclient" class="table table-bordered table-striped">
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

                <div class="admin-content" align="center" id="iallcompany" style="display: block" align="center">
                    <div class="coach-div" style="margin: 0" >

                        <ul id="dcompany" align="center" style="margin: 0;width:100%">

                        </ul>


                    </div>


                </div>

                <div class="admin-content" align="center" id="iaddcompany">
                    <form id='uploaddata2'  method='POST' enctype='multipart/form-data' action="{{ url('uploaddata2') }}">
                    <h4 style="text-align: left; width:90%; color:#fff">
                        Join us with your Company Account</h4></p>


                    <div class="coach-div" align="center"  style="width: 90%">

                        <div id="cldivmain" align="center" >

                            <div class="cldiv" align="left">
                                <label>Company Name*</label></p>
                                <input type="text" class="txt3" id="co-name" name="co-name">
                            </div>

                            <div class="cldiv" align="left">
                                <label>Address*</label></p>
                                <textarea class="txt3" id="co-adr" name="co-adr"></textarea>
                            </div>

                            <div class="cldiv" align="left">
                                <label>Place*</label></p>
                                <input type="text" class="txt3" id="co-place" name="co-place">
                            </div>

                            <div class="cldiv" align="left">
                                <label>Telephone Number*</label></p>
                                <input type="text" class="txt3" id="co-contact" name="co-contact">
                            </div>

                            <div class="cldiv" align="left">
                                <label>Email*</label></p>
                                <input type="text" class="txt3" id="co-email" name="co-email">
                            </div>

                            <div class="cldiv" align="left">
                                <label>Password*</label></p>
                                <input type="password" class="txt3" id="co-pwd" name="co-pwd">
                            </div>

                            <div class="cldiv" align="left">
                                <label>Contact Person*</label></p>
                                <input type="text" class="txt3" id="co-person" name="co-person">
                            </div>

                            <div class="cldiv" align="left">
                                <label>Company Number*</label></p>
                                <input type="text" class="txt3" id="co-number" name="co-number">
                            </div>

                            <div class="cldiv" align="left">
                                <label>Vat Number*</label></p>
                                <input type="text" class="txt3" id="co-vat" name="co-vat">
                            </div>

                            <div class="cldiv" align="left" style="height: 84px">
                                <label>profile image*</label></p>

                                <input type='file' name='photo3' id="pimg3" />
                                <span style="color:#fff;">Image size is only 5 mb  allowed</span>
                            </div>

                            <div class="cldiv" align="left" style="margin-top: 32px">
                                <input type="button" id="cosignup" value="Sign Up">

                            </div>


                        </div>


                </div>




                </form></div><!-- /.col -->

                <div class="admin-content" align="center" id="ideletecompany" align="left" >

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

                <div class="admin-content"  id="icompanyprofile" >

                    <div class="coach-div" style="margin: 0">

                        <div class="background2" style="z-index: 9999"></div>
                        <div class="loader" style="top:48%;z-index:9999999"><img src="images/status.gif" border="0" > </div>
                        <div id="popup4" class="popup" style="z-index: 999999; ">
                            <form  method="post" name="updateimage3" id="updateimage3" action="{{ url('updateimage3') }}">
                                <div class="border">
                                    <a id="closepop5" class="closepop">x</a></div>
                                <div id="wrapper4" class="wrapper1" align="center">

                                    <p style="margin:20px"></p>
                                    <span style=" font-size:24px;letter-spacing:1px;">Please choose image file to upload</span><p style="margin:10px"></p>

                                    <p style="margin:20px"></p>
                                    <div align="center">
                                        <input type='file' name='changeimg3' id="changeimg3"  style="background-color: #BB8057"/>
                                        <span>Image size 5 mb is allowed</span>
                                        <input type="submit" id="updateimg3" value="update image" style="background-color: #826048;">

                                    </div>

                                    <div align="center">
                                        <div id="progressbox5"><div id="progressbar5"></div><div id="statustxt5">0%</div></div>
                                    </div>

                                    <span id="imgmsg5"></span>
                                    <input type="hidden" name="compemail2" id="compemail2">
                                </div>
                            </form>

                        </div>

                        <div class="lprofile" style="margin-left: 60px">
                            <div class="pull-left image" style="margin-top: 15px;margin-left:10px">
                                <img src="images/logoplaceholder.png" class="img-circle" alt="User Image" style="height: 120px;width:120px; background: #fff;" id="compprofileimg">
                                <div style="width:120px;  margin-top:10px;" align="center"><a id="compppchange" class="picchange">Change Picture</a></div>

                            </div>


                        </div>

                        <div class="mprofile">
                            <div><span class="prheader">Company Profile</span></div>

                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Company Name:</span></div><div class="prtextdiv"><span id="prcomp" class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Company Email:</span></div><div class="prtextdiv"><span id="prcompemail" class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Address:</span></div><div class="prtextdiv"><span id="pradr" class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Place:</span></div><div class="prtextdiv"><span id="prplace" class="prtxt"></span></div></div></p>
                            <div style="height: 44px"><div class="prlabeldiv"><span class="prlabel">Telephone Number:</span></div><div class="prtextdiv"><span id="prcontact2"  class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Contact Person:</span></div><div class="prtextdiv"><span id="prcperson" class="prtxt"></span></div></div></p>
                            <div style="height: 40px"><div class="prlabeldiv"><span class="prlabel">Company Number:</span></div><div class="prtextdiv"><span id="prcompcontact" class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel">Vat:</span></div><div class="prtextdiv" style="width:261px"><span id="prvat" class="prtxt"></span></div></div></p>

                        </div>

                        <div class="rprofile"><a class="edit3" style="cursor: pointer"><img src="images/edit_icon.png" height="50px" width="50px"></a> </div>



                    </div>


                </div>

                <div class="admin-content"  id="ieditcompany" >

                    <div class="background2" style="z-index: 999"></div>

                        <div class="coach-div" style="margin-left:50px;width:92%">

                            <div id="cldivmain" align="center" >

                                <div class="cldiv" align="left">
                                    <label>Company Name</label></p>
                                    <input type="text" class="txt3" id="co-name2" name="co-name2">
                                </div>

                                <div class="cldiv" align="left">
                                    <label>Address</label></p>
                                    <textarea class="txt3" id="co-adr2" name="co-adr2"></textarea>
                                </div>

                                <div class="cldiv" align="left">
                                    <label>Place</label></p>
                                    <input type="text" class="txt3" id="co-place2" name="co-place2">
                                </div>

                                <div class="cldiv" align="left">
                                    <label>Telephone Number</label></p>
                                    <input type="text" class="txt3" id="co-contact2" name="co-contact2">
                                </div>


                                <div class="cldiv" align="left">
                                    <label>Contact Person</label></p>
                                    <input type="text" class="txt3" id="co-person2" name="co-person2">
                                </div>

                                <div class="cldiv" align="left">
                                    <label>Company Number</label></p>
                                    <input type="text" class="txt3" id="co-number2" name="co-number2">
                                </div>

                                <div class="cldiv" align="left">
                                    <label>Vat Number</label></p>
                                    <input type="text" class="txt3" id="co-vat2" name="co-vat2">
                                </div>

                                <div class="cldiv" align="left" style="margin-top: 32px">
                                    <input type="button" id="coupdate" value="Sign Up">

                                </div>


                            <input type="hidden" name="compemail" id="compemail">
                        </div>
                    </div>

                </div>

                <div class="admin-content"  id="ifinancialoverview" >

                    <div class="coach-div" style="margin: 0">

                        <div id="afinancediv">

                            <table id="afinancetab" style=margin-left:3%>
                                <thead>
                                <tr class="afinanceheading">

                                    <th>Date</th>
                                    <th>Company account sales</th>
                                    <th>Private account sales</th>
                                    <th>Total Amount</th>

                                </tr>
                                </thead>
                                <tbody>
                            </table>
                        </div>
                        </div>
                </div>

          </div><!-- /.row -->
       </div>
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

                var inactivecoaches=callajax('', 'getinactivecoaches',false,'GET');


                        $('#activate tbody').html(inactivecoaches);
            });

            $(".edit").click(function () {

                $("#icoachprofile").css("display", "none");
                $("#ieditprofile").css("display", "block");

            });

            $(".edit3").click(function () {

                $("#icompanyprofile").css("display", "none");
                $("#ieditcompany").css("display", "block");

            });

            $("#allcoach").click(function () {

                var coachdata = callajax('', 'getallcoaches', false, 'GET');

                $("#dcoach").html(coachdata);

            });


            $("#allclient").click(function () {

             var clientdata=callajax('', 'getallclientsbyadmin',false,'GET');
                $("#dclient").html(clientdata);

            });

            $("#allcompany").click(function () {

                var companydata=callajax('', 'getallcompanies',false,'GET');

                $("#dcompany").html(companydata);

            });



            $("#appoint").click(function () {

                var appointdata = callajax('', 'getappointdata', false, 'GET');
                $("#appointtab tbody").html(appointdata);


                //$("#dcoach").html(coachdata);

            });


            $("#financialoverview").click(function () {

                var financedata = callajax('', 'getallfinancedata', false, 'GET');
                 $("#afinancetab tbody").html(financedata);
               


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

                temp = act('level', 'Please enter coach level', 'blank');
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

            $("#coupdate").click(function()
            {

                var coname=$("#co-name2").val();
                var coadr=$("#co-adr2").val();
                var coplace=$("#co-place2").val();
                var cocontact=$("#co-contact2").val();
                var coperson=$("#co-person2").val();
                var conumber=$("#co-number2").val();
                var covat=$("#co-vat2").val();
                var coemail=$("#compemail").val();

                datastring= {
                    "coname": coname,
                    "coadr": coadr,
                    "coplace": coplace,
                    "cocontact": cocontact,
                    "cperson": coperson,
                    "cnumber": conumber,
                    "vat": covat,
                    "email": coemail

                };

                var updatecompany=callajax(datastring, 'updatecompanydata',false,'GET');

                //alert(updatecompany);
            });

            $("#deletecoach").click(function()
            {
                var dcoachdata=callajax('', 'getcoaches',false,'GET');

                $('#delete tbody').html(dcoachdata);


            });

            $("#deletecompany").click(function()
            {
                var dcompdata=callajax('', 'getcompanies',false,'GET');

                $('#delete tbody').html(dcompdata);


            });
            $("#deleteclient").click(function()
            {

                var dclientdata=callajax('', 'getdclientdata',false,'GET');

                $("#iallclient").css("display","none");
                $("#iclientprofile").css("display","none");

                $("#ideleteclient").css("display","block");
                $('#deleteclient tbody').html(dclientdata);


            });


            $("#inactive").click(function()
            {


                var activecoaches=callajax('', 'getactivecoaches',false,'GET');

                $('#inactive tbody').html(activecoaches);
            });



            $("#inactiveclient").click(function()
            {


                var activeclients=callajax('', 'getactiveclients',false,'GET');



                $('#inactiveclient tbody').html(activeclients);
            });


            $('.profile-act').click(function()
            {
                var id=$(this).attr("id");
                $('.admin-content').hide();
                var nid="i"+id;

                $("#"+nid).show();

            });

            $("#creditoverview").click(function()
            {
                $("#iallcompany").css("display","none");
                $("#icompanyprofile").css("display","none");
                $("#ieditcompany").css("display","none");
                $("#ideletecompany").css("display","none");
                $("#icreditoverview").css("display","block");
               // var datastring5= {

                   // "email": email
               // }

                //var creditoverview=callajax(datastring5, 'getcreditoverview',false,'GET');

                //$('#allcredits tbody').html(creditoverview);

            });


            $("#supply").click(function()
            {

                $("#icreditoverview").css("display","none");
                $("#idistcredit").css("display","block");

                var compname=callajax('', 'bindcompanyname',false,'GET');

                $("#compname").append(compname);

            });

            $("#creditoverview").click(function()
            {
                timezone = jstz.determine();
                var tz = timezone.name();

                data = {

                    timezon:tz

                };

                var creditoverview=callajax(data, 'getcreditoverview2',false,'GET');

                $('#allcredits tbody').html(creditoverview);

            });

            $("#save").click(function()
            {
                var cont=true;
                temp = act('compname', 'Please choose company name', 'SEL');
                if (temp == true) { cont = false; }
                temp = act('creditqty', 'Please enter credit qty', 'blank');
                if (temp == true) { cont = false; }

                if(cont==true)
                {
                    var compid=$("#compname").val();
                    var creditqty=$("#creditqty").val();

                    var datastring5= {

                        "compid":compid,
                        "creditqty":creditqty
                    };

                    var distributecredit=callajax(datastring5, 'distributecredit2',false,'GET');

                    if(distributecredit=='true')
                    {
                        $("#nmsg").css('display','block');
                        $("#nmsg").html('Credits is distributed to company successfully');
                        setTimeout(function() { $("#nmsg").fadeOut(1500); }, 5000);
                    }



                    $("#compname").val('-Select-');
                    $("#creditqty").val('');
                }
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

            $("#cosignup").click(function()
            {

                var cont=true;
                temp = act('co-name', 'Please enter company name', 'blank');
                if (temp == true) { cont = false; }
                temp = act('co-adr', 'Please enter address', 'blank');
                if (temp == true) { cont = false; }
                temp = act('co-place', 'Please enter place', 'blank');
                if (temp == true) { cont = false; }
                temp = act('co-contact', 'Please enter contact', 'blank');
                if (temp == true) { cont = false; }
                temp = act('co-email', 'Please enter email id', 'E2');
                if (temp == true) { cont = false; }
                temp = act('co-pwd', 'Please enter password', 'blank');
                if (temp == true) { cont = false; }
                temp = act('co-person', 'Please enter contact person ', 'blank');
                if (temp == true) { cont = false; }
                temp = act('co-number', 'Please enter company number', 'blank');
                if (temp == true) { cont = false; }
                temp = act('co-vat', 'Please enter vat number', 'blank');
                if (temp == true) { cont = false; }
                temp = act('pimg3', 'Please choose profile image', 'blank');
                if (temp == true) { cont = false; }

                if(cont==true)
                {

                    $("#uploaddata2").attr("method", "POST");
                    $("#uploaddata2").submit();

                    $(".background2").css({'display': 'block'});
                    $('.loader').css({'display': 'block'});


                }

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
                var langtext=arr[14];
                var level=arr[15];
                if (level == 2)
                {

                    $("#coachlevel").html("Executive coach <b style='background:#A78873; border-radius:50%; padding:2px 3px; color:#000; font-weight:bold; margin-left:2px;'>+1</b>");
                }

                else if (level == 1)
                {
                    $("#coachlevel").html("Coach <b style='background:#A78873; border-radius:50%; padding:2px 6px; color:#000; font-weight:bold; margin-left:2px;'>+</b>");
                }

                else
                {
                    $("#coachlevel").html('');
                }

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
                $("#coach-level2").val(level);

            });

            $(document).on('click', '.showclientprofile', function(){

                $("#iallclient").css("display","none");
                $("#iclientprofile").css("display","block");
                $("#prclientfname").html('');
                $("#prclientlname").html('');
                $("#about").html('');
                $("#clientprofileimg").attr('src', 'images/default_profile.png');

                $("#clientemail").val('');

                var uid=$(this).attr("alt");
                var data2={'userid':uid}

                var clientprofile=callajax(data2, 'getclientprofile',false,'GET');

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

            $(document).on('click', '.showcompprofile', function(){

                $("#iallcompany").css("display","none");
                $("#icompanyprofile").css("display","block");

                var uid=$(this).attr("alt");
                var data3={'userid':uid}

                $("#prcomp").html('');
                $("#pradr").html('');
                $("#prplace").html('');
                $("#prcontact2").html('');
                $("#prcperson").html('');
                $("#prcompcontact").html('');
                $("#prvat").html('');

                $("#prcompemail").html('');

                $("#compemail").val('');

                $("#compemail2").val('');

                $("#clientprofileimg").attr('src', 'images/logoplaceholder.png');

                var compprofile=callajax(data3, 'getcompanyprofile',false,'GET');

                var r=compprofile.split('#');

                $("#prcomp").html(r[0]);
                $("#pradr").html(r[1]);
                $("#prplace").html(r[2]);
                $("#prcontact2").html(r[4]);
                $("#prcperson").html(r[5]);
                $("#prcompcontact").html(r[6]);
                $("#prvat").html(r[7]);
                $("#prcompemail").html(r[8]);

                if(r[3]!='') {
                    $("#compprofileimg").attr("src", r[3]);
                }
$("#co-name2").val(r[0]);
                $("#co-adr2").val(r[1]);
                $("#co-place2").val(r[2]);
                $("#co-contact2").val(r[4]);
                $("#co-person2").val(r[5]);
                $("#co-number2").val(r[6]);
                $("#co-vat2").val(r[7]);

                $("#compemail").val(r[8]);
                $("#compemail2").val(r[8]);




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


            $('#compppchange').click(function()
            {

                $(".error").css("display","none");
                $(".background2").css("display","block");
                $("#popup4").css("display","block");
                var id="popup4";
                centerPopup(id);
                loadPopup(id);

                $('#statustxt5').html('0%');

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

            var submitbutton5=$("#updateimg3");
            var myform5          = $("#updateimage3");
            var output5          = $("#imgmsg5");
            var progressbox5     = $('#progressbox5');
            var progressbar5     = $('#progressbar5');
            var statustxt5      = $('#statustxt5');

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

            jq5(myform5).ajaxForm({
                beforeSend: function() { //brfore sending form

                    output5.html('');
                    submitbutton5.attr('disabled', '');
                    jq5('#changeimg3').attr('disabled', 'disabled');
                    jq5('#closepop5').attr('disabled', 'disabled');
                    // disable upload button
                    statustxt5.empty();
                    progressbox5.slideDown(); //show progressbar
                    progressbar5.width(completed); //initial value 0% of progressbar
                    statustxt5.html(completed); //set status text
                    statustxt5.css('color','#000'); //initial color of status text
                },
                uploadProgress: function(event, position, total, percentComplete) { //on progress
                    progressbar5.width(percentComplete + '%') //update progressbar percent complete
                    statustxt5.html(percentComplete + '%'); //update status text
                    if(percentComplete>50)
                    {
                        statustxt5.css('color','#fff'); //change status text to white after 50%
                    }
                    jq5('#changeimg3').attr('disabled', 'disabled');
                    jq5('#changeimg3').attr('disabled', 'disabled');
                },
                complete: function(response) { // on complete

                    var r=response.responseText;
                   // alert(r);
                    var r1= r.split("#");
                    var imgsrc=r1[1];
                    var msg=r1[0];


                    //update element with received data

                    //myform2.resetForm();  // reset form
                    submitbutton5.removeAttr('disabled'); //enable submit button
                    progressbox5.slideUp(); // hide progressbar
                    jq5('#changeimg3').removeAttr('disabled', 'disabled');
                    jq5('#closepop5').removeAttr('disabled', 'disabled');

                    if(imgsrc!='') {
                        jq5("#compprofileimg").attr("src", imgsrc);

                        output5.html(msg);
                    }

                    else
                    {
                        output5.html(msg);
                    }


                }
            });

        });

    </script>
    <script type="text/javascript" src="js/popup.js"></script>
    <script type="text/javascript" src="js/jstz-1.0.4.min.js"></script>

  </body>
</html>
