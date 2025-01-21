$(document).ready(function () {
    // Caching DOM elements for better performance
    const $collectibleRows = $('.collectible-row'); // All rows representing collectibles
    const $card = $('#collectible-card'); // The card where collectible details will be shown
    const $collectibleName = $('#collectible-name'); // Element to display the collectible's name
    const $collectibleRarity = $('#collectible-rarity'); // Element to display the collectible's rarity
    const $collectibleLocation = $('#collectible-location'); // Element to display the collectible's location
    const $collectibleImg = $('#collectible-img'); // Element to display the collectible's image
    const $closeCardBtn = $('#close-card'); // Close button for the collectible card
    const $overlay = $("<div class='overlay'></div>").appendTo("body"); // Dynamically add an overlay to the body

    // Event handler for when a collectible row is clicked
    $collectibleRows.on('click', function () {
        const $row = $(this); // The clicked row
        const name = $row.data('name') || 'Unknown'; // Retrieve the collectible's name, default to 'Unknown' if not available
        const rarity = $row.data('rarity') || 'Unknown'; // Retrieve the rarity, default to 'Unknown' if not available
        const location = $row.data('location') || 'Unknown'; // Retrieve the location, default to 'Unknown' if not available
        const imgIndex = $row.data('imgIndex') || 0; // Retrieve the image index, default to 0 if not available

        // Set the collectible details into the card
        $collectibleName.text(name);
        $collectibleRarity.text(rarity);
        $collectibleLocation.text(location);
        $collectibleImg.attr('src', `/img/collectibles/icon_collectible_glow_r_${imgIndex}.png`); // Set the image source
        $collectibleImg.attr('alt', name); // Set the alt attribute of the image for accessibility

        // Display the collectible card and overlay
        $card.show();
        $overlay.show();
    });

    // Close the card when the close button is clicked
    $closeCardBtn.on("click", function () {
        $card.hide(); // Hide the collectible card
        $overlay.hide(); // Hide the overlay
    });

    // Close the card when clicking outside of it (on the overlay)
    $overlay.on("click", function () {
        $card.hide(); // Hide the collectible card
        $(this).hide(); // Hide the overlay
    });
});
