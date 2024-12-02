document.addEventListener('DOMContentLoaded', function () {
    const characterRows = document.querySelectorAll('.character-row');
    const characterCard = document.getElementById('character-card');
    const characterName = document.getElementById('character-name');
    const characterClass = document.getElementById('character-class');
    const characterImg = document.getElementById('character-img');
    const closeCardButton = document.getElementById('close-card');

    characterRows.forEach(row => {
        row.addEventListener('click', function () {
            const name = row.dataset.name;
            const characterClassData = row.dataset.class;
            const imgIndex = row.dataset.imgIndex;

            characterName.textContent = name;
            characterClass.textContent = characterClassData;
            const index = row.dataset.id.padStart(2, '0');
            characterImg.src = `/img/characters/artwork/strm_hero_book_${index}_01_0.png`;
            characterImg.alt = name;

            characterCard.style.display = 'block';
        });
    });

    closeCardButton.addEventListener('click', function () {
        characterCard.style.display = 'none';
    });
});
