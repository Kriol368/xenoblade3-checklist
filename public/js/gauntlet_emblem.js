document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll(".gauntlet-emblem-row");
    const card = document.getElementById("gauntlet-emblem-card");
    const closeCardBtn = document.getElementById("close-card");

    rows.forEach(row => {
        row.addEventListener("click", () => {
            // Set the card's details from the selected row
            document.getElementById("gauntlet-emblem-name").textContent = row.dataset.name;
            document.getElementById("gauntlet-emblem-description").textContent = row.dataset.description;
            document.getElementById("gauntlet-emblem-effects").textContent = row.dataset.effects;

            // Set the level select field to match the current level
            const levelSelect = document.getElementById("gauntlet-emblem-level-select");
            levelSelect.value = row.dataset.level; // Set to the current emblem level

            // Show the card
            card.style.display = "block";
        });
    });

    closeCardBtn.addEventListener("click", () => {
        card.style.display = "none"; // Close the card
    });

    const levelSelects = document.querySelectorAll('.gauntlet-emblem-level');
    levelSelects.forEach(select => {
        select.addEventListener('change', (event) => {
            const emblemId = select.dataset.id;
            const newLevel = select.value;

            const formData = new FormData();
            formData.append('level', newLevel); // Send the new level
            formData.append('_csrf_token', csrfToken); // CSRF token

            fetch(`/update-gauntlet-emblem-level/${emblemId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        alert(data.error || 'Failed to update the emblem level.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the level.');
                });
        });
    });
});
