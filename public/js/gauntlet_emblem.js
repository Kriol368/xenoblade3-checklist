document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll(".gauntlet-emblem-row");
    const card = document.getElementById("gauntlet-emblem-card");
    const closeCardBtn = document.getElementById("close-card");

    // Open card on row click
    rows.forEach(row => {
        row.addEventListener("click", () => {
            document.getElementById("gauntlet-emblem-name").textContent = row.dataset.name;
            document.getElementById("gauntlet-emblem-rarity").textContent = row.dataset.rarity;
            document.getElementById("gauntlet-emblem-description").textContent = row.dataset.description;
            document.getElementById("gauntlet-emblem-effects").textContent = row.dataset.effects;
            document.getElementById("gauntlet-emblem-img").src = "/img/gauntlet/" + "" /*row.dataset.imgIndex*/ + 'icon_emblem_0.png';

            card.style.display = "block";
        });
    });

    // Close card
    closeCardBtn.addEventListener("click", () => {
        card.style.display = "none";
    });

    // Handle level change
    const levelInputs = document.querySelectorAll('.gauntlet-emblem-level');
    levelInputs.forEach(input => {
        input.addEventListener('change', function() {
            const emblemId = this.dataset.id;
            const level = this.value;

            const formData = new FormData();
            formData.append('level', level);
            formData.append('_csrf_token', document.getElementById('csrf-token').value);

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
                        alert(data.error || 'Failed to update level');
                        this.value = this.oldValue;  // Revert to old value on failure
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the level.');
                });
        });
    });
});
