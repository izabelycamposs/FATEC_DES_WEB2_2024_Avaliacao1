<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$message = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $laboratorio = trim($_POST['laboratorio']);
    $data = trim($_POST['data']);
    $solicitacao = trim($_POST['solicitacao']);
    $curso = trim($_POST['curso']);

    if (!empty($laboratorio) && !empty($data) && !empty($solicitacao) && !empty($curso)) {
        $record = "Laboratório $laboratorio|$data|$solicitacao|$curso\n";
        $filename = 'registros.txt';

        if (is_writable($filename) || !file_exists($filename)) {
            file_put_contents($filename, $record, FILE_APPEND);
            $message = "Registro salvo com sucesso!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <title>Criando Registro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px Arial;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }
        .custom-select {
            width: 310px;
            margin-bottom: 15px; 
        }
        .page-header {
            width: 350px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
            position: relative;
        }
        .form-group {
            margin-bottom: 15px; 
        }
        .form-control {
            margin-bottom: 15px; 
        }
        h1, p {
            margin-bottom: 10px;
        }
        .logout-btn {
            display: inline-block;
            margin-top: 20px;
            text-align: center;
        }
        .btn-registrar {
            width: 100%;
            margin-top: 15px;
        }
        .message {
            margin-top: 15px;
            font-weight: bold;
        }
        .message.success {
            color: #28a745; 
        }
        .message.error {
            color: #dc3545; 
        }
        .logout-btn {
            position: absolute;
            bottom: 20px; 
            right: 20px; 
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Registrar</h1>
        <p>Laboratórios</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <select name="laboratorio" class="custom-select">
                <option value="">Selecione</option>
                <option value="Laboratório 1">Laboratório 1</option>
                <option value="Laboratório 2">Laboratório 2</option>
                <option value="Laboratório 3">Laboratório 3</option>
            </select>
            <div class="form-group">
                <label for="formGroupExampleInput">Data</label>
                <input type="text" name="data" class="form-control" id="formGroupExampleInput" placeholder="dd/mm/aaaa">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Solicitação</label>
                <input type="text" name="solicitacao" class="form-control" id="formGroupExampleInput2" placeholder="">
            </div>
            <div class="form-group">
                <p>Curso Atendido</p>
                <select name="curso" class="custom-select">
                    <option value="">Selecione</option>
                    <option value="DSM">DSM</option>
                    <option value="GE">GE</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-registrar">Registrar</button>
            </div>
            <?php if (!empty($message)) { ?>
                <div class="message <?php echo strpos($message, 'sucesso') !== false ? 'success' : 'error'; ?>">
                    <?php echo $message; ?>
                </div>
            <?php } ?>
        </form>
    </div>
    
    <a href="logout.php" class="btn btn-danger logout-btn">Logout</a>
</body>
</html>
