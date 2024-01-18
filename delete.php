<?php
include 'config.php';
include 'Cliente.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $clienteId = $_GET['id'];

    // Excluir o cliente com base no ID
    $stmt = $conn->prepare("DELETE FROM cliente WHERE id_cliente = ?");
    $stmt->bind_param("i", $clienteId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Cliente excluído com sucesso
        header('Location: index.php'); // Redireciona para a página inicial
    } else {
        echo "Erro ao excluir cliente.";
    }
} else {
    echo "ID do cliente não especificado.";
}
?>