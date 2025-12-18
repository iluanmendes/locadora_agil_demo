<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Locadora Ágil — Aluguel de Carros Moderno</title>
  <meta name="description"
    content="Locadora Ágil — Aluguéis de carros com opções econômicas, executivas e SUVs. Reserva online rápida e segura." />
  <meta name="keywords" content="locadora, aluguel de carros, carro para alugar, rent a car, reserva" />
  <link rel="icon"
    href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🚗</text></svg>" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css\style_global.css">

  <?php

    require_once __DIR__ . '/Carro.php';

    $lista_carros = new Carro();
    $carros = $lista_carros->listar();

  ?>


</head>

<body>
  <div class="page" id="page">
    <header class="header" role="banner">
      <a href="#" class="brand" aria-label="Locadora Ágil - página inicial">
        <div class="logo" aria-hidden="true">LA</div>
        <div>
          <h1>Locadora Ágil</h1>
          <div class="muted" style="font-size:.85rem; font-weight:500">Alugue rápido. Dirija feliz.</div>
        </div>
      </a>

      <nav class="nav" role="navigation" aria-label="Menu principal"> 
        <a href="#cars">Veículos</a>
        <a href="#about">Sobre</a>
        <button class="btn" id="open-reserve">Reservar</button>
      </nav>
    </header>

    <main>
      <section class="hero" aria-labelledby="hero-title">
        <div class="intro">
          <h2 id="hero-title">Encontre o carro perfeito para sua próxima jornada.</h2>
          <p>Simples, rápido e transparente. Selecione a categoria, suas datas e caia na estrada com segurança e
            conforto.</p>
        </div>

        <aside class="search-card" aria-label="Busca de veículos">
          <form id="search-form">
            <div class="form-group">
              <label for="category">Categoria do veículo</label>
              <select id="category" name="category">
                <option value="all">Todas as categorias</option>
                <option value="Econômico">Econômico</option>
                <option value="Executivo">Executivo</option>
                <option value="suv">SUV</option>
              </select>
            </div>

            <div class="search-row">
              <div style="flex:1">
                <label for="from">Retirada</label>
                <input id="from" type="date" aria-label="Data de retirada" />
              </div>
              <div style="flex:1">
                <label for="to">Devolução</label>
                <input id="to" type="date" aria-label="Data de devolução" />
              </div>
            </div>

            <div class="form-group">
              <label for="price">Preço máximo por dia (R$)</label>
              <input id="price" type="number" min="0" placeholder="Ex: 250" aria-label="Preço máximo" />
            </div>

            <div style="display:grid; grid-template-columns: 2fr 1fr; gap:.75rem;">
              <button class="btn" type="submit">Filtrar Veículos</button>
              <button type="button" id="reset" class="btn btn-secondary">Limpar</button>
            </div>
          </form>
        </aside>
      </section>

      <section id="cars" aria-labelledby="cars-title">
        <h3 id="cars-title">Nossa frota disponível</h3>

        <div class="cars-grid" id="cars-grid">

          <!-- ?= htmlspecialchars($produto) ? -->

          <?php foreach ($carros as $carro): ?>

            <article class="card" data-category="<?= $carro['categoria'] ?>" data-price="95">
              <img class="card-media" src="<?= $carro['imagem_url'] ?>" alt="<?= $carro['modelo'] ?>" loading="lazy" />
              <div class="card-body">
                <div>
                  <h4 class="card-title"><?= $carro['modelo'] ?></h4>
                  <p class="card-text"><?= $carro['descricao'] ?></p>
                </div>
                <div class="card-meta">
                  <span class="badge"><?= $carro['categoria'] ?></span>
                  <div class="price">R$ <?= $carro['preco_diaria'] ?><span>/dia</span></div>
                </div>
              </div>
              <div class="card-actions">
                <button class="btn btn-lease" data-id="1">Alugar agora</button>
                <a href="#" class="details-link">Ver detalhes e fotos</a>
              </div>
            </article>
            
          <?php endforeach; ?>



        </div>
      </section>

      <section id="about" style="margin-top:4rem; max-width: 800px;">
        <h3>Sobre a Locadora Ágil</h3>
        <p class="muted" style="font-size: 1.05rem;">Fundada em 2015, nossa missão é simplificar o aluguel de carros.
          Oferecemos veículos modernos e seguros com um atendimento ágil e 100% transparente. Todos os veículos passam
          por uma rigorosa checagem de 40 pontos antes de cada locação para garantir sua tranquilidade.</p>
      </section>
    </main>

    <footer>
      © <span id="year"></span> Locadora Ágil — Todos os direitos reservados • <a href="#">Política de Privacidade</a> •
      <a href="#">Termos de Uso</a>
    </footer>
  </div>


  <script src="js/js_principal.js"></script>
</body>

</html>