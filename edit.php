<?php
include 'config.php';
include 'Cliente.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $clienteId = $_GET['id'];

    // Obter as informações do cliente com base no ID
    $stmt = $conn->prepare("SELECT * FROM cliente WHERE id_cliente = ?");
    $stmt->bind_param("i", $clienteId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $cliente = $result->fetch_assoc();

        // ... criar um formulário com os campos preenchidos com os dados atuais do cliente para edição ...
    } else {
        echo "Cliente não encontrado.";
    }
} else {
    echo "ID do cliente não especificado.";
}
?>