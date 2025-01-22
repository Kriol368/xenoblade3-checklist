$(document).ready(function () {
    // Dynamically create and append an overlay element to the body
    const $overlay = $("<div class='overlay'></div>").appendTo("body");

    // Get the close button and the skill card element
    const $closeCardBtn = $('#close-card');
    const $card = $('#skill-card');

    // Event listener for clicks on skill rows
    $('.skill-row').on('click', function () {
        // Get the clicked row (this refers to the .skill-row element)
        const $row = $(this);

        // Extract the data attributes from the clicked row
        const name = $row.data('name'); // Skill name
        const skillClassData = $row.data('class'); // Skill class (e.g., Warrior, Mage)
        const effect = $row.data('effect'); // Description of the skill's effect
        const masterLevel = $row.data('masterLevel'); // Mastery level of the skill
        const imgIndex = $row.data('imgindex'); // Index for the skill image to display

        // Populate the skill card with the extracted data
        $('#skill-name').text(name); // Set the skill name in the card
        $('#skill-class').text(skillClassData); // Set the skill class in the card
        $('#skill-effect').text(effect); // Set the skill effect description in the card
        $('#skill-master-level').text(masterLevel); // Set the mastery level in the card
        $('#skill-img')
            .attr('src', `img/skills/icon_skill3_${imgIndex}.png`) // Set the skill image source
            .attr('alt', name); // Set the alt attribute for the image

        // Show the skill card and overlay
        $card.show();
        $overlay.show();
    });

    // Event listener for the close button on the card
    $closeCardBtn.on("click", function () {
        // Hide the skill card and the overlay when the close button is clicked
        $card.hide();
        $overlay.hide();
    });

    // Event listener for the overlay click to close the card
    $overlay.on("click", function () {
        // Hide the skill card and overlay when the overlay is clicked
        $card.hide();
        $(this).hide(); // Hide the overlay
    });
});
