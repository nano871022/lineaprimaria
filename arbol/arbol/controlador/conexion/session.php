<?php 
$id = $_SESSION['idAfiliado'];
if($id == null){
	?>
 <meta http-equiv="Refresh" content="1;url=../usuario/login.php" />
 Redireccionando...
<?php
}
?>
