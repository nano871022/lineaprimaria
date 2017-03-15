<?php
include_once '../../lib/interface/abstract/AbstractDTO.php';
/**
 * Se encarga de crar la clase para manejar los afiliados y saber de quien es referidos o quien los refirio
 * @author JALEJ
 *
 */
class Usuarios extends DTO{
	var $usuario;
	var $password;
	var $afiliado;
	var $numeroIntentos;
	var $estado;
	var $rol;
	var $fechaBloqueo;
	var $fechaDesbloqueo;
	var $bloqueo;
	var $oRol;
	
	
	function setORol($object){
		$this->oRol;
	}
	function getORol(){
		return $this->oRol;
	}
	function setRow($row) {
		if (count ( $row ) > 0) {
			$this->usuario 		  = $row ['cus_usuario'];
			$this->password       = $row ['cus_password'];
			$this->afiliado       = $row ['nus_afiliado'];
			$this->numeroIntentos = $row ['nus_intentos'];
			$this->estado         = $row ['cus_estado'];
			$this->rol            = $row ['nus_rol'];
			$this->fechaBloqueo   = $row ['dus_fechabloqueo'];
			$this->fechaDesbloqueo= $row ['fechadesbloqueo'];
			$this->bloqueo        = $row ['bloqueo'];
		}
	}
	function getUsuario() {
		return $this->usuario;
	}
	function getFechaBloqueo(){
		return $this->fechaBloqueo;
	}
	function getFechaDesbloqueo(){
		return $this->fechaDesbloqueo;
	}
	function getPassword() {
		return $this->password;
	}
	function getAfiliado() {
		return $this->afiliado;
	}
	function getNumeroIntentos() {
		return $this->numeroIntentos;
	}
	function getEstado() {
		return $this->estado;
	}
	function getRol() {
		return $this->rol;
	}
	function setFechaBloqueo($in){
		$this->fechaBloqueo = $in;
	}
	function setFechaDesbloqueo($in){
		$this->fechaDesbloqueo = $in;
	}
	function setUsuario($in) {
		$this->usuario = $in;
	}
	function setPassword($in) {
		$this->password = $in;
	}
	function setAfiliado($in) {
		$this->afiliado = $in;
	}
	function setNumeroIntentos($in) {
		$this->numeroIntentos = $in;
	}
	function setEstado($in) {
		$this->estado= $in;
	}
	function setRol($in) {
		$this->rol= $in;
	}
	function alias(){
		return "Usuarios";
	}
	function where(){$this->asegurarCampos();
		$where = " where ";
		if($this->usuario != null){
			$where = $where.(strlen($where)>10?" AND ":"");
			$where = $where." cus_usuario = '".$this->usuario."' ";
		}
		if($this->afiliado != null){
			$where = $where.(strlen($where)>10?" AND ":"");
			$where = $where." nus_afiliado = '".$this->afiliado."' ";
		}
		if($this->estado != null){
			$where = $where.(strlen($where)>10?" AND ":"");
			$where = $where." cus_estado = '".$this->estado."' ";
		}
		if($this->fechaBloqueo != null){
			$where = $where.(strlen($where)>10?" AND ":"");
			$where = $where."dus_fechabloqueo = '".$this-fechaBloqueo."' ";
		}
		if($this->rol != null){
			$where = $where.(strlen($where)>10?" AND ":"");
			$where = $where." nus_rol = '".$this->rol."' ";
		}
		return $where;
	}
	function select(){$this->asegurarCampos();
		return "select cus_usuario,cus_password,nus_afiliado,nus_intentos,cus_estado,nus_rol,adddate(dus_fechabloqueo,interval 1 day) as fechadesbloqueo,adddate(dus_fechabloqueo,interval 1 day) < curdate() as bloqueo from ".$this->alias()." ";
	}
	function login(){$this->asegurarCampos();
		return "select cus_usuario,cus_password,nus_afiliado,nus_intentos,cus_estado,nus_rol from ".$this->alias()." where cus_usuario = '".$this->usuario."' and cus_password = '".$this->password."' and (adddate(dus_fechabloqueo,interval 1 day) < curdate() or dus_fechabloqueo is null)";
	}
	function insert(){$this->asegurarCampos();
		return "insert into ".$this->alias()." (cus_usuario,cus_password,nus_afiliado,nus_intentos,cus_estado,nus_rol) 
				values ('".$this->usuario."','".$this->password."','".$this->afiliado."','".$this->numeroIntentos."','".$this->estado."','".$this->rol."')";
	}
	function update(){$this->asegurarCampos();
		return "update ".$this->alias()." 
				set cus_password   = '".$this->password."'
				,nus_intentos      = '".$this->numeroIntentos."'
				,nus_rol      = '".$this->rol."'
				,cus_estado      = '".$this->estado."'
				where cus_usuario = '".$this->usuario."'";
	}
	function delete(){$this->asegurarCampos();
		return "delete from ".$this->alias()." where cus_usuario = ".$this->usuario;
	}
	
}  
?>
