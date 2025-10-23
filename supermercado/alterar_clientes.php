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
        <h1>Alterar Cliente</h1>
        <form method="POST" action="alterar1_clientes.php">
            <table border="0">
                <tr>
                    <th>Codigo</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Confirmar</th>
                </tr>
                <?php
                include "conecta.php";

                $id = $_GET["id"];
                $query = mysqli_query($conexao, "SELECT cli_id, cli_nome, cli_cpf, cli_email, cli_telefone FROM clientes WHERE cli_id = '$id'") or die("Erro1000");

                while ($saida = mysqli_fetch_array($query)) {
                    $cod = $saida[0];
                    $nome = $saida[1];
                    $cpf = $saida[2];
                    $email = $saida[3];
                    $telefone = $saida[4];

                    echo "<tr>";
                    echo "<input type='hidden' name='codigo' value='$cod'>";
                    echo "<td><input type='text' value='$cod' disabled></td>";
                    echo "<td><input type='text' name='nome' value='$nome'></td>";
                    echo "<td><input type='text' name='cpf' value='$cpf'></td>";
                    echo "<td><input type='text' name='telefone' value='$telefone'></td>";
                    echo "<td><input type='text' name='email' value='$email'></td>";
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
