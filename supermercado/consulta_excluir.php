<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Fornecedor</title>
    <style>
        /* Estilo geral */
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

            /* Centraliza o conteúdo */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Container */
        .container {
            background: rgba(112, 31, 135, 0.88);
            backdrop-filter: blur(8px);
            border-radius: 20px;
            padding: 40px;
            width: 90%;
            max-width: 900px;
            text-align: center;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
        }

        h1 {
            color: #f3e5f5;
            font-size: 28px;
            margin-bottom: 25px;
        }

        /* Tabela */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            text-align: center;
            color: #fff;
            font-size: 0.95em;
        }

        th {
            background-color: rgba(255, 255, 255, 0.25);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.08);
        }

        a {
            color: #ffccff;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        /* Botões "SIM" */
        a.sim {
            background-color: #8e24aa;
            padding: 6px 12px;
            border-radius: 8px;
            display: inline-block;
            transition: all 0.3s ease;
        }

        a.sim:hover {
            background-color: #ab47bc;
            transform: scale(1.05);
        }

        /* Responsividade */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            table {
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
        <h1>Excluir Fornecedor</h1>

        <table>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>CNPJ</th>
                <th>Email</th>
                <th>Deletar</th>
                <th>Alterar</th>
            </tr>

            <?php
            include "conecta.php";

            $id = $_GET["id"];

            $query = mysqli_query($conexao, "SELECT for_id, for_nome, for_telefone, for_cnpj, for_email FROM fornecedores WHERE for_id = '$id'") or die("Erro na consulta.");

            while ($saida = mysqli_fetch_array($query)) {
                $codigo = $saida[0];
                $nome = $saida[1];
                $telefone = $saida[2];
                $cnpj = $saida[3];
                $email = $saida[4];

                echo "<tr>";
                echo "<td>$codigo</td>";
                echo "<td>$nome</td>";
                echo "<td>$telefone</td>";
                echo "<td>$cnpj</td>";
                echo "<td>$email</td>";
                echo "<td><a class='sim' href='excluir.php?id=$codigo'>SIM</a></td>";
                echo "<td><a class='sim' href='alterar.php?id=$codigo'>SIM</a></td>";
                echo "</tr>";
            }

            mysqli_close($conexao);
            ?>
        </table>
    </div>
</body>
</html>
