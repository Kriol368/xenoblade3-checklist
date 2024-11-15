document.addEventListener('DOMContentLoaded', function () {
    const landmarkLocationRows = document.querySelectorAll('.landmark-location-row');
    const landmarkLocationCard = document.getElementById('landmark-location-card');
    const landmarkLocationName = document.getElementById('landmark-location-name');
    const landmarkLocationType = document.getElementById('landmark-location-type');
    const landmarkLocationArea = document.getElementById('landmark-location-area');
    const landmarkLocationRegion = document.getElementById('landmark-location-region');
    const closeCardButton = document.getElementById('close-card');

    landmarkLocationRows.forEach(row => {
        row.addEventListener('click', function () {
            // Retrieve data from row's dataset attributes
            const name = row.dataset.name;
            const type = row.dataset.type;
            const area = row.dataset.area;
            const region = row.dataset.region;

            // Update card content with retrieved data
            landmarkLocationName.textContent = name;
            landmarkLocationType.textContent = type;
            landmarkLocationArea.textContent = area;
            landmarkLocationRegion.textContent = region;

            // Show the card
            landmarkLocationCard.style.display = 'block';
        });
    });

    closeCardButton.addEventListener('click', function () {
        landmarkLocationCard.style.display = 'none';
    });
});
