<?php 
	
	function sendMail($nomeDestino, $emailDestino, $nomeRemetente, $emailRemetente, $assunto, $msg){
		
		#$nomeDestino = Nome de quem vai receber
		#$emailDestino = E-mail de quem vai receber
		#$nomeRemetente = Nome de quem está enviando
		#$emailRemetente = E-mail de quem está enviando
		#$assunto = Assunto do e-mail
		#$msg = Mensagem do e-mail
		
		$mail             = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;        
		$mail->Host       = "mail.webin.ga"; 
		$mail->Port       = 587;    
		$mail->Username   = "noreply@webin.ga";
		$mail->Password   = "webinga79";
		$mail->SetFrom($emailRemetente, $nomeRemetente);
		$mail->AddReplyTo($emailRemetente, $nomeRemetente);
		$mail->Subject    = $assunto;
		$mail->MsgHTML($msg);
		$mail->AddAddress($emailDestino, $nomeDestino);

		if(!$mail->Send()) {
		  return false;
		} else {
		  return true;
		}
	}

	
?>