<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Produtos</title>
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
            background-color: rgba(255,255,255,0.25);
        }

        tr:nth-child(even) {
            background-color: rgba(255,255,255,0.1);
        }

        input[type="text"] {
            padding: 8px;
            border-radius: 8px;
            border: none;
            outline: none;
            width: 90%;
            font-size: 1em;
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
        <h1>Alterar Produto</h1>
        <form method="POST" action="alterar1_produtos.php">
            <table border="0">
                <tr>
                    <th>Codigo</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor de compra</th>
                    <th>Valor de venda</th>
                    <th>Fornecedor</th>
                    <th>Confirmar</th>
                </tr>
                <?php
                include "conecta.php";

                $id = $_GET["id"];
                $query = mysqli_query($conexao, "SELECT pro_id, pro_nome, pro_descrição, pro_valor_compra, pro_valor_venda, pro_id_fornecedor FROM produtos WHERE pro_id = '$id'") or die("Erro1000");

                while ($saida = mysqli_fetch_array($query)) {
                    $codigo = $saida[0];
                    $nome = $saida[1];
                    $descricao = $saida[2];
                    $valor_compra = $saida[3];
                    $valor_venda = $saida[4];
                    $Fornecedor = $saida[5];

                    echo "<tr>";
                    echo "<input type='hidden' name='codigo' value='$codigo'>";
                    echo "<td><input type='text' value='$codigo' disabled></td>";
                    echo "<td><input type='text' name='nome' value='$nome'></td>";
                    echo "<td><input type='text' name='desc' value='$descricao'></td>";
                    echo "<td><input type='text' name='compra' value='$valor_compra'></td>";
                    echo "<td><input type='text' name='venda' value='$valor_venda'></td>";
                    echo "<td><input type='text' name='forn' value='$Fornecedor'></td>";
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
