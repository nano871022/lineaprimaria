<?php
include_once '../../lib/interface/abstract/AbstractDTO.php';
class PermisosRol extends DTO{
var $id;
var $permiso;
var $rol;
function setRow($row){
$this->id = $row['npr_llave'];
$this->permiso = $row['npr_permiso'];
$this->rol = $row['npr_rol'];
}
function where(){$this->asegurarCampos();
$where = " where ";
if(!empty($this->id)){
$where .= strlen($where)>10?" and ":"";
$where .= "npr_llave=".$this->id;
}
if(!empty($this->permiso)){
$where .= strlen($where)>10?" and ":"";
$where .= "npr_permiso=".$this->permiso;
}
if(!empty($this->rol)){
$where .= strlen($where)>10?" and ":"";
$where .= "npr_rol=".$this->rol;
}
return $where;
}
function alias(){return "PermisosRol";}
function setId($in){$this->id = $in;}
function setPermiso($in){$this->permiso = $in;}
function setRol($in){$this->rol = $in;}
function getId(){return $this->id;}
function getPermiso(){return $this->permiso;}
function getRol(){return $this->rol;}
function select(){$this->asegurarCampos();
return "select npr_llave,npr_permiso,npr_rol from".$this->alias();
}
function update(){$this->asegurarCampos();
return "update ".$this->alias()." set npr_permiso=".$this->permiso." ,npr_rol=".$this->rol." where npr_llave=".$this->id;
}
function insert(){$this->asegurarCampos();
return "insert into ".$this->alias()." (npr_permiso,npr_rol) values (".$this->permiso.",".$this->rol.")";
}
function delete(){$this->asegurarCampos();
return "delete from ".$this->alias()." where npr_llave=".$this->id;
}
}
