<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta no estoque</title>
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
        <h1>Produtos em estoque</h1>
        <table>
            <tr>
                <th>Código do produto</th>
                <th>Nome do produto</th>
                <th>Quantidade em estoque</th>
                <th>Excluir</th>
                <th>Alterar</th>
            </tr>
            <?php
            include "conecta.php";

            $query = mysqli_query($conexao, "SELECT est_id_produto, est_nome_produto, est_quantidade FROM estoque") or die ("Erro na consulta.");

            while($saida = mysqli_fetch_array($query)){
                $codigo_prod = $saida[0];
                $nome_prod = $saida[1];
                $prod_quant = $saida[2];

                echo "<tr>";
                echo "<td>$codigo_prod</td>";
                echo "<td>$nome_prod</td>";
                echo "<td>$prod_quant</td>";
                echo "<td><a class='sim' href='excluir_estoque.php?id=$codigo_prod'>SIM</a></td>";
                echo "<td><a class='sim' href='alterar_clientes.php?id=$codigo_prod'>SIM</a></td>";
                echo "</tr>";
            }

            mysqli_close($conexao);
            ?>

            <a href="estoque.php"><button>Voltar</button></a>
        </table>
    </div>
</body>
</html>
