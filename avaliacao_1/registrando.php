<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $laboratorio = $_POST['laboratorio'];

if (!empty($laboratorio)) {
    $data = "Laboratório registrado: $laboratorio\n";

    file_put_contents('registros.txt', $data, FILE_APPEND);
        
        header("Location: registro.php");
        exit;
    } else {
        header("Location: formulario.html?erro=1");
        exit;
    }
}
?>