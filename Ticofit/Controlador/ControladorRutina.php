<?php
require_once '../Modelo/Conexio.php';

class ControladorRutina {
    private $conn;

    public function __construct() {
        $this->conn = new Conexio();
    }

    public function listarRutinas() {
        $stmt = $this->conn->conn->query("SELECT rutinaId, nombre, descripcion, duracion FROM rutina");
        return $stmt->fetchAll();
    }
}
?>