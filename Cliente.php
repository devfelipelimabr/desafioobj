<?php

class Cliente
{
    private $id;
    private $nome;
    private $observacao;
    private $telefoneId;
    private $dataCadastro; // Adicionando a propriedade para armazenar a data de cadastro

    public function __construct($nome, $observacao, $telefoneId, $dataCadastro)
    {
        $this->nome = $nome;
        $this->observacao = $observacao;
        $this->telefoneId = $telefoneId;
        $this->dataCadastro = $dataCadastro;
    }

    // Métodos getters e setters aqui...

    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }
    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getObservacao()
    {
        return $this->observacao;
    }

    public function getTelefoneId()
    {
        return $this->telefoneId;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    // Métodos de manipulação de dados (salvar, editar, excluir)
    public function salvar()
    {
        global $conn;

        $stmt = $conn->prepare("INSERT INTO cliente (nome, observacao, cliente_telefone_id_cliente_telefone) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $this->nome, $this->observacao, $this->telefoneId);

        return $stmt->execute();
    }

    public static function obterTodos()
    {
        global $conn;

        $clientes = array();
        $result = $conn->query("SELECT * FROM cliente");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cliente = new Cliente($row['nome'], $row['observacao'], $row['cliente_telefone_id_cliente_telefone'], $row['data_cadastro']);
                $cliente->setId($row['id_cliente']);
                $clientes[] = $cliente;
            }
        }

        return $clientes;
    }


    // Adicione outros métodos conforme necessário (editar, excluir, etc.)
}
