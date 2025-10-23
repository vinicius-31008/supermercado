<!DOCTYPE html> 
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
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
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Container dos botões */
        .nav-buttons {
            background: rgba(112, 31, 135, 0.9);
            backdrop-filter: blur(8px);
            border-radius: 20px;
            padding: 40px 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .nav-buttons:hover {
            transform: translateY(-3px);
        }

        /* Botões */
        button {
            background-color: #8e24aa;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 1em;
            font-weight: 500;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 220px;
        }

        button:hover {
            background-color: #ab47bc;
            transform: scale(1.05);
        }

        /* Links */
        a {
            text-decoration: none;
        }

        /* Responsivo */
        @media (max-width: 480px) {
            .nav-buttons {
                width: 85%;
                padding: 25px 15px;
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="nav-buttons">
        <a href="cadastros_adm_fornecedor.php"><button>Cadastro de Fornecedores</button></a>
        <a href="cadastros_adm_clientes.php"><button>Cadastro de Clientes</button></a>        
        <a href="cadastros_adm_produtos.php"><button>Cadastro de Produtos</button></a>
        <a href="estoque.php"><button>Estoque</button></a>
        <a href="tela_inicial.php"><button>Logout</button></a>
    </div>
</body>
</html>
