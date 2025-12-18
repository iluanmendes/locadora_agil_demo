 // Inserir ano no rodapé
 document.getElementById('year').textContent = new Date().getFullYear();

 // Filtro simples (JavaScript mantido igual)
 const form = document.getElementById('search-form');
 const grid = document.getElementById('cars-grid');
 const cards = Array.from(grid.querySelectorAll('.card'));

 function applyFilter(filters) {
   cards.forEach(card => {
     const cat = card.dataset.category;
     const price = Number(card.dataset.price);
     let visible = true;
     if (filters.category && filters.category !== 'all') visible = visible && (cat === filters.category);
     if (filters.price) visible = visible && (price <= Number(filters.price));
     
     // Usando opacidade para uma transição mais suave se desejar, mas display funciona bem
     card.style.display = visible ? 'flex' : 'none'; 
   });
 }

 form.addEventListener('submit', (e) => {
   e.preventDefault();
   const filters = {
     category: form.category.value,
     price: form.price.value || null
   };
   applyFilter(filters);
 });

 document.getElementById('reset').addEventListener('click', () => {
   form.reset();
   applyFilter({ category: 'all' });
 });

 // Reservar -> demonstração: foca no primeiro card visível
 document.getElementById('open-reserve').addEventListener('click', () => {
   const firstVisible = cards.find(c => c.style.display !== 'none');
   // Focando no botão dentro do card
   if (firstVisible) firstVisible.querySelector('.btn-lease').focus();
 });

 // Ação do botão alugar (simples)
 grid.addEventListener('click', (e) => {
   // Verificando se o clique foi no botão ou dentro dele
   const btn = e.target.closest('.btn-lease');
   if (btn) {
     const card = btn.closest('.card');
     const title = card.querySelector('.card-title').textContent;
     alert('Iniciando reserva para: ' + title + '\n(Backend pendente)');
   }
 });