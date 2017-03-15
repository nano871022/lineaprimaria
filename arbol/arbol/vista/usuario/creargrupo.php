<div>
	<form action="./principal.php?nav=usuario/creargrupo" method="post">
		<table>
			<tr>
				<td>Fecha Ingreso</td>
				<td><input type="date" name="fechaIngreso" /></td>
			</tr>
			<tr>
				<td>Fecha Primero</td>
				<td><input type="date" name="fechaPrimero" /></td>
			</tr>
			<tr>
				<td>Fecha Segundo</td>
				<td><input type="date" name="fechaSegundo" /></td>
			</tr>
			<tr>
				<td>Fecha Tercero</td>
				<td><input type="date" name="fechaTercero" /></td>
			</tr>
			<tr>
				<td>Numero Grupo</td>
				<td><input type="number" name="numeroGrupo" step="5" max="30"
					min="5" ></td>
			</tr>
			<tr>
				<td colspan="2"><button>Guadar</button></td>
			</tr>
		</table>
		<?php $valor = unserialize($valor);
			echo $valor[1];
		?>
	</form>
</div>