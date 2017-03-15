<?php
session_start ();

require "../conexion/conexion.php";
require "../conexion/session.php";
require "../../dto/Afiliados.php";
require "../../dto/Grupo.php";
require "../../dto/Permisos.php";
require "../../dto/Roles.php";
require "../../dto/Usuarios.php";
require "../../dto/Referidos.php";
require "../../dto/ReferidoWhatsapp.php";
require "../../dto/WhatsappGrupos.php";
require "../../dto/vPaginasRol.php";
require "../../dto/vPermisosRoles.php";
require "../../dto/Login.php";
require "../../lib/utils/utils.php";
require "../../controlador/listas/listas.php";
global $page;
class Principal {
	var $afiliado;
	var $grupo;
	var $usuario;
	var $permisos;
	var $rol;
	var $enlace;
	var $body;
	var $head;
	var $menu;
        var $menuNav;
	function control() {
		$this->enlace = (new Conexion ())->connect ();
		$this->loadInfo ();
		$end = $_REQUEST ['end'];
		$navegar = $_REQUEST ['nav'];
		if ($end != null && $end == 1) {
			$login = new LogIn2();
			$login->setId($_SESSION['idSession']);
			if($login->getId() == null){
				$login->setUsuario($this->usuario->getUsuario());
			}
			$this->enlace->update($login);
			$_SESSION ['idSession'] = null;
			$_SESSION ['idAfiliado'] = null;
			$_SESSION ['afiliado'] = null;
			$_SESSION ['grupo'] = null;
			$_SESSION ['usuario'] = null;
			$_SESSION ['permisos'] = null;
			$_SESSION ['rol'] = null;
			$_SESSION ['menu'] = null;
			unset ( $_SESSION ['idAfiliado'] );
			unset ( $_SESSION ['idSession'] );
			unset ( $_SESSION ['afiliado'] );
			unset ( $_SESSION ['grupo'] );
			unset ( $_SESSION ['usuario'] );
			unset ( $_SESSION ['permisos'] );
			unset ( $_SESSION ['rol'] );
			unset ( $_SESSION ['menu'] );
			require "../conexion/session.php";
			return;
		} else if ($navegar != null) {
			require "../" . $navegar . ".php";
			if ($page != null) {
				if ($page instanceof iBean) {
					$page->control ();
					$this->body = $page->pantalla ();
				}
			}
		}
		
		$this->head = $this->headLoad ();
		$this->pantalla ();
	}
	function headLoad() {
		$vari = "";
		if ($this->grupo != null) {
			$n = count ( $this->grupo );
			if ($this->grupo [0] instanceof Grupo) {
				if ($this->grupo [0]->getOAfiliado () != null) {
					if ($this->grupo [0]->getOAfiliado () instanceof Afiliados) {
						$vari = $vari . "Bienvenido " . $this->grupo [0]->getOAfiliado ()->nombres . " " . $this->grupo [0]->getOAfiliado ()->apellidos ." (Cel:".$this->grupo[0]->getOAfiliado()->celular.")"."(Rol:".$this->rol->getNombre().")"."<br/>";
					}
				}
			}
			$vari = $vari . "Esta en los Grupos ";
			for($i = 0; $i < $n; $i ++) {
				if ($this->grupo [$i] instanceof Grupo) {
					$vari = $vari . "(" . ($this->grupo[$i]->getOAfiliado()->getOWhatsapp() instanceof WhatsappGrupos ?$this->grupo [$i]->getOAfiliado ()->getOWhatsapp()-> getNombre():$this->grupo[$i]->getNumeroGrupo()). " del " . $this->grupo [$i]->getFechaIngreso () . ")";
				}
			}
		}
		return $vari;
	}
	function navegacion() {
		if(empty($this->menuNav)){
		$lista = array ();
		$vpr = new VPaginasRol();
		$vpr->setRol($this->rol->getId());
		$query = $vpr->select().$vpr->where();
		$result = $this->enlace->query($query);
		if($result != null){
			while($row = $result->fetch_array()){
				$vpr->setRow($row);
				$lista[$vpr->getNombrePagina()] = $vpr->getCarpeta()."/".$vpr->getArchivo();		
			}
		}
		 if(count($lista)>0){
			$this->menuNav = $lista;
			$_SESSION['menu'] = serialize($this->menuNav);
			}
		}
		return $this->menuNav;
	}
	function loadInfo() {
		$this->loadSession ( "afiliado" );
		$this->loadAfiliado ();
		$this->loadSession ( "grupo" );
		$this->loadGrupo ();
		$this->loadSession ( "usuario" );
		$this->loadUsuario ();
		$this->loadSession ( "rol" );
		$this->loadRol ();
		$this->loadSession ( "permisos" );
		$this->loadPermisos ();
		$this->loadReferidos ();
		$this->loadSession ( "menu" );
		$this->loadSessions ();
	}
	function loadSession($var) {
		if ($_SESSION [$var] != null) {
			$vari = $_SESSION [$var];
			switch ($var) {
				case "afiliado" :
					$this->afiliado = unserialize ( $_SESSION [$var] );
					break;
				case "grupo" :
					$this->grupo = unserialize ( $_SESSION [$var] );
					break;
				case "usuario" :
					$this->usuario = unserialize ( $_SESSION [$var] );
					break;
				case "permisos" :
					$this->permisos = unserialize ( $_SESSION [$var] );
					break;
				case "rol" :
					$this->rol = unserialize ( $_SESSION [$var] );
					break;
				case "menu" :
					$this->menuNav= unserialize ( $_SESSION [$var] );
					break;
			}
		}
	}
	function loadSessions() {
		$_SESSION ['afiliado'] = serialize ( $this->afiliado );
		$_SESSION ['grupo'] = serialize ( $this->grupo );
		$_SESSION ['usuario'] = serialize ( $this->usuario );
		$_SESSION ['permisos'] = serialize ( $this->permisos );
		$_SESSION ['rol'] = serialize ( $this->rol );
		$_SESSION ['menu'] = serialize ( $this->menuNav );
	}
	function loadAfiliado() {
		if ($this->afiliado == null) {
			$this->afiliado = new Afiliados ();
			$this->afiliado->setId ( $_SESSION ['idAfiliado'] );
			if ($this->afiliado->getId () != null) {
				$sql = $this->afiliado->select () . $this->afiliado->where ();
				$result = $this->enlace->query ( $sql );
				if ($row = $result->fetch_array ()) {
					$this->afiliado->setRow ( $row );
				}
			}
		}
	}
	function loadUsuario() {
		if ($this->usuario == null) {
			$this->usuario = new Usuarios ();
			$this->usuario->setAfiliado ( $this->afiliado->getId () );
			$sql = $this->usuario->select () . $this->usuario->where ();
			$result = $this->enlace->query ( $sql );
			if ($result != null) {
				if ($row = $result->fetch_array ()) {
					$this->usuario->setRow ( $row );
				}
			}
		}
	}
	function loadPermisos() {
		if ($this->permisos == null) {
			$this->permisos = array ();
			$per = new VPermisosRoles ();
			$per->setRol ( $this->rol->getId () );
			$sql = $per->select () . $per->where ();
			$result = $this->enlace->query ( $sql );
			if ($result != null) {
				while ( $row = $result->fetch_array () ) {
					$per->setRow ( $row );
					$this->permisos [$per->getReferencia()] = $per->getNombrePermiso();
				}
			}
		}
	}
	function loadRol() {
		if ($this->rol == null) {
			$this->rol = new Roles ();
			$this->rol->setId ( $this->usuario->getRol () );
			$sql = $this->rol->select () . $this->rol->where ();
			$result = $this->enlace->query ( $sql );
			if ($result != null) {
				if ($row = $result->fetch_array()) {
					$this->rol->setRow ( $row );
				}
			}
		}
	}
	function loadGrupo() {
		if ($this->grupo == null) {
			$this->grupo = new Grupo ();
			$this->grupo->setAfiliado ( $this->afiliado->getId () );
			$sql = $this->grupo->select () . $this->grupo->where ();
			$result = $this->enlace->query ( $sql );
			$grupo = array ();
			if ($result != null) {
				while ( $row = $result->fetch_array () ) {
					$temp = new Grupo ();
					$temp->setRow ( $row );
					$copiAfiliado = $this->afiliado;
					$copiAfiliado->setOWhatsapp($this->loadGrupoWhatsapp($temp->getId()));
					$temp->setOAfiliado ( $copiAfiliado );
					$temp->setOPadre ( $this->loadPadre ( $temp->getId () ) );
					$grupo [] = $temp;
				}
			}
			if (count ( $grupo ) > 0) {
				$this->grupo = $grupo;
			}
		}
	}
	function loadGrupoWhatsapp($id){
		$ref = new Referidos();
		$ref->setReferido($id);
		$query = $ref->select().$ref->where();
		$result = $this->enlace->query($query);
		if($result != null){
			while($row = $result->fetch_array()){
				$ref->setRow($row);
				$rw = new ReferidoWhatsapp();
				$rw->setReferido($ref->getId());
				$query = $rw->select().$rw->where();
				$result2 = $this->enlace->query($query);
				if($result2 != null){
					while($row2 = $result2->fetch_array()){
						$rw->setRow($row2);
						$wg = new WhatsappGrupos();
						$wg->setId($rw->getWhatsapp());
						$query = $wg->select().$wg->where();
						$result3 = $this->enlace->query($query);
						if($result3 != null){
							if($row3 = $result3->fetch_array()){
								$wg->setRow($row3);
								return $wg;
							}
						}
					}
				}
			}
		}			
		return null;	
	}
	function loadPadre($id) {
		$referido = new Referidos ();
		$referido->setReferido ( $id );
		$query = $referido->select () . $referido->where ();
		$result = $this->enlace->query ( $query );
		if ($result != null) {
			if ($row = $result->fetch_array ()) {
				$referido->setRow ( $row );
				$grupo = new Grupo ();
				$grupo->setId ( $referido->getAfiliado () );
				$query = $grupo->select () . $grupo->where ();
				$result = $this->enlace->query ( $query );
				if ($result != null) {
					if ($row = $result->fetch_array ()) {
						$grupo->setRow ( $row );
						$afiliado = new Afiliados ();
						$afiliado->setId ( $grupo->getAfiliado () );
						$query = $afiliado->select () . $afiliado->where ();
						$result = $this->enlace->query ( $query );
						if ($result != null) {
							if ($row = $result->fetch_Array ()) {
								$afiliado->setRow($row);
								return $afiliado;
							}
						}
					}
				}
			}
		}
		return null;
	}
	function loadReferidos() {
		if ($this->grupo instanceof Grupo) {
			$temp = $this->grupo;
			$this->grupo = array ();
			$this->grupo [] = $this->grupo;
		}
		
		if ($this->grupo != null) {
			$n = count ( $this->grupo );
			for($i = 0; $i < $n; $i ++) {
				$ref = new Referidos ();
				$ref->setAfiliado ( $this->grupo [$i]->id );
				$sql = $ref->select () . $ref->where ();
				$result = $this->enlace->query ( $sql );
				if ($result != null) {
					$int = 0;
					while ( $row = $result->fetch_array () ) {
						if ($int == 0) {
							$grupo2 = ($this->grupo [$i]);
							$grupo2->setOReferido1 ( $this->obtenerReferido ( $row ) );
						}
						if ($int == 1) {
							$grupo2 = ($this->grupo [$i]);
							$grupo2->setOReferido2 ( $this->obtenerReferido ( $row ) );
						}
						$int ++;
					}
				}
			} // end for
		}
	}
	function obtenerReferido($row) {
		$referido = new Referidos ();
		$referido->setRow ( $row );
		$grupo = new Grupo ();
		$grupo->setId ( $referido->getReferido () );
		$sql = $grupo->select () . $grupo->where ();
		$result = $this->enlace->query ( $sql );
		if ($result != null) {
			if ($row = $result->fetch_Array ()) {
				$grupo->setRow ( $row );
				$afiliado = new Afiliados ();
				$afiliado->setId ( $grupo->getAfiliado () );
				$sql = $afiliado->select () . $afiliado->where ();
				$result = $this->enlace->query ( $sql );
				if ($result != null) {
					if ($row = $result->fetch_array ()) {
						$afiliado->setRow ( $row );
						$grupo->setOAfiliado ( $afiliado );
						$referido2 = new Referidos ();
						$referido2->setAfiliado ( $grupo->getId () );
						$sql = $referido2->select () . $referido2->where ();
						$result = $this->enlace->query ( $sql );
						if ($result != null) {
							$int = 0;
							while ( $row = $result->fetch_array () ) {
								if ($int == 0) {
									$grupo->setOReferido1 ( $this->obtenerReferido ( $row ) );
								}
								if ($int == 1) {
									$grupo->setOReferido2 ( $this->obtenerReferido ( $row ) );
								}
								$int ++;
							} // edn while
						}
						return $grupo;
					}
				}
			}
		}
		return null;
	}
	function pantalla() {
		$head = $this->head;
		$body = $this->body;
		$menu = serialize ( $this->navegacion () );
		require "../../vista/principal/principal.php";
	}
}
(new Principal ())->control ();
?>
