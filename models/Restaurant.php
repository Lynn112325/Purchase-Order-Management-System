<?php
class Restaurant
{
    private $id;
    private $restaurantName;
    private $type;
    private $managerId;
    private $address;

    // 构造函数
    function __construct($id, $restaurantName, $type, $managerId, $address)
    {
        $this->id = $id;
        $this->restaurantName = $restaurantName;
        $this->type = $type;
        $this->managerId = $managerId;
        $this->address = $address;
    }

    // Getter 方法
    public function getId()
    {
        return $this->id;
    }

    public function getRestaurantName()
    {
        return $this->restaurantName;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getManagerId()
    {
        return $this->managerId;
    }

    public function getAddress()
    {
        return $this->address;
    }

    // Setter 方法
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setRestaurantName($restaurantName)
    {
        $this->restaurantName = $restaurantName;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setManagerId($managerId)
    {
        $this->managerId = $managerId;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    // if the restaurant list is not cached, query the database
    // set restaurant list that managed by the logged manager
    // And cache the restaurant list for 1 hour
    public static function getRestaurantList($db)
    {

        $cacheKey = 'restaurant_list_' . $_SESSION["userId"];

        $query = "SELECT restaurant.restaurantId, restaurant.restaurantName, restaurant_type.typeName, restaurant.warehouseAddress 
                    FROM restaurant 
                    JOIN restaurant_type ON restaurant.typeId = restaurant_type.typeId 
                    WHERE restaurant.managerId = ?";

        $result = $db->query($query, "i", [$_SESSION["userId"]]);

        // create an array to store the Restaurant objects
        $restaurants = [];

        // fetch the result row by row
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            // create a new Restaurant object
            $restaurant = new Restaurant(
                $row["restaurantId"],
                $row["restaurantName"],
                $row["typeName"], // type
                $_SESSION["userId"], // managerId
                $row["warehouseAddress"]
            );
            $restaurants[] = $restaurant; // add the Restaurant object to the associative array
        }
        // cache the restaurant list for 1 hour
        CacheManager::set($cacheKey, $restaurants, 3600);
    }
}
