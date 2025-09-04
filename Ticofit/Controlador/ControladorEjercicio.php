<?php
require_once '../Modelo/Conexio.php';

class ControladorEjercicio {
    private $conn;

    public function __construct() {
        $this->conn = new Conexio();
    }

    public function listarEjercicios() {
        $stmt = $this->conn->conn->prepare("SELECT e.id, e.nombre, e.descripcion, e.tipo, r.nombre AS rutina FROM ejercicio e JOIN rutina r ON e.rutinaId = r.rutinaId");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>