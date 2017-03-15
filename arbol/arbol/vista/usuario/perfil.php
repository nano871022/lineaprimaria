<?php
$message = "";
$valor = unserialize ( $valor );
if (count ( $valor ) == 0) {
	if (! ($valor instanceof Afiliados)) {
		$valor = new Afiliados ();
	}
} else {
	$message = $valor[0];
	$valor = $valor [1];
}
?>
<div>
	<form action="./principal.php?nav=usuario/perfil" method="post">
		<table>
			<tbody>
				<tr>
					<td>nombre</td>
					<td><input name="nombre" type="text"
						value="<?php echo $valor->getNombres();?>" /></td>
				</tr>
				<tr>
					<td>apellido</td>
					<td><input name="apellido" type="text"
						value="<?php echo $valor->getApellidos();?>" /></td>
				</tr>
				<tr>
					<td>celular</td>
					<td><input name="celular" type="tel"
						value="<?php echo $valor->getCelular();?>" /></td>
				</tr>
				<tr>
					<td>numero documento</td>
					<td><input name="documento" type="text"
						value="<?php echo $valor->getDocumento();?>" /></td>
				</tr>
				<tr>
					<td>Otros</td>
					<td><input name="otros" type="tel"
						value="<?php echo $valor->getOtros();?>" /></td>
				</tr>
				<tr>
					<td colspan="2"><?php echo $message; ?></td>
				</tr>
				<tr>
					<td colspan="2"><button>guardar</button></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>