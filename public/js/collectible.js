$(document).ready(function () {
    const $collectibleRows = $('.collectible-row');
    const $collectibleCard = $('#collectible-card');
    const $collectibleName = $('#collectible-name');
    const $collectibleRarity = $('#collectible-rarity');
    const $collectibleLocation = $('#collectible-location');
    const $collectibleImg = $('#collectible-img');
    const $closeCardButton = $('#close-card');

    $collectibleRows.on('click', function () {
        const $row = $(this);
        const name = $row.data('name') || 'Unknown';
        const rarity = $row.data('rarity') || 'Unknown';
        const location = $row.data('location') || 'Unknown';
        const imgIndex = $row.data('imgIndex') || 0;

        $collectibleName.text(name);
        $collectibleRarity.text(rarity);
        $collectibleLocation.text(location);
        $collectibleImg.attr('src', `/img/collectibles/icon_collectible_glow_r_${imgIndex}.png`);
        $collectibleImg.attr('alt', name);

        $collectibleCard.show();
    });

    $closeCardButton.on('click', function () {
        $collectibleCard.hide();
    });
});
