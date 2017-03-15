<?php
require_once '../../lib/interface/abstract/AbstractDTO.php';
class Nuevos extends DTO{
var $id;
var $grupo;
var $fecha;
var $fechaWhatsapp;
var $whatsapp;
function alias(){
return "Nuevos";
}
function setRow($row){
$this->id            = $row['nnu_llave'];
$this->grupo         = $row['nnu_grupo'];
$this->fecha         = $row['dnu_fecha'];
$this->fechaWhatsapp = $row['dnu_fechaws'];
$this->whatsapp      = $row['cnu_whatsapp'];
}
function select(){$this->asegurarCampos();
return "select nnu_llave,nnu_grupo,dnu_fecha,dnu_fechaws,cnu_whatsapp from ".$this->alias();
}
function delete(){$this->asegurarCampos();
return "delete from ".$this->alias()." where  nnu_llave = ".$this->id;
}
function updateWhatsapp(){$this->asegurarCampos();
return "update ".$this->alias()." set dnu_fechaws=CURDATE(), cnu_whatsapp='".$this->whatsapp."' where nnu_llave =".$this->id;
}
function update(){$this->asegurarCampos();
return "update ".$this->alias()." set nnu_grupo = ".$this->grupo.", dnu_fecha='".$this->fecha."', dnu_fechaws='".$this->fechaWhatsapp."', cnu_whatsapp='".$this->whatsapp."' where nnu_llave =".$this->id;
}
function insert(){$this->asegurarCampos();
return "insert into ".$this->alias()." (nnu_grupo,dnu_fecha) values (".$this->grupo.",CURDATE())";
}
function where(){$this->asegurarCampos();
$where = " where ";
if(!empty($this->id)){
$where  .= strlen($where)>10?" and ":"";
$where .= "nnu_llave = ".($this->id);
}
if(!empty($this->grupo)){
$where .= strlen($where)>10?" and ":"";
$where .= "nnu_grupo = ".($this->grupo);
}
if(!empty($this->fecha)){
$where .= strlen($where)>10?" and ":"";
$where .= "dnu_fecha = ".($this->fecha);
}
if(!empty($this->fechaWhatsapp)){
$where .= strlen($where)>10?" and ":"";
$where .= "dnu_fechaws = ".($this->fechaWhatsapp);
}
if(!empty($this->whatsapp)){
$where .= strlen($where)>10?" and ":"";
$where .= "cnu_whatsapp = ".($this->whatsapp);
}
return $where;
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
}
?>
