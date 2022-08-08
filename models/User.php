<?php
include "./models/ConDataBase.php";

class User{
    public $id;
    public $name;
    public $surname;
    public $bool;
    public $age;
    public $height;

    public function __construct($id, $name, $surname, $bool, $age, $height) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->bool = $bool;
        $this->age = $age;
        $this->height = $height;
    }

    public static function find($id)
    {
        $db = new ConDataBase();
        $sql = "SELECT * FROM `registration` where `id` =". $id;
        $result = $db->conn->query($sql);

        while($row = $result->fetch_assoc()) {
            $user = new User($row["id"], $row["name"], $row["surname"], $row["bool"], $row["age"], $row["height"]);
        }
        $db->conn->close();
        return $user;
    }

    public static function ifExistsPlantName(string $name) {
        $db = new ConDataBase();
        $sql = "SELECT * FROM registration WHERE name = '".$name."'";
        $result = $db->conn->query($sql);

        while($row = $result->fetch_assoc()) {
            $user = new User($row["id"], $row["name"], $row["surname"], $row["bool"], $row["age"], $row["height"]);
        }
        $db->conn->close();
        return $user;
    }

    public static function ifExistsPlantSurname(string $surname) {
        $db = new ConDataBase();
        $sql = "SELECT * FROM registration WHERE surname = '".$surname."'";
        $result = $db->conn->query($sql);

        while($row = $result->fetch_assoc()) {
            $user = new User($row["id"], $row["name"], $row["surname"], $row["bool"], $row["age"], $row["height"]);
        }
        $db->conn->close();
        return $user;
    }

    public static function all()
    {
       $users = [];
       $db = new ConDataBase();
       $sql = "SELECT * FROM registration";
       $result = $db->conn->query($sql);

       while($row = $result->fetch_assoc()) {
           $users[] = new User($row["id"], $row["name"], $row["surname"], $row["bool"], $row["age"], $row["height"]);
       }
       $db->conn->close();
       return $users;
    }

    public static function create(){
        $db = new ConDataBase();
        $stmt = $db->conn->prepare("INSERT INTO registration (name, surname, bool, age, height) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiii", $_POST['name'], $_POST['surname'], $_POST["bool"], $_POST["age"], $_POST["height"]);
        $stmt->execute();
        $stmt->close();
        $db->conn->close();
    }

    public static function update(){
        $db = new ConDataBase();
        $stmt = $db->conn->prepare("UPDATE registration SET name = ?, surname = ?, bool = ?, age = ?, height = ? WHERE id = ?");
        $stmt->bind_param("ssiiii", $_POST['name'], $_POST['surname'], $_POST["bool"], $_POST["age"], $_POST["height"], $_POST['id']);
        $stmt->execute();
        $stmt->close();
        $db->conn->close();
    }

    public static function destroy(){
        $db = new ConDataBase();
        $stmt = $db->conn->prepare("DELETE FROM registration WHERE id = ?");
        $stmt->bind_param("i", $_POST['id']);
        $stmt->execute();
        $stmt->close();
        $db->conn->close();
        include "./models/footer.php"; /*----- FOOTER HTML -----*/
    }
}