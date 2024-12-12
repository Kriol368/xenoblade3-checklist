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

    // Handle checkbox change for each gem
    const checkboxes = document.querySelectorAll('.gem-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function (event) {
            event.stopPropagation(); // Stop event from bubbling up to row click
            const gemId = this.dataset.id;
            const field = 'checked'; // Field to update
            const value = this.checked ? 1 : 0; // 1 if checked, 0 if unchecked

            const formData = new FormData();
            formData.append('field', field);
            formData.append('value', value);
            formData.append('_csrf_token', csrfToken); // CSRF token for security

            fetch(`/update-gem-status/${gemId}`, {
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
                        this.checked = !this.checked; // Revert checkbox state on failure
                    } else {
                        updateProgressBar(); // Update progress bar on success
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the status.');
                    this.checked = !this.checked; // Revert checkbox state on error
                });
        });
    });
});

function updateProgressBar() {
    const checkboxes = document.querySelectorAll('.gem-checkbox');
    const totalGems = checkboxes.length;
    const checkedGems = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;
    const progress = Math.round(totalGems > 0 ? (checkedGems / totalGems) * 100 : 0);

    const progressBar = document.getElementById('progress-bar');
    const progressLabel = document.querySelector('.progress-label');

    progressBar.style.width = `${progress}%`;
    progressLabel.textContent = `${progress.toFixed(0)}% Complete`;
}
