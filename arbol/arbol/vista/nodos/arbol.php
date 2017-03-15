<?php
global $interacciones ;
$interacciones = 0;
global $permisos;
$permisos = unserialize($_SESSION['permisos']);
if ($valor != null) {
	$valor = unserialize ( $valor );
	function generarArbol($valor, $id, $pos) {
global $permisos;
global $interacciones;
	$interacciones++;
		foreach ( $valor as $value ) {
			
			if ($id == null || ($id != null && $id == $value->getId ())) {
				?>
<table border="0">
				<?php 
				if($value != null && $value->getOPadre () instanceof Afiliados){
					?>
<tr><th colspan="4">
<div class="referido">
					<a href="./principal.php?nav=afiliado/cambiar&id=<?php echo $value->getOPadre()->getId();?>" title="Celular : <?php echo $value->getOPadre()->getCelular();?>">
					<?php 
						echo $value->getOPadre ()->getNombres()." ".$value->getOPadre ()->getApellidos ();
					?>
					</a>
				</div>
	</th></tr>
	<tr>
		<td colspan="2" class="arbolLineRight " style="width:50%"></td>
		<td colspan="2" style="width:50%"></td>
	</tr>
					<?php
				}
				?>
	<tr>
		<th colspan="4">
			<div class="referido">
				<?php 
				if ($value != null && $value->getOAfiliado () instanceof Afiliados) {
					?>
					<table border="0" style="width: 100%">
					<tr>
						<td rowspan="2" class="arboltdHead">
					<a href="./principal.php?nav=afiliado/cambiar&id=<?php echo $value->getOAfiliado()->getId();?>" title="Celular : <?php echo $value->getOAfiliado()->getCelular();?>">
					<?php
					echo $value->getOAfiliado ()->getNombres () . " " . $value->getOAfiliado ()->getApellidos ();
					?></a>
					</td>
						<td>
						<?php 
					if (((!empty($permisos['EAD']) && $interacciones == 1 )||$permisos['ETA']) && $id != null && $id > 0 && !($value->getOReferido1() instanceof Grupo || $value->getOReferido2() instanceof Grupo)) {
						?>
							<form action="./principal.php?nav=afiliado/eliminargrupo" method="post">
								<input type="hidden" value="<?php echo $id;?>" name="id"/>
								<button class="btn-cerrar">X</button>
							</form>
							<?php } ?>
						</td>
						</tr><tr>
						<td>
						<?php
					if (((!empty($permisos['CAD']) &&  $interacciones == 1) || $permisos['CTA']) && $id != null && $id > 0 && ($value->getOReferido1() instanceof Grupo || $value->getOReferido2() instanceof Grupo)) {
						?>
							<form action="./principal.php?nav=afiliado/cambiarafiliado" method="post">
								<input type="hidden" value="<?php echo $id;?>" name="id"/>
								<button class="btn-change">Change</button>
							</form>
							<?php } ?>
						</td>
					</tr>
				</table>
					<?php
				}
				?>
			</div>
		</th>
	</tr>
<tr>
<td colspan="2" class="arbolLineRight">&nbsp;</td>
<td colspan="2">&nbsp;</td>
</tr>
	<tr>
		<td>&nbsp;</td>
		<td class="arbolLineLeft arbolLineUp"></td>
		<td class="arbolLineRight arbolLineUp"></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">
			<?php
				if ($value->oReferido1 instanceof Grupo) {
					$obj [] = $value->oReferido1 ;
					$id1 = "";
					$id1 = $value->getOReferido1 ()->getId ();
					generarArbol ( $obj, $id1, 1 );
				} else {
					?><div class="referidoEmpty">
<?php if((!empty($permisos['ARD']) && $interacciones == 1) || !empty($permisos['ATR'])){ ?>
				<form action="./principal.php?nav=afiliado/referido" method="post">
			<?php
					if ($id != null) {
						?>
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<?php
					}
					?>
			<button><font size="4"><b>+</b></font></button>
				</form>
<?php } ?>
			</div>
<?php
				}
				?>
</td>
		<td colspan="2">
<?php
				if ($value->oReferido2 instanceof Grupo) {
					$obj [] = $value->oReferido2 ;
					$id2 = "";
					$id2 = $value->getOReferido2 ()->getId ();
					generarArbol ( $obj, $id2, 2 );
				} else {
					?>
				<div class="referidoEmpty">
<?php		if((!empty($permisos['ARD']) && $interacciones == 1) || !empty($permisos['ATR'])){ ?>
				<form action="./principal.php?nav=afiliado/referido" method="post">
				<?php
					if ($id != null) {
						?>
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<?php
					}
					?>
			<button><font size="4"><b>+</b></font></button>
				</form>
<?php } ?>
			</div>
<?php
				}
				?>
			</td>
	</tr>
</table>
<?php
			}
			$interior ++;
		} // end foreach
	} // end function
	generarArbol ( $valor, "", 0 );
} // end if
?>
