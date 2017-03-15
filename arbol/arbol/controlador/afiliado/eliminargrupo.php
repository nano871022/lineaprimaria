<?php require_once '../../lib/interface/bean/iBean.php';
$page = "";
class EliminarGrupo implements iBean{
	var $body;
	var $grupo;
	var $enlace;
	function control(){
		$this->enlace = (new Conexion())->connect();
		$this->grupo = new Grupo();
		$this->grupo->setId($_REQUEST['id']);
		if( $this->grupo->getId() != null && strlen( $this->grupo->getId() ) ){
			$referidos = new Referidos();
			$referidos->setAfiliado($this->grupo->getId());
			$sql = $referidos->cantidad().$referidos->where();
			$result = $this->enlace->query($sql);
			if($result != null){
				if($row = $result->fetch_array()){
					if($row['cont'] > 0){
						$this->body = "<font color='red'>El Afiliado tiene Referidos en su Arbol</font>";
						return;
					}
				}
			}
			
			$referidos = new Referidos();
			$referidos->setReferido($this->grupo->getId());
			$sql = $referidos->select().$referidos->where();
			$result = $this->enlace->query($sql);
			if($result != null){
				while($row = $result->fetch_array()){
					$referidos->setRow($row);
					$sql = $referidos->delete();
					$result2 = $this->enlace->query($sql);
					if($result2 == null){
						$this->body = "<font color='red'>No se puede Eliminar el Afiliado de su Arbol (Es Referido).</font>";
						return;
					}
				}
			}
			
			$sql = $this->grupo->delete();
			$result = $this->enlace->query($sql);
			if($result != null){
				$this->body = "<font color='green'>Se Elimin&oacute; el Afiliado de su arbol.</font>";
				$_REQUEST['id'] = null;
				unset($_REQUEST['id']);
			}else{
				$this->body = "<font color='red'>No se puede Eliminar el Afiliado de su Arbol (Referido Asociado).</font>";
			}
		}else{
			$this->body = "<font color='red'>No se puede Eliminar el Afiliado de su Arbol.</font>";
		}
	}
	function pantalla(){
		return "<div class='msnUnico'>".$this->body."</div>"; 
	}
}
$page = new EliminarGrupo();

?>