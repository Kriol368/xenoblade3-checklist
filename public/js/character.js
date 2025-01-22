$(document).ready(function () {
    // Caching DOM elements for better performance
    const $characterRows = $('.character-row'); // All character rows containing data
    const $card = $('#character-card'); // The card where character details will be displayed
    const $characterName = $('#character-name'); // Character name element in the card
    const $characterClass = $('#character-class'); // Character class element in the card
    const $characterImg = $('#character-img'); // Character image element in the card
    const $closeCardBtn = $('#close-card'); // Close button for the character card
    const $overlay = $("<div class='overlay'></div>").appendTo("body"); // Dynamically create and append the overlay to the body

    // Event handler for when a character row is clicked
    $characterRows.on('click', function () {
        const $row = $(this); // The clicked row element
        const name = $row.data('name'); // Fetch the character's name from the data attribute
        const characterClassData = $row.data('class'); // Fetch the character's class from the data attribute
        const index = String($row.data('id')).padStart(2, '0'); // Fetch the character's ID, format it to two digits

        // Set the content of the character card with the fetched data
        $characterName.text(name);
        $characterClass.text(characterClassData);
        $characterImg.attr('src', `/img/characters/artwork/strm_hero_book_${index}_01_0.png`); // Set the image source based on the formatted index
        $characterImg.attr('alt', name); // Set the alt text of the image to the character's name

        // Show the card and overlay when a character row is clicked
        $card.show();
        $overlay.show();
    });

    // Event handler to close the card when the close button is clicked
    $closeCardBtn.on("click", function () {
        $card.hide(); // Hide the character card
        $overlay.hide(); // Hide the overlay
    });

    // Event handler to close the card when clicking outside of it (on the overlay)
    $overlay.on("click", function () {
        $card.hide(); // Hide the character card
        $(this).hide(); // Hide the overlay
    });
});
