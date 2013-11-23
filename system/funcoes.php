<?php 


	function procpalavras ($frase, $palavras, $resultado = 0) {
	      foreach ( $palavras as $key => $value ) {
	      $pos = strpos($frase, $value);
	      if ($pos !== false) { $resultado = 1; break; }
	      } 
	  return $resultado;
	}

	function geraLogin($var1, $var2){
		return substr($var1, 0, 3).substr($var2, 0, 3);
	}

	#Função para verificar a força da senha
	/*
	COMO USAR
	$teste = verificaSenha($senha);

	switch($teste){
	        case 1: echo "Senha Ruim!"; break;
	        case 2: echo "Senha Fraca!"; break;
	        case 3: echo "Senha Boa!"; break;
	        case 4: echo "Senha Ótima!"; break;
	        case 5: echo "Senha Excelente!"; break;
	}
	*/
	function verificaSenha($pass){
		
		$len = strlen($pass);
		$count = 0;
		$array = array("[[:lower:]]+", "[[:upper:]]+", "[[:digit:]]+", "[!#_-]+");
	        
		foreach($array as $a){
			if(ereg($a, $pass)){
				$count++;
			}
		}
	        
		if($len > 10){
			$count++;
		}

		return $count;

	}

	#Função para forçar o usuário a digitar letras e números na senha
	function senhaLetrasNumeros($senha){
		$senhaDigitada = intval(preg_match('/^[a-z\d]+$/i', $senha) && preg_match('/[a-z]/i', $senha) && preg_match('/\d/', $senha));
		if($senhaDigitada == 1){
			return true;
		}else{
			return false;
		}
	}



	function anti_inject($campo, $adicionaBarras = false) {
		$campo = preg_replace("/(from|alter table|select|insert|delete|update|where|drop table|show tables|#|\*|--|\\\\)/i","",$campo);
		$campo = trim($campo);
		$campo = strip_tags($campo);
			if($adicionaBarras || !get_magic_quotes_gpc())
				$campo = addslashes($campo);
				return $campo;
	}
 
	function tira_acentos($val){
	  return @ereg_replace("[^a-zA-Z0-9_]","-", strtr((strtolower($val)), "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ","aaaaeeiooouucaaaaeeiooouuc-"));
	}

	function validaCPF($cpf){
		$cpf = @str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
		if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999'){
			return false;
		}else{
			for($t = 9; $t < 11; $t++) {
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
			}
				$d = ((10 * $d) % 11) % 10;
				if ($cpf{$c} != $d) {
					return false;
				}
			}
			return true;
		}
	}

	function validaCNPJ($cnpj){
		$pontos = array(',','-','.','','/');
		$cnpj = str_replace($pontos,'',$cnpj);
		$cnpj = trim($cnpj);
		if(empty($cnpj) || strlen($cnpj) != 14) return FALSE;
		else {
			if(check_fake($cnpj,14)) return FALSE;
			else {
				$rev_cnpj = strrev(substr($cnpj, 0, 12));
				for ($i = 0; $i <= 11; $i++) {
					$i == 0 ? $multiplier = 2 : $multiplier;
					$i == 8 ? $multiplier = 2 : $multiplier;
					$multiply = ($rev_cnpj[$i] * $multiplier);
					$sum = $sum + $multiply;
					$multiplier++;
	
				}
				$rest = $sum % 11;
				if ($rest == 0 || $rest == 1)  $dv1 = 0;
				else $dv1 = 11 - $rest;
				
				$sub_cnpj = substr($cnpj, 0, 12);
				$rev_cnpj = strrev($sub_cnpj.$dv1);
				unset($sum);
				for ($i = 0; $i <= 12; $i++) {
					$i == 0 ? $multiplier = 2 : $multiplier;
					$i == 8 ? $multiplier = 2 : $multiplier;
					$multiply = ($rev_cnpj[$i] * $multiplier);
					$sum = $sum + $multiply;
					$multiplier++;
	
				}
				$rest = $sum % 11;
				if ($rest == 0 || $rest == 1)  $dv2 = 0;
				else $dv2 = 11 - $rest;
	
				if ($dv1 == $cnpj[12] && $dv2 == $cnpj[13]) return true; //$cnpj;
				else return false;
			}
		}
	}

	function validaCep($cep) {
		$cep = trim($cep);
		$avaliaCep = @ereg("^[0-9]{5}-[0-9]{3}$", $cep);
		if(!$avaliaCep) {            
			return false;
		}else{
			return true;
		}
	}


	function validaEmail($email){
		if(preg_match ("/^[A-Za-z0-9]+([_.-][A-Za-z0-9]+)*@[A-Za-z0-9]+([_.-][A-Za-z0-9]+)*\\.[A-Za-z0-9]{2,4}$/", $email)){
			return true;
		}else{
			return false;
		}
	}

	#Função para inverter data do formato 2013-06-19 para 19/06/2013
	function inverteData($data, $separar = '-', $juntar = '-'){
		return str_replace("-", "/", implode($juntar, array_reverse(explode($separar, $data))));
	}

	#Função para inverter data do formato 19/06/2013 para 2013-06-19
	function inverteDataSql($data){
		return implode("-",array_reverse(explode("/",$data)));
	}
	
	#Função para separa data
	function separaData($data, $val){
		
		$arrayData = explode("/", inverteData($data));

		if($val == "dia/mes"){

			return $arrayData[0]."/".$arrayData[1]; // Ex: 31/12

		}elseif($val == "mes/ano"){

			return $arrayData[1]."/".$arrayData[2]; //  Ex: 12/2013

		}elseif($val == "dia"){

			return $arrayData[0]; // Ex: 31

		}elseif($val == "mes"){

			return $arrayData[1]; // Ex: 12

		}elseif($val == "ano"){

			return $arrayData[2]; // Ex: 2013

		}else{
			return "erro";
		}

		
	}

	
	function pegaExt($nome_arq){
		$ext = explode('.',$nome_arq);
		$ext = array_reverse($ext);
			return $ext[0];
	}

	#Retorna o tamanho de um arquivo
	function tamanhoArquivo($arquivo) {
		$tamanhoarquivo = filesize($arquivo);
		/* Medidas */
		$medidas = array('KB', 'MB', 'GB', 'TB');
		/* Se for menor que 1KB arredonda para 1KB */
		if($tamanhoarquivo < 999){
			$tamanhoarquivo = 1000;
		}
		for ($i = 0; $tamanhoarquivo > 999; $i++){
			$tamanhoarquivo /= 1024;
		}
		return round($tamanhoarquivo) . $medidas[$i - 1];
	}

	#Função para cortar textos.	
	function truncate($str, $len, $etc='') {
		$end = array(' ', '.', ',', ';', ':', '!', '?');
		if (strlen($str) <= $len)
			return $str;
		if (!in_array($str{$len - 1}, $end) && !in_array($str{$len}, $end))
			while (--$len && !in_array($str{$len - 1}, $end));
			return rtrim(substr($str, 0, $len)).$etc;
	}
	

	#Função para apagar pasta completa
	function deleta_pasta($rootDir){
		if (!is_dir($rootDir)){
			return false;
		}
		if (!preg_match("/\\/$/", $rootDir)){
			$rootDir .= '/';
		}
		$dh = opendir($rootDir);
		while (($file = readdir($dh)) !== false){
			if ($file == '.'  ||  $file == '..'){
				continue;
			}
			if (is_dir($rootDir . $file)){
				removeTreeRec($rootDir . $file);
			}elseif (is_file($rootDir . $file)){
				unlink($rootDir . $file);
			}
		}
		closedir($dh);
		rmdir($rootDir);
		return true;
	}
	
	#Função para criar url curta
	function urlCurta($GetUrl){
		$url = urlencode($GetUrl);
		# Posta URL via GET para o Migre.me (verifique se o seu servidor possui suporte à função "file_get_contents")
		$return = @file_get_contents ("http://migre.me/api.json?url={$url}");
		# Converte JSON em array
		$return = json_decode($return);
		# Obtém URL curta
		return $return->migre;
	}
	
	#soNumeros: Deixa somente números em uma string
	function soNumeros($fonte) {
		return preg_replace("/[^0-9]/","",$fonte);
	}
	
	
	#formataValor: Formata um número para reais (1000.00 -> 1.000,00)
	function formataValor($valor){
		if (!empty($valor)){
			return number_format($valor,2,',','.');
		} else {
			return "0,00";
		}
	}
	
	#nomeMes: retorna o mês do ano
	function nomeMes($mes) { 
		switch($mes) {
			case 1: return "Janeiro"; break;
			case 2: return "Fevereiro"; break;
			case 3: return "Março"; break;
			case 4: return "Abril"; break;
			case 5: return "Maio"; break;
			case 6: return "Junho"; break;
			case 7: return "Julho"; break;
			case 8: return "Agosto"; break;
			case 9: return "Setembro"; break;
			case 10: return "Outubro"; break;
			case 11: return "Novembro"; break;
			case 12: return "Dezembro"; break;
		}			
	}
	
	#nomeDia: retorna o dia da semana (1-dom , 7-sáb)
	function nomeDia($dia) { 
		switch($dia) {
			case 1: return "Domingo"; break;
			case 2: return "Segunda-feira"; break;
			case 3: return "Terça-feria"; break;
			case 4: return "Quarta-feira"; break;
			case 5: return "Quinta-feira"; break;
			case 6: return "Sexta-feira"; break;
			case 7: return "Sábado"; break;
		}			
	}
	
	function diaMes($q){
		$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
		$diasdasemana = array (1 => "Segunda-Feira",2 => "Terça-Feira",3 => "Quarta-Feira",4 => "Quinta-Feira",5 => "Sexta-Feira",6 => "Sábado",0 => "Domingo");
		$hoje = getdate();
		$dia = $hoje["mday"];
		$mes = $hoje["mon"];
		$nomemes = $meses[$mes];
		$ano = $hoje["year"];
		$diadasemana = $hoje["wday"];
		$nomediadasemana = $diasdasemana[$diadasemana];
		
		if($q == "dia"){
			return $nomediadasemana;
		}elseif($q == "mes"){
			return $nomemes;
		}else{
			return false;
		}
	}
	
	function senhaAleatoria($tamanho) {
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((double)microtime()*1000000);
		$i = 1;
		$pass = '' ;
		while ($i <= $tamanho) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
		return $pass;
	}
	
	
	#ListaDiretorio: lista o conteúdo de um diretório									
	function ListaDiretorio($diretorio, $tipoarquivo=null){ 
		$d = dir($diretorio); // Abrindo diretório 
		// Fazendo buscar por um arquivo ou diretorio de cada vez que estejam dentro da pasta especificada 
		while (false !== ($entry = $d->read())) {
			if ($tipoarquivo == '') {
				$array[] = $entry;
			}
			else if ($tipoarquivo == 'dir') {  
				// Verificando se o que foi encontrado é um diretorio 
				if (substr_count($entry, '.') == 0){
					// Se sim colocando na matriz 
					$array[] = $entry;
				}
			}
			else { 
				// Verificando se o que foi encontrado um arquivo especifico 
				if (substr_count($entry, $tipoarquivo) == 1) {
					// Se sim colocando na matriz 
					$array[] = $entry; 
				} // end if
			} // end if
		} // end while
	
		//Fechando diretorio 
		$d->close(); 
		if ($array=='') { 
			$array = false; 
		}
		else { 			
			sort ($array); // Colocando em ordem alfabetica 
			reset ($array); // Voltando o ponteiro para o inicio da matriz 
		} 
		return $array; // Retornado resultado final 
	}
?>	