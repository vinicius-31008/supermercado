<?php
session_start();

if (empty($_SESSION['nota_txt'])) {
    die("Nenhuma nota encontrada!");
}

$nota_txt = $_SESSION['nota_txt'];
$arquivo = "nota_fiscal_" . date("Ymd_His") . ".txt";

// Cabeçalhos para download
header('Content-Type: text/plain; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $arquivo . '"');
header('Content-Length: ' . strlen($nota_txt));

echo $nota_txt;
exit;
?>
