<?php
include_once '../../lib/interface/abstract/AbstractDTO.php';
/**
 * Se encarga de crar la clase para manejar los afiliados y saber de quien es referidos o quien los refirio
 * @author JALEJ
 *
 */
class Roles extends DTO{
	var $id;
	var $nombre;
	function setRow($row) {
			$this->id     = $row ['nro_llave'];
 			$this->nombre = $row ['cro_nombre'];
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
	function alias(){
		return "Roles";
	}
	function where(){$this->asegurarCampos();
		$where = " where ";
		if($this->id != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." nro_llave = '".$this->id."'";
		}
		if($this->nombre != null){
			$where = $where.(strlen($where)>10?"AND":"");
			$where = $where." cro_nombre = '".$this->nombre."'";
		}
		return $where;
	}
	function select(){$this->asegurarCampos();
		return "select nro_llave,cro_nombre from ".$this->alias()." ";
	}
	function insert(){$this->asegurarCampos();
		return "insert into ".$this->alias()." (nro_llave,cro_nombre) 
				values (null,'".$this->nombre."')";
	}
	function update(){$this->asegurarCampos();
		return "update ".$this->alias()." 
				set cro_nombre = '".$this->nombre."'
				where    nro_llave = '".$this->id."'";
	}
	function delete(){$this->asegurarCampos();
		return "delete from ".$this->alias()." where nro_llave = ".$this->id;
	}
	
}  
?>
