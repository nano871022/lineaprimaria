<?php
include_once '../../lib/interface/abstract/AbstractDTO.php';
class WhatsappGrupos extends DTO{
  var $id;
  var $nombre;
  var $fecha;
  function alias(){
	  return "WhatsappGrupos";
  }
  function setRow($row){
	  $this->id = $row['nwg_llave'];
	  $this->nombre = $row['cwg_nombre'];
	  $this->fecha = $row['dwg_fecha'];
  }
  function setId($in){
	  $this->id = $in;
  }
  function getId(){
	  return $this->id;
  }
  function setNombre($in){
	  $this->nombre = $in;
  }
  function getNombre(){
	  return $this->nombre;
  }
  function setFecha($in){
	  $this->fecha = $in;
  }
  function getFecha(){
	  return $this->fecha;
  }
  function select(){$this->asegurarCampos();
	  return "select nwg_llave,cwg_nombre,dwg_fecha from ".$this->alias();
  }
  function update(){$this->asegurarCampos();
	  return "update ".$this->alias()." set cwg_nombre='".$this->nombre."', dwg_fecha='".$this->fecha."' where nwg_llave=".$this->id;
  }
  function delete(){$this->asegurarCampos();
	  return "delete from ".$this->alias()." where nwg_llave = ".$this->id;
  }
  function insert(){$this->asegurarCampos();
	  return "insert into ".$this->alias()." (nwg_llave,cwg_nombre,dwg_fecha) values (null,'".$this->nombre."',curdate()) ";
	}
	function where() {$this->asegurarCampos();
		$where = " where ";
		if(!empty($this->id)){
			$where = $where.(strlen($where)>10 ? " and ":"");
			$where = $where." nwg_llave = ".$this->id;
		}
		if(!empty($this->nombre)){
			$where = $where.(strlen($where)>10 ? " and ":"");
			$where = $where." cwg_nombre like '".$this->nombre."'";
		}
		if(!empty($this->date)){
			$where = $where.(strlen($where)>10 ? " and ":"");
			$where = $where." dwg_fecha = ".$this->fecha;
		}
		return $where;
	}
}
?>
