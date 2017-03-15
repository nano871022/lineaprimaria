<?php
include_once '../../lib/interface/abstract/AbstractDTO.php';
class VPermisosRoles extends DTO{
var $id;
var $permiso;
var $nombrePermiso;
var $referencia;
var $rol;
var $nombreRol;
function setRow($row){
$this->id = $row['llave'];
$this->permiso = $row['permiso'];
$this->nombrePermiso = $row['nombrePermiso'];
$this->referencia = $row['referencia'];
$this->rol = $row['rol'];
$this->nombreRol = $row['nombreRol'];
}
function where(){$this->asegurarCampos();
$where = " where ";
if(!empty($this->id)){
$where .= strlen($where)>10?" and ":"";
$where .= "llave=".$this->id;
}
if(!empty($this->permiso)){
$where .= strlen($where)>10?" and ":"";
$where .= "permiso=".$this->permiso;
}
if(!empty($this->nombrePermiso)){
$where .= strlen($where)>10?" and ":"";
$where .= "nombrePermiso=".$this->nombrePermiso;
}
if(!empty($this->referencia)){
$where .= strlen($where)>10?" and ":"";
$where .= "referencia=".$this->referencia;
}
if(!empty($this->rol)){
$where .= strlen($where)>10?" and ":"";
$where .= "rol=".$this->rol;
}
if(!empty($this->nombreRol)){
$where .= strlen($where)>10?" and ":"";
$where .= "nombreRol=".$this->nombreRol;
}
return $where;
}
function alias(){return " v_permisosroles ";}
function setId($in){$this->id = $in;}
function setPermiso($in){$this->permiso = $in;}
function setNombrePermiso($in){$this->nombreRermiso = $in;}
function setReferencia($in){$this->referencia= $in;}
function setRol($in){$this->rol = $in;}
function setNombreRol($in){$this->nombreRol = $in;}
function getId(){return $this->id;}
function getPermiso(){return $this->permiso;}
function getNombrePermiso(){return $this->nombrePermiso;}
function getReferencia(){return $this->referencia;}
function getRol(){return $this->rol;}
function getNombreRol(){return $this->nombreRol;}
function select(){$this->asegurarCampos();
return "select llave,permiso,nombrePermiso,rol,nombreRol,referencia from".$this->alias();
}
function update(){
return "";
}
function insert(){
return "";
}
function delete(){
return "";
}
}
