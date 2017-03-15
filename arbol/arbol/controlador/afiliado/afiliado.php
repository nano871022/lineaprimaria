<?php session_start(); require "../conexion/session.php";require "../../dto/Afiliados.php";require "../../lib/utils/utils.php";
class Afiliado{
	var $afiliado;
	
	function control(){
			$this->afiliado = new Afiliados();
				
			$this->pantalla();
		}
	function pantalla(){
		
			require "../../vista/afiliado.php";
		}
}//end class
(new Afiliado())->control();	
?>
