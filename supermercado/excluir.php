<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exclusão de Fornecedor</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #9c27b0;
            background-image: url(imagens/tela_inicial.png);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #fff;
            height: 100vh;
            margin: 0;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(112, 31, 135, 0.88);
            backdrop-filter: blur(8px);
            border-radius: 20px;
            padding: 40px;
            width: 90%;
            max-width: 500px;
            text-align: center;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
        }

        h1 {
            color: #f3e5f5;
            font-size: 28px;
            margin-bottom: 30px;
        }

        button {
            background-color: #8e24aa;
            border: none;
            padding: 10px 25px;
            border-radius: 30px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }

        button:hover {
            background-color: #ab47bc;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        include "conecta.php";

        $id = $_GET["id"];

        $query = mysqli_query($conexao, "DELETE FROM fornecedores WHERE for_id = '$id'") or die("Erro na exclusão.");

        echo "<h1>Deletado com sucesso!!!</h1>";

        mysqli_close($conexao);
        ?>

        <a href="cadastros_adm_fornecedor.php"><button>Voltar</button></a>
    </div>
</body>
</html>
