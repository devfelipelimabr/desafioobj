<?php
include 'config.php';
include 'Cliente.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $clienteId = $_POST['id'];
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
    $observacao = isset($_POST['observacao']) ? $_POST['observacao'] : '';

    try {
        // Atualizar o telefone na tabela cliente_telefone
        $stmtTelefone = $conn->prepare("UPDATE cliente_telefone SET telefone = ? WHERE id_cliente_telefone = 
                                        (SELECT cliente_telefone_id_cliente_telefone FROM cliente WHERE id_cliente = ?)");
        $stmtTelefone->bind_param("si", $telefone, $clienteId);
        $stmtTelefone->execute();

        // Atualizar os dados do cliente na tabela cliente
        $stmtCliente = $conn->prepare("UPDATE cliente SET nome = ?, observacao = ? WHERE id_cliente = ?");
        $stmtCliente->bind_param("ssi", $nome, $observacao, $clienteId);
        $stmtCliente->execute();

        header('Location: index.php'); // Redireciona para a página inicial após a atualização
    } catch (Exception $e) {
        // Tratar exceção
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "ID do cliente não especificado.";
}
?>
