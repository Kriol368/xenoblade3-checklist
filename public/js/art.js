document.addEventListener('DOMContentLoaded', function () {
    const artRows = document.querySelectorAll('.art-row');
    const artCard = document.getElementById('art-card');
    const artName = document.getElementById('art-name');
    const artEffect = document.getElementById('art-effect');
    const artType = document.getElementById('art-type');
    const artRecharge = document.getElementById('art-recharge');
    const artRechargeType = document.getElementById('art-recharge-type');
    const artPowerMultiplier = document.getElementById('art-power-multiplier');
    const artMasterLevel = document.getElementById('art-master-level');
    const artClass = document.getElementById('art-class');
    const artImg = document.getElementById('art-img');
    const closeCardButton = document.getElementById('close-card');

    artRows.forEach(row => {
        row.addEventListener('click', function () {
            const name = row.dataset.name;
            const artClassData = row.dataset.class;
            const effect = row.dataset.effect;
            const type = row.dataset.type;
            const recharge = row.dataset.recharge;
            const rechargeType = row.dataset.rechargeType;
            const powerMultiplier = row.dataset.powerMultiplier;
            const masterLevel = row.dataset.masterLevel;
            const imgIndex = row.dataset.imgindex;

            artName.textContent = name;
            artClass.textContent = artClassData;
            artEffect.textContent = effect;
            artType.textContent = type;
            artRechargeType.textContent = rechargeType;
            artPowerMultiplier.textContent = powerMultiplier;
            artRecharge.textContent = recharge;
            artMasterLevel.textContent = masterLevel;
            artImg.src = `img/arts/icon_arts2_${imgIndex}.png`;
            artImg.alt = name;

            artCard.style.display = 'block';
        });
    });

    closeCardButton.addEventListener('click', function () {
        artCard.style.display = 'none';
    });
});
