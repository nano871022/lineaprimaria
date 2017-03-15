<?php
require_once '../../lib/interface/abstract/AbstractDTO.php';
class RolPaginas extends DTO{
 var $id;
 var $rol;
 var $pagina;
 function setRow($row){
	$this->rol = $row['nrp_rol'];
	$this->id = $row['nrp_llave'];
	$this->pagina = $row['nrp_pagina'];
	}
function alias(){return "RolPaginas";}
function where(){$this->asegurarCampos();
	$where = " where ";
	if(!empty($this->rol)){
		$where .= strlen($where)>10?" and ":"";
		$where .= "nrp_rol = ".$this->rol;
		}
	if(!empty($this->id)){
		$where .= strlen($where)>10?" and ":"";
		$where .= "nrp_llave = ".$this->id;
		}
	if(!empty($this->pagina)){
		$where .= strlen($where)>10?" and ":"";
		$where .= "nrp_pagina = ".$this->pagina;
		}
	}
function select(){$this->asegurarCampos();
	return "select nrp_rol,nrp_pagina from ".$this->alias;
	}
function update(){$this->asegurarCampos();
	return "update ".$this->alias()." set nrp_rol=".$this->rol.", nrp_pagina=".$this->pagina." where nrp_rol=".$this->id;
	}
function insert(){$this->asegurarCampos();
	return "insert into ".$this->alias()." (nrp_rol,nrp_pagina) values (".$this->rol.",".$this->pagina.")";
	}
function delete(){$this->asegurarCampos();
	return "delete from ".$this->alias()." where nrp_llave=".$this->id;
	}
function setId($in){
	$this->id = $in;
	}
 function getId(){
	return $this->id;
	}
function setRol($in){
	$this->Rol = $in;
	}
 function getRol(){
	return $this->rol;
	}
function setPagina($in){
	$this->pagina = $in;
	}
 function getPagina(){
	return $this->pagina;
	}
}
