<?php
require_once '../Modelo/Conexio.php';

class ControladorAsistencia {
    private $conn;

    public function __construct() {
        try {
            $conexio = new Conexio();
            $this->conn = $conexio->conn;
        } catch (Exception $e) {
            die("Error al inicializar la conexión: " . $e->getMessage());
        }
    }

    public function listarAsistencia() {
        try {
            $stmt = $this->conn->prepare("
                SELECT a.asistenciaId, a.clienteId, u.nombre, u.apellido, a.fechaHora
                FROM Asistencia a
                INNER JOIN Cliente c ON a.clienteId = c.clienteId
                INNER JOIN Usuario u ON c.idUsuario = u.id
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en listarAsistencia: " . $e->getMessage());
            return [];
        }
    }
}
?>