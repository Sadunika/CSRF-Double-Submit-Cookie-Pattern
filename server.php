<?php

//start session - server
session_start();


if(isset($_POST['submit']))
{
    ob_end_clean();
    
//validate user login
    validate_login($_POST['CSRF'],$_COOKIE['session_id'],$_POST['username'],$_POST['password']);

}


//login validation function
function validate_login($CSRF,$session_ID, $username, $password)
{
    if($username=="admin" && $password=="admin" && $CSRF==$_COOKIE['csrf_token'] && $session_ID== $_SESSION['sessionId'])
    {
        echo "<script> alert('Login Sucessful') </script>";
        echo "Login successful! Welcome"."<br/>"; 
        echo "Username : $username"."<br/>";
        echo "Password : $password"."<br/>";
        echo "Token : $CSRF"."<br/>";
       
    }
    else
    {
        echo "<script> alert('Login Failed') </script>";
        echo "Login Failed ! "."<br/>";
        
    }
}



?>