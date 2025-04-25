<?php
declare(strict_types = 1);

class MakeOrder extends Controller
{

    private $database;
    private $restaurantList;
    private $virtualItemList;

    function __construct()
    {
        $this->database = new DatabaseAccess();

        // Check if the restaurant list is cached
        $cacheKey = 'restaurant_list_' . $_SESSION["userId"];
        if (!CacheManager::exists($cacheKey)) {
            Restaurant::getRestaurantList($this->database);
        }
        // Get the restaurant list from the cache
        $this->restaurantList = CacheManager::get($cacheKey);
        parent::__construct("MakeOrder", $this->restaurantList);
    }
    
}
