<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Fornecedores</title>
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

            /* Centralização */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Container principal */
        .container {
            background: rgba(112, 31, 135, 0.88);
            backdrop-filter: blur(8px);
            border-radius: 20px;
            padding: 40px;
            width: 90%;
            max-width: 900px;
            text-align: center;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: translateY(-3px);
        }

        h1 {
            color: #f3e5f5;
            font-size: 28px;
            margin-bottom: 25px;
        }

        /* Botão */
        input[type="submit"] {
            background-color: #8e24aa;
            border: none;
            padding: 10px 25px;
            border-radius: 30px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
            margin-bottom: 30px;
        }

        input[type="submit"]:hover {
            background-color: #ab47bc;
            transform: scale(1.05);
        }

        /* Tabela */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            overflow: hidden;
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
            background-color: rgba(255, 255, 255, 0.1);
        }

        a {
            color: #ffccff;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            color: #ffffff;
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
        <form method="post" action="consulta_fornecedor.php">
            <h1>Consulta de Fornecedores</h1>
            <input type="submit" value="Voltar">
        </form>

        <?php
        include "conecta.php";

        $busca = $_POST["busca"];
        $query = mysqli_query($conexao, "SELECT for_id, for_nome, for_telefone, for_cnpj, for_email FROM fornecedores WHERE for_nome LIKE '%$busca%' GROUP BY 1");

        echo ("<table>");
        echo ("<tr><th>Código</th><th>Nome</th><th>Telefone</th><th>CNPJ</th><th>Email</th></tr>");

        while ($saida = mysqli_fetch_array($query)) {
            $codigo = $saida[0];
            $nome = $saida[1];
            $telefone = $saida[2];
            $cnpj = $saida[3];
            $email = $saida[4];

            echo ("<tr>");
            echo ("<td><a href='consulta_excluir.php?id=".$codigo."'>".$codigo."</a></td>");
            echo ("<td>".$nome."</td>");
            echo ("<td>".$telefone."</td>");
            echo ("<td>".$cnpj."</td>");
            echo ("<td>".$email."</td>");
            echo ("</tr>");
        }

        echo ("</table>");
        mysqli_close($conexao);
        ?>
    </div>
</body>
</html>
