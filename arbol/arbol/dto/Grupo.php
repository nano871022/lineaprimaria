<?php
require_once '../../lib/interface/abstract/AbstractDTO.php';
/**
 * Se encarga de crar la clase para manejar los afiliados y saber de quien es referidos o quien los refirio
 * @author JALEJ
 *
 */
class Grupo extends DTO{
	var $id;
	var $afiliado;
	var $oAfiliado;
	var $fechaIngreso;
	var $fechaPrimero;
	var $fechaSegundo;
	var $fechaTercero;
	var $numeroGrupo;
	var $oReferido1;
	var $oReferido2;
	var $incremento;
	var $oPadre;
	var $oPago;
	
	function setLoad($load){
		if($load instanceof Grupo){
			$this->id           = $load->id;
			$this->afiliado     = $load->afiliado;
			$this->oAfiliado    = $load->oAfiliado;
			$this->fechaIngreso = $load->fechaIngreso;
			$this->fechaPrimero = $load->fechaPrimero;
			$this->fechaSegundo = $load->fechaSegundo;
			$this->fechaTercero = $load->fechaTercero;
			$this->numeroGrupo	= $load->numeroGrupo;
			$this->oReferido1 	= $load->oReferido1;
			$this->oReferido2   = $load->oReferido2;
		}
	}

	function setRow($row) {
		if (count ( $row ) > 0) {
			$this->id           = $row ['ngr_llave'];
			$this->afiliado     = $row ['ngr_afiliado'];
			$this->fechaIngreso = $row ['dgr_ingreso'];
			$this->fechaPrimero = $row ['dgr_primero'];
			$this->fechaSegundo = $row ['dgr_segundo'];
			$this->fechaTercero = $row ['dgr_tercero'];
			$this->numeroGrupo  = $row ['ngr_grupo'];
		}
	}
	function setOPadre($in){
		$this->oPadre = $in;
	}
	function getOPadre(){
		return $this->oPadre;
	}
	function setOPago($in){
		$this->oPago = $in;
	}
	function getOPago(){
		return $this->oPago;
	}
	function getId() {
		return $this->id;
	}
	function getAfiliado() {
		return $this->afiliado;
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
	function setAfiliado($in) {
		$this->afiliado = $in;
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
	function setId($in) {
		$this->id = $in;
	}
	function setIncremento($in) {
		$this->incremento = $in;
	}
	function getIncremento() {
		return $this->incremento;
	}
	function alias(){
		return "Grupo";
	}
	function setOReferido1($in){
		$this->oReferido1 = $in;
	}
	function getOReferido1(){
		return $this->oReferido1;
	}
	function setOReferido2($in){
		$this->oReferido2 = $in;
	}
	function getOReferido2(){
		return $this->oReferido2;
	}
	function setOAfiliado($in){
		$this->oAfiliado = $in;
	}
	function getOAfiliado(){
		return $this->oAfiliado;
	}
	function where(){$this->asegurarCampos();
		$where = " where ";
		if($this->afiliado != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." ngr_afiliado = '".($this->afiliado)."'";
		}
		if($this->fechaIngreso != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." dgr_ingreso = '".($this->fechaIngreso)."'";
		}
		if($this->fechaPrimero != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." dgr_primero = '".($this->fechaPrimero)."'";
		}
		if($this->fechaSegundo != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." dgr_segundo = '".($this->fechaSegundo)."'";
		}
		if($this->fechaTercero != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." dgr_tercero = '".($this->fechaTercero)."'";
		}
		if($this->numeroGrupo != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." ngr_grupo = '".($this->numeroGrupo)."'";
		}
		if($this->id != null){	
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." ngr_llave = '".($this->id)."'";
		}
		return $where;
	}
	
	function select(){$this->asegurarCampos();
		return "select ngr_llave,ngr_afiliado,dgr_ingreso,dgr_primero,dgr_segundo,dgr_tercero,ngr_grupo from ".$this->alias()." ";
	}
	function insert(){$this->asegurarCampos();
		return "insert into ".$this->alias()." (ngr_llave,ngr_afiliado,dgr_ingreso,dgr_primero,dgr_segundo,dgr_tercero,ngr_grupo) 
				values (null,'".$this->afiliado."','".$this->fechaIngreso."',ADDDATE('".$this->fechaPrimero."',INTERVAL ".$this->incremento." DAY),ADDDATE('".$this->fechaSegundo."', INTERVAL ".($this->incremento*2)." DAY),ADDDATE('".$this->fechaTercero."',INTERVAL ".($this->incremento*3)." DAY),'".$this->numeroGrupo."')";
	}
	function insert2(){$this->asegurarCampos();
		return "insert into ".$this->alias()." (ngr_llave,ngr_afiliado,dgr_ingreso,dgr_primero,dgr_segundo,dgr_tercero,ngr_grupo)
				values (".$this->id.",'".$this->afiliado."','".$this->fechaIngreso."','".$this->fechaPrimero."','".$this->fechaSegundo."','".$this->fechaTercero."','".$this->numeroGrupo."')";
	}
	function update(){$this->asegurarCampos();
		return "update ".$this->alias()." 
				set ngr_afiliado = '".$this->afiliado."'
				,dgr_ingreso  = '".$this->fechaIngreso."'
				,dgr_primero    = '".$this->fechaPrimero."'
				,dgr_segundo     = '".$this->fechaSegundo."'
				,dgr_tercero  = '".$this->fechaTercero."'
				,ngr_grupo     = '".$this->numeroGrupo."'
				where ngr_llave = ".$this->id;
	}
	function delete(){$this->asegurarCampos();
		return "delete from ".$this->alias()." where ngr_llave = ".$this->id;
	}
	
}  
?>
