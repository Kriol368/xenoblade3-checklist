$(document).ready(() => {
    // Dynamically create and append an overlay to the body
    const $overlay = $("<div class='overlay'></div>").appendTo("body");

    // Cache the card and close button elements
    const $card = $('#food-card');
    const $closeCardBtn = $('#close-card');

    // Event handler for when a food row is clicked
    $('.food-row').on('click', function () {
        const $row = $(this); // Reference to the clicked row

        // Set the text content of the card based on data attributes of the clicked row
        $('#food-name').text($row.data('name')); // Set food name
        $('#food-effects').text($row.data('effects')); // Set food effects
        $('#food-duration').text(`${$row.data('duration')} minutes`); // Set food duration
        $('#food-location').text($row.data('location')); // Set food location

        // Dynamically set the image based on the row's data
        const index = String($row.data('id')).padStart(3, '0'); // Format the ID with leading zeros if necessary
        $('#food-img').attr('src', `/img/food/strm_dish_thmb_${index}_0.png`); // Set the image source

        // Display the food card and the overlay
        $card.show();
        $overlay.show();
    });

    // Event handler for closing the card when the close button is clicked
    $closeCardBtn.on("click", function () {
        $card.hide(); // Hide the food card
        $overlay.hide(); // Hide the overlay
    });

    // Event handler for closing the card when the overlay is clicked
    $overlay.on("click", function () {
        $card.hide(); // Hide the food card
        $(this).hide(); // Hide the overlay
    });
});
