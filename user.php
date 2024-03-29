<?php
class User
{
	
	private $con;

	function __construct()
	{
		include_once("./database/db.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	//User is already registered or not
	private function emailExists($email){
		$sql = $this->con->prepare("SELECT user_id FROM users WHERE email_id = ? ");
		$sql->bind_param("s",$email);
		$sql->execute() or die($this->con->error);
		$result = $sql->get_result();
		if($result->num_rows > 0){
			return 1;
		}else{
			return 0;
		}
	}

	public function createUserAccount($username,$email,$password,$usertype){
		//To protect your application from sql attack you can user 
		//prepares statment
		if ($this->emailExists($email)) {
			return "EMAIL_ALREADY_EXISTS";
		}else{
			$pass_hash = password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);
			$pre_stmt = $this->con->prepare("INSERT INTO `users`(`name`, `email_id`, `password`, `user_type`)
			 VALUES (?,?,?,?)");
			$pre_stmt->bind_param("ssss",$username,$email,$pass_hash,$usertype);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				
		        require('phpmailer/class.phpmailer.php');
				require('phpmailer/class.smtp.php');
				require ('phpmailer/PHPMailerAutoload.php');
	
				
		        $message_body = "Your account is created.<br>
                 Username: ".$username."<br> Usertype:".$usertype." <br>Use this email id:".$email ." for login";
		         $mail = new PHPMailer();
		     	 $mail->IsSMTP();
					//$mail->SMTPDebug = 2;
				$mail->SMTPAuth = TRUE;
				$mail->SMTPSecure = 'tls'; // tls or ssl
				$mail->Port     = 587;
				$mail->Username = "my email id";
				$mail->Password = "my gmail account password";
				$mail->Host     = "tls://smtp.gmail.com";
				$mail->Mailer   = "smtp";
				$mail->SetFrom("my email id", "FROM NAME");
				$mail->AddAddress($email);

				$mail->Subject = "Your account created";
				$mail->MsgHTML($message_body);
				$mail->IsHTML(true);		
				$result = $mail->Send();
				
                

			}else{
				return "SOME_ERROR";
			}
			//$pre_stmt->close();
		}
			
	}

	public function userLogin($email,$password){
		$pre_stmt = $this->con->prepare("SELECT user_id,name,password FROM users WHERE email_id = ?");
		$pre_stmt->bind_param("s",$email);

		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
       
		if ($result->num_rows < 1) {
			return "NOT_REGISTERED";
		}else{
			$row = $result->fetch_assoc();
			if (password_verify($password,$row["password"])) {
			session_start();
             $_SESSION['user_id']=$row['user_id'];
			}else{
				return "PASSWORD_NOT_MATCHED";
			}
		}
	}

}

?>