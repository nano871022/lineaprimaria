<?php
require_once  '../../lib/interface/bean/iBean.php';
require_once '../../dto/Nuevos.php';
require_once '../../dto/NuevosAgregados.php';
require_once '../../controlador/procesar/generarvcard.php';
$page = null;
class ListaNuevosBean implements iBean{
var $enlace;
var $body;
var $msn;
var $buscar;
var $cantidad;
var $cantidadP;
var $pagina;
var $seleccionar;
var $whatsapp;
var $nombreWhatsapp;
var $agregadoWhatsapp;
function control(){
$this->cantidad = 10;
 $this->enlace = (new Conexion())->connect();
$this->body = "";
$this->msn = "";
if($this->validar()){
if(count($this->seleccionar)>0){
$this->generarVCard();
}
if(count($this->whatsapp)>0){
$this->actualizarWhatsapp();
}
}
$this->obtenerRegistros();
}

function generarVCard(){
$afiliados = $this->obtenerAfiliados();
$vcard = new GenerarVCard();
  $vcard->setAfiliados($afiliados);
  $file = $vcard->generarVCard();
if(!empty($file)){
 $this->msn = "<a href='./$file'>VCard </a>";
}
}
function obtenerAfiliados(){
$afiliados = array();
foreach($this->seleccionar as $id){
$nuevo = new Nuevos();
$nuevo->setId($id);
$query = $nuevo->select().$nuevo->where();
$result = $this->enlace->query($query);
if($result != null){
if($row = $result->fetch_array()){
$nuevo->setRow($row);
$afiliados[] = $this->obtenerGrupo($nuevo->getGrupo());
}}}
return $afiliados;
}
function obtenerGrupo($id){
$grupo = new Grupo();
$grupo->setId($id);
$query = $grupo->select().$grupo->where();
$result = $this->enlace->query($query);
if($result != null){
if($row = $result->fetch_array()){
$grupo->setRow($row);
return $this->obtenerAfiliado($grupo->getAfiliado());
}}
}
function obtenerAfiliado($id){
$afiliado= new Afiliados();
$afiliado->setId($id);
$query = $afiliado->select().$afiliado->where();
$result = $this->enlace->query($query);
if($result != null){
if($row = $result->fetch_array()){
$afiliado->setRow($row);
}}
return $afiliado;
}
function actualizarWhatsapp(){
foreach($this->whatsapp as $id){
$nuevo = new Nuevos();
$nuevo->setId($id);
$nuevo->setWhatsapp("S");
$query = $nuevo->updateWhatsapp();
$result = $this->enlace->query($query);
if($result == null){
  $this->msn = "<font color='red'>El registro $id no se logro actualizar</font>";
}
}
}
function validar(){
$this->buscar           = $_REQUEST['buscar'];
$this->pagina           = $_REQUEST['page'];
$this->nombreWhatsapp   = $_REQUEST['nombreWhatsapp'];
$this->agregadoWhatsapp = $_REQUEST['agregadoWhatsapp'];
if(empty($this->pagina)){
$this->pagina = 0;
}   
$this->seleccionar = $_REQUEST['seleccionar'];
$this->whatsapp = $_REQUEST['whatsapp'];
if(count($this->seleccionar) >0 or count($this->whatsapp)){
return true;
}
return false;
}
function obtenerRegistros(){
 $this->body = array();
 $nuevo = new NuevosAgregados();
 $nuevo ->setBuscar($this->buscar);
 $nuevo->setWhatsapp($this->agregadoWhatsapp=="S"?"S":"N");
 $nuevo->setNombreWhatsapp($this->nombreWhatsapp);
 $cantidad = $this->cantidad($nuevo);
 $query = $nuevo->select().$nuevo->where()." order by fecha desc limit ".($this->pagina*$this->cantidad).",".$this->cantidad;
 $this->cantidadP = round(($cantidad/$this->cantidad)+0.5);
 $result = $this->enlace->query($query);
 if($result != null){
  while($row = $result->fetch_array()){
 $temp = new NuevosAgregados();
 $temp->setRow($row);
 $temp->setBuscar($this->buscar);
 $this->body[] = $temp;
}//end while
}//end if
}//end obtener registros

function cantidad($dto){
$cant = 0;
$query = $dto->cantidad().$dto->where();
$result = $this->enlace->query($query);
if($result != null){
if($row = $result->fetch_array()){
$cant = $row['cantidad'];
}
}
return $cant;
}
function pantalla(){
$send = array();
$send[] = $this->body;
$send[] = $this->msn;
$send[] = $this->pagina;
$send[] = $this->cantidadP;
$send[] = $this->nombreWhatsapp;
$send[] = $this->agregadoWhatsapp;
return requireAVariable("../../vista/nuevos/listanuevos.php",serialize($send));
}
}
$page = new ListaNuevosBean();
?>
