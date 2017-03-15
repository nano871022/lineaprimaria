<?php include "../controlador/conexion/conexion.php";

$link = (new Conexion())->connects();

if($_REQUEST['lleno']== 'S'){
	$result = $link->query($_REQUEST['sql']);
	if($result != null){
		echo "ejecucion exitosa";
	}else{
		echo $link->error;
	}
}

?>

<form action="./ejecutar.php?lleno=S" method="post">
<textarea name="sql"></textarea>
<button>Ejecutar</button>
</form>
