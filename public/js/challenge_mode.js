document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll(".challenge-mode-row");
    const card = document.getElementById("challenge-mode-card");
    const closeBtn = document.getElementById("close-card");

    rows.forEach(row => {
        row.addEventListener("click", () => {
            document.getElementById("challenge-mode-name").textContent = row.dataset.name;
            document.getElementById("challenge-mode-difficulty").textContent = row.dataset.difficulty;
            document.getElementById("challenge-mode-waves").textContent = row.dataset.waves;
            document.getElementById("challenge-mode-levelRestriction").textContent = row.dataset.levelRestriction;

            card.style.display = "block";
        });
    });

    closeBtn.addEventListener("click", () => {
        card.style.display = "none";
    });
});
