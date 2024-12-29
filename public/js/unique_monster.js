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

    const checkboxes = document.querySelectorAll('.unique-monster-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function (event) {
            event.stopPropagation();
            const uniqueMonsterId = this.dataset.id;
            const field = this.dataset.attribute;
            const value = this.checked ? 1 : 0;

            const formData = new FormData();
            formData.append('field', field);
            formData.append('value', value);
            formData.append('_csrf_token', csrfToken);

            fetch(`/update-monster-status/${uniqueMonsterId}`, {
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

function updateProgressBar() {
    const checkboxes = document.querySelectorAll('.unique-monster-checkbox');
    const totalCheckboxes = checkboxes.length;
    const checkedCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;

    const progress = Math.round(totalCheckboxes > 0 ? (checkedCheckboxes / totalCheckboxes) * 100 : 0);

    const progressBar = document.getElementById('progress-bar');
    const progressLabel = document.querySelector('.progress-label');

    progressBar.style.width = `${progress}%`;
    progressLabel.textContent = `${progress.toFixed(0)}% Complete`;
}
