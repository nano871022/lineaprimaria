<?php
interface iCamposDTO{
function setId($in);
function getId();
function setUsuario($in);
function getUsuario();
function setFechaIngreso($in);
function getFechaIngreso();
function setFechaModificado($in);
function getFechaModificado();
function asegurarCampos();
}
?>
