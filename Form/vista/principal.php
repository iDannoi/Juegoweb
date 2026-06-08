<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: acceso.php");
    exit();
}

// Opcional: Guardamos el nombre del jugador en una variable para usarlo en el saludo
$nombreJugador = $_SESSION['nombreJugador'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Kanguroo korp - Principal</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg shadow" style="background-color: #FAACBF;">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Kanguroo Korp</a>
            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" 
                data-bs-target="#menu"
                aria-controls="menu" 
                aria-expanded="false" 
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span> 
            </button>
            
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto text-center">
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-danger" href="../controlador/logout.php">Cerrar sesión</a> 
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="display-4 fw-bold">¡Bienvenido de vuelta, <?php echo htmlspecialchars($nombreJugador); ?>!</h1>
            <p class="lead text-muted">Has ingresado correctamente a la zona principal de Kanguroo Korp.</p>
        </div>
    </div>
</main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>