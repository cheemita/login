<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'create') {
            // Lógica para crear un nuevo usuario
            if (
                isset($_POST['nombre']) &&
                isset($_POST['apellido']) &&
                isset($_POST['email'])
            ) {
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $email = $_POST['email'];

                // Insertar los datos en la base de datos
                $sql = "INSERT INTO usuarios (nombre, apellido, email) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $nombre, $apellido, $email);
                
                if ($stmt->execute()) {
                    echo "Usuario creado con éxito";
                } else {
                    echo "Error al crear el usuario";
                }
            } else {
                echo "Faltan datos para crear el usuario";
            }
        } elseif ($action === 'read' || $action === 'HEAD') {
            // Lógica para mostrar usuarios en la tabla
            $sql = "SELECT * FROM usuarios";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $rows = array();
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                echo json_encode($rows);
            } else {
                echo json_encode(array());
            }
        } elseif ($action === 'update') {
            // Lógica para actualizar un usuario
            if (isset($_POST['userId']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email'])) {
                $userId = $_POST['userId'];
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $email = $_POST['email'];

                // Actualizar los datos en la base de datos
                $sql = "UPDATE usuarios SET nombre = ?, apellido = ?, email = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssi", $nombre, $apellido, $email, $userId);

                if ($stmt->execute()) {
                    echo "Usuario actualizado con éxito";
                } else {
                    echo "Error al actualizar el usuario";
                }
            } else {
                echo "No se han proporcionado datos completos para actualizar el usuario";
            } 
        }    
            elseif ($action === 'delete') {
            // Lógica para eliminar un usuario
            if (isset($_POST['userId'])) {
                $userId = $_POST['userId'];

                $sql = "DELETE FROM usuarios WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $userId);
                
                if ($stmt->execute()) {
                    echo "Usuario eliminado con éxito";
                } else {
                    echo "Error al eliminar el usuario";
                }
            } else {
                echo "No se ha proporcionado un ID de usuario para eliminar";
            }
        }
        elseif ($_SERVER["REQUEST_METHOD"] == "HEAD") {
            ob_end_clean(); 

            echo "Método HEAD no está implementado";
        }
        elseif ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
            
            header("HTTP/1.1 200 OK");
            
            exit;
            echo "Método OPTIONS no está implementado";
        }
        elseif ($_SERVER["REQUEST_METHOD"] == "TRACE") {
            $response = 'TRACE request received: ' . print_r($_REQUEST, true);

            echo "Método TRACE no está implementado";
        }
        elseif ($_SERVER["REQUEST_METHOD"] == "LINK") {
            $linkHeader = $_SERVER['HTTP_LINK'];
            
            echo "Método LINK no está implementado";
        }
        
    }
}
$conn->close();
?>