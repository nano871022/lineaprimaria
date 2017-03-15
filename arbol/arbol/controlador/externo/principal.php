<?php
include_once '../../lib/interface/bean/iBean.php';
include_once "../../controlador/conexion/conexion.php";
require_once "../../lib/utils/utils.php";
require_once "../../dto/Grupo.php";
require_once "../../dto/Referidos.php";
require_once "../../dto/Afiliados.php";
require "../../controlador/listas/listas.php";

class ExternoBean implements iBean{
var $nav;
var $body;
var $head;
var $menu;
function control(){
	$this->navegar();
	if (!empty($this->nav)) {
          if(file_exists("../".$this->nav.".php")){
	   require_once "../" . $this->nav . ".php";
	   if ($page != null) {
	     if ($page instanceof iBean) {
		$page->control ();
		$this->body = $page->pantalla ();
	     }}
	   }else{$this->body = "P&aacute;gina no existe.";}
	}
}
function navegar(){
 $this->nav = $_REQUEST['nav'];
}

function pantalla(){
 $this->control();
 $menu = $this->menu;
 $body = $this->body;
 $head = $this->head;
 require_once "../../vista/externo/externo.php";
}

}
(new ExternoBean())->pantalla();

?>
