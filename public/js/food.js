$(document).ready(() => {
    const $overlay = $("<div class='overlay'></div>").appendTo("body"); // Add overlay dynamically
    const $card = $('#food-card');
    const $closeCardBtn = $('#close-card');

    $('.food-row').on('click', function () {
        const $row = $(this);

        $('#food-name').text($row.data('name'));
        $('#food-effects').text($row.data('effects'));
        $('#food-duration').text(`${$row.data('duration')} minutes`);
        $('#food-location').text($row.data('location'));

        // Dynamically set the image path
        const index = String($row.data('id')).padStart(3, '0');
        $('#food-img').attr('src', `/img/food/strm_dish_thmb_${index}_0.png`);

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
