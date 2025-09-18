<?php
// backend.php

// Asegurarse de que el servidor solo acepte solicitudes POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el cuerpo de la solicitud (los datos JSON enviados por el frontend)
    $json_data = file_get_contents('php://input');

    // Decodificar el JSON a un objeto PHP
    $data = json_decode($json_data);

    // Definir la respuesta por defecto
    $response = [
        'status' => 'error',
        'message' => 'Hubo un error al procesar la solicitud.'
    ];

    // Verificar si se recibieron los datos esperados
    if (isset($data->username)) {
        $username = trim($data->username);

        // Realizar la validación del backend
        // En este caso, solo verificamos que el nombre de usuario no esté vacío
        if (!empty($username)) {
            // Si la validación es exitosa
            $response['status'] = 'ok';
            $response['message'] = 'Datos recibidos y validados correctamente para el usuario: ' . htmlspecialchars($username);
        } else {
            // Si el nombre de usuario está vacío
            $response['message'] = 'El nombre de usuario no puede estar vacío.';
        }
    } else {
        // Si los datos esperados no se encontraron en la solicitud
        $response['message'] = 'Datos incompletos o incorrectos.';
    }

    // Configurar la cabecera de la respuesta como JSON
    header('Content-Type: application/json');

    // Enviar la respuesta en formato JSON al frontend
    echo json_encode($response);
} else {
    // Si no es una solicitud POST, devolver un error
    header('HTTP/1.1 405 Method Not Allowed');
    echo 'Método no permitido.';
}