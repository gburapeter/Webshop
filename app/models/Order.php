<?php


class Order
{

    private $order_id;
    private $order_date;
    private $order_status;
    private $order_comment;

    private $customer_name;
    private $customer_mail;
    private $customer_county;
    private $customer_town;
    private $customer_address;
    private $customer_ip;

    private $basket;


    public function __construct($id = null) {



        $db = DB::getInstance();
        $statement = $db->conn->prepare("SELECT * FROM orders WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $tmp = $statement->fetch(PDO::FETCH_OBJ );
        if($tmp) {
            $tmp = json_decode($tmp);

            $this->order_id         = $tmp->id;
            $this->order_date       = $tmp->date;
            $this->order_status     = $tmp->status;
            $this->order_comment    = $tmp->comment;

            $this->customer_name    = $tmp->name;
            $this->customer_mail    = $tmp->mail;
            $this->customer_address = $tmp->addr;
            $this->customer_town    = $tmp->town;
            $this->customer_county  = $tmp->county;
            $this->customer_ip      = $tmp->ip;

            $db = DB::getInstance();

            $stmt = $db->conn->prepare("SELECT * FROM orders_products o INNER JOIN products p ON o.product_id = p.id WHERE order_id = :order_id");
            $stmt->bindValue(":order_id", $id);
            $stmt->execute();

            $basket = new Basket();
            $products = new Products();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $product = $products->getProductById($row['product_id']);
                $basket->add($product, $row['pcs']);
            }

            $this->basket = $basket->getContents();

        }
    }

    private function generateUniqueId() {
        // TODO #1 : Meg kéne valósítani azt, hogy itt egy garantáltan egyedi azonosító
        //  jöjjön létre. Az azonosító kisorsolását lásd a gyakorlati feladatsorban, az
        //  egyediséget pedig úgy tudod vizsgálni, hogy példányosítod az Orders Modelt,
        //  és használod az abban implementált checkOrderExists() metódust.
        //  Egészen addig kell újra sorsolni az azonosítót, amíg olyat nem kapsz, ami
        //  már nem létezik.

        $orders = new Orders();
        $chars = "23456789ABCDEFGHKLMNPRSTXY";
        $code = "";
        for($n = 0;$n < 8; $n++){
            $i = random_int(0,strlen($chars)-1);
            $code .= $chars[$i];
        }
        while($orders->checkOrderExists($code)){
            for($n = 0;$n < 8; $n++){
                $i = random_int(0,strlen($chars)-1);
                $code .= $chars[$i];
            }
        }
        return $code;
    }

    public function new($customer_data, $basket_contents) {

        $this->order_id         = $this->generateUniqueId();
        $this->order_date       = date("Y-m-d H:i:s");
        $this->order_status     = "fogadva";

        // A $customer_data egy tömb, ami az űrlap apalján áll elő.
        // Itt már elvárjuk, hogy validált adatot kapjunk
        $this->customer_name    = $customer_data['name'];
        $this->customer_mail    = $customer_data['mail'];
        $this->customer_address = $customer_data['addr'];
        $this->customer_town    = $customer_data['town'];
        $this->customer_county  = $customer_data['county'];
        $this->order_comment    = $customer_data['comment'];

        $this->customer_ip      = $_SERVER['REMOTE_ADDR']; // egyes dolgokat ki tudunk találni magunk is

        // A kosár tartalmát olyan formában mentjük, hogy van egy tömb,
        // amiben kulcs-érték párként van benne a rendelt termék id-ja és a darabszám:

        $this->basket = $basket_contents;

    }




        public function save() {
            $db = DB::getInstance();
            $db->conn->beginTransaction();
            $stmt = $db->conn->prepare("INSERT INTO orders (id, date,status,name,mail,addr,town,county,comment,ip)
            VALUES (:order_id, :date,:status,:name,:mail,:addr,:town,:county,:comment,:ip);");


            $stmt->bindValue(":order_id", $this->order_id);
            $stmt->bindValue(":date", $this->order_date);
            $stmt->bindValue(":status", $this->order_status);
            $stmt->bindValue(":name", $this->customer_name);
            $stmt->bindValue(":mail", $this->customer_mail);
            $stmt->bindValue(":addr", $this->customer_address);
            $stmt->bindValue(":town", $this->customer_town);
            $stmt->bindValue(":county", $this->customer_county);
            $stmt->bindValue(":comment", $this->order_comment);
            $stmt->bindValue(":ip", $this->customer_ip);
            $stmt->execute();

            foreach($this->basket as $id => $row) {
                $stmt = $db->conn->prepare("INSERT INTO orders_products (order_id,product_id,pcs) 
                                                VALUES (:order_id,:product_id,:pcs)");
                $stmt->bindValue(":order_id", $this->order_id);
                $stmt->bindValue(":product_id",$row["prod"]->getId());
                $stmt->bindValue(":pcs", $row["pcs"]);
                $stmt->execute();
            }
            $db->conn->commit();

            return $this->order_id;

        }




    public function getTotal() {
        $total = 0;
        foreach($this->basket as $id => $row) {
            $total += $row["pcs"] * $row["prod"]->getPrice();
        }

        return $total;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @return mixed
     */
    public function getOrderDate()
    {
        return $this->order_date;
    }

    /**
     * @return mixed
     */
    public function getOrderStatus()
    {
        return $this->order_status;
    }

    /**
     * @return mixed
     */
    public function getOrderComment()
    {
        return $this->order_comment;
    }

    /**
     * @return mixed
     */
    public function getCustomerName()
    {
        return $this->customer_name;
    }

    /**
     * @return mixed
     */
    public function getCustomerMail()
    {
        return $this->customer_mail;
    }

    /**
     * @return mixed
     */
    public function getCustomerCounty()
    {
        return $this->customer_county;
    }

    /**
     * @return mixed
     */
    public function getCustomerTown()
    {
        return $this->customer_town;
    }

    /**
     * @return mixed
     */
    public function getCustomerAddress()
    {
        return $this->customer_address;
    }

    /**
     * @return mixed
     */
    public function getCustomerIp()
    {
        return $this->customer_ip;
    }

    public function getBasketContents() {
        return $this->basket;
    }


}