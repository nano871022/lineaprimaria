<?php $valores = unserialize($valor); ?>
<div>
<form action="./principal.php?nav=afiliado/agregarwhatsappbean" method="post">
  <table>
	<tr>
		<td><label for="nombre">Nombre</label></td>
		<td><input type="text" name="nombre" id="nombre" placeholder="Ingrese Nombre del Grupo de Whatsapp" value="<?php 
		if($valores[0] instanceof WhatsappGrupos ){
			$v = $valores[0];
			echo $v->getNombre(); 
		}?>"/></td>
	</tr>
	<tr <?php if($valores[0] instanceof WhatsappGrupos ){
			$v = $valores[0];
			echo empty($v->getId())?"style='display:none'":""; 
		}?>>
		<td><label for="fecha">Fecha</label></td>
		<td><input type="date" name="fecha" id="fecha" value="<?php 
		if($valores[0] instanceof WhatsappGrupos ){
			$v = $valores[0];
			echo $v->getFecha(); 
		}?>"/>
		<input type="hidden" name="id" id="id" value="<?php 
		if($valores[0] instanceof WhatsappGrupos ){
			$v = $valores[0];
			echo $v->getId(); 
		}?>"/>
		</td>
	</tr>
	<tr>
	<td colspan="2">
		<?php echo $valores[1]; ?>
	</td>
	</tr>
	<tr>
	<td colspan="2">
	<button>
		Guardar
	</button>
	</td>
	</tr>
  </table>
</form>
</div>
