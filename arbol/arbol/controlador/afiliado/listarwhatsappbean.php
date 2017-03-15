<?php require_once '../../lib/interface/bean/iBean.php';
require_once "../../dto/WhatsappGrupos.php";
$page = "";
class ListarWhatsappGrupos implements iBean{
	var $body;
	var $msn;
	var $enlace;
	function control(){
		$this->body = array();
		$this->msn = "";
		$this->enlace = (new Conexion())->connect();
		if($this->validar()){
			$this->obtenerGrupos();
		}
	}
	function obtenerGrupos(){
		$grupo = new WhatsappGrupos();
		$query = $grupo->select().(strlen($grupo->where())>10?$grupo->where():"");
		$result = $this->enlace->query($query);
		if($result != null){
			while($row = $result->fetch_array()){
				$temp = new WhatsappGrupos();
				$temp->setRow($row);
				$this->body[] = $temp;
			}
		}
	}
	function validar(){
		return true;
	}
	function pantalla(){
		$send = array();
		$send[] = $this->body;
		$send[] = $this->msn;
		return requireAVariable("../../vista/afiliados/listarwhatsapp.php",serialize($send));
	}
}
$page = new ListarWhatsappGrupos();
?>
