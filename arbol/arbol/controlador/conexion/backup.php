<?php 
require_once './conexion.php';
require_once '../../dto/Referidos.php';
$link = (new Conexion())->connect();
$a = new Referidos(); 
//"select nre_llave,nre_afiliado,nre_referido,dre_fecha from Referidos"
$result = $link->query($a->select());
if($result != null){
	while ( $row = $result->fetch_array() ){
		$a->setRow($row);
		echo $a->insert2().";<br/>"; 
	}
}
?>
