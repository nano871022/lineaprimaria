<?php
require_once '../../lib/interface/abstract/AbstractDTO.php';
/**
 * Se encarga de crar la clase para manejar los afiliados y saber de quien es referidos o quien los refirio
 * @author JALEJ
 *
 */
class Pagos extends DTO{
	var $id;
	var $pago;
	var $paga;
	var $oPago;
	var $recibio;
	var $recibe;
	var $oRecibio;
	var $fecha;
	var $numeroPago;
	var $pagoRealizado;
	function setPagoRealizado($object){
		$this->pagoRealizado = $object;
	}
	function getPagoRealizado(){
		return $this->pagoRealizado;
	}
	function setORecibio($object){
		$this->oRecibio = $object;
	}
	function getORecibio(){
		return $this->oRecibio;
	}
	function setOPago($object){
		$this->oPago = $object;
	}
	function getOpago(){
		return $this->oPago;
	}
	function setRow($row) {
		if (count ( $row ) > 0) {
			$this->id         = $row ['npa_llave'];
			$this->numeroPago = $row ['npa_npago'];
			$this->pago       = $row ['npa_pago'];
			$this->recibio    = $row ['npa_recibio'];
			$this->fecha      = $row ['dpa_fecha'];
			$this->paga       = $row ['cpa_paga'];
			$this->recibe     = $row ['cpa_recibe'];
		}
	}
	function getPaga() {
		return $this->paga;
	}
	function getId() {
		return $this->id;
	}
	function getPago() {
		return $this->pago;
	}
	function getRecibe() {
		return $this->recibe;
	}
	function getRecibio() {
		return $this->recibio;
	}
	function getFecha() {
		return $this->fecha;
	}
	function getNumeroPago() {
		return $this->numeroPago;
	}
	function setId($in) {
		$this->id = $in;
	}
	function setPaga($in) {
		$this->paga = $in;
	}
	function setPago($in) {
		$this->pago = $in;
	}
	function setRecibio($in) {
		$this->recibio = $in;
	}
	function setRecibe($in) {
		$this->recibe = $in;
	}
	function setFecha($in) {
		$this->fecha = $in;
	}
	function setNumeroPago($in) {
		$this->numeroPago = $in;
	}
	function alias(){
		return "Pagos";
	}
	function select(){$this->asegurarCampos();
		return "select npa_llave,npa_pago,npa_recibio,dpa_fecha,npa_npago,cpa_paga,cpa_recibe from ".$this->alias()." ";
	}
	function insert(){$this->asegurarCampos();
		return "insert into ".$this->alias()." (npa_pago,npa_recibio,cpa_paga,cpa_recibe,dpa_fecha,npa_npago) 
				values (".$this->pago.",".$this->recibio.",'".$this->paga."','".$this->recibe."',curdate(),".$this->numeroPago.")";
	}
	function update(){$this->asegurarCampos();
		return "update ".$this->alias()." 
				set npa_pago = '".$this->pago."'
				,cpa_paga = '".$this->paga."'
				,npa_recibio    = '".$this->recibio."'
				,cpa_recibe    = '".$this->recibe."'
				,dpa_fecha      = '".$this->fecha."'
				,npa_npago      = '".$this->numeroPago."' where npa_llave = ".$this->id;
	}
	function delete(){$this->asegurarCampos();
		return "delete from ".$this->alias()." where npa_llave = ".$this->id;
	}
	function where(){$this->asegurarCampos();
		$where = " where ";
		if(!empty($this->pago)){
			$where .= strlen($where)>10?" and ":"";
			$where .= "npa_pago = ".$this->pago;
		}
		if(!empty($this->paga)){
			$where .= strlen($where)>10?" and ":"";
			$where .= "cpa_paga = '".$this->paga."'";
		}
		if(!empty($this->recibio)){
			$where .= strlen($where)>10?" and ":"";
			$where .= "npa_recibio = ".$this->recibio;
		}
		if(!empty($this->recibe)){
			$where .= strlen($where)>10?" and ":"";
			$where .= "cpa_recibe = '".$this->recibe."'";
		}
		if(!empty($this->fecha)){
			$where .= strlen($where)>10?" and ":"";
			$where .= "dpa_fecha = '".$this->fecha."'";
		}
		if(!empty($this->numeroPago)){
			$where .= strlen($where)>10?" and ":"";
			$where .= "npa_npago = ".$this->numeroPago;
		}
		if(!empty($this->id)){
			$where .= strlen($where)>10?" and ":"";
			$where .= "npa_llave = ".$this->id;
		}
		if(!empty($this->pagoRealizado)){
			$where .= strlen($where)>10?" and ":"";
			$where .= "(cpa_recibe = 'S' or cpa_paga = 'S')";
		}
		return $where;
	}
}  
?>
