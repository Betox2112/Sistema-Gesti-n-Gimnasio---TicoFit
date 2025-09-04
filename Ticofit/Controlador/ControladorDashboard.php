<?php
session_start();

class ControladorDashboard {
    public function verificarSesion() {
        if (isset($_SESSION['user_id'])) {
            return $_SESSION['rol'];
        }
        return null;
    }

    public function cerrarSesion() {
        if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
            session_destroy();
            header("Location: ../Vista/Login.php");
            exit();
        }
    }
}