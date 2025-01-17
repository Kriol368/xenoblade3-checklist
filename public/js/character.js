$(document).ready(function () {
    const $characterRows = $('.character-row');
    const $card = $('#character-card');
    const $characterName = $('#character-name');
    const $characterClass = $('#character-class');
    const $characterImg = $('#character-img');
    const $closeCardBtn = $('#close-card');
    const $overlay = $("<div class='overlay'></div>").appendTo("body"); // Add overlay dynamically


    $characterRows.on('click', function () {
        const $row = $(this);
        const name = $row.data('name');
        const characterClassData = $row.data('class');
        const index = String($row.data('id')).padStart(2, '0');

        $characterName.text(name);
        $characterClass.text(characterClassData);
        $characterImg.attr('src', `/img/characters/artwork/strm_hero_book_${index}_01_0.png`);
        $characterImg.attr('alt', name);

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
