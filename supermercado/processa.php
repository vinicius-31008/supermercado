<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Realizado</title>
    <style>
        /* Estilo geral */
        body {
            font-family: "Poppins", Arial, sans-serif;
            background-image: url("imagens/tela_inicial.png");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #fff;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Container principal */
        .container {
            background: rgba(112, 31, 135, 0.9);
            backdrop-filter: blur(8px);
            border-radius: 16px;
            padding: 40px 60px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: translateY(-3px);
        }

        h1 {
            color: #f3e5f5;
            font-weight: 600;
            font-size: 1.5em;
            margin-bottom: 20px;
        }

        /* Botão */
        input[type="submit"] {
            background-color: #8e24aa;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 1em;
            font-weight: 500;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #ab47bc;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="post" action="cadastros_adm_clientes.php">
            <h1>Cadastro de cliente realizado!</h1>
            <input type="submit" value="OK">
        </form>
    </div>        
</body>
</html>

<?php
include "conecta.php";
$nome = $_POST["nome"];
$telefone = $_POST["telefone"];
$CPF = $_POST["cpf"];
$email = $_POST["email"];

$query = mysqli_query($conexao, "INSERT INTO clientes (cli_nome, cli_telefone, cli_cpf, cli_email) 
VALUES ('$nome', '$telefone', '$CPF', '$email');");
mysqli_close($conexao);
?>
