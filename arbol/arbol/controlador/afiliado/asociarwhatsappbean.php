<?php
require_once "../../lib/interface/bean/iBean.php";
require_once "../../dto/ReferidoWhatsapp.php";
require_once "../../dto/WhatsappGrupos.php";
require_once "../procesar/grupowhatsapp.php";
class AsociarWhatsappBean implements iBean {
	var $msn;
	var $enlace;
	var $referidos;
	var $whatsapp;
	var $update;
	var $permisos;
	function control() {
		$this->permisos = unserialize($_SESSION['permisos']);
		$this->enlace = (new Conexion ())->connect ();
		$this->msn = "";
		if(!empty($this->permisos['AWP'])){
			if ($this->validar ()) {
				$this->actualizar ();
			}
		}
		if(!empty($this->permisos['MGE'])){
			$this->procesar ();
		}
		$this->referidos = $this->obtenerReferido ();
		$this->whatsapp = $this->obtenerWhatsapp ();
	}
	function actualizar() {
		$query = $this->update->update ();
		$result = $this->enlace->query ( $query );
		if ($result != null) {
			$this->msn = "<font color='green'>Se actualizo correctamente el grupo de whatsapp</font>";
		} else {
			$this->msn = "<font color='red'>No se actualizo el grupo de whatsapp</font>";
		}
	}
	function procesar() {
		$id = $_REQUEST ['id2'];
		$grupo = $_REQUEST ['grupo2'];
		if (! empty ( $id ) && ! empty ( $grupo )) {
			$ref = new Referidos ();
			$ref->setId ( $id );
			$query = $ref->select () . $ref->where ();
			$result = $this->enlace->query ( $query );
			if ($result != null) {
				if ($row = $result->fetch_array ()) {
					$ref->setRow($row);
					$temp = new GrupoWhatsappPro ();
					$temp->procesar ( $ref->getAfiliado(), $grupo );
					$this->msn = "<font color='green'>Proceso terminado</font>";
				}
			}
		}
	}
	function validar() {
		$WG = new ReferidoWhatsapp ();
		$WG->setId ( $_REQUEST ['id'] );
		$WG->setWhatsapp ( $_REQUEST ['whatsapp'] );
		$WG->setReferido ( $_REQUEST ['referido'] );
		$WG->setAgregado ( $_REQUEST ['agregado'] );
		if (! empty ( $WG->getId () ) && ! empty ( $WG->getWhatsapp () )) {
			$this->update = $WG;
			if (empty ( $WG->getAgregado () )) {
				$WG->setAgregado ( "N" );
			} else {
				$WG->setAgregado ( "S" );
			}
			return true;
		}
		return false;
	}
	function obtenerWhatsapp() {
		$wgs = array ();
		$wg = new WhatsappGrupos ();
		$query = $wg->select ();
		$result = $this->enlace->query ( $query );
		if ($result != null) {
			while ( $row = $result->fetch_array () ) {
				$wg = new WhatsappGrupos ();
				$wg->setRow ( $row );
				$wgs [] = $wg;
			}
		}
		return $wgs;
	}
	function obtenerReferido() {
		$referidosWS = array ();
		$grupos = unserialize ( $_SESSION ['grupo'] );
		foreach ( $grupos as $grupo ) {
			if (count ( $grupo ) > 0) {
				return $this->obtenerReferidos ( $grupo->getId () );
			}
		}
	}
	function obtenerReferidos($id) {
		$referido = new Referidos ();
		$load = "S";
		load:
		$i = 0;
		if ($load == "S") {
			$referido->setReferido ( $id );
			$referido->setAfiliado ( null );
		} else {
			$referido->setAfiliado ( $id );
			$referido->setReferido ( null );
		}
		$query = $referido->select () . $referido->where ();
		$result = $this->enlace->query ( $query );
		if ($result != null) {
			while ( $row = $result->fetch_array () ) {
				$ref = new Referidos ();
				$ref->setRow ( $row );
				$tempWS = $this->obtenerReferidoWhatsapp ( $ref->getId () );
				foreach ( $tempWS as $tempW ) {
					$referidosWS [] = $tempW;
				}
				if (count ( $tempWS ) == 0) {
					$tempW = $this->crearReferidoWhatsapp ( $ref->getId () );
					if ($tempW != null) {
						$referidosWS [] = $tempW;
					}
				}
				$i ++;
			}
		} // end id
		if ($i == 0 && $load == "S") {
			$load = "N";
			goto load;
		}
		return $referidosWS;
	}
	function crearReferidoWhatsapp($referido) {
		$tempW = new ReferidoWhatsapp ();
		$tempW->setReferido ( $referido );
		$query = $tempW->insert ();
		$result = $this->enlace->query ( $query );
		if ($result != null) {
			$id = $result->insert_id;
			$temp = new ReferidoWhatsapp ();
			$temp->setId ( $id );
			$query = $temp->select () . $temp->where ();
			$result = $this->enlace->query ( $query );
			if ($result != null) {
				if ($row = $result->fetch_array ()) {
					$temp->setRow ( $row );
					return $temp;
				}
			}
		}
		return null;
	}
	function obtenerReferidoWhatsapp($referido) {
		$referidos = array ();
		$refw = new ReferidoWhatsapp ();
		$refw->setReferido ( $referido );
		$query = $refw->select () . $refw->where ();
		$result = $this->enlace->query ( $query );
		if ($result != null) {
			while ( $row = $result->fetch_array () ) {
				$temp = new ReferidoWhatsapp ();
				$temp->setRow ( $row );
				$referidos [] = $temp;
			}
		}
		return $referidos;
	}
	function pantalla() {
		$send = array ();
		$send [] = $this->referidos;
		$send [] = $this->whatsapp;
		$send [] = $this->msn;
		return requireAVariable ( "../../vista/afiliados/asociarwhatsapp.php", serialize ( $send ) );
	}
}
$page = new AsociarWhatsappBean ();
?>
