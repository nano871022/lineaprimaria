<?php

class Lista{
	var $destinos;
	var $origen;
	function setOrigen($in){
		$this->origen = $in;
	}
	function setDestino($in){
		$this->destinos = $in;
	}
		function getOrigen(){
		return $this->origen;
	}
	function getDestino(){
		return $this->destinos;
	}
}

?>
