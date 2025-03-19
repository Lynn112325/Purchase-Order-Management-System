<?php
class supplierItem
{
    // allow child classes to access these properties
    protected $supplierItemId;
    protected $name;
    protected $status;
    protected $price;
    protected $specifications;
    protected $description;
    protected $imgFile;
    protected $supplierID;
    protected $minimumOrderQuantity;

    function __construct(array $data)
    {
        $this->supplierItemId = $data['id'];
        $this->name = $data['name'];
        $this->status = $data['status'];
        $this->price = (float)$data['price']; // 强制转换为浮点数
        $this->specifications = $data['specifications'];
        $this->description = $data['description'];
        $this->imgFile = $data['imgFile'];
        $this->supplierID = $data['supplierID'];
        $this->minimumOrderQuantity = (int)$data['minimumOrderQuantity']; // 强制转换为整数
    }

    // Getter methods
    function getSupplierItemId()
    {
        return $this->supplierItemId;
    }

    function getName()
    {
        return $this->name;
    }

    function getStatus()
    {
        return $this->status;
    }

    function getPrice()
    {
        return $this->price;
    }

    function getSpecifications()
    {
        return $this->specifications;
    }

    function getDescription()
    {
        return $this->description;
    }

    function getImgFile()
    {
        return $this->imgFile;
    }

    function getSupplierID()
    {
        return $this->supplierID;
    }

    function getMinimumOrderQuantity()
    {
        return $this->minimumOrderQuantity;
    }

    // Setter methods
    function setSupplierItemId($supplierItemId)
    {
        $this->supplierItemId = $supplierItemId;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function setStatus($status)
    {
        $this->status = $status;
    }

    public function setPrice(float $price)
    {
        if ($price < 0) {
            throw new InvalidArgumentException("Price cannot be negative");
        }
        $this->price = $price;
    }

    function setSpecifications($specifications)
    {
        $this->specifications = $specifications;
    }

    function setDescription($description)
    {
        $this->description = $description;
    }

    function setImgFile($imgFile)
    {
        $this->imgFile = $imgFile;
    }

    function setSupplierID($supplierID)
    {
        $this->supplierID = $supplierID;
    }

    function setMinimumOrderQuantity($minimumOrderQuantity)
    {
        $this->minimumOrderQuantity = $minimumOrderQuantity;
    }
}