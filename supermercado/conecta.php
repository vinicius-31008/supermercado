<?php
$servidor = "127.0.0.1";
$usuario = "root";
$senha = "";
$bancoDados = "senai";
$conexao = mysqli_connect($servidor,$usuario,$senha,$bancoDados)
or die ("problemas para conectar no banco, verifique os dados");
?>