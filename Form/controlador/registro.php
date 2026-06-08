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
        $_SESSION["form_data"] = $_POST; // Guardamos datos por si hay error
        $nombre = trim($_POST["nombre"]);
        $apellido = trim($_POST["apellido"]);
        $correo = trim($_POST["correo"]);
        $contrasena = $_POST["contrasena"];
        $nombreJugador = trim($_POST["nombreJugador"]);
        // --- VALIDACIONES ---
        // A. Verificar campos vacíos
        if (empty($nombre) || empty($apellido) || empty($correo) || empty($contrasena) || empty($nombreJugador)) {
            $_SESSION["mensaje_error"] = "Todos los campos son obligatorios.";
            header("Location: ../vista/index.php");
            exit();
        }
        // B. Verificar duplicado de CORREO
        $checkEmail = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE correo = :correo");
        $checkEmail->execute([':correo' => $correo]);
        if ($checkEmail->fetchColumn() > 0) {
            $_SESSION["mensaje_error"] = "El correo <strong>$correo</strong> ya está registrado.";
            header("Location: ../vista/index.php");
            exit();
        }
        // C. NUEVO: Verificar duplicado de NOMBRE DE JUGADOR
        $checkPlayer = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE nombreJugador = :nombreJugador");
        $checkPlayer->execute([':nombreJugador' => $nombreJugador]);
        if ($checkPlayer->fetchColumn() > 0) {
            $_SESSION["mensaje_error"] = "El nombre de jugador <strong>$nombreJugador</strong> ya está en uso. Elige otro.";
            header("Location: ../vista/index.php");
            exit();
        }
        // --- INSERCIÓN (Si todo pasó) ---
        $sql = "INSERT INTO usuarios (nombre, apellido, correo, contrasena, nombreJugador)
                VALUES (:nombre, :apellido, :correo, :contrasena, :nombreJugador)";
        
        $stmt = $pdo->prepare($sql);
        $res = $stmt->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':correo' => $correo,
            ':contrasena' => $contrasena,
            ':nombreJugador' => $nombreJugador
        ]);
        if ($res) {
            $_SESSION["mensaje_exito"] = "¡Cuenta creada con éxito! Ya puedes jugar.";
            unset($_SESSION["form_data"]); // Limpiamos el formulario
            header("Location: ../vista/index.php");
            exit();
        }
    }
} catch (PDOException $e) {
    $_SESSION["mensaje_error"] = "Error crítico: " . $e->getMessage();
    header("Location: ../vista/index.php");
    exit();
}