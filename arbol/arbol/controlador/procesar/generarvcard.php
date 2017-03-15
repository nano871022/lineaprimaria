<?php
require_once '../../controlador/procesar/vcardtemplate.php';
class GenerarVCard{
var $afiliados;
function setAfiliados($in){$this->afiliados = $in;}

function generarVCard(){
$vcards = array();
if(count($this->afiliados)>0) 
foreach($this->afiliados as $afiliado){
	$vcard = new VCard();
	$vcard->setAfiliado($afiliado);
$vcards[] = $vcard->generarVCard();
 }//end foreach
if(count($vcards)>0)
return $this->crearArchivo($vcards);
return null;
}
function crearArchivo($vcards){
$name = "../../filesgen/".$this->generarCodigo(20).".vcf";
	$file = fopen($name,"w");
	foreach($vcards as $vcard){
		if(!empty($vcard)){	
			fwrite($file,$vcard . PHP_EOL);
		}
	}
	fclose($file);
 return $name;
}
function generarCodigo($longitud){
$key = '';
echo $longitud."<--";
$pattern = '123456789abcdefghijklmnsopqrstuvwxyz';
$max = strlen($pattern)-1;
for($i=0;$i<$longitud;$i++){
$key .= $pattern{mt_rand(0,$max)};
}
return $key;
}//end generarCodigo
}
?>
