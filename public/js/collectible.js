$(document).ready(function () {
    const $collectibleRows = $('.collectible-row');
    const $card = $('#collectible-card');
    const $collectibleName = $('#collectible-name');
    const $collectibleRarity = $('#collectible-rarity');
    const $collectibleLocation = $('#collectible-location');
    const $collectibleImg = $('#collectible-img');
    const $closeCardBtn = $('#close-card');
    const $overlay = $("<div class='overlay'></div>").appendTo("body"); // Add overlay dynamically


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

        $card.show();
        $overlay.show();
    });
    // Close the card when clicking the close button
    $closeCardBtn.on("click", function () {
        $card.hide();
        $overlay.hide();
    });

    // Close the card when clicking outside it
    $overlay.on("click", function () {
        $card.hide();
        $(this).hide();
    });
});
