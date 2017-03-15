<?php 
require_once '../../dto/Referidos.php';
require_once '../../dto/ReferidoWhatsapp.php';
class GrupoWhatsappPro{
	function procesar($id,$grupow){
		if($id == null){
			return;
		}
		$enlace = (new Conexion())->connect();
		$referido = new Referidos();
		$referido->setAfiliado($id);
		$query = $referido->select().$referido->where();
		$result = 	$enlace->query($query);
		if($result != null){
			while($row = $result->fetch_array()){
				$referido->setRow($row);
				$this->verificarGrupoW($enlace, $referido->getId(), $grupow);
				$this->procesar($referido->getReferido(),$grupow);
			}
		}
	}
	function verificarGrupoW($enlace,$id,$grupow){
		$rw = new ReferidoWhatsapp();
		$rw->setReferido($id);
		$query = $rw->select().$rw->where();
		$result = $enlace->query($query);
		$i = 0;
		if($result != null){
			while($row = $result->fetch_array()){
				$i++;
				$temp = new ReferidoWhatsapp();
				$temp->setRow($row);
				$temp->setWhatsapp($grupow);
				$query = $temp->update();
				$result2 = $enlace->query($query);//ejecucion y actualizacion del grupo
			}
		}
		if($i == 0){
			$rw->setWhatsapp($grupow);
			$query = $rw->insert(); 	
			$result = $enlace->query($query);
		}
	}
}

?>