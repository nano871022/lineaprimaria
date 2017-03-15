<?php
include_once '../../lib/interface/abstract/AbstractDTO.php';
class VReferidoAG extends DTO{
 var $codigo;
 var $codigoAfiliado;
 var $codigoReferido;
 var $fechaAsociado;
 var $afiliado;
 var $celularAfiliado;
 var $referido;
 var $celularReferido;
 function setRow($row){
	$this->codigo = $row['codigo'];
	$this->codigoAfiliado = $row['codAfiliado'];
	$this->codigoReferido = $row['codReferido'];
	$this->fechaAsociado  = $row['fechaAsociado'];
	$this->afiliado       = $row['afiliado'];
	$this->celularAfiliado= $row['celularAfiliado'];
	$this->referido       = $row['referido'];
	$this->celularReferido= $row['celularReferido'];
	}
 function alias(){
	return "ReferidoAG";
	}
 function select(){
	return "select codigo,codAfiliado,codReferido,fechaAsociado,afiliado,referido,celularAfiliado,celularReferido from ".$this->alias();
	}
function update(){return "";}
function insert(){return "";}
function delete(){return "";}
 function where(){
		$where = " where ";
		if(!empty($this->codigo)){
			$where .= strlen($where)>10?" and ":"";
			$where .= "codigo = ".$this->codigo;
		}
		if(!empty($this->codigoAfiliado)){
			$where .= strlen($where)>10?" and ":"";
			$where .= "codAfiliado = ".$this->codigoAfiliado;
		}
		if(!empty($this->codigoReferido)){
			$where .= strlen($where)>10?" and ":"";
			$where .= "codReferido = ".$this->codigoReferido;
		}
		if(!empty($this->fechaAsociado)){
			$where .= strlen($where)>10?" and ":"";
			$where .= "fechaAsociado = '".$this->fechaAsociado."'";
		}
		if(!empty($this->afiliado)){
			$where .= strlen($where)>10?" and ":"";
			$where .= "afiliado = '".$this->afiliado."'";
		}
		if(!empty($this->referido)){
			$where .= strlen($where)>10?" and ":"";
			$where .= "referido = '".$this->referido."'";
		}
	return $where;
	}
 function setCodigo($in){$this->codigo = $in;}
 function getCodigo(){return $this->codigo;}
 function setCodigoAfiliado($in){$this->codigoAfiliado = $in;}
 function getCodigoAfiliado(){return $this->codigoAfiliado;}
 function setCodigoReferido($in){$this->codigoReferido = $in;}
 function getCodigoReferido(){return $this->codigoReferido;}
 function setFechaAsociado($in){$this->fechaAsociado = $in;}
 function getFechaAsociado(){return $this->fechaAsociado;}
 function setAfiliado($in){$this->afiliado = $in;}
 function getAfiliado(){return $this->afiliado;}
 function setReferido($in){$this->referido = $in;}
 function getReferido(){return $this->referido;}
 function setCelularAfiliado($in){$this->celularAfiliado = $in;}
 function getCelularAfiliado(){return $this->celularAfiliado;}
 function setCelularReferido($in){$this->celularReferido = $in;}
 function getCelularReferido(){return $this->celularReferido;}
 }
?>
