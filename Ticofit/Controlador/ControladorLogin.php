<?php
require_once '../Modelo/Conexio.php';

class ControladorLogin {
    private $conn;

    public function __construct() {
        $this->conn = new Conexio();
    }

    public function validarLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            error_log("Email recibido: $email, Password recibido: $password");

            $stmt = $this->conn->conn->prepare("SELECT id, nombre, apellido, contraseña, rol FROM usuario WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            error_log("Usuario encontrado: " . print_r($user, true));

            if ($user && $password === $user['contraseña']) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['rol'] = $user['rol'];
                $_SESSION['nombre_completo'] = trim($user['nombre'] . ' ' . (isset($user['apellido']) ? $user['apellido'] : ''));
                header("Location: ../Vista/Dashboard.php");
                exit();
            } else {
                error_log("Login falló: " . ($user ? "Contraseña no coincide" : "Usuario no encontrado"));
                return "Usuario o contraseña incorrectos.";
            }
        }
        return "";
    }
}
?>