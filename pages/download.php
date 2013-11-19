<div class="titulos_pages">DOWNLOAD</div>
<br />

<div class="inserir" style="float: left; margin-top: -25px;"><a href="index.php?secao=pages/download&acao=proposta" style="width:226px;">SOLICITAR PROPOSTA ESPECIAL</a></div>
<div class="inserir" style="float: right; margin-top: -25px; margin-right: 10px;"><a href="forca_download.php?arquivo=download/Contrato.pdf" style="width:139px;">BAIXAR CONTRATO</a></div>
<br />

<div id="back-list-visitas">

<?php 
$propostas = array("site de R$1.400,00"=>"site1400.pdf",
					"site de R$1.600,00"=>"site1600.pdf",
"site de R$1.800,00"=>"site1800.pdf",
"site de R$2.000,00"=>"site2000.pdf",
"site de R$2.400,00"=>"site2400.pdf",
"site de R$2.800,00"=>"site2800.pdf",
"site de R$3.500,00"=>"site3500.pdf",
"e-commerce de R$2.400,00"=>"e-commerce2400.pdf",
"e-commerce de R$2.800,00"=>"e-commerce2800.pdf",
"e-commerce de R$3.200,00"=>"e-commerce3200.pdf",
"e-commerce de R$3.800,00"=>"e-commerce3800.pdf"
);
	?>
             <div id="top_table">

                <div style="position: absolute; color: #445285; font-size: 15px; top: 15px; left: 20px;"><h6>DOCUMENTO</h6></div>

            </div>
    
<?php foreach ($propostas as $valor => $indice ){ ?>
			<div id="bar_table">
				<div class="coluna_table" style="font-size:12px;">
					<div style="position: absolute; top: 11px; left: 15px; width: 300px; text-align: left; ">
						Proposta <?php echo $valor; ?> em PDF;
                   	</div>
   					<div style="position: absolute; top: 11px; left: 813px; width: 100px; text-align: left; ">
						<a href="forca_download.php?arquivo=download/<?php echo $indice;?>" >BAIXAR</a>
                    </div>   
				</div>
			</div>
     
<?php } ?>
  
<?php 
	if(@$_GET["acao"] == "proposta"):

?>
<div id="back-inserir-rep">
	<div class="back-inserir-rep content">

      <form name="contato" method="post" action="index.php?secao=pages/post_contato" style="margin-top: 22px;">
        <?php 
			$sqlRep = @mysql_fetch_object(mysql_query("SELECT * FROM admin WHERE ID = '".$_SESSION["idRep"]."'"));
		?>
        <input type="hidden" name="nomeC" id="nomeC" value="<?php echo $sqlRep->nome; ?>" />
        <input type="hidden" name="emailC" id="emailC" value="<?php echo $sqlRep->email; ?>" />
		<div style="margin-top:10px;">Tipo da Proposta:</div>
        <div><select id="tipo" name="tipo">
        	<option value="Site">Site</option>
            <option value="E-commerce">E-commerce</option>
        </select></div>
        <div style="margin-top:10px;">Valor da proposta</div>
        <div><input onkeypress="mascara(this, Dinheiro);" style="width:450px;" type="text" id="valorProposta" name="valorProposta" required="required" /></div>
        <div style="margin-top:10px;">Observa&ccedil;&otilde;es</div>
        <div>
          <textarea name="msgC" id="msgC" style="width:450px; height:50px; overflow:auto;"></textarea>
        </div>
		<div style="margin-bottom: 25px;">
        	<input style="float:left;" type="submit" name="enviar_contato" value="ENVIAR" id="enviar_contato" alt="Enviar" />
        	<input style="float:left;" type="reset" onclick="javascript: location.href='index.php?secao=pages/visitas';" value="CANCELAR" />
        </div>
            <div class="back-contato resultado_post_contato"></div>
		</form>

    
      	
  </div>
</div>

<p>

  <?php 
	endif;
?>