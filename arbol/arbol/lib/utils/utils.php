<?php
function requireAVariable($pathFile,$valor){
  ob_start();
  $var = require $pathFile;
  $v2 = ob_get_clean();
  return $v2;
}
?>
