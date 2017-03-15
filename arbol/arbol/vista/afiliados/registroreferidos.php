<div class="floatLeft">
<?php
$body = unserialize ( $valor );
if ($body instanceof Lista) {
		 if (count ( $body->getDestino () ) == 0 ) {
$objN = ($body->getOrigen());
$grupo = "";
if(count($objN)>0){
$objj = new Grupo();
$objj = $objN[0];
if($objj instanceof Afiliados){
foreach($objj as $key => $value)
$grupo = "&grupo=". $objj->getId(); 
}}

		?>
		  <meta http-equiv="Refresh" content="1;url=./principal.php?nav=afiliado/crear<?php echo $grupo; ?>" />
		Redireccionado... 
		<?php
		 }else if ( count($body->getDestino ())>0) {
			 ?>
			 <ul>
			 <?php
				foreach ( $body->getOrigen () as $obj ) {
					 foreach ( $body->getDestino () as $obj1 ) {
					?>
					<li>
					<a href="./principal.php?nav=afiliado/agregarreferido&id=<?php echo $obj->getId(); ?>&id2=<?php echo $obj1->getId(); ?>"> 
						<?php 						   
							if( count ( $body->getOrigen() ) > 1 ){
								echo $obj->getOAfiliado()->getNombres()." ".$obj->getOAfiliado()->getApellidos()." ".$obj->getOAfiliado()->getCelular()." - "; 
							}
							if($obj1 instanceof Afiliados){
								echo $obj1->nombres." ".$obj1->apellidos." ".$obj1->celular;
							}
						?> 
					</a>
					</li>
					<?php
				 }//end foreach destino
			}//end foreach origen
			?></lu><?php
	}//end if else
}//end if lista
?> 
</div>
