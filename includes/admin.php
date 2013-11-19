<?php 
if(dados_admin_sql("permissao") <> "Admin"){
	header("Location: index.php?secao=pages/visitas");
}
?>
<div class="titulos_pages">REPRESENTANTES</div>
<div class="inserir"><a href="?secao=includes/admin&acao=inserir"> <strong>+</strong> INSERIR USU&Aacute;RIO </a></div>
<br />
<?php 
	if(@$_GET["acao"] == "lista"):
	
	$sql = mysql_query("SELECT * FROM admin WHERE email <> 'sites@webinga.com.br' AND senha <> 'joremi' ORDER BY ID DESC");
	if(mysql_num_rows($sql) == false):
		echo '<br /><center>Nenhum dado cadastrado.</center><br />';
	else:
?>
<div id="top_table">
  <div style="position: absolute; color: #445285; font-size: 15px; top: 15px; left: 6px;">Nome</div>
	<div style="position: absolute; color: #445285; font-size: 15px; top: 16px; left: 300px;">E-mail</div>
	<div style="position: absolute; color: #445285; font-size: 15px; top: 16px; left: 520px;">Permiss&atilde;o</div>
  <div style="position: absolute; color: #445285; font-size: 15px; top: 16px; left: 813px;">A&ccedil;&atilde;o</div>
</div>
<div id="bar_table">
<?php 
  	while($ln = mysql_fetch_object($sql)):
?>
<div id="widgetArray_<?php echo $ln->ID;?>" class="coluna_table">
	
    <div style="position: absolute; top: 9px; left: 5px; width: 291px; text-align: left; font-size: 15px;"><?php echo $ln->nome; ?></div>
	
    <div style="position: absolute; top: 11px; left: 300px; width: 285px; text-align: left;"><?php echo $ln->email; ?></div>
    <div style="position: absolute; top: 9px; left: 520px; width: 291px; text-align: left; font-size: 15px;"><strong><?php echo $ln->permissao; ?></strong></div>
    <div style="position: absolute; top: 6px; left: 803px; width: 156px; text-align: left;"><?php if($ln->ID <> 22): ?><a href="?secao=includes/admin&acao=editar&ID=<?php echo $ln->ID; ?>" class="editar_deletar">EDITAR</a><?php endif; ?>
        <?php if($ln->ID <> 22): ?><a href="?secao=includes/admin&acao=deletar&ID=<?php echo $ln->ID; ?>" onClick="return confirm('Deseja realmente deletar?');" class="editar_deletar">DELETAR</a><?php endif; ?></div>
        
</div>
<?php 
  	endwhile;
?>
</div>
<?php 
	endif;
	endif;
?>


<?php if($_GET["acao"] == "inserir"){ ?>
<br />
<form name="inserir" method="post" action="">
  <table width="100%" border="0" align="center">
     <tr>
      <td align="right" valign="middle" class="cinza3">Permiss&atilde;o:</td>
      <td align="left" valign="middle">
        <label><input required="required" type="radio" name="permissao" value="Admin" id="permissao_0" />Admin</label>
        <label><input required="required" type="radio" name="permissao" value="Rep" id="permissao_1" />Representante</label>
		</td>
    </tr>
     <tr>
      <td align="right" valign="middle" class="cinza3">Nome:</td>
      <td align="left" valign="middle"><input required="required" style="width:300px;" name="nome" type="text" class="forms" id="nome"></td>
    </tr>
    <tr>
      <td width="33%" align="right" valign="middle" class="cinza3">E-mail:</td>
      <td width="67%" align="left" valign="middle">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
          <td width="2%" align="left"><input required="required" style="width:300px;" name="email" type="email" class="forms" id="email" /></td>
        </tr>
    </table>
    </td>
    </tr>
    <tr>
      <td align="right" valign="middle" class="cinza3">Senha:</td>
      <td align="left" valign="middle"><input required="required" style="width:300px;" name="senha" type="password" class="forms" id="senha"></td>
    </tr>
    <tr>
      <td class="cinza3">&nbsp;</td>
      <td align="left" valign="middle"><input required="required" name="enviar_cadastro" type="submit" class="botao" id="enviar_cadastro" value="CADASTRAR"></td>
    </tr>
  </table>
</form>

<?php 
if(@$_POST["enviar_cadastro"]){
	
	$permissao = anti_inject($_POST["permissao"]);
	$nome      = anti_inject($_POST["nome"]);
	$email     = anti_inject($_POST["email"]);
	$senha     = anti_inject(md5($_POST["senha"]));
	
	$insert = mysql_query("INSERT INTO admin (permissao, nome, email, senha) VALUES ('$permissao', '$nome', '$email', '$senha')");
	
		header("Location: ?secao=includes/admin&acao=lista");

	
}
?>

<?php } ?>

<?php 

if($_GET["acao"] == "editar"){ 

$ID = $_GET["ID"];

$sql = mysql_query("SELECT * FROM admin where ID = '$ID'");
$ln = mysql_fetch_array($sql);
?>
<br />
<form name="dados" method="post" action="">
  <table width="100%" border="0" align="center">
     <tr>
      <td align="right" valign="middle" class="cinza3">Permiss&atilde;o:</td>
      <td align="left" valign="middle">
        <label><input <?php if($ln["permissao"] == "Admin"): echo 'checked="checked"'; endif; ?> required="required" type="radio" name="permissao" value="Admin" id="permissao_0" />Admin</label>
        <label><input <?php if($ln["permissao"] == "Rep"): echo 'checked="checked"'; endif; ?> required="required" type="radio" name="permissao" value="Rep" id="permissao_1" />Representante</label>
		</td>
    </tr>
    <tr>
      <td width="33%" align="right" valign="middle" class="cinza3">Nome:</td>
      <td width="67%" align="left" valign="middle"><input required="required" style="width:300px;" name="nome" type="text" class="forms" id="nome" value="<?php echo $ln["nome"]; ?>" /></td>
    </tr>
    <tr>
      <td width="33%" align="right" valign="middle" class="cinza3">E-mail:</td>
      <td width="67%" align="left" valign="middle"><input required="required" style="width:300px;" name="email" type="email" class="forms" id="email" value="<?php echo $ln["email"]; ?>" /></td>
    </tr>
    <tr>
      <td align="right" valign="middle" class="cinza3">Senha:</td>
      <td align="left" valign="middle"><input style="width:300px;" name="senha" type="password" class="forms" id="senha" value=""></td>
    </tr>
    <tr>
      <td class="cinza3">&nbsp;</td>
      <td align="left" valign="middle"><input name="enviar_salvar" type="submit" class="botao" id="enviar_salvar" value="ATUALIZAR"></td>
    </tr>
  </table>
  <input type="hidden" id="senha_atual" name="senha_atual" value="<?php echo $ln["senha"]; ?>" />
</form>

<?php 
if(@$_POST["enviar_salvar"]){
	
	$permissao = $_POST["permissao"];
	$nome      = $_POST["nome"];
	$email     = $_POST["email"];
	if(@$_POST["senha"] == true){
		$senha = md5($_POST["senha"]);
	}else{
		$senha = $_POST["senha_atual"];
	}
	
	
	mysql_query("UPDATE admin SET permissao = '$permissao', nome = '$nome', email = '$email', senha = '$senha' WHERE ID = '".$_GET["ID"]."'");
	header("Location: ?secao=includes/admin&acao=lista");
	
}
?>


<?php } ?>

<?php
if(@$_GET["acao"] == "deletar"){
	

$sql = mysql_query("DELETE FROM admin where ID = '".$_GET["ID"]."'");
header("Location: index.php?secao=includes/admin&acao=lista");

}
?>
</div>