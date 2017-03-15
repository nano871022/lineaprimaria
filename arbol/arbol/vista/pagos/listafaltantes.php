<div>
<table>
<?php
if ($valor != null) {
	$valor = unserialize ( $valor );
	$listas = $valor [0];
	$fechaGrupo = $valor [1];
	$whatsapp = $valor [2];
	$msn = $valor[3];
	$pago = $valor[4];
	$enumerar = 1;
	$permisos = unserialize($_SESSION['permisos']);
	if (count ( $listas ) > 0) {
		$fechaFin = date ( "Y-m-d", strtotime ( $fechaGrupo->anio . "-" . $fechaGrupo->mes . "-" . $fechaGrupo->numero ) );
		$fechaIni = strtotime ( "-5 day", strtotime ( $fechaFin ) );
		$fechaIni = date ( "d/m/Y", $fechaIni );
		$fechaFin = date ( "d/m/Y", strtotime ( $fechaFin ) );
		$pago = "Referidos Faltantes del Grupo *{Grupo}* de  *$fechaIni a $fechaFin* de las siguientes personas:\n";
		$whatsapp = "";
		?><tr><td colspan="4"><?php echo $msn; ?></td></tr>
			<tr>
		<td colspan="4">Referidos Faltantes del<b> Grupo 			
		<?php
		if (count ( $listas ) > 0) {
			if ($listas [0] != null) {
				$grupoWS = $listas [0]->getNombreWhatsapp () ;
				echo $grupoWS;
			}
				$pago = str_replace("{Grupo}", $grupoWS, $pago);
		}
		?>
		de <?php echo $fechaIni;?> a <?php echo $fechaFin;?></b> de las siguientes personsa:</td>
		</tr>
		<tr><th>#</th><th>Nombres y Apellidos</th><th>N&uacute;mero Celular</th><th>Faltantes</th></tr>
			<?php
		foreach ( $listas as $lista ) {
			if ($lista instanceof VAfiliadoGrupo) { 
				$pago .= $enumerar.". ". $lista->getNombreAfiliado()." ".$lista->getApellidoAfiliado()." numero celular ".$lista->getCelularAfiliado()." le hace falta ".($lista->getCantidad()==1?1:2)." referido(s)\n";		
			?>
			 <tr>
			     <td class="center"><?php echo $enumerar;?></td>
			     <td><?php echo $lista->getNombreAfiliado()." ".$lista->getApellidoAfiliado();?></td>
			     <td class="center"><?php echo $lista->getCelularAfiliado();?></td>
			     <td class="center"><?php echo $lista->getCantidad()==1?1:2;?></td>
			</tr>
			<?php
			 $enumerar ++;
			}
		} // end foreach
	} else {
		?>
 <font color="red">No se encontro informacion en listas </font>
<?php
	}
} else {
	?>
 <font color="red">No se encontro informacion </font>
<?php
}
?>
</table>
<textarea cols="10" rows="1"><?php echo $pago; ?></textarea>
</div>
