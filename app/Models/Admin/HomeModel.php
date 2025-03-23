<?php
class HomeModel
{
    public $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function __getUsers()
    {
        $sql = "select * from users";
        $query = $this->db->pdo->query($sql);
        $result = $query->fetchAll();
        return $result;
    }

    public function checkLogin()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $result = $stmt->fetch();
        //kiểm tra mật khẩu
        if ($result && password_verify($password, $result->password)) {
            return $result;
        }
        return $result;
    }
}
