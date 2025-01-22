$(document).ready(function () {
    // Define variables for the elements used in the script
    const $closeCardBtn = $('#close-card'); // Select the close button for the hero card
    const $card = $('#hero-card'); // Select the hero card container
    const $overlay = $("<div class='overlay'></div>").appendTo("body"); // Create an overlay and append it to the body dynamically

    // Event listener for clicking on a hero row to show the hero details card
    $('.hero-row').on('click', function () {
        const $row = $(this); // The row that was clicked
        const name = $row.data('name'); // Retrieve the hero's name from the data attribute
        const heroClassData = $row.data('class'); // Retrieve the hero's class from the data attribute
        const index = String($row.data('id')).padStart(2, '0'); // Get the hero's ID and pad it with leading zeros if necessary

        // Populate the hero card with data from the clicked row
        $('#hero-name').text(name); // Set the hero's name
        $('#hero-class').text(heroClassData); // Set the hero's class
        $('#hero-img').attr('src', `/img/characters/artwork/strm_hero_book_${index}_01_0.png`) // Set the hero's image source dynamically based on the hero's ID
            .attr('alt', name); // Set the alt text for the image to the hero's name

        // Show the hero card and overlay
        $card.show();
        $overlay.show();
    });

    // Event listener for closing the hero card when the close button is clicked
    $closeCardBtn.on("click", function () {
        $card.hide(); // Hide the hero card
        $overlay.hide(); // Hide the overlay
    });

    // Event listener for closing the hero card when clicking outside the card (on the overlay)
    $overlay.on("click", function () {
        $card.hide(); // Hide the hero card
        $(this).hide(); // Hide the overlay
    });
});
