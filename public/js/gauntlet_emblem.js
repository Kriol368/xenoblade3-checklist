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
            document.getElementById("gauntlet-emblem-img").src = "/img/gauntlet/" + row.dataset.imgIndex + '.png';

            card.style.display = "block";
        });
    });

    // Close card
    closeCardBtn.addEventListener("click", () => {
        card.style.display = "none";
    });

    const checkboxes = document.querySelectorAll('.gauntlet-emblem-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function (event) {
            event.stopPropagation();
            const gauntletEmblemId = this.dataset.id;
            const field = 'checked'; // Field is always 'checked'
            const value = this.checked ? 1 : 0;

            const formData = new FormData();
            formData.append('field', field);
            formData.append('value', value);
            formData.append('_csrf_token', csrfToken); // CSRF token for security

            fetch(`/update-emblem-status/${gauntletEmblemId}`, {
                method: 'POST', // Correct POST method
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        alert(data.error || 'Failed to update status');
                        this.checked = !this.checked; // Revert the checkbox state on failure
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the status.');
                    this.checked = !this.checked; // Revert the checkbox state on error
                });
        });
    });
});
