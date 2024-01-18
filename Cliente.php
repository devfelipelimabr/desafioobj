<?php

class Cliente {
    private $id;
    private $nome;
    private $observacao;
    private $telefoneId;

    public function __construct($nome, $observacao, $telefoneId) {
        $this->nome = $nome;
        $this->observacao = $observacao;
        $this->telefoneId = $telefoneId;
    }

    // Métodos getters e setters aqui...

    public function salvar() {
        global $conn;

        $stmt = $conn->prepare("INSERT INTO cliente (nome, observacao, cliente_telefone_id_cliente_telefone) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $this->nome, $this->observacao, $this->telefoneId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public static function obterTodos() {
        global $conn;

        $clientes = array();
        $result = $conn->query("SELECT * FROM cliente");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $clientes[] = $row;
            }
        }

        return $clientes;
    }

    public function editar() {
        global $conn;

        $stmt = $conn->prepare("UPDATE cliente SET nome = ?, observacao = ?, cliente_telefone_id_cliente_telefone = ? WHERE id_cliente = ?");
        $stmt->bind_param("ssii", $this->nome, $this->observacao, $this->telefoneId, $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function excluir() {
        global $conn;

        $stmt = $conn->prepare("DELETE FROM cliente WHERE id_cliente = ?");
        $stmt->bind_param("i", $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}


?>
