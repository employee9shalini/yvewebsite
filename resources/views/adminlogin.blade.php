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

    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/templatemo_main.css">

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script type="text/javascript" src="js/validation.js"></script>

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

                </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </div>
        <div class="image-section">
            <div class="image-container">
                <img src="images/woman.png" id="templatemo-page1-img" class="main-img inactive" alt="Home">

            </div>
        </div>


        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 templatemo-content-wrapper">

                <div class="templatemo-content" >


                    <section id="templatemo-page1-text" class="active" style="width: 100%; margin-left:0; padding: 0;">

                        <div class="col-sm-12 col-md-12 col-lg-12" style="width:100%; padding: 0;height: 100%;">


                            <div class="signin-div" align="center" style="width:30%;margin-left:35%;padding-top:25px;min-height: 370px">


                                <div style="min-height: 290px;width:100%; height: auto ">
                                        <h3 style="margin-bottom: 25px;color: #ffffff">Sign In</h3></p>

                                        <div class="sidiv" align="center">
                                            <div style="position: relative;height: 56px; margin-bottom: 10px; ">
                                                <input type="text" class="txt2" value="Email Address" alt="Email" id="email2"></p></div>

                                            <div style="position: relative;height: 56px; margin-bottom: 10px;">
                                                <input type="password" class="txt2" value="Password" alt="Password" id="pwd" ></p>
                                            </div>

                                            <input type="button" id="signin2" value="SIGN IN"></p>




                                    </div>

                                </div>

                            </div>

                        </div>

                    </section><!-- /.templatemo-page5-text -->

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

<script type="text/javascript">

    $(document).ready(function() {

        $('input.txt2').on('focus', function () {
            if (!$(this).data('defaultText')) $(this).data('defaultText', $(this).val());
            if ($(this).val() == $(this).data('defaultText')) $(this).val('');
        });


        $('input.txt2').on('blur', function () {
            if ($(this).val() == '') $(this).val($(this).data('defaultText'));
        });

        $('#email2').keypress(function(e){

            if(e.keyCode==13)
                $('#signin2').click();

        });

        $('#pwd').keypress(function(e){
            if(e.keyCode==13)
                $('#signin2').click();
        });

        $('#signin2').click(function()
        {
            var cont=true;
            temp = act('email2', 'Please enter email', 'E');
            if (temp == true) { cont = false; }
            temp = act('pwd', 'Please enter password', 'P');
            if (temp == true) { cont = false; }
            if(cont==true)
            {
                signin();
            }

        });


    });

    function signin() {
        var email = $('#email2').val();
        var pwd = $('#pwd').val();

        var data = {"aemail": email, "apwd": pwd};

        var checkuser = callajax(data, 'adminsignin', false, 'GET');
//alert(checkuser);
        var rarray = checkuser.split("#");

        var status = rarray[0];
        if (rarray[1] != '') {

            var res = rarray[1].split("$");
            var type = res[0];
            var uid = res[1];
            var email = res[2];
        }

        //$('#wait').css("display","none");


        if ($.trim(status) == 'false') {

            alert("Invalid Login Username or Password");
            $("#email2").val("Email Address");
            $("#pwd").val("Password");

        }

        if ($.trim(status) == 'true') {
            $("#email2").val("Email Address");
            $("#pwd").val("Password");

            window.location = "admin";


        }

    }

</script>



</body>
</html>