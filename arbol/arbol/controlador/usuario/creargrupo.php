<?php 
require_once '../../lib/interface/bean/iBean.php';
$page = null;
class CrearGrupo implements iBean{
	var $grupo;
	var $msn;
	var $sGrupo;
	var $enlace;
	var $afiliado;
	function control(){
		$this->enlace = (new Conexion())->connect();
		$this->grupo = unserialize($_SESSION['grupo']);
		$this->afiliado = unserialize($_SESSION['afiliado']);
		if($this->validar()){
			$this->sGrupo->setAfiliado($this->afiliado->getId());
			$sql = $this->sGrupo->insert();
			$result = $this->enlace->query($sql);
			if($result != null){
				$this->msn = "<font color='green'>Se creo el grupo</font>";
			}else{
				$this->msn = "<font color='red'>No se creo el grupo</font>";
			}
		}
	}
	
	function validar(){
		$fechaIngreso = $_REQUEST['fechaIngreso'];
		$fechaPrimero = $_REQUEST['fechaPrimero'];
		$fechaSegundo = $_REQUEST['fechaSegundo'];
		$fechaTercero = $_REQUEST['fechaTercero'];
		$numeroGrupo  = $_REQUEST['numeroGrupo'];
		$this->sGrupo = new Grupo();
		$this->sGrupo->setFechaIngreso($fechaIngreso);
		$this->sGrupo->setFechaPrimero($fechaPrimero);
		$this->sGrupo->setFechaSegundo($fechaSegundo);
		$this->sGrupo->setFechaTercero($fechaTercero);
		$this->sGrupo->setNumeroGrupo($numeroGrupo);
		if(!empty($fechaIngreso) && !empty($fechaPrimero) && !empty($fechaSegundo) && !empty($fechaTercero) && !empty($numeroGrupo)){
			return true;
		}
		return false;
	}
	function pantalla(){
		$save = array();
		$save[] = $this->grupo;
		$save[] = $this->msn;
		$body = serialize($save);
		return requireAVariable("../../vista/usuario/creargrupo.php",$body);
	}
}
$page = new CrearGrupo();
?>