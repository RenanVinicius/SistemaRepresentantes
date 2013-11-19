<?php 
	session_start();
	ob_start();
	include_once("config/Class.conexao.php");
	include_once("config/Class.funcoes.php");
	include_once("includes/configs_painel.php");
?>
<!DOCTYPE html>
<html lang="pt">
<head>

<!-- Meta -->
<meta name="author" content="Webinga - www.webinga.com.br" />
<meta charset="ISO-8859-1" />

<!-- Title -->
<title><?php print_r(TITULO.' - '.VERSAO); ?></title>

<!-- Css -->
<link href="css/login.css" rel="stylesheet" type="text/css" />

<!-- Font -->
<link href="http://fonts.googleapis.com/css?family=Quattrocento+Sans|Open+Sans+Condensed:300|Open+Sans:400,300,600" rel="stylesheet" type="text/css" />

<!-- Js -->
<script src="js/jquery.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script src="js/scripts.js"></script>
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body>

<!-- logo -->
<div id="logo"></div>
<!-- logo -->

<!-- header -->
<header>
	<form name="form_login" id="form_login" method="post" action="#">
   	  <legend>SISTEMA DE REPRESENTANTES</legend>
   	  <input name="email_login" type="email" class="form_login" id="email_login" placeholder="E-mail" />
        <input name="senha_login" type="password" class="form_senha" id="senha_login" placeholder="Senha" />
        <input name="entrar_admin" type="submit" class="botao" id="entrar_admin" onclick="return false;" value="ACESSAR SISTEMA" />
        <div id="resultado_login"></div>
    </form>
</header>
<!-- header -->

</body>
</html>