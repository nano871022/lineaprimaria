<?php
$valor  = unserialize ( $valor );
$grupos = $valor[0];
$msn    = $valor[1];
$permisos = unserialize($_SESSION['permisos']);
?>
<div>
<?php
if (is_array( $grupos ) ) {
	echo $msn;
	foreach ( $grupos as $grupo ) {
		?>
<form action="./principal.php?nav=usuario/grupos" method="post">
		<input type="hidden" name="id" value="<?php echo $grupo->getId(); ?>">
		<input type="hidden" name="afiliado"
			value="<?php echo $grupo->getAfiliado(); ?>">
		<table>
			<tr>
				<td>Fecha Ingreso</td>
				<td><input type="date" name="fechaIngreso"
					value="<?php echo $grupo->getFechaIngreso();?>"></td>
			</tr>
			<tr>
				<td>Fecha Primero</td>
				<td><input type="date" name="fechaPrimero"
					value="<?php echo $grupo->getFechaPrimero();?>"></td>
			</tr>
			<tr>
				<td>Fecha Segundo</td>
				<td><input type="date" name="fechaSegundo"
					value="<?php echo $grupo->getFechaSegundo();?>"></td>
			</tr>
			<tr>
				<td>Fecha Tercero</td>
				<td><input type="date" name="fechaTercero"
					value="<?php echo $grupo->getFechaTercero();?>"></td>
			</tr>
			<tr>
				<td>Numero Grupo</td>
				<td><input type="number" name="numeroGrupo" max="30" min="5"
					value="<?php echo $grupo->getNumeroGrupo();?>"></td>
			</tr>
			<tr>
				<td colspan="2"><button>Guadar</button></td>
			</tr>
		</table>
	</form>
	<?php } } if(!empty($permisos['AGR'])){?>
	<a href="./principal.php?nav=usuario/creargrupo">Asociar a un Grupo</a>
<?php } ?>
</div>
