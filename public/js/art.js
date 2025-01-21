$(document).ready(function () {
    // Caching DOM elements for better performance
    const $artRows = $('.art-row'); // All rows containing art data
    const $card = $('#art-card'); // The card where art details will be displayed
    const $artName = $('#art-name'); // Art name element
    const $artEffect = $('#art-effect'); // Art effect element
    const $artType = $('#art-type'); // Art type element
    const $artRecharge = $('#art-recharge'); // Art recharge element
    const $artRechargeType = $('#art-recharge-type'); // Art recharge type element
    const $artPowerMultiplier = $('#art-power-multiplier'); // Art power multiplier element
    const $artMasterLevel = $('#art-master-level'); // Art master level element
    const $artClass = $('#art-class'); // Art class element
    const $artImg = $('#art-img'); // Art image element
    const $closeCardBtn = $('#close-card'); // Close button for the card
    const $overlay = $("<div class='overlay'></div>").appendTo("body"); // Add overlay dynamically to the body

    // Event handler for clicking on a row
    $artRows.on('click', function () {
        const $row = $(this); // The clicked row element
        // Fetching data attributes from the clicked row
        const name = $row.data('name');
        const artClassData = $row.data('class');
        const effect = $row.data('effect');
        const type = $row.data('type');
        const recharge = $row.data('recharge');
        const rechargeType = $row.data('rechargeType');
        const powerMultiplier = $row.data('powerMultiplier');
        const masterLevel = $row.data('masterLevel');
        const imgIndex = $row.data('imgindex');

        // Setting the text/content of the card elements with the clicked row's data
        $artName.text(name);
        $artClass.text(artClassData);
        $artEffect.text(effect);
        $artType.text(type);
        $artRechargeType.text(rechargeType);
        $artPowerMultiplier.text(powerMultiplier);
        $artRecharge.text(recharge);
        $artMasterLevel.text(masterLevel);

        // Updating the image source and alt text for the card's image
        $artImg.attr('src', `img/arts/icon_arts2_${imgIndex}.png`);
        $artImg.attr('alt', name);

        // Display the card and overlay when a row is clicked
        $card.show();
        $overlay.show();
    });

    // Event handler to close the card when the close button is clicked
    $closeCardBtn.on("click", function () {
        $card.hide(); // Hide the art card
        $overlay.hide(); // Hide the overlay
    });

    // Event handler to close the card when clicking outside of it (on the overlay)
    $overlay.on("click", function () {
        $card.hide(); // Hide the art card
        $(this).hide(); // Hide the overlay
    });
});
