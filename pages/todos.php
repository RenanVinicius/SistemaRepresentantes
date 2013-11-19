<div class="titulos_pages">VISITAS DE TODOS REPRESENTANTES</div>
<br />
<form name="filtrarNome" action="recebeTodos.php">
Cliente: <input type="text" id="nome" value="" name="nome" required="required" list="datalist1"/>

<datalist id="datalist1">
<?php 
$sql_cliente = mysql_query("SELECT *  FROM visitas");

while($ln_cliente = mysql_fetch_object($sql_cliente)):
?>
  <option value="<?php echo $ln_cliente->nomeCliente; ?>">
  
<?php 
endwhile;
?>
</datalist>
<!--Status:<select name="status" id="status">
			<option value=""></option>
			<option value="Vendido">VENDIDO</option>
            <option value="Recusado">RECUSADO</option>
       </select>-->
<a class="inserir" href="javascript: submitFiltroNome()">FILTRAR</a>
</form>
<script type="text/javascript">
function submitFiltroNome()
{
  document.filtrarNome.submit();
}
</script>


<br />

<div class="inserir" style="float: right; margin-top: -49px;"><a href="index.php?secao=pages/visitas&acao=inserir">INSERIR <?php if(dados_admin_sql("email")=="erika@webinga.com.br"){echo"PROPOSTA";}else{echo"VISITA";}?></a></div>

<br />

<div id="back-list-visitas">

<?php 
		mysql_query("UPDATE visitas SET resultadoNegociacao = 'Recusado' WHERE data < '".date("Y\-m\-d", mktime(date('H'),date('i'),date('s'),date('m'), date('d')-90, date('Y')))."'");
		
$p = $_GET["p"];
if(isset($p)) {
	$p = $p;
	} else {
$p = 1;
}
$qnt = 90;
$inicio = ($p*$qnt) - $qnt;


	if(@$_GET["status"]==true){
		$status= $_GET["status"];
	}else{
		$status="Negociando";
	};		
		
if(@$_GET["nome"] == true){

	$rep = @mysql_fetch_object(mysql_query("SELECT * FROM admin WHERE nome LIKE'%".$_GET["nome"]."%' "));
		
	$sql = mysql_query("SELECT *  FROM visitas WHERE nomeCliente LIKE'%".$_GET["nome"]."%'AND resultadoNegociacao = '".$status."' ORDER BY data, hora ASC LIMIT $inicio, $qnt");

	//echo '<h1>Mostrando visitas do representate <strong>'.$rep->nome.'</strong> com status <strong>'.$status.'</strong></h1>';
	
}else{

		$data_inicial = date("Y\-m\-d", mktime(date('H'),date('i'),date('s'),date('m'), date('d')-90, date('Y')));
		$data_final = date("Y-m-d");
		
		$sql = mysql_query("SELECT *  FROM visitas WHERE resultadoNegociacao = '".$status."' AND data BETWEEN '$data_inicial' AND '$data_final' ORDER BY data, hora ASC LIMIT $inicio, $qnt");
		
	echo '<h1>Mostrando visitas do periodo <strong>'. date("d\/m\/Y", mktime(date('H'),date('i'),date('s'),date('m'), date('d')-90, date('Y'))).'</strong> a <strong>'.date("d/m/Y").'</strong></h1>';
}
	?>
             <div id="top_table">
                <div style="position: absolute; color: #445285; font-size: 15px; top: 15px; left: 6px;"><h6>DATA/HORA</h6></div>
                <div style="position: absolute; color: #445285; font-size: 15px; top: 15px; left: 122px;"><h6>NOME</h6></div>
                <div style="position: absolute; color: #445285; font-size: 15px; top: 15px; left: 219px;"><h6>CLIENTE</h6></div>
                <div style="position: absolute; color: #445285; font-size: 15px; top: 16px; left: 348px;"><h6>TELEFONE</h6></div>
                <div style="position: absolute; color: #445285; font-size: 15px; top: 16px; left: 461px;"><h6>CIDADE</h6></div>
                <div style="position: absolute; color: #445285; font-size: 15px; top: 16px; left: 579px;"><h6>VALOR</h6></div>
                <div style="position: absolute; color: #445285; font-size: 15px; top: 16px; left: 699px;"><h6>SITUA&Ccedil;&Atilde;O</h6></div>
                <div style="position: absolute; color: #445285; font-size: 15px; top: 16px; left: 819px;"><h6>OBSERVA&Ccedil;&Otilde;ES</h6></div>

            </div>
    
    <?php

	if(mysql_num_rows($sql) == false):
		echo '<br /><br /><div style="text-align:center;">Nenhuma visita encontrada.</div><br /><br />';
	else:

		while($ln = mysql_fetch_object($sql)):
		
	
?>
			<div id="bar_table">
				<div class="coluna_table" style="font-size:12px;">
					<div style="position: absolute; top: 11px; left: 5px; width: 291px; text-align: left;">
						<?php echo inverte_data($ln->data); ?> | <?php echo $ln->hora; ?>
                    </div>
                    <div style="position: absolute; top: 11px; left: 117px; width: 119px; text-align: left; ">
                    <?php
                    $sql_representante =@mysql_fetch_object(mysql_query("SELECT *  FROM admin WHERE ID ='".$ln->idRep."'"));
					echo $sql_representante->nome; ?>
                    </div>
					<div style="position: absolute; top: 11px; left: 217px; width: 119px; text-align: left; ">
						<?php echo $ln->nomeCliente; ?>
                    </div>
					<div style="position: absolute; top: 11px; left: 344px; width: 100px; text-align: left; ">
						<?php echo $ln->telefoneCliente; ?>
                    </div>
					<div style="position: absolute; top: 11px; left: 456px; width: 100px; text-align: left; ">
						<?php echo $ln->cidadeCliente; ?> - <?php echo $ln->estadoCliente; ?>
                    </div>
					<div style="position: absolute; top: 11px; left: 574px; width: 80px; text-align: left; ;">
                    	R$<?php echo number_format($ln->valorProposta,2,',','.'); ?>
                   	</div>
					<div style="position: absolute; top: 11px; left: 695px; width: 73px; text-align: left; ">
						<?php echo $ln->resultadoNegociacao; ?>
                   	</div>
   					<div style="position: absolute; top: 11px; left: 813px; width: 100px; text-align: left; ">
						<a href="index.php?secao=pages/todos&acao=ver_obs&ID=<?php echo $ln->ID; ?>"><?php echo truncate($ln->obs, 40); ?></a>
                    </div>
    
				</div>
			</div>
	<?php 
    		endwhile;
		endif;
    
    ?>
    <div style="margin-top: 20px; margin-bottom: 20px; margin-left: 830px;">
      <?php 
 if(@$_GET["nome"] == true){

	$rep = @mysql_fetch_object(mysql_query("SELECT * FROM admin WHERE nome LIKE'%".$_GET["nome"]."%' "));
		
	$sql_select_all="SELECT *  FROM visitas WHERE idRep='".$rep->ID."'AND resultadoNegociacao = '".$status."'";

	
}else{

		$data_inicial = date("Y\-m\-d", mktime(date('H'),date('i'),date('s'),date('m'), date('d')-90, date('Y')));
		$data_final = date("Y-m-d");
		
		$sql_select_all ="SELECT *  FROM visitas WHERE resultadoNegociacao = '".$status."' AND data BETWEEN '$data_inicial' AND '$data_final'";
		

}

	  $sql_query_all = mysql_query($sql_select_all);
	  $total_registros = mysql_num_rows($sql_query_all);
	  $pags = ceil($total_registros/$qnt);
	  $max_links = 1;
	  echo '<a class="pg" href="index.php?secao=pages/todos&p=1&nome='.$_GET["nome"].'" target="_self" title="Primeira Pagina"><</a> ';
	  for($i = $p-$max_links; $i <= $p-1; $i++) {
		if($i <=0) {
			} else { 
			echo '<a class="pg" href="index.php?secao=pages/todos&p='.$i.'&nome='.$_GET["nome"].'" target="_self">'.$i.'</a> '; }
			}
		echo '<a class="pg_selected" >'.$p.'</a>';
		for($i = $p+1; $i <= $p+$max_links; $i++) {
			if($i > $pags){
		}else { 
		echo '<a class="pg" href="index.php?secao=pages/todos&p='.$i.'&nome='.$_GET["nome"].'" target="_self">'.$i.'</a> ';
		 }
		 }

		echo '<a class="pg" href="index.php?secao=pages/todos&p='.$pags.'&nome='.$_GET["nome"].'" target="_self" title="Ultima Pagina">></a> ';


      ?>
     </div>
<?php 
	if(@$_GET["acao"] == "ver_obs"):
	$sqlObs = mysql_query("SELECT obs FROM visitas WHERE ID = '".$_GET['ID']."'");
?>
<div id="back-inserir-rep">
	<div class="back-inserir-rep content">
    
        <div style="height:40px; float: right;">
        <a href="javascript: window.history.back();">VOLTAR</a>
        </div>
    <h1 style="margin-top: -13px;">OBSERVA&Ccedil;&Otilde;ES</h1>
    <br />
    <?php
        	if(mysql_num_rows($sqlObs) == true){
		while($lnObs = mysql_fetch_object($sqlObs)){
			echo '
			<div>
			'.$lnObs->obs.'
			</div>
			'."\n";
		}
	
	}
	
	?>
      	
  </div>
</div>
<p>
  <?php 

	endif;
?>