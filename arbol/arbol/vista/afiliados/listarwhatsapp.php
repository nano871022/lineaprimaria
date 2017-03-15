<div>
	<table>
<?php  
setlocale(LC_TIME,"es_CO");
$valores = unserialize($valor);
$grupos = $valores[0];
$msn =    $valores[1];
foreach ( $grupos as $grupo){
?>
<form action="./principal.php?nav=afiliado/agregarwhatsappbean" method="post">
<tr>
<td><?php echo $grupo->getNombre(); ?></td>
<td><?php echo $grupo->getFecha(); ?></td>
<td><input type="hidden" name="id" value="<?php echo $grupo->getId();?>"/><button>Ver</button></td>
</tr>
</form>
<?php
}
?>
</table>
</div>
