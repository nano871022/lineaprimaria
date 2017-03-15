<?php
require_once "../../lib/interface/bean/iBean.php";
require_once "../../lib/utils/ngrupo.php";
require_once "../../lib/utils/lista.php";
$page = null;

class ListaReferidos implements iBean {
	var $body;
	var $actual;
	var $destinos;
	var $origen;
	var $mes;
	var $anio;
	var $numero;
	
	function control() {
		$this->actual   = (new Conexion ())->connect ();
		$this->body     = null;
		$this->destinos = null;
		$this->origen   = null;
		$this->mes      = null;
		$this->anio     = null;
		$this->numero   = null;
		$this->loadVForm();
		$this->buscarOrigen();
		$this->buscarDestino();
	}//end control
	
	function loadVForm(){
		if(isset($_SESSION['NuevoGrupo'])){
			$ng = new NGrupo();
			$ng = unserialize($_SESSION['NuevoGrupo']);
			$this->mes    = $ng->getMes();
			$this->anio   = $ng->getAnio();
			$this->numero = $ng->getNumero();
		}else{
			$this->mes    = $_REQUEST['mes'];
			$this->anio   = $_REQUEST['anio'];
			$this->numero = $_REQUEST['grupo'];
		}
	}//end load v form
	
	function buscarOrigen() {
		$origen = new Afiliados ();
		$origenes = array ();
		if (isset ( $_REQUEST ['id'] )) {
			$origen->setId ( $_REQUEST ['id'] );
		} else {
			$origen->setCelular ( $_REQUEST ['celular'] );
		}
		$result = $this->actual->query ( $origen->select () . $origen->where () );
		if (isset ( $result )) {
			while ( $row = $result->fetch_array () ) {
				$temp = new Afiliados ();
				$temp->setRow ( $row );
				$origenes [] = $temp;
			} // end while
		$origenes = $this->obtenerGrupo($origenes);
		} // end if
		$this->origen = $origenes;
	}//end buscar origen
	
	function obtenerGrupo($lista) {
		$origenes = array ();
		foreach ( $lista as $obj ) {
			$obj1 = new Grupo ();
			$g = $_REQUEST['idGrupo'];
			if( $g != null ){
			  $obj1->setId( $g );
			}
			$obj1->setAfiliado ( $obj->getId () );
			$query = $obj1->select () . $obj1->where () ;
			$result = $this->actual->query ($query );
			if (isset ( $result )) {
				while ( $row = $result->fetch_array () ) {
					$temp = new Grupo();
					$temp->setRow($row);
					$temp->setOAfiliado($obj);
					$origenes[] = $temp;
				}
			}
		}
		return $origenes;
	}//end obtener grupo
	function buscarDestino() {
		$afiliados = array ();
		$afiliado = new Afiliados ();
		$afiliado->setCelular ( $_REQUEST ['celular1'] );
		$sql = $afiliado->select () . $afiliado->where ();
		$result = $this->actual->query ( $sql );
		if ($result != null) {
			while ( $row = $result->fetch_array () ) {
				$temp = new Afiliados ();
				$temp->setRow ( $row );
				$afiliados [] = $temp;
			}
		}
		$this->destinos = $afiliados;
	}//end buscar destino
	
	function pantalla() {
		$bodys = new Lista();
		$ng = new NGrupo();
		$bodys->setOrigen($this->origen);
		$bodys->setDestino($this->destinos);
		$ng->setAnio($this->anio);
		$ng->setMes($this->mes);
		$ng->setNumero($this->numero);
		$_SESSION['NuevoGrupo'] = serialize($ng);
		$_SESSION['CELULARAFILIADO'] = $_REQUEST['celular'];
		$body = serialize($bodys);
		return requireAVariable ( "../../vista/afiliados/registroreferidos.php", $body);
	}//end pantalla
	
	function getOrigen(){
	return $this->origen;
	}
	function getDestino(){
		return $this->destinos;
	}
	function getMes(){
		return $this->mes;
	}
	function getAnio(){
		return $this->anio;
	}
	function getNumero(){
		return $this->numero;
	}
}
$page = new ListaReferidos ();
?>
