<?php
$u='georgekanage';
$e='georgekanage97@gmail.com';
		$emailcut = substr($e, 0, 4);
		$randNum = rand(10000,99999);
		$tempPass = "$emailcut$randNum";
		$hashTempPass = md5($tempPass);

		echo '<h2 style="background-color: darkgrey;color: black"><img src="images/coding.png" width="50" height="50" alt="logo not found" style="margin-right: 50px;">This is <a href="#" style="text-decoration: none;">Kigo Tech</a> Password Reset</h2><h2>Hello '.$u.'</h2><p>This is an automated message from Kigo Tech. If you did not recently initiate the Forgot Password process, please disregard this email.</p><p>You indicated that you forgot your login password. We can generate a temporary password for you to log in with, then once logged in you can change your password from your profile page to anything you like.</p><p>After you click the link below your password to login will be:<br /><b>'.$tempPass.'</b></p><p><a href="localhost/kigotech/pass_reset/forgot_pass.php?u='.$u.'&p='.$hashTempPass.'">Click here now to apply the temporary password shown below to your account</a></p><p>If the above link does not work, copy this address to your browser: <a href="localhost/kigotech/pass_reset/forgot_pass.php?u='.$u.'&p='.$hashTempPass.'">localhost/kigotech/pass_reset/forgot_pass.php?u='.$u.'&p='.$hashTempPass.'</a></p><p>If you do not click the link in this email, no changes will be made to your account. In order to set your login password to the temporary password you must click the link above.</p>';
?>


