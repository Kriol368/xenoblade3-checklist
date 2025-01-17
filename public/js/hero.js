$(document).ready(function () {
    const $closeCardBtn = $('#close-card');
    const $card = $('#hero-card');
    const $overlay = $("<div class='overlay'></div>").appendTo("body"); // Add overlay dynamically



    $('.hero-row').on('click', function () {
        const $row = $(this);
        const name = $row.data('name');
        const heroClassData = $row.data('class');
        const index = String($row.data('id')).padStart(2, '0');

        $('#hero-name').text(name);
        $('#hero-class').text(heroClassData);
        $('#hero-img').attr('src', `/img/characters/artwork/strm_hero_book_${index}_01_0.png`).attr('alt', name);

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
