<?php
require_once '../../lib/interface/bean/iBean.php';
$page = null;
class Usuario implements iBean {
	var $enlace;
	var $body;
	var $usuario;
	var $msn;
	var $cambio;
	function control() {
		$this->enlace = (new Conexion ())->connect ();
		$this->usuario = unserialize ( $_SESSION ['usuario'] );
		if ($this->validar ()) {
			$this->usuario->setPassword ( $_REQUEST ['password'] );
			$sql = $this->usuario->update();
			$result = $this->enlace->query($sql);
			if($result != null){
				$this->msn = "<font color='green'>Se cambio de contrase&ntilde;a correctamente</font>";
				$_SESSION['usuario'] = serialize($this->usuario);
			}else{
				$this->msn = "<font color='red'>No se logro cambiar de contrase&ntilde;a</font>";
			}
		}
	}
	function validar() {
		$anterior = $_REQUEST ['last'];
		$nuevo = $_REQUEST ['password'];
		$repetir = $_REQUEST ['repetirPassword'];
		if (! empty ( $anterior ) && ! empty ( $nuevo ) && ! empty ( $repetir )) {
			if ($nuevo != $repetir) {
				$this->msn = "<font color='red'>La contrase&ntilde;as ingresadas no coinciden</font>";
				return false;
			}
			$user = new Usuarios ();
			$user->setUsuario ( $this->usuario->getUsuario () );
			$user->setPassword ( $anterior );
			$sql = $user->login ();
			echo $sql;
			$result = $this->enlace->query ( $sql );
			if ($result != null) {
				if ($row = $result->fetch_array ()) {
					return true;
				}
			}
		}
		return false;
	}
	function pantalla() {
		$send = array();
		$send[] = $this->usuario;
		$send[] = $this->msn;
		$body = serialize($send);
		return requireAVariable ( "../../vista/usuario/usuario.php", $body );
	}
}
$page = new Usuario ();
?>