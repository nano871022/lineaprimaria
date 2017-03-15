<script src="../../vista/js/pagosexterno.js"></script>
<?php 
global $listasBean;
$listas = $listasBean->listaWhatsapp();
?>
<div>
<?php foreach ( $listas as $lista){if($lista instanceof WhatsappGrupos){ ?>
<div class="grupo">
<form method="post" action="./principal.php?nav=pagos/pagos">
	<div class="grupos" onclick="onFormulario(this)">
	  <input type="hidden" name="whatsapp" value="<?php echo $lista->getId(); ?>"/>
	   <?php echo $lista->nombre;?>	
	</div>
</form>
</div>
<?php }} ?>
</div>
