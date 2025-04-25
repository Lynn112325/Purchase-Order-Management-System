<?php
class Supplier
{
    private $id;
    private $name;
    private $contactName;
    private $contactNumber;
    private $address;

    function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->address = $data['address'];
        $this->contactName = $data['contactName'];
        $this->contactNumber = $data['contactNumber'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getContactName()
    {
        return $this->contactName;
    }

    public function getContactNumber()
    {
        return $this->contactNumber;
    }
}
