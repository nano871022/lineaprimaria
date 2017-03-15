<?php 
$valor = unserialize($valor);
?>
<div>
	<table>
		<tr>
			<td>buscar</td>
			<td>
				<form action="./principal.php?nav=afiliado/cambiar" method="post">
					<input type="search" name="buscar" value="<?php echo $_SESSION['buscar'] ; ?>"/><button>Buscar</button><br/>
					<a href="./principal.php?nav=afiliado/cambiar&mv=0">atras</a> P&aacute;gina <?php echo 1+intval($_SESSION['page']);?> <a href="./principal.php?nav=afiliado/cambiar&mv=1">adelante</a>
				</form>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table>
					<tr>
						<th>Documento</th>
						<th>Nombres</th>
						<th>Celular</th>
						<th>Otros</th>
						<th></th>
					</tr>
					<?php 
					if(count($valor)>0){
						foreach ($valor as $afiliado) {?>
					<form action="./principal.php?nav=afiliado/cambiar"  method="post">
						<input type="hidden" name="id" value="<?php echo $afiliado->getId(); ?>"/>
						<tr>
							<td><?php echo $afiliado->getDocumento(); ?></td>
							<td><?php echo $afiliado->getNombres()." ".$afiliado->getApellidos(); ?></td>
							<td><?php echo $afiliado->getCelular(); ?></td>
							<td><?php echo $afiliado->getOtros(); ?></td>
							<td><button>Seleccionar</button></td>
						</tr>
					</form>
					<?php } }else{?>
						<tr>
						<td colspan="5">No se encontró Información</td>
						</tr>
						<?php } ?>
				</table>
			</td>
		</tr>
	</table>
</div>
