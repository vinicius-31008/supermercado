<?php
include "conecta.php";

// Inicializa variáveis
$carrinho = [];
$total = 0;
$cpfCliente = "";

// Recupera carrinho e CPF se vierem do formulário
if (!empty($_POST['carrinho_json'])) {
    $dados = json_decode($_POST['carrinho_json'], true);
    $carrinho = $dados['itens'] ?? [];
    $cpfCliente = $dados['cpf'] ?? "";
}

// Atualiza CPF se enviado diretamente
if (isset($_POST['cpf'])) {
    $cpfCliente = trim($_POST['cpf']);
}

// Ação: adicionar produto
if (isset($_POST['acao']) && $_POST['acao'] === 'adicionar') {
    $id = (int)$_POST['prod'];
    $quant = max(1, (int)$_POST['quant']);

    // Busca nome, valor e estoque do produto
    $stmt = $conexao->prepare("
        SELECT p.pro_nome, p.pro_valor_venda, e.est_quantidade
        FROM produtos p
        JOIN estoque e ON e.est_id_produto = p.pro_id
        WHERE p.pro_id = ?
    ");
    if ($stmt === false) {
        die("Erro no prepare: " . $conexao->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res && $res->num_rows > 0) {
        $produto = $res->fetch_assoc();
        $estoqueDisponivel = (int)$produto['est_quantidade'];

        // Quantidade que já está no carrinho
        $quantNoCarrinho = $carrinho[$id]['quantidade'] ?? 0;

        // Quantidade total que seria adicionada
        $quantTotal = $quantNoCarrinho + $quant;

        // Verifica estoque
        if ($quantTotal > $estoqueDisponivel) {
            echo "<script>alert('Quantidade solicitada maior que o estoque disponível ($estoqueDisponivel)');</script>";
            $quant = 0; // Não adiciona nada
        }

        // Adiciona ao carrinho se quantidade válida
        if ($quant > 0) {
            if (isset($carrinho[$id])) {
                $carrinho[$id]['quantidade'] += $quant;
            } else {
                $carrinho[$id] = [
                    'nome' => $produto['pro_nome'],
                    'valor' => (float)$produto['pro_valor_venda'],
                    'quantidade' => $quant
                ];
            }
        }
    }

    $res->free();
    $stmt->close();
}

// Ação: remover produto
if (isset($_POST['acao']) && $_POST['acao'] === 'remover' && isset($_POST['remover_id'])) {
    $idRemover = (int)$_POST['remover_id'];
    unset($carrinho[$idRemover]);
}

// Dados combinados para envio em hidden
$dadosCarrinho = [
    'cpf' => $cpfCliente,
    'itens' => $carrinho
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Caixa</title>
<style> /* Fundo e estilo geral */ 
    body { font-family: "Poppins", Arial, sans-serif; 
    background-image: url("imagens/tela_inicial.png"); 
    background-size: cover; 
    background-position: center; 
    background-attachment: fixed; 
    color: #fff; 
    margin: 0; 
    height: 100vh; 
    display: flex; 
    justify-content: center; 
    align-items: center; } /* Container central */ 
    .container { background: rgba(112, 31, 135, 0.9); 
    backdrop-filter: blur(8px); border-radius: 20px; 
    padding: 30px 50px; 
    width: 90%; 
    max-width: 900px; 
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3); } 
    h2 { text-align: center; margin-bottom: 10px; color: #fff; } 
    label { font-weight: 500; } 
    input[type="text"], input[type="number"], select { padding: 10px; border: none; border-radius: 8px; width: 100%; max-width: 250px; margin-bottom: 15px; outline: none; } 
    input[type="submit"], button { background-color: #8e24aa; color: white; border: none; padding: 12px 30px; font-size: 1em; font-weight: 500; border-radius: 8px; cursor: pointer; transition: all 0.3s ease; margin-top: 10px; } input[type="submit"]:hover, button:hover { background-color: #ab47bc; transform: scale(1.05); } table { width: 100%; border-collapse: collapse; margin-top: 20px; color: #fff; } th, td { border: 1px solid rgba(255,255,255,0.2); padding: 10px; text-align: center; } th { background: rgba(255,255,255,0.15); } hr { border: 1px solid rgba(255,255,255,0.2); margin: 20px 0; } .total { text-align: right; font-size: 1.2em; margin-top: 20px; font-weight: 600; } /* Responsivo */ @media (max-width: 768px) { .container { padding: 20px; } table { font-size: 0.9em; } input[type="text"], input[type="number"], select { max-width: 100%; } } </style>
</head>
<body>
<div class="container">
    <form method="post">
        <h2>CPF do Cliente</h2>
        <center><input type="text" name="cpf" maxlength="14"
               value="<?= htmlspecialchars($cpfCliente) ?>"
               placeholder="Digite o CPF"></center>

        <hr>

        <h2>Adicione um produto à sua compra</h2>
        <label>Produto:</label>
        <select name="prod" required>
            <option value="" disabled selected>Selecione um produto</option>
            <?php
            $result = $conexao->query("SELECT pro_id, pro_nome FROM produtos ORDER BY pro_nome");
            while ($row = $result->fetch_assoc()) {
                echo '<option value="'.$row['pro_id'].'">'.htmlspecialchars($row['pro_nome']).'</option>';
            }
            ?>
        </select>

        <label>Quantidade:</label>
        <input type="number" name="quant" min="1" value="1">

        <!-- Mantém carrinho e CPF -->
        <input type="hidden" name="carrinho_json" value='<?= json_encode($dadosCarrinho) ?>'>
        <input type="hidden" name="acao" value="adicionar">

        <input type="submit" value="Adicionar Produto">
    </form>

    <table>
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Valor Unitário (R$)</th>
            <th>Subtotal (R$)</th>
            <th>Ação</th>
        </tr>

        <?php if ($carrinho): ?>
            <?php foreach ($carrinho as $id => $item): 
                $subtotal = $item['valor'] * $item['quantidade'];
                $total += $subtotal;
            ?>
            <tr>
                <td><?= htmlspecialchars($item['nome']) ?></td>
                <td><?= $item['quantidade'] ?></td>
                <td><?= number_format($item['valor'], 2, ',', '.') ?></td>
                <td><?= number_format($subtotal, 2, ',', '.') ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="carrinho_json" value='<?= json_encode($dadosCarrinho) ?>'>
                        <input type="hidden" name="remover_id" value="<?= $id ?>">
                        <input type="hidden" name="acao" value="remover">
                        <button type="submit">Remover</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5">Nenhum produto adicionado.</td></tr>
        <?php endif; ?>
    </table>

    <hr>

    <div class="total">Total: R$ <?= number_format($total, 2, ',', '.') ?></div>

    <hr>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <form method="post" action="finalizar_compra.php">
            <input type="hidden" name="carrinho_json" value='<?= json_encode($dadosCarrinho) ?>'>
            <input type="submit" value="Finalizar Compra">
        </form>

        <a href="tela_inicial.php">
            <button type="button">Logout</button>
        </a>
    </div>
</div>
</body>
</html>
