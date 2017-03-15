<?php
include_once '../../lib/interface/bean/iBean.php';
include_once '../../dto/Modificaciones.php';
$page = null;
class ModificacionesBean implements iBean{
var $enlace;
var $lista;
var $msn;
var $permisos;
var $paginas;
var $pagina;
 var $cantidad;
function control(){
 $this->cantidad = 10;
 $this->permisos = unserialize($_SESSION['permisos']);
 $this->enlace = new Conexion();
 $this->msn = "";
 $this->lista = array();
 $this->request();
 $this->obtenerRegistros();
}
function request(){
 $this->pagina = $_REQUEST['pagina'];
 $this->pagina = $this->pagina!=null&&$this->pagina>=0?$this->pagina:0;
 } 

function obtenerRegistros(){
 $mod = new Modificaciones();
 $cantidad = $this->enlace->cantidad($mod);
 $this->paginas = ceil($cantidad / $this->cantidad);
 
$mod->setRegistroInicial($this->pagina*$this->cantidad);
 $mod->setCantidad($this->cantidad);
 $result = $this->enlace->select($mod);
 if($result != null){
  if($result != false){
       $this->lista = $result;
  }else{
	$this->msn = "<font color='red'>".$this->enlace->error."</font>";
	}
 }
 
}
function pantalla(){
$send = array();
$send[] = $this->lista;
$send[] = $this->msn;
$send[] = $this->pagina;
$send[] = $this->paginas;
return requireAVariable('../../vista/usuario/modificaciones.php',serialize($send));
}
}
$page = new ModificacionesBean();
?>
