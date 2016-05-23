// Init QuickBlox application here
//
var mediaParams, caller, callee;

QB.init(QBApp.appId, QBApp.authKey, QBApp.authSecret);
var uploadPages = 0;
var filesCount = 0;
var finished = false;

$(document).ready(function() {

  // First of all create a session and obtain a session token
  // Then you will be able to run requests to Users
  //
  QB.createSession(function(err,result){

    console.log('Session create callback', err, result);
  });



  // Init Twitter Digits
  //

  //var digitsKey = 'uH2aUsd3BP0qLpTezVnqXyZAk';
    var digitsKey= 'nrqC22LFtRtxASymx8vH';

  $('#digits-sdk').load(function () {
    Digits.init({ consumerKey: digitsKey })
      .done(function() {
        console.log('Digits initialized.');
      })
      .fail(function(error) {
        console.log('Digits failed to initialize: ' + JSON.stringify(error));
      });

    // Login user twitter digits
    $('#sign_in_twitter_digits').on('click', function() {
      Digits.logIn()
        .done(function(loginResponse) {

          var params = {
            provider: 'twitter_digits',
            twitter_digits: loginResponse.oauth_echo_headers
          };

          // login with twitter_digits params
          QB.login(params, function(err, user){
            if (user) {
              $('#output_place').val(JSON.stringify(user));
            }else{
              $('#output_place').val(JSON.stringify(err));
            }
          });

        })
        .fail(function(error) {
          console.log('Digits failed to login: ' + JSON.stringify(error));
        });
    });
  });

  // Create user
  //
  $('#sign_up').on('click', function() {
    var login = $('#usr_sgn_p_lgn').val();
    var password = $('#usr_sgn_p_pwd').val();

    var params = { 'login': login, 'password': password};

    QB.users.create(params, function(err, user){
      if (user) {
        $('#output_place').val(JSON.stringify(user));
      } else  {
        $('#output_place').val(JSON.stringify(err));
      }

      $("#progressModal").modal("hide");

      $("html, body").animate({ scrollTop: 0 }, "slow");
    });
  });


  // Login user
  //
  $('#sign_in').on('click', function() {
    var login = $('#usr_sgn_n_lgn').val();
    var password = $('#usr_sgn_n_pwd').val();

    var params = { 'login': login, 'password': password};

    QB.login(params, function(err, user){
      if (user) {
        $('#output_place').val(JSON.stringify(user));
      } else  {
        $('#output_place').val(JSON.stringify(err));
      }

      $("#progressModal").modal("hide");

      $("html, body").animate({ scrollTop: 0 }, "slow");
    });
  });

  // Login user with social provider
  //
  $('#sign_in_social').on('click', function() {

    var provider = $('#usr_sgn_n_social_provider').val();
    var token = $('#usr_sgn_n_social_token').val();
    var secret = $('#usr_sgn_n_social_secret').val();

    var params = { 'provider': provider, 'keys[token]': token, 'keys[secret]': secret};

    QB.login(params, function(err, user){
      if (user) {
        $('#output_place').val(JSON.stringify(user));
      } else  {
        $('#output_place').val(JSON.stringify(err));
      }

      $("#progressModal").modal("hide");

      $("html, body").animate({ scrollTop: 0 }, "slow");
    });
  });

  // Logout user
  //
  $('#sign_out').on('click', function() {
     QB.logout(function(err, result){
      if (result) {
        $('#output_place').val(JSON.stringify(result));
      } else  {
        $('#output_place').val(JSON.stringify(err));
      }

      $("#progressModal").modal("hide");

      $("html, body").animate({ scrollTop: 0 }, "slow");
    });
  });

  // Get users
  //
  $('#get_by').on('click', function() {
    var filter_value = $('#usrs_get_by_filter').val();
    var filter_type = $("#sel_filter_for_users option:selected").val();

    var params;

    var request_for_many_user = false;

    switch (filter_type) {
      // all users, no filters<
      case "1":
        params = { page: '1', per_page: '100'};
        request_for_many_user = true;
        break;

      // by id
      case "2":
        params = parseInt(filter_value);
        break;

      // by login
      case "3":
        params = {login: filter_value};
        break;

      // by fullname
      case "4":
        params = {full_name: filter_value};
        break;

      // by facebook id
      case "5":
        params = {facebook_id: filter_value};
        break;

      // by twitter id
      case "6":
        params = {twitter_id: filter_value};
        break;

      // by email
      case "7":
        params = {email: filter_value};
        break;

      // by tags
      case "8":
        params = {tags: filter_value};
        break;

      // by external id
      case "9":
        params = {external: filter_value};
        break;

      // custom filters
      case "10":
        // More info about filters here
        // http://quickblox.com/developers/Users#Filters
        params = {filter: { field: 'login', param: 'in', value: ["sam33","ivan_gram"] }};
        request_for_many_user = true;
        break;
    }

    console.log("filter_value: " + filter_value);

    if(request_for_many_user){
      QB.users.listUsers(params, function(err, result){
        if (result) {
          $('#output_place').val(JSON.stringify(result));
        } else  {
          $('#output_place').val(JSON.stringify(err));
        }

        console.log("current_page: " + result.current_page);
        console.log("per_page: " + result.per_page);
        console.log("total_entries: " + result.total_entries);
        console.log("count: " + result.items.length);

        $("#progressModal").modal("hide");

        $("html, body").animate({ scrollTop: 0 }, "slow");
      });
    }else{
      QB.users.get(params, function(err, user){
        if (user) {
          $('#output_place').val(JSON.stringify(user));
        } else  {
          $('#output_place').val(JSON.stringify(err));
        }

        $("#progressModal").modal("hide");

        $("html, body").animate({ scrollTop: 0 }, "slow");
      });
    }
  });

  // Update user
  //
  $('#update').on('click', function() {
    var user_id = $('#usr_upd_id').val();
    var user_fullname = $('#usr_upd_full_name').val();

    QB.users.update(parseInt(user_id), {full_name: user_fullname}, function(err, user){
      if (user) {
        $('#output_place').val(JSON.stringify(user));
      } else  {
        $('#output_place').val(JSON.stringify(err));
      }

      $("#progressModal").modal("hide");

      $("html, body").animate({ scrollTop: 0 }, "slow");
    });
  });

  // Delete user
  //
  $('#delete_by').on('click', function() {
    var user_id = $('#usr_delete_id').val();
    var operation_type = $("#sel_filter_for_delete_user option:selected").val();

    var params;

    switch (operation_type) {
      // delete by id
      case "1":
        params = parseInt(user_id);
        break;

      // delete by external id
      case "2":
        params = {external: user_id};
        break;
    }

    QB.users.delete(params, function(err, user){
      if (user) {
        $('#output_place').val(JSON.stringify(user));
      } else  {
        $('#output_place').val(JSON.stringify(err));
      }

      $("#progressModal").modal("hide");

      $("html, body").animate({ scrollTop: 0 }, "slow");
    });
  });

    $('#videocall').on('click', function() {

        if(callee == null){
            alert('Please choose a user to call');
            return;
        }

        var mediaParams = {
            audio: true,
            video: true,
            elemId: 'localVideo',
            options: {
                muted: true,
                mirror: true
            }
        };

        callWithParams(mediaParams, false);
    });


    $('#accept').on('click', function() {
        $('#incomingCall').modal('hide');
        $('#ringtoneSignal')[0].pause();

        QB.webrtc.getUserMedia(mediaParams, function(err, stream) {
            if (err) {
                //console.log(err);

                var deviceNotFoundError = 'Devices are not found';
                updateInfoMessage(deviceNotFoundError);


                QB.webrtc.reject(callee.id, {'reason': deviceNotFoundError});
            } else {
                $('.btn_mediacall, #hangup').removeAttr('disabled');
                $('#audiocall, #videocall').attr('disabled', 'disabled');

                QB.webrtc.accept(callee.id);
            }
        });
    });


    // Reject
    //
    $('#reject').on('click', function() {
        $('#incomingCall').modal('hide');
        $('#ringtoneSignal')[0].pause();

        if (typeof callee != 'undefined'){
            QB.webrtc.reject(callee.id);
        }
    });


    // Hangup
    //
    $('#hangup').on('click', function() {
        if (typeof callee != 'undefined'){
            QB.webrtc.stop(callee.id);
        }
    });




    // Reset email
  //
  $('#reset').on('click', function() {
    var user_email = $('#usr_rst_email').val();

    QB.users.resetPassword(user_email, function(err, user){
      if (user) {
        $('#output_place').val(JSON.stringify(user));
      } else  {
        $('#output_place').val(JSON.stringify(err));
      }

      $("#progressModal").modal("hide");

      $("html, body").animate({ scrollTop: 0 }, "slow");
    });
  });
});

QB.webrtc.onSessionStateChangedListener = function(newState, userId) {
    console.log("onSessionStateChangedListener: " + newState + ", userId: " + userId);

    // possible values of 'newState':
    //
    // QB.webrtc.SessionState.UNDEFINED
    // QB.webrtc.SessionState.CONNECTING
    // QB.webrtc.SessionState.CONNECTED
    // QB.webrtc.SessionState.FAILED
    // QB.webrtc.SessionState.DISCONNECTED
    // QB.webrtc.SessionState.CLOSED

    if(newState === QB.webrtc.SessionState.DISCONNECTED){
        if (typeof callee != 'undefined'){
            QB.webrtc.stop(callee.id);
        }
        hungUp();
    }else if(newState === QB.webrtc.SessionState.CLOSED){
        hungUp();
    }
};

QB.webrtc.onCallListener = function(userId, extension) {


    console.log("onCallListener. userId: " + userId + ". Extension: " + JSON.stringify(extension));

    mediaParams = {
        audio: true,
        video: extension.callType === 'video' ? true : false,
        elemId: 'localVideo',
        options: {
            muted: true,
            mirror: true
        }

    }
};

QB.webrtc.onAcceptCallListener = function(userId, extension) {
    console.log("onAcceptCallListener. userId: " + userId + ". Extension: " + JSON.stringify(extension));

    $('#callingSignal')[0].pause();
    updateInfoMessage(callee.full_name + ' has accepted this call');
};

QB.webrtc.onRejectCallListener = function(userId, extension) {
    console.log("onRejectCallListener. userId: " + userId + ". Extension: " + JSON.stringify(extension));

    $('.btn_mediacall, #hangup').attr('disabled', 'disabled');
    $('#audiocall, #videocall').removeAttr('disabled');
    $('video').attr('src', '');
    $('#callingSignal')[0].pause();

};

QB.webrtc.onStopCallListener = function(userId, extension) {
    console.log("onStopCallListener. userId: " + userId + ". Extension: " + JSON.stringify(extension));

    hungUp();
};

QB.webrtc.onRemoteStreamListener = function(stream) {

    QB.webrtc.attachMediaStream('remoteVideo', stream);
};

QB.webrtc.onUserNotAnswerListener = function(userId) {
    console.log("onUserNotAnswerListener. userId: " + userId);
};

function qbsignup(qemail,qpwd)
{

    $.ajax({
        type: 'POST',
        url: 'loaddata.php',
        data: {

            dtype:'userid',
            qemail:qemail

        },

        success: function (result) {

var userid= $.trim(result);
            var login = "yveqb"+userid;
            var password = qpwd;

            var params = { 'login': login, 'password': password};


            QB.users.create(params, function(err, user) {
                if (user) {
        var id=user.id;

                    $.ajax({
                        type: 'POST',
                        url: 'qupdate.php',
                        data: {


                            qid: id,
                            qlogin:login,
                            qpwd:qpwd,
                            userid:result

                        },

                        success: function (result) {

                            createsession(login,password);



                        }
                    });

                }

            });
        }


    });
}

function qbsignin(qblogin,qpwd)
{


    var params = { 'login': qblogin, 'password': qpwd};
    createsession(qblogin,qpwd);
}


function createsession(login,password)
{

    var params = { 'login': login, 'password': password};
    QB.createSession(params, function(err, result) {
        connectChat();
    });
}

function connectChat() {

    var session = QB.service.getSession();
    var params = {userId: session.user_id, password: session.token};
    QB.chat.connect({
        jid: QB.chat.helpers.getUserJid(session.user_id, QBApp.appId),
        password: session.token
    }, function(err, res) {
        $('.connecting').addClass('hidden');
        $('.chat').removeClass('hidden');
        caller = {
            id: session.user_id,
            login:session.login,
            password: session.token
        };


    })
}

function retrieveFiles() {
    if (finished != true) {
        $("#loadwnd").show(0);
        uploadPages = uploadPages + 1;

        QB.content.list({page: uploadPages, per_page: '9'}, function(error, response) {
            if (error) {
                console.log(error);
            } else {
                $.each(response.items, function(index, item){
                    var cur = this.blob;
                    showImage(cur.uid, cur.name, true);
                });

                console.log(response);
                $("#loadwnd").delay(1000).fadeOut(1000);

                var totalEntries = response.total_entries;
                entries = response.items.length;
                filesCount = filesCount + entries;

                if (filesCount >= totalEntries) {
                    finished = true;
                }
            }
        });
    }
}

function callWithParams(mediaParams, isOnlyAudio){
    QB.webrtc.getUserMedia(mediaParams, function(err, stream) {
        if (err) {
            console.log(err);
            alert('Error: devices (camera or microphone) are not found');
        } else {
            $('.btn_mediacall, #hangup').removeAttr('disabled');
            $('#audiocall, #videocall').attr('disabled', 'disabled');
            $('#callingSignal')[0].play();
            //
            alert(callee.id);
            QB.webrtc.call(callee.id, isOnlyAudio ? 'audio' : 'video', {});
        }
    });
}

function chooserecipient(id,login,password)
{
    alert(id);
    alert('Recipient selected');

    var login="ravi123";
    var password = "xyzABC@123";

    alert(login);
    alert(password);
    callee = {
        id:id,
        login: login,
        password: password
    };
}

function hungUp(){
    // hide inciming popup if it's here
    $('#incomingCall').modal('hide');
    $('#ringtoneSignal')[0].pause();

    updateInfoMessage('Call is stopped. Logged in as ' + caller.full_name);

    $('.btn_mediacall, #hangup').attr('disabled', 'disabled');
    $('#audiocall, #videocall').removeAttr('disabled');
    $('video').attr('src', '');
    $('#callingSignal')[0].pause();
    $('#endCallSignal')[0].play();
}

