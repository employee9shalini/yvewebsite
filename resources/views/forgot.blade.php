<?php
$email='';
$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
$iv = mcrypt_create_iv($iv_size, MCRYPT_DEV_URANDOM);
$key = "yve12";
$key_size =  strlen($key);

if (isset($_REQUEST['email'])) {

    $email=$_REQUEST['email'];

    $ciphertext_dec = base64_decode($email);



# retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
    //$iv_dec = substr($ciphertext_dec, 0, $iv_size);

# retrieves the cipher text (everything except the $iv_size in the front)
   // $ciphertext_dec = substr($ciphertext_dec, $iv_size);

    # may remove 00h valued characters from end of plain text
    //$plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key,
            //$ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);

    $plaintext_dec=$ciphertext_dec;
}



?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title>YVE</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!-- 
    Authentic Template 
    http://www.templatemo.com/preview/templatemo_412_authentic 
    -->
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/templatemo_main.css">

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/validation.js"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            var emailid="<?php echo $plaintext_dec?>";
            var e= $.trim(emailid);

            $("#reset").click(function()
            {
                var cont=true;
                if($("#cpwd").val()!='')
                {
                    $(".error").css("display","none");
                    temp = act('pwd', 'Please enter password', 'blank');
                    if (temp == true) { cont = false; }
                    temp = act('cpwd', 'password does not match', 'pw');
                    if (temp == true) { cont = false; }
                }
                else
                {
                    $(".error").css("display","none");
                    temp = act('pwd', 'Please enter password', 'blank');
                    if (temp == true) { cont = false; }

                    temp = act('cpwd', 'please enter confirm password', 'blank');
                    if (temp == true) { cont = false; }

                }


                if(cont==true)
                {

                    var pwd=$("#pwd").val();
                    var cpwd=$("#cpwd").val();



                    $.ajax({
                        type: 'GET',
                        url: 'reset',
                        data: {
                            "email":emailid,
                            "pwd": pwd

                        },

                        success: function (result) {

                            if (!alert('Password reset Successfully. Please Login with new password')) {

                                $("#pwd").val('');
                                $("#cpwd").val('');
                                window.location = "index";
                            }


                        }

                    });

                }

            });

        });

    </script>



</head>
<body>

<div id="main-wrapper">
    <!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a rel="nofollow" href="http://browsehappy.com">upgrade your browser</a> or <a rel="nofollow" href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->

    <div class="container">
        <!-- Static navbar -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <a class="logo">sdsd</a>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" >
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse" id="mdiv">

                    <ul class="nav navbar-nav">


                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </div>
        <div class="image-section">
            <div class="image-container">
                <img src="images/woman.png" id="templatemo-page1-img" class="main-img inactive" alt="Home">
                <img src="images/woman.png" id="templatemo-page2-img" class="inactive" alt="About">
                <img src="images/woman.png" id="templatemo-page3-img"  class="inactive" alt="Coaches">
                <img src="images/woman.png" id="templatemo-page4-img" class="inactive" alt="Tour">
                <img src="images/woman.png" id="templatemo-page5-img" class="inactive" alt="Sign up">
                <img src="images/woman.png" id="templatemo-page6-img" class="inactive" alt="Sign in">
                <!-- <img src="images/woman.png" id="iClient-content" class="inactive" alt="Sign up">
                 <img src="images/woman.png" id="iCoach-content" class="inactive" alt="Sign up">
                 <img src="images/woman.png" id="iCompany-content" class="inactive" alt="Sign up">-->

            </div>
        </div>

        <!--<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="templatemo-site-title">
                    <h1 class="site-name"><a href="#">Authentic</a></h1>
                    <h2 class="slogon">by <a href="#">templatemo</a></h2>
                </div>
            </div>
        </div>-->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 templatemo-content-wrapper">

                <div class="templatemo-content" >
                    <section id="templatemo-page1-text" class="active">
                        <div class="clientsignup" align="center" style="min-height: 515px;  height: auto">

                            <h4>Enter your new password</h4></p>

                            <div id="cldivmain" align="center" >

                                <div class="cldiv" align="left" style="width: 100%">
                                    <label>New Password*</label></p>
                                    <input type="password" class="txt3" id="pwd" style="width: 40%">
                                </div>

                                <div class="cldiv" align="left" style="width: 100%">
                                    <label>Confirm Password*</label></p>
                                    <input type="password" class="txt3"  id="cpwd" style="width: 40%">
                                </div>


                                <div class="cldiv" align="left" style="margin-top: 0px;">
                                    <input type="button" id="reset" value="Reset">

                                </div>

                            </div>

                        </div>

                    </section><!-- /.templatemo-page1-text -->


                </div><!-- /.templatemo-content -->
            </div><!-- /.templatemo-content-wrapper -->
        </div><!-- /.row -->


    </div>
</div> <!-- /.container -->
</div><!-- /#main-wrapper -->





<script src="js/jquery.min.js"></script>
<script src="js/jquery.backstretch.min.js"></script>
<script src="js/jquery.flexslider.min.js"></script>

<script src="js/templatemo_script.js"></script>
<script type="text/javascript" src="js/bootstrap2.min.js"></script>

<link href="css/bootstrap2.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" >
<script type="text/javascript " src="js/bootstrap-multiselect.js"></script>



</body>
</html>
