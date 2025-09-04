<?php
require_once '../Modelo/Conexio.php';

class ControladorMembresias {
    private $conn;

    public function __construct() {
        $this->conn = new Conexio();
    }

    public function listarMembresias() {
        $stmt = $this->conn->conn->query("SELECT DISTINCT membresiaId, tipoMembresia, costo, fechaInicio, fechaFin FROM membresias GROUP BY membresiaId, tipoMembresia, costo");
        return $stmt->fetchAll();
    }
}
?>