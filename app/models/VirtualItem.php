<?php
declare(strict_types = 1);

class virtualItem extends Item
{
    private $virtualId;


    function __construct($virtualId)
    {
        $this->virtualId = $virtualId;
    }

    public function getVirtualItemList(DatabaseAccess $db, $restaurantId)
    {
        // SELECT 
        // m.virtualId,
        // m.ItemName,
        // c.categoryName,
        // s.itemImage,
        // s.specifications,
        // i.stock
        // FROM virtual_real_mapping m
        // FULL JOIN inventory i m ON m.itemId = i.itemId
        // JOIN virtual_items v ON i.itemId = v.itemId
        // JOIN category c ON m.categoryId = c.categoryId
        // JOIN items r ON m.itemID = r.itemID
        // JOIN supplier_items s ON m.supplierItemId = s.supplierItemId
        // WHERE i.restaurantId = ?
        // AND GETDATE() BETWEEN m.EffectiveDate AND m.ExpirationDate
        // GROUP BY v.VirtualItemID
        $query = "SELECT * FROM virtual_items WHERE virtualId = ?";

        $result = $db->query($query, "i", [$restaurantId]);

        $virtualItemList = array();
        while ($row = $result->fetch_assoc()) {
            $virtualItem = new virtualItem(
                $row["virtualId"],
                $row["item"],
                $row["category"],
                $row["type"]
            );
            array_push($virtualItemList, $virtualItem);
        }
    }

    public function getVirtualId()
    {
        return $this->virtualId;
    }

    public function setVirtualId($virtualId)
    {
        $this->virtualId = $virtualId;
    }
}
