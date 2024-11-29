document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll(".quest-row");
    const card = document.getElementById("quest-card");
    const closeCardBtn = document.getElementById("close-card");

    // Handle the row click event to show the details card
    rows.forEach(row => {
        row.addEventListener("click", () => {
            document.getElementById("quest-name").textContent = row.dataset.name;
            document.getElementById("quest-region").textContent = row.dataset.region;
            document.getElementById("quest-type").textContent = row.dataset.type;
            document.getElementById("quest-level").textContent = row.dataset.level;
            document.getElementById("quest-summary").textContent = row.dataset.summary;
            document.getElementById("quest-giver").textContent = row.dataset.giver;
            document.getElementById("quest-prerequisites").textContent = row.dataset.prerequisites;
            document.getElementById("quest-rewards").textContent = row.dataset.rewards;
            document.getElementById("quest-chapter").textContent = row.dataset.chapter;
            card.style.display = "block";
        });
    });

    // Close the detailed card when clicking the close button
    closeCardBtn.addEventListener("click", () => {
        card.style.display = "none";
    });


});
