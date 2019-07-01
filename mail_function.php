<?php	
	function sendOTP($email,$otp) {
		require('phpmailer/class.phpmailer.php');
		require('phpmailer/class.smtp.php');
		require ('phpmailer/PHPMailerAutoload.php');
	
		$message_body = "One Time Password for PHP login authentication is:<br/><br/>" . $otp;
		$mail = new PHPMailer();
		$mail->IsSMTP();
		//$mail->SMTPDebug = 2;
		$mail->SMTPAuth = TRUE;
		$mail->SMTPSecure = 'tls'; // tls or ssl
		$mail->Port     = 587;
		$mail->Username = "ankitajain23121997@gmail.com";
		$mail->Password = "ankita@23";
		$mail->Host     = "tls://smtp.gmail.com";
		$mail->Mailer   = "smtp";
		$mail->SetFrom("ankitajain23121997@gmail.com", "Ankita");
		$mail->AddAddress($email);

		$mail->Subject = "OTP to Login";
		$mail->MsgHTML($message_body);
		$mail->IsHTML(true);		
		$result = $mail->Send();
		
		return $result;
	}
?>