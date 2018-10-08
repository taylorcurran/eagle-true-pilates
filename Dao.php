<?php
class Dao {

    private $host = "us-cdbr-iron-east-01.cleardb.net";
    private $db = "heroku_082e85feecb33f2";
    private $user = "b266bf6ad3670b";
    private $pass = "f637ebcb";

    public function getConnection () {
        return
            new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,
                $this->pass);
    }

    public function saveUser ($first_name, $last_name, $email, $password) {
        $conn = $this->getConnection();
        $saveQuery =
            "INSERT INTO user
        (first_name, last_name, email, password)
        VALUES
        (:first_name, :last_name, :email, :password)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":first_name", $first_name);
        $q->bindParam(":last_name", $last_name);
        $q->bindParam(":email", $email);
        $q->bindParam(":password", $password);
        $q->execute();
    }

    public function getUser ($email) {
        $conn = $this->getConnection();
        return $conn->query("SELECT * FROM user WHERE email = '$email'");
    }
}
?>

