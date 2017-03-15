<?php
include_once '../../lib/interface/abstract/AbstractDTO.php';
class ReferidoWhatsapp extends DTO{
	var $id;
	var $referido;
	var $whatsapp;
	var $agregado;
	function alias(){
		return "ReferidoWhatsapp";
	}
	function setRow($row){
		$this->id = $row ['nrw_llave'];
		$this->referido = $row ['nrw_referido'];
		$this->whatsapp = $row ['nrw_whatsapp'];
		$this->agregado = $row ['crw_agregado'];
	}
	function setId($in){
		$this->id = $in;
	}
	function getId(){
		return $this->id;
	}
	function setReferido($in){
		$this->referido = $in;
	}
	function getReferido(){
		return $this->referido;
	}
	function setWhatsapp($in){
		$this->whatsapp = $in;
	}
	function getWhatsapp(){
		return $this->whatsapp;
	}
	function setAgregado($in){
		$this->agregado = $in;
	}
	function getAgregado(){
		return $this->agregado;
	}
	function select(){$this->asegurarCampos();
		return "select nrw_llave,nrw_referido,nrw_whatsapp,crw_agregado from ".$this->alias();
	}
	function update(){$this->asegurarCampos();
		return "update  ".$this->alias()." set nrw_referido=".$this->referido.",nrw_whatsapp=".$this->whatsapp.",crw_agregado='".$this->agregado."' where nrw_llave=".$this->id;
	}
	function delete (){$this->asegurarCampos();
		return "delete from ".$this->alias()." where nrw_llave = ".$this->id;
	}
	function insert(){$this->asegurarCampos();
		return "insert into ".$this->alias()." (nrw_llave,nrw_referido,nrw_whatsapp,crw_agregado) values (null,".$this->referido.",".($this->whatsapp!=null?$this->whatsapp:"null").",'N')";
	}
	function where(){$this->asegurarCampos();
			$where = "  where ";
		if($this->id != null){
			 $where = $where.(strlen($where) > 10?" AND ":"");
			 $where = $where." nrw_llave = ".$this->id."";
		}
		if($this->referido != null){
			 $where = $where.(strlen($where) > 10?" AND ":"");
			 $where = $where." nrw_referido = ".$this->referido."";
		}
		if($this->whatsapp != null){
			 $where = $where.(strlen($where) > 10?" AND ":"");
			 $where = $where." nrw_whatsapp = ".$this->whatsapp."";
		}
		if($this->id != null){
			 $where = $where.(strlen($where) > 10?" AND ":"");
			 $where = $where." nrw_agregado = '".$this->agregado."'";
		}
		return $where;
	}
}
?>
