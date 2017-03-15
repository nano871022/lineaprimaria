<?php
require_once "../../lib/interface/bean/iBean.php";
$page = null;

class RefAfi{
	var $grupo;
	var $afiliado;
	var $aumento;
	var $gActual;
	function setAfiliado($in){
		$this->afiliado = $in;
	}
	function getAfiliado(){
		return $this->afiliado;
	}
	function setAumento($in){
		$this->aumento = $in;
	}
	function getAumento(){
		return $this->aumento;
	}

	function setGActual($in){
		$this->gActual = $in;
	}
	function getGActual(){
		return $this->gActual;
	}

	function setGrupo($in){
		$this->grupo = $in;
	}
	function getGrupo(){
		return $this->grupo;
	}
}//end class ref afi

class Referido implements iBean{
	var $body;
	var $enlace;
	function control(){
		$this->enlace = (new Conexion())->connect();
		$this->body = new RefAfi();
		if(($_REQUEST['id']) == null){
			if($_SESSION['grupo'] != null){
				$this->body->setGrupo(unserialize($_SESSION['grupo']));
			}
		
			if($_SESSION['afiliado'] != null){
				$this->body->setAfiliado(unserialize($_SESSION['afiliado']));
			}
		}else{
			$grupo = new Grupo();
			$grupo->setId($_REQUEST['id']);
			$sql = $grupo->select().$grupo->where();
			$result = $this->enlace->query($sql);
			if($result != null){
				if($row = $result->fetch_array()){
					$grupo->setRow($row);
				}
			}	
			$afiliado = new Afiliados();
			$afiliado->setId($grupo->getAfiliado());
			$sql = $afiliado->select().$afiliado->where();
			$result = $this->enlace->query($sql);
			if($result != null){
				if($row = $result->fetch_array()){
					$afiliado->setRow($row);
				}
			}
			$temp[] = $grupo;
			$this->body->setGrupo($temp);
			$this->body->setAfiliado($afiliado);
		}//end else
		$this->body->setAumento(5);
		$this->body->setGActual(1);
	}
	function pantalla(){
		
		$body = "";
		if($this->body != null){
			$body = $this->body;
		}
	   return requireAVariable("../../vista/afiliados/referido.php",serialize($body));
	}
}//end referido
$page = new Referido();
?>
