<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Cliente</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #9c27b0;
            background-image: url(imagens/tela_inicial.png);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #fff;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(112, 31, 135, 0.88);
            backdrop-filter: blur(8px);
            border-radius: 20px;
            padding: 30px;
            width: 95%;
            max-width: 800px;
            text-align: center;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
        }

        h1 {
            color: #f3e5f5;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: center;
            color: #fff;
        }

        th {
            background-color: rgba(255, 255, 255, 0.25);
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }

        input[type="text"] {
            padding: 8px;
            border-radius: 8px;
            border: none;
            outline: none;
            width: 90%;
            font-size: 1em;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        input[type="text"]:focus {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid #8e24aa;
        }

        input[type="text"][readonly] {
            background-color: rgba(255, 255, 255, 0.2);
            color: #ddd;
            cursor: not-allowed;
            border: 1px solid #9e9e9e;
        }

        input[type="submit"] {
            background-color: #8e24aa;
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #ab47bc;
            transform: scale(1.05);
        }

        @media (max-width: 600px) {
            th, td, input[type="text"] {
                font-size: 0.8em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Alterar produtos</h1>
        <form method="POST" action="alterar1_estoque.php">
            <table border="0">
                <tr>
                    <th>Codigodo produto</th>
                    <th>Nome do produto</th>
                    <th>Quantidade no estoque</th>
                    <th>Confirmar</th>
                </tr>
                <?php
                include "conecta.php";

                $id = $_GET["id"];
                $query = mysqli_query($conexao, "SELECT est_id_produto, est_nome_produto, est_quantidade FROM estoque WHERE est_id_produto = '$id'") or die("Erro1000");

                while ($saida = mysqli_fetch_array($query)){
                    $codigo_prod = $saida[0];
                    $nome_prod = $saida[1];
                    $prod_quant = $saida[2];

                    echo "<tr>";
                    echo "<td><input type='text' name='codigo' value='$codigo_prod' readonly></td>";
                    echo "<td><input type='text' name='nome' value='$nome_prod' readonly></td>";
                    echo "<td><input type='text' name='quant' value='$prod_quant'></td>";
                    echo "<td><input type='submit' value='OK'></td>";
                    echo "</tr>";
                }

                mysqli_close($conexao);
                ?>
            </table>
        </form>
    </div>
</body>
</html>
