document.addEventListener('DOMContentLoaded', function () {
    const heroRows = document.querySelectorAll('.hero-row');
    const heroCard = document.getElementById('hero-card');
    const heroName = document.getElementById('hero-name');
    const heroClass = document.getElementById('hero-class');
    const heroImg = document.getElementById('hero-img');
    const closeCardButton = document.getElementById('close-card');

    heroRows.forEach(row => {
        row.addEventListener('click', function () {
            const name = row.dataset.name;
            const heroClassData = row.dataset.class;
            const imgIndex = row.dataset.imgIndex;

            heroName.textContent = name;
            heroClass.textContent = heroClassData;
            const index = row.dataset.id.padStart(2, '0');
            heroImg.src = `/img/characters/artwork/strm_hero_book_${index}_01_0.png`;
            heroImg.alt = name;

            heroCard.style.display = 'block';
        });
    });

    closeCardButton.addEventListener('click', function () {
        heroCard.style.display = 'none';
    });
});
