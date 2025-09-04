<?php
// Verificación de archivo
$controllerPath = '../Controlador/ControladorDashboard.php';
if (!file_exists($controllerPath)) {
    die('Error: Archivo ' . $controllerPath . ' no encontrado. Verifica la ruta o crea el archivo.');
}
require_once $controllerPath;

try {
    $controlador = new ControladorDashboard();
    $rol = $controlador->verificarSesion();
    $controlador->cerrarSesion();
} catch (Exception $e) {
    die('Error al instanciar ControladorDashboard: ' . $e->getMessage() . ' (Línea: ' . $e->getLine() . ')');
}

// Iniciar sesión si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configuración del tema
$permitidos = array('light', 'dark');
$valor = isset($_COOKIE['ticofit_theme']) ? $_COOKIE['ticofit_theme'] : null;

if (!is_string($valor)) {
    $theme = 'light';
} else {
    $valor = trim($valor);
    $valor = strtolower($valor);
    $theme = in_array($valor, $permitidos, true) ? $valor : 'light';
}

$nombre = isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo'] : '';
$rolSafe = isset($rol) ? htmlspecialchars($rol, ENT_QUOTES, 'UTF-8') : '';
$nombreSafe = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html lang="es" class="<?php echo $theme; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Ticofit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { background-color: #f5f7fa; transition: background-color 0.3s; font-family: 'Arial', sans-serif; }
        .light { background-color: #f5f7fa; color: #2c3e50; }
        .dark { background-color: #1a252f; color: #ecf0f1; }
        .sidebar { width: 220px; position: fixed; top: 0; left: 0; height: 100vh; background-color: #1c2526; padding: 10px; }
        .sidebar-menu { padding: 0; margin: 0; list-style: none; }
        .sidebar-menu a { color: #fff; text-decoration: none; display: flex; align-items: center; padding: 8px 12px; border-radius: 4px; font-size: 0.9rem; transition: background-color 0.3s; }
        .sidebar-menu a i { margin-right: 8px; }
        .sidebar-menu a:hover { background-color: #34495e; color: #fff; }
        .content { margin-left: 230px; padding: 10px; display: flex; flex-wrap: wrap; gap: 10px; }
        .dashboard-card { background-color: #fff; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 10px; margin: 5px; flex: 1 1 calc(33.33% - 10px); min-width: 200px; }
        .dark .dashboard-card { background-color: #2c3e50; }
        .clock-digital { font-size: 1.5rem; font-weight: bold; color: #27ae60; text-align: center; padding: 8px; border-radius: 6px; }
        .dark .clock-digital { color: #2ecc71; }
        .calendar { padding: 8px; border-radius: 6px; }
        .calendar-header { font-size: 1rem; font-weight: bold; margin-bottom: 5px; display: flex; justify-content: space-between; align-items: center; }
        .calendar-nav { cursor: pointer; font-size: 0.9rem; padding: 3px 6px; border-radius: 4px; background-color: #ecf0f1; }
        .calendar-nav:hover { background-color: #ddd; }
        .dark .calendar-nav { background-color: #34495e; }
        .dark .calendar-nav:hover { background-color: #465c71; }
        .calendar-days { display: grid; grid-template-columns: repeat(7, 1fr); gap: 2px; }
        .calendar-day { padding: 5px; text-align: center; border-radius: 4px; cursor: pointer; font-size: 0.8rem; background-color: #ecf0f1; }
        .calendar-day.header { background-color: #8e44ad; color: white; font-weight: bold; }
        .calendar-day.today { background-color: #27ae60; color: white; }
        .calendar-day.selected { background-color: #8e44ad; color: white; }
        .calendar-day.holiday { background-color: #e74c3c; color: white; }
        .dark .calendar-day { background-color: #34495e; }
        .dark .calendar-day.header { background-color: #9b59b6; }
        .dark .calendar-day.today { background-color: #27ae60; }
        .dark .calendar-day.selected { background-color: #9b59b6; }
        .dark .calendar-day.holiday { background-color: #c0392b; }
        .quick-actions .btn { min-width: 120px; padding: 4px 8px; font-size: 0.9rem; margin: 3px; }
        .navigation-cards .card { border: none; border-radius: 8px; transition: transform 0.2s; background-color: #fff; padding: 8px; }
        .navigation-cards .card:hover { transform: scale(1.03); }
        .dark .navigation-cards .card { background-color: #2c3e50; }
        .btn { transition: all 0.3s; font-size: 0.9rem; }
        .btn:hover { opacity: 0.9; }
        .card-body { padding: 5px; }
        .card-title { font-size: 1rem; }
        .card-text { font-size: 0.8rem; }
    </style>
</head>
<body>
<div class="sidebar">
    <h5 class="text-center text-white mb-2">Ticofit</h5>
    <ul class="sidebar-menu">
        <?php if ($rol): ?>
            <?php if ($rol === 'admin'): ?>
                <li><a href="../Vista/Login.php"><i class="fas fa-sign-in-alt"></i> Identificarse</a></li>
                <li><a href="Registro.php"><i class="fas fa-user-plus"></i> Registrarse</a></li>
                <li><a href="CambiarPassword.php"><i class="fas fa-key"></i> Cambiar Contraseña</a></li>
                <li><a href="Asistencia.php"><i class="fas fa-check"></i> Asistencia</a></li>
                <li><a href="Clase.php"><i class="fas fa-calendar-alt"></i> Clases</a></li>
                <li><a href="Clientes.php"><i class="fas fa-users"></i> Clientes</a></li>
                <li><a href="Ejercicio.php"><i class="fas fa-dumbbell"></i> Ejercicios</a></li>
                <li><a href="Entrenadores.php"><i class="fas fa-chalkboard-teacher"></i> Entrenadores</a></li>
                <li><a href="Membresias.php"><i class="fas fa-id-card"></i> Membresías</a></li>
                <li><a href="pago.php"><i class="fas fa-money-bill-wave"></i> Pagos</a></li>
                <li><a href="EstadoPagos.php"><i class="fas fa-money-check-alt"></i> Estado de Pagos</a></li>
                <li><a href="PlanEntrenamiento.php"><i class="fas fa-chart-line"></i> Planes de Entrenamiento</a></li>
                <li><a href="Reporte.php"><i class="fas fa-chart-pie"></i> Reportes</a></li>
                <li><a href="Rutina.php"><i class="fas fa-list"></i> Rutinas</a></li>
                <li><a href="Inventario.php"><i class="fas fa-box"></i> Gestión de Inventario</a></li>
                <li><a href="Configuracion.php"><i class="fas fa-cog"></i> Configuración</a></li>
            <?php elseif ($rol === 'entrenador'): ?>
                <li><a href="Asistencia.php"><i class="fas fa-check"></i> Asistencia</a></li>
                <li><a href="Clase.php"><i class="fas fa-calendar-alt"></i> Clases</a></li>
                <li><a href="Ejercicio.php"><i class="fas fa-dumbbell"></i> Ejercicios</a></li>
                <li><a href="PlanEntrenamiento.php"><i class="fas fa-chart-line"></i> Planes de Entrenamiento</a></li>
                <li><a href="Rutina.php"><i class="fas fa-list"></i> Rutinas</a></li>
                <li><a href="Clientes.php"><i class="fas fa-users"></i> Clientes</a></li>
                <li><a href="Inventario.php"><i class="fas fa-box"></i> Gestión de Inventario</a></li>
                <li><a href="Configuracion.php"><i class="fas fa-cog"></i> Configuración</a></li>
            <?php elseif ($rol === 'cliente'): ?>
                <li><a href="Clase.php"><i class="fas fa-calendar-alt"></i> Clases</a></li>
                <li><a href="Membresias.php"><i class="fas fa-id-card"></i> Membresías</a></li>
                <li><a href="pago.php"><i class="fas fa-money-bill-wave"></i> Pagos</a></li>
                <li><a href="EstadoPagos.php"><i class="fas fa-money-check-alt"></i> Estado de Pagos</a></li>
                <li><a href="Rutina.php"><i class="fas fa-list"></i> Rutinas</a></li>
                <li><a href="Configuracion.php"><i class="fas fa-cog"></i> Configuración</a></li>
            <?php endif; ?>
        <?php else: ?>
            <li><p class="text-white">No tienes acceso a opciones específicas. Contacta al administrador.</p></li>
        <?php endif; ?>
    </ul>
</div>
<div class="content">
    <?php if ($rol): ?>
        <!-- Bienvenida según el rol -->
        <div class="dashboard-card">
            <h2 class="mb-2">
                <?php
                if ($rol === 'admin') {
                    echo "Bienvenido a Ticofit, " . trim($nombreSafe . ' (' . $rolSafe . ')') . "! Administra el gimnasio.";
                } elseif ($rol === 'entrenador') {
                    echo "Bienvenido a Ticofit, " . trim($nombreSafe . ' (' . $rolSafe . ')') . "! Gestiona tus clases y clientes.";
                } elseif ($rol === 'cliente') {
                    echo "Bienvenido a Ticofit, " . trim($nombreSafe . ' (' . $rolSafe . ')') . "! Explora tus servicios.";
                }
                ?>
            </h2>
            <div class="clock-digital" id="clock-digital">Cargando reloj...</div>
        </div>

        <!-- Contenido según el rol -->
        <?php if ($rol === 'admin'): ?>
            <div class="dashboard-card">
                <p class="mb-2">Administra todas las operaciones del gimnasio y genera reportes detallados.</p>
                <h3 class="mb-2">Acciones Rápidas</h3>
                <div class="quick-actions">
                    <a href="Registro.php" class="btn btn-success"><i class="fas fa-user-plus"></i> Registrarse</a>
                    <a href="Clase.php" class="btn btn-primary"><i class="fas fa-calendar-alt"></i> Clases</a>
                    <a href="Entrenadores.php" class="btn btn-info"><i class="fas fa-chalkboard-teacher"></i> Entrenadores</a>
                    <a href="Membresias.php" class="btn btn-warning"><i class="fas fa-id-card"></i> Membresías</a>
                    <a href="pago.php" class="btn btn-danger"><i class="fas fa-money-bill-wave"></i> Pagos</a>
                </div>
            </div>

            <div class="dashboard-card">
                <h3 class="mb-2">Calendario</h3>
                <div class="calendar" id="calendar-container"></div>
            </div>

            <div class="dashboard-card">
                <h3 class="mb-2">Navegación Rápida</h3>
                <div class="navigation-cards" style="display: flex; flex-wrap: wrap; gap: 5px;">
                    <div class="card dashboard-card" style="flex: 1 1 calc(33.33% - 5px);">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-lg mb-1" style="color: #3498db;"></i>
                            <h5 class="card-title">Gestión de Clientes</h5>
                            <p class="card-text">Administrar clientes.</p>
                            <a href="Clientes.php" class="btn btn-primary btn-sm">Ir</a>
                        </div>
                    </div>
                    <div class="card dashboard-card" style="flex: 1 1 calc(33.33% - 5px);">
                        <div class="card-body text-center">
                            <i class="fas fa-id-card fa-lg mb-1" style="color: #e67e22;"></i>
                            <h5 class="card-title">Gestión de Membresías</h5>
                            <p class="card-text">Administrar membresías.</p>
                            <a href="Membresias.php" class="btn btn-primary btn-sm">Ir</a>
                        </div>
                    </div>
                    <div class="card dashboard-card" style="flex: 1 1 calc(33.33% - 5px);">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-alt fa-lg mb-1" style="color: #2ecc71;"></i>
                            <h5 class="card-title">Gestión de Clases</h5>
                            <p class="card-text">Programar clases.</p>
                            <a href="Clase.php" class="btn btn-primary btn-sm">Ir</a>
                        </div>
                    </div>
                    <div class="card dashboard-card" style="flex: 1 1 calc(33.33% - 5px);">
                        <div class="card-body text-center">
                            <i class="fas fa-list fa-lg mb-1" style="color: #9b59b6;"></i>
                            <h5 class="card-title">Gestión de Rutinas</h5>
                            <p class="card-text">Crear rutinas.</p>
                            <a href="Rutina.php" class="btn btn-primary btn-sm">Ir</a>
                        </div>
                    </div>
                    <div class="card dashboard-card" style="flex: 1 1 calc(33.33% - 5px);">
                        <div class="card-body text-center">
                            <i class="fas fa-money-bill-wave fa-lg mb-1" style="color: #e74c3c;"></i>
                            <h5 class="card-title">Gestión de Pagos</h5>
                            <p class="card-text">Registrar pagos.</p>
                            <a href="pago.php" class="btn btn-primary btn-sm">Ir</a>
                        </div>
                    </div>
                    <div class="card dashboard-card" style="flex: 1 1 calc(33.33% - 5px);">
                        <div class="card-body text-center">
                            <i class="fas fa-box fa-lg mb-1" style="color: #f1c40f;"></i>
                            <h5 class="card-title">Gestión de Inventario</h5>
                            <p class="card-text">Control de equipos.</p>
                            <a href="Inventario.php" class="btn btn-primary btn-sm">Ir</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ($rol === 'entrenador'): ?>
            <div class="dashboard-card">
                <p class="mb-2">Gestiona tus clases, entrenamientos y el progreso de tus clientes.</p>
                <h3 class="mb-2">Acciones Rápidas</h3>
                <div class="quick-actions">
                    <a href="Clase.php" class="btn btn-primary"><i class="fas fa-calendar-alt"></i> Clases</a>
                    <a href="PlanEntrenamiento.php" class="btn btn-success"><i class="fas fa-chart-line"></i> Planes de Entrenamiento</a>
                    <a href="Rutina.php" class="btn btn-info"><i class="fas fa-list"></i> Rutinas</a>
                </div>
            </div>

            <div class="dashboard-card">
                <h3 class="mb-2">Calendario</h3>
                <div class="calendar" id="calendar-container"></div>
            </div>

            <div class="dashboard-card">
                <h3 class="mb-2">Navegación Rápida</h3>
                <div class="navigation-cards" style="display: flex; flex-wrap: wrap; gap: 5px;">
                    <div class="card dashboard-card" style="flex: 1 1 calc(33.33% - 5px);">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-alt fa-lg mb-1" style="color: #2ecc71;"></i>
                            <h5 class="card-title">Gestión de Clases</h5>
                            <p class="card-text">Programar clases.</p>
                            <a href="Clase.php" class="btn btn-primary btn-sm">Ir</a>
                        </div>
                    </div>
                    <div class="card dashboard-card" style="flex: 1 1 calc(33.33% - 5px);">
                        <div class="card-body text-center">
                            <i class="fas fa-list fa-lg mb-1" style="color: #9b59b6;"></i>
                            <h5 class="card-title">Gestión de Rutinas</h5>
                            <p class="card-text">Crear rutinas.</p>
                            <a href="Rutina.php" class="btn btn-primary btn-sm">Ir</a>
                        </div>
                    </div>
                    <div class="card dashboard-card" style="flex: 1 1 calc(33.33% - 5px);">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-lg mb-1" style="color: #3498db;"></i>
                            <h5 class="card-title">Gestión de Clientes</h5>
                            <p class="card-text">Ver progreso.</p>
                            <a href="Clientes.php" class="btn btn-primary btn-sm">Ir</a>
                        </div>
                    </div>
                    <div class="card dashboard-card" style="flex: 1 1 calc(33.33% - 5px);">
                        <div class="card-body text-center">
                            <i class="fas fa-box fa-lg mb-1" style="color: #f1c40f;"></i>
                            <h5 class="card-title">Gestión de Inventario</h5>
                            <p class="card-text">Control de equipos.</p>
                            <a href="Inventario.php" class="btn btn-primary btn-sm">Ir</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php elseif ($rol === 'cliente'): ?>
            <div class="dashboard-card">
                <p class="mb-2">Explora tus clases, rutinas y gestiona tus pagos y membresías.</p>
                <h3 class="mb-2">Acciones Rápidas</h3>
                <div class="quick-actions">
                    <a href="Clase.php" class="btn btn-primary"><i class="fas fa-calendar-alt"></i> Clases</a>
                    <a href="Membresias.php" class="btn btn-warning"><i class="fas fa-id-card"></i> Membresías</a>
                    <a href="pago.php" class="btn btn-danger"><i class="fas fa-money-bill-wave"></i> Pagos</a>
                </div>
            </div>

            <div class="dashboard-card">
                <h3 class="mb-2">Calendario</h3>
                <div class="calendar" id="calendar-container"></div>
            </div>

            <div class="dashboard-card">
                <h3 class="mb-2">Navegación Rápida</h3>
                <div class="navigation-cards" style="display: flex; flex-wrap: wrap; gap: 5px;">
                    <div class="card dashboard-card" style="flex: 1 1 calc(33.33% - 5px);">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-alt fa-lg mb-1" style="color: #2ecc71;"></i>
                            <h5 class="card-title">Gestión de Clases</h5>
                            <p class="card-text">Ver tus clases.</p>
                            <a href="Clase.php" class="btn btn-primary btn-sm">Ir</a>
                        </div>
                    </div>
                    <div class="card dashboard-card" style="flex: 1 1 calc(33.33% - 5px);">
                        <div class="card-body text-center">
                            <i class="fas fa-id-card fa-lg mb-1" style="color: #e67e22;"></i>
                            <h5 class="card-title">Gestión de Membresías</h5>
                            <p class="card-text">Administrar membresías.</p>
                            <a href="Membresias.php" class="btn btn-primary btn-sm">Ir</a>
                        </div>
                    </div>
                    <div class="card dashboard-card" style="flex: 1 1 calc(33.33% - 5px);">
                        <div class="card-body text-center">
                            <i class="fas fa-money-bill-wave fa-lg mb-1" style="color: #e74c3c;"></i>
                            <h5 class="card-title">Gestión de Pagos</h5>
                            <p class="card-text">Registrar pagos.</p>
                            <a href="pago.php" class="btn btn-primary btn-sm">Ir</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <div class="dashboard-card">
                <p class="mb-2">Por favor, inicia sesión para acceder a las opciones.</p>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Reloj Digital de 12 Horas
    function updateClock() {
        const now = new Date();
        const cstOffset = -6; // CST es UTC-6
        const localTime = new Date(now.getTime() + (cstOffset * 60 * 60 * 1000));
        let hours = localTime.getUTCHours();
        const minutes = localTime.getUTCMinutes().toString().padStart(2, '0');
        const seconds = localTime.getUTCSeconds().toString().padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // Convertir 0 a 12
        const timeStr = `${hours}:${minutes}:${seconds} ${ampm} CST`;
        document.getElementById('clock-digital').textContent = timeStr;
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Calendario Interactivo para 2025
    let currentMonth = new Date().getMonth();
    let selectedDate = null;
    const holidays2025CR = {
        '01-01': 'Año Nuevo',
        '04-17': 'Jueves Santo',
        '04-18': 'Viernes Santo',
        '04-21': 'Día de Juan Santamaría',
        '05-01': 'Día del Trabajador',
        '07-25': 'Anexión del Partido de Nicoya',
        '08-02': 'Virgen de los Ángeles',
        '09-15': 'Día de la Independencia',
        '10-12': 'Día de las Culturas',
        '12-25': 'Navidad'
    };

    function generateCalendar(month = currentMonth, year = 2025) {
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const daysInMonth = lastDay.getDate();
        const startDay = firstDay.getDay();
        const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        let calendarHTML = `<div class="calendar-header">
            <span class="calendar-nav" onclick="changeMonth(-1)">&lt;</span>
            ${months[month]} ${year}
            <span class="calendar-nav" onclick="changeMonth(1)">&gt;</span>
        </div>`;
        calendarHTML += '<div class="calendar-days">';
        const days = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];

        for (let day of days) {
            calendarHTML += `<div class="calendar-day header">${day}</div>`;
        }

        for (let i = 0; i < startDay; i++) {
            calendarHTML += '<div class="calendar-day"></div>';
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dateStr = `${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const isToday = day === new Date().getDate() && month === new Date().getMonth() && year === new Date().getFullYear();
            const isHoliday = holidays2025CR[dateStr];
            const isSelected = selectedDate === `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const tooltip = isHoliday ? `data-bs-toggle="tooltip" data-bs-placement="top" title="${isHoliday}"` : '';
            calendarHTML += `<div class="calendar-day ${isToday ? 'today' : ''} ${isHoliday ? 'holiday' : ''} ${isSelected ? 'selected' : ''}" ${tooltip} onclick="selectDate(${year}, ${month + 1}, ${day})">${day}</div>`;
        }

        const totalCells = startDay + daysInMonth;
        for (let i = totalCells; i < 42; i++) {
            calendarHTML += '<div class="calendar-day"></div>';
        }

        calendarHTML += '</div>';
        document.getElementById('calendar-container').innerHTML = calendarHTML;

        // Inicializar tooltips de Bootstrap
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltipTriggerList.forEach(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    }

    function changeMonth(offset) {
        currentMonth += offset;
        if (currentMonth < 0) currentMonth = 11; // Volver a diciembre
        if (currentMonth > 11) currentMonth = 0; // Volver a enero
        generateCalendar(currentMonth, 2025);
    }

    function selectDate(year, month, day) {
        selectedDate = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        generateCalendar(month - 1, year); // Recargar con la fecha seleccionada
        alert(`Fecha seleccionada: ${selectedDate}`);
    }

    // Generar calendario inicial para el mes actual de 2025
    generateCalendar(currentMonth, 2025);
</script>
</body>
</html>