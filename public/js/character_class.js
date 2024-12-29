document.addEventListener('DOMContentLoaded', function () {
    const classRows = document.querySelectorAll('.character-class-row');
    const classCard = document.getElementById('character-class-card');
    const className = document.getElementById('class-name');
    const roleImg = document.getElementById('role-img');
    const imgIndex = document.getElementById('img-index'); // New image element for imgIndex
    const closeCardButton = document.getElementById('close-card');

    // New fields
    const classWeapon = document.getElementById('class-weapon');
    const classNation = document.getElementById('class-nation');
    const classOffense = document.getElementById('class-offense');
    const classDefense = document.getElementById('class-defense');
    const classHealing = document.getElementById('class-healing');
    const classDifficulty = document.getElementById('class-difficulty');

    classRows.forEach(row => {
        row.addEventListener('click', function (event) {
            // Prevent the row click from triggering when clicking on the checkbox
            if (event.target.tagName.toLowerCase() === 'input') {
                return;
            }

            const name = row.dataset.name;
            const role = row.dataset.role;
            const weapon = row.dataset.weapon;
            const nation = row.dataset.nation;
            const offense = row.dataset.offense;
            const defense = row.dataset.defense;
            const healing = row.dataset.healing;
            const difficulty = row.dataset.difficulty;
            const imgIndexPath = row.dataset.imgIndex;

            // Set values
            className.textContent = name;
            imgIndex.src = `/img/classes/${imgIndexPath}.png`;
            imgIndex.alt = name;

            roleImg.src = `/img/roles/${role}.png`;
            roleImg.alt = role;

            // Populate new fields
            classWeapon.textContent = weapon || 'N/A';
            classNation.textContent = nation || 'N/A';
            classOffense.textContent = offense || 'N/A';
            classDefense.textContent = defense || 'N/A';
            classHealing.textContent = healing || 'N/A';
            classDifficulty.textContent = difficulty || 'N/A';

            classCard.style.display = 'block';
        });
    });

    closeCardButton.addEventListener('click', function () {
        classCard.style.display = 'none';
    });



    // Select all checkboxes with class 'character-checkbox'
    const checkboxes = document.querySelectorAll('.character-checkbox');

    // Add event listeners to each checkbox
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function (event) {
            event.stopPropagation(); // Prevent the row click event

            const characterId = this.dataset.id;
            const field = this.dataset.attribute;
            const value = this.checked ? 1 : 0;

            // Send AJAX request to update database
            const formData = new FormData();
            formData.append('field', field);
            formData.append('value', value);
            formData.append('_csrf_token', csrfToken); // Include CSRF token

            fetch(`/update-character-status/${characterId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' // Indicate that this is an AJAX request
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
                    // Optionally, revert the checkbox state
                    this.checked = !this.checked;
                });
        });
    });
    updateProgressBar(); // Initialize progress bar

});

function updateProgressBar() {
    const checkboxes = document.querySelectorAll('.character-checkbox');
    const totalCheckboxes = checkboxes.length;
    const checkedCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;

    const progress = Math.round(totalCheckboxes > 0 ? (checkedCheckboxes / totalCheckboxes) * 100 : 0);

    const progressBar = document.getElementById('progress-bar');
    const progressLabel = document.querySelector('.progress-label');

    progressBar.style.width = `${progress}%`;
    progressLabel.textContent = `${progress.toFixed(0)}% Complete`;
}
