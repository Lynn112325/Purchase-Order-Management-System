<?php
declare(strict_types = 1);

class Inventory {
    public $itemId;
    public $itemName;
    public $imgUrl;// for reference
    public $categoryName;
    public $specifications;
    public $stock;

    public function __construct($itemId, $itemName, $categoryName, $imgUrl, $specifications, $stock) {
        $this->itemId = $itemId;
        $this->itemName = $itemName;
        $this->categoryName = $categoryName;
        $this->imgUrl = $imgUrl;
        $this->specifications = $specifications;
        $this->stock = $stock;
    }

    // Get inventory list by restaurantId
    public static function getInventoryList(DatabaseAccess $db, $restaurantId)
    {

        $query = "SELECT m.virtualId, m.ItemName, c.categoryName, s.itemImage,
                CASE 
                    WHEN SUM(CASE WHEN i.stock > 0 THEN 1 ELSE 0 END) > 1 THEN 
                        GROUP_CONCAT(s.specifications SEPARATOR '/')
                    WHEN SUM(CASE WHEN i.stock > 0 THEN 1 ELSE 0 END) = 1 THEN
                        MAX(CASE WHEN i.stock > 0 THEN s.specifications END)
                    ELSE 
                    NULL
                END AS specifications,
                COALESCE(GROUP_CONCAT(i.stock SEPARATOR '/'), 0) AS stock
                FROM virtual_items v 
                LEFT JOIN inventory i ON v.itemId = i.itemId AND i.restaurantId = ? 
                LEFT JOIN virtual_real_mapping m ON v.virtualId = m.virtualId
                JOIN restaurant r ON r.restaurantId = ? 
                JOIN restaurant_type t ON r.typeId = t.typeId 
                JOIN category c ON m.categoryId = c.categoryId 
                JOIN item item ON v.itemID = item.itemID
                JOIN supplier_item s ON item.supplierItemId = s.supplierItemId AND item.supplierId = s.supplierId 
                GROUP BY v.virtualId, m.ItemName, c.categoryName 
                LIMIT 0, 25;";

        $result = $db->query($query, "ii", [$restaurantId, $restaurantId]);

        $inventoryList = array();
        while ($row = $result->fetch_assoc()) {

            $inventory = new Inventory(
                $row["virtualId"],
                $row["ItemName"],
                $row["categoryName"],
                $row["itemImage"],
                $row["specifications"],
                $row["stock"]
            );

            array_push($inventoryList, $inventory);
        }
        return $inventoryList;
    }

    public function getItemId()
    {
        return $this->itemId;
    }
}
