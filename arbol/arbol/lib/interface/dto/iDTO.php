<?php
interface iDTO{
function select();
function update();
function insert();
function delete();
function alias();
function where();
function setRow($row);
function setRegistroInicial($in);
function setCantidad($in);
function getRegistroInicial();
function getCantidad();
}


?>
