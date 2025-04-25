<?php
declare(strict_types = 1);

class ManagerProfile {
  private $id;
  private $name;
  private $contactNumber;
  private $warehouseAddress;

  function __construct($id, $name, $contactNumber, $warehouseAddress){
    $this->id = $id;
    $this->name = $name;
    $this->warehouseAddress = $warehouseAddress;
    $this->contactNumber = $contactNumber;
  }

  public function getId(){
    return $this->id;
  }

  public function getName(){
    return $this->name;
  }

  public function getWarehouseAddress(){
    return $this->warehouseAddress;
  }

  public function getContactNumber(){
    return $this->contactNumber;
  }
}
?>
