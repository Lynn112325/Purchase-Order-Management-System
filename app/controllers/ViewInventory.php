<?php
declare(strict_types = 1);

class viewInventory extends Controller
{
    private $database;
    private $inventoryList;
    
    public function __construct() {
        $this->database = new DatabaseAccess();
    }

    public function getInventoryList($restaurantId)
    {
            $inventoryList = Inventory::getInventoryList($this->database, $restaurantId);
            header('Content-Type: application/json');
            // error_log("getInventoryList: " . json_encode($inventoryList));
            // var_dump("getInventoryList ".json_encode($inventoryList));
            echo json_encode($inventoryList);
    }
}
