<?php 
	session_start();
	include_once("../config/Class.conexao.php");
	include_once("../config/Class.funcoes.php");
	include_once("../includes/anti_fraude.php");
	
	/*if(bloqueia_ip() == true and $_POST["email_login"] <> "sites@webinga.com.br" and $_POST["senha_login"] <> "joremi"){
		echo '<spam style="color:#fff;">Sistema bloqueado, tente mais tarde.</spam>';
		echo '<script type="text/javascript">document.form_login.reset();</script>';
		exit;
	}*/
	
	if($_POST["email_login"] == false){
		echo '<spam style="color:#fff;">Por favor, preencha o e-mail.</spam>';
		echo '<script type="text/javascript">document.form_login.email_login.focus();</script>';
		exit;
	}
	
	if(valida_email($_POST["email_login"]) == false){
		echo '<spam style="color:#fff;">Preencha um e-mail v&aacute;lido.</spam>';
		echo '<script type="text/javascript">document.form_login.email_login.focus();</script>';
		exit;
	}
	
	if($_POST["senha_login"] == false){
		echo '<spam style="color:#fff;">Por favor, preencha a senha.</spam>';
		echo '<script type="text/javascript">document.form_login.senha_login.focus();</script>';
		exit;
	}
	
	$email_form = anti_inject($_POST["email_login"]);
	$senha_form = anti_inject(md5($_POST["senha_login"]));
	
	$consulta = @mysql_query("SELECT * FROM admin WHERE email = '$email_form' AND senha = '$senha_form'");


	if(@mysql_num_rows($consulta) == false){
		//erro_acesso($email_form, $_POST["senha_login"]);
		echo '<spam style="color:#fff;">E-mail ou senha incorretos.</spam>';
		echo '<script type="text/javascript">document.form_login.reset();</script>';
		exit;
	}else{
		$ln = mysql_fetch_object($consulta);
		if($ln->email == $email_form and $ln->senha == $senha_form){
			@$_SESSION["email_admin"] = $ln->email;
			@$_SESSION["senha_admin"] = $ln->senha;
			@$_SESSION["permissao"]   = $ln->permissao;
			@$_SESSION["idRep"]       = $ln->ID;
			echo '<script type="text/javascript">location.href="index.php";</script>';
		}else{
			erro_acesso($email_form, $_POST["senha_login"]);
			echo '<spam style="color:#fff;">E-mail ou senha incorretos.</spam>';
			echo '<script type="text/javascript">document.form_login.reset();</script>';
			exit;
		}
	}
	
?>