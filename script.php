<?php

include 'config.php';
include 'Cliente.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
    $observacao = isset($_POST['observacao']) ? $_POST['observacao'] : '';

    // Salvar o telefone no banco de dados
    $stmtTelefone = $conn->prepare("INSERT INTO cliente_telefone (telefone) VALUES (?)");
    $stmtTelefone->bind_param("s", $telefone);
    $stmtTelefone->execute();

    // Obter o ID do telefone recém-inserido
    $telefoneId = $stmtTelefone->insert_id;

    // Salvar o cliente no banco de dados
    $stmtCliente = $conn->prepare("INSERT INTO cliente (nome, observacao, cliente_telefone_id_cliente_telefone) VALUES (?, ?, ?)");
    $stmtCliente->bind_param("ssi", $nome, $observacao, $telefoneId);
    $stmtCliente->execute();

    if ($stmtCliente->affected_rows > 0) {
        // Cliente cadastrado com sucesso
        header('Location: index.php'); // Redireciona para a página inicial
    } else {
        // Erro ao cadastrar cliente
        echo "Erro ao cadastrar cliente.";
    }
}

?>
