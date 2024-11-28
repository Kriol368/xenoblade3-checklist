document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll(".soul-tree-row");
    const card = document.getElementById("soul-tree-card");
    const closeCardBtn = document.getElementById("close-card");

    // Handle the row click event to show the details card
    rows.forEach(row => {
        row.addEventListener("click", () => {
            document.getElementById("soul-tree-name").textContent = row.dataset.name;
            document.getElementById("soul-tree-effect").textContent = row.dataset.effect;
            document.getElementById("soul-tree-character").textContent = row.dataset.character;
            card.style.display = "block";
        });
    });

    // Close the detailed card when clicking the close button
    closeCardBtn.addEventListener("click", () => {
        card.style.display = "none";
    });

});
