<?php
class Conexio {
    public $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=ticofit", "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Conexión fallida: " . $e->getMessage();
        }
    }
}
?>