document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll(".challenge-mode-row");
    const card = document.getElementById("challenge-mode-card");
    const closeCardBtn = document.getElementById("close-card");

    // Open card on row click
    rows.forEach(row => {
        row.addEventListener("click", () => {
            document.getElementById("challenge-mode-name").textContent = row.dataset.name;
            document.getElementById("challenge-mode-difficulty").textContent = row.dataset.difficulty;
            document.getElementById("challenge-mode-waves").textContent = row.dataset.waves;
            document.getElementById("challenge-mode-levelRestriction").textContent = row.dataset.levelRestriction;
            card.style.display = "block";
        });
    });

    // Close card
    closeCardBtn.addEventListener("click", () => {
        card.style.display = "none";
    });

    // Handle checkbox changes
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
                    } else {
                        updateProgressBar();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the status.');
                    this.checked = !this.checked;
                });
        });
    });

    updateProgressBar(); // Initialize progress bar
});

// Function to update the progress bar
function updateProgressBar() {
    const checkboxes = document.querySelectorAll('.challenge-mode-checkbox');
    const totalCheckboxes = checkboxes.length;
    const checkedCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;

    const progress = Math.round(totalCheckboxes > 0 ? (checkedCheckboxes / totalCheckboxes) * 100 : 0);

    const progressBar = document.getElementById('progress-bar');
    const progressLabel = document.querySelector('.progress-label');

    progressBar.style.width = `${progress}%`;
    progressLabel.textContent = `${progress.toFixed(0)}% Complete`;
}
