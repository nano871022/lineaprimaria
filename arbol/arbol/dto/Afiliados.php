<?php
include_once '../../lib/interface/abstract/AbstractDTO.php';
/**
 * Se encarga de crar la clase para manejar los afiliados y saber de quien es referidos o quien los refirio
 * @author JALEJ
 *
 */
 
class Afiliados extends DTO {
	var $id;
	var $nombres;
	var $apellidos;
	var $celular;
	var $otros;
	var $documento;
	var $estado;
	var $buscar;
	var $oWhatsapp;
	var $oPago;
	var $grupo;
	function setRow($row) {
		if (count ( $row ) > 0) {
			$this->nombres = $row ['afs_nombres'];
			$this->apellidos = $row ['afs_apellidos'];
			$this->celular = $row ['afs_celular'];
			$this->otros = $row ['afs_otros'];
			$this->documento = $row ['afs_documento'];
			$this->estado = $row ['afs_estado'];
			$this->id = $row ['afs_llave'];
		}
	}
	function setOPago($in){
		$this->oPago = $in;
	}
	function getOPago(){
		return $this->oPago;
	}
	function setGrupo($in){
		$this->grupo = $in;
	}
	function getGrupo(){
		return $this->grupo;
	}
	function setOWhatsapp($in){
		$this->oWhatsapp = $in;
	}
	function getOWhatsapp(){
		return $this->oWhatsapp;
	}
	function getId() {
	 return $this->id;
	}
	function getNombres() {
	 return $this->nombres;
	}
	function getApellidos() {
	 return $this->apellidos;
	}
	function getCelular() {
		return $this->celular;
	}
	function getOtros() {
		return $this->otros;
	}
	function getDocumento() {
		return $this->documento;
	}
	function getEstado() {
		return $this->estado;
	}
	function setNombres($in) {
		$this->nombres = $in;
	}
	function setApellidos($in) {
		$this->apellidos = $in;
	}
	function setCelular($in) {
		$this->celular = $in;
	}
	function setOtros($in) {
		$this->otros = $in;
	}
	function setDocumento($in) {
		$this->documento = $in;
	}
	function setEstado($in) {
		$this->estado = $in;
	}
	function setId($in) {
		$this->id = $in;
	}
	function setBuscar($buscar){
		$this->buscar = $buscar;
	}
	function getBuscar(){
		$this->buscar;
	}
	
   function where(){$this->asegurarCampos();
		$where = " where ";
		if($this->id != null){
			 $where = $where.(strlen($where) > 10?" AND ":"");
			 $where = $where." afs_llave = '". ($this->id)."'";
		}
		if($this->nombres != null){
			 $where = $where.(strlen($where) > 10?" AND ":"");
			 $where = $where." afs_nombres = '". ($this->nombres)."'";
		}
		if($this->apellidos != null){
			 $where = $where.(strlen($where) > 10?" AND ":"");
			 $where = $where." afs_apellidos = '". ($this->apellidos)."'";
		}
		if($this->celular != null){
			 $where = $where.(strlen($where) > 10?" AND ":"");
			 $where = $where." afs_celular = '". ($this->celular)."'";
		}
		if($this->otros != null){
			 $where = $where.(strlen($where) > 10?" AND ":"");
			 $where = $where." afs_otros = '". ($this->otros)."'";
		}
		if($this->documento != null){
			 $where = $where.(strlen($where) > 10?" AND ":"");
			 $where = $where." afs_documento = '". ($this->documento)."'";
		}
		if($this->estado != null){
			 $where = $where.(strlen($where) > 10?" AND ":"");
			 $where = $where." afs_estado = '". ($this->estado)."'";
		}
		if(!empty($this->buscar)){
			$where = $where.(strlen($where) > 10?" AND ":"");
			$this->buscar =  ($this->buscar); 
			$where = $where." (afs_nombres like '".$this->buscar."' or afs_apellidos like '".$this->buscar."' or afs_celular like '".$this->buscar."'  or afs_otros like '".$this->buscar."' or afs_documento like '".$this->buscar."')";
		}
		return $where;
	}
	
	function alias(){
		return " Afiliados ";
	}
	function select(){$this->asegurarCampos();
		return "select afs_llave,afs_nombres,afs_apellidos,afs_celular,afs_otros,afs_documento,afs_estado from ".$this->alias()." ";
	}
	function cantidadRegistros(){$this->asegurarCampos();
		return "select count(*) as cont from ".$this->alias()." ";
	}
	function insert(){$this->asegurarCampos();
		return "insert into ".$this->alias()." (afs_llave,afs_nombres,afs_apellidos,afs_celular,afs_otros,afs_documento,afs_estado) 
				values (null,'".$this->nombres."','".$this->apellidos."','".$this->celular."','".$this->otros."','".$this->documento."','".$this->estado."')";
	}
	function insert2(){$this->asegurarCampos();
		return "insert into ".$this->alias()." (afs_llave,afs_nombres,afs_apellidos,afs_celular,afs_otros,afs_documento,afs_estado) 
				values (".$this->id.",'".$this->nombres."','".$this->apellidos."','".$this->celular."','".$this->otros."','".$this->documento."','".$this->estado."')";
	}
	function update(){$this->asegurarCampos();echo $this->nombres."<--";
		return "update ".$this->alias()." 
				set afs_nombres = '".$this->nombres."'
				,afs_apellidos  = '".$this->apellidos."'
				,afs_celular    = '".$this->celular."'
				,afs_otros      = '".$this->otros."'
				,afs_documento  = '".$this->documento."'
				,afs_estado     = '".$this->estado."'
				where afs_llave =  ".$this->id;
				
	}
	function delete(){$this->asegurarCampos();
		return "delete from ".$this->alias()." where afs_llave = ".$this->id;
	}
} 
?>
