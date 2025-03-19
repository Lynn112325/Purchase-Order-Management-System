<?php
class Inventory
{

    private $id;
    private $restaurantInfo;
    private $itemId;
    protected $qty;

    function __construct($id, $restaurantInfo, $itemId, $qty)
    {
        $this->id = $id;
        $this->restaurantInfo = $restaurantInfo;
        $this->itemId = $itemId;
        $this->qty = $qty;
    }

    function getId()
    {
        return $this->id;
    }

    public function getRestaurantInfo()
    {
        return $this->restaurantInfo;
    }
    public function getItemId()
    {
        return $this->itemId;
    }
    function getQty()
    {
        return $this->qty;
    }
}
