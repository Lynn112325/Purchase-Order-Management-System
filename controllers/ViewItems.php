<?php
class ViewItems extends Controller
{

    private $database;
    private $shopList;

    function __construct()
    {
        $this->database = new DatabaseAccess();
        parent::__construct("ViewItems");
    }

    public function getItemsList()
    {
        $result = $this->database->query("SELECT * FROM `virtualitem` WHERE `status` = '1'");
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            echo "$row[tenantID]";
        }
        return $result;
    }
}
