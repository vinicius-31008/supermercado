<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AçaiMart - Nossa História</title>
  <style>
    /* Reset e fontes */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      background-image: url(imagens/tela_inicial.png);
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      color: #3d0a6d;
      position: relative;
    }

    /* Overlay no background */
    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    }

    /* Header */
    header {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 15px;
      background-color: #701f87;
      color: white;
      padding: 20px 0;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    header img {
      width: 50px;
      height: auto;
    }

    header h2 {
      font-size: 1.8em;
      font-weight: 700;
    }

    /* Main */
    main {
      flex: 1;
      max-width: 800px;
      margin: 40px auto;
      background-color: rgba(255, 255, 255, 0.95);
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    h1 {
      color: #6a0dad;
      text-align: center;
      font-weight: 700;
      margin-bottom: 25px;
    }

    p {
      line-height: 1.8;
      font-size: 1.05em;
      text-align: justify;
      margin-bottom: 20px;
      font-weight: 400;
    }

    /* Botão voltar centralizado */
    .btn-voltar {
      display: block;          /* garante centralização */
      width: fit-content;      /* ajusta ao conteúdo */
      margin: 30px auto 0;     /* centraliza horizontalmente */
      padding: 12px 25px;
      background-color: #a428c7;
      color: white;
      font-weight: bold;
      text-align: center;
      text-decoration: none;
      border-radius: 8px;
      transition: background-color 0.3s, transform 0.2s, box-shadow 0.2s;
    }

    .btn-voltar:hover {
      background-color: #8b23b0;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    /* Footer */
    footer {
      text-align: center;
      background-color: #701f87;
      color: white;
      padding: 15px 0;
      font-size: 0.9em;
    }
  </style>
</head>
<body>
  <header>
    <img src="imagens/logo2.png" alt="Logo AçaiMart">
    <h2>AçaiMart</h2>
  </header>

  <main>
    <h1>Nossa Fundação</h1>
    <p>
      O <strong>AçaiMart</strong> foi fundado por <strong>Alexandre</strong>, um empreendedor visionário que acreditava no poder de unir qualidade, praticidade e sabor em um só lugar. Inspirado pela paixão pelo açaí e pelos produtos naturais da Amazônia, Alexandre decidiu criar um mercado que oferecesse não apenas o tradicional açaí, mas também uma variedade de alimentos saudáveis e regionais, valorizando os produtores locais.
    </p>

    <p>
      Desde sua fundação, o AçaiMart tem como missão proporcionar aos clientes uma experiência única de consumo, combinando o frescor dos ingredientes com um atendimento acolhedor e um ambiente moderno. Com o passar do tempo, o mercado tornou-se referência na comunidade, sendo reconhecido pela autenticidade de seus produtos e pelo compromisso em promover uma alimentação equilibrada e sustentável.
    </p>

    <p>
      O sonho de Alexandre de transformar o açaí em um símbolo de união entre sabor e bem-estar se concretizou no <strong>AçaiMart</strong> — um espaço que vai além de um simples mercado, representando o orgulho de suas origens e o compromisso com um futuro mais saudável.
    </p>

    <a href="tela_inicial.php" class="btn-voltar">Voltar à Página Inicial</a>
  </main>

  <footer>
    © 2025 AçaiMart | Feito com amor por Alexandre
  </footer>
</body>
</html>
