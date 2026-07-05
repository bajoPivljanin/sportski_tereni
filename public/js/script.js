
const registerTrigger = document.getElementById('register-trigger');
const registerOverlay = document.getElementById('register-overlay');
const registerClose = document.getElementById('register-close');

registerTrigger.addEventListener('click', function(event) {
    event.preventDefault(); 
    registerOverlay.classList.add('active');
});
registerClose.addEventListener('click', function() {
    registerOverlay.classList.remove('active'); 
});
registerOverlay.addEventListener('click', function(event) {
    if (event.target === registerOverlay) {
        registerOverlay.classList.remove('active');
    }
});