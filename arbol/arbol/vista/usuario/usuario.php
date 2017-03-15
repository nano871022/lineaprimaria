<?php 
$msn = "";
$valor = unserialize($valor);
if(empty($valor)){
	$usuario  = new Usuarios();
}else{
	$msn = $valor[1];
	$usuario = $valor[0];
}
?>
<div>
	<form action="./principal.php?nav=usuario/usuario" method="post">
		<table>
			<tr>
				<td>Usuario</td>
				<td><?php echo $usuario->usuario; ?></td>
			</tr>
			<tr>
				<td>Anterior Contrase&ntilde;a</td>
				<td><input type="password" name="last"/> </td>
			
			</tr>
			<tr>
				<td>Nueva Contrase&ntilde;a</td>
				<td><input type="password" name="password"/></td>
			
			</tr>
			<tr>
				<td>Confirmar Contrase&ntilde;a</td>
				<td><input type="password" name="repetirPassword"/></td>
			
			</tr>
			<tr>
				<td colspan="2"><?php echo $msn; ?></td>
			</tr>
			</tr>
			<tr>
				<td colspan="2"><button>Cambiar</button></td>
			</tr>
		</table>
	</form>
</div>