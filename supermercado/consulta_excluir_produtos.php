<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir / Alterar Cliente</title>
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
            padding: 30px;
            width: 95%;
            max-width: 900px;
            text-align: center;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
        }

        h1 {
            color: #f3e5f5;
            font-size: 28px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 12px;
            text-align: center;
            color: #fff;
        }

        th {
            background-color: rgba(255, 255, 255, 0.25);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }

        a.sim {
            background-color: #8e24aa;
            padding: 6px 12px;
            border-radius: 8px;
            display: inline-block;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        a.sim:hover {
            background-color: #ab47bc;
            transform: scale(1.05);
        }

        @media (max-width: 600px) {
            table, th, td {
                font-size: 0.8em;
            }

            h1 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dados do Produtos</h1>
        <table>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Valor de Compra</th>
                <th>Valor de venda</th>
                <th>Fornecedor</th>
                <th>Deletar</th>
                <th>Alterar</th>
            </tr>
            <?php
            include "conecta.php";

            $id = $_GET["id"];
            $query = mysqli_query($conexao, "SELECT pro_id, pro_nome, pro_descrição, pro_valor_compra, pro_valor_venda, pro_id_fornecedor FROM produtos WHERE pro_id = '$id'") or die ("Erro na consulta.");

            while($saida = mysqli_fetch_array($query)){
                $codigo = $saida[0];
                $nome = $saida[1];
                $descricao = $saida[2];
                $valor_compra = $saida[3];
                $valor_venda = $saida[4];
                $Fornecedor = $saida[5];

                echo "<tr>";
                echo "<td>$codigo</td>";
                echo "<td>$nome</td>";
                echo "<td>$descricao</td>";
                echo "<td>$valor_compra</td>";
                echo "<td>$valor_venda</td>";
                echo "<td>$Fornecedor</td>";
                echo "<td><a class='sim' href='excluir_produtos.php?id=$codigo'>SIM</a></td>";
                echo "<td><a class='sim' href='alterar_produtos.php?id=$codigo'>SIM</a></td>";
                echo "</tr>";
            }

            mysqli_close($conexao);
            ?>
        </table>
    </div>
</body>
</html>
