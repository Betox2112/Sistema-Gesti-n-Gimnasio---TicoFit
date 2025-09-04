<?php
require_once '../Modelo/Conexio.php';

class ControladorCliente {
    private $conn;

    public function __construct() {
        try {
            $conexio = new Conexio();
            $this->conn = $conexio->conn;
        } catch (Exception $e) {
            die("Error al inicializar la conexión: " . $e->getMessage());
        }
    }

    public function listarClientes() {
        try {
            $stmt = $this->conn->prepare("
                SELECT c.clienteId, u.nombre, u.apellido, u.email, u.celular, c.preferencias
                FROM Cliente c
                INNER JOIN Usuario u ON c.idUsuario = u.id
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en listarClientes: " . $e->getMessage());
            return [];
        }
    }
}
?>