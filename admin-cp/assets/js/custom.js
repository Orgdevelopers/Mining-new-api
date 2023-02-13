/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */



"use strict";



function showLoaderFullPage(){
    $(function() {

        var docHeight = $(document).height();
     
        $("body").append("<div id='overlay'></div>");
        
     
        $("#overlay")
           .height(docHeight)
           .css({
            'opacity' : 1,
            'backdrop-filter': 'blur(5px)',
            'position': 'absolute',
            'top': 0,
            'left': 0,
            'background-color': 'transparent',
            'width': '100%',
            'z-index': 5000,
            'display': 'flex',
            'align-items': 'center',
            'justify-content': 'center'
        });

        $("#overlay").append('<div class="spinner-box"><div class="three-quarter-spinner"></div></div>');
     
     });
}


function showLoaderHalf(){
    $(function() {

        var docHeight = $(document).height();
     
        $("#main-contentttttt").append("<div id='overlay'></div>");
        
     
        $("#overlay")
        .height(docHeight)
        .css({
         'opacity' : 1,
         'backdrop-filter': 'blur(5px)',
         'position': 'absolute',
         'top': 0,
         'left': 0,
         'background-color': 'transparent',
         'width': '100%',
         'z-index': 1,
         'display': 'flex',
         'align-items': 'center',
         'justify-content': 'center'
        });

        $("#overlay").append('<div class="spinner-box"><div class="three-quarter-spinner"></div></div>');
     
     });
}


function cancelLoader(){
    $(function() {

        $("#overlay").remove();
    });
}


function SyncDashboard(){
    showLoaderHalf()
    jQuery.ajax({
        type: "POST",
        url: '../admin/getDashboard',
        dataType: 'json',
        data: {},
    
        success: function (obj, textstatus) {
                      if( !('error' in obj) ) {
                        cancelLoader();
                        //yourVariable = obj.result;
                        console.log(obj);
                        document.getElementById('total-users-txt').innerHTML = obj.msg.total_users;
                        document.getElementById('miners-txt').innerHTML = obj.msg.miners;
                        document.getElementById('requests-txt').innerHTML = obj.msg.requests;
                        document.getElementById('investment-txt').innerHTML = obj.msg.investments;

                      }
                      else {
                        cancelLoader();
                        console.log(obj.error);
                      }
                }
    });
}


function jQueryRequest(q,data, callback,showLoader = false){
    if(showLoader){
        showLoaderHalf();
    }
    jQuery.ajax({
        type: "POST",
        url: '../admin/'+q,
        dataType: 'json',
        data: data,
    
        success: function (obj, textstatus) {
                      if( !('error' in obj) ) {
                        cancelLoader();
                        //console.log(obj);
                        callback(obj);

                      }
                      else {
                        cancelLoader();
                        console.log(obj.error);
                        callback(false);
                      }
                },
        error: function(header,msg){
            console.log(msg);
            cancelLoader();
            callback(false);
        }
    });
}



function dateFormat(d){

    var current = new Date();
    const months = [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'June',
        'July',
        'August',
        'Sep',
        'Oct',
        'Nov',
        'Dec'
    ];

    const days = [
        'Sun',
        'Mon',
        'Tue',
        'Wed',
        'Thu',
        'Fri',
        'Sat'
    ];

    var output = "";

    if(current.getFullYear() == d.getFullYear()){
        output = d.getDate()+" "+months[d.getMonth()]+" "+d.getHours()+":"+d.getMinutes();
    }else{
        output = d.getDate()+" "+months[d.getMonth()]+" "+d.getFullYear()+" "+d.getHours()+":"+d.getMinutes();
    }

    return output;

}



// Toasts

function ToastError(title,msg){
iziToast.error({
    title: title,
    message: msg,
    position: 'topRight'
    });
}

function ToastInfo(title,msg){
    iziToast.info({
        title: title,
        message: msg,
        position: 'topRight'
    });
}

function ToastSuccess(title,msg){
    iziToast.success({
        title: title,
        message: msg,
        position: 'topRight'
    });
}


