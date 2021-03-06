<?php
 
if(isset($_POST['email'])) {
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "ouseph@innercircleinfotech.com";
    $email_subject = "Innercircle - contact form";
    $email_sender = "admin@innercircleinfotech.com";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error;
	echo "<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
 
        die();
    }

    // Recaptcha verification
    $recaptcha_response = $_POST['g-recaptcha-response']; // required
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array('secret' => '6LcqCxYUAAAAAKCZdpiNlKgHgoUTi6DzH8qc80hb', 'response' => $recaptcha_response, 'remoteip' => $_SERVER['REMOTE_ADDR']);
    $options = array(
      'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'method'  => 'POST',
          'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $result = json_decode($response, true);
    if ($result['success'] == false) { died('Captcha verification failed'); }
 
    // validation expected data exists
    if(!isset($_POST['name']) ||
      !isset($_POST['cname']) ||
        !isset($_POST['email']) ||
        !isset($_POST['phone']) ||
         !isset($_POST['place']) ||
        !isset($_POST['message']) ||
        !isset($_POST['g-recaptcha-response'])) {
 
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
    $name = $_POST['name']; // required
    $cname = $_POST['cname']; // required
    $email_from = $_POST['email']; // required
    $phone = $_POST['phone']; // not required
    $place = $_POST['place']; // not required
    $message = $_POST['message']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
    if(!preg_match($email_exp,$email_from)) {
      $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
    if(!preg_match($string_exp,$name)) {
      $error_message .= 'The First Name you entered does not appear to be valid.<br />';
    }
 
    if(strlen($message) < 2) {
      $error_message .= 'The Comments you entered do not appear to be valid.<br />';
    }
 
    if(strlen($error_message) > 0) {
      died($error_message);
    }
 
    $email_message = "Form details below.\n\n";
 
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
    $email_message .= "First Name: ".clean_string($name)."\n";
     $email_message .= "Company Name: ".clean_string($cname)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($phone)."\n";
    $email_message .= "Place: ".clean_string($place)."\n";
    $email_message .= "Comments: ".clean_string($message)."\n";
 
    // create email headers
    $headers = 'From: '.$email_sender."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css1" rel="stylesheet">
 <link href="css/custom.css" rel="stylesheet type="text">
 <link rel="stylesheet" href="font-awesome-4.6.3/css/font-awesome.min.css">
 <script src="https://use.fontawesome.com/82d213351c.js"></script>
 <link rel="stylesheet" type="text/css" href="css/preloader.css"/>

 <script type="text/javascript" src="js/jssor.slider.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>

   </head>
  

  <body>
<div class="container-fluid">
<div class="row">
<div class="top-bar"></div>  
</div>

<div class="row">
  <div class="social"> 
<ul>
<li><a href="#"><img src="images/googleplus.png" align="right" hspace="6"></a></li>
<li><a target="_blank" href="https://twitter.com/InnerCircleinfo"><img src="images/twitter.png" align="right" hspace="6"></a></li>
<li><a target="_blank" href="https://www.facebook.com/Innercircle-1215964921813658/"><img src="images/facebook.png" align="right" hspace="6"></a></li>
<li><a href="#"><img src="images/in.png" align="right" hspace="6"></li></a>
</ul>
</div>
</div> 

<div class="row">
<div class="col-md-4 col-sm-4 col-xs-4">
<div class="logo">
<a class="navbar-brand" href="#"><img src="images/logo.jpg" width=" 197px" height=" 110px" class="img-responsive"></a>
</div>  
</div>  <!--/end of col-md-2 --> 

<div class="col-md-8 col-sm-8 col-xs-8">
<div class="top-contact">
   <ul>
    <li><span style="color:#13a89e"> Reach Us at-</span></li>
    <li><i class="fa fa-volume-control-phone" aria-hidden="true" align="right"></i>&nbsp;&nbsp;080 – 48511187</li> 
<li><i class="fa fa-edit fa-fw fa-lg" aria-hidden="true"></i> info@innercircleinfotech.com</li>
 </ul>
</div>
 </div> <!--/end of col-md-10 --> 

</div>





  <!-- Static navbar -->  
<div class="row">
<div class="navbar-bar">
<nav class="navbar navbar-default">
                     <div class="navbar-header ">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav nav-justified ">
              
              <li class="active"><a href="index.html"><i class="fa fa-send-o fa-fw fa-lg" aria-hidden="true"></i>&nbsp; About Us</a></li>
              <li><a href="services.html"><i class="fa fa-crosshairs fa-fw fa-lg" aria-hidden="true"></i>&nbsp;Services</a></li>
                
                 <li><a href="c-opening.html"><i class="fa fa-chain-broken fa-fw fa-lg" aria-hidden="true"></i>&nbsp;Current Opening</a></li>
                  <li><a href="customers.html"><i class="fa fa-child fa-fw fa-lg" aria-hidden="true"></i>&nbsp;Customers</a></li>
                  <li><a href="industry.html"><i class="fa fa-cogs fa-fw fa-lg" aria-hidden="true"></i> Industry Segment</a></li> 
                   <li><a href="contact.html"><i class="fa fa-share-square fa-fw fa-lg" aria-hidden="true"></i> Contact</a></li>                     
                        
            
          </div><!--/.nav-collapse -->
          
       
      </nav>
</div>

<img src="images/contact.png" class="img-responsive" style="margin:auto"></img>


<div class="row ">
 <div class="thankyou">

<h3><span class="style2"><strong> Thank you for contacting us. We will be in touch with you very soon.</strong> </span> </h3>
  </div>
</div>








<div class="row ">
<div class="footer-links">
<div class="col-md-3">
<div class="hidden-xs">  
<img src="images/pin.png"></img></div> 
</div>
<div class="col-md-3">
<ul class="list">
<h3><span style="color:#e8b71a">Quick </span>  Links....</h3>

<li><a href="index.html">About Us</a></li>
<li><a href="services.html">Services</a></li>
<li><a href="c-opening.html">Current Openings</a></li>
<li><a href="industry.html">Industry Segment</a></li>
<li><a href="contact.html">Reach Us</a></li>
</ul>
</div> 

<div class="col-md-3">

  <ul class="list">

<h3><span style="color:#e8b71a"> Contact</span> Us...</h3>

INNERCIRCLE SOFTECH PVT LTD </br>
#49,50, 1st Floor, Guru Gowtham Complex</br>
S.V Road, Halasuru</br>
Bangalore – 560008</br>
Phone: 080 – 48511187</br>
E mail: info@innercircleinfotech.com</br>
</div> 
<div class="col-md-1"></div> 
<div class="col-md-2">
<div class="hidden-xs"> 
  <img src="images/arrow.png"></img>
</div> 
</div> 
</div> 

<div class="footer">
© 2017 InnerCircle. <span style="color:#ffffff"> All Rights Reserved.</span>
</div> 
</div> 


</div><!--/end of row-1--> 
</div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"> </script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<script type="text/javascript" src="js/validating.js"></script>
    <body/>
    <html/>
 
<?php
 
}
 
?>
