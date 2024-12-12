document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll(".landmark-location-row");
    const card = document.getElementById("landmark-location-card");
    const closeCardBtn = document.getElementById("close-card");

    // Handle the row click event to show the details card
    rows.forEach(row => {
        row.addEventListener("click", () => {
            document.getElementById("landmark-location-name").textContent = row.dataset.name;
            document.getElementById("landmark-location-type").textContent = row.dataset.type;
            document.getElementById("landmark-location-area").textContent = row.dataset.area;
            document.getElementById("landmark-location-region").textContent = row.dataset.region;
            card.style.display = "block";
        });
    });

    // Close the detailed card when clicking the close button
    closeCardBtn.addEventListener("click", () => {
        card.style.display = "none";
    });

    // Handle checkbox change for each landmark location
    const checkboxes = document.querySelectorAll('.landmark-location-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function (event) {
            event.stopPropagation();
            const landmarkLocationId = this.dataset.id;
            const field = 'checked'; // Field is always 'checked'
            const value = this.checked ? 1 : 0;

            const formData = new FormData();
            formData.append('field', field);
            formData.append('value', value);
            formData.append('_csrf_token', csrfToken); // CSRF token for security

            fetch(`/update-landmark-status/${landmarkLocationId}`, {
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
                    }else {
                        updateProgressBar(); // Update progress bar on success
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

function updateProgressBar() {
    const checkboxes = document.querySelectorAll('.landmark-location-checkbox');
    const totalLandmarkLocations = checkboxes.length;
    const checkedLandmarkLocations = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;
    const progress = Math.round(totalLandmarkLocations > 0 ? (checkedLandmarkLocations / totalLandmarkLocations) * 100 : 0);

    const progressBar = document.getElementById('progress-bar');
    const progressLabel = document.querySelector('.progress-label');

    progressBar.style.width = `${progress}%`;
    progressLabel.textContent = `${progress.toFixed(0)}% Complete`;
}
