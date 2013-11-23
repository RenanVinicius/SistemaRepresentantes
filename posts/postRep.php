<?php 
	session_start();
	include_once("../system/conexao.php");
	include_once("../system/funcoes.php");
	
	extract($_POST);
	
	if($tipoForm == "insert"){

		if($permissaoRep == false){
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">×</button>
	    	Escolha o tipo de permissão.
			</div>
			';
			echo '<script type="text/javascript">document.insert.permissaoRep.focus();</script>';
			exit;
		}

		if($nomeRep == false){
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">×</button>
	    	Preencha o nome do representante.
			</div>
			';
			echo '<script type="text/javascript">document.insert.nomeRep.focus();</script>';
			exit;
		}

		if(strlen($nomeRep) < 3){
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">×</button>
	    	Isso não parece um nome, verifique...
			</div>
			';
			echo '<script type="text/javascript">document.insert.nomeRep.focus();</script>';
			exit;
		}

		if($sobreNomeRep == false){
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">×</button>
	    	Preencha o sobrenome do representante.
			</div>
			';
			echo '<script type="text/javascript">document.insert.sobreNomeRep.focus();</script>';
			exit;
		}

		if(strlen($sobreNomeRep) < 3){
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">×</button>
	    	Isso não parece um sobrenome, verifique...
			</div>
			';
			echo '<script type="text/javascript">document.insert.sobreNomeRep.focus();</script>';
			exit;
		}

		if($emailRep == false){
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">×</button>
	    	Preencha o e-mail do representante.
			</div>
			';
			echo '<script type="text/javascript">document.insert.emailRep.focus();</script>';
			exit;
		}

		if(validaEmail($emailRep) == false){
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">×</button>
	    	E-mail inválido.
			</div>
			';
			echo '<script type="text/javascript">document.insert.emailRep.focus();</script>';
			exit;
		}

		$emailsGrupo = array("webinga", "webin", "revistainga", "grupoinga", "emaringa", "outinga", "cvwww", "marketinga");
		if(procpalavras($emailRep, $emailsGrupo) == false){
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">×</button>
	    	O e-mail digitado não parece estar relacionado a nenhuma empresa do <strong>Grupoinga</strong>.
	    	<br />
	    	Tente usar algo como <strong>seuemail@webinga.com.br</strong> ou <strong>seuemail@grupoinga.com</strong> e por ai vai... 
			</div>
			';
			echo '<script type="text/javascript">document.insert.emailRep.focus();</script>';
			exit;
		}

		$consultaEmail = mysql_num_rows(mysql_query("SELECT * FROM representantes WHERE email = '$emailRep'"));
		if($consultaEmail == true){
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">×</button>
	    	Este e-mail já está cadastrado no sistema.
			</div>
			';
			echo '<script type="text/javascript">document.insert.emailRep.focus();</script>';
			exit;
		}

		if($senhaRep == false){
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">×</button>
	    	Digite uma senha.
			</div>
			';
			echo '<script type="text/javascript">document.insert.senhaRep.focus();</script>';
			exit;
		}

		if(strlen($senhaRep) < 6){
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">×</button>
	    	A senha deve conter no mínimo 6 caracteres.
			</div>
			';
			echo '<script type="text/javascript">document.insert.senhaRep.focus();</script>';
			exit;
		}

		$restritoSenha = array("webinga", "inga", $nomeRep, $emailRep);
		if(procpalavras($senhaRep, $restritoSenha) == true){
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">×</button>
	    	Por motivos de segurança a senha não pode conter nada relacionado ao <strong>nome</strong>, <strong>email</strong> e a palavra <strong>Webinga</strong>.
			</div>
			';
			echo '<script type="text/javascript">document.insert.senhaRep.focus();</script>';
			exit;
		}

		if(senhaLetrasNumeros($senhaRep) == false){
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">×</button>
	    	A senha deve conter letras e números.
			</div>
			';
			echo '<script type="text/javascript">document.insert.senhaRep.focus();</script>';
			exit;
		}

		if(verificaSenha($senhaRep) == 1){
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">×</button>
	    	A senha digitada é muito fraca, tente outra.
			</div>
			';
			echo '<script type="text/javascript">document.insert.senhaRep.focus();</script>';
			exit;
		}

		if($senhaConfRep == false){
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">×</button>
	    	Confirme a senha.
			</div>
			';
			echo '<script type="text/javascript">document.insert.senhaConfRep.focus();</script>';
			exit;
		}

		if($senhaRep != $senhaConfRep){
			echo '
			<div class="alert alert-block alert-error fade in">
			<button type="button" class="close" data-dismiss="alert">×</button>
	    	As senhas digitadas não conferem
			</div>
			';
			echo '<script type="text/javascript">document.insert.senhaConfRep.focus();</script>';
			exit;
		}

		$loginGerado = strtolower(geraLogin($nomeRep, $sobreNomeRep));
		$consultaLogin = mysql_num_rows(mysql_query("SELECT * FROM representantes WHERE login = '$loginGerado'"));
		if($consultaLogin == true){
			$loginToSql = $loginGerado.rand(1,100);
		}else{
			$loginToSql = $loginGerado;
		}
		
		insert(array("nome", "sobrenome", "email", "telefone", "senha", "status", "permissao"), array($nomeRep, $sobreNomeRep, $emailRep, $telefoneRep, $senhaRep, "1", $permissaoRep), "representantes");

		echo '
		<div class="alert alert-block alert-sucess">
		<button type="button" class="close" data-dismiss="alert">×</button>
	    <strong>Conta criada com sucesso</strong>
	    <br />
	    Foi enviado um e-mail para '.$emailRep.' com a confirmação do cadastro.
		</div>
		';
		//echo '<script type="text/javascript">document.insert.senhaConfRep.focus();</script>';		

	}
	
?>