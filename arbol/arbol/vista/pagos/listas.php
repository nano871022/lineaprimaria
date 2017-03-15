<form action="./principal.php?nav=pagos/pagos" method="post">
	<table>
<?php
if ($valor != null) {
	$valor = unserialize ( $valor );
	$listas = $valor [0];
	$fechaGrupo = $valor [1];
	$whatsapp = $valor [2];
	$msn = $valor[3];
	$pago = $valor[4];
	$pagoT = "";
	switch($pago){
	case 0: $pagoT = "Pago";break;
	case 1: $pagoT = "Devolucion 1";break;
	case 2: $pagoT = "Devolucion 2";break;
	case 3: $pagoT = "Devolucion 3";break;
	}
	$permisos = unserialize($_SESSION['permisos']);
	if (count ( $listas ) > 0) {
		$fechaFin = date ( "Y-m-d", strtotime ( $fechaGrupo->anio . "-" . $fechaGrupo->mes . "-" . $fechaGrupo->numero ) );
		$fechaIni = strtotime ( "-5 day", strtotime ( $fechaFin ) );
		$fechaIni = date ( "d/m/Y", $fechaIni );
		$fechaFin = date ( "d/m/Y", strtotime ( $fechaFin ) );
		$pago = "Grupo *{Grupo}* de  *$fechaIni a $fechaFin*";
		$whatsapp = "";
		?><tr><td colspan="5"><?php echo $msn; ?></td></tr>
			<tr>
			<td colspan="2"><b> Grupo 			
		<?php
		if (count ( $listas ) > 0) {
			if ($listas [0]->getOrigen () != null) {
				$whatsapp = empty ( $listas [0]->getOrigen ()->getOAfiliado ()->getOWhatsapp () ) ? "" : $listas [0]->getOrigen ()->getOAfiliado ()->getOWhatsapp ()->id;
				$grupoWS = empty ( $listas [0]->getOrigen ()->getOAfiliado ()->getOWhatsapp () ) ? "" : $listas [0]->getOrigen ()->getOAfiliado ()->getOWhatsapp ()->nombre ;
				echo $grupoWS;
			}
				$pago = str_replace("{Grupo}", $grupoWS, $pago)." ".$pagoT;
		}
		?>
		de <?php echo $fechaIni;?> a <?php echo $fechaFin;?></b></td>
			<td><input type="hidden" name="grupo"
				value="<?php echo $fechaGrupo->numero; ?>" /> <input type="hidden"
				name="mes" value="<?php echo $fechaGrupo->mes; ?>" /> <input
				type="hidden" name="anio" value="<?php echo $fechaGrupo->anio; ?>" />
				<input type="hidden" name="whatsapp" value="<?php echo $whatsapp;?>" />
				<input type="hidden" name="pago" value="<?php echo $pago;?>" />
				<?php echo $pagoT; ?>
			</td>
			<td colspan="2">
				<button>Actualizar Pagos</button>
			</td>
		</tr>
			<?php
		foreach ( $listas as $lista ) {
			if ($lista instanceof Lista) {
				if ($lista->getOrigen () instanceof Grupo) {
					$pago = $pago . "\n\r A *" . trim ( $lista->getOrigen ()->getOAfiliado ()->getNombres () . " " . $lista->getOrigen ()->getOAfiliado ()->getApellidos () ) . "* con numero telefono *" . trim ( $lista->getOrigen ()->getOAfiliado ()->getCelular () ) . "* le deben consignar las siguientes personas:";
					?><tr>
			<th colspan="3">
				<div>
					A <b><font color="green"><?php echo trim($lista->getOrigen()->getOAfiliado()->getNombres()." ".$lista->getOrigen()->getOAfiliado()->getApellidos());?> </font></b>
					con numero telefono <b><font color="green"><?php echo $lista->getOrigen()->getOAfiliado()->getCelular();?></font></b>
					le deben consignar las siguientes personas:
				</div>
			</th>
			<th>Entrega</th>
			<th>Recibe</th>
		</tr>
					<?php
				}
				if (count ( $lista->getDestino () ) > 0) {
					$enumerar = 1;
					foreach ( $lista->getDestino () as $grupo ) {
						if ($grupo != null) {
							if ($grupo instanceof Afiliados) {
								$pago = $pago . "\n\r" . " $enumerar. *" . trim ( $grupo->getNombres () . " " . $grupo->getApellidos ()) . "* celular  *" . $grupo->getCelular ()  . "* ";
								if ($grupo->getOPago () != null) {
									if ($grupo->getOPago ()->paga == "S" || $grupo->getOPago()->recibe == "S") {
										$putT = $grupo->getOPago()->recibe == "S";
										$pago .=  ($putT?"~":"")."*PAGO*".($putT?"~":"");
									}
								}
								?>
						<tr>
			<th>
			<?php echo $enumerar; ?>
		</th>
			<td><b>
						<?php echo $grupo->getNombres () . " " . $grupo->getApellidos () ; ?>
						</b></td>
			<td>
						<?php echo $grupo->getCelular (); ?>
						</td>
			<td> <input type="checkbox" name="entrega[]"  <?php echo empty($permisos['APR'])?"disabled":"";?>
				value="<?php echo $grupo->getOPago()->getId(); ?>"
				<?php echo $grupo->getOPago()->paga=='S'?"checked disabled":""; ?> /></td>
			<td><input type="checkbox" name="recibe[]" <?php echo empty($permisos['APR'])?"disabled":"";?>
				value="<?php echo $grupo->getOPago()->getId(); ?>"
				<?php echo $grupo->getOPago()->recibe=='S'?"checked disabled":""; ?> /></td>
		</tr>
					<?php
								$enumerar ++;
							}
						}
					} // end foreach
				}
			}
		}
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
</form>
<textarea cols="10" rows="1"><?php echo $pago; ?></textarea>
