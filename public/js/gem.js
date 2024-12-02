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


});
