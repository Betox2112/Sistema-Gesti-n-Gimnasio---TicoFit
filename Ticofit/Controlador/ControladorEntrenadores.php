<?php
require_once '../Modelo/Conexio.php';

class ControladorEntrenadores {
    private $conn;

    public function __construct() {
        $this->conn = new Conexio();
    }

    public function listarEntrenadores() {
        $stmt = $this->conn->conn->query("SELECT id, nombre, especialidad, email FROM entrenadores");
        return $stmt->fetchAll();
    }
}
?>