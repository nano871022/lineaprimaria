<div>
<script>
function accion(){
document.getElementById("accion").value = "eliminar";
}
</script>
<form action="./principal.php?nav=nuevos/listanuevos" method="post">
<?php
$valores 	  = unserialize($valor);
$listas 	  = $valores[0];
$msn 		  = $valores[1];
$page 		  = $valores[2];
$cant		  = $valores[3];
$nombreWhatsapp   = $valores[4];
$agregadoWhatsapp = $valores[5];
$buscar 	  = "";
if(count($listas)>0){
  $buscar = $listas[0]->getBuscar();
}
echo $msn;
?>
<table>
<tr>
<td colspan="1"><label for="buscar">Buscar</label></td>
<td colspan="2"><input type="text" name="buscar" id="buscar" value="<?php echo $buscar; ?>" placeholder="Ingrese nombre o apellido o celular o fecha"/></td>
<td colspan="2"><input type="text" name="nombreWhatsapp"  value="<?php echo $nombreWhatsapp; ?>" placeholder="Ingrese nombre del Grupo de Whatsapp"/></td>
<td colspan="1"><label>Agregado <input type="checkbox" name="agregadoWhatsapp" value="S" <?php echo !empty($agregadoWhatsapp)?"checked":""; ?> title="Registro Agregado A Whatsapp"/></label></td>
</tr>
<tr><td colspan="6" align="center">
<button>Buscar</button>
<button>Generar VCard</button>
<button>Actualizar</button>
</td>
</tr>
<tr>
<td colspan="2"><a href="./principal.php?nav=nuevos/listanuevos&page=<?php echo $page>0?$page-1:0;?>&buscar=<?php echo $buscar; ?>&nombreWhatsapp=<?php echo $nombreWhatsapp;?>&agregadoWhatsapp=<?php echo $agregadoWhatsapp;?>">atras</a></td>
<td colspan="2"><?php echo $page+1; ?>/<?php echo $cant; ?></td>
<td colspan="2"><a href="./principal.php?nav=nuevos/listanuevos&page=<?php echo $page+1;?>&buscar=<?php echo $buscar; ?>&nombreWhatsapp=<?php echo $nombreWhatsapp;?>&agregadoWhatsapp=<?php echo $agregadoWhatsapp;?>">siguiente</a></td>
</tr>
<tr>
<th>Gen VCard</th><th>Agregar Whatsapp</th><th>Nombres Y Apellidos</th><th>Celular</th><th>Fecha Ingreso</th><th>Fecha Agrego Whatsapp</th><th>Grupo Whatsapp</th>
</tr>
<?php
foreach($listas as $lista){
if($lista instanceof NuevosAgregados){
?>
<tr>
<th><input type="checkbox" name="seleccionar[]" value="<?php echo $lista->getId(); ?>"/></th>
<th><input type="checkbox" name="whatsapp[]" value="<?php echo $lista->getId(); ?>" <?php echo $lista->getWhatsapp()=="S"?"checked disabled":"";?>/></th>
<td>
<a href="./principal.php?nav=afiliado/cambiar&id=<?php echo $lista->getAfiliado();?>">
<?php echo $lista->getNombres()." ".$lista->getApellidos();?>
</a>
</td>
<td><?php echo $lista->getCelular();?></td>
<td><?php echo $lista->getFecha();?></td>
<td align="center"><?php echo $lista->getFechaWhatsapp();?></td>
<td><?php echo $lista->getNombreWhatsapp();?></td>
</tr>
<?php
}
}
?>
</table>
</form>
</div>
