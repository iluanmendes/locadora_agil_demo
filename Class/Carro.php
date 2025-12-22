<?php

require_once __DIR__ . '/../config/database.php';

class Carro
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function listar()
    {
        $sql = "SELECT 
                c.*, 
                cat.nome AS categoria 
            FROM 
                carros c
            INNER JOIN 
                categorias cat ON c.categoria_id = cat.id
            WHERE 
                c.status_carro = 'DISPONIVEL'";
        return $this->pdo->query($sql)->fetchAll();
        
    }

    public function buscarPorId($id)
    {
        $conn = Database::getConnection();

        // Query corrigida para trazer todos os detalhes técnicos
        $sql = "SELECT 
                    c.*, 
                    cat.nome AS categoria 
                FROM 
                    carros c
                INNER JOIN 
                    categorias cat ON c.categoria_id = cat.id
                WHERE 
                    c.id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}