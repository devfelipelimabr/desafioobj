<?php
include 'config.php';
include 'Cliente.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $clienteId = $_GET['id'];

    // Obter as informações do cliente com base no ID
    $stmt = $conn->prepare("SELECT c.id_cliente, c.nome, c.observacao, t.telefone 
                            FROM cliente c
                            INNER JOIN cliente_telefone t ON c.cliente_telefone_id_cliente_telefone = t.id_cliente_telefone
                            WHERE c.id_cliente = ?");
    $stmt->bind_param("i", $clienteId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $cliente = $result->fetch_assoc();
?>

        <!DOCTYPE html>
        <html lang="pt-BR" data-bs-theme="dark">

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="Time Objetivo">
            <meta name="generator" content="OBJ 1.0">
            <title>Editar Cliente - Desafio Técnico</title>
            <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="./assets/css/app.css">
        </head>

        <body>

            <div class="container py-5">
                <h2 class="mb-4">Editar Cliente</h2>

                <form method="post" action="update.php">

                    <input type="hidden" name="id" value="<?= $cliente['id_cliente']; ?>">

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= $cliente['nome']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone:</label>
                        <input type="number" class="form-control" id="telefone" name="telefone" value="<?= $cliente['telefone']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="observacao" class="form-label">Observação:</label>
                        <textarea class="form-control" id="observacao" name="observacao" rows="3"><?= $cliente['observacao']; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </div>

                </form>
            </div>

            <script src="./assets/js/bootstrap.bundle.min.js"></script>
        </body>

        </html>

<?php
    } else {
        echo "Cliente não encontrado.";
    }
} else {
    echo "ID do cliente não especificado.";
}
?>
