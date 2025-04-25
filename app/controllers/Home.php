<?php
declare(strict_types = 1);

class Home extends Controller {

    private $database;
    private $shopList;

    function __construct()
    {
        $this->database = new DatabaseAccess();
        parent::__construct("Home");
    }

    // public function getShopList()
    // {
    //     $result = $this->database->query("SELECT * FROM ConsignmentStore");
    //     //while($row = $result->fetch_array(MYSQLI_ASSOC)){
    //     //  echo "$row[tenantID]";
    //     //}
    //     return $result;
    // }
}
