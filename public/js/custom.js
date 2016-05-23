// JavaScript Document

function callajax(dataval, url, async,methodtype) {

    var response = "";
    $.ajax({
        type: methodtype,
        url: url,
        async: async,
        data: dataval,
        beforeSend: function () {

        },
        success: function (result) {

            response = result;

        }
    });
    //alert(response);
    return response;
}




