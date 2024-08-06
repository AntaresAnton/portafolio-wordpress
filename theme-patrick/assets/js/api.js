// // Reusable function to fetch and process data
// async function fetchAndProcessData(url, processFunction) {
//     try {
//       const response = await fetch(url);
//       const data = await response.json();
//       data.data.forEach(processFunction);
//     } catch (error) {
//       console.error('Error fetching or processing data:', error);
//     }
//   }
  
//   // Function to create portfolio items
//   function createPortfolioItem(item) {
//     const portfolioList = document.getElementById('portafolio-item');
//     const listItem = document.createElement('li');
//     listItem.innerHTML = `
//       <figure>
//         <img src="${item.IMAGEN1}.jpg" alt="${item.NOMBRE_PROYECTO}" />
//         <div><span>${item.NOMBRE_PROYECTO}</span></div>
//       </figure>
//     `;
//     portfolioList.appendChild(listItem);
//   }
  
//   // Function to create portfolio details
//   function createPortfolioDetail(item) {
//     const portfolioDesc = document.getElementById('portafolio-desc');
//     const listItem = document.createElement('li');
//     listItem.innerHTML = `
//       <figure>
//         <figcaption>
//           <h3>${item.NOMBRE_PROYECTO}</h3>
//           <div class="row open-sans-font">
//             <div class="col-6 mb-2">
//               <i class="fa fa-file-text-o pr-2"></i><span class="project-label">Título </span>: <span class="ft-wt-600 uppercase">${item.NOMBRE_PROYECTO}</span>
//             </div>
//             <div class="col-6 mb-2">
//               <i class="fa fa-user-o pr-2"></i><span class="project-label">Cliente </span>: <span class="ft-wt-600 uppercase">${item.CLIENTE || 'N/A'}</span>
//             </div>
//             <div class="col-6 mb-2">
//               <i class="fa fa-code pr-2"></i><span class="project-label">Herram. Utilizadas </span>: <span class="ft-wt-600 uppercase">${item.HERRAMIENTAS_UTILIZADAS || 'N/A'}</span>
//             </div>
//             <div class="col-6 mb-2">
//               <i class="fa fa-external-link pr-2"></i><span class="project-label">Sitio </span>: <span class="ft-wt-600 uppercase"><a href="https://${item.SITIO_WEB}/" target="_blank">${item.SITIO_WEB || 'N/A'}</a></span>
//             </div>
//             <div class="col-6 mb-2">
//               <i class="fa fa-calendar-o pr-2"></i> <span class="project-label">Fecha Inicio </span>: <span class="ft-wt-600 uppercase">${item.FECHA_INICIO || 'N/A'}</span>
//             </div>
//             <div class="col-6 mb-2">
//               <i class="fa fa-calendar-check-o pr-2"></i><span class="project-label">Fecha Término </span>: <span class="ft-wt-600 uppercase">${item.FECHA_TERMINO || 'N/A'}</span>
//             </div>
//           </div>
//         </figcaption>
//         <div id="slider" class="random carousel slide portfolio-slider" data-ride="carousel" data-interval="false">
//           <ol class="carousel-indicators">
//             <li data-target="slider" class="dtarget active" data-slide-to="0"></li>
//             <li data-target="slider" class="dtarget" data-slide-to="1"></li>
//             <li data-target="slider" class="dtarget" data-slide-to="2"></li>
//           </ol>
//           <div class="carousel-inner">
//             <div class="carousel-item active">
//               <img src="${item.IMAGEN1}.jpg" alt="${item.NOMBRE_PROYECTO} - Imagen 1" />
//             </div>
//             <div class="carousel-item">
//               <img src="${item.IMAGEN2}.jpg" alt="${item.NOMBRE_PROYECTO} - Imagen 2" />
//             </div>
//             <div class="carousel-item">
//               <img src="${item.IMAGEN3}.jpg" alt="${item.NOMBRE_PROYECTO} - Imagen 3" />
//             </div>
//           </div>
//         </div>
//       </figure>
//     `;
//     portfolioDesc.appendChild(listItem);
//   }
  
//   // Main function to initialize the portfolio
//   async function initializePortfolio() {
//     await fetchAndProcessData('data.json', createPortfolioItem);
//     await fetchAndProcessData('data.json', createPortfolioDetail);
//   }
  
//   // Call the main function when the DOM is fully loaded
//   document.addEventListener('DOMContentLoaded', initializePortfolio);
  


// Reusable function to fetch and process data
async function fetchAndProcessData(url, processFunction) {
  try {
    const response = await fetch(url);
    const data = await response.json();
    data.data.forEach(processFunction);
  } catch (error) {
    console.error('Error fetching or processing data:', error);
  }
}

// Function to create portfolio items
function createPortfolioItem(item) {
  const portfolioList = document.getElementById('portafolio-item');
  const listItem = document.createElement('li');
  listItem.innerHTML = `
    <figure>
      <a href="${item.IMAGEN1}.jpg" data-fancybox="gallery" data-caption="${item.NOMBRE_PROYECTO}">
        <img src="${item.IMAGEN1}.jpg" alt="${item.NOMBRE_PROYECTO}" />
        <div><span>${item.NOMBRE_PROYECTO}</span></div>
      </a>
    </figure>
  `;
  portfolioList.appendChild(listItem);
}

// Function to create portfolio details
function createPortfolioDetail(item) {
  const portfolioDesc = document.getElementById('portafolio-desc');
  const listItem = document.createElement('li');
  listItem.innerHTML = `
    <figure>
      <figcaption>
        <h3>${item.NOMBRE_PROYECTO}</h3>
        <div class="row open-sans-font">
          <div class="col-6 mb-2">
            <i class="fa fa-file-text-o pr-2"></i><span class="project-label">Título </span>: <span class="ft-wt-600 uppercase">${item.NOMBRE_PROYECTO}</span>
          </div>
          <div class="col-6 mb-2">
            <i class="fa fa-user-o pr-2"></i><span class="project-label">Cliente </span>: <span class="ft-wt-600 uppercase">${item.CLIENTE || 'N/A'}</span>
          </div>
          <div class="col-6 mb-2">
            <i class="fa fa-code pr-2"></i><span class="project-label">Herram. Utilizadas </span>: <span class="ft-wt-600 uppercase">${item.HERRAMIENTAS_UTILIZADAS || 'N/A'}</span>
          </div>
          <div class="col-6 mb-2">
            <i class="fa fa-external-link pr-2"></i><span class="project-label">Sitio </span>: <span class="ft-wt-600 uppercase"><a href="https://${item.SITIO_WEB}/" target="_blank">${item.SITIO_WEB || 'N/A'}</a></span>
          </div>
          <div class="col-6 mb-2">
            <i class="fa fa-calendar-o pr-2"></i> <span class="project-label">Fecha Inicio </span>: <span class="ft-wt-600 uppercase">${item.FECHA_INICIO || 'N/A'}</span>
          </div>
          <div class="col-6 mb-2">
            <i class="fa fa-calendar-check-o pr-2"></i><span class="project-label">Fecha Término </span>: <span class="ft-wt-600 uppercase">${item.FECHA_TERMINO || 'N/A'}</span>
          </div>
        </div>
      </figcaption>
      <div id="slider" class="random carousel slide portfolio-slider" data-ride="carousel" data-interval="false">
        <ol class="carousel-indicators">
          <li data-target="slider" class="dtarget active" data-slide-to="0"></li>
          <li data-target="slider" class="dtarget" data-slide-to="1"></li>
          <li data-target="slider" class="dtarget" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="${item.IMAGEN1}.jpg" alt="${item.NOMBRE_PROYECTO} - Imagen 1" />
          </div>
          <div class="carousel-item">
            <img src="${item.IMAGEN2}.jpg" alt="${item.NOMBRE_PROYECTO} - Imagen 2" />
          </div>
          <div class="carousel-item">
            <img src="${item.IMAGEN3}.jpg" alt="${item.NOMBRE_PROYECTO} - Imagen 3" />
          </div>
        </div>
      </div>
    </figure>
  `;
  portfolioDesc.appendChild(listItem);
}

// Main function to initialize the portfolio
async function initializePortfolio() {
  await fetchAndProcessData('data.json', createPortfolioItem);
  await fetchAndProcessData('data.json', createPortfolioDetail);
}

// Call the main function when the DOM is fully loaded and initialize Fancybox
document.addEventListener('DOMContentLoaded', async () => {
  await initializePortfolio();
  Fancybox.bind("[data-fancybox]", {
    // Fancybox options here
  });
});
