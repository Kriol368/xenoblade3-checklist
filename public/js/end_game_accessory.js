document.addEventListener('DOMContentLoaded', function () {
    const accessoryRows = document.querySelectorAll('.accessory-row');
    const accessoryCard = document.getElementById('accessory-card');
    const accessoryName = document.getElementById('accessory-name');
    const accessoryEffect = document.getElementById('accessory-effect');
    const accessoryLocation = document.getElementById('accessory-location');
    const accessoryImg = document.getElementById('accessory-img');
    const closeCardButton = document.getElementById('close-card');

    accessoryRows.forEach(row => {
        row.addEventListener('click', function () {
            const name = row.dataset.name || 'Unknown';
            const effect = row.dataset.effect || 'Unknown';
            const location = row.dataset.location || 'Unknown';
            const imgIndex = (row.dataset.imgIndex || '0').padStart(1, '0');  // Ensures 3-digit formatting

            accessoryName.textContent = name;
            accessoryEffect.textContent = effect;
            accessoryLocation.textContent = location;
            accessoryImg.src = `/img/accessories/icon_item_glow_g_${imgIndex}.png`;
            accessoryImg.alt = name;

            accessoryCard.style.display = 'block';
        });
    });

    closeCardButton.addEventListener('click', function () {
        accessoryCard.style.display = 'none';
    });
});
