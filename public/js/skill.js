document.addEventListener('DOMContentLoaded', function () {
    const skillRows = document.querySelectorAll('.skill-row');
    const skillCard = document.getElementById('skill-card');
    const skillName = document.getElementById('skill-name');
    const skillEffect = document.getElementById('skill-effect');
    const skillMasterLevel = document.getElementById('skill-master-level');
    const skillClass = document.getElementById('skill-class');
    const skillImg = document.getElementById('skill-img');
    const closeCardButton = document.getElementById('close-card');

    skillRows.forEach(row => {
        row.addEventListener('click', function () {
            const name = row.dataset.name;
            const skillClassData = row.dataset.class;
            const effect = row.dataset.effect;
            const masterLevel = row.dataset.masterLevel;
            const imgIndex = row.dataset.imgindex;

            skillName.textContent = name;
            skillClass.textContent = skillClassData;
            skillEffect.textContent = effect;
            skillMasterLevel.textContent = masterLevel;
            skillImg.src = `img/skills/icon_skill3_${imgIndex}.png` ;
            skillImg.alt = name;

            skillCard.style.display = 'block';
        });
    });

    closeCardButton.addEventListener('click', function () {
        skillCard.style.display = 'none';
    });
});
