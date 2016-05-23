<?php
session_start();
ob_start();
$uemail=Session::get('coemail');

        $uid=Session::get('uid2');
if($uemail=='')
{
    header('Location:index');
}
        $company_name=Session::get('company');

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
            <a class="logout" href="logout">logout</a>
            <div class="pull-left image" >
              <img src="images/logoplaceholder.png" class="img-circle" alt="User Image" id="primg" style="height: 45px;width:45px;">
            </div>
            <div class="pull-left info">
              <p id="uname" style="text-transform: capitalize"></p>
              <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
          </div>
         
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">


              <li class="sidebar-border">
                  <a  class="admin-menu" id="allclient" style="cursor:pointer">
                      <span>Client Overview</span>
                      <i class="fa fa-fw fa-angle-right financial" style="margin-left:104px;font-size:20px;"></i>
                  </a>

              </li>




              <li class="sidebar-border">
                  <a  class="admin-menu" id="creditoverview" style="cursor:pointer">
                      <span>Credit Overview</span>
                      <i class="fa fa-fw fa-angle-right financial" style="margin-left:101px;font-size:20px;"></i>
                  </a>

              </li>

              <li class="sidebar-border">
                  <a  class="admin-menu" id="appoint" style="cursor:pointer">
                      <span>Appointment Overview</span>
                      <i class="fa fa-fw fa-angle-right financial" style="margin-left:68px;font-size:20px;"></i>
                  </a>
              </li>

              <li class="sidebar-border">
                  <a  class="admin-menu" id="profile" style="cursor:pointer">
                      <span>Profile</span>
                      <i class="fa fa-fw fa-angle-right financial" style="margin-left:144px;font-size:20px;"></i>
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

            <li><a class="home" href="#">Company</a>
              <i class="fa fa-fw fa-angle-right"></i>
            </li> 
            <li class="trg">Client Overview</li>
          </ol>

            <div class="row">
            <div class="col-md-9 coach-header" >
          <div class="content-bg" style="width:100%;padding-left: 14px;margin-left:0">
            <h3 class="htxt">
              Client Overview
            </h3>

              <div id="hallclient" class="hsection" style="display: block;">
              <a class="profile-act" id="addclient"  style="margin-left: 2%">Add Colleague</a>

              <a class="profile-act" id="deleteclient" >Delete Colleague</a>
              <a class="profile-act" id="inactiveclient" >Set Colleague non-active</a>
              <a class="profile-act" id="activeclient" >Set Colleague active</a>
                  </div>

              <div id="hcreditoverview" class="hsection">
                  <a class="profile-act" id="distcredit"  style="margin-left: 2%">Credit Distribution</a>
                  <a class="profile-act" id="creditoverview2" >Credit overview</a>

              </div>

              <div id="hprofile" class="hsection">
                  <a class="profile-act" id="showcompprofile"  style="margin-left: 2%">View Profile</a>

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


          <div class="row">
            
            <div class="col-md-12" style="padding: 0px">

                <section class="admin-content" align="center" id="iaddclient" style="width:100%;">

                    <div class="row">
                        <div class="col-md-9 col-sm-12" style="padding-left:45px;">


                        <h4 style="text-align: left; width:90%; color:#fff">
                        Add Colleague</h4></p>

                    <form id='uploadclientdata'  method='POST' enctype='multipart/form-data' action="{{ url('uploadclientdata') }}">
                        <div class="coach-div" align="center"  style="width: 90%">

                            <div class="cldiv" align="left">
                                <label>First Name*</label></p>
                                <input type="text" class="txt3" id="fname" name="fname" >
                            </div>

                            <div class="cldiv" align="left">
                                <label>Last Name*</label></p>
                                <input type="text" class="txt3"  id="lname" name="lname">
                            </div>

                            <div class="cldiv" align="left">
                                <label>Email*</label></p>
                                <input type="text" class="txt3" id="cemail" name="cemail">
                            </div>



                            <div class="cldiv" align="left">
                                <label>Telephone Number*</label></p>
                                <input type="text" class="txt3" id="ccontact" name="ccontact">
                            </div>

                            <div class="cldiv" align="left">
                                <label>Function*</label></p>
                                <input type="text" class="txt3" id="cfunction" name="cfunction">
                            </div>

                            <div class="cldiv" align="left" style="height: 84px">
                                <label>profile image*</label></p>

                                <input type='file' name='photo' id="pimg" />
                                <span style="color:#fff;">Image size is only 5 mb  allowed</span>
                            </div>

                            <div class="cldiv" align="left" style="margin-bottom: 50px; margin-top:35px">
                                <input type="button" id="csignup" value="Sign Up">

                            </div>
<input type="hidden" id="companyemail"  name="companyemail"/>
                        </div>
                    </form>
</div>
                    <div class="col-md-2 col-sm-12 sidespace" style="color:#fff;padding:25px; text-align:left;">

            </div>
</div>
        </section>

                <section class="admin-content" align="center" id="iallclient" style="display: block; width:100%;">

                    <div class="row">
                        <div class="col-md-9 col-sm-12">

                    <div class="coach-div" style="margin: 0" >

                        <ul id="dclient" align="center" style="margin: 0;width:100%">

                        </ul>


                    </div>


                </div>

                        <div class="col-md-2 col-sm-12 sidespace" style="color:#fff;padding:25px; text-align:left;">
                        <h6 style="margin-bottom:0px;">Credits available</h6>
                        <div class="availablecredits"></div>
                    </div>
            </div>
        </section>

                <section class="admin-content"  id="iclientprofile" style="margin-left: 60px; width:100%;">
                    <div class="row">
                        <div class="col-md-9 col-sm-12">

                    <div class="coach-div" style="margin: 0">

                        <div class="background2" style="z-index: 9999"></div>
                        <div class="loader" style="top:48%;z-index:9999999"><img src="images/status.gif" border="0" > </div>

                        <div id="popup" class="popup" style="z-index: 999999; ">
                            <form  method="post" name="updateclientimage" id="updateclientimage" action="{{ url('updateclientimage') }}">
                                <div class="border">
                                    <a id="closepop" class="closepop">x</a></div>
                                <div id="wrapper" class="wrapper1" align="center">

                                    <p style="margin:20px"></p>
                                    <span style=" font-size:24px;letter-spacing:1px;">Please choose image file to upload</span><p style="margin:10px"></p>

                                    <p style="margin:20px"></p>
                                    <div align="center">
                                        <input type='file' name='changeimg' id="changeimg"  style="background-color: #BB8057"/>
                                        <span>Image size 5 mb is allowed</span>
                                        <input type="submit" id="updateimg" value="update image" style="background-color: #826048;">

                                    </div>

                                    <div align="center">
                                        <div id="progressbox"><div id="progressbar"></div><div id="statustxt">0%</div></div>
                                    </div>
                                    <span id="imgmsg"></span>

                                    <input type="hidden" name="clientemail3" id="clientemail3">

                                </div>
                            </form>

                        </div>

                        <div class="lprofile">
                            <div class="pull-left image" style="margin-top: 15px;margin-left:10px">
                                <img src="images/default_profile.png" class="img-circle" alt="User Image" style="height: 120px;width:120px" id="clientprofileimg">
                                <div style="width:120px;  margin-top:10px;" align="center"><a id="ppchange" class="picchange">Change Picture</a></div>

                            </div>



                        </div>

                        <div class="mprofile" style="margin-top:14px">
                            <div style="margin-bottom:7px"><span class="prheader" style="font-size:14px">Client Profile</span></div>

                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel" style="font-size:12px">First Name:</span></div><div class="prtextdiv"><span id="prclientfname" class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel" style="font-size:12px">Last Name:</span></div><div class="prtextdiv"><span id="prclientlname" class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv"><span class="prlabel" style="font-size:12px">Function:</span></div><div class="prtextdiv"><span id="cfunctiontxt" class="prclienttxt"></span></div></div></p>
                            <input type="hidden" name="clientemail" id="clientemail">

                        </div>

                        <div class="rprofile" style="margin-top:14px"><a class="edit" style="cursor: pointer"><img src="images/edit_icon.png" height="50px" width="50px"></a> </div>



                    </div>

                </div>
                        <div class="col-md-2 col-sm-12 sidespace" style="color:#fff;padding:25px; text-align:left;">

                        </div>
                    </div>


                </section>


                <section class="admin-content"  id="ieditprofile" style="width:100%;" >
                    <div class="row">
                        <div class="col-md-9 col-sm-12">

                    <div class="background2" style="z-index: 999"></div>


                        <div class="coach-div" style="margin-left:50px;width:92%">

                            <div class="cldiv" align="left">
                                <label>First Name</label></p>
                                <input type="text" class="txt3" id="fname2" name="fname2" >
                            </div>

                            <div class="cldiv" align="left">
                                <label>Last Name</label></p>
                                <input type="text" class="txt3"  id="lname2" name="lname2">
                            </div>


                            <div class="cldiv" align="left">
                                <label>Telephone Number</label></p>
                                <input type="text" class="txt3" id="ccontact2" name="ccontact2">
                            </div>


                            <div class="cldiv" align="left">
                                <label>Function</label></p>
                                <input type="text" class="txt3" id="cfunction2" name="cfunction2">
                            </div>

                            <div class="cldiv" align="left" style="margin-bottom: 50px; margin-top: 33px">
                                <input type="button" id="updateclient" value="Update">

                            </div>
                            <input type="hidden" id="clientemail2"  name="clientemail2"/>
                        </div>

                </div>
                        <div class="col-md-2 col-sm-12 sidespace" style="color:#fff;padding:25px; text-align:left;">

                        </div>
                    </div>

                </section>


                <section class="admin-content" align="center" id="ideleteclient" style="width:100%;" >
                    <div class="row">
                        <div class="col-md-9 col-sm-12" style="padding-left:45px;">
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
                        <div class="col-md-2 col-sm-12 sidespace" style="color:#fff;padding:25px; text-align:left;">

                        </div>
                    </div>

                </section>

                <section class="admin-content" align="center" id="iactiveclient" style="width:100%;">
                    <div class="row">
                        <div class="col-md-9 col-sm-12" style="padding-left:45px;">

                    <div class="coach-div" style="margin: 0">

                        <div class="tbldata" >
                            <table id="activeclient" class="table table-bordered table-striped">
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

                        <div class="col-md-2 col-sm-12 sidespace" style="color:#fff;padding:25px; text-align:left;">

                        </div>
                    </div>

                </section>


                <section class="admin-content" align="center" align="left" id="icreditoverview" style="width:100%;" >
                    <div class="row">
                        <div class="col-md-9 col-sm-12" style="padding-left:45px;">


                        <div class="coach-div" style="margin: 0">

                        <div class="tbldata" >
                            <table id="allcredits" class="table table-bordered table-striped">
                                <thead>
                                <tr class="tblheading">
                                    <th>Client Name</th>
                                    <th>Company Credit qty</th>
                                    <th>Client Credit qty</th>

                                </tr>
                                </thead>
                                <tbody>
                                </tbody>

                            </table>

                        </div>
                    </div>

                </div>

                        <div class="col-md-2 col-sm-12 sidespace" style="color:#fff;padding:25px; text-align:left;">
                            <h6 style="margin-bottom:0px;">Credits available</h6>
                            <div class="availablecredits"></div>
                        </div>
                    </div>
                </section>

                <section class="admin-content" align="center" id="idistcredit" style="width:100%;">
                    <div class="row">
                        <div class="col-md-9 col-sm-12" style="padding-left:45px;">

                    <div class="coach-div" style="width: 90%">

                        <div class="cldiv" align="left">
                            <label>Client Name</label></p>
                            <select class="txt3" id="clientname" name="clientname">

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
                        <div class="col-md-2 col-sm-12 sidespace" style="color:#fff;padding:25px; text-align:left;">
                            <h6 style="margin-bottom:0px;">Credits available</h6>
                            <div class="availablecredits"></div>
                        </div>
                    </div>

                </section>

                <section class="admin-content" align="center" id="iinactiveclient" style="width:100%;" >
                    <div class="row">
                        <div class="col-md-9 col-sm-12" style="padding-left:45px;">

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
                        <div class="col-md-2 col-sm-12 sidespace" style="color:#fff;padding:25px; text-align:left;">

                        </div>
                    </div>
                </section>


                <section class="admin-content"  id="icompanyprofile" style="width:100%;" >
                    <div class="row">
                        <div class="col-md-9 col-sm-12">

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

                            <div style="height: 20px"><div class="prlabeldiv" style="width:120px"><span class="prlabel">Company Name:</span></div><div class="prtextdiv"><span id="prcomp" class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv" style="width:120px"><span class="prlabel">Address:</span></div><div class="prtextdiv"><span id="pradr" class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv" style="width:120px"><span class="prlabel">Place:</span></div><div class="prtextdiv"><span id="prplace" class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv" style="width:120px"><span class="prlabel">Telephone Number:</span></div><div class="prtextdiv"><span id="prcontact2"  class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv" style="width:120px"><span class="prlabel">Contact Person:</span></div><div class="prtextdiv"><span id="prcperson" class="prtxt"></span></div></div></p>
                            <div style="height: 40px"><div class="prlabeldiv" style="width:120px"><span class="prlabel">Company Number:</span></div><div class="prtextdiv"><span id="prcompcontact" class="prtxt"></span></div></div></p>
                            <div style="height: 20px"><div class="prlabeldiv" style="width:120px"><span class="prlabel">Vat:</span></div><div class="prtextdiv" style="width:261px"><span id="prvat" class="prtxt"></span></div></div></p>

                        </div>

                        <div class="rprofile"><a class="edit2" style="cursor: pointer"><img src="images/edit_icon.png" height="50px" width="50px"></a> </div>



                    </div>


                </div>

                        <div class="col-md-2 col-sm-12 sidespace" style="color:#fff;padding:25px; text-align:left;">

                        </div>
                    </div>
                </section>



                <section class="admin-content"  id="ieditcompany" style="width:100%;">
                    <div class="row">
                        <div class="col-md-9 col-sm-12">

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
                                <input type="button" id="coupdate" value="Update">

                            </div>


                            <input type="hidden" name="compemail" id="compemail">
                        </div>
                    </div>

          </div><!-- /.row -->
                        <div class="col-md-2 col-sm-12 sidespace" style="color:#fff;padding:25px; text-align:left;">

                        </div>
                    </div>

                </section>

                <<section class="admin-content" align="center" id="iappoint" style="width:100%;" >

                    <div class="row">
                        <div class="col-md-9 col-sm-12">

                        <div class="coach-div" style="margin: 0">

                        <div id="appointdiv" style="margin-left: 4%">

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


</div>
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

        var email="<?php echo $uemail?>";

        $(document).ready(function(){

            var company_name="<?php echo $company_name?>";

            $("#uname").html(company_name);

            datastring2= {

                "email1": email
            }

            var clientdata=callajax(datastring2, 'getallcorpclients',false,'GET');


            $("#dclient").html(clientdata);

            $("#companyemail").val(email);

            $("#allclient").click(function () {

                datastring2= {

                    "email1": email
                }

             var clientdata=callajax(datastring2, 'getallcorpclients',false,'GET');


                $("#dclient").html(clientdata);

            });

            data4= {

                "qemail": email
            }

            var profileimg=callajax(data4, 'getprofileimg',false,'GET');

            $("#primg").attr("src",profileimg);

            var availablecredits=callajax(datastring2, 'getavailablecredits',false,'GET');
            $(".availablecredits").html(availablecredits);

            $("#deleteclient").click(function()
            {

               var datastring3= {

                    "email1": email
                }
                var dclientdata=callajax(datastring3, 'getcorpclientdata',false,'GET');

                $("#iallclient").css("display","none");
                $("#iclientprofile").css("display","none");

                $("#ideleteclient").css("display","block");
                $('#deleteclient tbody').html(dclientdata);


            });



            $("#inactiveclient").click(function()
            {

                var datastring4= {

                    "email1": email
                }

                var activeclients=callajax(datastring4, 'getactivecorpclients',false,'GET');
                $('#inactiveclient tbody').html(activeclients);
            });

            $("#activeclient").click(function()
            {
                var datastring5= {

                    "email1": email
                }

                var inactiveclients=callajax(datastring5, 'getinactivecorpclients',false,'GET');
                $('#activeclient tbody').html(inactiveclients);
            });


            $('.profile-act').click(function()
            {
                var id=$(this).attr("id");
                $('.admin-content').hide();
                var nid="i"+id;

                $("#"+nid).show();

            });

            $(document).on('click', '#profile', function(){

                $("#iallcompany").css("display","none");
                $("#icompanyprofile").css("display","block");

                var uid = "<?php echo $uid; ?>";
                //var uid=$(this).attr("alt");
                var data3={'userid':uid}

                $("#prcomp").html('');
                $("#pradr").html('');
                $("#prplace").html('');
                $("#prcontact2").html('');
                $("#prcperson").html('');
                $("#prcompcontact").html('');
                $("#prvat").html('');

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


            $(".edit2").click(function () {

                $("#icompanyprofile").css("display", "none");
                $("#ieditcompany").css("display", "block");

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


            $("#showcompprofile").click(function () {

                $("#icompanyprofile").css("display", "block");
                $("#ieditcompany").css("display", "none");

            });

            $("#creditoverview").click(function()
            {
                var datastring5= {

                    "email": email
                }

                var creditoverview=callajax(datastring5, 'getcreditoverview',false,'GET');

                $('#allcredits tbody').html(creditoverview);

            });

            $("#creditoverview2").click(function()
            {
                var datastring5= {

                    "email": email
                }

                var creditoverview=callajax(datastring5, 'getcreditoverview',false,'GET');



                $('#allcredits tbody').html(creditoverview);

                $("#idistcredit").css("display","none");
                $("#icreditoverview").css("display","block");

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


            $(document).on('click', '.showclientprofile', function(){

                $("#iallclient").css("display","none");
                $("#iclientprofile").css("display","block");
                $("#prclientfname").html('');
                $("#prclientlname").html('');
                $("#about").html('');
                $("#clientprofileimg").attr('src', 'images/default_profile.png');

                $("#clientemail").val('');
                $("#clientemail2").val('');
                $("#clientemail3").val('');
                $("#imgmsg").html('');
                $("#changeimg").val('');
                var uid=$(this).attr("alt");
                var data2={'userid':uid}

                var clientprofile=callajax(data2, 'getcorpclientprofile',false,'GET');

                var arr = clientprofile.split("#");
                var fname = arr[0];
                var lname = arr[1];
                var contact = arr[2];
                var img = arr[3];
                var about_info = arr[4];
                var email = arr[5];
                var cfunction= arr[6];
                var fname1 = fname.toUpperCase();
                var lname1 = lname.toUpperCase();
                var name = fname1 + " " + lname1;

                $("#prclientfname").html(fname);
                $("#prclientlname").html(lname);
                $("#cfunctiontxt").html(cfunction);
                $("#clientprofileimg").attr('src', img);
                $("#timelineimg").attr('src', img);
                $("#timelinetext").html(name);
                $("#clientemail").val(email);
                $("#clientemail2").val(email);
                $("#clientemail3").val(email);
                $("#fname2").val(fname);
                $("#lname2").val(lname);
                $("#ccontact2").val(contact);
                $("#cfunction2").val(cfunction);



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

            $("#appoint").click(function () {
                var appointdata = callajax('', 'getappointdata', false, 'GET');
                $("#appointtab tbody").html(appointdata);

                $("#creditsidebar1").css("display","none");
                $("#creditsidebar2").css("display","none");

            });

            $("#csignup").click(function()
            {

                var cont=true;
                temp = act('fname', 'Please enter first name', 'blank');
                if (temp == true) { cont = false; }
                temp = act('lname', 'Please enter last name', 'blank');
                if (temp == true) { cont = false; }
                temp = act('cemail', 'Please enter email', 'E2');
                if (temp == true) { cont = false; }

                temp = act('ccontact', 'Please enter correct number', 'blank');
                if (temp == true) { cont = false; }
                temp = act('pimg', 'Please select profile image', 'blank');
                if (temp == true) { cont = false; }
                temp = act('cfunction', 'Please enter function', 'blank');
                if (temp == true) { cont = false; }
                if(cont==true)
                {
                    $("#uploadclientdata").attr("method", "POST");
                    $("#uploadclientdata").submit();

                    $(".background2").css({'display': 'block'});
                    $('.loader').css({'display': 'block'});
                }

            });

            $("#updateclient").click(function()
            {

                var fname=$("#fname2").val();
                var lname=$("#lname2").val();
                var contact=$("#ccontact2").val();
var clienemail=$("#clientemail2").val();
                var fun=$("#cfunction2").val();

                datastring= {
                    "fname2": fname,
                    "lname2": lname,
                    "ccontact2": contact,
                    "clientemail2":clienemail,
                    "cfunction2": fun

                };

                var updateclient=callajax(datastring, 'updateclientdata',false,'GET');
               // alert(updateclient);

            });



            $('#ppchange').click(function()
            {
                $(".error").css("display","none");
                $(".background2").css("display","block");
                $("#popup").css("display","block");
                var id="popup";
                centerPopup(id);
                loadPopup(id);

                $('#statustxt').html('0%');

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

            $(".edit").click(function () {

                $("#iclientprofile").css("display", "none");
                $("#ieditprofile").css("display", "block");

            });

            $("#distcredit").click(function () {

                $("#icreditoverview").css("display", "none");
                $("#idistcredit").css("display", "block");
               var datastring4= {

                    "email": email
                };

                var clientname=callajax(datastring4, 'bindcorpclientname',false,'GET');
                $("#clientname").append(clientname);

            });

            $("#save").click(function()
            {
                var cont=true;
                temp = act('clientname', 'Please choose client name', 'SEL');
                if (temp == true) { cont = false; }
                temp = act('creditqty', 'Please enter credit qty', 'blank');
                if (temp == true) { cont = false; }

                if(cont==true)
                {
                    var clientid=$("#clientname").val();
                    var creditqty=$("#creditqty").val();

                    var datastring5= {

                        "email": email,
                        "clientid":clientid,
                        "creditqty":creditqty
                    };

                    var distributecredit=callajax(datastring5, 'distributecredit',false,'GET');

                    if(distributecredit=='true')
                    {
                        $("#nmsg").css('display','block');
                        $("#nmsg").html('Credits is distributed to client successfully');
                        setTimeout(function() { $("#nmsg").fadeOut(1500); }, 5000);
                        var availablecredits=callajax(datastring2, 'getavailablecredits',false,'GET');
                        $(".availablecredits").html(availablecredits);
                    }

                    else
                    {
                        $("#nmsg").css('display','block');
                        $("#nmsg").html('insufficient credits ');
                        setTimeout(function() { $("#nmsg").fadeIn().fadeOut(1500); }, 5000);
                    }

                    $("#clientname").val('-Select-');
                    $("#creditqty").val('');
                }


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
            var submitbutton    = $("#updateimg");
            var myform          = $("#updateclientimage");
            var output          = $("#imgmsg");
            var completed       = '0%';

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

                    output.html('');
                    submitbutton.attr('disabled', '');
                    jq5('#changeimg').attr('disabled', 'disabled');
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
                    submitbutton.removeAttr('disabled'); //enable submit button
                    progressbox.slideUp(); // hide progressbar
                    jq5('#changeimg').removeAttr('disabled', 'disabled');
                    jq5('#closepop').removeAttr('disabled', 'disabled');

                    if(imgsrc!='') {
                        jq5("#clientprofileimg").attr("src", imgsrc);

                        output.html(msg);
                    }

                    else
                    {
                        output.html(msg);
                    }


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
                        jq5("#primg").attr("src", imgsrc);

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


  </body>
</html>
