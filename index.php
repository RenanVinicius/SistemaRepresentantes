<?php
 
	session_start();
	ob_start();

	header('Content-Type: text/html; charset=utf-8');

	include_once("config/conexao.php");
	include_once("config/funcoesGerais.php");
	include_once("config/sendMail.php");
	include_once("config/auth.php");

	@date_default_timezone_set('America/Sao_Paulo');	

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />

<title><?php echo TITULO." ".VERSAO; ?></title>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-tab.js"></script>
<script src="js/scripts.js"></script>

<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

</head>
<div id="menu">
	<div class="navbar navbar-inverse" role="navigation">
		<div class="navbar-inner">
			<div class="navbar-header">
				<ul class="nav">
					<li class="active"><a href="#">Início</a></li>
					<li class="divider-vertical"></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Gerenciar Representantes <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="?secao=pages/visitas&acao=lista">Listar todos</a></li>
							<li><a href="?secao=pages/visitas&acao=inserir">Inserir um novo</a></li>
						</ul>
					</li>
					<li class="divider-vertical"></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Minhas visitas <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="?secao=pages/visitas&acao=lista">Ver todas</a></li>
							<li><a href="?secao=pages/visitas&acao=inserir">Agendar uma nova</a></li>
							<li class="divider"></li>
							<li class="nav-header">Outros recursos</li>
							<li><a href="?secao=pages/visitas&acao=deletadas">Ver visitas deletadas</a></li>
						</ul>
					</li>
				</ul>
				<form class="navbar-search pull-right" action="">
					<input type="text" class="search-query" placeholder="Pesquisa inteligente...">
				</form>
				<ul class="nav pull-right">
					<li><a href="">Enviar Feedback</a></li>
					<li class="divider-vertical"></li>
					<li><a href="?secao=sair">Sair</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div id="content">

<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h1 class="alert-heading">Novo sistema de Representantes</h1>
		<p>Esse novo sistema contém correções novas ferramentas e correções de bugs.</p>
		<p>
			<a class="btn btn-success" href="#">Continar por aqui</a> <a class="btn" href="#">Voltar para o antigo</a>
		</p>
</div>

<?php 
	$pg = anti_inject($_GET["secao"]);
	if(file_exists("$pg.php") == true){
		@include_once("$pg.php");
	}else{
		header("Location: index.php?secao=pages/visitas");
	}
?>
</div>

</body>
</html>