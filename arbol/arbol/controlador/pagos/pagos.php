<?php
include_once '../../lib/interface/bean/iBean.php';
include_once '../../lib/utils/ngrupo.php';
include_once '../../lib/utils/lista.php';
include_once '../../dto/ReferidoWhatsapp.php';
include_once '../../dto/WhatsappGrupos.php';
include_once '../../dto/vPagos.php';
include_once '../../dto/Pagos.php';
$page = null;
class PagosBean implements iBean {
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
			if(!empty($this->permisos['APR'])){
				$this->actualizarReciben ();
				$this->actualizarPagan();
			}else{$this->msn = "<font color='red'>No tiene permisos para actualizar pagos</font>";}
			$this->obtenerListaPagosFecha ();
			$this->ifile = "../../vista/pagos/listas.php";
		} else { // muestra el formulario para buscar la fecha de las personas q reciben los pagos y posteriormente obtener el listado
			$this->ifile = "../../vista/pagos/pagos.php";
		}
	}
	function actualizarReciben() {
		if ($this->recibe != null) {
			foreach ( $this->recibe as $id ) {
				$pago = new Pagos ();
				$pago->setId ( $id );
				$pago->setNumeroPago ($this->pago + 1 );
				$result = $this->enlace->select($pago);
				if ($result != null) {
					if($result instanceof Pagos){
						$result->setRecibe ( "S" );
						$result = $this->enlace->update($result);
						if ($result == null || $result == false) {
							echo "No se puede cactualizar pago";
						}
					}
				}
			}
		}
	} // end funcion actualizar recibe
	function actualizarPagan() {
		if ($this->entrega != null) {
			foreach ( $this->entrega as $id ) {
				$pago = new Pagos ();
				$pago->setId( $id );
				$pago->setNumeroPago ($this->pago + 1 );
				$result = $this->enlace->select( $pago );
				if ($result != null) {
					if ($pago = $result) {
						$pago->setPaga ( "S" );
						$result = $this->enlace->update( $pago );
						if ($result == null) {
							echo "No se puede cactualizar pago";
						}
					}
				}
			}
		}
	} // end funcion actualizar recibe
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
	function obtenerListaPagosFecha() {
		$grupos = array ();
		$grupo = new Grupo ();
		$fecha = $this->nGrupo->getAnio () . "-" . $this->nGrupo->getMes () . "-" . $this->nGrupo->numero;
		switch($this->pago){
		 case	0: $grupo->setFechaPrimero ( $fecha ); break;
		 case	1: $grupo->setFechaSegundo ( $fecha ); break;
		 case	2: $grupo->setFechaTercero ( $fecha ); break;
		 case	3: $grupo->setFechaTercero ( $fecha ); break;
		}
		$result = $this->enlace->select( $grupo);
		if ($result != null) {
			$grupos = $result;
			$this->obtenerPagadores ( $grupos );
		}
	}
	/**
	 * se encarga de recorer la lista de los referidos buscando el grupo con fecha de ingreso igual a la fecha de primer pago
	 *
	 * @param unknown $grupos        	
	 */
	function obtenerPagadores($gruposs) {
		$grupos = array ();
		if (count ( $gruposs ) > 0) {
			foreach ( $gruposs as $grupo ) {
				$fecha = null;
				switch($this->pago){
					case 0: $fecha = $grupo->getFechaPrimero();break;
					case 1: $fecha = $grupo->getFechaSegundo();break;
					case 2: $fecha = $grupo->getFechaTercero();break;
					case 3: $fecha = $grupo->getFechaTercero();break;
				} 
				$obj = $this->obtenerReferidoParaPrimerPago ( $grupo->getId (), $fecha,$grupo->getId() );
				if ($obj != null) {
					$lista = new Lista ();
					$grupo->setOAfiliado ( $this->obtenerAfliado ( $grupo->getAfiliado () ) );
					$lista->setOrigen ( $grupo );
					$lista->setDestino ( $obj );
					$grupos [] = $lista;
				}
			}
		}
		$this->body = $grupos;
	}
	/**
	 * Se encarga de obtener por cada uno de los referidos indicados a pagar si ya realizaron el pago o no
	 */
	function obtenerPagos($recibe, $entrega) {
		$vista = new Pagos ();
		$vista->setRecibio ( $recibe );
		$vista->setPago ( $entrega );
		$vista->setNumeroPago ($this->pago+1 );
		$result = $this->enlace->select( $vista );
		if ($result != null) {
		   return  $result ;
		} else {
				$pago = new Pagos ();
				$pago->setPago ( $entrega );
				$pago->setPaga ( "N" );
				$pago->setRecibio ( $recibe );
				$pago->setRecibe ( "N" );
				$pago->setNumeroPago ( $this->pago+1 );
				$result = $this->enlace->insert( $pago );
				if ($result != null) {
					$id = $this->enlace->insert_id;
					$pago->setId($id);
					return $pago ;
				}
			}
		}
	function obtenerReferidoParaPrimerPago($afiliado, $fecha,$original) {
		$grupos = array ();
		$referido = new Referidos ();
		$referido->setAfiliado ( $afiliado );
		$result22 = $this->enlace->select($referido);
		if ($result22 != null) {
			if(gettype($result22) == "array"){
				foreach($result22 as $temp){
					if(($temp = $this->obtenerReferidoWhatsapp($temp))=="true") continue;
				          $valor = $this->obtenerReferidoGrupo($afiliado,$temp,$fecha,$original);
					  if(gettype($valor) == "array"){
					 	 $grupos = array_merge($grupos,$valor);
					}
					}
				}else if(gettype($result22) == "object"){
					if($result22 instanceof Referidos){
					 if(($result22 = $this->obtenerReferidoWhatsapp($result22))!="true"){ 
				 	   $value = $this->obtenerReferidoGrupo($afiliado,$result22,$fecha,$original);
					   if(count($value)==1){
						$value = $value[0];
						}else if(count($value) > 1){
						$grupos = array_merge($grupos,$value);
						}
					 if($value instanceof Afiliados){
					  $grupos[] = $value;
					 }
					}
					}
				}
		}	
		return $grupos;
	}
	function obtenerReferidoGrupoArray($obj,$temp,$afiliado,$original){
		$array = array();
		if(gettype($obj) == "array"){
			foreach($obj as $valor){
				$valors = $this->obtenerReferidoGrupoArray($valor,$temp,$afiliado,$original);
				if($valors != null){
					$array = array_merge($array, $valors);
				}
			}
		}else if(gettype($obj) == "object"){
			$valors = $this->obtenerReferidoGrupoObject($obj,$temp,$afiliado,$original);
			if($valors != null){
				if($valors instanceof Afiliados){
				$array[] = $valors;
				}
			}
		}
	  if(count($array)>0){
	  	return $array;
	}
	return null;
	}
	function obtenerReferidoGrupoObject($obj,$temp,$afiliado,$original){
	   if($obj != null){
		if($obj instanceof Grupo){
			if($this->obtenerPagosDevoluciones($grupo)){
			$oafiliado = $obj->getOAfiliado();
			if($oafiliado != null){
				if($oafiliado instanceof Afiliados){	
					if (! empty ( $temp->getOWhatsapp () )) {
						$oafiliado->setOWhatsapp ( $temp->getOWhatsapp () );
					}
					if(!empty($obj->id)){
						$oafiliado->setGrupo($temp->getReferido());
						$oafiliado->setOPago($this->obtenerPagos($original,$obj->id));
					}
					return $oafiliado;
				}
			}
		}}else if($obj instanceof Afiliados){	
			return $obj;
			}
	   }
	 return null;
	}
	function obtenerReferidoGrupo($afiliado,$temp,$fecha,$original){
		$grupo = array();
		$obj = $this->obtenerGrupoReferido ( $temp->getReferido (), $fecha,$original );
		$grupo = $this->obtenerReferidoGrupoArray($obj,$temp,$afiliado,$original);
		return $grupo;
	}
	function obtenerPagosDevoluciones($grupo){
	if($this->estrictoDevolucion == 'S'){
	if($grupo instanceof Grupo){
	if($this->pago > 0 ){
		$pago = new Pagos();
		$pago->setRecibio($grupo->getId());
		$pago->setNumeroPago($this->pago);
		$pago->setPagoRealizado("S");
		$result = $this->enlace->cantidad($pago);
		return $result>0;
	}}}
	return true;
	}
       function obtenerReferidoWhatsapp($temp){
				$whatsapp = new ReferidoWhatsapp ();
				$whatsapp->setReferido ( $temp->getId() );
				$whatsapp->setWhatsapp ( $this->nGrupo->getWhatsapp () );
				if (! empty ( $this->nGrupo->getWhatsapp () )) {
					$resultW = $this->enlace->select($whatsapp);
					if ($resultW != null) {
						if($whatsapp = $resultW){
							$temp->setOWhatsapp ( $whatsapp );
						}
					}
					if (empty ( $whatsapp->getId () )) {
						return true;
					}
				}
			return $temp;
		}
	function obtenerGrupoReferido($id, $fecha,$original) {
		$grupo = new Grupo ();
		$grupo->setId ( $id );
		$result = $this->enlace->select($grupo);
		if ($result != null) {
			if($temp = $result){
			  $fecha2 = null;
				switch($this->pago){
				   case 0: $fecha2 = $temp->getFechaIngreso();break;
				   case 1: $fecha2 = $temp->getFechaPrimero();break;
				   case 2: $fecha2 = $temp->getFechaSegundo();break;
				   case 3: $fecha2 = $temp->getFechaTercero();break;
				}
				if ($this->compararFecha ( "<", $fecha2, $fecha )) {
					$out =  $this->obtenerReferidoParaPrimerPago ( $temp->getId (), $fecha ,$original);
					if(gettype($out) == "array")if(count($out)==0)return null;
					return $out;
				}
				if ($this->compararFecha ( "=", $fecha2, $fecha )) {
					$temp->setOAfiliado ( $this->obtenerAfliado ( $temp->getAfiliado () ) );
					return $temp;
				}
			}
		}
		return null;
	}
	function obtenerAfliado($id) {
		$afiliado = new Afiliados ();
		$afiliado->setId ( $id );
		$result = $this->enlace->select( $afiliado);
		if ($result != null) {
			if ($afiliado = $result) {
				$afiliado->setOWhatsapp ( $this->obtenerWhatsapp () );
				return $afiliado;
			}
		}
		return null;
	}
	function obtenerWhatsapp() {
		if ($this->oWhatsapp == null) {
			$id = $this->nGrupo->getWhatsapp ();
			$ws = new WhatsappGrupos ();
			$ws->setId ( $id );
			$ws = $this->enlace->select( $ws );
			$this->oWhatsapp = $ws;
		}
		return $this->oWhatsapp;
	}
	function compararFecha($simbolo, $fechaIngreso, $fechaPrimero) {
		$query = "select '" . $fechaIngreso . "' " . $simbolo . " '" . $fechaPrimero . "' as comparar from Usuarios limit 1";
		$result = $this->enlace->query ( $query );
		if ($result != null) {
			if ($row = $result->fetch_array ()) {
				if ($row ['comparar'] == 1) {
					return true;
				}
			}
		}
		return false;
	}
	function validar() {
		$validar = true;
		$this->nGrupo = new NGrupo ();
		$this->nGrupo->setAnio ( $_REQUEST ['anio'] );
		$this->nGrupo->setMes ( $_REQUEST ['mes'] );
		$this->nGrupo->setNumero ( $_REQUEST ['grupo'] );
		$this->nGrupo->setWhatsapp ( $_REQUEST ['whatsapp'] );
		$this->entrega = $_REQUEST ['entrega'];
		$this->recibe = $_REQUEST ['recibe'];
		$this->nGrupo->setMes ( ($this->nGrupo->getMes () < 10 && strlen($this->nGrupo->getMes())<2 ? "0" : "") . $this->nGrupo->getMes () );
		$this->nGrupo->setNumero ( ($this->nGrupo->getNumero () < 10 && strlen($this->nGrupo->getMes())<2 ? "0" : "") . $this->nGrupo->getNumero () );
		$this->pago = $_REQUEST['pago'];
		$this->estrictoDevolucion = $_REQUEST['devolucion'];
		if(empty($this->estrictoDevolucion)){
			$this->estrictoDevolucion = "N";
		}
		if(empty($this->pago)){
			$this->pago = 0;
		}
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
			$this->nGrupo->setNumero($dia<10?"0".$dia:$dia);
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
$page = new PagosBean ();

?>
