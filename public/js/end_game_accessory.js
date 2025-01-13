$(document).ready(function () {
    const $accessoryRows = $('.accessory-row');
    const $accessoryCard = $('#accessory-card');
    const $accessoryName = $('#accessory-name');
    const $accessoryEffect = $('#accessory-effect');
    const $accessoryLocation = $('#accessory-location');
    const $accessoryImg = $('#accessory-img');
    const $closeCardButton = $('#close-card');

    $accessoryRows.on('click', function () {
        const $row = $(this);
        const name = $row.data('name') || 'Unknown';
        const effect = $row.data('effect') || 'Unknown';
        const location = $row.data('location') || 'Unknown';
        const imgIndex = $row.data('imgIndex') || 0;

        $accessoryName.text(name);
        $accessoryEffect.text(effect);
        $accessoryLocation.text(location);
        $accessoryImg.attr('src', `/img/accessories/icon_accessory_glow_r_${imgIndex}.png`);
        $accessoryImg.attr('alt', name);

        $accessoryCard.show();
    });

    $closeCardButton.on('click', function () {
        $accessoryCard.hide();
    });
});
