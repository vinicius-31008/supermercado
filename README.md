Este projeto foi feito sem a utilização de nenhumna extensão adiconal, apenas é necessario uma API como o PHPMYADMIN proveniente do WampServer.

O banco de dados precisa de uma estrutura especifica para que o codigo funcione que é:

CREATE DATABASE senai;

USE senai;

CREATE TABLE produtos (
    pro_id INT AUTO_INCREMENT PRIMARY KEY, 
    pro_nome VARCHAR(50), 
    pro_descrição VARCHAR(100), 
    pro_valor_compra INT, 
    pro_valor_venda INT,
    pro_id_fornecedor INT
);

CREATE TABLE fornecedores (
    for_id INT AUTO_INCREMENT PRIMARY KEY, 
    for_nome varchar(50), 
    for_cnpj varchar(50), 
    for_telefone varchar(50), 
    for_email varchar(50)
);

CREATE TABLE clientes (
    cli_id INT AUTO_INCREMENT PRIMARY KEY, 
    cli_nome varchar(50), 
    cli_cpf varchar(50), 
    cli_telefone varchar(50), 
    cli_email varchar(50)
);

CREATE TABLE estoque (
    est_id_produto INT,
    est_nome_produto VARCHAR(30),
    est_quantidade INT
);

CREATE TABLE vendas (
    ven_id int AUTO_INCREMENT PRIMARY KEY, 
    ven_data date, 
    ven_id_cliente int, 
    ven_total int, 
    ven_id_produto int, 
    ven_quantidade int, 
    ven_valor_unitario int
);

Fazendo a criação correta do banco de dados e mantendo a estrutura de arquivos o codigo deve funcionar sem grandes problemas
