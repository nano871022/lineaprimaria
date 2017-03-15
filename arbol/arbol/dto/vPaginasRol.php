<?php
require_once '../../lib/interface/abstract/AbstractDTO.php';
class VPaginasRol extends DTO{
 var $id;
 var $pagina;
 var $nombrPagina;
 var $carpeta;
 var $archivo;
 var $descripcion;
 var $rol;
 var $nombreRol;
 function setRow($row){
	$this->id = $row['llave'];
	$this->pagina = $row['pagina'];
	$this->nombrePagina = $row['nombrePagina'];
	$this->carpeta = $row['carpeta'];
	$this->archivo = $row['archivo'];
	$this->descripcion = $row['descripcion'];
	$this->rol = $row['rol'];
	$this->nombreRol = $row['nombreRol'];
	}
 function alias(){return "v_paginasrol";}
 function where(){$this->asegurarCampos();
	$where = " where ";
	if(!empty($this->id)){
		$where .= strlen($where)>10?" and ":"";
		$where .= "llave = ".$this->id;
	}
	if(!empty($this->pagina)){
		$where .= strlen($where)>10?" and ":"";
		$where .= "pagina= ".$this->pagina;
	}
	if(!empty($this->nombrePagina)){
		$where .= strlen($where)>10?" and ":"";
		$where .= "nombrePagina = ".$this->nombrePagina;
	}
	if(!empty($this->carpeta)){
		$where .= strlen($where)>10?" and ":"";
		$where .= "carpeta = ".$this->carpeta;
	}
	if(!empty($this->archivo)){
		$where .= strlen($where)>10?" and ":"";
		$where .= "archivo= ".$this->archivo;
	}
	if(!empty($this->descripcion)){
		$where .= strlen($where)>10?" and ":"";
		$where .= "descripcion= ".$this->descripcion;
	}
	if(!empty($this->rol)){
		$where .= strlen($where)>10?" and ":"";
		$where .= "rol = ".$this->rol;
	}
	if(!empty($this->nombreRol)){
		$where .= strlen($where)>10?" and ":"";
		$where .= "nombreRol = ".$this->nombreRol;
	}
	return $where;
	}
function select(){$this->asegurarCampos();
 return "select llave,pagina,nombrePagina,carpeta,archivo,descripcion,rol,nombreRol from ".$this->alias();
}
function update(){return "";}
function delete(){return "";}
function insert(){return "";}
function setId($in){
	$this->id = $in;
	}
 function getId(){
	return $this->id;
	}
function setPagina($in){
	$this->pagina = $in;
	}
 function getPagina(){
	return $this->pagina;
	}
function setNombrePagina($in){
	$this->nombrePagina = $in;
	}
 function getNombrePagina(){
	return $this->nombrePagina;
	}
function setCarpeta($in){
	$this->carpeta = $in;
	}
 function getCarpeta(){
	return $this->carpeta;
	}
function setArchivo($in){
	$this->archivo = $in;
	}
 function getArchivo(){
	return $this->archivo;
	}
function setDescripcion($in){
	$this->descripcion = $in;
	}
 function getDescripcion(){
	return $this->descripcion;
	}
function setRol($in){
	$this->rol = $in;
	}
 function getRol(){
	return $this->rol;
	}
function setNombreRol($in){
	$this->nombreRol = $in;
	}
 function getNombreRol(){
	return $this->nombreRol;
	}
}
