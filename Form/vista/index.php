<?php
// Iniciar sesión para leer los mensajes que dejó el controlador
session_start();

// Recuperar mensajes si existen, de lo contrario dejarlos vacíos
$mensaje_exito = isset($_SESSION["mensaje_exito"]) ? $_SESSION["mensaje_exito"] : "";
$mensaje_error = isset($_SESSION["mensaje_error"]) ? $_SESSION["mensaje_error"] : "";
$datos_guardados = isset($_SESSION["form_data"]) ? $_SESSION["form_data"] : [];

// Borrar los mensajes de la sesión para que no se queden fijos al recargar la página manualmente
unset($_SESSION["mensaje_exito"]);
unset($_SESSION["mensaje_error"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Registro de Usuarios</title>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <div class="form-container-custom">
                    
                    <div class="d-flex justify-content-center mb-4">
                        <img src="welcome.png" alt="imagen bienvenida">
                    </div>

                    <?php if (!empty($mensaje_exito)): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $mensaje_exito; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($mensaje_error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $mensaje_error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="../controlador/registro.php" method="POST" class="row g-3">
                        
                        <div class="col-md-6">
                            <label for="inputNombre" class="form-label fw-semibold">Nombre<span>*</span></label>
                            <input type="text" class="form-control form-control-lg" id="inputNombre" name="nombre" placeholder="Coloque su nombre" value="<?php echo isset($datos_guardados['nombre']) ? htmlspecialchars($datos_guardados['nombre']) : ''; ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="inputApellido" class="form-label fw-semibold">Apellido <span>*</span></label>
                            <input type="text" class="form-control form-control-lg" id="inputApellido" name="apellido" placeholder="Coloque su apellido" value="<?php echo isset($datos_guardados['apellido']) ? htmlspecialchars($datos_guardados['apellido']) : ''; ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="inputcorreo" class="form-label fw-semibold">Correo Electrónico <span>*</span></label>
                            <input type="email" class="form-control form-control-lg" id="inputcorreo" name="correo" placeholder="ejemplo@dominio.com" value="<?php echo isset($datos_guardados['correo']) ? htmlspecialchars($datos_guardados['correo']) : ''; ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="inputcontrasena" class="form-label fw-semibold">Contraseña <span>*</span></label>
                            <input type="password" class="form-control form-control-lg" name="contrasena" minlength="8" id="inputcontrasena" required>
                        </div>

                        <div class="col-12">
                            <label for="inputJugador" class="form-label fw-semibold">Nombre de Jugador <span>*</span></label>
                            <input type="text" class="form-control form-control-lg" id="inputJugador" name="nombreJugador" placeholder="Coloque su nombre" value="<?php echo isset($datos_guardados['nombreJugador']) ? htmlspecialchars($datos_guardados['nombreJugador']) : ''; ?>" required>
                        </div>

                        <div class="col-12">
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="terminos" value="aceptado" id="checkTerminos" required>
                                <label class="form-check-label" for="checkTerminos">
                                    Acepto los <a href="#" class="text-decoration-none text-primary fw-medium">Términos y condiciones</a> <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="reset" class="btn btn-outline-secondary">Limpiar campos</button>
                            <button type="submit" class="btn btn-primary">Enviar formulario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>