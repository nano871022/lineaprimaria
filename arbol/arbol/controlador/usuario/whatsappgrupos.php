<?php
require_once '../../lib/interface/bean/iBean.php';
require_once '../../dto/Referidos.php';
require_once '../../dto/ReferidoWhatsapp.php';
require_once '../../dto/WhatsappGrupos.php';
$page = null;
class WhatsappGruposBean implements iBean {
	var $enlace;
	var $body;
	var $msn;
	function control() {
		$this->enlace = (new Conexion ())->connect ();
	}
	function obtenerGrupoActual() {
		
	}
	function pantalla() {
		$save = array ();
		$save [] = $this->grupo;
		$save [] = $this->msn;
		$body = serialize ( $save );
		return requireAVariable ( "../../vista/usuario/whatsappgrupos.php", $body );
	}
}
$page = new WhatsappGruposBean ();
?>