<?php
require_once __DIR__ . '\Class\Carro.php';
require_once __DIR__ . '\Class\Categorias.php';

// 1. Carregamento de Dados
$objeto_carro = new Carro();
$todos_carros = $objeto_carro->listar();
$objeto_categoria = new Categoria();
$lista_categorias = $objeto_categoria->listarCategorias();

// 2. Lógica de Filtros
$filtro_categorias = [];
if (isset($_GET['categorias']) && is_array($_GET['categorias'])) {
    $filtro_categorias = $_GET['categorias'];
} elseif (isset($_GET['categoria']) && $_GET['categoria'] !== 'all' && $_GET['categoria'] !== '') {
    $filtro_categorias = [$_GET['categoria']];
}

$filtro_preco_max = $_GET['preco'] ?? $_GET['preco_max'] ?? null;
$filtro_cambio = $_GET['cambio'] ?? 'todos';
$ordem = $_GET['ordem'] ?? 'relevancia';
$pagina_atual = basename($_SERVER['PHP_SELF']);

// 3. Aplicação dos Filtros
$carros_filtrados = [];
foreach ($todos_carros as $carro) {
    $passou = true;
    if (!empty($filtro_categorias)) {
        if (!in_array($carro['categoria'], $filtro_categorias)) $passou = false;
    }
    if ($filtro_preco_max) {
        if ($carro['preco_diaria'] > $filtro_preco_max) $passou = false;
    }
    if ($filtro_cambio !== 'todos') {
        if (isset($carro['cambio']) && strtolower($carro['cambio']) !== strtolower($filtro_cambio)) $passou = false;
    }
    if ($passou) $carros_filtrados[] = $carro;
}

// 4. Ordenação
if ($ordem === 'preco_asc') {
    usort($carros_filtrados, fn($a, $b) => $a['preco_diaria'] <=> $b['preco_diaria']);
} elseif ($ordem === 'preco_desc') {
    usort($carros_filtrados, fn($a, $b) => $b['preco_diaria'] <=> $a['preco_diaria']);
}
$carros = $carros_filtrados;
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Pesquisa de Veículos — Locadora Ágil</title>
    
    <!-- Ícones e Fontes -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- CSS: Global primeiro, depois Pesquisa -->
    <link rel="stylesheet" href="css/style_global.css">
    <link rel="stylesheet" href="css/style_pesquisa.css">
</head>

<body>
<div class="page">

    <!-- Header -->
    <header class="header">
      <div class="header-container">
        <a href="index.php" class="brand">
          <div class="logo">LA</div>
          <div><h1>Locadora Ágil</h1></div>
        </a>
        <nav class="nav">
          <a href="index.php">Home</a>
          <a href="minhas-reservas.php">Minhas Reservas</a>
          <button class="btn-account">Entrar</button>
        </nav>
      </div>
    </header>

    <main class="container" style="padding-top: 2rem;">
        
        <!-- Grid Layout: Sidebar + Conteúdo -->
        <div class="results-layout">

            <!-- Coluna 1: Filtros -->
            <aside class="filter-sidebar">
                <form action="<?= $pagina_atual ?>" method="GET" id="search-filters">
                    
                    <div class="filter-section">
                        <div class="filter-title">Categorias</div>
                        <?php foreach ($lista_categorias as $cat): ?>
                            <?php $checked = in_array($cat['nome'], $filtro_categorias) ? 'checked' : ''; ?>
                            <label class="filter-option">
                                <input type="checkbox" name="categorias[]" value="<?= $cat['nome'] ?>" <?= $checked ?>>
                                <?= $cat['nome'] ?>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <div class="filter-section">
                        <div class="filter-title">Câmbio</div>
                        <label class="filter-option">
                            <input type="radio" name="cambio" value="todos" <?= $filtro_cambio === 'todos' ? 'checked' : '' ?>> Todos
                        </label>
                        <label class="filter-option">
                            <input type="radio" name="cambio" value="manual" <?= $filtro_cambio === 'manual' ? 'checked' : '' ?>> Manual
                        </label>
                        <label class="filter-option">
                            <input type="radio" name="cambio" value="automatico" <?= $filtro_cambio === 'automatico' ? 'checked' : '' ?>> Automático
                        </label>
                    </div>

                    <div class="filter-section">
                        <div class="filter-title">Preço Máximo</div>
                        <div class="price-range-group">
                            <input type="number" name="preco_max" placeholder="R$ Máximo" value="<?= $filtro_preco_max ?>">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-apply-filters">Aplicar Filtros</button>
                    
                    <?php if(!empty($_GET)): ?>
                    <a href="<?= $pagina_atual ?>" style="display: block; text-align: center; margin-top: 1rem; font-size: 0.85rem; color: var(--text-muted); text-decoration: underline;">
                        Limpar Filtros
                    </a>
                    <?php endif; ?>
                </form>
            </aside>

            <!-- Coluna 2: Resultados -->
            <section class="results-content">
                <div class="results-header">
                    <div class="results-count">
                        Encontrados <strong><?= count($carros) ?></strong> veículos
                    </div>
                    <div class="sort-box">
                        <span style="font-size:0.9rem; color:var(--text-muted)">Ordenar:</span>
                        <select class="sort-select" name="ordem" form="search-filters" onchange="this.form.submit()">
                            <option value="relevancia" <?= $ordem === 'relevancia' ? 'selected' : '' ?>>Relevância</option>
                            <option value="preco_asc" <?= $ordem === 'preco_asc' ? 'selected' : '' ?>>Menor Preço</option>
                            <option value="preco_desc" <?= $ordem === 'preco_desc' ? 'selected' : '' ?>>Maior Preço</option>
                        </select>
                    </div>
                </div>

                <div class="cars-grid">
                    <?php foreach ($carros as $carro): ?>
                        <article class="card">
                            <div style="position: relative;">
                                <img class="card-media" src="<?= $carro['imagem_url'] ?? '' ?>" alt="<?= $carro['modelo'] ?>" loading="lazy">
                                <span class="badge" style="position:absolute; top:10px; right:10px; background: rgba(255,255,255,0.9);">
                                    <?= $carro['categoria'] ?>
                                </span>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title"><?= $carro['modelo'] ?></h3>
                                <div class="card-meta">
                                    <div class="price">R$ <?= $carro['preco_diaria'] ?><span>/dia</span></div>
                                    <a href="carro_detalhe.php?id=<?= $carro['id'] ?>" class="btn" style="padding: 0.5rem 1rem;">Reservar</a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <?php if (empty($carros)): ?>
                    <div class="empty-state">
                        <i class="ph ph-car" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
                        <h3>Nenhum veículo encontrado</h3>
                        <p style="color: var(--text-muted);">Tente ajustar seus filtros de busca.</p>
                        <a href="<?= $pagina_atual ?>" class="btn btn-secondary" style="margin-top: 1rem;">Limpar Filtros</a>
                    </div>
                <?php endif; ?>
            </section>
        </div>
    </main>

    <footer>
        <div class="container">
            <span class="logo-text">LA</span>
            <p>Locadora Ágil — Conduza com confiança.</p>
            <div style="margin-top: 1rem; font-size: 0.9rem;">
                © <?= date('Y') ?> Locadora Ágil
            </div>
        </div>
    </footer>
</div>
</body>
</html>