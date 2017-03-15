<?php
$valores = unserialize($valor);
$lista   = $valores[0];
$msn     = $valores[1];
$pagina  = $valores[2];
$paginas = $valores[3];
?>
<table>
<tr>
<th>Tabla</th>
<th>Campo</th>
<th>Valor Anterior</th>
<th>Nuevo Valor</th>
<th>Fecha Modificacion</th>
</tr>
<?php
if($lista != null){
foreach($lista as $modificacion){
 if($modificacion instanceof Modificaciones){
		?>
<tr>
<td><?php echo $modificacion->getTabla(); ?></td>
<td><?php echo $modificacion->getCampo(); ?></td>
<td><?php echo $modificacion->getAnterior(); ?></td>
<td><?php echo $modificacion->getNuevo(); ?></td>
<td align="center"><?php echo $modificacion->getFechaModificado(); ?></td>
</tr>
<?php
	}
}
}

?>
<tr><td colspan="5" align="center">
<a href="./principal.php?nav=usuario/modificaciones&pagina=<?php echo $pagina-1; ?>">Atras</a><?php echo ($pagina+1)."/".$paginas;?><a href="./principal.php?nav=usuario/modificaciones&pagina=<?php echo $pagina+1; ?>">Siguiente</a>
</td></tr>
</table>
