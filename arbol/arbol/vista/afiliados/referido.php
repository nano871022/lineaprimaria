<form action="./principal.php?nav=afiliado/buscarreferido" method="post">
<table>
	<?php
	setlocale(LC_TIME,"es_CO");
	  $afiliado = null;
	  $grupo = null;
	  if($valor != null){
		$valor = unserialize($valor);
		if($valor instanceof RefAfi){
			if($valor->getAfiliado()!=null){
				$afiliado = $valor->getAfiliado();
			}else{
				$afiliado = new Afiliados();
			}
			if($valor->getGrupo() != null){
				$grupo    = $valor->getGrupo();
			}else{
				$grupo = new Grupo();
			}
		}
	   }
	?>
<input type="hidden" name="id" value="<?php echo $afiliado->getId();?>"/>	
<tr style="<?php echo $afiliado->getCelular()!=null?"display:none":"";?>">
	<td>celular (Origen)</td>
	<td>
		<input type="text" name="celular" value="<?php echo $afiliado->getCelular();?>" />
	</td>
</tr>
<tr>
	<td>celular (Destino)</td>
	<td>
		<input type="text" name="celular1"/>
	</td>
</tr>
<tr style="<?php echo $grupo[$valor->getGActual()-1]->getNumeroGrupo()!=null?"display:none":"";?>">
	<td>Grupo Ingreso(5,10,15,20,25,30)</td>
	<td>
		<input type="text" name="grupo" maxlength="2" value="<?php echo ($grupo[$valor->getGActual()-1]->getNumeroGrupo()<30?$grupo[$valor->getGActual()-1]->getNumeroGrupo():0)+$valor->getAumento();?>"/>
	</td>
</tr>
<tr>
	<td>Ingrese Mes(1-12)</td>
	<td>
		<input type="text" name="mes" maxlength="2" value="<?php 
		$mes = date("m")+($grupo[$valor->getGActual()-1]->getNumeroGrupo()>=28?1:0); 
		echo $mes>12?"01":$mes; ?>"/>
	</td>
</tr>
<tr><td>Ingrese Año(2016,2017)</td><td><input type="text" name="anio" maxlength="4" value="<?php echo date("Y")+($grupo[$valor->getGActual()-1]->getNumeroGrupo()>=28 && date("m")==12?1:0); ?>"/></td></tr>
	<tr>
		<td>
			<a href="./principal.php?nav=nodos/arbol">Regresar</a>
		</td>
		<td>
			<button>Buscar</button>
		</td>
	</tr>
</table>
</form>
