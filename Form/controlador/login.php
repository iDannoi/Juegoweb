<?php
session_start();

$host = "localhost";
$dbname = "juegoweb";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $correo = trim($_POST["correo"]);
        $contrasena = $_POST["contrasena"];
        if (empty($correo) || empty($contrasena)) {
            $_SESSION["login_error"] = "Por favor, llena todos los campos.";
            header("Location: ../vista/acceso.php");
            exit();
        }
        // Buscamos al usuario por su correo
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo = :correo LIMIT 1");
        $stmt->execute([':correo' => $correo]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        // Verificación de credenciales (Comparación directa según los datos de tu phpMyAdmin)
        if ($usuario && $usuario["contrasena"] === $contrasena) {
            
            // Definir Variables de Sesión
            $_SESSION["usuario_id"] = $usuario["ID"];
            $_SESSION["usuario_nombre"] = $usuario["nombreJugador"];
            $_SESSION["usuario_correo"] = $usuario["correo"];
            // Gestionar Cookie de "Recordar Usuario"
            if ($usuario) {
            // 1. Guardamos el ID en mayúsculas (como está en tu base de datos)
            $_SESSION['usuario_id'] = $usuario['ID']; 
            
            // 2. CORRECCIÓN AQUÍ: Guardamos el nombre usando exactamente la llave que busca principal.php
            $_SESSION['nombreJugador'] = $usuario['nombreJugador']; 
            // Manejo de la cookie "usuario_recordado"
            if (isset($_POST['recordar'])) {
                setcookie("usuario_recordado", $correo, time() + (30 * 24 * 60 * 60), "/");
            } else {
                setcookie("usuario_recordado", "", time() - 3600, "/");
            }
            // Redirección a la pantalla principal
            header("Location: ../vista/principal.php");
            exit();
        }
            // Acceso concedido al archivo principal
            header("Location: ../vista/principal.php");
            exit();
        } else {
            $_SESSION["login_error"] = "El correo electrónico o la contraseña son incorrectos.";
            header("Location: ../vista/acceso.php");
            exit();
        }
    }
} catch (PDOException $e) {
    $_SESSION["login_error"] = "Error de conexión: " . $e->getMessage();
    header("Location: ../vista/acceso.php");
    exit();
}