<?php 
	if(dados_admin_sql("permissao") == "Admin" and @$_GET["idRep"] == false and @$_GET["acao"] == false):
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" />

<div id="back-select-rep">
	<div class="back-select-rep content">
        <form name="repSelect" action="recebeRepRel.php">
        Selecione o representante: 
          <select name="idRep" id="idRep">
          <option value="01">TODOS</option>
            <?php 
				$sql = mysql_query("SELECT * FROM admin ORDER BY nome ASC");
				while($ln = mysql_fetch_object($sql)){
					echo '<option value="'.$ln->ID.'">'.$ln->nome.'</option>';
				}
			?>
          </select>
		<a class="inserir" href="javascript: submitRep()">ENTRAR</a>
        </form>
        <script type="text/javascript">
        function submitRep()
        {
          document.repSelect.submit();
        }
        </script>    	
    </div>
</div>
<?php 
	endif;
?>

<?php 
	if(@$_GET["idRep"]):
	$where= "";
	if($_GET["idRep"]==01){ $where = "01 = '".$_GET["idRep"]."'"; }
	if($_GET["idRep"]!=01){ $where = "idRep = '".$_GET['idRep']."'";}
	
	
	$sqlRep = mysql_query("SELECT * FROM admin WHERE (ID ='".$_GET["idRep"]."') OR (01='".$_GET["idRep"]."')");
	$lnRep = mysql_fetch_object($sqlRep);
	

	$sqlVisitas = mysql_query("SELECT * FROM visitas WHERE '".$where."' ");
		$lnVisitas = mysql_fetch_object($sqlVisitas);

	
	/*Calcula o total de visitas na semana*/      
       function conversor($dataentra){
            $datasentra=explode("-",$dataentra);
            $datass=array_reverse($datasentra);
            $data4=implode("/",$datass);
            return $data4;
       }


       $diadasemana = date("w");
       $dia = date("d");
       $mes = date("m");
       $ano = date("Y");
       $datadasemana = date ("Y-m-d", mktime (0,0,0,$mes,$dia,$ano));

       $index = 0;
    
     while($diadasemana != -1){
        $arraydata[$index] = $datadasemana; $index++;
        $diadasemana--;
     	$dia = $dia - 1;
        $datadasemana = date ("Y-m-d", mktime (0,0,0,$mes,$dia,$ano));
     } 
  
     $indexy = $index - 1;
     $saidaarray = $arraydata[$indexy]; $saidaarray2 = $arraydata[0]; 
     $diafinais = $dia + 7;
     $saidaarray2 = date ("Y-m-d", mktime (0,0,0,$mes,$diafinais,$ano));

	 $totalVisitasSemana = mysql_num_rows(mysql_query("SELECT * FROM visitas WHERE ".$where." AND data between '".dataToSql(conversor($saidaarray))."' AND '".dataToSql(conversor($saidaarray2))."'"));

	 $totalNegociandoSemana = mysql_num_rows(mysql_query("SELECT * FROM visitas WHERE ".$where." AND resultadoNegociacao = 'Negociando' AND data between '".dataToSql(conversor($saidaarray))."' AND '".dataToSql(conversor($saidaarray2))."'"));
	 
	 $totalRecusadoSemana = mysql_num_rows(mysql_query("SELECT * FROM visitas WHERE ".$where." AND resultadoNegociacao = 'Recusado' AND data between '".dataToSql(conversor($saidaarray))."' AND '".dataToSql(conversor($saidaarray2))."'"));
	 
	 $totalVendidoSemana = mysql_num_rows(mysql_query("SELECT * FROM visitas WHERE ".$where." AND resultadoNegociacao = 'Vendido' AND data between '".dataToSql(conversor($saidaarray))."' AND '".dataToSql(conversor($saidaarray2))."'"));
 /*Calcula o total de visitas na semana*/

 /*Calcula o total de visitas no mes*/
 	$mes = ltrim(date('m'),"0");

	$totalVisitasMes = mysql_num_rows(mysql_query("SELECT * FROM visitas WHERE ".$where." AND mes = '$mes'"));

	 $totalNegociandoMes = mysql_num_rows(mysql_query("SELECT * FROM visitas WHERE ".$where." AND resultadoNegociacao = 'Negociando' AND mes = '$mes'"));

	 $totalRecusadoMes = mysql_num_rows(mysql_query("SELECT * FROM visitas WHERE ".$where." AND resultadoNegociacao = 'Recusado' AND mes = '$mes'"));
	 
	 $totalVendidoMes = mysql_num_rows(mysql_query("SELECT * FROM visitas WHERE ".$where." AND resultadoNegociacao = 'Vendido' AND mes = '$mes'"));

 /*Calcula o total de visitas no mes*/
	 
 /*Calcula o total de visitas no ano*/
 	$ano = date('Y');

	$totalVisitasAno = mysql_num_rows(mysql_query("SELECT * FROM visitas WHERE ".$where." AND ano = '$ano'"));

	 $totalNegociandoAno = mysql_num_rows(mysql_query("SELECT * FROM visitas WHERE ".$where."  AND resultadoNegociacao = 'Negociando' AND ano = '$ano'"));

	 $totalRecusadoAno = mysql_num_rows(mysql_query("SELECT * FROM visitas WHERE ".$where." AND resultadoNegociacao = 'Recusado' AND ano = '$ano'"));
	 
	 $totalVendidoAno = mysql_num_rows(mysql_query("SELECT * FROM visitas WHERE ".$where." AND resultadoNegociacao = 'Vendido' AND ano = '$ano'"));

 /*Calcula o total de visitas no ano*/
	 
?>
<h1 style="text-transform:uppercase;">MOSTRANDO RELAT&Oacute;RIO DE <?php echo $lnRep->nome; ?></h1>
<br />
<div id="baloes">
<h1>ESTA SEMANA</h1>
<div class="baloes a"><?php echo $totalVisitasSemana; ?><br /><strong>Visitas</strong></div>
<div class="baloes b"><?php echo $totalNegociandoSemana; ?><br /><strong>Negociando</strong></div>
<div class="baloes c"><?php echo $totalRecusadoSemana; ?><br /><strong>Recusado(s)</strong></div>
<div class="baloes d"><?php echo $totalVendidoSemana; ?><br /><strong>Vendido(s)</strong></div>
</div>

<br />

<div id="baloes">
<h1>ESTE M&Ecirc;S</h1>
<div class="baloes a"><?php echo $totalVisitasMes; ?><br /><strong>Visitas</strong></div>
<div class="baloes b"><?php echo $totalNegociandoMes; ?><br /><strong>Negociando</strong></div>
<div class="baloes c"><?php echo $totalRecusadoMes; ?><br /><strong>Recusado(s)</strong></div>
<div class="baloes d"><?php echo $totalVendidoMes; ?><br /><strong>Vendido(s)</strong></div>
</div>

<br />

<div id="baloes">
<h1>ESTE ANO</h1>
<div class="baloes a"><?php echo $totalVisitasAno; ?><br /><strong>Visitas</strong></div>
<div class="baloes b"><?php echo $totalNegociandoAno; ?><br /><strong>Negociando</strong></div>
<div class="baloes c"><?php echo $totalRecusadoAno; ?><br /><strong>Recusado(s)</strong></div>
<div class="baloes d"><?php echo $totalVendidoAno; ?><br /><strong>Vendido(s)</strong></div>
</div>


<?php 
	endif;
?>