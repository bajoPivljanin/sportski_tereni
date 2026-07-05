// Selektujemo elemente sa stranice
const registerTrigger = document.getElementById('register-trigger');
const registerOverlay = document.getElementById('register-overlay');
const registerClose = document.getElementById('register-close');
// Kada korisnik klikne na "Registracija" u navigaciji
registerTrigger.addEventListener('click', function(event) {
    event.preventDefault(); // Sprečava podrazumevano osvežavanje stranice
    registerOverlay.classList.add('active'); // Prikazuje zatamnjenje i formu
});
// Kada korisnik klikne na dugme X
registerClose.addEventListener('click', function() {
    registerOverlay.classList.remove('active'); // Skriva zatamnjenje i formu
});
// BONUS: Ako korisnik klikne bilo gde u prazno crnilo van forme, modal se zatvara
registerOverlay.addEventListener('click', function(event) {
    if (event.target === registerOverlay) {
        registerOverlay.classList.remove('active');
    }
});