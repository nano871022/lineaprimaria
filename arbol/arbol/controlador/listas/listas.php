<?php
require_once '../../dto/WhatsappGrupos.php';
global $listasBean;
$ListasBean = null;
class ListasBean {
 var $listaMeses;
 var $listaIngresos;
 var $listaAnios;
 var $listaPagos;
 var $listaWhatsapp;
 function listaMeses(){ 
		if($this->listaMeses == null){
			$this->listaMeses = array();
			$this->listaMeses[1] = "Enero";
			$this->listaMeses[2] = "Febrero";
			$this->listaMeses[3] = "Marzo";
			$this->listaMeses[4] = "Abril";
			$this->listaMeses[5] = "Mayo";
			$this->listaMeses[6] = "Junio";
			$this->listaMeses[7] = "Julio";
			$this->listaMeses[8] = "Agosto";
			$this->listaMeses[9] = "Septiembre";
			$this->listaMeses[10]= "Octubre";
			$this->listaMeses[11]= "Noviembre";
			$this->listaMeses[12]= "Diciembre";
		}
	return $this->listaMeses;
	}
 function listaIngresos(){ 
		if($this->listaIngresos == null){
			$this->listaIngresos = array();
			$this->listaIngresos[5] = "5";
			$this->listaIngresos[10] = "10";
			$this->listaIngresos[15] = "15";
			$this->listaIngresos[20] = "20";
			$this->listaIngresos[25] = "25";
			$this->listaIngresos[30] = "30";
		}
	return $this->listaIngresos;
	}
 function listaAnios(){ 
		if($this->listaAnios == null){
			$this->listaAnios = array();
			$this->listaAnios[2016] = "2016";
			$this->listaAnios[2017] = "2017";
			$this->listaAnios[2018] = "2018";
		}
	return $this->listaAnios;
	}
 function listaPagos(){ 
		if($this->listaPagos == null){
			$this->listaPagos = array();
			$this->listaPagos[0] = "1er Pago";
			$this->listaPagos[1] = "1ra Devolucion";
			$this->listaPagos[2] = "2da Devolucion";
			$this->listaPagos[3] = "3ra Devolucion";
		}
	return $this->listaPagos;
	}
 function listaWhatsapp(){
		if($this->listaWhatsapp == null){
		       $wg = new WhatsappGrupos();
			$result = (new Conexion())->select($wg);
			$this->listaWhatsapp = $result;
		}
	return $this->listaWhatsapp;
	}
}
$listasBean = new ListasBean();
?>
