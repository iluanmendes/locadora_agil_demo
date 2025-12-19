<?php

require_once __DIR__ . '/../config/database.php';

class Usuario
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function listar()
    {
        $sql = "SELECT * FROM usuarios";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }
}