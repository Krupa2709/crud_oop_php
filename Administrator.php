<?php
require_once 'db.php';

class Administrator extends Database {
    public function authenticate($username, $password) {

        $sql = "SELECT * FROM administrator WHERE username='$username'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();

        if ($result->num_rows == 1 && password_verify($password, $row['pwd'])) {
            return true;
        }else{
            return false;
        }

    }
}
?>
