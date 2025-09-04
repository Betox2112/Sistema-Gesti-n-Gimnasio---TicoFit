<?php
require_once '../Modelo/Conexio.php';

class ControladorEstadoPagos {
    private $conn;

    public function __construct() {
        $this->conn = new Conexio();
    }

    public function listarEstadoPagos() {
        $stmt = $this->conn->conn->query("
            SELECT p.id, u.nombre, m.tipoMembresia, 
                   CASE 
                       WHEN p.id IS NOT NULL THEN 'Pagado'
                       ELSE 'No Pagado'
                   END AS estadoPago,
                   p.fechaPago,
                   DATEDIFF(m.fechaFin, CURDATE()) AS diasRestantes
            FROM usuario u
            LEFT JOIN pagos p ON u.id = p.usuarioId
            LEFT JOIN membresias m ON p.membresiaId = m.membresiaId
            GROUP BY u.id, u.nombre, m.tipoMembresia, p.fechaPago, m.fechaFin
            HAVING p.fechaPago = (SELECT MAX(fechaPago) FROM pagos p2 WHERE p2.usuarioId = u.id)
        ");
        return $stmt->fetchAll();
    }

    public function listarEstadoPagosPorCliente($idCliente) {
        $stmt = $this->conn->conn->prepare("
            SELECT p.id, u.nombre, m.tipoMembresia, 
                   CASE 
                       WHEN p.id IS NOT NULL THEN 'Pagado'
                       ELSE 'No Pagado'
                   END AS estadoPago,
                   p.fechaPago,
                   DATEDIFF(m.fechaFin, CURDATE()) AS diasRestantes
            FROM usuario u
            LEFT JOIN pagos p ON u.id = p.usuarioId
            LEFT JOIN membresias m ON p.membresiaId = m.membresiaId
            WHERE u.id = ?
            GROUP BY u.id, u.nombre, m.tipoMembresia, p.fechaPago, m.fechaFin
            HAVING p.fechaPago = (SELECT MAX(fechaPago) FROM pagos p2 WHERE p2.usuarioId = u.id)
        ");
        $stmt->execute([$idCliente]);
        return $stmt->fetchAll();
    }
}
?>