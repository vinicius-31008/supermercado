<?php
include "conecta.php";
session_start();

// DEBUG: defina true para ver var_dumps e mensagens de SQL (apague em produção)
$debug = true;

// Salva CPF do cliente
if (isset($_POST['cpf']) && !empty(trim($_POST['cpf']))) {
    $_SESSION['cpf_cliente'] = trim($_POST['cpf']);
}

// Inicializa carrinho
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Adicionar produto ao carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prod'])) {
    // Valida entrada
    $prod_raw = $_POST['prod'];
    $quant_raw = isset($_POST['quant']) ? $_POST['quant'] : 1;

    if ($debug) {
        echo '<pre>DEBUG $_POST: '; var_dump($_POST); echo '</pre>';
    }

    // Força inteiro no id do produto e quantidade
    $prod = (int)$prod_raw;
    $quant = (int)$quant_raw;
    if ($quant < 1) $quant = 1;

    if ($prod <= 0) {
        echo "<p style='color:red;'>Erro: id do produto inválido (valor recebido: ".htmlspecialchars($prod_raw).").</p>";
    } else {
        // Prepared statement seguro
        $stmt = $conexao->prepare("SELECT pro_nome, pro_valor FROM produtos WHERE pro_id = ? LIMIT 1");
        if (!$stmt) {
            // erro no prepare (problema na conexão ou sintaxe)
            echo "<p style='color:red;'>Erro no prepare(): " . htmlspecialchars($conexao->error) . "</p>";
            if ($debug) {
                echo "<p>SQL esperada: SELECT pro_nome, pro_valor FROM produtos WHERE pro_id = ? LIMIT 1</p>";
            }
        } else {
            $stmt->bind_param("i", $prod);
            $ok = $stmt->execute();
            if (!$ok) {
                echo "<p style='color:red;'>Erro ao executar consulta: " . htmlspecialchars($stmt->error) . "</p>";
            } else {
                $res = $stmt->get_result();
                if ($res && $res->num_rows > 0) {
                    $produto = $res->fetch_assoc();
                    // adiciona ao carrinho (acumula quantidade se já existir)
                    if (isset($_SESSION['carrinho'][$prod])) {
                        $_SESSION['carrinho'][$prod]['quantidade'] += $quant;
                    } else {
                        $_SESSION['carrinho'][$prod] = [
                            'nome' => $produto['pro_nome'],
                            'valor' => (float)$produto['pro_valor'],
                            'quantidade' => $quant
                        ];
                    }
                } else {
                    // Resultado vazio => produto não encontrado
                    echo "<p style='color:red;'>Produto não encontrado no banco para pro_id = $prod.</p>";
                    if ($debug) {
                        echo "<p>Verifique se a tabela <strong>produtos</strong> existe e se a coluna <strong>pro_id</strong> possui este valor.</p>";
                        echo "<p>Se estiver usando outro nome de coluna (ex: id, produto_id) ajuste a consulta.</p>";
                    }
                }
                $res->free_result();
            }
            $stmt->close();
        }
    }
}

// Remover produto do carrinho via GET ?remover=ID
if (isset($_GET['remover'])) {
    $rid = (int)$_GET['remover'];
    if ($rid > 0 && isset($_SESSION['carrinho'][$rid])) {
        unset($_SESSION['carrinho'][$rid]);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Caixa</title>
<style>
    body{font-family:Arial;margin:20px}
    table{border-collapse:collapse;width:80%}
    th,td{border:1px solid #ccc;padding:8px;text-align:center}
    th{background:#f0f0f0}
    input[type=number]{width:80px}
</style>
</head>
<body>

<form method="post">
    <h2>CPF do cliente:</h2>
    <input type="text" name="cpf" value="<?php echo isset($_SESSION['cpf_cliente']) ? htmlspecialchars($_SESSION['cpf_cliente']) : ''; ?>">
    <input type="submit" value="Continuar">
</form>

<hr>

<form method="post">
    Produto:
    <select name="prod" required>
        <option value="" selected disabled>Selecione um produto</option>
        <?php
        // Carrega lista de produtos (sem dependência do debug)
        $result = $conexao->query("SELECT pro_id, pro_nome FROM produtos ORDER BY pro_nome ASC");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="'.(int)$row['pro_id'].'">'.htmlspecialchars($row['pro_nome']).'</option>';
            }
            $result->free_result();
        } else {
            echo '<option value="">Erro ao carregar produtos</option>';
            if ($debug) echo '<option value="">'.htmlspecialchars($conexao->error).'</option>';
        }
        ?>
    </select>

    Quantidade:
    <input type="number" name="quant" min="1" value="1" required>

    <input type="submit" value="Adicionar">
</form>

<h2>Itens da compra:</h2>
<table>
    <tr>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Valor Unitário (R$)</th>
        <th>Subtotal (R$)</th>
        <th>Ação</th>
    </tr>

    <?php
    $total = 0;
    if (!empty($_SESSION['carrinho'])) {
        foreach ($_SESSION['carrinho'] as $id => $item) {
            $subtotal = $item['valor'] * $item['quantidade'];
            $total += $subtotal;
            echo "<tr>";
            echo "<td>".htmlspecialchars($item['nome'])."</td>";
            echo "<td>".$item['quantidade']."</td>";
            echo "<td>".number_format($item['valor'],2,',','.')."</td>";
            echo "<td>".number_format($subtotal,2,',','.')."</td>";
            echo "<td><a href='?remover=".$id."'>Remover</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Nenhum produto adicionado.</td></tr>";
    }
    ?>
</table>

<hr>
<h2>Valor Total: R$ <?php echo number_format($total,2,',','.'); ?></h2>

</body>
</html>
