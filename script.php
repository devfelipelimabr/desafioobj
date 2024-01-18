<?php

// Incluir configurações e classe Cliente
include 'config.php';
include 'Cliente.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
    $observacao = isset($_POST['observacao']) ? $_POST['observacao'] : '';

    try {
        // Salvar o telefone no banco de dados
        $stmtTelefone = $conn->prepare("INSERT INTO cliente_telefone (telefone) VALUES (?)");
        $stmtTelefone->bind_param("s", $telefone);
        $stmtTelefone->execute();

        // Obter o ID do telefone recém-inserido
        $telefoneId = $stmtTelefone->insert_id;

        // Obter a data de cadastro atual
        $dataCadastro = date('Y-m-d H:i:s');

        // Criar instância do Cliente
        $cliente = new Cliente($nome, $observacao, $telefoneId, $dataCadastro);

        // Salvar o cliente no banco de dados
        if ($cliente->salvar()) {
            // Cliente cadastrado com sucesso
            header('Location: index.php'); // Redireciona para a página inicial
        } else {
            // Erro ao cadastrar cliente
            echo "Erro ao cadastrar cliente.";
        }
    } catch (Exception $e) {
        // Tratar exceção
        echo "Erro: " . $e->getMessage();
    }
}

?>
