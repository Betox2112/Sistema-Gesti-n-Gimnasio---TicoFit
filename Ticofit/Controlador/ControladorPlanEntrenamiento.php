<?php
require_once '../Modelo/Conexio.php';

class ControladorPlanEntrenamiento {
    private $conn;

    public function __construct() {
        $this->conn = new Conexio();
    }

    public function listarPlanes() {
        $stmt = $this->conn->conn->query("SELECT id, nombre, descripcion FROM plan_entrenamiento");
        return $stmt->fetchAll();
    }
}
?>