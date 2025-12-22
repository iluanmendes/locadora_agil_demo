<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Locadora Ágil — Liberdade para ir mais longe</title>
  <meta name="description" content="Locadora Ágil — Aluguéis de carros com opções econômicas, executivas e SUVs." />
  
  <!-- Ícones e Fontes -->
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- CSS Global Padronizado -->
  <link rel="stylesheet" href="css/style_global.css">

  <!-- Estilos Específicos da Home (Layout de Seções) -->
  <style>
    /* --- CONFIGURAÇÃO DAS SEÇÕES --- */
    section {
      padding: 5rem 1.5rem; /* Espaçamento vertical generoso */
    }

    .section-header {
      text-align: center;
      max-width: 700px;
      margin: 0 auto 3.5rem auto;
    }

    .section-header h3 {
      font-size: 2.25rem;
      color: var(--text-main);
      margin-bottom: 0.75rem;
    }

    .section-header p {
      color: var(--text-muted);
      font-size: 1.1rem;
    }

    /* Cores de Fundo Alternadas para Divisão Visual */
    .bg-white { background-color: var(--surface); }
    .bg-gray  { background-color: var(--bg-app); border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color); }
    
    /* --- HERO SECTION --- */
    .hero {
      display: grid;
      grid-template-columns: 1fr;
      gap: 3rem;
      padding-top: 2rem; /* Ajuste fino para o topo */
      padding-bottom: 4rem;
      align-items: center;
      max-width: var(--max-width);
      margin: 0 auto;
    }
    
    @media (min-width: 900px) {
      .hero { grid-template-columns: 1.2fr 1fr; padding-top: 4rem; }
    }

    .hero-content h2 { font-size: 2.75rem; line-height: 1.15; margin-bottom: 1.25rem; color: var(--text-main); }
    .hero-content p { font-size: 1.125rem; color: var(--text-muted); margin-bottom: 2rem; max-width: 500px; }

    /* Card de Busca Flutuante */
    .search-card {
      background: var(--surface);
      padding: 2rem;
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow-lg);
      border: 1px solid var(--border-color);
      position: relative;
      z-index: 10;
    }

    /* --- BENEFÍCIOS --- */
    .benefits-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
      max-width: var(--max-width);
      margin: 0 auto;
    }
    .benefit-card {
      background: var(--surface);
      padding: 2.5rem 2rem;
      border-radius: var(--radius-lg);
      text-align: center;
      border: 1px solid transparent;
      transition: all 0.3s ease;
    }
    .benefit-card:hover {
      border-color: var(--border-color);
      transform: translateY(-5px);
      box-shadow: var(--shadow-md);
    }
    .benefit-icon-wrapper {
      width: 70px; height: 70px;
      background: #eff6ff; /* Azul bem claro */
      color: var(--primary);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 1.5rem auto;
      font-size: 2rem;
    }

    /* --- FROTA --- */
    .fleet-container { max-width: var(--max-width); margin: 0 auto; }

    /* --- SOBRE NÓS (NOVO DESIGN) --- */
    .about-section {
      background-color: #1e293b; /* Slate 800 - Fundo escuro */
      color: white;
      padding: 6rem 1.5rem;
    }
    .about-grid {
      max-width: var(--max-width);
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4rem;
      align-items: center;
    }
    .about-stats {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
      margin-top: 2rem;
    }
    .stat-item h4 { font-size: 2.5rem; color: var(--primary); margin-bottom: 0; line-height: 1; }
    .stat-item p { color: #94a3b8; font-size: 0.95rem; margin-top: 0.5rem; }
    
    @media (max-width: 900px) {
      .about-grid { grid-template-columns: 1fr; }
      .about-image-placeholder { display: none; } /* Esconde imagem decorativa no mobile */
    }

    /* --- CTA SECTION --- */
    .cta-section {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: white;
      padding: 6rem 1.5rem;
      text-align: center;
    }
    .btn-cta-large {
      background: white;
      color: var(--primary);
      padding: 1.25rem 2.5rem;
      border-radius: 99px;
      font-weight: 800;
      font-size: 1.1rem;
      margin-top: 2rem;
      display: inline-block;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-cta-large:hover { transform: scale(1.05); box-shadow: 0 10px 25px rgba(0,0,0,0.2); }

  </style>

  <?php
  require_once __DIR__ . '\Class\Carro.php';
  require_once __DIR__ . '\Class\Categorias.php';

  $lista_carros = new Carro();
  $carros = $lista_carros->listar();

  $lista_categorias = new Categoria();
  $categorias = $lista_categorias->listarCategorias();
  ?>
</head>

<body>
  <div class="page">
    
    <!-- HEADER -->
    <header class="header">
      <div class="header-container">
        <a href="index.php" class="brand">
          <div class="logo">LA</div>
          <div>
            <h1>Locadora Ágil</h1>
          </div>
        </a>

        <nav class="nav">
          <a href="#frota">Frota</a>
          <a href="#sobre">Sobre</a>
          <button class="btn-account">Minha Conta</button>
        </nav>
      </div>
    </header>

    <main>
      
      <!-- SEÇÃO 1: HERO (Branco) -->
      <section class="bg-white" style="padding-top:0; padding-bottom:0;">
        <div class="hero">
          <!-- Texto Hero -->
          <div class="hero-content">
            <span style="color: var(--primary); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; font-size: 0.8rem; background: #eff6ff; padding: 6px 12px; border-radius: 20px;">Simples e Transparente</span>
            <h2 style="margin-top: 1.5rem;">Liberdade para descobrir novos caminhos.</h2>
            <p>Esqueça a burocracia. Na Locadora Ágil, você reserva em segundos, pega a chave e aproveita a viagem.</p>
            
            <div style="display: flex; gap: 1.5rem; font-size: 0.95rem;">
              <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-main); font-weight:500;">
                <i class="ph ph-shield-check" style="color: #10b981; font-size: 1.2rem;"></i> Seguro Incluso
              </div>
              <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-main); font-weight:500;">
                <i class="ph ph-thumbs-up" style="color: #10b981; font-size: 1.2rem;"></i> Sem taxas ocultas
              </div>
            </div>
          </div>

          <!-- Card de Busca -->
          <aside class="search-card">
            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
              <i class="ph ph-magnifying-glass" style="font-size: 1.25rem; color: var(--primary);"></i>
              <span style="font-weight: 700; font-size: 1.1rem; color: var(--text-main);">Encontre seu veículo</span>
            </div>

            <form action="pesquisa.php" method="GET">
              <div class="form-group">
                <label>O que você procura?</label>
                <select name="categoria">
                  <option value="all">Todas as categorias</option>
                  <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['nome'] ?>"><?= $categoria['nome'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label>Até quanto por dia? (R$)</label>
                <input name="preco_max" type="number" min="0" placeholder="Ex: 300" />
              </div>

              <div style="display:grid; grid-template-columns: 2fr 1fr; gap: 1rem;">
                <button class="btn" type="submit" style="width: 100%;">Buscar Agora</button>
                <button type="button" class="btn btn-secondary" onclick="this.form.reset()">Limpar</button>
              </div>
            </form>
          </aside>
        </div>
      </section>

      <!-- SEÇÃO 2: BENEFÍCIOS (Cinza Claro) -->
      <section class="bg-gray" id="beneficios">
        <div class="section-header">
          <h3>Por que escolher a Ágil?</h3>
          <p>Mais do que aluguel de carros, entregamos tranquilidade para sua jornada.</p>
        </div>

        <div class="benefits-grid">
          <div class="benefit-card">
            <div class="benefit-icon-wrapper">
              <i class="ph ph-shield-check"></i>
            </div>
            <h4>Segurança Total</h4>
            <p style="color: var(--text-muted); margin-top: 0.5rem;">Veículos revisados em 40 pontos antes de cada entrega para sua total segurança.</p>
          </div>
          <div class="benefit-card">
            <div class="benefit-icon-wrapper">
              <i class="ph ph-clock-afternoon"></i>
            </div>
            <h4>Retirada Expressa</h4>
            <p style="color: var(--text-muted); margin-top: 0.5rem;">Processo 100% digital. Check-in online e chave na mão em 15 minutos.</p>
          </div>
          <div class="benefit-card">
            <div class="benefit-icon-wrapper">
              <i class="ph ph-wallet"></i>
            </div>
            <h4>Preço Transparente</h4>
            <p style="color: var(--text-muted); margin-top: 0.5rem;">O valor que você vê na reserva é o valor final. Sem surpresas no balcão.</p>
          </div>
        </div>
      </section>

      <!-- SEÇÃO 3: FROTA (Branco) -->
      <section class="bg-white" id="frota">
        <div class="section-header">
          <h3>Destaques da nossa Frota</h3>
          <p>Modelos modernos, econômicos e confortáveis para qualquer ocasião.</p>
        </div>

        <div class="fleet-container">
          <div class="cars-grid">
            <?php 
            // Limita a mostrar apenas os primeiros 4 carros na home para não poluir
            $destaques = array_slice($carros, 0, 4);
            foreach ($destaques as $carro): 
            ?>
              <article class="card">
                <div class="card-media">
                   <img src="<?= $carro['imagem_url'] ?>" alt="<?= $carro['modelo'] ?>" loading="lazy" style="width:100%; height:100%; object-fit:cover;" />
                </div>
                <div class="card-body">
                  <h4 class="card-title"><?= $carro['modelo'] ?></h4>
                  <p class="card-text"><?= $carro['descricao'] ?></p>
                  
                  <div class="card-meta">
                    <div class="price">R$ <?= $carro['preco_diaria'] ?><span>/dia</span></div>
                    <a href="carro_detalhe.php?id=<?= $carro['id'] ?>" class="btn" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Ver Oferta</a>
                  </div>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
          
          <div style="text-align: center; margin-top: 3rem;">
            <a href="pesquisa.php" class="btn btn-secondary" style="padding: 1rem 2rem;">Ver todos os veículos &rarr;</a>
          </div>
        </div>
      </section>

      <!-- SEÇÃO 4: SOBRE (Escuro/Institucional) -->
      <section class="about-section" id="sobre">
        <div class="about-grid">
          <div>
            <span style="color: var(--primary); font-weight: 700; letter-spacing: 1px;">SOBRE A LOCADORA ÁGIL</span>
            <h3 style="font-size: 2.5rem; margin: 1rem 0; color: white;">Compromisso com a sua mobilidade desde 2015.</h3>
            <p style="color: #cbd5e1; line-height: 1.8; font-size: 1.1rem; margin-bottom: 2rem;">
              Nossa missão é simplificar o aluguel de carros. Oferecemos veículos modernos com um atendimento ágil. 
              Eliminamos a papelada desnecessária para que você gaste seu tempo dirigindo, não assinando documentos.
            </p>
            <div class="about-stats">
              <div class="stat-item">
                <h4>10k+</h4>
                <p>Clientes Satisfeitos</p>
              </div>
              <div class="stat-item">
                <h4>500+</h4>
                <p>Veículos na Frota</p>
              </div>
            </div>
          </div>
          
          <!-- Elemento decorativo visual -->
          <div class="about-image-placeholder" style="display: flex; justify-content: center; align-items: center;">
            <div style="width: 100%; height: 350px; background: rgba(255,255,255,0.05); border-radius: 24px; display: flex; align-items: center; justify-content: center; border: 2px dashed rgba(255,255,255,0.1);">
               <i class="ph ph-buildings" style="font-size: 8rem; color: rgba(255,255,255,0.1);"></i>
            </div>
          </div>
        </div>
      </section>

      <!-- SEÇÃO 5: CTA FINAL -->
      <section class="cta-section">
        <div style="max-width: 700px; margin: 0 auto;">
          <h2 style="font-size: 2.5rem; color: white; margin-bottom: 1rem; line-height: 1.2;">Pronto para sua próxima aventura?</h2>
          <p style="opacity: 0.9; font-size: 1.2rem;">Baixe nosso App e ganhe 10% de desconto na primeira reserva.</p>
          <a href="#" class="btn-cta-large">Baixar App Agora</a>
        </div>
      </section>

    </main>

    <footer>
      <div class="container">
        <span class="logo-text">LA</span>
        <p>Locadora Ágil — Conduza com confiança.</p>
        <div style="margin-top: 1rem; font-size: 0.9rem;">
          © <?= date('Y') ?> Locadora Ágil • <a href="#">Termos</a> • <a href="#">Privacidade</a>
        </div>
      </div>
    </footer>
  </div>
</body>
</html>