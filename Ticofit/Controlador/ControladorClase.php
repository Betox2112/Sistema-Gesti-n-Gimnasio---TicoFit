<?php
require_once '../Modelo/Conexio.php';

class ControladorClase {
    private $conn;

    public function __construct() {
        try {
            $conexio = new Conexio();
            $this->conn = $conexio->conn;
        } catch (Exception $e) {
            die("Error al inicializar la conexión: " . $e->getMessage());
        }
    }

    public function listarClases() {
        try {
            $stmt = $this->conn->prepare("
                SELECT claseId, nombre, descripcion, capacidadMaxima
                FROM Clase
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en listarClases: " . $e->getMessage());
            return [];
        }
    }
}
?>