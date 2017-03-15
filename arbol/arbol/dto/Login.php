<?php
include_once '../../lib/interface/abstract/AbstractDTO.php';
class LogIn2 extends DTO{
var $usuario;
var $fechaIngreso;
var $fechaSalida;
var $id;
function setRow($row){
$this->usuario = $row['clo_usuario'];
$this->fechaIngreso = $row['dlo_fechaingreso'];
$this->fechaSalida = $row['dlo_fechasalida'];
$this->id = $row['nlo_llave'];
}
function alias(){return "Login";}
function select(){
return "select clo_usuario,nlo_llave,dlo_fechaingreso,dlo_fechasalida from ".$this->alias();
}
function delete(){
return "delete from ".$this->alias()." where nlo_llave = ".$this->id;
}
function update(){
return "update ".$this->alias()." set dlo_fechasalida = current_timestamp() where ".(!empty($this->id)?("nlo_llave = ".$this->id):("clo_usuario = '".$this->usuario."' and dlo_fechasalida is null "));
}
function insert(){
return "insert into ".$this->alias()." (clo_usuario,dlo_fechaingreso) values ('".$this->usuario."',current_timestamp())";
}
function where(){
$where = " WHERE ";
if($this->usuario != null){
$where .= str_len($where)>10?" AND ":"";
$where .= " clo_usuario = '".$this->usuario."'";
}
if($this->fechaIngreso != null){
$where .= str_len($where)>10?" AND ":"";
$where .= " dlo_fechaingreso = '".$this->fechaIngreso."'";
}
if($this->fechaSalida != null){
$where .= str_len($where)>10?" AND ":"";
$where .= " dlo_fechasalida = '".$this->fechasalida."'";
}
if($this->id != null){
$where .= str_len($where)>10?" AND ":"";
$where .= " nlo_llave = ".$this->id;
}
}
function setUsuario($usu){$this->usuario = $usu;}
function getUsuario(){return $this->usuario;}
function setFechaIngreso($in){$this->fechaIngreso = $in;}
function getFechaIngreso(){return $this->fechaIngreso;}
function setFechaSalida($in){$this->fechaSalida = $in;}
function getFechaSalida(){return $this->fechaSalida;}
function setId($id){$this->id = $id;}
function getId(){return $this->id;}
}
?>
