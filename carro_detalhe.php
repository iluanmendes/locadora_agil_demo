<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Detalhes do Veículo — Locadora Ágil</title>
  
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="css/style_global.css">

  <?php
  require_once __DIR__ . '\Class\Carro.php';
  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  
  if ($id) {
      $carroObj = new Carro();
      $carro = $carroObj->buscarPorId($id);
  } else {
      header('Location: index.php');
      exit;
  }
  ?>

  <style>
    /* CSS Específico da Página de Detalhes */
    .detail-container {
      display: grid;
      grid-template-columns: 1fr 380px;
      gap: 3rem;
      align-items: start;
      margin-top: 2rem;
      margin-bottom: 4rem;
    }

    .detail-media {
      border-radius: var(--radius-lg);
      overflow: hidden;
      box-shadow: var(--shadow-md);
      background: var(--surface);
      margin-bottom: 2rem;
      margin-top: 0;
    }
    .detail-media img { width: 100%; height: 400px; object-fit: cover; }

    .detail-header { margin-bottom: 1.5rem; }
    .detail-title { font-size: 2.25rem; margin-bottom: 0.5rem; }
    
    .specs-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
      gap: 1rem;
      margin: 2rem 0;
    }

    .spec-item {
      background: var(--surface);
      border: 1px solid var(--border-color);
      border-radius: var(--radius-md);
      padding: 1rem;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.5rem;
    }
    .spec-icon { font-size: 1.5rem; color: var(--primary); }

    /* Card Reserva Sticky */
    .booking-sidebar {
      background: var(--surface);
      border-radius: var(--radius-lg);
      padding: 2rem;
      box-shadow: var(--shadow-lg);
      border: 1px solid var(--border-color);
      position: sticky;
      top: 100px;
    }

    .price-total { font-size: 2.5rem; font-weight: 800; color: var(--text-main); }
    
    .check-list { list-style: none; padding: 0; margin: 1.5rem 0; }
    .check-list li {
      display: flex; gap: 0.75rem; margin-bottom: 0.75rem;
      color: var(--text-muted); font-size: 0.95rem;
    }

    @media (max-width: 900px) {
      .detail-container { grid-template-columns: 1fr; }
      .detail-media img { height: 300px; }
      .booking-sidebar { position: static; }
    }
  </style>
</head>

<body>
  <div class="page">
    
    <!-- HEADER PADRONIZADO -->
    <header class="header">
      <div class="header-container">
        <a href="index.php" class="brand">
          <div class="logo">LA</div>
          <div><h1>Locadora Ágil</h1></div>
        </a>
        <nav class="nav">
          <a href="index.php">Voltar</a>
          <button class="btn-account">Minha Conta</button>
        </nav>
      </div>
    </header>

    <main class="container">
      <div style="margin-top: 1.5rem; color: var(--text-muted); font-size: 0.9rem;">
        <a href="index.php">Home</a> &rsaquo; <span><?= $carro['modelo'] ?></span>
      </div>

      <div class="detail-container">
        <!-- Conteúdo Esquerda -->
        <div class="content-side">
          <div class="detail-header">
            <span class="badge" style="font-size:0.85rem; margin-bottom:0.5rem; display:inline-block;"><?= $carro['categoria'] ?></span>
            <h2 class="detail-title"><?= $carro['modelo'] ?></h2>
            <p class="muted">Código: #<?= str_pad($carro['id'], 4, '0', STR_PAD_LEFT) ?></p>
          </div>

          <figure class="detail-media">
            <img src="<?= $carro['imagem_url'] ?>" alt="Foto do <?= $carro['modelo'] ?>">
          </figure>

          <h3>Especificações</h3>
          <div class="specs-grid">
            <div class="spec-item">
              <i class="ph ph-gear spec-icon"></i>
              <span>Câmbio</span>
              <strong><?= $carro['cambio'] ?? 'Manual' ?></strong>
            </div>
            <div class="spec-item">
              <i class="ph ph-lightning spec-icon"></i>
              <span>Motor</span>
              <strong><?= $carro['motor'] ?? '1.0 Flex' ?></strong>
            </div>
            <div class="spec-item">
              <i class="ph ph-users spec-icon"></i>
              <span>Lugares</span>
              <strong><?= $carro['lugares'] ?? '5' ?></strong>
            </div>
            <div class="spec-item">
              <i class="ph ph-snowflake spec-icon"></i>
              <span>Ar Cond.</span>
              <strong><?= ($carro['ar_condicionado'] ?? true) ? 'Sim' : 'Não' ?></strong>
            </div>
          </div>

          <div style="margin-top: 2.5rem;">
            <h3>Sobre o veículo</h3>
            <p style="color: var(--text-muted); line-height: 1.7;">
              <?= $carro['descricao'] ?>
            </p>
          </div>
        </div>

        <!-- Sidebar Direita -->
        <aside class="booking-sidebar">
          <div style="border-bottom: 1px solid var(--border-color); padding-bottom: 1.5rem; margin-bottom: 1.5rem;">
            <div style="color:var(--text-muted); font-weight:500;">Diária a partir de</div>
            <div class="price-total">R$ <?= number_format($carro['preco_diaria'], 2, ',', '.') ?></div>
            <div style="color: #10b981; font-size: 0.9rem; font-weight: 600; margin-top: 0.5rem; display:flex; align-items:center; gap:5px;">
              <i class="ph ph-check-circle"></i> Disponível agora
            </div>
          </div>

          <ul class="check-list">
            <li><i class="ph ph-check" style="color:#10b981"></i> Km Livre</li>
            <li><i class="ph ph-check" style="color:#10b981"></i> Proteção Básica</li>
            <li><i class="ph ph-check" style="color:#10b981"></i> Cancelamento Grátis</li>
          </ul>

          <form action="checkout.php" method="GET">
            <input type="hidden" name="id_carro" value="<?= $carro['id'] ?>">
            
            <div class="form-group">
              <label for="dias">Duração (dias)</label>
              <input type="number" id="dias" name="dias" value="1" min="1" max="30">
            </div>

            <button type="submit" class="btn" style="width: 100%; font-size: 1.1rem; padding: 1rem;">
              Reservar Agora
            </button>
          </form>
        </aside>
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