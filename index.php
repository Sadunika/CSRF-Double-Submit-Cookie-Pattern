<?php 
    //start a session - users browser
    session_start();

    //setting a cookie
 //   $sessionID = session_id(); //storing session id
    $_SESSION['sessionId']=session_id(); //storing session id
//check token already generated or not
if(empty($_SESSION['tokenkey']))
{
    //generate and set the token to the SESSION
    $_SESSION['tokenkey']=bin2hex(random_bytes(32));
    
}

//generate CSRF token
$token = sha1( $_SESSION['tokenkey']. $_SESSION['sessionId'].'IT16128200' );
    

setcookie("session_id",$_SESSION['sessionId'],time()+3600,"/","localhost",false,true); //cookie terminates after 1 hour - HTTP only flag
setcookie("csrf_token",$token,time()+3600,"/","localhost",false,true); //csrf token cookie


?>


<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="utf-8"/>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href='https://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="style.css">

</head>
<body>

<div id="login" class="loginsection">
    <div class="login-area">
      
      <div class="login-inputs">
        <span>Login</span>
      </div>
      <form class="login-form" method="POST" action="server.php">
        <div class="text-input">
          <input type="text" placeholder="User name" id="login-username" name="username">

        </div>
        <div class="text-input">
          <input type="password" placeholder="Password" id="login-password" name="password">
          <input type="hidden" id="csrfToken" name="CSRF" value="<?php echo $token; ?>"/>
        </div>

         <input type="submit" class="login-button" name="submit" value="Log in" />
      </form>

    </div>
  </div>

</body>
</html>
