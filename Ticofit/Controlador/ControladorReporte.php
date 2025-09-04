<?php
require_once '../Modelo/Conexio.php';

class ControladorReporte {
    private $conn;

    public function __construct() {
        $this->conn = new Conexio();
    }

    public function listarEjerciciosReporte() {
        $stmt = $this->conn->conn->query("SELECT id AS ejercicioId, nombre, grupoMuscular, tipo, descripcion FROM ejercicio");
        return $stmt->fetchAll();
    }
}
?>