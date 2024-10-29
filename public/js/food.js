document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.food-row').forEach(row => {
        row.addEventListener('click', () => {
            const foodCard = document.getElementById('food-card');
            document.getElementById('food-name').textContent = row.dataset.name;
            document.getElementById('food-effects').textContent = row.dataset.effects;
            document.getElementById('food-duration').textContent = row.dataset.duration + ' minutes';
            document.getElementById('food-location').textContent = row.dataset.location;

            // Dynamically set the image path
            const index = row.dataset.id.padStart(3, '0');
            document.getElementById('food-img').src = `/img/food/strm_dish_thmb_${index}_0.png`;

            foodCard.style.display = 'block';
        });
    });

    document.getElementById('close-card').addEventListener('click', () => {
        document.getElementById('food-card').style.display = 'none';
    });
});
