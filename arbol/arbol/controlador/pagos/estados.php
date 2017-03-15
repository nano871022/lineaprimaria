<?php
include_once "../../lib/interface/bean/iBean.php";
include_once "../../dto/Pagos.php";
include_once "../../dto/vReferidoAG.php";
$page = null;
class EstadosBean implements iBean{
 var $enlace;
 var $body;
 var $msn;
 var $error;
 var $pagarA;
 var $pagosA;
 var $recibeDe;
 var $pagosDe;
 var $afiliado;
 function control(){
	$this->enlace = new Conexion();
        $this->msn    = "";
	$this->error  = "";
	if(!$this->validar()){
		$this->obtenerPago();
	}
}
function validar(){
$validar = true;
$valores = $_REQUEST;
foreach($valores as $k => $v){
if(strpos($k,"recibido")!==false){
$valores2 = $_REQUEST[$k];
foreach($valores2 as $k2 => $v2){
	$this->cargarPagoRecibido(str_replace("recibido","",$k),$v2);
}
}
if(strpos($k,"pago")!==false){
$valores2 = $_REQUEST[$k];
foreach($valores2 as $k2 => $v2){
	$this->cargarPagoEntregado(str_replace("pago","",$k),$v2);
}
}

}
$validar = false;
return $validar;
}
function cargarPagoRecibido($id,$valor){
	$pago = new Pagos();
	$pago->setId($id);
	$pago = $this->enlace->select($pago);
	if($pago->getRecibe() != $valor){	
		$pago->setRecibe($valor);
		$this->enlace->update($pago);
	}
}
function cargarPagoEntregado($id,$valor){
	$pago = new Pagos();
	$pago->setId($id);
	$pago = $this->enlace->select($pago);
	if($pago->getPaga() != $valor){	
		$pago->setPaga($valor);
		$this->enlace->update($pago);
	}
}
/** se encarga de obtener el registro de referido a quien se le debe cancelar el pago y las devoluciones q se realizan*/
function obtenerPago(){
	$grupos = null;
	$this->afiliado = $afiliado = unserialize($_SESSION['afiliado']);
	$grupo = new Grupo();
	$grupo->setAfiliado($afiliado->getId());
	$grupos = $this->enlace->select($grupo);
	if(gettype($grupos) == "array"){
		$this->pagarA = array();
		foreach($grupos as $grupo){
			$temp = $this->obtenerReferidoPago($grupo);
			$this->pagosA  = $this->obtenerPagos($temp,$grupo);
			$this->pagarA[] = $temp;
			$this->recibeDe[] = $this->obtenerReferidoRecibe($grupo);
			$this->pagosDe  = $this->obtenerPagosRecibe($grupo);
		}
	}else if(gettype($grupos) == "object"){
		$this->pagarA = $this->obtenerReferidoPago($grupos);
		$this->pagosA  = $this->obtenerPagos($this->pagarA,$grupos);
		$this->recibeDe = $this->obtenerReferidoRecibe($grupos);
		$this->pagosDe  = $this->obtenerPagosRecibe($grupos);
	}	
}
/**se encarga de obtenerlos pagos realizados por las personas las cuales debe realizar el pago y las devoluciones*/
function obtenerPagosRecibe($grupo){
	$pagos = array();
	foreach($this->recibeDe as $referido){
	 if($referido instanceof VReferidoAG){
		$pago = new Pagos();
		$pago->setRecibio($grupo->getId());
		$pago->setPago($referido->getCodigoAfiliado());
		$pago = $this->enlace->select($pago);
		if(gettype($pago) == "array"){
			$pagos = array_merge($pagos, $pago);
		}else if(gettype($pago)=="object"){
			$pagos[] =  $pago;
		}
	}}	
return $pagos;
}
/**se encarga de obtenerlos pagos realizados a la persona a la cual se le debe realizar el pago y las devoluciones*/
function obtenerPagos($referido,$grupo){
	 if($referido instanceof VReferidoAG){
		$pago = new Pagos();
		$pago->setRecibio($referido->getCodigoReferido());
		$pago->setPago($grupo->getId());
		$pagos =  $this->enlace->select($pago);
		if($pagos == null){
			
		}
		return $pagos;
	}	
}
/** se encarga de obtener el referido del grupo asociado, campo referido*/
function obtenerReferidoPago($grupo){
	if($grupo instanceof Grupo){
		$referido = new VReferidoAG();
		$referido->setCodigoReferido($grupo->getId());
		$referido = $this->enlace->select($referido);
		return $this->obtenerPadreReferido($referido,$grupo->getFechaIngreso());
	}
	 return null;
}
/** se encarga de obtener el referido del grupo asociado, campo afiliado*/
function obtenerReferidoRecibe($grupo){
	if($grupo instanceof Grupo){
		$referido = new VReferidoAG();
		$referido->setCodigoAfiliado($grupo->getId());
		$referido = $this->enlace->select($referido);
		return $this->obtenerHijoReferido($referido,$grupo->getFechaPrimero());
	}
	 return null;
}
/** se encarga de obtener el padre de quien lo refirio y verificar si es al que se le debe pagar la cuota*/
function obtenerPadreReferido($referido,$fecha){
	if($referido instanceof VReferidoAG){
		if(!$this->obtenerGrupoFecha($referido,$fecha)){
			$referidos = new VReferidoAG();
			$referidos->setCodigoReferido($referido->getCodigoAfiliado());
			$referidos = $this->enlace->select($referidos);
			return $this->obtenerPadreReferido($referidos,$fecha);
		}
	return $referido;
	}
 return null;
}
/** se encarga de obtener el hijo de quien refirio y verificar si es al que  le debe pagar la cuota*/
function obtenerHijoReferido($referidos,$fecha){
	$out = array();
	if(gettype($referidos) == 'array'){
		foreach ( $referidos as $referido){
			  $out2 = $this->obtenerHijoReferido2($referido,$fecha);
			  if(gettype($out2) == 'array'){
				$out = array_merge($out,$out2);
			}else if(gettype($out2)=='object'){
				$out[] = $out2;
			}
		}}else {
			$out2 = $this->obtenerHijoReferido2($referidos,$fecha);
			  if(gettype($out2) == 'array'){
				$out = array_merge($out,$out2);
			}else if(gettype($out2)=='object'){
				$out[] = $out2;
			}
		}
	return $out;
	}
/** se encarga de realizar de verificar su el referido es el que le debe cancelar si no vuelve a buscar lso hijos de ese referido **/
function obtenerHijoReferido2($referido,$fecha){
	if($referido instanceof VReferidoAG){
	if(!$this->obtenerGrupoFechaRecibe($referido,$fecha)){
		$referido2 = new VReferidoAG();
		$referido2->setCodigoAfiliado($referido->getCodigoReferido());
		$referido2 = $this->enlace->select($referido2);
		return $this->obtenerHijoReferido($referido2,$fecha);
	}else{
	 return $referido;
	}
	}
	return null;
}
/** se encarga de buscar el grupo y comparar las fechas de pago primero con el campo afiliado del referido*/
function obtenerGrupoFechaRecibe($referido,$fecha){
	if($referido instanceof VReferidoAG){
		$grupo = new Grupo();
		$grupo->setId($referido->getCodigoAfiliado());
		$grupo = $this->enlace->select($grupo);
		if($grupo->getFechaIngreso() == $fecha){
			return true;
		}
	}
return false;
}
/** se encarga de buscar el grupo y comparar las fechas de pago primero con el campo afiliado del referido*/
function obtenerGrupoFecha($referido,$fecha){$this->nv++;
	if($referido instanceof VReferidoAG){
		$grupo = new Grupo();
		$grupo->setId($referido->getCodigoReferido());
		$grupo = $this->enlace->select($grupo);
		if($grupo->getFechaPrimero() == $fecha){
			return true;
		}
	}
return false;
}
function pantalla(){
 $send   = array();
 $send[] = $this->pagarA;
 $send[] = $this->pagosA;
 $send[] = $this->recibeDe;
 $send[] = $this->pagosDe;
 $send[] = $this->afiliado;
 $send[] = $this->msn;
 $send[] = $this->error;
 return requireAVariable("../../vista/pagos/estados.php",serialize($send));
}
}
$page = new EstadosBean();
?>
