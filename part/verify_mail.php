<?php
	use PHPMailer\PHPMailer\PHPMailer;
	require './vendor/autoload.php';
	//Create a new PHPMailer instance
	$mail = new PHPMailer;

	
	//Set who the message is to be sent from
	$mail->setFrom('dlorunfemi@gmail.com', 'Joshua Olorunfemi');
	//Set an alternative reply-to address
	$mail->addReplyTo('replyto@example.com', 'First Last');
	//Set who the message is to be sent to
	$mail->addAddress($email, $name);
	//Set the subject line
	$mail->Subject = 'Signup | Verification';
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	//Replace the plain text body with one created manually
	$mail->Body = '
                     
        Thanks for signing up!
        Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
         
        ------------------------
        Username: '.$name.'
        Password: '.$password.'
        ------------------------
         
        Please click this link to activate your account:
        http://www.yourwebsite.com/verify.php?email='.$email.'&hash='.$hash.'
         
        ';

	if(!$mail->send()) 
	{
	    echo "Mailer Error: " . $mail->ErrorInfo;
	} 
	else 
	{
	    echo "Message has been sent successfully";
	}