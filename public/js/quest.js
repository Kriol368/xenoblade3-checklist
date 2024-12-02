document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll(".quest-row");
    const card = document.getElementById("quest-card");
    const closeCardBtn = document.getElementById("close-card");

    // Handle the row click event to show the details card
    rows.forEach(row => {
        row.addEventListener("click", () => {
            document.getElementById("quest-name").textContent = row.dataset.name;
            document.getElementById("quest-region").textContent = row.dataset.region;
            document.getElementById("quest-type").textContent = row.dataset.type;
            document.getElementById("quest-level").textContent = row.dataset.level;
            document.getElementById("quest-summary").textContent = row.dataset.summary;
            document.getElementById("quest-giver").textContent = row.dataset.giver;
            document.getElementById("quest-prerequisites").textContent = row.dataset.prerequisites;
            document.getElementById("quest-rewards").textContent = row.dataset.rewards;
            document.getElementById("quest-chapter").textContent = row.dataset.chapter;
            card.style.display = "block";
        });
    });

    // Close the detailed card when clicking the close button
    closeCardBtn.addEventListener("click", () => {
        card.style.display = "none";
    });


    const checkboxes = document.querySelectorAll('.quest-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function (event) {
            event.stopPropagation();
            const questId = this.dataset.id;
            const field = 'checked'; // Field is always 'checked'
            const value = this.checked ? 1 : 0;

            const formData = new FormData();
            formData.append('field', field);
            formData.append('value', value);
            formData.append('_csrf_token', csrfToken); // CSRF token for security

            fetch(`/update-quest-status/${questId}`, {
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
