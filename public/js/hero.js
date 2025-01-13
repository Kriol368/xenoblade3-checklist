$(document).ready(function () {
    $('.hero-row').on('click', function () {
        const $row = $(this);
        const $heroCard = $('#hero-card');

        const name = $row.data('name');
        const heroClassData = $row.data('class');
        const imgIndex = $row.data('imgIndex');
        const index = String($row.data('id')).padStart(2, '0');

        $('#hero-name').text(name);
        $('#hero-class').text(heroClassData);
        $('#hero-img').attr('src', `/img/characters/artwork/strm_hero_book_${index}_01_0.png`).attr('alt', name);

        $heroCard.show();
    });

    $('#close-card').on('click', function () {
        $('#hero-card').hide();
    });
});
