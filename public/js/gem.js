document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll(".gem-row");
    const card = document.getElementById("gem-card");
    const closeCardBtn = document.getElementById("close-card");

    // Handle the row click event to show the details card
    rows.forEach(row => {
        row.addEventListener("click", () => {
            document.getElementById("gem-name").textContent = row.dataset.name;
            document.getElementById("gem-effect").textContent = row.dataset.effect;
            document.getElementById("gem-type").textContent = row.dataset.type;
            card.style.display = "block";
        });
    });

    // Close the detailed card when clicking the close button
    closeCardBtn.addEventListener("click", () => {
        card.style.display = "none";
    });

    // Handle checkbox change for each geme
    const checkboxes = document.querySelectorAll('.gem-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function (event) {
            event.stopPropagation();
            const gemId = this.dataset.id;
            const field = 'checked'; // Field is always 'checked'
            const value = this.checked ? 1 : 0;

            const formData = new FormData();
            formData.append('field', field);
            formData.append('value', value);
            formData.append('_csrf_token', csrfToken); // CSRF token for security

            fetch(`/update-gem-status/${gemId}`, {
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
