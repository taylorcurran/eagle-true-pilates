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

    public function getProduct ($id) {
        $conn = $this->getConnection();
        $getQuery = "SELECT id, name, description, image_path FROM product WHERE id = :id";
        $q = $conn->prepare($getQuery);
        $q->bindParam(":id", $id);
        $q->execute();
        return reset($q->fetchAll());
    }

    public function getUsers () {
        $conn = $this->getConnection();
        return $conn->query("SELECT * FROM user", PDO::FETCH_ASSOC);
    }

    public function getUser ($email) {
        $conn = $this->getConnection();
        return $conn->query("SELECT * FROM user WHERE email = 'taylorcurran02@bsu.com'", PDO::FETCH_ASSOC);
    }

    public function getUserId ($email) {
        $conn = $this->getConnection();
        $getQuery = "SELECT id FROM user WHERE email = :email";
        $q = $conn->prepare($getQuery);
        $q->bindParam(":email", $email);
        $q->execute();
        return reset($q->fetchAll());
    }

    public function getFirstName ($email) {
        $conn = $this->getConnection();
        $getQuery = "SELECT first_name FROM user WHERE email = :email";
        $q = $conn->prepare($getQuery);
        $q->bindParam(":email", $email);
        $q->execute();
        return reset($q->fetchAll());
    }

    public function getLastName ($email) {
        $conn = $this->getConnection();
        $getQuery = "SELECT Last_name FROM user WHERE email = :email";
        $q = $conn->prepare($getQuery);
        $q->bindParam(":email", $email);
        $q->execute();
        return reset($q->fetchAll());
    }

    public function saveUserGroup ($user_id, $group_id) {
        $conn = $this->getConnection();
        $saveQuery = "INSERT INTO user_group
            (user_id, group_id)
            VALUES
            (:user_id, :group_id)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":user_id", $user_id);
        $q->bindParam(":group_id", $group_id);
        $q->execute();
    }

    public function getGroupId ($name) {
        $conn = $this->getConnection();
        $getQuery= "SELECT id FROM groups WHERE name = :name";
        $q = $conn->prepare($getQuery);
        $q->bindParam(":name", $name);
        $q->execute();
        return reset($q->fetchAll());
    }

    public function getGroupMemberId () {
        $conn = $this->getConnection();
        $getQuery= "SELECT id FROM groups WHERE name = 'member'";
        $q = $conn->prepare($getQuery);
        $q->execute();
        return reset($q->fetchAll());
    }

    private function getGroupInstructorId () {
        $conn = $this->getConnection();
        $getQuery= "SELECT id FROM groups WHERE name = 'instructor'";
        $q = $conn->prepare($getQuery);
        $q->execute();
        return reset($q->fetchAll());
    }

    private function getGroupAdminId () {
        $conn = $this->getConnection();
        $getQuery= "SELECT id FROM groups WHERE name = 'admin'";
        $q = $conn->prepare($getQuery);
        $q->execute();
        return reset($q->fetchAll());
    }

    public function isMember ($user_id) {
        $conn = $this->getConnection();
        $group_id = $this->getGroupMemberId()[0];
        $getQuery = "SELECT id FROM user_group WHERE user_id = :user_id && group_id = :group_id";
        $q = $conn->prepare($getQuery);
        $q->bindParam(":user_id", $user_id);
        $q->bindParam(":group_id", $group_id);
        $q->execute();
        return reset($q->fetchAll());
    }

    public function isInstructor ($user_id) {
        $conn = $this->getConnection();
        $group_id = $this->getGroupInstructorId()[0];
        $getQuery = "SELECT id FROM user_group WHERE user_id = :user_id && group_id = :group_id";
        $q = $conn->prepare($getQuery);
        $q->bindParam(":user_id", $user_id);
        $q->bindParam(":group_id", $group_id);
        $q->execute();
        return reset($q->fetchAll());
    }

    public function isAdmin ($user_id) {
        $conn = $this->getConnection();
        $group_id = $this->getGroupAdminId()[0];
        $getQuery = "SELECT id FROM user_group WHERE user_id = :user_id && group_id = :group_id";
        $q = $conn->prepare($getQuery);
        $q->bindParam(":user_id", $user_id);
        $q->bindParam(":group_id", $group_id);
        $q->execute();
        return reset($q->fetchAll());
    }

    public function saveMessage($first_name, $last_name, $country, $message) {
        $conn = $this->getConnection();
        $saveQuery =
            "INSERT INTO message
        (first_name, last_name, country, message)
        VALUES
        (:first_name, :last_name, :country, :message)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":first_name", $first_name);
        $q->bindParam(":last_name", $last_name);
        $q->bindParam(":country", $country);
        $q->bindParam(":message", $message);
        $q->execute();
    }

    public function getMessages() {
        $conn = $this->getConnection();
        $getQuery= "SELECT * FROM message";
        $q = $conn->prepare($getQuery);
        $q->execute();
        return $q->fetchAll();
    }

    public function deleteMessage($id) {
        $conn = $this->getConnection();
        $saveQuery = "DELETE FROM message WHERE id = :id";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":id", $id);
        $q->execute();
    }
}
?>


