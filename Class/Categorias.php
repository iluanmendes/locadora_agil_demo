<?php

    require_once __DIR__ . '/../config/database.php';

    Class Categoria {
        private $pdo;

        

        public function __construct()
        {
            $this->pdo = Database::getConnection();
        }


        public function listarCategorias()
        {
            $sql = "SELECT DISTINCT `id`, `nome` FROM `categorias`";

            return $this->pdo->query($sql)->fetchAll();

        }

    }



?>