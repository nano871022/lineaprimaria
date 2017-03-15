<div>
<?php
$valores = unserialize($valor);
$grupos = $valores[0];
$whatsapps = $valores[1];
$msn = $valores[2];
$permisos = unserialize($_SESSION['permisos']);
?>
<table>
<?php foreach($grupos as $grupo){ ?>
<?php if(!empty($permisos['MWR'])){ ?>
<form action="./principal.php?nav=afiliado/asociarwhatsappbean" method="post">
<?php } ?>
<tr>
<td><label for="whatsapp">Grupo Whatsapp</label></td>
<td><select name="whatsapp" id="whatsapp">
	<option>Seleccione</option>
	<?php	foreach($whatsapps as $whatsapp){ ?>
	  <option value="<?php echo $whatsapp->getId(); ?>" <?php echo ($grupo->getWhatsapp() == $whatsapp->getId() ? "selected ":""); ?>><?php echo $whatsapp->getNombre(); ?></option>
	<?php } ?>
</select></td>
<td><label for="agregado">Agregado a Whatsapp</label></td>
<td><input type="checkbox" name="agregado" id="agregado" <?php echo $grupo->getAgregado() == "S" ? "checked" : "";?> /></td>
<td><input type="hidden" name="referido" value="<?php echo $grupo->getReferido(); ?>"/><input type="hidden" name="id" value="<?php echo $grupo->getId(); ?>"/><button>Actualizar</button></td>
<td style="display:<?php echo $grupo->getWhatsapp()!=null?"block":"none";?>" >
<?php if(!empty($permisos['MGE'])){ ?>
<a href="./principal.php?nav=afiliado/asociarwhatsappbean&id2=<?php echo $grupo->getReferido(); ?>&grupo2=<?php echo $grupo->getWhatsapp()?>">Modificar Grupo Referidos</a>
<?php } ?>
</td>
</tr>
<?php if(!empty($permisos['MWR'])){ ?>
</form>
<?php } ?>
<?php } ?>
<tr ><td colspan="5"><?php echo $msn; ?></td></tr>
</table>
</div>
