<form action="./principal.php?nav=pagos/faltantes" method="post">
	<?php
	global $listasBean;
	setlocale ( LC_TIME, "es_CO" );
	$valores = unserialize ( $valor );
	$valores = $valores [2];
	?>
	<table>
		<tr>
			<td><label title="Grupo de Ingreso (5,10,15,20,25,30)" for="grupo">Grupo</label></td>
			<td><select name="grupo" id="grupo">
				 	<option value="">Seleccionar</option>
			<?php
			foreach($listasBean->listaIngresos() as $key => $valor) {
				?>
					<option value="<?php echo $key; ?>"><?php echo $valor; ?></option>
			<?php
			}
			?>
			</select></td>
			<td><label for="mes">Mes</label></td>
			<td><select name="mes" id="mes">
				 	<option value="">Seleccionar</option>
			<?php
			foreach ( $listasBean->listaMeses() as $key => $valor){
				?>
					<option value="<?php echo $key; ?>"><?php echo $valor; ?></option>
			<?php
			}
			?>
			</select></td>
			<td><label for="anio">A&ntilde;o</label></td>
			<td><select name="anio" id="anio">
				 	<option value="">Seleccionar</option>
			<?php foreach($listasBean->listaAnios() as $key => $valor){	?>
			 	<option value="<?php echo $key; ?>"><?php echo $valor; ?></option>
		 	<?php } ?>
			</select></td>
		</tr><tr>
			<td><label for="whatsapp" title="Grupo de Whatsapp que se desea generar la lista">Whatsapp</label></td>
			<td colspan="5"><select name="whatsapp" id="whatsapp">
				 	<option value="">Seleccionar</option>
				<?php 
				 foreach ($valores as $value){
				 	?>
				 	<option value="<?php echo $value->getId(); ?>"><?php echo $value->getNombre(); ?></option>
				 	<?php 
				 }
				?>
			</select></td>
		</tr><tr>
			<td><a href="./principal.php">Regresar</a></td>
			<td colspan="5">
				<button>Buscar</button>
			</td>
		</tr>
	</table>
</form>
