<?php session_start(); require "../conexion/conexion.php"; require "../../dto/Usuarios.php"; require "../../dto/Afiliados.php";

class Registrar{
	var $msnPassword;
	var $msnPassword2;
	var $msnCelular;
	var $msnUsuario;
	var $usuario;
	var $afiliado;
	
	function control(){
		$id = $_REQUEST['id'];
		$this->usuario = new Usuarios();
		$this->afiliado = new Afiliados();
		if($this->validarRegistrar()){
			$this->registrando();
			return;
		}
		if($id != null ){
			$_REQUEST['usuario']  = $_SESSION['usuario'];
			$_REQUEST['password'] = $_SESSION['password'];
			$_SESSION['usuario'] = null;
			$_SESSION['password'] = null;
			$this->registrando();
			return;
		}
		$this->formulario();
	}
	
	function registrando(){
		$this->afiliado = new Afiliados();
		$this->afiliado->setCelular($_REQUEST['celular']);
		$enlace = (new Conexion())->connect();
		$id = $_REQUEST['id'];
		if($id == null){
			$sql = $this->afiliado->cantidadRegistros()." where afs_celular = ".$this->afiliado->getCelular();
		}else{
			$sql = $this->afiliado->cantidadRegistros()." where afs_llave = ".$id;
		}
	    $result = $enlace->query($sql);
	    if($result != null){
			if($row = $result->fetch_array()){
				if($row['cont'] == 1){
					$sql = $this->afiliado->select();
					if($id== null){
						$sql = $sql." where afs_celular = '".$this->afiliado->getCelular()."'";
					}else{
						$sql = $sql." where afs_llave = '".$id."'";
					}
					$result = $enlace->query($sql);
					if($row = $result->fetch_Array()){
						$this->afiliado->setRow($row);
						$this->usuario = new Usuarios();
						$this->usuario->setUsuario($_REQUEST['usuario']);
						$this->usuario->setPassword($_REQUEST['password']);
						$this->usuario->setAfiliado($this->afiliado->getId());
						$this->usuario->setNumeroIntentos(0);
						$this->usuario->setEstado("A");
						$this->usuario->setRol(1);
						$sql = $this->usuario->insert();
						$result = $enlace->query($sql);
						if($result != null){
							$_SESSION['idAfiliado'] = $this->afiliado->getId();
							?>
							Registro Agregado Corectamente
							 <meta http-equiv="Refresh" content="3;url=./login.php" /><br/>
								Redireccionado...
							<?php
						}else{
							?>
							<h3></h3>No se pudo Agregado Registro</h3>
							<?php
							$this->formulario();
						}
					}
				}else{
					if($row['cont'] > 1){
						$sql = $this->afiliado->select()." where afs_celular = '".$this->afiliado->getCelular()."'";
						$result = $enlace->query($sql);
						if($result != null){
							?> Quien Eres <br/><?php
							while($row = $result->fetch_array()){
								$afiliado = new Afiliados();
								$afiliado->setRow($row);
								$_SESSION['usuario'] = $this->usuario->getUsuario();
								$_SESSION['password'] = $this->usuario->getPassword();
								?> 
								<a href="./registrar.php?id=<?php echo $afiliado->getId();?>"><?php echo $afiliado->getNombres()." ".$afiliado->getApellidos()." ".$afiliado->getCelular();?></a>
								<br/>
								<?php
							}
						}
					}else{
						$this->msnCelular = "No se encontro ningun referido con ese numero celular";
						$this->formulario();
					}
				}
			}
		}
	}
	
	function formulario(){
		$msnPassword  = $this->msnPassword;
		$msnPassword2 = $this->msnPassword2;
		$msnUsuario   = $this->msnUsuario;
		$msnCelular   = $this->msnCelular;
		if($this->afiliado != null){
			$celular = $this->afiliado->getCelular();
		}
		if($this->usuario != null){
			$usuario  = $this->usuario->getUsuario();
			$password = $this->usuario->getPassword();
		}
		require "../../vista/usuario/registrar.php";
	}
	
	function validarRegistrar(){
		$validar = true;
		if(strlen($_REQUEST['usuario'])==0){
			$this->msnUsuario = "No se ingreso el usuario ";
			$validar &= false;
		}
		$this->usuario->setUsuario($_REQUEST['usuario']);
		
		if(strlen($_REQUEST['password'])==0){
			$this->msnPassword = "No se ingreso la contraseña ";
			$validar &= false;
		}
		$this->usuario->setPassword($_REQUEST['password']);
		
		if($_REQUEST['password']!=$_REQUEST['password2']){
			$this->msnPassword2 = "Las contraseñas no son iguales ";
			$validar &= false;
		}
		
		if(strlen($_REQUEST['celular'])<10){
			$this->msnCelular = "No ingreso numero de celular registrado";
			$validar &= false;
		}
		$this->afiliado->setCelular($_REQUEST['celular']);
		return $validar;
	}
}

$registrar = new Registrar();
$registrar->control();
?>
