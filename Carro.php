<?php

require_once __DIR__ . '/config/database.php';

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
    c.id,
    c.modelo,                 -- Título do Card (Ex: Econômico Compacto)
    c.descricao,              -- Texto descritivo
    c.preco_diaria,           -- Preço para exibir e filtrar
    c.imagem_url,             -- Foto do carro
    cat.nome AS categoria     -- Nome da categoria para o Badge (Ex: Econômico)
FROM 
    carros c
INNER JOIN 
    categorias cat ON c.categoria_id = cat.id
WHERE 
    c.disponivel = TRUE;      -- Apenas carros que não estão em manutenção";
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