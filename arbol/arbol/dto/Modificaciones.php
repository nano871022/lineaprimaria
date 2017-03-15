<?php
include_once '../../lib/interface/abstract/AbstractDTO.php';
class Modificaciones extends DTO{
var $id;
var $tabla;
var $campo;	  
var $idRegistro;
var $anterior;	
var $nuevo;     
var $fechaModificado;
var $regresar;	
var $fechaRegresar;

function alias(){
return "Modificaciones";
}

function setRow($row){
$this->id              = $row['nmo_llave'];
$this->tabla           = $row['cmo_tabla'];
$this->campo           = $row['cmo_campo'];	   
$this->idRegistro      = $row['nmo_idregistro'];
$this->anterior        = $row['cmo_anterior'];
$this->nuevo           = $row['cmo_nuevo'];     
$this->fechaModificado = $row['dmo_modificado'];
$this->regresar        = $row['cmo_regresar'];	
$this->fechaRegresar   = $row['dmo_regresar'];
}

function select(){$this->asegurarCampos();
return "select cmo_tabla,cmo_campo,nmo_idregistro,cmo_anterior,cmo_nuevo,dmo_modificado,cmo_regresar,dmo_regresar from ".$this->alias();
}
function update(){
return "";
}
function insert(){
return "";
}
function delete(){
return "";
}
function where(){$this->asegurarCampos();
$where = " where ";
if(!empty($this->tabla)){
$where .= strlen($where)>10?" and ":"";   
$where .= "cmo_tabla ='".($this->tabla)."'";     
}
if(!empty($this->id)){
$where .= strlen($where)>10?" and ":"";   
$where .= "nmo_llave =".($this->id);     
}
if(!empty($this->campo           )){
$where .= strlen($where)>10?" and ":"";
$where .= "cmo_campo ='".($this->campo)."'";     
}

if(!empty($this->idRegistro      )){
$where .= strlen($where)>10?" and ":"";
$where .= "nmo_idregistro =".($this->idRegistro);     
}

if(!empty($this->anterior        )){
$where .= strlen($where)>10?" and ":"";
$where .= "cmo_anterior ='".($this->anterior)."'";     
}

if(!empty($this->nuevo           )){
$where .= strlen($where)>10?" and ":"";
$where .= "cmo_nuevo ='".($this->nuevo)."'";     
}

if(!empty($this->fechaModificado )){
$where .= strlen($where)>10?" and ":"";
$where .= "dmo_modificaco ='".($this->modificado)."'";     
}

if(!empty($this->regresar        )){
$where .= strlen($where)>10?" and ":"";
$where .= "cmo_regresar ='".($this->regresar)."'";     
}

if(!empty($this->fechaRegresar   )){
$where .= strlen($where)>10?" and ":"";
$where .= "dmo_regresar ='".($this->fechaRegresar)."'";     
}
}

function setId($in){
$this->id = $in;
}
function setTabla($in){
$this->tabla = $in;
}

function setCampo($in){  
$this->campo = $in;
}

function setIdRegistro($in){
$this->idRegistro = $in;
}
function setAnterior($in){
$this->anterior = $in;
}
function setNuevo($in){
$this->nuevo = $in;
}
function setFechaModificado($in){
$this->fechaModificado = $in;
}
function setRegresar($in){	
$this->regresar = $in;
}
function setFechaRegresar($in){
$this->fechaRegresar = $in;
}

function getId(){
return $this->id;
}
function getTabla(){
return $this->tabla;
}
function getCampo(){  
return $this->campo;
}
function getIdRegistro(){
return $this->idRegistro;
}
function getAnterior(){	
return $this->anterior;
}
function getNuevo(){     
return $this->nuevo;
}
function getFechaModificado(){
return $this->fechaModificado;
}
function getRegresar(){	
return $this->regresar;
}
function getFechaRegresar(){
return $this->fechaRegresar;
}
}
?>
