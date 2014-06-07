<?php

	
	error_reporting(E_ALL ^ E_NOTICE);
	ini_set('display_errors',1); 
	

?>

<!DOCTYPE html>
<html>
    <head>
    <title> Member System - Register </title>
    </head>

    <body>

    <?php

		error_reporting(E_ALL ^ E_NOTICE);
		ini_set('display_errors',1); 

    if( $_POST['registerbtn'] ){
    	$getuser = $_POST['user'];
    	$getemail = $_POST['email'];
    	$getpass = $_POST['pass'];
    	$getretypepass = $_POST['retypepass'];

    	if($getuser){
    		if($getemail){
    			if($getpass){
    				if($getretypepass){
    					if( $getpass === $getretypepass){
    						if( (strlen($getemail) >= 7) && (strstr($getemail, "@")) && (strstr($getemail, ".")) ){
    							require("./connect.php");

    							$query = mysql_query("SELECT * FROM users WHERE username='$getuser'");
    							$numrows = mysql_num_rows($query);
    							if($numrows == 0){

    								$query = mysql_query("SELECT * FROM users WHERE email='$getemail'");
    								$numrows = mysql_num_rows($query);
    								if($numrows == 0){
    								
    									$password = md5(md5("ae5544".$password."eef520d66aaa")); 
    									//This adds salt and md5 encryption to the user's password.
    								
    									$date = date("F d, Y");
    									$code = md5(rand());

    									mysql_query("INSERT INTO users VALUES (
    										'', '$getuser', '$getpass', '$getemail', '0', '$code', '$date'
    									)");

    									$query = mysql_query("SELECT * FROM users WHERE username=$getuser");
    									$numrows = mysql_num_rows($query);
    									if($numrows == 1){

    										$site = "http://localhost:8888/htdocs/hoica/";

    										$webmaster = "Jaken Herman <JakenHerman@Outlook.com>";
    										$headers = "From: $webmaster";
    										$subject = "Activate Your Account";
    										$message = "Thank you for registering with HOICA - Houston Open Innovation
    										Crowdsourcing Application. We're excited that about your decision to pitch
    										in your ideas and questions about the city of Houston. Click here to Activate
    										your account so you can dip your feet into HOICA.";
    										$message .="$site/activate.php?user=$getuser&code=$code\n";
    										$message .="You must activate your account to log in.";

    										if(mail($getemail, $subject, $message, $headers)){
    											$errormsg = "You have been registered. You must activate your account 
    											from the activation link sent to <b>$getemail</b>";
    											$getuser = "";
    											$getemail = "";
    										}
    										else
    											$errormsg = "An error has occured. Your activation email was not sent.";
    									}	
    									else
    									$errormsg = "An error has occured. Your account was not created";
    								}
    								else
    								$errormsg = "There is already a user with that email";
    								
    							}
    							else
    								$errormsg = "There is already a user with that username";

    							mysql_close;
    						}
    						else
    							$errormsg = "You must enter a valid email address to register.";
    					}
    					else
    						$errormsg = "Your passwords did not match";
    				}
    				else
    					$errormsg = "You must retype your password to register";
    			}
    			else
    				$errormsg = "You must enter a password to register";
    		}
    		else
    			$errormsg = "You must enter your email to register";
    	}
    	else
    		$errormsg = "You must enter your username to register.";

    }
    else
    	$errormsg = "";


    $form = "<form action='./register.php' method='post'>
    <table>

    	<tr>
    		<td></td>
    		<td><font color='red'>$errormsg</font></td>
    	</tr>

    	<tr>
    		<td>Username:</td>
    		<td><input type='text' name='user' value='$getuser' /></td>
    	</tr>

    	<tr>
    		<td>Email:</td>
    		<td><input type='text' name='email' value='$getemail' /></td>
    	</tr>

    	<tr>
    		<td>Password:</td>
    		<td><input type='password' name='pass' value='' /></td>
    	</tr>

    	<tr>
    		<td>Password Confirmation:</td>
    		<td><input type='password' name='retypepass' value='' /></td>
    	</tr>

    	<tr>
    		<td></td>
    		<td><input type ='submit' name='registerbtn' value='Register' /></td>
    	</tr>

    </table>

    </form>";


    ?>
    
    
    </body>
    </html>