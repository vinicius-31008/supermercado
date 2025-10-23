<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta ao Banco de Dados</title>
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

        /* Campos e formulários */
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

        input[type="text"] {
            padding: 10px 12px;
            border-radius: 8px;
            border: 2px solid transparent;
            outline: none;
            font-size: 1em;
            transition: 0.2s;
        }

        input[type="text"]:focus {
            border: 2px solid #ce93d8;
            background-color: #f3e5f5;
            color: #4a148c;
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
            margin-top: 10px;
            display: inline-block;
        }
    </style>
</head>
<body>

    <div class="container">
        <form method="post" action="consulta_lote_fornecedores.php">
            <h1>Consulta de Fornecedores</h1>
            <input type="text" id="busca_fornecedor" name="busca" placeholder="Buscar...">
            <input type="submit" value="Consultar">
        </form>
    </div>
    
    <a href="cadastros_adm.php"><button>Voltar</button></a>

</body>
</html>
