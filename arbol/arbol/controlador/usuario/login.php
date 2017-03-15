<?php session_start(); 
require_once "../../lib/utils/utils.php";
include_once '../../lib/interface/bean/iBean.php';
require_once "../conexion/conexion.php"; 
require_once "../../dto/Afiliados.php";
require_once "../../dto/Usuarios.php"; 
require_once "../../dto/Login.php"; 

$id = $_SESSION['idAfiliado'];
global $page;
$page = null;
class Login implements iBean{
	var $msnPassword;
	var $msnPassword2;
	var $msnCelular;
	var $msnUsuario;
	var $usuario;
	var $afiliado;
	function control(){
		$valor = $_REQUEST;
		if($_SESSION['idAfiliado'] != null){
			?>
				 <meta http-equiv="Refresh" content="1;url=../principal/principal.php" />
				 Redireccionado...
				<?php
			return;
		} else 
		    if(count($valor)>0){
			   if(strlen($_REQUEST['usuario'])>0 && strlen($_REQUEST['password'])>0){
				  $this->loged();
				  return;
			    }
			 }
	}

	function loged(){
	    $enlace = (new Conexion())->connect();
	    $this->usuario = new Usuarios();
	    $this->usuario->setUsuario($_REQUEST['usuario']);
	    $this->usuario->setPassword($_REQUEST['password']);
	    $sql = $this->usuario->login();
	    $result = $enlace->query($sql);
	    if($result != null){
			if($row = $result->fetch_array()){
				$this->usuario->setRow($row);
				$login = new LogIn2();
				$login->setUsuario($this->usuario->getUsuario());
				$enlace->insert($login);
				$_SESSION['idSession'] = $enlace->insert_id;
				$_SESSION['idAfiliado'] = $this->usuario->getAfiliado();
				?>
				 <meta http-equiv="Refresh" content="1;url=../principal/principal.php" />
				 Redireccionado...
				<?php
			}else{
				$this->msnPassword = "Contraseña Incorrecta";
				$this->msnUsuario = "Usuario Incorrecto";
				$this->loging();
				$this->incrementoIntentos();		
			}
		}else{
			$this->msnPassword = "Contraseña Incorrecta";
			$this->msnUsuario = "Usuario Incorrecto";
			$this->loging();
		}
	}
	function incrementoIntentos(){
	    $enlace = (new Conexion())->connect();
		if(!empty($this->usuario->getUsuario())){
		$temp = new Usuarios();
		$temp->setUsuario($this->usuario->getUsuario());
		$query = $temp->select().$temp->where();
		$result = $enlace->query($query);
		if($result != null){
			if($row = $result->fetch_array()){
				$temp->setRow($row);
				$temp->setNumeroIntentos($temp->getNumeroIntentos()+1);
				echo $this->msnUsuario = "Usuario bloqueado hasta ".$temp->getFechaDesbloqueo();
				$query = $temp->update();
				$result = $enlace->query($query);
			}
		}}
	}
	function pantalla(){
		if($this->usuario != null){
			$ususario    = $this->usuario->getUsuario();
			$password    = $this->usuario->getPassword();
			$msnPassword = $this->msnPassword;
			$msnUsuario  = $this->msnUsuario;
		}
		return requireAVariable ( "../../vista/usuario/login.php", $body );
		
	}
}///end class
$page = new Login();
$login = new Login();
$login->control();
if(strrpos($_SERVER['REQUEST_URI'],'externo') === false){
echo $login->pantalla();
header('Location: ../externo/principal.php?nav=usuario/login');
}
?>
