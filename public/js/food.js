document.addEventListener('DOMContentLoaded', () => {
    console.log("JavaScript loaded"); // Add this to confirm JS is loading
    alert("Hello JavaScript!");

    document.querySelectorAll('.food-row').forEach(row => {
        row.addEventListener('click', () => {
            const foodCard = document.getElementById('food-card');
            document.getElementById('food-name').textContent = row.dataset.name;
            document.getElementById('food-effects').textContent = row.dataset.effects;
            document.getElementById('food-duration').textContent = row.dataset.duration + ' minutes';
            document.getElementById('food-location').textContent = row.dataset.location;

            foodCard.style.display = 'block';
        });
    });

    document.getElementById('close-card').addEventListener('click', () => {
        document.getElementById('food-card').style.display = 'none';
    });
});
