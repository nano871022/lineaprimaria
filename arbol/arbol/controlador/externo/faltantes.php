<?php
global $page;
$page = null;
class FaltantesBean implements iBean{
 var $ifile; 
 var $body;
  function control(){
	   $this->ifile = "../../vista/externo/faltante.php";
	}
  function pantalla(){
		return requireAVariable ( $this->ifile, $this->body );
	}
}
$page = new FaltantesBean();
?>
