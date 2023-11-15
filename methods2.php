<?php
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "HEAD":
        header("Access-Control-Allow-Origin: *");
        header("hello");
        echo "Método HEAD no está implementado";
        break;

    case "OPTIONS":
        header("Access-Control-Allow-Origin: *");
        header("hello");
        break;

    case "TRACE":
        // Lógica para manejar el método TRACE
        $response = 'TRACE request received: ' . print_r($_REQUEST, true);
        echo "Método TRACE no está implementado";
        break;

    case "LINK":
        // Lógica para manejar el método LINK
        $linkHeader = $_SERVER['HTTP_LINK'];
        echo "Método LINK no está implementado";
        break;
}
?>
