<?php
include_once '../../lib/interface/abstract/AbstractDTO.php';
class VPagos extends DTO{
var $pago;
var $recibio;
var $nPago;
var $fecha;
var $nombresPago;
var $apellidosPago;
var $celularPago;
var $nombresRecibio;
var $apellidosRecibio;
var $celularRecibio;

function alias(){
return "v_pagos";
}
function setRow($row){
$this->pago             = $row['pago'];
$this->recibiio         = $row['recibio'];
$this->nPago            = $row['nPago'];
$this->fecha            = $row['fecha'];
$this->nombresPago      = $row['nombresPago'];
$this->apellidosPago    = $row['apellidosPago'];
$this->celularPago      = $row['celularPago'];
$this->nombresRecibio   = $row['nombresRecibio'];
$this->apellidosRecibio = $row['apellidosRecibio'];
$this->celularRecibio   = $row['celularRecibio'];
}
function select(){$this->asegurarCampos();
return "select pago,recibio,nPago,fecha,nombresPago,apellidosPago,celularPago,nombresRecibio,apellidosRecibio,celularRecibio from ".$this->alias();
}
function update(){
return "";
}
function delete(){
return "";
}
function insert(){
return "";
}
function where(){$this->asegurarCampos();
$where = " where ";
if(!empty($this->pago)){
$where .= strlen($where)>0?" and ":" ";
$where .= "pago = ".$this->pago;
}
if(!empty($this->recibio)){
$where .= strlen($where)>0?" and ":" ";
$where .= "recibio = ".$this->recibio;
}
if(!empty($this->nPago)){
$where .= strlen($where)>0?" and ":" ";
$where .= "nPago = ".$this->nPago;
}
if(!empty($this->fecha)){
$where .= strlen($where)>0?" and ":" ";
$where .= "fecha = ".$this->fecha;
}
if(!empty($this->nombresPago)){
$where .= strlen($where)>0?" and ":" ";
$where .= "nombresPago = ".$this->nombresPago;
}
if(!empty($this->apellidosPago)){
$where .= strlen($where)>0?" and ":" ";
$where .= "apellidosPago = ".$this->apellidosPago;
}
if(!empty($this->celularPago)){
$where .= strlen($where)>0?" and ":" ";
$where .= "celularPago = ".$this->celularPago;
}
if(!empty($this->nombresRecibio)){
$where .= strlen($where)>0?" and ":" ";
$where .= "nombresRecibio = ".$this->nombresRecibio;
}
if(!empty($this->apellidosRecibio)){
$where .= strlen($where)>0?" and ":" ";
$where .= "apellidosRecibio = ".$this->apellidosRecibio;
}
if(!empty($this->celularRecibio)){
$where .= strlen($where)>0?" and ":" ";
$where .= "celularRecibio = ".$this->celularRecibio;
}
}
function setPago($in){
$this->pago = $in;
}
function getPago(){
return $this->pago;
}
function setRecibio($in){
$this->recibio = $in;
}
function getRecibio(){
return $this->recibio;
}
function setNPago($in){
$this->nPago = $in;
}
function getNPago(){
return $this->nPago;
}
function setFecha($in){
$this->fecha = $in;
}
function getFecha(){
return $this->fecha;
}
function setNombresPago($in){
$this->nombresPago = $in;
}
function getNombresPago(){
return $this->nombresPago;
}
function setApellidosPago($in){
$this->apellidosPago = $in;
}
function getApellidosPago(){
return $this->apellidosPago;
}
function setCelularPago(){
$this->celularPago = $in;
}
function getCelularPago(){
return $this->celularPago;
}
function setNombresRecibio($in){
$this->nombresRecibio = $in;
}
function getNombresRecibio(){
return $this->nombresRecibio;
}
function setApellidosRecibio($in){
$this->apellidosRecibio = $in;
}
function getApellidosRecibio(){
return $this->apellidosRecibio;
}
function setCelularRecibio(){
$this->celularRecibio = $in;
}
function getCelularRecibio(){
return $this->celularRecibio;
}
}

?>
