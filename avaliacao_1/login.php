<?php
$credentials = [
    'coordenador' => 'coordenador123',
    'tecnico' => 'tecnico123'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];

if (isset($credentials[$username]) && $credentials[$username] === $password) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;

if ($username === 'coordenador') {
header('Location: registro.php');
} 
elseif ($username === 'tecnico') {
header('Location: registros.txt');
}
exit(); 
}
}
?>


 <!DOCTYPE html>
 <html lang="pt_BR">
 <head>
     <meta charset="UTF-8">
     <title>Acessar</title>
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
         .wrapper {
             width: 350px;
             padding: 20px;
             background-color: #fff;
             border-radius: 8px;
             box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
         }
         .form-group button {
             width: 100%;
         }
     </style>
 </head>
 <body>
     <div class="wrapper">
         <h2>Login</h2>
         <p>Favor inserir login e senha</p>
         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
             <div class="form-group">
                 <label>Nome de Login</label>
                 <input type="text" name="username" class="form-control" required>
                 <span class="help-block"></span>
             </div>    
             <div class="form-group">
                 <label>Senha</label>
                 <input type="password" name="password" class="form-control" required>
                 <span class="help-block"></span>
             </div>
             <div class="form-group">
             <button type="submit" class="btn btn-outline-primary"> Entrar</button>
             </div>
         </form>
     </div>    
 </body>
 </html>
 