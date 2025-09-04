<?php
require_once '../Modelo/Conexio.php';

class ControladorRegistro {
    private $conn;

    public function __construct() {
        $this->conn = new Conexio();
    }

    public function procesarRegistro() {
        if (isset($_POST['register'])) {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellidos'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $preferencias = $_POST['preferencias'];
            $tipoMembresia = $_POST['tipoMembresia'];
            $celular = $_POST['celular'];
            $cedula = $_POST['cedula'];

            // Verificar si el email ya existe
            $stmtCheck = $this->conn->conn->prepare("SELECT id FROM usuario WHERE email = :email");
            $stmtCheck->execute(['email' => $email]);
            if ($stmtCheck->rowCount() > 0) {
                return "El email ya está registrado.";
            }

            // Insertar en usuario (contraseña en texto plano)
            $stmtUsuario = $this->conn->conn->prepare("INSERT INTO usuario (nombre, apellido, contraseña, email, registroFecha, rol) VALUES (:nombre, :apellido, :password, :email, NOW(), 'cliente')");
            $stmtUsuario->execute(['nombre' => $nombre, 'apellido' => $apellido, 'password' => $password, 'email' => $email]);
            $idUsuario = $this->conn->conn->lastInsertId();

            // Verificar si el idUsuario ya existe en cliente para evitar duplicados
            $stmtCheckCliente = $this->conn->conn->prepare("SELECT clienteId FROM cliente WHERE idUsuario = :idUsuario");
            $stmtCheckCliente->execute(['idUsuario' => $idUsuario]);
            if ($stmtCheckCliente->rowCount() == 0) {
                // Insertar en cliente solo si no existe
                $stmtCliente = $this->conn->conn->prepare("INSERT INTO cliente (idUsuario, preferencias, celular) VALUES (:idUsuario, :preferencias, :celular)");
                $stmtCliente->execute(['idUsuario' => $idUsuario, 'preferencias' => $preferencias, 'celular' => $celular]);
            }

            // Insertar membresía
            $costo = ($tipoMembresia === 'Mensual') ? 29.99 : 49.99;
            $fechaFin = ($tipoMembresia === 'Mensual') ? date('Y-m-d', strtotime('+1 month')) : date('Y-m-d', strtotime('+1 year'));
            $stmtMembresia = $this->conn->conn->prepare("INSERT INTO membresias (tipoMembresia, costo, fechaInicio, fechaFin) VALUES (:tipoMembresia, :costo, NOW(), :fechaFin)");
            $stmtMembresia->execute(['tipoMembresia' => $tipoMembresia, 'costo' => $costo, 'fechaFin' => $fechaFin]);

            return "Registro exitoso. Serás contactado por un administrador pronto.";
        }

        // Preservar creación de tabla solicitudes_registro
        $this->conn->conn->exec("CREATE TABLE IF NOT EXISTS solicitudes_registro (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(255) NOT NULL,
            apellido VARCHAR(255) DEFAULT NULL,
            email VARCHAR(255) NOT NULL,
            preferencias TEXT DEFAULT NULL,
            tipoMembresia VARCHAR(255) NOT NULL,
            fechaSolicitud DATETIME DEFAULT NULL
        )");
        return null;
    }
}
?>