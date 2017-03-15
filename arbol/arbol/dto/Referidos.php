<?php
require_once '../../lib/interface/abstract/AbstractDTO.php';
/**
 * Se encarga de crar la clase para manejar los afiliados y saber de quien es referidos o quien los refirio
 * @author JALEJ
 *
 */
class Referidos extends DTO{
	var $id;
	var $afiliado;
	var $oAfiliado;
	var $referido;
	var $oReferido;
	var $oWhatsapp;
	var $fecha;
	function setOAfiliado($object){
		$this->oAfiliado;
	}
	function setOReferido($object){
		$this->oReferido;
	}
	function getOAfiliado(){
		return $this->oAfiliado;
	}
	function getOReferido(){
		return $this->oReferido;
	}
	function setOWhatsapp($in){
		$this->oWhatsapp = $in;
	}
	function getOWhatsapp(){
		return $this->oWhatsapp;
	}
	function setRow($row) {
		if (count ( $row ) > 0) {
			$this->id           = $row ['nre_llave'];
			$this->afiliado     = $row ['nre_afiliado'];
			$this->referido     = $row ['nre_referido'];
			$this->fecha        = $row ['dre_fecha'];
		}
	}
	function getId() {
		return $this->id;
	}
	function getAfiliado() {
		return $this->afiliado;
	}
	function getReferido() {
		return $this->referido;
	}
	function getFecha() {
		return $this->fecha;
	}
	function setAfiliado($in) {
		$this->afiliado = $in;
	}
	function setReferido($in) {
		$this->referido = $in;
	}
	function setFecha($in) {
		$this->fecha = $in;
	}
	function setId($in) {
		$this->id = $in;
	}
	function alias(){
		return "Referidos";
	}
	function where(){$this->asegurarCampos();
		$where = " where ";
		if($this->afiliado != null){
			$where = $where .(strlen($where)>10? " AND ":"");
			$where = $where." nre_afiliado = '".$this->afiliado."'";
		}
		if($this->referido != null){
			$where = $where .(strlen($where)>10? " AND ":"");
			$where = $where." nre_referido = '".$this->referido."'";
		}
		if($this->fecha != null){ 
			$where = $where .(strlen($where)>10? " AND ":"");
			$where = $where." dre_fecha = '".$this->fecha."'";
		}
		if($this->id != null){ 
			$where = $where .(strlen($where)>10? " AND ":"");
			$where = $where." nre_llave = '".$this->id."'";
		}
		return $where;
	}
	function cantidad(){$this->asegurarCampos();
		return  "select count(*) as cont from ".$this->alias();
	}
	function select(){$this->asegurarCampos();
		return "select nre_llave,nre_afiliado,nre_referido,dre_fecha from ".$this->alias()." ";
	}
	function insert(){$this->asegurarCampos();
		return "insert into ".$this->alias()." (nre_llave,nre_afiliado,nre_referido,dre_fecha) 
				values (null,'".$this->afiliado."','".$this->referido."',CURDATE())";
	}
	function insert2(){$this->asegurarCampos();
		return "insert into ".$this->alias()." (nre_llave,nre_afiliado,nre_referido,dre_fecha) 
				values (".$this->id.",'".$this->afiliado."','".$this->referido."','".$this->fecha."')";
	}
	function update(){$this->asegurarCampos();
		return "update ".$this->alias()." 
				set nre_afiliado = '".$this->afiliado."'
				,nre_referido    = '".$this->referido."'
				,dre_fecha       = '".$this->fecha."'
				where nre_llave = ".$this->id;
	}
	function delete(){$this->asegurarCampos();
		return "delete from ".$this->alias()." where nre_llave = ".$this->id;
	}
	
}  
?>
