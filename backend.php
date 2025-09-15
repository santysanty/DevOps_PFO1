<?php

// Script para recibir datos del frontend

$datos_json = file_get_contents("php://input");
$datos = json_decode($datos_json, true);

if ($datos === null) {
    echo json_encode(["status" => "error", "message" => "Error al decodificar JSON"]);
    exit;
}

$username = $datos["username"] ?? null;
$password = $datos["password"] ?? null;

if ($username && $password) {
    // Simulación de verificación de datos
    if ($username === "admin" && $password === "1234") {
        echo json_encode(["status" => "ok", "message" => "Usuario y contraseña correctos"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Usuario o contraseña incorrectos"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Faltan datos (username o password)"]);
}

?>