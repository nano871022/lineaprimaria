<?php
require_once '../../lib/interface/abstract/AbstractDTO.php';
/**
 * Se encarga de crar la clase para manejar los afiliados y saber de quien es referidos o quien los refirio
 * @author JALEJ
 *
 */
class VAfiliadoGrupo extends DTO{
	var $nombreAfiliado;
	var $apellidoAfiliado;
	var $celularAfiliado;
	var $otrosAfiliado;
	var $estadoAfiliado;
	var $codigoAfiliado;
	var $codigoGrupo;
	var $codigoWhatsapp;
	var $nombreWhatsapp;
	var $fechaIngreso;
	var $fechaPrimero;
	var $fechaSegundo;
	var $fechaTercero;
	var $numeroGrupo;
        var $cantidad;	
	function setRow($row) {
		if (count ( $row ) > 0) {
			$this->codigoWhatsapp   = $row ['codigoWhatsap'];
			$this->nombreWhatsapp   = $row ['nombreWhatsapp'];
			$this->codigoGrupo      = $row ['codGrupo'];
			$this->codigoAfiliado   = $row ['codAfiliado'];
			$this->nombreAfiliado   = $row ['nombre'];
			$this->apellidoAfiliado = $row ['apellido'];
			$this->celularAfiliado  = $row ['celular'];
			$this->otrosAfiliado    = $row ['otros'];
			$this->estadoAfiliado   = $row ['estado'];
			$this->fechaIngreso     = $row ['fechaIngreso'];
			$this->fechaPrimero     = $row ['fechaPago1'];
			$this->fechaSegundo     = $row ['fechaPago2'];
			$this->fechaTercero     = $row ['fechaPago3'];
			$this->numeroGrupo      = $row ['numeroGrupo'];
		}
	}
	function setCantidad($in){$this->cantidad = $in;}
	function getCantidad(){return $this->cantidad;}
	function getCodigoWhatsapp() {
		return $this->codigoWhatsapp;
	}
	function getCodigoGrupo() {
		return $this->codigoGrupo;
	}
	function getCodigoAfiliado() {
		return $this->codigoAfiliado;
	}
	function getOtrosAfiliado() {
		return $this->otrosAfiliado;
	}
	function getEstadoAfiliado() {
		return $this->estadoAfiliado;
	}
	function getApellidoAfiliado() {
		return $this->apellidoAfiliado;
	}
	function getCelularAfiliado() {
		return $this->celularAfiliado;
	}
	function getNombreWhatsapp() {
		return $this->nombreWhatsapp;
	}
	function getNombreAfiliado() {
		return $this->nombreAfiliado;
	}
	function getFechaIngreso() {
		return $this->fechaIngreso;
	}
	function getFechaPrimero() {
		return $this->fechaPrimero;
	}
	function getFechaSegundo() {
		return $this->fechaSegundo;
	}
	function getFechaTercero() {
		return $this->fechaTercero;
	}
	function getNumeroGrupo() {
		return $this->numeroGrupo;
	}
	function setNombreWhatsapp($in) {
		$this->nombreWhatsapp = $in;
	}
	function setNombreAfiliado($in) {
		$this->nombreAfiliado = $in;
	}
	function setApellidoAfiliado($in) {
		$this->apellidoAfiliado = $in;
	}
	function setCelularAfiliado($in) {
		$this->celularAfiliado = $in;
	}
	function setOtrosAfiliado($in) {
		$this->otrosAfiliado = $in;
	}
	function setEstadoAfiliado($in) {
		$this->estadoAfiliado = $in;
	}
	function setFechaIngreso($in) {
		$this->fechaIngreso = $in;
	}
	function setFechaPrimero($in) {
		$this->fechaPrimero = $in;
	}
	function setFechaSegundo($in) {
		$this->fechaSegundo = $in;
	}
	function setFechaTercero($in) {
		$this->fechaTercero = $in;
	}
	function setNumeroGrupo($in) {
		$this->numeroGrupo = $in;
	}
	function setCodigoWhatsapp($in) {
		$this->codigoWhatsapp = $in;
	}
	function setCodigoGrupo($in) {
		$this->codigoGrupo = $in;
	}
	function setCodigoAfiliado($in) {
		$this->codigoAfiliado = $in;
	}
	function alias(){
		return "AfiliadoGrupo";
	}
	function where(){$this->asegurarCampos();
		$where = " where ";
		if($this->codigoWhatsapp != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." codigoWhatsapp = '".($this->codigoWhatsapp)."'";
		}
		if($this->nombreWhatsapp != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." nombreWhatsapp=".($this->nombreWhatsapp)."'";
		}
		if($this->codigoAfiliado != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." codAfiliado = '".($this->codigoAfiliado)."'";
		}
		if($this->nombreAfiliado != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." nombre = '".($this->nombreAfiliado)."'";
		}
		if($this->apellidoAfiliado != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." apellido = '".($this->apellidoAfiliado)."'";
		}
		if($this->celularAfiliado != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." celular = '".($this->celularAfiliado)."'";
		}
		if($this->otrosAfiliado != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." otros = '".($this->otrosAfiliado)."'";
		}
		if($this->estadoAfiliado != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." estado= '".($this->estadoAfiliado)."'";
		}
		if($this->fechaIngreso != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." fechaIngreso= '".($this->fechaIngreso)."'";
		}
		if($this->fechaPrimero != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." fechaPago1 = '".($this->fechaPrimero)."'";
		}
		if($this->fechaSegundo != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." fechaPago2 = '".($this->fechaSegundo)."'";
		}
		if($this->fechaTercero != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." fechaPago3 = '".($this->fechaTercero)."'";
		}
		if($this->numeroGrupo != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." numeroGrupo = '".($this->numeroGrupo)."'";
		}
		if($this->codigoGrupo != null){	
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." codGrupo = '".($this->codigoGrupo)."'";
		}
		return $where;
	}
	
	function select(){$this->asegurarCampos();
		return "select * from ".$this->alias()." ";
	}
	function insert(){return "";}
	function update(){return "";}
	function delete(){return "";}
	
}  
?>
