<?php
require_once '../../lib/interface/bean/iBean.php';
$page = null;
class CambiarAfiliado implements iBean {
	var $body;
	var $enlace;
	var $referido;
	var $numeroReferido;
	function validarRetorno() {
		if ($_SESSION ['ReferidoCambiar'] != null) {
			$this->referido = unserialize ( $_SESSION ['ReferidoCambiar'] );
		} else {
			$this->referido = null;
		}
		if ($_SESSION ['NuevoReferido'] != null) {
			$this->numeroReferido = $_SESSION ['NuevoReferido'];
		} else {
			$this->numeroReferido = null;
		}
	} // end validar retorno
	function crearReferido() {
		$grupo = new Grupo ();
		$grupo->setId ( $_REQUEST ['id'] );
		if ($grupo->getId () != null) {
			$referido = new Referidos ();
			$referido->setReferido ( $grupo->getId () );
			$sql = $referido->select () . $referido->where ();
			$result = $this->enlace->query ( $sql );
			if ($result != null) {
				if ($row = $result->fetch_array ()) {
					$referido->setRow ( $row );
					$_SESSION ['ReferidoCambiar'] = serialize ( $referido );
					$this->body = ' <meta http-equiv="Refresh" content="1;url=./principal.php?nav=afiliado/referido&id=' . $referido->getAfiliado () . '" />Redireccionando...';
				}
			}
		}
	} // end crear referido
	function control() {
		$this->enlace = (new Conexion ())->connect ();
		$this->validarRetorno ();
		if ($this->referido == null) {
			$this->crearReferido ();
		} else {
			$this->cambiarReferido ();
		}
	} // end control
	function cambiarReferido() {
		$_SESSION ['ReferidoCambiar'] = null;
		$_SESSION ['NuevoReferido'] = null;
		unset ( $_SESSION ['ReferidoCambiar'] );
		unset ( $_SESSION ['NuevoReferido'] );
		//obtengo el referido creado
		$ref = new Referidos ();
		$ref->setId ( $this->numeroReferido );
		$sql = $ref->select () . $ref->where ();
		$result = $this->enlace->query ( $sql );
		if ($result != null) {
			if ($row = $result->fetch_array ()) {
				$ref->setRow ( $row );
			}
		} // end if
		//obtengo el grupo del referido a cambiar
		$grupo1 = $this->obtenerGrupoReferido($this->referido->getReferido());
		//obtengo el grupo del nuevo referido
		$grupo2 = $this->obtenerGrupoReferido($ref->getReferido());
		//cambio de grupo
		$grupo1->setAfiliado($grupo2->getAfiliado());
		$query = $grupo1->update();
		$result = $this->enlace->query( $query);
		if($result != null){
			$query = $ref->delete();
			$result = $this->enlace->query( $query);
			if($result != null){
				$query = $grupo2->delete();
				$result = $this->enlace->query($query);
				if($result != null){
					$this->body = '<font color="green">Se realizo el cambio correctamente</font>';
				}else{
					$this->body = '<font color="red">No se realizo el cambio (cod:3)</font>';
					
				}
			}else{
					$this->body = '<font color="red">No se realizo el cambio (cod:2)</font>';
			}
		}else{
					$this->body = '<font color="red">No se realizo el cambio (cod:1)</font>';
		}
		$_SESSION['grupo']    = null;
	} // end cambiar referido
	function obtenerGrupoReferido($id){
		$grupo = new Grupo();
		$grupo->setId($id);
		$query = $grupo->select().$grupo->where();
		$result = $this->enlace->query($query);
		if($result != null){
			if($row = $result->fetch_array () ){
				$grupo->setRow($row);
			}
		}
		return $grupo;
	}
	function pantalla() {
		$body = $this->body;
		return $body;
	}
}
$page = new CambiarAfiliado ();

?>