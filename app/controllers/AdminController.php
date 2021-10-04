<?php

require_once '../app/controllers/BasicController.php';
require_once '../app/models/Orders.php';

class AdminController extends BasicController
{



    public function __construct($URI_PARTS) {
        parent::__construct($URI_PARTS);

    }

    private function checkCredentials($user, $pass) {
        $db = DB::getInstance();
        $statement = $db->conn->prepare("SELECT password FROM admins WHERE username = :user");
        $statement->bindValue(":user", $user);
        $statement->execute();
        $row = $statement->fetch();
        if($row) {

            return password_verify($pass,  $row[0]);
        }
    }

    public function authenticate($DATA)  {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            // megpróbáljuk validálni a felhasználói adatokat:
            $user = $DATA['username'] ?? null;
            $pass = $DATA['password'] ?? null;


            if(array_key_exists($user, $this->admins)) {
                if (password_verify($pass, $this->admins[$user])){
                    $_SESSION['is_admin'] = true;
                    header("Refresh:0");
                }
            }


        }

        include '../view/admin_login.php';

        /** @var string $__CONTENT */
        $this->show($__CONTENT);
    }

    public function showOrders() {

        $orders = new Orders();

        include '../view/admin_orders.php';

        /** @var string $__CONTENT */
        $this->show($__CONTENT);

    }
}

