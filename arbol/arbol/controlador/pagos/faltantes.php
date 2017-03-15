<?php
include_once '../../lib/interface/bean/iBean.php';
include_once '../../lib/utils/ngrupo.php';
include_once '../../lib/utils/lista.php';
include_once '../../dto/ReferidoWhatsapp.php';
include_once '../../dto/WhatsappGrupos.php';
include_once '../../dto/vPagos.php';
include_once '../../dto/Pagos.php';
include_once '../../dto/vAfiliadoGrupo.php';
$page = null;
class ReferidosBean implements iBean {
	var $enlace;
	var $body;
	var $ifile;
	var $nGrupo;
	var $entrega;
	var $recibe;
	var $oWhatsapp;
	var $permisos;
	var $msn;
	var $pago;
	var $estrictoDevolucion;
	function control() {
		$this->permisos = unserialize($_SESSION['permisos']);
		$this->nGrupo = null;
		$this->enlace = (new Conexion ())->connect ();
		if ($this->validar ()) { // obtiene la lista del turno de pagos
			$this->obtenerListaFaltantes ();
			$this->ifile = "../../vista/pagos/listafaltantes.php";
		} else { // muestra el formulario para buscar la fecha de las personas q reciben los pagos y posteriormente obtener el listado
			$this->ifile = "../../vista/pagos/faltantes.php";
		}
	}
	function obtenerGruposWhatsap() {
		$grupos = array ();
		$wg = new WhatsappGrupos ();
		$result = $this->enlace->select ( $wg );
		if ($result != null) {
			$grupos = $result;
		}
		return $grupos;
	}
	/**
	 * se encarga de obtener el listado de personas q reciben pagon en la fecha seleccionada en el formulario
	 */
	function obtenerListaFaltantes() {
		$grupos = array ();
		$grupo = new VAfiliadoGrupo ();
		$grupo->setCodigoWhatsapp($this->nGrupo->getWhatsapp());
		$fecha = $this->obtenerFechaFaltante();
		$grupo->setFechaIngreso ( $fecha ); 
		$result = $this->enlace->selectOrder( $grupo," order by nombre asc");
		if ($result != null) {
			if(gettype($result) == "array"){
			foreach($result as $grupo2){
				$tiene = $this->tieneReferido($grupo2);
				if($tiene == 1 || !$tiene ){
				   $grupo2->setCantidad($tiene==1?1:0);
				   $grupos[] = $grupo2;
				}
			}}else if(gettype($result)=="object"){
				$grupo = $result;
				$tiene = $this->tieneReferido($grupo);
				if($tiene == 1 || !$tiene ){
				   $grupo->setCantidad($tiene==1?1:0);
				   $grupos[] = $grupo;
				}
		}
		}
	  $this->body = $grupos;
	}
	function obtenerFechaFaltante(){
		$dia = $this->nGrupo->numero > 5 ? $this->nGrupo->numero - 5:30;
		if($this->nGrupo->getMes() == 1 && $dia == 30){
			$mes = 12;
		}else if($this->nGrupo->getMes()>1 && $dia == 30){
			$mes = $this->nGrupo->getMes()-1;
		}else{
			$mes = $this->nGrupo->getMes();
		}
		$anio = $dia == 30 && $mes == 12?$this->nGrupo->getAnio()-1:$this->nGrupo->getAnio();
		return $anio."-".$mes."-".$dia;
	}
	function tieneReferido($grupo){
		if(empty($grupo)){return false;}
		$referido = new Referidos();
		$referido->setAfiliado(	$grupo->codigoGrupo);
		$result = $this->enlace->select($referido);
		if($result == null)return false;
		if(count($result)==1)return 1;
		if(count($result)==2) return true;

	}
	function validar() {
		$validar = true;
		$this->nGrupo = new NGrupo ();
		$this->nGrupo->setAnio ( $_REQUEST ['anio'] );
		$this->nGrupo->setMes ( $_REQUEST ['mes'] );
		$this->nGrupo->setNumero ( $_REQUEST ['grupo'] );
		$this->nGrupo->setWhatsapp ( $_REQUEST ['whatsapp'] );
		$this->nGrupo->setMes ( ($this->nGrupo->getMes () < 10 && strlen($this->nGrupo->getMes())<2 ? "0" : "") . $this->nGrupo->getMes () );
		$this->nGrupo->setNumero ( ($this->nGrupo->getNumero () < 10 && strlen($this->nGrupo->getMes())<2 ? "0" : "") . $this->nGrupo->getNumero () );
		$this->pago = $_REQUEST['pago'];
		$this->externo();
		$validar &= $this->nGrupo->getAnio () != null;
		$validar &= $this->nGrupo->getMes () != null;
		$validar &= $this->nGrupo->getNumero () != null;
		return $validar;
	}
function externo(){
		$url =  $_SERVER['REQUEST_URI'];
		if(strpos($url,"externo")){
			$this->nGrupo->setAnio(date("Y"));
			$this->nGrupo->setMes(date("m"));
			$dia = date("d");
			if($dia > 0 && $dia <= 5){
				$dia == 5;
			}else
			if($dia > 5 && $dia <= 10){
				$dia == 10;
			}else
			if($dia > 10 && $dia <= 15){
				$dia == 15;
			}else
			if($dia > 15 && $dia <= 20){
				$dia == 20;
			}else
			if($dia > 20 && $dia <= 25){
				$dia == 25;
			}else
			if($dia > 25 && $dia <= 30){
				$dia == 30;
			}else $dia = 30;
			$this->nGrupo->setNumero($dia);
		}
	
}
	function pantalla() {
		$send = array ();
		$send [] = $this->body;
		$send [] = $this->nGrupo;
		$send [] = $this->obtenerGruposWhatsap ();
		$send [] = $this->msn;
		$send [] = $this->pago;
		$body = serialize ( $send );
		return requireAVariable ( $this->ifile, $body );
	}
}
$page = new ReferidosBean ();

?>
