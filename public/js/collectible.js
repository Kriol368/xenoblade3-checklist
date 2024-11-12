document.addEventListener('DOMContentLoaded', function () {
    const collectibleRows = document.querySelectorAll('.collectible-row');
    const collectibleCard = document.getElementById('collectible-card');
    const collectibleName = document.getElementById('collectible-name');
    const collectibleRarity = document.getElementById('collectible-rarity');
    const collectibleLocation = document.getElementById('collectible-location');
    const collectibleImg = document.getElementById('collectible-img');
    const closeCardButton = document.getElementById('close-card');

    collectibleRows.forEach(row => {
        row.addEventListener('click', function () {
            const name = row.dataset.name || 'Unknown';
            const rarity = row.dataset.rarity || 'Unknown';
            const location = row.dataset.location || 'Unknown';
            const imgIndex = (row.dataset.imgIndex || '0').padStart(1, '0');  // Ensures 3-digit formatting

            collectibleName.textContent = name;
            collectibleRarity.textContent = rarity;
            collectibleLocation.textContent = location;
            collectibleImg.src = `/img/collectibles/icon_item_glow_g_${imgIndex}.png`;
            collectibleImg.alt = name;

            collectibleCard.style.display = 'block';
        });
    });

    closeCardButton.addEventListener('click', function () {
        collectibleCard.style.display = 'none';
    });
});
