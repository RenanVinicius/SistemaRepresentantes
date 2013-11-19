<?php 
	
	//Cria a classe
	class AdminLogado{
		
		//Se existir, captura os valores das sessões
		private $email_session;
		private $senha_session;
		
		public function SetDados($email_session, $senha_session){
			$this->email_session = $email_session;
			$this->senha_session = $senha_session;
		}		
		
		private function GetDados(){
			return $this->email_session;
			return $this->senha_session;
		}		
		
		public function MostraResultado(){
			if($this->email_session == false or $this->senha_session == false){
				return false;
			}else{
				$consulta = mysql_query("SELECT * FROM admin WHERE email = '".$this->email_session."' AND senha = '".$this->senha_session."'");
				if(mysql_num_rows($consulta) == false){
					return false;
				}else{
					$ln = mysql_fetch_object($consulta);
					if($this->email_session == $ln->email and $this->senha_session == $ln->senha){
						return true;
					}else{
						return false;
					}
				}
			}
		}
	
	}
	
	$AuthAdmin = new AdminLogado();
	$AuthAdmin->SetDados(@$_SESSION["email_admin"], @$_SESSION["senha_admin"]);
	$AuthAdmin->MostraResultado();
	
?>