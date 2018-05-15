 <?php
   session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Feedback</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <link rel="icon" type="image/png" href="https://www.networkbulls.com/assets/images/favi.png">
  <link rel="stylesheet" href="css/fonts/fonts.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/feedback-style.css">  
  <link rel="stylesheet" href="css/star-rating.css">
  <link rel="stylesheet" href="css/sweetalert.css">
</head>
<body>

<section id="feedbk">
    <div class="fb_logo text-center">
        <a href="https://www.networkbulls.com"><img src="img/logo.svg" alt=""></a>
    </div> 
    <div class="feed_hd"><h1 class="text-uppercase">Help us to be the Best</h1></div>  
    <div class="container">
       <div class="wrapper text-center">
           <div class="fb-spare ">Kindly spare few minutes and share your valuable feedback about your visit to Network Bulls?</div>
       </div>

       <div class="fb-wrapper ">              
          <div class="row">
            <form action="https://www.networkbulls.com/api/1.0/feedback-form/store" method="post" id="nb-feedback">
            <!-- <form action="http://nbcom.dev/api/1.0/feedback-form/store" method="post" id="nb-feedback"> -->
              
              <div class="col-xs-12">
                  <div class="form-group">
                    <label for="name">Name of NB Career Counsellor – Mr/Miss/Mrs. <span class="txt-orange">*</span></label>
                    <input type="text" name="counsellor_name" class="form-control" id="counsellor">
                    <div id="user_name_err" class="error_field" style="display:none;"></div>
                  </div>
              </div>

              <div class="col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label for="name">Your Name </label><input type="text" name="name" class="form-control" id="name">
                  </div>
              </div>

              <div class="col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label for="name">Enquired For</label><input type="text" name="enquiry" class="form-control" id="equrr">
                    <div id="user_enquiry_err" class="error_field" style="display:none;"></div>
                  </div>
              </div>

              <div class="col-xs-12">
                <div class="form-group">
                  <label for="email">Email Id</label><input type="email" name="email" class="form-control" id="email">
                   <div id="user_email_err" class="error_field" style="display: none;"></div> 
                </div></div>
              

              <div class="col-xs-12">
                  <div class="form-group">
                    <div class="fb_ques">Q1. How much you would rate our career counsellors on politeness?</div>
                    <div class="ml_t20" id="counsellors"></div>                
                  </div>
              </div>
              
              <div class="col-xs-12">
                  <div class="form-group">
                    <div class="fb_ques">Q2. Were you explained thoroughly about career scope of courses, content and placements?</div>
                    <div class="ml_t20" id="career"></div>                
                  </div>
              </div>
              
              <div class="col-xs-12">
                  <div class="form-group">
                    <div class="fb_ques">Q3. Did our career counsellors resolved your doubts and answered queries properly?</div>
                    <div class="ml_t20" id="doubts"></div>                
                  </div>
              </div>
              
              <div class="col-xs-12">
                  <div class="form-group">
                    <div class="fb_ques">Q4. Was your lab visit satisfactory? </div>
                    <div class="ml_t20" id="satisfactory"></div>                
                  </div>
              </div>
              
              <div class="col-xs-12">
                  <div class="form-group">
                    <div class="fb_ques">Q5. Was there any waiting time on enquiry, 1-4 Mins, 5-9 Mins or above 10 minutes?</div>
                    <div class="wrapper ml_t20">
                        <label class="radio-inline"><input type="radio" name="q5" value="1">1-4 Mins</label>
                        <label class="radio-inline"><input type="radio" name="q5" value="2">5-9 Mins</label>
                        <label class="radio-inline"><input type="radio" name="q5" value="3">Above 10 Mins</label>
                    </div>                
                  </div>
              </div>
              
              <div class="col-xs-12">
                  <div class="form-group">
                    <div class="fb_ques">Q6. Any suggestions or comments you would like to share?</div>
                    <div class="wrapper mt15"><textarea name="remarks" rows="4" class="form-control" placeholder="Type here" id="message" ></textarea></div>       
                  </div>
              </div>
              
              <div class="col-xs-12">
                  <div class="text-center"><button type="submit" class="btn btn-orange btn-lg">Submit</button></div>
              </div>         
            </form>
              
          </div><!--row-->
       </div> <!--fb-wrapper-->             
    </div> <!--container-->
    
    <div class="feed_hd"><div class="lead text-center m15">&copy; Copyright 2018 NetworkBulls. All Rights Reserved</div>  
</section>

<!--<script src="js/jquery.min_2.js"></script>-->
<!--<script src="js/jquery.star.rating.js"></script>-->
<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/sweetalert.js"></script>
<script src="js/jquery.raty.js"></script>

<script>
  var successServer,errorServer;
  <?php

    if(isset($_SESSION["success"])){
      $success = $_SESSION["success"];
      session_destroy ();
      echo "var successServer='".$success."';";
    }
    if(isset($_SESSION["error"])){
      $error = $_SESSION["error"];
      $errorData = $_SESSION["data"];
      session_destroy ();
      echo "var errorServer='".$error."',errorData=".$errorData.";";
    }
  ?>
  if(successServer){
    swal("Thank you!", "Your Feedback has been sent successfully!", "success");
  }

  if(errorServer){
    // console.log(errorData);
    if(!$.isEmptyObject(errorData)){
      if("counsellor_name" in errorData){
        $("#user_name_err").text(errorData["counsellor_name"]).css("display","block");
      }
      if("email" in errorData){
        $("#user_email_err").text(errorData["email"]).css("display","block");
      }
      // if("enquiry" in errorData){
      //   $("#user_enquiry_err").text(errorData["enquiry"]).css("display","block");
      // }
      
    }
    swal("Failed!", "Please Fill in the correct details!", "error");
    // alert(errorServer);
  }

  $(document).ready(function(){
    $('#counsellors').raty({
          cancelOff:  'cancel-off-big.png',
          cancelOn: 'cancel-on-big.png',
          half: true,
          size: 24,
          number: 10,
          cancelHint: 'none',
          starOff:  'star-off-big.png',
          starOn:   'star-on-big.png',
          starHalf: 'star-half-big.png',
          scoreName: 'q1',
        });
    $('#career').raty({
          cancelOff:  'cancel-off-big.png',
          cancelOn: 'cancel-on-big.png',
          half: true,
          size: 24,
          number: 10,
          cancelHint: 'none',
          starOff:  'star-off-big.png',
          starOn:   'star-on-big.png',
          starHalf: 'star-half-big.png',
          scoreName: 'q2',
        });
    $('#doubts').raty({
          cancelOff:  'cancel-off-big.png',
          cancelOn: 'cancel-on-big.png',
          half: true,
          size: 24,
          number: 10,
          cancelHint: 'none',
          starOff:  'star-off-big.png',
          starOn:   'star-on-big.png',
          starHalf: 'star-half-big.png',
          scoreName: 'q3',
        });
    $('#satisfactory').raty({
          cancelOff:  'cancel-off-big.png',
          cancelOn: 'cancel-on-big.png',
          half: true,
          size: 24,
          number: 10,
          cancelHint: 'none',
          starOff:  'star-off-big.png',
          starOn:   'star-on-big.png',
          starHalf: 'star-half-big.png',
          scoreName: 'q4',
        });
   
    $("#nb-feedback").on("submit",function(ev){
      if(!home_frmvalidation()){
        ev.preventDefault();
      }
    })
  })  

</script>


<script type="text/javascript">
  function home_frmvalidation() 
  {
      var isCheck = true;
      if($.trim($("#counsellor").val())=="") {
          $("#user_name_err").html("Please enter Counsellor's Name.");
          $("#user_name_err").show();
          $("#counsellor").val("");
          $("#counsellor").focus();
          isCheck = false;
          return false;
      }else{
          $("#user_name_err").hide();
      } 
      if($.trim($("#counsellor").val()).length >255) {
          $("#user_name_err").html("Name content exceeds defined character limit!!");
          $("#user_name_err").show();
          $("#counsellor").val("");
          $("#counsellor").focus();
          isCheck = false;
          return false;
      }else{
          $("#user_name_err").hide();
      }   
      if($.trim($("#email").val())=="") {
          $("#user_email_err").html("Please enter your email address.");
          $("#user_email_err").show();
          $("#email").val("");
          $("#email").focus();
          isCheck = false;
          return false;
      }else{
          $("#user_email_error").hide();
      }
      var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if(!regex.test($("#email").val())){
          $("#user_email_err").html("Please enter valid email-address.");
          $("#user_email_err").show();
          $("#email").focus();
          isCheck = false;
          return false;
      }else{
          $("#user_email_err").hide();
      }
               
      if(isCheck==true){
          return true;
      }
  }
    
/*SweetAlert script here*/
  function SweetAlert() {
      return window.swal;
    };

</script>


</body>
</html>