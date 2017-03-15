<?php
include_once '../../lib/interface/abstract/AbstractDTO.php';
/**
 * Se encarga de crar la clase para manejar los afiliados y saber de quien es referidos o quien los refirio
 * @author JALEJ
 *
 */
class Permisos extends DTO{
	var $id;
	var $nombre;
	var $oRol;
	var $referencia;
	function setORol($object){
		$this->oRol;
	}
	function getORol(){
		return $this->oRol;
	}
	function setRow($row) {
		if (count ( $row ) > 0) {
			$this->id         = $row ['npe_llave'];
			$this->nombre     = $row ['cpe_nombre'];
			$this->referencia = $row ['cpe_referencia'];
		}
	}
	function getId() {
		return $this->id;
	}
	function getNombre() {
		return $this->nombre;
	}
	function setId($in) {
		$this->id = $in;
	}
	function setNombre($in) {
		$this->nombre = $in;
	}
	function setReferencia($in) {
		$this->referencia = $in;
	}
	function alias(){
		return "Permisos";
	}
	function where(){$this->asegurarCampos();
		$where = " where ";
		if($this->id != null){
			$where = $where.(strlen($where)>10?" AND ":"");
			$where = $where." npe_llave = '".$this->id."'";
		}
		if($this->nombre != null){
			$where = $where.(strlen($where)>10?" AND ":"");
			$where = $where." cpe_nombre = '".$this->nombre."'";
		}
		if($this->referencia != null){
			$where = $where.(strlen($where)>10?" AND ":"");
			$where = $where." cpe_referencia = '".$this->referencia."'";
		}
		return $where;
	}
	function select(){$this->asegurarCampos();
		return "select npe_llave,cpe_nombre,cpe_referencia from ".$this->alias()." ";
	}
	function insert(){$this->asegurarCampos();
		return "insert into ".$this->alias()." (npe_llave,cpe_nombre,cpe_referencia) 
				values ('".$this->id."','".$this->nombre."','".$this->referencia."')";
	}
	function update(){$this->asegurarCampos();
		return "update ".$this->alias()." 
				set npe_llave  = '".$this->id."'
				,cpe_nombre    = '".$this->nombre."'
				,cpe_referencia= '".$this->referencia."'";
	}
	function delete(){$this->asegurarCampos();
		return "delete from ".$this->alias()." where npe_llave = ".$this->id;
	}
	
}  
?>
