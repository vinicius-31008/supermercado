<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
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
            padding: 40px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        h1 {
            text-align: center;
            color: #f8e9ff;
            margin-bottom: 15px;
            font-weight: 600;
        }

        /* Container principal */
        .container {
            background: rgba(112, 31, 135, 0.9);
            backdrop-filter: blur(8px);
            border-radius: 16px;
            padding: 25px 35px;
            margin: 20px;
            width: 90%;
            max-width: 420px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: translateY(-3px);
        }

        /* Campos do formulário */
        form {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        label {
            font-weight: 500;
            color: #e1bee7;
            font-size: 0.95em;
        }

        input[type="text"],
        select {
            padding: 10px 12px;
            border-radius: 8px;
            border: 2px solid transparent;
            outline: none;
            font-size: 1em;
            transition: 0.2s;
            background-color: #fff;
            color: #4a148c;
            appearance: none; /* Remove o estilo padrão do select */
        }

        /* Ícone de seta personalizada */
        select {
            background-image: linear-gradient(to bottom, #f3e5f5, #f3e5f5),
                              url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' fill='%238e24aa' height='24' viewBox='0 0 24 24' width='24'><path d='M7 10l5 5 5-5z'/></svg>");
            background-repeat: no-repeat, no-repeat;
            background-position: right 10px center, right 10px center;
            background-size: 24px;
        }

        select:focus,
        input[type="text"]:focus {
            border: 2px solid #ce93d8;
            background-color: #f3e5f5;
            color: #4a148c;
        }

        select option[disabled] {
            color: #999;
        }

        /* Botões */
        input[type="submit"],
        button {
            background-color: #8e24aa;
            color: white;
            border: none;
            padding: 12px;
            font-size: 1em;
            font-weight: 500;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover,
        button:hover {
            background-color: #ab47bc;
            transform: scale(1.05);
        }

        /* Links */
        a {
            text-decoration: none;
            margin: 8px;
        }

        /* Ajuste dos botões de navegação */
        .nav-buttons {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastro de Produtos</h1>
        <form method="post" action="processa3.php">
            <label for="nome">NOME DO PRODUTO:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="desc">DESCRIÇÃO:</label>
            <input type="text" id="desc" name="desc" required>

            <label for="valor_custo">VALOR DE COMPRA:</label>
            <input type="text" id="valor_custo" name="valor_custo" required>

            <label for="valor_venda">VALOR DE VENDA:</label>
            <input type="text" id="valor_venda" name="valor_venda" required>

            <label for="forn">FORNECEDOR:</label>
            <select id="forn" name="forn" required>
                <option value="" selected disabled>Selecione um fornecedor</option>
                <?php
                include "conecta.php";
                $query = mysqli_query($conexao, "SELECT for_id, for_nome FROM fornecedores ORDER BY for_nome ASC");
                while($dados = mysqli_fetch_array($query)){
                    echo '<option value="'.$dados['for_id'].'">'.$dados['for_nome'].'</option>';
                }
                ?>
            </select>

            <input type="submit" value="Enviar">
        </form>
    </div>

    <div class="nav-buttons">
        <a href="consulta_produtos.php"><button>Consultar banco de dados</button></a>
        <a href="cadastros_adm.php"><button>Voltar</button></a>
    </div>
</body>
</html>
