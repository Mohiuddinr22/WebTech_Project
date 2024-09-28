<?php
	require '../vendor/autoload.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	function sendConfirmationMail($email, $body){
		$mail = new PHPMailer(true);

		try{
			$mail->isSMTP();
    		$mail->Host       = 'smtp.gmail.com';
    		$mail->SMTPAuth   = true;
    		$mail->Username   = 'newmail3349@gmail.com';
    		$mail->Password   = 'gxtfxiqesgcrxekf';
    		$mail->SMTPSecure = 'ssl';
    		$mail->Port       = 465;
    		$mail->setFrom('newmail3349@gmail.com');
    		$mail->addAddress($email); 
    		$mail->isHTML(true);                     
    		$mail->Subject = 'Confirmation of Application';
    		$mail->Body    = $body;
    		$mail->AltBody = 'This is the plain text body for non-HTML clients';

    		$mail->send();
		}
		catch(Exception $e){
			$mail->ErrorInfo;
		}
	}

	function sendDeclineMail($email, $body){
		$mail = new PHPMailer(true);

		try{
			$mail->isSMTP();
    		$mail->Host       = 'smtp.gmail.com';
    		$mail->SMTPAuth   = true;
    		$mail->Username   = 'newmail3349@gmail.com';
    		$mail->Password   = 'gxtfxiqesgcrxekf';
    		$mail->SMTPSecure = 'ssl';
    		$mail->Port       = 465;
    		$mail->setFrom('newmail3349@gmail.com');
    		$mail->addAddress($email); 
    		$mail->isHTML(true);                     
    		$mail->Subject = 'Update on Your Hiring Request at E-LawyerBD';
    		$mail->Body    = $body;
    		$mail->AltBody = 'This is the plain text body for non-HTML clients';

    		$mail->send();
		}
		catch(Exception $e){
			$mail->ErrorInfo;
		}
	}

	function sendAcceptanceMail($email, $body){
		$mail = new PHPMailer(true);

		try{
			$mail->isSMTP();
    		$mail->Host       = 'smtp.gmail.com';
    		$mail->SMTPAuth   = true;
    		$mail->Username   = 'newmail3349@gmail.com';
    		$mail->Password   = 'gxtfxiqesgcrxekf';
    		$mail->SMTPSecure = 'ssl';
    		$mail->Port       = 465;
    		$mail->setFrom('newmail3349@gmail.com');
    		$mail->addAddress($email); 
    		$mail->isHTML(true);                     
    		$mail->Subject = 'Your Consultancy Request has been Accepted - E-LawyerBD';
    		$mail->Body    = $body;
    		$mail->AltBody = 'This is the plain text body for non-HTML clients';

    		$mail->send();
		}
		catch(Exception $e){
			$mail->ErrorInfo;
		}
	}

	function sendRejectionMail($email, $body){
		$mail = new PHPMailer(true);

		try{
			$mail->isSMTP();
    		$mail->Host       = 'smtp.gmail.com';
    		$mail->SMTPAuth   = true;
    		$mail->Username   = 'newmail3349@gmail.com';
    		$mail->Password   = 'gxtfxiqesgcrxekf';
    		$mail->SMTPSecure = 'ssl';
    		$mail->Port       = 465;
    		$mail->setFrom('newmail3349@gmail.com');
    		$mail->addAddress($email); 
    		$mail->isHTML(true);                     
    		$mail->Subject = 'Application Update Form';
    		$mail->Body    = $body;
    		$mail->AltBody = 'This is the plain text body for non-HTML clients';

    		$mail->send();
		}
		catch(Exception $e){
			$mail->ErrorInfo;
		}
	}

	// $mail = new PHPMailer(true);

	// try{
	// 	$mail->isSMTP();
    // 	$mail->Host       = 'smtp.gmail.com';
    // 	$mail->SMTPAuth   = true;
    // 	$mail->Username   = 'newmail3349@gmail.com';
    // 	$mail->Password   = 'gxtfxiqesgcrxekf';
    // 	$mail->SMTPSecure = 'ssl';
    // 	$mail->Port       = 465;
    // 	$mail->setFrom('newmail3349@gmail.com');
    // 	$mail->addAddress('mohiuddinr.22@gmail.com'); 
    // 	$mail->isHTML(true);                     
    // 	$mail->Subject = 'Custom Subject';
    // 	$mail->Body    = 'Ifti is a good boy!';
    // 	$mail->AltBody = 'This is the plain text body for non-HTML clients';

    // 	$mail->send();
    // 	echo 'Message has been sent';
	// }
	// catch(Exception $e){
	// 	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	// }
?>