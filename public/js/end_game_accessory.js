$(document).ready(function () {
    // Caching DOM elements for better performance
    const $accessoryRows = $('.accessory-row'); // All rows representing accessories
    const $card = $('#accessory-card'); // The card where accessory details will be displayed
    const $accessoryName = $('#accessory-name'); // Element to display the accessory's name
    const $accessoryEffect = $('#accessory-effect'); // Element to display the accessory's effect
    const $accessoryLocation = $('#accessory-location'); // Element to display the accessory's location
    const $accessoryImg = $('#accessory-img'); // Element to display the accessory's image
    const $closeCardBtn = $('#close-card'); // Close button for the accessory card
    const $overlay = $("<div class='overlay'></div>").appendTo("body"); // Dynamically add an overlay to the body

    // Event handler for when an accessory row is clicked
    $accessoryRows.on('click', function () {
        const $row = $(this); // The clicked row
        const name = $row.data('name') || 'Unknown'; // Retrieve the accessory's name, default to 'Unknown' if not available
        const effect = $row.data('effect') || 'Unknown'; // Retrieve the effect, default to 'Unknown' if not available
        const location = $row.data('location') || 'Unknown'; // Retrieve the location, default to 'Unknown' if not available
        const imgIndex = $row.data('imgIndex') || 0; // Retrieve the image index, default to 0 if not available

        // Set the accessory details into the card
        $accessoryName.text(name);
        $accessoryEffect.text(effect);
        $accessoryLocation.text(location);
        $accessoryImg.attr('src', `/img/accessories/icon_accessory_glow_r_${imgIndex}.png`); // Set the image source
        $accessoryImg.attr('alt', name); // Set the alt attribute of the image for accessibility

        // Display the accessory card and overlay
        $card.show();
        $overlay.show();
    });

    // Close the card when the close button is clicked
    $closeCardBtn.on("click", function () {
        $card.hide(); // Hide the accessory card
        $overlay.hide(); // Hide the overlay
    });

    // Close the card when clicking outside of it (on the overlay)
    $overlay.on("click", function () {
        $card.hide(); // Hide the accessory card
        $(this).hide(); // Hide the overlay
    });
});
