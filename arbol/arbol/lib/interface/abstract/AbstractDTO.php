<?php
require_once '../../lib/interface/dto/iDTO.php';
require_once '../../lib/interface/dto/iCamposDTO.php';
abstract class DTO implements iDTO,iCamposDTO{
 var $id;
 var $usuario;
 var $fechaIngreso;
 var $fechaModificado;
var $registroInicial;
var $cantidad;
 function setRegistroInicial($in){
$this->registroInicial = $in;
}
function setCantidad($in){
$this->cantidad = $in;
}
function getRegistroInicial(){
return  $this->registroInicial;
}
function getCantidad(){
return $this->cantidad;
}
 function setId($in){
	$this->id = $in;
	}
function getId(){
	return $this->id;
	}
 function setUsuario($in){
	$this->usuario = $in;
	}
function getUsuario(){
	return $this->usuario;
	}
function setFechaIngreso($in){
	$this->fechaIngreso = $in;
	}
function getFechaIngreso(){
	return $this->fechaIngreso;
	}
 function setFechaModificado($in){
	$this->fechaModificado = $in;
	}
function getFechaModificado(){
	return $this->fechaModificado;
	}
function asegurarCampos(){
  $campos = $this; 
  foreach ($campos as $nombre => $valor){
	 if(is_string($valor)){
		$this->$nombre =$this->validarTextos($valor);
		}
	}
}
function validarTextos($cadena){
//$cadena = "\" or ngr_llave is not null < > ' \"";
	$patrones = array();
 	$sustituciones = array();
	$patrones[1] = "/</";
	$patrones[2] = "/>/";
	$patrones[3] = "/\"/";
	$patrones[4] = "/\'/";
	$sustituciones[1] = "&lt;";
	$sustituciones[2] = "&gt;";
	$sustituciones[3] = "&quot;";
	$sustituciones[4] = "&acute;";
 return preg_replace($patrones,$sustituciones,$cadena);
}
}
