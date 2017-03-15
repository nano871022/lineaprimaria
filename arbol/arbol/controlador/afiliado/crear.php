<?php require_once "../../lib/interface/bean/iBean.php";
$page = null;
class Crear implements iBean{
	var $body;
	var $afiliado;
	var $enlace;
	var $show;//si es true muestra pantalla de creacion de lo contrario va a crear el registro

	function control(){
		$this->show = true;
		$this->enlace = (new Conexion())->connect();
		$this->loadVar();
		if($this->afiliado->getNombres() != null && $this->afiliado->getCelular() != null){
			$this->creacion();
			$this->show = false;
		}
		$id = $_REQUEST["grupo"];
		if(!empty($id)){
			$_SESSION['idBuscarReferido'] = $id;
		}
	}//end control
	function loadVar(){
		$this->afiliado = new Afiliados();
		$this->afiliado->setNombres  ($_REQUEST["nombre"]   );
		$this->afiliado->setApellidos ($_REQUEST["apellido"] );
		$this->afiliado->setCelular  ($_REQUEST["celular"]  );
		$this->afiliado->setDocumento($_REQUEST["documento"]);
		$this->afiliado->setOtros    ($_REQUEST["otros"]    );
	} //end load var

    function creacion(){
		$imprimir = "";
		if($this->afiliado->getNombres() != null || $this->afiliado->getCelular() != null)
		{
			if($this->validar()){
				$sql = $this->afiliado->insert();
				$result = $this->enlace->query($sql);
				if( $result != null){
					$imprimir = "<h3>Registro Agregado</h3>";
				}else{
					$imprimir = "<h3>No se agrego el registro</h3>";
				}
			}
			if( $_SESSION['NuevoGrupo'] != null ){
				$id = $_SESSION['idBuscarReferido'];
				$cel = $_SESSION['CELULARAFILIADO'];
				$_SESSION['CELULARAFILIADO'] = null;
				unset($_SESSION['CELULARAFILIADO']);
				if(!empty($id)){
					$_SESSION['idBuscarReferido'] = null;
					unset($_SESSION['idBuscarReferido']);
				}
				$this->body = '  <meta http-equiv="Refresh" content="1;url=./principal.php?nav=afiliado/buscarreferido'.((!empty($id))?"&idGrupo=".$id:"").'&celular='.$cel.'&celular1='.$this->afiliado->getCelular().'" />Redireccionando...';
			}else{
				$imprimir = $imprimir.'<br/><a href="./principal.php?nav=afiliado/crear">Agregar Nuevo registro</a>';
				$this->body = $imprimir;
			}
		}
	}//end creacion
	
	function pantalla(){
	    if( $this->show ){
			$body = serialize($this->body);
			return requireAVariable("../../vista/afiliados/crear.php",$body);
		}else{
			return $this->body;
		}
	}//end pantalla
	
	function validar(){
		$validar = strlen($this->afiliado->getNombres() ) > 2?true:false;
		$validar &= strlen($this->afiliado->getCelular())==10?true:false;
		if(!$validar){
			echo "El campo nombre o celular no se encuentran llenos correctamente";
		}
		return $validar;
	}//end validar

}//end class
$page = new Crear();

?>
