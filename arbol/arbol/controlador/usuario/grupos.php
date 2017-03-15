<?php
require_once '../../lib/interface/bean/iBean.php';
$page = null;
class Gruposs implements iBean{
	var $enlace;
	var $body;
	var $sGrupo;
	var $grupo;
	var $msn;
	var $permisos;
	function control(){
		$this->permisos = unserialize($_SESSION['permisos']);
		$this->enlace = (new Conexion())->connect();
		$this->grupo = unserialize($_SESSION['grupo']);
		if(!empty($this->permisos['AGO'])){
		if($this->validar()){
			$sql = $this->sGrupo->update();
			$result = $this->enlace->query($sql);
			if($result != null){
			 $this->msn = "<font color='green'>Se actualizo el grupo</font>";	
			 $this->actualizarSession();
			}else{
			 $this->msn = "<font color='red'>No se actualizo el grupo</font>";	
			}
		}}else{$this->msn = "<font color='red'>No tiene permisos para actualizar grupo</font>";}
	}
	function actualizarSession(){
		$grupoD = array();
		foreach ($this->grupo as $grupo){
			if($grupo->getId() == $this->sGrupo->getId()){
				$grupoD[] = $this->sGrupo; 
			}else{
				$grupoD[] = $grupo; 
			}
		}
	}
	function validar(){
		$id           = $_REQUEST['id'];
		$afiliado     = $_REQUEST['afiliado'];
		$fechaIngreso = $_REQUEST['fechaIngreso'];
		$fechaPrimero = $_REQUEST['fechaPrimero'];
		$fechaSegundo = $_REQUEST['fechaSegundo'];
		$fechaTercero = $_REQUEST['fechaTercero'];
		$numeroGrupo  = $_REQUEST['numeroGrupo'];
		$this->sGrupo = new Grupo();
		$this->sGrupo->setId($id);
		$this->sGrupo->setAfiliado($afiliado);
		$this->sGrupo->setFechaIngreso($fechaIngreso);
		$this->sGrupo->setFechaPrimero($fechaPrimero);
		$this->sGrupo->setFechaSegundo($fechaSegundo);
		$this->sGrupo->setFechaTercero($fechaTercero);
		$this->sGrupo->setNumeroGrupo($numeroGrupo);
		if(!empty($id) && !empty($afiliado) && !empty($fechaIngreso) && !empty($fechaPrimero) && !empty($fechaSegundo) && !empty($fechaTercero) && !empty($numeroGrupo)){
		 return true;	
		}
		return false;
	}
	function pantalla(){
		$save = array();
		$save[] = $this->grupo;
		$save[] = $this->msn;
		$body = serialize($save);
		return requireAVariable("../../vista/usuario/grupos.php",$body);
	}
}
$page = new Gruposs();
?>
