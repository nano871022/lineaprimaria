<?php
require_once '../../lib/interface/abstract/AbstractDTO.php';
class NuevosAgregados extends DTO{
var $id;
var $grupo;
var $fecha;
var $fechaWhatsapp;
var $whatsapp;
var $afiliado;
var $nombres;
var $apellidos;
var $celular;
var $nombreWhatsapp;
var $buscar;
function alias(){
return "NuevosAgregados";
}
function setRow($row){
$this->id             = $row['llave'];
$this->grupo          = $row['grupo'];
$this->fecha          = $row['fecha'];
$this->fechaWhatsapp  = $row['fechaWhatsapp'];
$this->whatsapp	      = $row['whatsapp'];
$this->nombres        = $row['nombres'];
$this->afiliado       = $row['afiliado'];
$this->apellidos      = $row['apellidos'];
$this->celular        = $row['celular'];
$this->nombreWhatsapp = $row['nombreWhatsapp'];
}
function select(){$this->asegurarCampos();
return "select llave,grupo,fecha,fechaWhatsapp,whatsapp,afiliado,nombres,apellidos,celular,nombreWhatsapp from ".$this->alias();
}
function cantidad(){$this->asegurarCampos();
return "select count(*) as cantidad from ".$this->alias();
}
function delete(){
return "";
}

function update(){
return "";
}

function insert(){
return "";
}
function where(){$this->asegurarCampos();
$where = " where ";
if(!empty($this->id)){
$where  .= strlen($where)>10?" and ":"";
$where .= "llave = ".($this->id);
}
if(!empty($this->grupo)){
$where .= strlen($where)>10?" and ":"";
$where .= "grupo = ".($this->grupo);
}
if(!empty($this->fecha)){
$where .= strlen($where)>10?" and ":"";
$where .= "fecha = '".($this->fecha)."'";
}
if(!empty($this->fechaWhatsapp)){
$where .= strlen($where)>10?" and ":"";
$where .= "fechaWhatsapp = '".($this->fechaWhatsapp)."'";
}
if(!empty($this->whatsapp)){
$where .= strlen($where)>10?" and ":"";
$where .= "whatsapp = '".($this->whatsapp)."'";
}
if(!empty($this->nombres)){
$where .= strlen($where)>10?" and ":"";
$where .= "nombres = '".($this->nombres)."'";
}
if(!empty($this->apellidos)){
$where .= strlen($where)>10?" and ":"";
$where .= "apellidos = '".($this->apellidos)."'";
}
if(!empty($this->celular)){
$where .= strlen($where)>10?" and ":"";
$where .= "celular = '".($this->celular)."'";
}
if(!empty($this->nombreWhatsapp)){
$where .= strlen($where)>10?" and ":"";
$where .= "nombreWhatsapp like '%".($this->nombreWhatsapp)."%'";
}
if(!empty($this->afiliado)){
$where .= strlen($where)>10?" and ":"";
$where .= "afiliado = ".($this->afiliado);
}
if(!empty($this->buscar)){
$where .= strlen($where)>10?" and ":"";
$where .= " (nombreWhatsapp like '%".($this->nombreWhatsapp)."%' and nombres like '%".htmlspecialchars($this->buscar)."%' or apellidos like '%".htmlspecialchars($this->buscar)."%'  or celular like '%".htmlspecialchars($this->buscar)."%' or fecha = '".htmlspecialchars($this->buscar)."')";
}
return $where;
}
function setBuscar($in){
$this->buscar = $in;
}
function getBuscar(){
return $this->buscar;
}
function setAfiliado($in){
$this->afiliado = $in;
}
function getAfiliado(){
return $this->afiliado;
}
function setId($id){
$this->id = $id;
}
function setGrupo($grupo){
$this->grupo = $grupo;
}
function setFecha($fecha){
$this->fecha = $fecha;
}
function setFechaWhatsapp($fechaws){
$this->fechaWhatsapp = $fechaws;
}
function setWhatsapp($ws){
$this->whatsapp = $ws;
}
function setNombres($in){
$this->nombres = in;
}
function setApellidos($in){
$this->apellidos = $in;
}
function setCelular($in){
$this->celular = $in;
}
function setNombreWhatsapp($in){
$this->nombreWhatsapp = $in; 
}
function getId(){
return $this->id;
}
function getGrupo(){
return $this->grupo;
}
function getFecha(){
return $this->fecha;
}
function getFechaWhatsapp(){
return $this->fechaWhatsapp;
}
function getWhatsapp(){
return $this->whatsapp;
}
function getNombres(){
return $this->nombres;
}
function getApellidos(){
return $this->apellidos;
}
function getCelular(){
return $this->celular;
}
function getNOmbreWhatsapp(){
return $this->nombreWhatsapp;
}
}
?>
