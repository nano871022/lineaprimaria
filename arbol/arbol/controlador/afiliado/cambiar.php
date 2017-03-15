<?php include_once '../../lib/interface/bean/iBean.php';
$page = null;
class CambiarAfiliadoPagina implements iBean{
	var $enlace;
	var $afiliado;
	var $grupo;
	var $buscar;
	var $page;
	function control(){
		$permisos = unserialize($_SESSION['permisos']);
		if(empty($permisos['CDA'])) return null;
		$afiliados = array();
		$this->enlace = (new Conexion())->connect();
		if($this->validarSeleccionar()){
			$this->loadSeleccion();
		}else{
			$this->loadBusqueda();
		} 
	}
	function loadSeleccion(){
		$afiliado = new Afiliados();
		$afiliado->setId($_REQUEST['id']);
		$sql = $afiliado->select().$afiliado->where();
		$result = $this->enlace->query($sql);
		if($result != null){
			if($row = $result->fetch_array()){
				$afiliado->setRow($row);
				$_SESSION['afiliado'] = serialize($afiliado);
				$_SESSION['grupo'] = null;
				unset($_SESSION['grupo']);
				$this->grupo = '<meta http-equiv="Refresh" content="1;url=./principal.php" />Redireccionando...';
				$this->limpiarSession();
			}
		}
	}
	function paginar(){
		$limit = "";
		$mov = $_REQUEST['mv'];
		$this->page = ($_SESSION['page']);
 		if($this->page >= 0){
			if($mov == "1"){
				$this->page = $this->page + 1;
			}else
				if($mov == "0"){
					if($this->page > 0){
						$this->page = $this->page - 1;
					}
				}else{
					$this->page = 0;
				}
  		}else{
				$this->page = 0;
			}
		$limit = " LIMIT ".($this->page*10)." , 10";
		$_SESSION['page'] = ($this->page);
		return $limit;
	}
	function loadBusqueda(){
			$this->validarBuscar();
			$afiliado = new Afiliados();
			$afiliado->setBuscar("%".$this->buscar."%");
			
			$sql = $afiliado->select().(empty($this->buscar)?"":$afiliado->where()).$this->paginar();
			$result = $this->enlace->query($sql);
			if($result != null){
				while($row = $result->fetch_array()){
					$temp = new Afiliados();
					$temp->setRow($row);
					$afiliados[] = $temp;
				}
			}
			$this->afiliado = $afiliados;
	}
	function validarBuscar(){
		$this->buscar = $_REQUEST['buscar'];
		
		if($this->buscar != null){
			$_SESSION['buscar'] = $this->buscar;
			return true;
		}
		return false;
	}
	function limpiarSession(){
		$_SESSION['buscar'] = null;
		unset($_SESSION['buscar']);
		$_SESSION['page'] = null;
		unset($_SESSION['page']);
	}
	function validarSeleccionar(){
		$id = $_REQUEST['id'];
		if(!empty($id)){
			return true;
		}
		return false;
	}
	function pantalla(){
		$send = serialize($this->afiliado);
		if(empty($this->grupo)){
			return requireAVariable("../../vista/afiliados/cambiar.php",$send);
		}else{
			return $this->grupo;
		}
	}
}
$page = new CambiarAfiliadoPagina();
?>
