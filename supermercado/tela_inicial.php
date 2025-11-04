<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AçaiMart</title>
  <style>
    body {
      height: 100vh;
      margin: 0;
      display: flex;
      flex-direction: column;
      background-image: url(imagens/tela_inicial.png);
      background-size: cover;       /* faz a imagem cobrir toda a tela */
      background-position: center;  /* centraliza a imagem */
      background-repeat: no-repeat; /* evita repetição da imagem */
      font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }

    /* ===== HEADER ===== */
    header {
      background-color: #701f87;
      color: white;
      padding: 15px 25px;
      display: flex;
      justify-content: space-around;
      align-items: center;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      padding: 20px;
    }

    header a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      font-size: 16px;
      transition: color 0.3s;
    }

    header a:hover {
      color: #d3b5e8;
    }

    /* ===== CONTEÚDO ===== */
    .main {
      flex: 1;
      display: flex;
      align-items: center;
    }

    .container {
      margin-left: 40%;
      background-color: #e7e7e7;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    h1 {
      margin-bottom: 25px;
      color: #333;
    }

    a.button-link {
      text-decoration: none;
    }

    button {
      display: block;
      width: 220px;
      margin: 10px auto;
      padding: 12px 24px;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      background-color: #701f87;
      color: white;
      transition: background-color 0.3s, transform 0.2s;
    }

    button:hover {
      background-color: #a428c7;
      transform: scale(1.03);
    }
  </style>
</head>
<body>

  <!-- HEADER -->
  <header>
    <img src="imagens/logo.png" width="100px">
    <a href="sobre_nos.php">Sobre nós</a>
  </header>

  <!-- CONTEÚDO PRINCIPAL -->
  <div class="main">
    <div class="container">
      <h1>Bem-vindo!</h1>
      <a class="button-link" href="login_adm.php"><button>Sou administrador</button></a>
      <a class="button-link" href="login_atendente.php"><button>Sou operador</button></a>
    </div>
  </div>

</body>
</html>
