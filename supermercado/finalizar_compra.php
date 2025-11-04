<?php  
include "conecta.php";

date_default_timezone_set('America/Sao_Paulo');
$dataAtual = date("Y-m-d H:i:s");

if (empty($_POST['carrinho_json'])) {
    die("Nenhum dado recebido!");
}

$dados = json_decode($_POST['carrinho_json'], true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("JSON inválido!");
}

$cpf = htmlspecialchars($dados['cpf'] ?? '');
$idCliente = null;

if (!empty($cpf)) {
    $buscaCliente = mysqli_query($conexao, "SELECT cli_id FROM clientes WHERE cli_cpf LIKE '%$cpf%' LIMIT 1");
    if ($buscaCliente && mysqli_num_rows($buscaCliente) > 0) {
        $idCliente = mysqli_fetch_assoc($buscaCliente)['cli_id'];
    }
}

$itens = $dados['itens'] ?? [];
if (empty($itens)) {
    die("Carrinho vazio!");
}

$total = 0;

$blocos = "";
foreach ($itens as $item) {
    $qtd = (int)$item['quantidade'];
    $valor = (float)$item['valor'];
    $sub = $valor * $qtd;
    $total += $sub;

    $valorFormatado = number_format($valor, 2, ',', '.');
    $subFormatado = number_format($sub, 2, ',', '.');

    $blocos .= "
    <table class='item-vertical'>
        <tr><th>Produto</th><td>" . htmlspecialchars($item['nome']) . "</td></tr>
        <tr><th>Quantidade</th><td>$qtd</td></tr>
        <tr><th>Valor Unitário</th><td>R$ $valorFormatado</td></tr>
        <tr><th>Subtotal</th><td>R$ $subFormatado</td></tr>
    </table>
    <hr>";
    
    $buscaProduto = mysqli_query($conexao, "
        SELECT pro_id FROM produtos 
        WHERE pro_nome LIKE '%" . mysqli_real_escape_string($conexao, $item['nome']) . "%' 
        LIMIT 1
    ");
    if ($buscaProduto && mysqli_num_rows($buscaProduto) > 0) {
        $idProduto = mysqli_fetch_assoc($buscaProduto)['pro_id'];

        $sqlVenda = "INSERT INTO vendas 
            (ven_data, ven_id_cliente, ven_total, ven_id_produto, ven_quantidade, ven_valor_unitario)
            VALUES 
            ('$dataAtual', " . ($idCliente ?: "NULL") . ", '$sub', '$idProduto', '$qtd', '$valor')";
        mysqli_query($conexao, $sqlVenda) or die("Erro ao inserir venda: " . mysqli_error($conexao));

        $sqlEstoque = "UPDATE estoque 
                       SET est_quantidade = est_quantidade - $qtd 
                       WHERE est_id_produto = '$idProduto'";
        mysqli_query($conexao, $sqlEstoque) or die("Erro ao atualizar estoque: " . mysqli_error($conexao));
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Nota Fiscal</title>
<style>
body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background-image: url("imagens/tela_inicial.png");
    background-size: cover;
    color: #000;
    margin: 0;
    height: 100vh;
    display: flex;
    align-items: center;   /* Centraliza verticalmente */
    justify-content: center; /* Centraliza horizontalmente */
}

.nota-container {
    max-width: 220px;
    background: #fff;
    padding: 12px 10px;
    border: 1px solid #000;
    border-radius: 6px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.2);
    color: #000;
}

h2 {
    text-align: center;
    margin-bottom: 5px;
    font-size: 18px;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #000;
}

p {
    text-align: center;
    margin: 3px 0;
    font-size: 12px;
    color: #000;
}

.item-vertical {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 8px;
    border: 1px solid #000;
    border-radius: 4px;
    overflow: hidden;
    color: #000;
}

.item-vertical th, .item-vertical td {
    border-bottom: 1px solid #000;
    padding: 5px 4px;
    font-size: 12px;
    color: #000;
}

.item-vertical th {
    background-color: #e8e8e8;
    text-align: left;
    font-weight: 700;
    color: #000;
    width: 45%;
}

.item-vertical td {
    text-align: right;
    color: #000;
}

.item-vertical tr:last-child td, 
.item-vertical tr:last-child th {
    border-bottom: none;
}

hr {
    border: none;
    border-top: 1px dashed #000;
    margin: 5px 0;
}

.total {
    text-align: right;
    font-weight: bold;
    font-size: 14px;
    margin-top: 10px;
    border-top: 2px solid #000;
    padding-top: 5px;
    color: #000;
}

.botoes {
    text-align: center;
    margin-top: 12px;
}

button {
    background-color: #000;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 7px 14px;
    margin: 4px;
    cursor: pointer;
    font-size: 12px;
    transition: all 0.2s ease;
}

button:hover {
    background-color: #333;
    transform: scale(1.03);
}

a button {
    background-color: #222;
}

a button:hover {
    background-color: #444;
}

@media print {
    body {
        margin: 0;
        background: #fff;
        display: block;
    }
    .nota-container {
        width: 58mm;
        margin: 0;
        padding: 0;
        border: none;
        box-shadow: none;
        color: #000;
    }
    .botoes {
        display: none;
    }
}
</style>
</head>
<body>

<div class="nota-container">
    <h2>AçaiMart</h2>
    <p>Data: <?= date("d/m/Y H:i:s", strtotime($dataAtual)) ?></p>
    <p>CPF do Cliente: <?= $cpf ?></p>

    <?= $blocos ?>

    <div class="total">TOTAL: R$ <?= number_format($total,2,',','.') ?></div>

    <div class="botoes">
        <form method="post" action="download_nota.php" style="display:inline;">
            <button type="submit">Baixar Nota (.txt)</button>
        </form>
        <button onclick="window.print()">Imprimir Nota</button>
        <a href="caixa.php"><button type="button">Voltar</button></a>
    </div>
</div>

</body>
</html>
