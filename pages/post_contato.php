<?php 
	session_start();
	include_once("config/Class.conexao.php");
	include_once("config/Class.funcoes.php");


	if(strip_tags($_POST["nomeC"]) == false){
		echo 'Preencha o nome.';
		echo '<script type="text/javascript">document.contato.nomeC.focus();</script>';
		exit;
	}

	if(strip_tags($_POST["emailC"]) == false){
		echo 'Preencha o e-mail.';
		echo '<script type="text/javascript">document.contato.emailC.focus();</script>';
		exit;
	}

	if(valida_email($_POST["emailC"]) == false){
		echo 'Preencha um e-mail v&aacute;lido.';
		echo '<script type="text/javascript">document.contato.emailC.focus();</script>';
		exit;
	}
	
	if(strip_tags($_POST["tipo"]) == false){
		echo 'Preencha o seu telefone.';
		echo '<script type="text/javascript">document.contato.tipo.focus();</script>';
		exit;
	}

	if(strip_tags($_POST["valorProposta"]) == false){
		echo 'Selecione o assunto.';
		echo '<script type="text/javascript">document.contato.valorProposta.focus();</script>';
		exit;
	}

	if(strip_tags($_POST["msgC"]) == false){
		echo 'Preencha a mensagem.';
		echo '<script type="text/javascript">document.contato.msgC.focus();</script>';
		exit;
	}

	
	$nome = strip_tags(utf8_decode($_POST["nomeC"]));
	$email = strip_tags(utf8_decode($_POST["emailC"]));
	$tipo = strip_tags(utf8_decode($_POST["tipo"]));
	$mensagem = strip_tags(utf8_decode($_POST["msgC"]));
	$assunto = strip_tags(utf8_decode($_POST["valorProposta"]));
	$assunto_email = 'Contato recebido por Representantes';
	$msg_email  = '
	<div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#666;">
	<div align="left"><strong>Resposta para:</strong> '.$email.'</div>
	<br />
	<div align="left"><strong>Nome do Representante:</strong> '.$nome.'</div>
	<div align="left"><strong>E-mail:</strong> '.$email.'</div>
	<div align="left"><strong>Tipo da Proposta:</strong> '.$tipo.'</div>
	<div align="left"><strong>Valor Proposta:</strong> '.$valorProposta.'</div>
	<div align="left"><strong>Mensagem:</strong> '.$mensagem.'</div>
	</div>
	';
	

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: '.$nome.' <'.$email.'>' . "\r\n";
	$headers.="Return-Path:<apoio@webinga.com.br>\r\n";
	if(@mail("apoio@webinga.com.br", $assunto_email, $msg_email, $headers)){
		echo '
		Enviado com sucesso.
		<script type="text/javascript">
		document.contato.reset();
		</script>
	';
	}else{
		echo '
		Erro ao enviar.
		<script type="text/javascript">
		document.contato.reset();
		</script>';

	}	

	header ("location:index.php?secao=pages/download");

?>