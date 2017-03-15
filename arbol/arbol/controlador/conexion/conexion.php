<?php
include_once "../../lib/interface/dto/iDTO.php";
class Conexion{
var $user = "lineaprimaria";//"id311404_lpmaster";//"master"
var $pass = "LineaPrimaria2016";//"Nano871022";
var $BD = "lineaprimaria";//"id311404_lineaprimaria";
var $server = "localhost";
var $link = null;
var $insert_id;
var $error;
function connect(){
  if($this->link == null){
    $this->link = new mysqli($this->server,$this->user,$this->pass,$this->BD);
   $this->link->set_charset("UTF-8");   
   mysqli_set_charset($this->link,"UTF-8");
  }
//  return $this->link;
return $this;
 }
 function query($query){
	$result =  $this->link->query($query);
	$this->insert_id = $this->link->insert_id;
	return $result;
	}
 function insert_id(){
	 return $this->link->insert_id;
	}
 function insert($dto){
 $this->connect();
	if($dto instanceof iDTO){
		$sql = $dto->insert();
		if(strlen($sql)>0){
			$result = $this->link->query($sql);
			if($result != null){
				$this->insert_id = $this->link->insert_id;
				return $result;
			}
		}
	}
$this->error = $this->link->error;
$this->insert_id = null;
return false;
}
 function update($dto){
 $this->connect();
	if($dto instanceof iDTO){
		$sql = $dto->update();
		if(strlen($sql)>0){
			$result = $this->link->query($sql);
			if($result != null){
				return $result;
			}
		}
	}
$this->error = $this->link->error;
$this->insert_id = null;
return false;
}
 function delete($dto){
 $this->connect();
	if($dto instanceof iDTO){
		$sql = $dto->delete();
		if(strlen($sql)>0){
			$result = $this->link->query($sql);
			if($result != null){
				return $result;
			}
		}
	}
$this->error = $this->link->error;
$this->insert_id = null;
return false;
}
function select($dto){
 $this->connect();
 $retornar = array();
	if($dto instanceof iDTO){
		$where = $dto->where();
		$limit = " LIMIT ".$dto->getRegistroInicial().",".$dto->getCantidad();
		$limit = strlen($limit)>8?$limit:"";
		$where = strlen($where)>10?$where:"";
		$sql = $dto->select().$where.$limit;
		if(strlen($sql)>0){
			$result = $this->link->query($sql);	
			if($result != null){
			  while($row = $result->fetch_array()){
				$temp = clone $dto;
				$temp->setRow($row);
				$retornar[] = $temp;
			  }
			}
		}
	}
  if(count($retornar)>1){
	return $retornar;
  }else if(count($retornar)==1){
	return $retornar[0];	
  }
$this->error = $this->link->error;
return null;
}
function selectOrder($dto,$order){
 $this->connect();
 $retornar = array();
	if($dto instanceof iDTO){
		$where = $dto->where();
		$limit = " LIMIT ".$dto->getRegistroInicial().",".$dto->getCantidad();
		$limit = strlen($limit)>8?$limit:"";
		$where = strlen($where)>10?$where:"";
		$sql = $dto->select().$where.$order.$limit;
		if(strlen($sql)>0){
			$result = $this->link->query($sql);	
			if($result != null){
			  while($row = $result->fetch_array()){
				$temp = clone $dto;
				$temp->setRow($row);
				$retornar[] = $temp;
			  }
			}
		}
	}
  if(count($retornar)>1){
	return $retornar;
  }else if(count($retornar)==1){
	return $retornar[0];	
  }
$this->error = $this->link->error;
return null;
}
function cantidad($dto){
 $this->connect();
	if($dto instanceof iDTO){
		$where = $dto->where();
		$where = strlen($where)>10?$where:"";
		$sql = "select count(*) as cantidad from ".$dto->alias().$where;
		if(strlen($sql)>0){
			$result = $this->link->query($sql);
			if($result != null){	
				if($row = $result->fetch_array()){
					return $row['cantidad'];
				}
			}
			}
	}
$this->error = $this->link_error;
return null;
}
}
?>
