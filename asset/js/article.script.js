// console.log('connecté');
let petitesImages = document.querySelectorAll('.miniImage');
let grandeImage = document.querySelector('.grandImage');

// Ajouter des écouteurs d'événements de clic à chaque petite image
    petitesImages.forEach((petiteImage) => {
    petiteImage.addEventListener('click', () => {
    // Obtenir la source de la petite image cliquée
    let src = petiteImage.getAttribute('src');
    
    // Définir la source de la grande image comme celle de la petite image cliquée
    grandeImage.innerHTML = `<img src="${src}" alt="produit" class="w-75">`;
  });
});
//   Mettre en avant la première image par défaut
petitesImages[0].classList.add('selected');
let firstImageSrc = petitesImages[0].getAttribute('src');
grandeImage.innerHTML = `<img src="${firstImageSrc}" alt="produit" class="w-75">`;
