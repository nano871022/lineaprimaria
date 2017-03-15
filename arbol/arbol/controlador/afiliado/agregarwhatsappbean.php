<?php
require_once "../../lib/interface/bean/iBean.php";
require_once "../../dto/WhatsappGrupos.php";
$page = null;
class AgregarWhatsappBean implements iBean{
  var $body;
  var $msn;
  var $enlace;
  function control(){
	  $this->body = new WhatsappGrupos();
	  $this->msn = "";
	  $this->enlace = (new Conexion())->connect();
	  
	  if($this->validar()){
		  if(empty($this->body->getId())){
			$this->agregar();
		  }else{
			$this->update();
		  }
	  }
   }
   function agregar(){
	   //verificar que el nombre no exista
	   $query = $this->body->select().$this->body->where();
	   $result = $this->enlace->query($query);
	   if($result == null){
		   insert:
		   $query = $this->body->insert();
			$result = $this->enlace->query($query);   
			if($result != null){
				$this->msn = "<font color='green'>Se agrego el grupo de whatsapp correctamente</font>";
			}else{
				$this->msn = "<font color='red'>No se agrego el grupo de whatsapp</font>";
			}
	   }else{
		   if($row = $result->fetch_array()){
			   $this->msn = "<font color='orange'>El grupo de whatsapp ya esta creado</font>";
		   }else{
			   goto insert;
		   }
	   }
   }
   function update(){
	     $query = $this->body->update();
			$result = $this->enlace->query($query);   
			if($result != null){
				$this->msn = "<font color='green'>Se modifico el grupo de whatsapp correctamente</font>";
			}else{
				$this->msn = "<font color='red'>No se modifico el grupo de whatsapp</font>";
			}
   }
   function validar(){
	   $this->body->setNombre($_REQUEST['nombre']);
	   $this->body->setId($_REQUEST['id']);
	   $this->body->setFecha($_REQUEST['fecha']);
	   if(!empty($this->body->getNombre())){
		   return true;
	   }
	   if(!empty($this->body->getId()) && empty($this->body->getNombre())){
		   $query = $this->body->select().$this->body->where();
		   $result = $this->enlace->query($query);
		   if($result != null){
			   if($row = $result->fetch_array()){
				   $this->body->setRow($row);
			   }
		   }
		   return false;
	   }
	   return false;
   }
  function pantalla(){
	  $send = array();
	  $send[] = $this->body;
	  $send[] = $this->msn;
	return  requireAVariable("../../vista/afiliados/agregarwhatsapp.php",serialize($send));
  }

}
$page = new AgregarWhatsappBean();

?>
