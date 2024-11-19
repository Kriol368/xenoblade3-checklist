document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll(".unique-monster-row");
    const card = document.getElementById("unique-monster-card");
    const closeCardBtn = document.getElementById("close-card");

    rows.forEach(row => {
        row.addEventListener("click", () => {
            document.getElementById("unique-monster-name").textContent = row.dataset.name;
            document.getElementById("unique-monster-area").textContent = row.dataset.area;
            document.getElementById("unique-monster-location").textContent = row.dataset.location;
            document.getElementById("unique-monster-level").textContent = row.dataset.level;
            document.getElementById("unique-monster-soulhacker-ability").textContent = row.dataset.soulhackerAbility;
            card.style.display = "block";
        });
    });

    closeCardBtn.addEventListener("click", () => {
        card.style.display = "none";
    });

    const checkboxes = document.querySelectorAll('.challenge-mode-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function (event) {
            event.stopPropagation();
            const challengeModeId = this.dataset.id;
            const field = this.dataset.attribute;
            const value = this.checked ? 1 : 0;

            const formData = new FormData();
            formData.append('field', field);
            formData.append('value', value);
            formData.append('_csrf_token', csrfToken);

            fetch(`/update-challenge-status/${challengeModeId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        alert(data.error || 'Failed to update status');
                        this.checked = !this.checked;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the status.');
                    this.checked = !this.checked;
                });
        });
    });
});