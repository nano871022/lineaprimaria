<?php
require_once '../../lib/interface/bean/iBean.php';
$page = null;
class Perfil implements iBean{
	var $enlace;
	var $body;
	var $change;
	var $message;
	function control(){
		$this->enlace = (new Conexion())->connect();
		$this->body = unserialize($_SESSION['afiliado']);
		if($this->validar()){
			$sql = $this->change->update();
			$result = $this->enlace->query($sql);
			if($result != null){
				$_SESSION['afiliado'] = serialize($this->change);
				$this->body = $this->change;
				$this->message = "<font color='green'>Se Actualizo el registro correctamente</font>";
			}else{
				$this->message = "<font color='red'>No se Actualizo el registro</font>";
			}
		}
	}
	function validar(){
		$this->change = new Afiliados();
		$this->change->setNombres  ($_REQUEST['nombre'   ]);
		$this->change->setApellidos ($_REQUEST['apellido' ]);
		$this->change->setCelular  ($_REQUEST['celular'  ]);
		$this->change->setDocumento($_REQUEST['documento']);
		$this->change->setOtros    ($_REQUEST['otros'    ]);
		$this->change->setId    ($this->body->getId());
		$validar1 = $this->change->getNombres  ()!=null && $this->change->getNombres  ()!=$this->body->getNombres  ();
		$this->message = $this->message." ".(strlen($this->change->getNombres  ())>0 ?"":"<font color='red'>El campo nombres no puede estar vacio</font>");
		$validar2 = $this->change->getApellidos()!=$this->body->getApellidos();
		$validar3 = $this->change->getCelular  ()!=null && $this->change->getCelular  ()!=$this->body->getCelular  ();
		$this->message = $this->message." ".(strlen($this->change->getCelular  ())>0 ?"":"<font color='red'>El campo celular no puede estar vacio</font>");
		$validar4 = $this->change->getDocumento()!=$this->body->getDocumento();
		$validar5 = $this->change->getOtros    ()!=$this->body->getOtros    ();
		if(($validar1 || $validar2 || $validar3 || $validar4 || $validar5) && strlen($this->message)<101){
		 return true;			
		}
		return false;
	}
	function pantalla(){
		$send = array();
		$send[] = $this->message;
		$send[] = $this->body;
		$body = serialize($send);
		return requireAVariable("../../vista/usuario/perfil.php",$body);
	}
}
$page = new Perfil();
?>