<?php $valores = unserialize($valor);
$numerarPersonas= 0;
$pagarA = $valores[0];
$recibeDe = $valores[2];
$pagosAIn = $valores[1];
$pagosA = array();
$pagosDe = $valores[3];
$afiliado= $valores[4];
if( gettype($pagosAIn) == "object"){
$pagosA[] = $pagosAIn;
}else if(gettype($pagosAIn) == "array"){
$pagosA = $pagosAIn;
$cantidadPagosRecibidos = 0;
$cantidadPagosAceptados = 0;
$recibeWhatsapp = "";
}
if($afiliado instanceof Afiliados){
	$recibeWhatsapp .= "A *".trim($afiliado->getNombres()." ".$afiliado->getApellidos())."* con n&uacute;mero celular ".$afiliado->getCelular()." le deben consignar las siguientes personas: \n";
}
?>
<div><form method="post" action="./principal.php?nav=pagos/estados">
<script>
function onclick1(){
	document.getElementById("recibir").classList.remove("tabNow");
	document.getElementById("recibir").classList.add("tab");
	document.getElementById("pagar").classList.remove("tab");
	document.getElementById("pagar").classList.add("tabNow");
	document.getElementById("recibirBody").classList.remove("tabBodyNow");
	document.getElementById("recibirBody").classList.add("tabBody2");
	document.getElementById("pagarBody").classList.remove("tabBody2");
	document.getElementById("pagarBody").classList.add("tabBodyNow");
}
function onclick2(){
	document.getElementById("pagar").classList.remove("tabNow");
	document.getElementById("pagar").classList.add("tab");
	document.getElementById("recibir").classList.remove("tab");
	document.getElementById("recibir").classList.add("tabNow");
	document.getElementById("pagarBody").classList.remove("tabBodyNow");
	document.getElementById("pagarBody").classList.add("tabBody2");
	document.getElementById("recibirBody").classList.remove("tabBody2");
	document.getElementById("recibirBody").classList.add("tabBodyNow");
}
</script>
<div>
<div class="tabs tabNow" id="pagar" onclick="onclick1()">Pagar A</div>
<div class="tabs tab"  id="recibir" onclick="onclick2()">Recibir De</div>
<div class="tabBody">
<table>
<tr>
<td>
<div class="tabBodyNow" id="pagarBody">
<?php if($pagarA != null){ $pagarAA = array(); array_push($pagarAA,$pagarA);foreach($pagarAA as $pagar){ ?>
<table>
	<tr><th colspan="5">Pagar a <?php echo $pagar->getReferido()." con celular ".$pagar->getCelularReferido(); ?> </th></tr>
	<tr><th>Tipo Pago</th><th>Realizado</th><th>Monto</th><th>Fecha Esperada</th><th>Fecha Pago</th></tr>
<?php foreach ($pagosA as $key => $pago){if($pagar->getCodigoReferido() == $pago->getRecibio()){ ?>
<tr><td><?php echo $pago->getNumeroPago() == 1?"Pago 1":"Devolucion ".$pago->getNumeroPago();?> </td>
<td><label>Si<input type="radio" value="S" name="pago<?php echo $pago->getId(); ?>[]" <?php echo $pago->getPaga()=="S"?"checked":"";?> /></label>
<label>No<input type="radio" value="N" name="pago<?php echo $pago->getId(); ?>[]" <?php echo $pago->getPaga()=="N"?"checked":"";?> /></label>
</td><td><input type="number" name="monto[]" value=""/></td><td></td><td><?php echo $pago->getFecha();?></td></tr>
<?php }} ?>
</table>
<?php } }?>
<table>
<tr><th colspan="4">Devolucion 3 (Administraci&oacute;n)</th></tr>
<tr><th>Realizado</th><th>Monto</th><th>Fecha Esperada</th><th>Fecha Pago</th></tr>
<tr><td><input type="checkbox" value="S" name="pago3"/></td><td><input type="number" name="monto3" value=""/></td><td></td><td></td></tr>
</table>
</div>
</td>
<td >
<div class="tabBody2" id="recibirBody">
<table>
<?php if($recibeDe != null) { foreach($recibeDe as $recibe){ if($recibe instanceof VReferidoAG){$numerarPersonas++;  $recibeWhatsapp .= $numerarPersonas.". *".trim($recibe->getReferido())."* con numero de celular *".trim($recibe->getCelularReferido())."* ";?>
<tr><th colspan="6">Recibe de <?php echo $recibe->getReferido()." con celular ".$recibe->getCelularReferido();?> el  Pago  </th></tr>
<tr><th>#</th><th>Realizado</th><th>Pagado</th><th>Monto</th><th>Fecha Esperada</th><th>Fecha Pago</th></tr>
<?php foreach($pagosDe as $pago2){
if(gettype($pago2) == "object" && $recibe->getCodigoAfiliado() == $pago2->getPago()){ $cantidadPagosRecibidos += ($pago2->getPaga()=="S"?1:0); $cantidadPagosAceptados += ($pago2->getRecibe()=="S"?1:0); 
$recibeWhatsapp .= ($pago2->getRecibe() == "S"?"~":"").($pago2->getPaga()=="S"?"*PAGO*":"").($pago2->getRecibe()=="S"?"~":"")."\n";?>

<tr><td><?php echo $pago2->getNumeroPago() ;?> </td>
<td><label>Si <input type="radio" value="S" name="recibido<?php echo $pago2->getId();?>[]" <?php echo $pago2->getRecibe() == "S"?"checked":""; ?>/></label><br/>
<label>No  <input type="radio" value="N" name="recibido<?php echo $pago2->getId();?>[]" <?php echo $pago2->getRecibe() == "N"?"checked":""; ?>/></label></td>
<td><?php echo $pago2->getPaga() == "S"?"Si":"No";?></td>
<td><input type="number" name="valor[]" value=""/></td>
<td></td><td><?php echo $pago2->getFecha();?></td></tr>
<?php }}}}?>
<td colspan="2">Numero de Pagos Recibidos</td><td><?php echo $cantidadPagosRecibidos; ?></td><td colspan="2">Numero de Pagos Aceptados</td><td><?php echo $cantidadPagosAceptados; ?></td></tr>
<?php } ?>
</table>
<textarea style="width:50px;height:14px;">
<?php echo $recibeWhatsapp; ?>
</textarea>
</div>
</td>
</tr>
</table>
</div></div>
<button>Actualizar</button><br/>
</form>
</div>
