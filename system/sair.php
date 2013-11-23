<?php 
	unset($_SESSION["email_admin"], $_SESSION["senha_admin"]);
	header("Location: login.php");
?>