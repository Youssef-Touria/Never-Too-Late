const champRecherche = document.getElementById('searchInput');
champRecherche.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
        alert('Tu as tapé : ' + champRecherche.value);
    }
});
const burger = document.querySelector('.burger');
const navLinks = document.querySelector('nav');

burger.addEventListener('click', () => {
    navLinks.classList.toggle('nav-open');
});

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.2 });

document.querySelectorAll('.service, .hero-text').forEach(el => {
    observer.observe(el);
});

const boutonsReponse = document.querySelectorAll('.reponse');
const question1 = document.getElementById('question1');
const resultat = document.getElementById('resultat');

boutonsReponse.forEach(bouton => {
    bouton.addEventListener('click', () => {
        question1.style.display = 'none';
        resultat.style.display = 'block';
    });
});