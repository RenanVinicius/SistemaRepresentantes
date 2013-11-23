<?php 

	#Conexão Site
	define("HOST", "localhost");
	define("BANCO", "representantes");
	define("USER", "root");
	define("PASS", "");

	define("VERSAO", "v2.0");
	define("ULTIMA_ATUALIZACAO", "18/11/2013");
	define("DESENVOLVEDOR", "Renan Vinicius");
	define("TITULO", "Webinga - Sistema de representantes");

	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');

	$Connect = mysql_connect(HOST, USER, PASS) or die (mysql_error());
	$Select = mysql_select_db(BANCO) or die (mysql_error());

	if($Connect == false or $Select == false){
		print_r("Erro ao acessar o banco de dados.");
		exit;
	}
	
	/*
	* função para inserir registros no banco de dados
	*
	* @param string $field O nome da coluna
	* @param string $value A informação
	* @param string $table O nome da tabela
	
	Inserir vários campos
	insert(array("nome","idade","profissao"), array("renan",22,"programador"),"cadastro");

	inserir dados em uma única coluna
	insert("nome","Renan","cadastro");
	*
	*/
	function insert($field,$value,$table){
    	if((is_array($field)) and (is_array($value))){
        	if(count($field) == count($value)){
      			$sql = mysql_query("INSERT INTO {$table} (".implode(', ', $field).") VALUES ('".implode('\', \'', $value)."')") or die (mysql_error());
				if($sql){
					return true;
				}else{
					return false;
				}
        	}else{
            	return false;
       		}
    	}else{
			$sql = mysql_query("INSERT INTO {$table} ({$field}) VALUES ({$value})") or die (mysql_error());
			if($sql){
				return true;
			}else{
				return false;
			}
    	}
	}


	/*
	* função para atualizar registros no banco de dados
	*
	*
	* @param string $field O nome do campo
	* @param string $value O novo valor
	* @param string $table O nome da tabela
	* @param string $where Onde será atualizado
	* @return TRUE em caso de sucesso
	
	update(array("tipo","texto"), array("vinicius","nunes"),"textos","WHERE ID = 7");
	*/
	function update($field,$value,$table,$where){
		if((is_array($field)) and (is_array($value))){
			if(count($field) == count($value)){
				$field_value = NULL;
				for ($i=0;$i<count($field);$i++){
					$field_value .= " {$field[$i]} = '{$value[$i]}',";
				}
				$field_value = substr($field_value,0,-1);
				$update = mysql_query("UPDATE {$table} SET {$field_value} {$where}") or die (mysql_error());
				if($update){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			$update = mysql_query("UPDATE {$table} SET {$field} = '{$value}' {$where}") or die (mysql_error());
			if($update){
				return true;
			}else{
				return false;
			}
		}
	}
	/*
	* método para remover registros em uma tabela
	*
	*
	* @param string $table O nome da tabela
	* @param string $where O campo e o valor(condição para deletar)
	*
	*/
	// cuidado! Se não informar a condição para deletar, todos os registros da tabela serão deletados    
	function delete($table,$where=NULL){
		$delete = mysql_query("DELETE FROM {$table} {$where}");
		if($delete){
			return true;
		}else{
			return false;
		}
	}
	
	function uniqSelect($tabela, $campo, $where = ''){
		$sql = @mysql_fetch_object(mysql_query("SELECT $campo FROM $tabela {$where}"));
		return @$sql->$campo;
	}
	
	function numRows($table, $where){
		return @mysql_num_rows(mysql_query("SELECT * FROM {$table} {$where}"));
	}
	
?>