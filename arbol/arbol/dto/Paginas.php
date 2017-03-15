<?php
include_once '../../lib/interface/abstract/AbstractDTO.php';
class Paginas extends DTO{
 var $id;
 var $nombre;
 var $carpeta;
 var $archivo;
 var $descripcion;
 function setRow($row){
	$this->id          = $row['nps_llave'];
	$this->nombre      = $row['cps_nombre'];
	$this->carpeta     = $row['cps_carpeta'];
	$this->archivo     = $row['cps_archivo'];
	$this->descripcion = $row['cps_descripcion'];
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
 function setCarpeta($in){
	$this->carpeta = $in;
	}
 function getCarpeta(){
	return $this->carpeta;
	}
 function setArchivo($in){
	$this->archivo = $in;
	}
 function getArchivo(){
	return $this->archivo;
	}
 function setDescripcion($in){
	$this->descripcion = $in;
	}
 function getDescripcion(){
	return $this->descripcion;
	}
 function alias(){return "Paginas";}
 function select(){$this->asegurarCampos();
	 return "select nps_llave,cps_nombre,cps_carpeta,cps_archivo,cps_descripcion from ".($this->alias());
	}
 function update(){$this->asegurarCampos();
	return "update ".$this->alias()." set cps_nombre ='".($this->nombre)."' ,cps_carpeta='".($this->carpeta)."',cps_archivo='".($this->archivo)."',cps_descripcion='".($this->descripcion)."' where nps_llave".($this->id);
	}
 function delete(){$this->asegurarCampos();
	return "delete from ".$this->alias()."  where nps_llave =".($this->id);
	}
 function insert(){$this->asegurarCampos();
	return "insert into ".$this->alias()." (cps_nombre,cps_carpeta,cps_archivo,cps_descripcion) values ('".($this->nombre)."','".($this->carpeta)."','".($this->archivo)."','".($this->descripcion)."')";	
	}
 function where(){$this->asegurarCampos();
	$where = " where ";
		 if(!empty($this->id)){
			$where .= strlen($where)>10?" and ":"";
			$where .= "nps_llave = ".($this->id);
		}
		 if(!empty($this->nombre)){
			$where .= strlen($where)>10?" and ":"";
			$where .= "cps_nombre = ".($this->nombre);
		}
		 if(!empty($this->carpeta)){
			$where .= strlen($where)>10?" and ":"";
			$where .= "cps_carpeta= ".($this->carpeta);
		}
		 if(!empty($this->archivo)){
			$where .= strlen($where)>10?" and ":"";
			$where .= "cps_archivo= ".($this->archivo);
		} 
		if(!empty($this->descripcion)){
			$where .= strlen($where)>10?" and ":"";
			$where .= "cps_descripcion = ".($this->descripcion);
		}
	}
}

?>
