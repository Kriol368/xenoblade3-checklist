document.addEventListener('DOMContentLoaded', function() {
    const classRows = document.querySelectorAll('.character-class-row');
    const classCard = document.getElementById('character-class-card');
    const className = document.getElementById('class-name');
    const roleImg = document.getElementById('role-img');
    const imgIndex = document.getElementById('img-index');
    const closeCardButton = document.getElementById('close-card');

    // New fields
    const classWeapon = document.getElementById('class-weapon');
    const classNation = document.getElementById('class-nation');
    const classOffense = document.getElementById('class-offense');
    const classDefense = document.getElementById('class-defense');
    const classHealing = document.getElementById('class-healing');
    const classDifficulty = document.getElementById('class-difficulty');

    // Add event listeners to each class row
    classRows.forEach(row => {
        row.addEventListener('click', function() {
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

    // Close the character class card
    closeCardButton.addEventListener('click', function() {
        classCard.style.display = 'none';
    });

    // Select all checkboxes with class 'character-checkbox'
    const checkboxes = document.querySelectorAll('.character-checkbox');

    // Add event listeners to each checkbox
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const row = this.closest('.character-class-row');
            const characterId = row.dataset.characterId;
            const field = this.dataset.field;
            const value = this.checked ? 1 : 0;

            // Send AJAX request to update database
            fetch(`/update-character-status/${characterId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest', // Indicate that the request is AJAX
                    'X-CSRF-Token': csrfToken // Include CSRF token in the headers
                },
                body: JSON.stringify({
                    field: field,
                    value: value
                })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        console.log(`${field} updated successfully for character ID: ${characterId}`);
                    } else {
                        alert('Failed to update status');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
});
