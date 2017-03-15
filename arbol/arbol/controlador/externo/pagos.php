<?php
global $page;
$page = null;
class PagosBean implements iBean{
 var $ifile; 
 var $body;
  function control(){
	   $this->ifile = "../../vista/externo/pago.php";
	}
  function pantalla(){
		return requireAVariable ( $this->ifile, $this->body );
	}
}
$page = new PagosBean();
?>
