<?php if($_GET["acao"] == "lista"): ?>
<h1>Representantes</h1>

<hr class="featurette-divider">

<ul class="breadcrumb" style="height:100px">

    <div class="pull-left">
    <div class="pull-right">
      PESQUISAR REPRESENTANTE:
      <form>
        <input required type="text" id="input">
        <div><input class="btn btn-info" type="submit" value="Buscar"></div>
      </form> 
    </div>

</ul>
<div class="clear"></div>

<hr class="featurette-divider">

<?php 
  $sql = mysql_query("SELECT * FROM representantes ORDER BY nome ASC") or die (mysql_error());
?>
<div><a class="btn btn-success" href="?secao=controller/representantes&acao=inserir"><i class="icon-plus-sign"></i> Cadastrar Representante</a></div>
<br />
<table class="table table-hover">
  <thead>
    <tr>
      <th>Nome</th>
      <th>E-mail</th>
      <th>Telefone</th>
      <th>Permissão</th>
      <th>Status</th>
      <th>Ação</th>
    </tr>
  </thead>
  <tbody>
    <?php while($ln = mysql_fetch_object($sql)): ?>
    <tr>
      <td><?php echo $ln->nome; ?></td>
      <td><?php echo $ln->email; ?></td>
      <td><?php echo $ln->telefone; ?></td>
      <td><?php echo $ln->permissao; ?></td>
      <td>
        <?php
        if($ln->status == "0"){
          echo '<span class="label">Inativo</span>';
        }else{
          echo '<span class="label label-success">Ativo</span>';
        }
        ?>
      </td>
      <td>
        <a class="btn btn-info btn-mini" href="?secao=controller/representantes&acao=editar&ID=<?php echo $ln->ID; ?>"><i class="icon-edit"></i> Editar</a>
        <a class="btn btn-danger btn-mini" href="?secao=controller/representantes&acao=deletar&ID=<?php echo $ln->ID; ?>" onclick="return confirm('Deseja deletar?');"><i class="icon-trash"></i> Deletar</a>
        </div>
      </td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>
<?php endif; ?>

<?php if($_GET["acao"] == "inserir"): ?>
<br />
<h1>Representantes</h1>
<div class="clear"></div>
<br />
<div><a class="btn btn-success" href="?secao=controller/representantes&acao=lista"><i class="icon-chevron-left"></i> Voltar</a></div>
<br />
<hr class="featurette-divider">
<form name="insert" method="post" action="?secao=controller/representantes&acao=inserir">
  <div>Permissão:</div>
  <div>
  <select name="permissaoRep" id="permissaoRep">
    <option selected value="">Escolha</option>
    <option value="Administrador">Administrador</option>
    <option value="Representante">Representante</option>
  </select>
  </div>
  <div>Nome:</div>
  <div><input class="input-large" type="text" name="nomeRep" id="nomeRep" /></div>
  <div>Sobrenome:</div>
  <div><input class="input-large" type="text" name="sobreNomeRep" id="sobreNomeRep" /></div>
  <div>E-mail:</div>
  <div><input class="input-large" type="email" name="emailRep" id="emailRep" /></div>
  <div>Telefone:</div>
  <div><input class="input-large" type="tel" name="telefoneRep" id="telefoneRep" /></div>
  <div>Senha:</div>
  <div><input class="input-large" type="password" name="senhaRep" id="senhaRep" /></div>
  <div>Confirme a senha:</div>
  <div><input class="input-large" type="password" name="senhaConfRep" id="senhaConfRep" /></div>
  <div><input type="submit" id="enviarInsertRep" value="ENVIAR" class="btn btn-info" onclick="return false;" /></div>
  <br />
  <div id="resultRep"></div>
</form>
<?php endif; ?>