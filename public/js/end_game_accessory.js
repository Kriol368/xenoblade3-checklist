$(document).ready(function () {
    const $accessoryRows = $('.accessory-row');
    const $card = $('#accessory-card');
    const $accessoryName = $('#accessory-name');
    const $accessoryEffect = $('#accessory-effect');
    const $accessoryLocation = $('#accessory-location');
    const $accessoryImg = $('#accessory-img');
    const $closeCardBtn = $('#close-card');
    const $overlay = $("<div class='overlay'></div>").appendTo("body"); // Add overlay dynamically

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
