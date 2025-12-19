<?php

require_once __DIR__ . '\Class\Carro.php';
require_once __DIR__ . '\Class\Categorias.php';

$lista_carros = new Carro();
$carros = $lista_carros->listar();

$lista_categorias = new Categoria();
$categorias = $lista_categorias->listarCategorias();



?>
<!doctype html>
<html lang="pt-PT">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Resultados de Pesquisa — Locadora Ágil</title>

   
    <link rel="stylesheet" href="css/style_pesquisa.css">


</head>

<body>
<div class="page" id="page">

    <!-- Cabeçalho Principal -->
    <header class="header">
        <div class="container" style="display:flex; justify-content:space-between; width:100%; align-items:center;">
            <a href="index.php" class="brand">
                <div class="logo">LA</div>
                <h1>Locadora Ágil</h1>
            </a>
            <nav>
                <a href="minhas-reservas.php" class="text-muted" style="margin-right: 1.5rem; font-size: 0.9rem;">Minhas
                    Reservas</a>
                <button class="btn"
                    style="background:transparent; color:var(--accent); border:1px solid var(--accent)">Entrar</button>
            </nav>
        </div>
    </header>

    <main class="container">
        <div class="results-layout">

            <!-- Formulário de Filtros (Sidebar) -->
            <aside class="filter-sidebar">
                <form action="pesquisa.php" method="GET" id="search-filters">

                    <!-- Filtro de Categorias (PHP loop placeholder) -->
                    <div class="filter-section">
                        <div class="filter-title">Categorias</div>
                        <?php foreach ($categorias as $cat): ?>
                            <label class="filter-option">
                                <input type="checkbox" name="categoria[]" value="<?= $cat['nome'] ?>" checked>
                                <?= $cat['nome'] ?>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <!-- Filtro de Transmissão -->
                    <div class="filter-section">
                        <div class="filter-title">Transmissão</div>
                        <label class="filter-option">
                            <input type="radio" name="cambio" value="todos" checked> Qualquer
                        </label>
                        <label class="filter-option">
                            <input type="radio" name="cambio" value="manual"> Manual
                        </label>
                        <label class="filter-option">
                            <input type="radio" name="cambio" value="automatico"> Automático
                        </label>
                    </div>

                    <!-- Filtro de Preço -->
                    <div class="filter-section">
                        <div class="filter-title">Preço Diário Máx.</div>
                        <div class="price-range-group">
                            <input type="number" name="preco_max" placeholder="Ex: 500" value="1000">
                            <span class="text-muted" style="font-size: 0.7rem;">Valor em Euros (€) ou Reais (R$)</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-apply-filters">Filtrar Resultados</button>
                    <a href="resultados.php"
                        style="display: block; text-align: center; margin-top: 1rem; font-size: 0.8rem; color: var(--text-muted); text-decoration: underline;">Limpar
                        Filtros</a>
                </form>
            </aside>

            <!-- Listagem de Veículos Encontrados -->
            <section class="results-content">

                <div class="results-header">
                    <!-- Quantidade total vinda do banco de dados -->
                    <div class="results-count"><span>6</span> veículos disponíveis</div>

                    <div class="sort-box">
                        <span class="text-muted" style="font-size: 0.85rem;">Ordenar por:</span>
                        <!-- Ao mudar a opção, submete o formulário via JavaScript para atualizar a query -->
                        <select class="sort-select" name="ordem" form="search-filters" onchange="this.form.submit()">
                            <option value="relevancia">Relevância</option>
                            <option value="preco_asc">Menor Preço</option>
                            <option value="preco_desc">Maior Preço</option>
                        </select>
                    </div>
                </div>

                <div class="cars-grid">

                    <!-- Card de Veículo (Este bloco será repetido pelo PHP foreach) -->
                    <?php foreach ($carros as $carro): ?>
                        <article class="card">
                            <div class="card-media">
                                <img src="<?= $carro['imagem_url']?>"
                                    alt="Veículo">
                                <span class="category-badge"><?= $carro['categoria']?></span>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">Volkswagen Polo</h3>
                                <div class="card-specs">
                                    <span class="spec-item">⚙️ Automático</span>
                                    <span class="spec-item">👤 5 Lugares</span>
                                </div>
                                <div class="card-footer">
                                    <div class="price-value">R$120<span>/dia</span></div>
                                    <!-- Link para a página de reserva passando o ID do veículo -->
                                    <a href="reserva.php?id=1" class="btn">Reservar</a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>

                </div>

                <!-- Placeholder para estado de "Nenhum Resultado" -->
                <?php if (empty($carros)): ?>
                    <div
                        style="display:none; text-align: center; padding: 5rem 2rem; background: white; border-radius: 20px; margin-top: 2rem; border: 1px solid var(--border-color);">
                        <h3 style="color: var(--text-muted); margin-bottom: 0.5rem;">Nenhum veículo encontrado</h3>
                        <p style="color: var(--text-muted);">Experimente ajustar os filtros de pesquisa para ver mais
                            opções.</p>
                    </div>
                <?php endif; ?>

            </section>
        </div>
    </main>

    <!-- Rodapé -->
    <footer>
        <div class="container">
            <p>© 2024 Locadora Ágil — Conduza com confiança e segurança.</p>
        </div>
    </footer>
</div>

</body>

</html>