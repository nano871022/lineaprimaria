<?php
require_once "../../lib/interface/bean/iBean.php";
$page = null;
class Arbol implements iBean{
	var $grupo;
	function control(){
		if($_SESSION['grupo'] != null){
		$this->grupo    = unserialize($_SESSION['grupo']);
		}
	}
	function pantalla(){
		$body = "";
		if($this->grupo != null){
			$body = $this->grupo;
		}
	   return requireAVariable("../../vista/nodos/arbol.php",serialize($body));
	}
}
$page = new Arbol();
?>
