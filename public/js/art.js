$(document).ready(function () {
    const $artRows = $('.art-row');
    const $artCard = $('#art-card');
    const $artName = $('#art-name');
    const $artEffect = $('#art-effect');
    const $artType = $('#art-type');
    const $artRecharge = $('#art-recharge');
    const $artRechargeType = $('#art-recharge-type');
    const $artPowerMultiplier = $('#art-power-multiplier');
    const $artMasterLevel = $('#art-master-level');
    const $artClass = $('#art-class');
    const $artImg = $('#art-img');
    const $closeCardButton = $('#close-card');

    $artRows.on('click', function () {
        const $row = $(this);
        const name = $row.data('name');
        const artClassData = $row.data('class');
        const effect = $row.data('effect');
        const type = $row.data('type');
        const recharge = $row.data('recharge');
        const rechargeType = $row.data('rechargeType');
        const powerMultiplier = $row.data('powerMultiplier');
        const masterLevel = $row.data('masterLevel');
        const imgIndex = $row.data('imgindex');

        $artName.text(name);
        $artClass.text(artClassData);
        $artEffect.text(effect);
        $artType.text(type);
        $artRechargeType.text(rechargeType);
        $artPowerMultiplier.text(powerMultiplier);
        $artRecharge.text(recharge);
        $artMasterLevel.text(masterLevel);
        $artImg.attr('src', `img/arts/icon_arts2_${imgIndex}.png`);
        $artImg.attr('alt', name);

        $artCard.show();
    });

    $closeCardButton.on('click', function () {
        $artCard.hide();
    });
});
