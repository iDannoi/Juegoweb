<?php
session_start();

// Leer mensajes de error del controlador
$mensaje_error = isset($_SESSION["login_error"]) ? $_SESSION["login_error"] : "";
$mensaje_exito = isset($_SESSION["login_exito"]) ? $_SESSION["login_exito"] : "";
unset($_SESSION["login_error"]);
unset($_SESSION["login_exito"]);

// Recordar usuario: Si la cookie existe, autocompletamos el campo de correo
$correo_guardado = isset($_COOKIE["usuario_recordado"]) ? $_COOKIE["usuario_recordado"] : "";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Acceso al Juego</title>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <div class="form-container-custom p-4 border rounded bg-light">
                    
                    <div class="d-flex justify-content-center mb-4">
                        <img src="logo.png" alt="imagen de kanguro" style="max-height: 120px;">
                    </div>

                    <h3 class="text-center mb-4">Iniciar Sesión</h3>

                    <?php if (!empty($mensaje_error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $mensaje_error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($mensaje_exito)): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $mensaje_exito; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="../controlador/login.php" method="POST" class="row g-3">
                        
                        <div class="col-12">
                            <label for="inputcorreo" class="form-label fw-semibold">Correo Electrónico <span>*</span></label>
                            <input type="email" class="form-control form-control-lg" id="inputcorreo" name="correo" placeholder="ejemplo@dominio.com" value="<?php echo htmlspecialchars($correo_guardado); ?>" required>
                        </div>

                        <div class="col-12">
                            <label for="inputcontrasena" class="form-label fw-semibold">Contraseña <span>*</span></label>
                            <input type="password" class="form-control form-control-lg" name="contrasena" id="inputcontrasena" required>
                        </div>

                        <div class="col-12 d-flex justify-content-between align-items-centermy-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="recordar" id="checkRecordar" <?php echo !empty($correo_guardado) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="checkRecordar">Recordarme</label>
                            </div>
                            <a href="recuperar.php" class="text-decoration-none text-primary small">¿Olvidaste tu acceso?</a>
                        </div>

                        <div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="reset" class="btn btn-outline-secondary">Limpiar</button>
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>