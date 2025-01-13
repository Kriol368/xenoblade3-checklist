$(document).ready(() => {
    $('.food-row').on('click', function () {
        const $row = $(this);
        const $foodCard = $('#food-card');

        $('#food-name').text($row.data('name'));
        $('#food-effects').text($row.data('effects'));
        $('#food-duration').text(`${$row.data('duration')} minutes`);
        $('#food-location').text($row.data('location'));

        // Dynamically set the image path
        const index = String($row.data('id')).padStart(3, '0');
        $('#food-img').attr('src', `/img/food/strm_dish_thmb_${index}_0.png`);

        $foodCard.show();
    });

    $('#close-card').on('click', () => {
        $('#food-card').hide();
    });
});
