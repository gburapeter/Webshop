<?php

require_once "../app/models/Order.php";

class Orders
{
    private $orders;

    public function __construct() {
        // read all order files
       /* $all_files = scandir("../data");
        $order_files = array_filter($all_files, function($f) {
           return explode("-", $f)[0] == "order";
        });

        foreach ($order_files as $file) {
            $this->orders[] = substr($file, 6,8);
        }*/
        $db = DB::getInstance();
        $statement = $db->conn->prepare("SELECT id FROM orders");

        $statement->execute();
        while($obj = $statement->fetchObject(Order::class)){
            $this->orders[]=$obj;
        }
    }

    public function checkOrderExists($id) {
        return in_array($id, $this->orders);
    }

    public function getOrderById($id) {
        if($this->checkOrderExists($id)) {
            return new Order($id);
        } else {
            return null;
        }
    }

    public function getOrders() {
        $orders_array = [];

        foreach($this->orders as $order_id) {
            $order = new Order($order_id);
            $orders_array[] = $order;
        }

        return $orders_array;
    }
}