<?php
class MakeOrder extends Controller
{

    private $database;
    private $restaurantList;
    private $virtualItemList;

    function __construct()
    {
        $this->database = new DatabaseAccess();
        $cacheKey = 'restaurant_list_' . $_SESSION["userId"];
        if (!CacheManager::exists($cacheKey)) {
            Restaurant::getRestaurantList($this->database);
        }
        $this->restaurantList = CacheManager::get($cacheKey);
        parent::__construct("MakeOrder", $this->restaurantList);
    }
}
