<?php

class NGrupo {
		var $mes;
		var $anio;
		var $numero;
                var $whatsapp;
function setWhatsapp($in){
$this->whatsapp = $in;
}
function getWhatsapp(){
return $this->whatsapp;
}
		function setAnio($in){
		$this->anio = $in;
	}
	function setMes($in){
		$this->mes= $in;
	}
	function setNumero($in){
		$this->numero = $in;
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
?>
