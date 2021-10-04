<?php

class DB {
    public PDO $conn;
    private static DB $instance;

    private function __construct() {
        require_once "../app/db_credentials.php";
        $this->conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {

        if(!isset(self::$instance)) {
            self::$instance = new DB();
        }

        return self::$instance;
    }
}


class Person {
    private $id;
    private $name;
    private $age;

    public function __construct() {

    }

    public function __toString(): string {
        return "#$this->id $this->name ($this->age)";
    }

    public function loadByID($id){
        $db = DB::getInstance();
        $statement = $db->conn->prepare("SELECT * FROM proba WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if($row) {
            foreach ($row as $name => $value) {
                $this->{$name} = $value;
            }
        }

    }
    public function save() {
        $db = DB::getInstance();
        $statement = $db->conn->prepare("INSERT INTO proba (id, name, age) VALUES (:id, :name, :age)
                                            ON DUPLICATE  KEY UPDATE name=:name, age=:age");
        $statement->bindValue(":id", $this->id);
        $statement->bindValue(":name", $this->name);
        $statement->bindValue(":age", $this->age);

        $statement->execute();
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }


}

class Group{

    private $list;

    /**
     * @return mixed
     */
    public function getList()
    {
        return $this->list;
    }

    public function __construct($id = null) {
        $db = DB::getInstance();
        $statement = $db->conn->prepare("SELECT * FROM proba");

        $statement->execute();
        while($obj = $statement->fetchObject(Person::class)){
            $this->list[]=$obj;
        }

    }


}
/*
$e = new Person(1);
$e->setName("Éva");
$e->setAge(15);

$e->save();
*/
$g = new Group();
header("Content-type: text/plain");
var_dump($g->getList());