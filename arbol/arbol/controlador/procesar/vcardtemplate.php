<?php
class VCard{
var $afiliado;
function setAfiliado($in){$this->afiliado = $in;}
function generarVCard(){
if($this->afiliado instanceof Afiliados){
$vcard = "BEGIN:VCARD
VERSION:2.1
N;CHARSET=UTF-8:".$this->afiliado->getNombres().$this->afiliado->getApellidos()."
TITLE;CHARSET=UTF-8;LANGUAGE=es-CO:Afiliado LP
ORG;CHARSET=UTF-8:Line Primaria
URL;WORK:http://www.lineaprimaria.cf
TEL;CELL:".$this->afiliado->celular."
TEL;WORK:".$this->afiliado->otros."
END:VCARD";
return $vcard;
}
return null;
}
}
Â?>
