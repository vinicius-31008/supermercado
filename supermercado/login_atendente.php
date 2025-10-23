<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #9c27b0; /* roxo médio */
            background-image: url(imagens/tela_inicial.png);
            background-size: cover;       
            background-position: center;  
            background-repeat: no-repeat; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: white;
        }

        form {
            background-color: #701f87; /* roxo escuro */
            padding: 40px;
            border-radius: 8px;
            display: flex;
            flex-direction: column; /* organiza inputs verticalmente */
            width: 300px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #ce93d8; /* roxo claro */
            border: none;
            border-radius: 4px;
            color: #000;
            font-weight: bold;
            cursor: pointer;
            margin-top: 15px;
            align-self: center; /* centraliza o botão */
            width: 50%; /* define largura menor para o botão */
        }

        input[type="submit"]:hover {
            background-color: #d1c4e9;
        }

        h1 {
            text-align: center;
            margin-bottom: 15px;
        }

        .erro {
            color: #ffcccc;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <form method="post">
        <h1>Faça seu login como operador</h1>
        Usuário: <input type="text" name="usuar" required>
        Senha: <input type="password" name="senha" required>
        <input type="submit" value="Continuar">
    </form>

</body>
</html>

<?php
include "conecta.php";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['usuar'];
    $senha = $_POST['senha'];

    if($username == 'operador' && $senha == 'senha123'){
        $_SESSION['logado'] = true;
        header('Location: caixa.php');
        exit;
    } else {
        $erro = "Credenciais inválidas, tente novamente";
    }
}
?>
