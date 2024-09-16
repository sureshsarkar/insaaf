  // only number 
 $('.OnlyNumberInput').keypress(function(event) {
        var code = event.which ;
        
        if (((event.which != 46 || (event.which == 46 && $(this).val() == '')) ||
                $(this).val().indexOf('.') != 0) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    }).on('paste', function(event) {
        event.preventDefault();
    });


 // Lawyer Registration
 $(document).on('submit','.lawyer_register',function(){
 
  var data=new FormData($(this)[0]); 
  var url=$(this).attr("action");
   $(".formInnerCon").addClass("hidden");
  $("#loaderAreaCon").removeClass("hidden");

  $.ajax(
    {
     
    type:"POST",
    url: url,
    data:data,
    contentType:false,
    processData:false,
    success:function(fb)
    {
     
   var resp=$.parseJSON(fb);
   if(resp.status =='true1'){
    $(".Register").show().html('<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Please fil form correctly </div>');
    $(".formInnerCon").addClass("hidden");
    $("#formAreaCon").removeClass("hidden");
    return true;
   }
   else if(resp.status =='true2'){
    $(".Register").show().html('<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Mobile and Email Already exit! </div>');
    $(".formInnerCon").addClass("hidden");
    $("#formAreaCon").removeClass("hidden");
    return true;
   }
   else if(resp.status =='true3'){
    $(".Register").show().html('<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>This Mobile Number Already exit! </div>');
    $(".formInnerCon").addClass("hidden");
    $("#formAreaCon").removeClass("hidden");
    return true;
   }
   
   else if(resp.status =='true4'){
    $(".Register").show().html('<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Email Already exit!</div>');
    $(".formInnerCon").addClass("hidden");
    $("#formAreaCon").removeClass("hidden");
    return true;
    //alert("Please enter valid pass");
   }else if(resp.status =='true'){
    window.location.href =resp.reload;

   }
    
    }
    });
return false;

});
 

// Lawyer registration  mobile check

$(document).on('keyup','.LawyerMobileNum',function(){
    
  let number=$(this).val();
  let base_url=$(this).attr('base_url');
  let url=base_url+'Lawyer_account/check_existtance';
  // alert(url);
  if (number.length==10) {
    $.ajax({
      type: 'post',
      url: url,
      data: {number:number},
      success: function (responce) {
        var resp=$.parseJSON(responce);
       if(resp.status =='Lmobile'){
        $(".numberexist").addClass("text-danger");
           $('.numberexist').html('Number in already exist as a Lawyer Please Enter different number');
           $("#sendotp").hide();
        return true;
       }else if(resp.status =='Cmobile'){
        $(".numberexist").addClass("text-danger");
           $('.numberexist').html('Number in already exist as a Client Please Enter different number');
        $("#sendotp").hide();
        return true;
       }else if(resp.status =='No_mobile'){
        $(".numberexist").removeClass("text-danger");
        $(".numberexist").addClass("text-success");
        $(".numberexist").html("Valid Number");
        $("#sendotp").show();
        return true;
       }
      }
    });
    return false;
  }
});

  // Lawyer login 
  $(document).on('submit','.lawyer_login',function(){
    var data=new FormData($(this)[0]); 
    var url=$(this).attr("data_id");
    $.ajax(
        {
        type:"POST",
        url: url,
        data:data,
        contentType:false,
        processData:false,
        success:function(fb)
        {
       console.log(fb);
       var resp=$.parseJSON(fb);
       if(resp.status =='true'){
        window.location.href =resp.reload;
        return true;
       }
       else if(resp.status =='wrong_mobile'){
        $(".res").show().html('<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Please enter valid Mobile number </div>');
        //alert("Please enter valid pass");
       }
       else if(resp.status =='pin_pass'){
        $(".res").show().html('<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Please enter valid Pin or Password </div>');
        //alert("Please enter valid pass");
       }
       else if(resp.status =='login_detail'){
        $(".res").show().html('<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Please enter valid login details </div>');
        //alert("Please enter valid pass");
       }
        
        }
        });
    return false;

  });
// Lawyer Forget password
  $(document).on('submit','.forgot_lawyer_pass',function(){
    var data=new FormData($(this)[0]); 
    var url=$(this).attr("action");
    $.ajax(
        {
        type:"POST",
        url: url,
        data:data,
        contentType:false,
        processData:false,
        success:function(fb)
        {
       console.log(fb);
       var resp=$.parseJSON(fb);
       if(resp.status =='true'){
       
        window.location.href =resp.reload;
        return true;
       }else if(resp.status =='false'){
        $(".res1").show().html('<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Please enter valid Email</div>');
        
       }
        
        }
        });
    return false;

  });
// Client Registration
$(document).on('submit','.formClass1321',function(){
  $(".GIF_hide").show();
  $(".counterinsaaf").show();
  $(".__formHide").hide();
  var data=new FormData($("#client_register")[0]); 
  var url=$("#client_register").attr("action");
// alert(data);
// alert(url);


  // <!-- JS for Counter start -->
  var counter = 60;
  var interval = setInterval(function() {
      counter--;
      // Display 'counter' wherever you want to display it.
      if (counter <= 0) {
          clearInterval(interval);
          $('.counterinsaaf').html("<p>Being slow internet speed please wait!</p>");
          return;
      } else {
          $('.counterinsaaf').text(counter);
          //   console.log("Timer --> " + counter);
          $('.counterinsaaf').html("" + counter +
              " <span>Please Wait your Registration in being process. </span>");
      }
  }, 1000);
  // <!-- JS for Counter end -->
   



  $.ajax(
    {
    type:"POST",
    url: url,
    data:data,
    contentType:false,
    processData:false,
    success:function(fb)
    {
   console.log(fb);
   var resp=$.parseJSON(fb);
   if(resp.status =='true1'){
  
    $(".Register").show().html('<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Email or Mobile number already exist </div>');
    $(".GIF_hide").hide();
    $(".__formHide").show();

 
    return true;
   }
   else if(resp.status =='true2'){
 
    $(".Register").show().html('<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Mobile number already exist !</div>');
    $(".GIF_hide").hide();
    $(".__formHide").show();

   }
   else if(resp.status =='true3'){
 
    $(".Register").show().html('<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Email Already exit!</div>');
    $(".GIF_hide").hide();
    $(".__formHide").show();
  
    return true;
    //alert("Please enter valid pass");
   }
   else if(resp.status =='true5'){
 
    $(".Register").show().html('<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Failed to Register</div>');
    $(".GIF_hide").hide();
    $(".__formHide").show();
  
    return true;
    //alert("Please enter valid pass");
   }
   else if(resp.status =='true6'){
 
    $(".Register").show().html('<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Please Fill the form correctly!</div>');
    $(".GIF_hide").hide();
    $(".__formHide").show();
  
    return true;
    //alert("Please enter valid pass");
   }
   else if(resp.status =='true4'){

    // window.location.href =resp.reload;
    $(".Register").show().html('<div  class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>You have Successfully Registered into Insaaf99 go for login !</div>');
    $(".GIF_hide").hide();
    $(".__formHide").show();
    window.location.href =resp.reload;
    return true;
   }
    
    }
    });
return false;

});

// Client registration  mobile check

$(document).on('keyup','.clientMobileNum',function(){
    
  let number=$(this).val();
  let base_url=$(this).attr('base_url');
  let url=base_url+'Clint_account/check_existtance';
 
  if (number.length==10) {
    // alert(number);
    $.ajax({
      type: 'post',
      url: url,
      data: {number:number},
      success: function (responce) {
        var resp=$.parseJSON(responce);
       if(resp.status =='Lmobile'){
        $(".numberexist").addClass("text-danger");
           $('.numberexist').html('Number in already exist as a Lawyer Please Enter different number');
           $("#sendotp").hide();
        return true;
       }
       else if(resp.status =='Cmobile'){
        $(".numberexist").addClass("text-danger");
           $('.numberexist').html('Number in already exist as a Client Please Enter different number');
        $("#sendotp").hide();
        return true;
       }else if(resp.status =='No_mobile'){
        $(".numberexist").removeClass("text-danger");
        $(".numberexist").addClass("text-success");
        $(".numberexist").html("Valid Number");
        $("#sendotp").show();
        return true;
       }
      }
    });
    return false;
  }
});

  //client login
  $(document).on('submit','.client_login',function(){
    var data=new FormData($(this)[0]); 
    var url=$(this).attr("action");
    $.ajax(
        {
        type:"POST",
        url: url,
        data:data,
        contentType:false,
        processData:false,
        success:function(fb)
        {
       console.log(fb);
       var resp=$.parseJSON(fb);
      
       if(resp.status =='true'){
        window.location.href =resp.reload;
       }
       else if(resp.status =='wrong_mobile'){
        $(".res").show().html('<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Please enter valid Mobile number </div>');
        //alert("Please enter valid pass");
       }
       else if(resp.status =='pin_pass'){
        $(".res").show().html('<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Please enter valid Pin or Password </div>');
        //alert("Please enter valid pass");
       }
       else if(resp.status =='login_detail'){
        $(".res").show().html('<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Please enter valid login details </div>');
        //alert("Please enter valid pass");
       }
        
        }
        });
    return false;

  });

  // Client Forget password
  $(document).on('submit','.forgot_client_pass',function(){
    var data=new FormData($(this)[0]); 
    var url=$(this).attr("action");
    $.ajax(
        {
        type:"POST",
        url: url,
        data:data,
        contentType:false,
        processData:false,
        success:function(fb)
        {
       console.log(fb);
       var resp=$.parseJSON(fb);
       if(resp.status =='true'){
       
        window.location.href =resp.reload;
        return true;
       }else if(resp.status =='false'){
        $(".res1").show().html('<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Please enter valid Email</div>');
        
       }
        
        }
        });
    return false;

  });


// this is otp process
function validate_mobile(mob){

  var pattern =  /^[6-9]\d{9}$/;

  if (mob == '') {

    return false;
  }else if (!pattern.test(mob)) {

    return false;
  }else{

    return true;
  }
}


//send otp function
function send_otp(mob){
    var ch = "send_otp";
   
    var url =base_url();
 
    console.log(url);
      $.ajax({

      url: url,
      method: "post",
      data: {mob:mob,ch:ch},
      dataType: "text",
      success: function(data){

        if (data == 'success') {

          $('#otpdiv').css("display","block");
          $('#sendotp').css("display","none");
          $('#verifyotp').css("display","block");
          
            timer();
          $('.otp_msg').html('<div class="alert alert-success">OTP sent successfully</div>').fadeIn();
            
            window.setTimeout(function(){
            $('.otp_msg').fadeOut();
          },2000)
            

        }else{

          $('.otp_msg').html('<div class="alert alert-danger">Error in sending OTP</div>').fadeIn();
            
            window.setTimeout(function(){
            $('.otp_msg').fadeOut();
          },2000)
        
        }
      }

    });
}
//end of send otp function

  // Alert massage
  $(function(){
    setTimeout(function() {
        $(".alert").fadeTo(400, 0).slideUp(400, function(){
            $(this).remove(); 
        });
    }, 5000);
});




$(document).ready(function(){


  function validate_mobile(mob){

    var pattern =  /^[6-9]\d{9}$/;

    if (mob == '') {

      return false;
    }else if (!pattern.test(mob)) {

      return false;
    }else{

      return true;
    }
  }


  //send otp function
  function send_otp(mob){

      var ch = "send_otp";
      var url = $('.url').val();
        $.ajax({

        url: url,
        method: "post",
        data: {mob:mob,ch:ch},
        dataType: "text",
        success: function(data){

          if (data == 'success') {

            $('#otpdiv').css("display","block");
            $('#sendotp').css("display","none");
            $('#verifyotp').css("display","block");
            
              timer();
            $('.otp_msg').html('<div class="alert alert-success">OTP sent successfully</div>').fadeIn();
              
              window.setTimeout(function(){
              $('.otp_msg').fadeOut();
            },1000)
              

          }else{

            $('.otp_msg').html('<div class="alert alert-danger">Error in sending OTP</div>').fadeIn();
              
              window.setTimeout(function(){
              $('.otp_msg').fadeOut();
            },1000)
          
          }
        }

      });
  }
  //end of send otp function


  //send otp function

  $('#sendotp').click(function(){
    var mob = $('#mob').val();
  // alert(mob);
   // console.log('hgiohagb afbABAAKURFI');

      if (validate_mobile(mob) == false) $('.otp_msg').html('<div class="alert alert-danger" style="position:absolute">Enter Valid mobile number</div>').fadeIn(); else 	send_otp(mob);

      window.setTimeout(function(){
        $('.otp_msg').fadeOut();
      },1000)
    });
  //end of send otp function


  //resend otp function
  $('#resend_otp').click(function(){
    
    
    var mob = $('#mob').val();
    
    if (validate_mobile(mob) == false) $('.otp_msg').html('<div class="alert alert-danger" style="position:absolute">Enter Valid mobile number</div>').fadeIn(); else 	send_otp(mob) ; $(this).hide();

    window.setTimeout(function(){
      $('.otp_msg').fadeOut();
    },1000)
    
    // send_otp(mob);
     
  });
  //end of resend otp function


//verify otp function starts

$('#verifyotp').click(function(){

  $(".hide_but").hide();
      var ch = "verify_otp";
      var otp = $('#otp').val();
      var url = $('.url').val();
      $.ajax({

        url: url,
        method: "post",
        data: {otp:otp,ch:ch},
        dataType: "text",
        success: function(data){

            if (data == "success") {

              $('.otp_msg').html('<div class="alert alert-success">OTP Verified successfully</div>').show().fadeOut(5000);
              $(".hide_sec").hide();
              $("#formSubmit1").removeClass("d-none");
                                  
            }else{

              $('.otp_msg').html('<div class="alert alert-danger">otp did not match</div>').show().fadeOut(5000);
            }
        }
      });
          

  });

//end of verify otp function


//start of timer function

function timer(){

    var timer2 = "01:59";
    var interval = setInterval(function() {


      var timer = timer2.split(':');
      //by parsing integer, I avoid all extra string processing
      var minutes = parseInt(timer[0], 10);
      var seconds = parseInt(timer[1], 10);
      --seconds;
      minutes = (seconds < 0) ? --minutes : minutes;
      
      seconds = (seconds < 0) ? 59 : seconds;
      seconds = (seconds < 10) ? '0' + seconds : seconds;
      //minutes = (minutes < 10) ?  minutes : minutes;
      $('.countdown').html("Resend otp in:  <b class='text-primary'>"+ minutes + ':' + seconds + " seconds </b>");
      //if (minutes < 0) clearInterval(interval);
      if ((seconds <= 0) && (minutes <= 0)){
        clearInterval(interval);
        $('.countdown').html('');
        $('#resend_otp').css("display","block");
      } 
      timer2 = minutes + ':' + seconds;
    }, 1000);

  }

  //end of timer


});

// Chaptch code start 

$(document).ready(function(){
  cap();
  $("#formsubmit").prop('disabled', true);
});
function cap() {

var alpha=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V'
          ,'W','X','Y','Z','1','2','3','4','5','6','7','8','9','0','a','b','c','d','e','f','g','h','i',
          'j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','#','$','%','@'];

var a=alpha[Math.floor(Math.random()*62)];
var b=alpha[Math.floor(Math.random()*62)];
var c=alpha[Math.floor(Math.random()*62)];
var d=alpha[Math.floor(Math.random()*62)];
var e=alpha[Math.floor(Math.random()*62)];
var f=alpha[Math.floor(Math.random()*62)];

var sum=a + b + c + d + e + f;

document.getElementById("capt").value=sum;
}

function validcap() {
var string1 = document.getElementById('capt').value;
var string2 = document.getElementById('textinput').value;
if (string1 == string2){
     $("#formsubmit").prop('disabled', false);
      //  $("#formSubmit1").prop('disabled',false);

 return true;
}
else {
     $("#formsubmit").prop('disabled', true);
     $(".check_chap").show().html('<div  class="alert alert-dismissable alert-danger" style="padding:0px;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" >×</button>Please enter a valid captcha!</div>');
    //  $("#formSubmit1").prop('disabled',true);
     var fewSeconds = 3;
     setTimeout(function(){
          //  $("#formSubmit1").prop('disabled', false);
        }, fewSeconds*1000);

}
}
// Chaptch Code End


 