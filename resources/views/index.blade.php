<?php
session_start();
ob_start();
define('APP_ID', '902620203157287');
define('APP_SECRET', '92f2b94b34438ea57255c44aabbdaa59');
define('REDIRECT_URL','http://laravel.yve.ibuildmart.in/public/index.php');

define('CONSUMER_KEY', 'NDW9fDmE2hG50kUg8PNNgn05F');
define('CONSUMER_SECRET', '03qHRrlZwb4IrvyZZ9825izqekxjZ2Jw7Z5VvHZxCM7COQiccu');
define('OAUTH_CALLBACK', 'http://laravel.yve.ibuildmart.in/public/index.php');


$m='';
if(isset($message))
    {
echo $message;
$m=$message;
      }

$fuser_email=Session::get('femail');
$fuser_fname=Session::get('fname');




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
    <script type="text/javascript" src="js/custom.js"></script>

    <script type="text/javascript" src="js/validation.js"></script>

    <script type="text/javascript" src="quickblox/quickblox.min.js"></script>
    <script type="text/javascript" src="quickblox/config.js"></script>
    <script type="text/javascript" src="quickblox/main.js"></script>

    <link rel="stylesheet" href="css/jquery-ui.css" />
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/jquery-ui.js"></script>

    <script>
        var jq=jQuery.noConflict();

        jq(document).ready(

                /* This is the function that will get executed after the DOM is fully loaded */
                function () {
                    jq( "#birthdate" ).datepicker({
                        changeMonth: true,//this option for allowing user to select month
                        changeYear: true, //this option for allowing user to select from year range
                        dateFormat: "mm/dd/yy",
                        yearRange: "1920:2005"
                    });
                }

        );
    </script>

    <script type="text/javascript">
        var active=false;
        var fid='';
        var tid='';
        var menuDisabled='';
        $(document).ready(function()
        {

            var h=$(".rpop").height();
            h=h+60;
            var h2=$(".abright").height();
            $('.lpop img').outerHeight(h);

            var coachdata=callajax('', 'getallcoaches',false,'GET');

            $("#dcoach").html(coachdata);

            var coachcategories=callajax('', 'getcatlist',false,'GET');

            var catarr= JSON.parse(coachcategories);
            var catlist='';
            var catlist2='';
            $.each($(catarr),function(key,value){
                catlist=catlist+"<option value="+value.category_id+">"+value.category_name+"</option>";
                catlist2=catlist2+"<li>"+value.category_name+"</li>";
            });

           $("#coach-category").html(catlist);

            $("#searchdiv ul").html(catlist2);

            var lang_list=callajax('', 'getlanglist',false,'GET');

            var langarr= JSON.parse(lang_list);
            var langlist='';

            $.each($(langarr),function(key,value){
                langlist=langlist+"<option value="+value.lang_id+">"+value.lang_text+"</option>";

            });

            $("#lang").html(langlist);


            var femail="<?php echo $fuser_email;?>";
            var fname="<?php echo $fuser_fname;?>";


            $("#cemail").val(femail);
            $("#fname").val(fname);



            $(".close").click(function()
            {
                $("#slider").fadeOut("fast");
                $(".background2").fadeOut("fast");

            });

            $(".navbar ul>li").click(function()
            {
                $(".error").css("display","none");


            });

            $("#signup2").click(function(e) {



                if( $(this).hasClass("external") ) {

                    return;
                }
                e.preventDefault();
                if (menuDisabled == false) // check the menu is disabled?
                {
                    menuDisabled = true; // disable the menu

                    var name = $(this).attr('href');
                    $('.nav li').removeClass('active');

                    var menuClass = $(this).parent('li'); // .attr('class')
                    $(menuClass).addClass('active');

                    // get image url and assign to backstretch for background
                    var imgSrc = $("img"+name+"-img").attr('src');
                    $.backstretch(imgSrc, {speed: 400}); //backstretch for background fade in/out

                    // content slide in/out
                    $("section.active").animate({left:-$("section.active").outerWidth()}, 300,function(){
                        $(this).removeClass("active");
                        $(this).hide();
                        $(name+"-text").removeClass("inactive");
                        $(name+"-text").css({left:'703px', top:'0px'});
                        $(name+"-text").show();
                        $(name+"-text").animate({left:'0px'}, 300,function(){
                            $(this).addClass("active");

                            //google.maps.event.trigger(map, 'resize'); // resize map
                            $.backstretch("resize"); // resize the background image
                            $(window).resize();

                            menuDisabled = false; // enable the menu
                        });
                    });
                }
                //$('.toggle').removeClass("active");
                return;



            });


            $(".flexslider .slides > li").click(function()
            {
                $(".background2").fadeIn("fast");
                $("#slider").fadeIn("fast");

            });

            $('.searchbar ul>li').click(function()
            {
                $("#searchbox").val($(this).html());
                var txval=$(this).html();
                if(txval!='') {
                    filterdata($.trim(txval));
                }
                else
                {
                    $('.searchbar ul>li').show();
                    $('#dcoach>li').show();
                }

            });

            $("#searchresp").click(function(event)
            {

                $("#searchdiv").css("display", "block");
                $(".searchbar").css({"width": "220px"});
                $(".searchbar").animate({"margin-right": "0", right: "0"});
                $("#searchresp").css("display", "none");
                $("#searchclose").css("display", "block");

            });

            $("#searchclose").click(function(event)
            {



                $("#searchdiv").css("display", "none");
                $(".searchbar").css({"width": "40px"});
                $("#searchclose").css("display", "none");
                $("#searchresp").css("display", "block");
            });

            $("#searchbox").keyup(function()
            {
                var txval=$(this).val();
                if(txval!='') {
                    filterdata(txval);
                }
                else
                {
                    $('.searchbar ul>li').show();
                    $('#dcoach>li').show();
                }
                //$(".searchbar ul li").hide();

            });

            $('input.txt2').on('focus', function() {
                if (!$(this).data('defaultText')) $(this).data('defaultText', $(this).val());
                if ($(this).val()==$(this).data('defaultText')) $(this).val('');
            });

            $('input.txt2').on('blur', function() {
                if ($(this).val()=='') $(this).val($(this).data('defaultText'));
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

            $(".fpwd").click(function()
            {
$(".background2").css("display","block");
                $('#fpopup').fadeIn('500');
                $('#fmessage').html('');

            });

            $("#fsave").click(function()
            {
                var cont=true;
                temp = act('femail', ' Please enter email address', 'E');
                if (temp == true) { cont = false; }

                if(cont==true)
                {
                    var femail=$("#femail").val();


                    data1= {
                        femail: femail

                    };

                    var fdata=callajax(data1, 'sendmailfpwd',false,'GET');
                    $("#fmessage").html("To reset password, Email has been sent to your emailId");
                    $("#femail").val('');
                }

            });


            $("#cemail").blur(function(){
                var cont=true;
                val=$(this).val();
                $("#cmessage1").html("");
                if(val!='')
                {
                    temp = act('cemail', 'Please enter valid email', 'E2');
                    if (temp == true) { cont = false; }
                    if(cont==true)
                    {
                        var cemail=$("#cemail").val();
                        cdata1= {
                            cemail: cemail,
                            ctype: 1
                        };

                        var result=callajax(cdata1, 'chkemail',false,'GET');

                        if(result=='false'){
                            $("#cmessage1").html("Email alredy exists");
                            $("#cemail").val('');
                        }
                        else
                        {
                            $("#cmessage1").html("");
                        }
                    }

                }




            });

            $("#coach-email").blur(function(){
                var cont=true;
                val=$(this).val();
                $("#cmessage2").html("");
                if(val!='')
                {
                    temp = act('coach-email', 'Please enter valid email', 'E2');
                    if (temp == true) { cont = false; }
                    if(cont==true)
                    {
                        var coachemail=$("#coach-email").val();
                        cdata2= {
                            cemail: coachemail,
                            ctype: 2
                        };

                        var result=callajax(cdata2, 'chkemail',false,'GET');

                        if(result=='false'){
                            $("#cmessage2").html("Email alredy exists");
                            $("#coach-email").val('');
                        }
                        else
                        {
                            $("#cmessage2").html("");
                        }
                    }

                }




            });


            $("#co-email").blur(function(){
                var cont=true;
                val=$(this).val();
                $("#cmessage3").html("");
                if(val!='')
                {
                    temp = act('co-email', 'Please enter valid email', 'E2');
                    if (temp == true) { cont = false; }
                    if(cont==true)
                    {
                        var coemail=$("#co-email").val();
                        cdata3= {
                            cemail: coemail,
                            ctype: 3
                        };

                        var result=callajax(cdata3, 'chkemail',false,'GET');

                        if(result=='false'){
                            $("#cmessage3").html("Email alredy exists");
                            $("#co-email").val('');
                        }
                        else
                        {
                            $("#cmessage3").html("");
                        }
                    }

                }




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
                temp = act('cpwd', 'Please enter password', 'blank');
                if (temp == true) { cont = false; }
                temp = act('ccontact', 'Please enter correct number', 'blank');
                if (temp == true) { cont = false; }
                temp = act('cterms', 'Please select the terms &amp; conditions', 'check');
                if (temp == true) { cont = false; }
                if(cont==true)
                {
                    var type='Client';
                    signup(type);
                }

            });

            $("#coachsignup").click(function()
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

                temp = act('coachterms', 'Please select the terms &amp; conditions', 'check');
                if (temp == true) { cont = false; }


                if(cont==true)
                {
                    var type='Coach';
                    signup(type);
                }

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
                temp = act('co-contact', 'Please enter telephone number', 'blank');
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
                temp = act('pimg2', 'Please select profile image', 'blank');
                if (temp == true) { cont = false; }
                temp = act('co-terms', 'Please select the terms &amp; conditions', 'check');
                if (temp == true) { cont = false; }
                if(cont==true)
                {
                    var type='Company';
                    signup(type);
                }

            });


            $("#typeopt").change(function(e) {

                var v=$(this).val();
                h="i"+v+"-content";
                scroldiv(h);
                $('#typeopt').prop('selectedIndex', 0);

            });

            $("#saveprofile").click(function()
            {
                var cont=true;
                temp = act('profile', 'Please enter profile text', 'blank');
                if (temp == true) { cont = false; }
                temp = act('gender', 'Please select gender', 'SEL');
                if (temp == true) { cont = false; }
                temp = act('birthdate', 'Please enter date of birth', 'D');
                if (temp == true) { cont = false; }
                temp = act('lang', 'Please enter language', 'blank');
                if (temp == true) { cont = false; }
                temp = act('pimg', 'Please choose image', 'blank');
                if (temp == true) { cont = false; }

                temp = act('bankname', 'Please enter bank name', 'blank');
                if (temp == true) { cont = false; }

                temp = act('accnumber', 'Please enter account number', 'blank');
                if (temp == true) { cont = false; }


                temp = act('bic', 'Please enter bic', 'blank');
                if (temp == true) { cont = false; }

                if(cont==true)
                {
                    //saveprofile();

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

                   $("#uploadImage").attr("method","post");
                    $("#uploadImage").submit();
                   $(".background2").css({'display': 'block'});
                    $('.loader').css({'display': 'block'});


                    //$("#form").submit();
                }
            });


        });

        function saveprofile()
        {

            var profiletext = $('#profile').html();
            var gender = $('#gender').val();
            var dob = $('#birthdate').val();
            var language = $('#lang').val();
            var pimg=$('#pimg').val();
            var email=$('#coach-email').val();


            $.ajax({
                type: 'POST',
                url: 'saveprofile.php',
                data: {

                    "profiletext": profiletext,
                    "gender": gender,
                    "dob": dob,
                    "language": language,
                    "pimg": pimg,
                    "email":email

                },
                beforeSend: function () {


                    $(".background2").fadeIn("slow");
                    //$('#wait').css({'display': 'block'});
                },
                success: function (result) {

                    alert(result);
                }

            });


        }

        function scroldiv(name)
        {

            name="#"+name;

            if( $(this).hasClass("external") ) {

                return;
            }
            // e.preventDefault();
            if (menuDisabled == false) // check the menu is disabled?
            {

                menuDisabled = true; // disable the menu


                $('.nav li').removeClass('active');

                var menuClass = $(this).parent('li'); // .attr('class')
                $(menuClass).addClass('active');

                // get image url and assign to backstretch for background
                var imgSrc = $("img"+name+"-img").attr('src');
                //$.backstretch(imgSrc, {speed: 400}); //backstretch for background fade in/out

                // content slide in/out
                $("section.active").animate({left:-$("section.active").outerWidth()}, 300,function(){
                    $(this).removeClass("active");
                    $(this).hide();
                    $(name).removeClass("inactive");
                    $(name).css({left:'703px', top:'0px'});
                    $(name).show();
                    $(name).animate({left:'0px'}, 300,function(){
                        $(this).addClass("active");

                        //google.maps.event.trigger(map, 'resize'); // resize map
                        $.backstretch("resize"); // resize the background image
                        $(window).resize();

                        menuDisabled = false; // enable the menu
                    });
                });
            }
        }

        function  filterdata(textval)
        {

            $('.searchbar ul>li').each(
                    function(){
                        var val=$(this).html();

                        val=val.toLowerCase();
                        textval=textval.toLowerCase();

                        if(val.indexOf(textval) === -1)

                        {

                            $(this).hide();


                        }
                        else
                        {

                            $(this).show();
                        }


                    });

            $('#dcoach>li').each(
                    function(){
                        var val=$(this).attr('alt');

                        val=val.toLowerCase();
                        textval=textval.toLowerCase();

                        if(val.indexOf(textval) === -1)

                        {
                            $(this).hide();

                        }
                        else
                        {

                            $(this).show();
                        }


                    });
        }

        function signin() {
            var email = $('#email2').val();
            var pwd = $('#pwd').val();

            var data = {"aemail": email, "apwd": pwd};

            var checkuser = callajax(data, 'signin', false, 'GET');
//alert(checkuser);
            var rarray = checkuser.split("#");

            var status = rarray[0];
            if (rarray[1] != '') {

            var res = rarray[1].split("$");
            var type = res[0];
            var userid = res[1];
            var qblogin = res[2];
            var email = res[3];

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

                if (type == '2') {
                    window.location = "coach";
                }
                if (type == '1') {
                    window.location = "home";
                }

                if (type == '3') {
                    
                    window.location = "company";
                }

                if (type == '4') {
                    window.location = "home";
                }

            }
        }

        function signup(utype) {
            var coachcategory='';
            var fname = $('#fname').val();
            var lname= $('#lname').val();
            var email = $('#cemail').val();
            var pwd= $('#cpwd').val();
            var contact=$('#ccontact').val();
            var compname=$('#co-name').val();
            var addr=$('#co-adr').val();
            var place=$('#co-place').val();
            var compcontact=$('#co-contact').val();
            var compemail=$('#co-email').val();
            var coperson=$('#co-person').val();
            var conumber=$('#co-number').val();
            var vat=$('#co-vat').val();
            var comppwd=$('#co-pwd').val();
            var coachfname = $('#coach-fname').val();
            var coachlname= $('#coach-lname').val();
            var coachemail = $('#coach-email').val();
            var coachpwd= $('#coach-pwd').val();
            var coachcontact=$('#coach-contact').val();

            var insertuser='';
//alert(insertuser);
            var res='';
            var status='';
            var screen='';

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
            //alert(coachcategory);
            var datastring;
            var qbemail;
            if(utype=='Client')
            {
                datastring={

                    "uemail": email,
                    "ufname": fname,
                    "ucontact":contact,
                    "ulname":lname,
                    "upwd":pwd,
                    "utype":'1',
                    "ucomp":'',
                    "uadr":'',
                    "uplace":'',
                    "ucperson":'',
                    "ucmpnumber":'',
                    "uvat":'',
                    "ufbid":fid,
                    "utwid":'',
                    "ucatid":'',
                    "approvalid":'1'


                };

                qbemail=email;

                insertuser=callajax(datastring, 'signup',false,'GET');
//alert(insertuser);
                 res=insertuser.split("#");
                status=res[0];
                 screen=res[1];
            }

            if(utype=='Coach')
            {
                datastring= {
                    "uemail": coachemail,
                    "ufname": coachfname,
                    "ucontact": coachcontact,
                    "ulname":coachlname,
                    "upwd": coachpwd,
                    "utype": '2',
                    "ucomp": '',
                    "uadr": '',
                    "uplace": '',
                    "ucperson":'',
                    "ucmpnumber": '',
                    "uvat": '',
                    "ufbid": '',
                    "utwid": '',
                    "ucatid":coachcategory,
                    "approvalid":'0'
                };

                qbemail=coachemail;
                var insertuser=callajax(datastring, 'signup',false,'GET');
//alert(insertuser);
                var res=insertuser.split("#");
                var status=res[0];
                var screen=res[1];
            }

            if(utype=='Company')
            {
                datastring= {
                    "uemail": compemail,
                    "ufname": '',
                    "ucontact": compcontact,
                    "ulname": '',
                    "upwd": comppwd,
                    "utype": '3',
                    "ucomp": compname,
                    "uadr": addr,
                    "uplace": place,
                    "ucperson": coperson,
                    "ucmpnumber": conumber,
                    "uvat": vat,
                    "ufbid": '',
                    "utwid": '',
                    "ucatid":'',
                    "approvalid":'1'
                };

                qbemail=compemail;
                $("#uploaddata3").submit();
                $("#uploaddata3").attr("method","post");
            }


            $("#tempemail").val(coachemail);
            //$('#wait').css("display","none");
            $(".background2").fadeOut("slow");



            if($.trim(screen)=='insert' && $.trim(status) == 'false') {


                //alert("User already exists");
                $("#fname").val("");
                $("#lname").val("");
                $("#cemail").val("");
                $("#cpwd").val("");
                $('#ccontact').val("");
                $('#co-name').val("");
                $('#co-adr').val("");
                $('#co-adr').val("");
                $('#co-place').val("");
                $('#co-contact').val("");
                $('#co-email').val("");
                $('#co-pwd').val("");
                $('#co-person').val("");
                $('#co-number').val("");
                $('#co-vat').val("");
                $('#coach-fname').val("");
                $('#coach-lname').val("");

                $('#coach-pwd').val("");
                $('#coach-contact').val("");
                $('.multiselect-selected-text').html("None Selected");

            }

            if ($.trim(screen)=='insert' && $.trim(status) == 'true') {
                $("#fname").val("");
                $("#lname").val("");
                $("#cemail").val("");
                $("#cpwd").val("");
                $('#ccontact').val("");
                $('#co-name').val("");
                $('#co-adr').val("");
                $('#co-adr').val("");
                $('#co-place').val("");
                $('#co-contact').val("");
                $('#co-email').val("");
                $('#co-pwd').val("");
                $('#co-person').val("");
                $('#co-number').val("");
                $('#co-vat').val("");
                $('#coach-fname').val("");
                $('#coach-lname').val("");

                $('#coach-pwd').val("");
                $('#coach-contact').val("");
                $('.multiselect-selected-text').html("None Selected");
                if(utype=='Coach')
                {
                    h="iCoach-profile-content";
                    scroldiv(h);
                }
                else
                {
                    window.location = "home";
                }
            }


            if ($.trim(screen)=='update' && $.trim(status) == 'false') {
                $("#fname").val("");
                $("#lname").val("");
                $("#cemail").val("");
                $("#cpwd").val("");
                $('#ccontact').val("");
                $('#co-name').val("");
                $('#co-adr').val("");
                $('#co-adr').val("");
                $('#co-place').val("");
                $('#co-contact').val("");
                $('#co-email').val("");
                $('#co-pwd').val("");
                $('#co-person').val("");
                $('#co-number').val("");
                $('#co-vat').val("");
                $('#coach-fname').val("");
                $('#coach-lname').val("");

                $('#coach-pwd').val("");
                $('#coach-contact').val("");
                $('.multiselect-selected-text').html("None Selected");
                if(utype=='Coach')
                {
                    h="iCoach-profile-content";
                    scroldiv(h);
                }

            }

            if ($.trim(screen)=='registered' && $.trim(status) == 'false') {
                $("#fname").val("");
                $("#lname").val("");
                $("#cemail").val("");
                $("#cpwd").val("");
                $('#ccontact').val("");
                $('#co-name').val("");
                $('#co-adr').val("");
                $('#co-adr').val("");
                $('#co-place').val("");
                $('#co-contact').val("");
                $('#co-email').val("");
                $('#co-pwd').val("");
                $('#co-person').val("");
                $('#co-number').val("");
                $('#co-vat').val("");
                $('#coach-fname').val("");
                $('#coach-lname').val("");

                $('#coach-pwd').val("");
                $('#coach-contact').val("");
                $('.multiselect-selected-text').html("None Selected");
                alert('User already exists');
            }



        }



        function setusername(email,fname,lname,id)
        {

            //window.location.replace("index");
            fid=id;
            data= {

                "aemail": email,
                        "aname": fname
            };
            var result=callajax(data, 'fsignin',false,'GET');

            var rarray = result.split("#");
            var status = rarray[0];
            var data= rarray[1];
var t="true";
            //$('#wait').css("display","none");
            $(".background2").fadeOut("slow");



            if ($.trim(status) == t) {


                var data = {"aemail": email, "afbid": fid};

                var updatefbid = callajax(data, 'fupdate', false, 'GET');

                window.location.replace("home");
            }
            else {

                window.location.replace("index");


            }



        }


        function setusername1(email,name,id)
        {

            //window.location.replace("index");
            tid=id;

            data= {

                "aemail": email,
                "aname": name
            };
            var result=callajax(data, 'tsignin',false,'GET');
            var rarray = result.split("#");
            var status = rarray[0];
            var data= rarray[1];

            //$('#wait').css("display","none");



            if ($.trim(status) == 'false') {

                var narr=name.split(" ");
                var fname=narr[0];
                var lname=narr[1];

                //window.location.replace("index");


            }

            if ($.trim(status) == 'true') {
                var data = {"aemail": email, "atwid": tid};

                //var updatetbid = callajax(data, 'tupdate', false, 'GET');

               //window.location.replace("home");
            }




        }

    </script>


</head>
<body>
<?php
require_once('lib/Facebook/FacebookSession.php');
require_once('lib/Facebook/FacebookRequest.php');
require_once('lib/Facebook/FacebookResponse.php');
require_once('lib/Facebook/FacebookSDKException.php');
require_once('lib/Facebook/FacebookRequestException.php');
require_once('lib/Facebook/FacebookRedirectLoginHelper.php');
require_once('lib/Facebook/FacebookAuthorizationException.php');
require_once('lib/Facebook/FacebookAuthorizationException.php');
require_once('lib/Facebook/GraphObject.php');
require_once('lib/Facebook/GraphUser.php');
require_once('lib/Facebook/GraphSessionInfo.php');
require_once('lib/Facebook/Entities/AccessToken.php');
require_once('lib/Facebook/HttpClients/FacebookCurl.php');
require_once('lib/Facebook/HttpClients/FacebookHttpable.php');
require_once('lib/Facebook/HttpClients/FacebookCurlHttpClient.php');
//require_once('config.php');

//USING NAMESPACES
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;
use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookCurl;

//STARTING SESSION




FacebookSession::setDefaultApplication(APP_ID,APP_SECRET);

$helper = new FacebookRedirectLoginHelper(REDIRECT_URL);


$sess = $helper->getSessionFromRedirect();





if(isset($sess)) {
    //$request  = new FacebookRequest($sess, 'GET', '/me');

    $request = new FacebookRequest(
            $sess, 'GET', '/me?fields=id,gender,email,first_name,last_name'
    );
    $response = $request->execute();
    $graph = $response->getGraphObject(GraphUser::className());
    $fname = $graph->getProperty('first_name');
    $lname = $graph->getProperty('last_name');
    $email = $graph->getProperty('email');
    $id=$graph->getProperty('id');
    $_SESSION["email1"]=$email;
    $_SESSION["fname"]=$fname;
    $_SESSION["lname"]=$lname;
    $_SESSION["id"]=$id;
    //$email=$graph->getBirthday();

    //echo "<script>window.location.replace('http://yve.ibuildmart.in/index.php');</script>";

    if($_SESSION["email1"]!='')
    {

        $email=$_SESSION["email1"];
        $fname=$_SESSION["fname"];
        $lname=$_SESSION["lname"];
        $id1=$_SESSION["id"];


        echo "<script>setusername('".$email."','".$fname."','".$lname."','".$id1."');</script>";

        $uemail=Session::get('uemail');

        if($uemail=='')
            {
echo $uemail;
        echo "<script>$(document).ready(function(){ $('#fname').val('".$fname."'); $('#lname').val('".$lname."'); $('#cemail').val('".$email."'); h='iClient-content';
                scroldiv(h);});</script>";

}

    }
}
else
{

    $_SESSION["email"]='';
    $_SESSION["fname"]='';
    $_SESSION["lname"]='';
    $_SESSION["id"]='';
}

?>

<?php
require_once('lib/twitteroauth/OAuth.php');
require_once('lib/twitteroauth/twitteroauth.php');

if(isset($_GET['oauth_token'])){
    // create a new twitter connection object with request token
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['request_token'], $_SESSION['request_token_secret']);
    // get the access token from getAccesToken method
    $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
    if($access_token){
        // create another connection object with access token
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
        // set the parameters array with attributes include_entities false
        $params =array('include_entities'=>'false');
        // get the data
        $data = $connection->get('account/verify_credentials', array('screen_name'=>'true', 'include_email'=>'true'));
        if($data){
            // store the data in the session
            $_SESSION['data']=$data;
            // redirect to same page to remove url parameters
            $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
            //header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
        }
    }
}

if(!isset($_SESSION['data']) && !isset($_GET['oauth_token'])) {
    // create a new twitter connection object
    $connection = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET);
    // get the token from connection object
    $request_token = $connection->getRequestToken(OAUTH_CALLBACK);
    // if request_token exists then get the token and secret and store in the session
    if($request_token){
        $token = $request_token['oauth_token'];
        $_SESSION['request_token'] = $token ;
        $_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];
        // get the login url from getauthorizeurl method
        $login_url = $connection->getAuthorizeURL($token);

    }
}

?>
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

                        <li><a href="#templatemo-page3" class="gray">Coaches</a></li>
                        <li><a href="#templatemo-page5" class="brown">Sign up</a></li>
                        <li><a href="#templatemo-page5" class="brown">Sign in</a></li>

                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </div>
        <div class="image-section">
            <div class="image-container">

                <img src="images/background.png" id="templatemo-page3-img"  class="main-img inactive" alt="Coaches">
                <img src="images/bg_main.png" id="templatemo-page4-img" class="inactive" alt="Tour">
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
                   <!-- <section id="templatemo-page1-text" class="active">
                        <div class="background2"></div>


                        <div class="col-sm-12 col-md-12" style="margin-top: 20px; padding-left:0;padding-right: 0;">
                            <div class="tleft" >
                                <h2>Choose Success</h2>
                                <p>Everybody that come to planet Earth, came with a unique set of capabilities and intentions. We then found our ways in
                                    different surroundings and along the way some of our intentions & Capabilities came to be forgotten. Or did they?
                                </p><p style="margin-top: 10px">
                                    YVE is here to work at your excellence. Your Personal development to becoming the best version of you in any surrounding.
                                </p><p>
                                    In business settings and for private purposes YVE is your vehicle to excellence. YVE selected the best certified coaches to support you with anything that you are looking to get out of life.
                                </p><p>
                                    YVE is NLP in combination with unique qualities and specialities of our coaches.
                                </p><p style="margin-top: 10px">

                                <p>Personal development</p>
                                <p>Reaching goals</p>
                                <p>Decision making</p>
                                <p>Team management</p>
                                <p>Executive coaching</p>
                                <p>Acquisition/ sales</p>
                                <p>(Self) Presentation</p>
                                <p>Private and Professional relationship</p>
                                <p>Personal Leadership</p>
                                <p>Professional Leadership</p>
                            </div>
                            <div class="tright" align="right">
                                <img src="images/Devices.png" />
                            </div>


                            <div id="slider" class="flexslider">
                                <a class="close"><img src="images/close.png"></a>
                                <ul class="slides">
                                    <li >
                                        <div class="lpop"><img src="images/slide1.png" ></div>
                                        <div class="rpop">
                                            <span>New Technology</span><p style="margin-top: 12px;"></p>
                                            <p>
                                                YVE's platform has been build by Dutch top engineers to provide a world-class experience in personal and professional development.
                                            </p>
                                            <p style="margin-top: 10px;"></p>
                                            <ol>
                                                <li>Quickly find your coach amongst top range professionals, with our Mentality Match, Categories and Filter.</li>
                                                <li>Directly book your coach after reading personalized information and watching short video presentations.</li>
                                                <li>Connect and conduct your sessions from any location through the integrated high definition video conferencing technology.</li>
                                                <li>Read summaries of session on your timeline and enjoy your</p><p>progress.</li>
                                                <li>Intelligent questionnaire post trajectory creates final report.</li>
                                                <li>Integrated credit and payment system.</li>
                                            </ol><p style="margin-top: 10px;"></p>
                                            <p></p>
                                            <p>
                                                Check your account anytime and see your history of used up credits or automated payments of every session.
                                            </p>
                                            <p style="margin-top: 30px;"></p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="lpop"><img src="images/slide2.png" ></div>
                                        <div class="rpop">
                                            <span>World Class Professionals</span><p style="margin-top: 12px;"></p>
                                            <p>
                                                YVE's coaches are all certified by ICF (International Coach Federation) and leading organisations in their countries.</p><p>
                                                In addition to their specialties and schooling YVE coaches</p><p>commit to values that are core to YVE.
                                            </p>

                                            <p style="margin-top: 30px;"></p>

                                            <p>
                                                Valid coaches, ongoingly develop by attending seminars, workshops or courses.
                                            </p>

                                            <p style="margin-top: 20px;"></p>

                                            <p>
                                                YVE's sophisicated technical team is constantly pushing
                                                forward. Youth ICT talents find their ways to YVE to explore their genious in solutions and creativity.
                                            </p>
                                            <p style="margin-top: 30px;"></p>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="lpop"><img src="images/slide3.png" ></div>
                                        <div class="rpop">

                                            <span>Most Client Friendly</span><p style="margin-top: 12px;"></p>
                                            <p>
                                                A Mentality Match and coach information guidance are</p><p>designed to help clients to easily find and connect with a coach</p><p>that matches their requirements and styles.</p><p>
                                                YVE provides her clients with a no cure no pay policy through a</p><p>rating system.
                                            </p>

                                            <p style="margin-top: 20px;"></p>

                                            <p>
                                                Sessions through YVE, work on every bandwidth or</p><p>internet speed, browser and on any device. Clients may reach our</p><p>support desk 24/7.
                                            </p><p style="margin-top: 30px;"></p>

                                        </div>
                                    </li>
                                    <li>
                                        <div class="lpop"><img src="images/slide4.png" > </div>

                                        <div class="rpop">

                                            <span>Quality above all</span><p style="margin-top: 12px;"></p>

                                            <p>
                                                Clients coaching experiences and personal developments are what keep us going. Maintaining and developing the maximum in quality coaching and technology are core tu YVE.
                                            </p>

                                            <p style="margin-top: 20px;"></p>

                                            <p>
                                                The terms at technology are based in the Netherlands and in china, a way to combine design and technology at high performance levels.
                                            </p>

                                            <p style="margin-top: 20px;"></p>

                                            <p>
                                                YVE organises coach meetings for professionals to share knowledge and inspire through intelligent presentations.</p><p>
                                                Clients are welcome to send feedback or any requirement</p><p>they feel YVE should offer.
                                            </p>

                                            <p style="margin-top: 20px;"></p>

                                            <p>
                                                An YVE monitor contracts coaches and clients within 24 hours</p><p>should the occasion rise.
                                            </p><p style="margin-top: 30px;"></p>

                                        </div>

                                    </li>

                                </ul>
                            </div>


                            <div id="carousel" class="flexslider">
                                <ul class="slides">
                                    <li style="width:100px">
                                        <img src="images/thumb/slide1.png" alt="Thumbnail 1"/>
                                    </li>
                                    <li style="width:100px">
                                        <img src="images/thumb/slide2.png" alt="Thumbnail 2"/>
                                    </li>
                                    <li>
                                        <img src="images/thumb/slide3.png" alt="Thumbnail 3"/>
                                    </li>
                                    <li>
                                        <img src="images/thumb/slide4.png" alt="Thumbnail 4"/>
                                    </li>

                                </ul>
                            </div>

                        </div>
                    </section> /.templatemo-page1-text
                    <section id="templatemo-page2-text" class="inactive" style="padding: 0">
                        <div class="col-sm-12 col-md-12" style="margin-top: 20px">
                            <div class="logo2" align="center"><a  href="index.php"><img src="images/logo%20(1).png" height="60px"> </a></div>
                            <div class="about-div">

                                <div class="ableft">

                                    <center> <span>About Yve</span></center><p style="margin-top: 12px;"></p>

                                    <p>YVE is a team of it engineers and professionals in communication and development that has been put together by Yosara Greelings in 2015.</p><p>
                                        YVE's office is based in Amsterdam wherefrom we collaborate with professionals all over the world.</p>

                                    <p style="margin-top: 10px">YVE is a platform that offers everybody a way to discover their excellence.</p>

                                    <p style="margin-top: 10px">The idea for YVE started to form in Yosara's mind in 2007 when her life took her from her hometown Amsterdam in the Netherlands to Malaga in Spain. Yosara wanted to continue to offer her coaching service to her clients in Amsterdam which inspired the idea of creating an online coaching space. Technology wsas not yet ready for Yosara's ideas so her first enterprise gloriously failed.</p>

                                    <p style="margin-top: 10px">Seven years later while ordering her Uber ride and looking at her phone, Yosara realised that the time had come to take up her idea and put it out there. In the passing of those seven years Yosara learned and developed a great deal, she currently teaches her coaching style to other professionals.</p>

                                    <p style="margin-top: 10px">The core of her style is a set of values and beliefs which is the core of YVE.</p>

                                </div>

                                <div class="abright">

                                    <center><span>Values & Beliefs</span></center><p style="margin-top: 12px;"></p>
                                    <ul>
                                        <li>All people have inborn aualities that enable them to
                                            reach goals.</li>

                                        <li>Everybody is unique and everybody has something to offer
                                            to the world.</li>

                                        <li>There is no such thing as failure, there is only
                                            feedback that enables the opportunity or the duty to
                                            develop. If what you do does not work, do something
                                            different.</li>

                                        <li>All humans are in a waay responsible for the responses
                                            that they get, all humans infuence their surroundings with
                                            their communication style.</li>

                                        <li>There is always a positive in the negative.</li>

                                        <li>Forward is the way to go, avoiding behaviou undetermines
                                            possibility and slows down any process.</li>

                                        <li>Pay attention to what is there, rather than to what is
                                            not.</li>

                                        <li>Practice what you teach. </li>

                                    </ul>



                                </div>

                            </div>


                        </div>
                    </section><!-- /.templatemo-page2-text -->
                    <section id="templatemo-page3-text" class="active" style="width: 100%; margin-left:0; padding: 0;">
                        <div class="col-sm-12 col-md-12 col-lg-12" style="padding: 0">

                            <div class="coach-div">

                                <ul id="dcoach" align="center">
                                </ul>

                                <div class="searchbar">
                                    <input type="text" id="searchbox" id="autocomplete">

                                    <div class="labeldiv">
                                        <label id="searchlabel" class="search"></label>
                                        <label id="searchresp" class="search"></label>
                                        <label id="searchclose" class="search"></label>


                                    </div>
                                    <div id="searchdiv" >

                                        <ul >


                                        </ul></div>
                                </div>
                            </div>

                        </div>



                    </section><!--
                    <section id="templatemo-page4-text" class="inactive">

                        <div class="col-sm-12 col-md-12 col-lg-12" id="tr-div" style="margin-top: 20px">



                            <div class="tour-div">

                                <div id="tuleft">

                                    <div><a href=#" class="timg" ><span>What is YVE?</span></a></div>
                                    <div><a href=#" class="timg" ><span>What can I do with YVE ?</span> </a></div>
                                    <div style="margin-bottom:0"> <a href=#" class="timg" ><span>How does YVE work?</span></a></div>

                                </div>

                                <div id="turight">

                                    <div class="tuldiv">

                                        <div style="margin: 4%;"><span>What is YVE?</span>
                                            <p>
                                                YVE's platform has been bulit by Dutch top engineers to provide a world-class experience in personal and professional development.</p>
                                            <ol>
                                                <li>Quickly find your coach amongst top range professionals, with our Mentality Match, Categories and Filter.</li>

                                                <li>Directly book your coach after reading personalized information and watching short video presentations.</li>

                                                <li>Connect and conduct your sessions from any location through the inmtegrated high definition video conferencing technology.</li>
                                                <li>Read summaries of session on your time line and your progress.</li>
                                                <li>Intelligent questionnaire post trajectory creates finaal report.</li>
                                                <li>Integrated credit and payment system.</li>
                                            </ol>
                                            <p>Check your account any time and see your history of used up credits or automated payments of every session.</p>

                                        </div>
                                        <div class="lsign">Let's sign up</a></div>
                                    </div>

                                    <div class="turdiv">
                                        <img src="images/iphone_img.png">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section><!-- /.templatemo-page4-text -->

                    <section id="templatemo-page5-text" class="inactive" style="width: 100%; margin-left:0; padding: 0;">

                        <div class="col-sm-12 col-md-12 col-lg-12" style="width:100%; padding: 0;height: 100%;" >
                            <div class="background2" style="display: none"></div>
                            <div id="fpopup" class="popup" style=" margin-left:36%; margin-top: 10%;z-index: 999999;background-color: #525150;">

                                    <div class="border" style=" background-color: #525150;margin-bottom:20px;height:20px">
                                        <a id="closepop" class="closepop">x</a></div>
                                    <div id="wrapper" class="wrapper1" align="center" style="padding-top: 0">

                                        <div align="left"><span style="margin-left:10%; font-size:19px;letter-spacing:1px;color:#fff; text-align:left">Enter Email</span><p style="margin:10px"></div></p>

                                        <p style="margin:20px"></p>
                                        <div align="center">
                                            <div  style="position: relative;height: 56px; margin-bottom: 10px;">

                                            <input type="text" class="txt2" value="Email Address" alt="Email Address" id="femail" ><p style="margin-bottom: 10px;"></p>
                                        </div>

                                            <div>

                                                <input type="button" id="fsave" value="Submit"></p>

                                                </div>

                                            </div>


                                        <div id="fmessage" style="color:#fff; width:201px; margin-top:10px"></div>
                                    </div>

                            </div>

                            <div class="signin-div" align="center">


                                <div style="min-height: 290px;width:100%; height: auto "><div class="sileft" align="center">
                                        <h3>Sign In</h3></p>

                                        <div class="sidiv" align="center">
                                            <div style="position: relative;height: 56px; margin-bottom: 10px; ">
                                                <input type="text" class="txt2" value="Email Address" alt="Email" id="email2"></p></div>

                                            <div style="position: relative;height: 56px; margin-bottom: 10px;">
                                                <input type="password" class="txt2" value="Password" alt="Password" id="pwd" ></p>
                                            </div>

                                            <input type="button" id="signin2" value="SIGN IN"></p>
                                            <a class="fpwd">Forgot Password?</a>


                                        </div>
                                    </div>

                                    <div class="siright" align="center">
                                        <h3>Sign Up</h3></p>


                                        <p>YVE is a team of it engineers and professionals in communication and development that has been put together by Yosara Greelings in 2015.
                                            YVE's office is based in Amsterdam wherefrom we collaborate with professionals all over the world</p>

                                        <a id="signup2" href="#templatemo-page6">CREATE ACCOUNT</a>


                                    </div>
                                </div>
                                <div class="sifooter">
                                    <span>Or connect with</span>
                                    <div class="sologin">

                                        <div id="flogin"><a  target="_blank" href='<?php echo $helper->getLoginUrl(array('email'));?>'><img src="images/facebook.png" target="_blank"> FACEBOOK</a></div>
                                        <div id="tlogin">
                                            <?php
                                            if(isset($login_url) && !isset($_SESSION['data'])){
                                                // echo the login url
                                                echo "<a href='$login_url'><img src='images/twitter.png'>TWITTER</a>";
                                            }
                                            else {
                                                echo "<a href='#templatemo-page2'><img src='images/twitter.png'>TWITTER</a>";
                                                $data = $_SESSION['data'];

                                                $name1=$data->name;
                                                $id1=$data->id;
                                                $email1=$data->email;

                                                $narr=explode(' ',$name1);
                                                $fname=$narr[0];
                                                $lname=$narr[1];

                                                echo "<script>setusername1('".$email1."','".$name1."','".$id1."');</script>";

                                                echo "<script>$(document).ready(function(){ $('#fname').val('".$fname."'); $('#lname').val('".$lname."'); $('#cemail').val('".$email1."');  h='iClient-content';
                    scroldiv(h);$('#templatemo-page1-img').removeClass('main-img');$('#templatemo-page6-img').addClass('main-img');
});</script>";
                                            }

                                            ?>
                                    </div>

                                </div>


                            </div>

                        </div>

                    </section><!-- /.templatemo-page5-text -->


                    <section id="templatemo-page6-text" class="inactive" style="width: 100%; margin-left:0; padding: 0;">
                        <div class="col-sm-12 col-md-12 col-lg-12" style="width:100%; padding: 0;height: 100%;">


                            <div class="usertyp-div" align="center">



                                <div class="usleft" align="center">
                                    <h3>Would you like to sign up as :</h3></p>
                                    <select id="typeopt">

                                        <option value="-Select-" alt="-Select-">-Select-</option>
                                        <option value="Client"  alt="templatemo-page7-text">Client</option>
                                        <option value="Coach" alt="Coach">Coach</option>
                                        <option value="Company" alt="Company">Company</option>

                                    </select></p>
                                </div>

                                <div class="usright" align="center">
                                    <img src="images/iphone_img.png">

                                </div>
                            </div>


                        </div>

                    </section>

                    <section id="iClient-content" class="inactive" style="width: 100%; margin-left:0; padding: 0;min-height:500px;">

                        <div class="col-sm-12 col-md-12 col-lg-12" style="width:100%; padding: 0;height: 100%;">


                            <div class="clientsignup" align="center">

                                <h4>Join us with your Client Account</h4></p>

                                <div id="cldivmain" align="center" >

                                    <div class="cldiv" align="left">
                                        <label>First Name*</label></p>
                                        <input type="text" class="txt3" id="fname" >
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Last Name</label></p>
                                        <input type="text" class="txt3"  id="lname">
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Email</label></p>
                                        <input type="text" class="txt3" id="cemail">
                                        <div id="cmessage1" style="color:#fff; margin-top:-15px;"></div>
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Password</label></p>
                                        <input type="password" class="txt3" id="cpwd">
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Telephone Number</label></p>
                                        <input type="text" class="txt3" id="ccontact">
                                    </div>

                                    <div class="cldiv" align="left" style="height: 65px; width:50%;">
                                        <label style="color:#ddd;"><input type="checkbox" id="cterms" style="height:15px; width:15px; vertical-align: sub;"> &nbsp;&nbsp;I agree with the <a style="color:#6FA6D6;" href="http://yve.today/algemene-voorwaarden/" TARGET="_blank">Terms &amp; Conditions</a></label></p>
                                    </div>

                                    <div class="cldiv" align="left" style="height: 65px; width:50%;">

                                    </div>


                                    <div class="cldiv" align="left">
                                        <input type="button" id="csignup" value="Sign Up">

                                    </div>

                                    <div class="cldiv" align="left" style="height: 61px; width:50%;">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </section>

                    <section id="iCoach-content" class="inactive" style="width: 100%; margin-left:0; padding: 0;height: auto;">

                        <div class="col-sm-12 col-md-12 col-lg-12" style="width:100%; padding: 0;height: 100%;">


                            <div class="clientsignup" align="center" style="min-height: 515px;  height: auto; overflow-y:auto">

                                <h4>Join us with your Coach Account</h4></p>

                                <div id="cldivmain" align="center" >

                                    <div class="cldiv" align="left">
                                        <label>First Name*</label></p>
                                        <input type="text" class="txt3" id="coach-fname" >
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Last Name</label></p>
                                        <input type="text" class="txt3"  id="coach-lname">
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Email</label></p>
                                        <input type="text" class="txt3" id="coach-email" name="coach-email">
                                        <div id="cmessage2" style="color:#fff; margin-top:-15px;"></div>
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Password</label></p>
                                        <input type="password" class="txt3" id="coach-pwd">
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Telephone Number</label></p>
                                        <input type="text" class="txt3" id="coach-contact" >
                                    </div>



                                    <!--   <div class="cldiv" align="left" style="height: 65px">
                                           <label >Category</label><p></p>
                                           <div id="catlabel"><select id="coach-category" > </select></div>

                                       </div>-->

                                    <div class="cldiv" align="left" style="height: 65px">
                                        <label >Category</label><p></p>
                                        <div id="catlabel" style="width:100%"><select id="coach-category" multiple="multiple"> </select></div>

                                    </div>

                                    <div class="cldiv" align="left" style="height: 65px; width:50%;">
                                        <label style="color:#ddd;"><input type="checkbox" id="coachterms" style="height:15px; width:15px; vertical-align: sub;"> &nbsp;&nbsp;I agree with the <a style="color:#6FA6D6;" href="http://yve.today/algemene-voorwaarden/" TARGET="_blank">Terms &amp; Conditions</a></label></p>
                                    </div>

                                    <div class="cldiv" align="left" >
                                        <input type="button" id="coachsignup" value="Sign Up">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </section>

                    <section id="iCoach-profile-content" class="inactive" style="width: 100%; margin-left:0; padding: 0;">

                        <div class="background2" style="display: none"></div>
                        <div class="loader"><img src="images/status.gif" border="0" > </div>
                        <div id="popup" class="popup">
                            <form method="post" name="uploadvideo" id="uploadvideo" action="{{ url('uploadvideo') }}">
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

                        <div class="col-sm-12 col-md-12 col-lg-12" style="width:100%; padding: 0;height: 100%;">

                            <form id='uploadImage'  method='get' enctype='multipart/form-data' action="{{ url('uploadimgdata') }}">
                                <div class="clientsignup" align="center" style="min-height: 620px; margin-bottom: 20px;">

                                    <h4>Please Enter Your Profile Information</h4></p>

                                    <div id="cldivmain" align="center" >



                                        <div class="cldiv" align="left">
                                            <label>DOB</label></p>
                                            <input type="text" class="txt3" id="birthdate" name="birthdate">
                                        </div>

                                        <div class="cldiv" align="left">
                                            <label>Gender</label></p>
                                            <select class="txt3" id="gender" name="gender">
                                                <option value="-Select-">-Select-</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>



                                        <div class="cldiv" align="left">
                                            <label>Language</label></p>
                                            <div id="langlabel" style="width:100%"> <select id="lang" multiple="multiple" name="language"> </select></div>

                                        </div>

                                        <div class="cldiv" align="left">
                                            <label>Profile Information*</label></p>
                                            <textarea class="txt3" id="profile" style="resize:vertical; max-height: 200px" name="profile"></textarea>
                                        </div>

                                        <div class="cldiv" align="left" style="height:90px">
                                            <label>profile image</label></p>
                                            <input type='file' name='photo' id="pimg"  />
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

                                        <div class="cldiv" align="left">
                                            <input type="button" id="saveprofile" value="Save">

                                        </div>

                                        <input type='text' name='tempemail' id="tempemail" style="display: none" />

                                        <input type="hidden" id="lang_selected" name="lang_selected">

                                        <span id='msg' style="margin-top: 140px; color:#fff; font-size: 13px; float:none"></span>

                                    </div>

                                </div>
                            </form>


                            <!-- including upload.js script -->

                        </div>

                    </section>

                    <section id="iCompany-content" class="inactive" style="width: 100%; margin-left:0; padding: 0;min-height:655px">

                        <div class="col-sm-12 col-md-12 col-lg-12" style="width:100%; padding: 0;height: 100%;">

                            <div class="clientsignup" align="center" style="min-height: 620px; margin-bottom: 20px;">

                                <h4>Join us with your Company Account</h4></p>
                                <form id='uploaddata3'  method='POST' enctype='multipart/form-data' action="{{ url('uploaddata3') }}">

                                <div id="cldivmain" align="center" >

                                    <div class="cldiv" align="left">
                                        <label>Company Name*</label></p>
                                        <input type="text" class="txt3" id="co-name" name="co-name">
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Address</label></p>
                                        <textarea class="txt3" id="co-adr" name="co-adr"></textarea>
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Place</label></p>
                                        <input type="text" class="txt3" id="co-place" name="co-place">
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Telephone Number</label></p>
                                        <input type="text" class="txt3" id="co-contact" name="co-contact">
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Email</label></p>
                                        <input type="text" class="txt3" id="co-email" name="co-email">
                                        <div id="cmessage3" style="color:#fff; margin-top:-15px;"></div>
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Password</label></p>
                                        <input type="password" class="txt3" id="co-pwd" name="co-pwd">
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Contact Person</label></p>
                                        <input type="text" class="txt3" id="co-person" name="co-person">
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Company Number</label></p>
                                        <input type="text" class="txt3" id="co-number" name="co-number">
                                    </div>

                                    <div class="cldiv" align="left">
                                        <label>Vat Number</label></p>
                                        <input type="text" class="txt3" id="co-vat" name="co-vat">
                                    </div>

                                    <div class="cldiv" align="left" style="height: 84px">
                                        <label>profile image*</label></p>

                                        <input type='file' name='photo2' id="pimg2" />
                                        <span style="color:#fff;">Image size is only 5 mb  allowed</span>
                                    </div>

                                    <div class="cldiv" align="left" style="height: 65px; width:50%; margin-top:0px">
                                        <label style="color:#ddd;"><input type="checkbox" id="co-terms" style="height:15px; width:15px; vertical-align: sub;"> &nbsp;&nbsp;I agree with the <a style="color:#6FA6D6;" href="http://yve.today/algemene-voorwaarden/" TARGET="_blank">Terms &amp; Conditions</a></label></p>
                                    </div>

                                    <div class="cldiv" align="left">
                                        <input type="button" id="cosignup" value="Sign Up">

                                    </div>

                                    <div class="cldiv" align="left" style="height: 65px; width:50%;">

                                    </div>

                                </div>
</form>
                            </div>
                        </div>

                    </section>



                </div><!-- /.templatemo-content -->
            </div><!-- /.templatemo-content-wrapper -->
        </div><!-- /.row -->

    </div>
</div> <!-- /.container -->
</div><!-- /#main-wrapper -->

<!--<div id="preloader">
    <div id="status">&nbsp;</div>
</div><!-- /#preloader -->

<script src="js/jquery.min.js"></script>
<script src="js/jquery.backstretch.min.js"></script>
<script src="js/jquery.flexslider.min.js"></script>

<script src="js/templatemo_script.js"></script>
<script type="text/javascript" src="js/bootstrap2.min.js"></script>

<link href="css/bootstrap2.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" >
<script type="text/javascript " src="js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="js/jquery.form.min.js"></script>


<script type="text/javascript">
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
            $(".error").css("display","none");
            $(".background2").css("display","block");

            var id="popup";
            centerPopup(id);
            loadPopup(id);
            $('#statustxt').html('0%');
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

                var r=response.responseText;
                var r1= r.split("#");

                output.html(r1[0]); //update element with received data
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