<?php
include_once '../../lib/interface/abstract/AbstractDTO.php';
class AdminsWG extends DTO{
	var $id;
	var $afiliado;
	var $fecha;
	function alias(){
		return "AdminsWG";
	}
	function setRow($row){
		$this->id = $row['naw_llave'];
		$this->afiliado = $row['naw_afiliado'];
		$this->fecha = $row['daw_fecha'];
	}
	function setId($in){
		$this->id = $in;
	}
	function setAfiliado($in){
		$this->afiliado = $in;
	}
	function setFecha($in){
		$this->fecha = $in;
	}
	function getId(){
		return $this->id;
	}
	function getAfiliado(){
		return $this->afiliado;
	}
	function getFecha(){
		return $this->fecha;
	}
	function insert(){$this->asegurarCampos();
		return "insert into ".$this->alias()." (naw_llave,naw_afiliado,daw_fecha) values (null,".$this->afiliado.",CURDATE())";
	}
	function update(){$this->asegurarCampos();
		return "update ".$this->alias()." set   naw_afiliado = ".$this->afiliado.", daw_fecha = '".$this->fecha."' from naw_llave = ".$this->id;
	}
	function delete(){$this->asegurarCampos();
		return "delete from ".$this->alias()." where naw_llave = ".$this->id;
	}
	function select(){$this->asegurarCampos();
		return "select naw_llave,naw_afiliado,daw_fecha from ".$this->alias();
	}
	function where(){$this->asegurarCampos();
		$where = "  where ";
		if($this->id != null){
			 $where = $where.(strlen($where) > 10?" AND ":"");
			 $where = $where." naw_llave = '".$this->id."'";
		}
		if($this->afiliado != null){
			 $where = $where.(strlen($where) > 10?" AND ":"");
			 $where = $where." naw_afiliado = '".$this->afiliado."'";
		}
		if($this->fecha != null){
			 $where = $where.(strlen($where) > 10?" AND ":"");
			 $where = $where." daw_fecha  = '".$this->fecha."'";
		}
		return $where;
	}
}

?>
