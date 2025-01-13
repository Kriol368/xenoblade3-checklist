$(document).ready(function () {
    const $characterRows = $('.character-row');
    const $characterCard = $('#character-card');
    const $characterName = $('#character-name');
    const $characterClass = $('#character-class');
    const $characterImg = $('#character-img');
    const $closeCardButton = $('#close-card');

    $characterRows.on('click', function () {
        const $row = $(this);
        const name = $row.data('name');
        const characterClassData = $row.data('class');
        const imgIndex = $row.data('imgIndex');
        const index = String($row.data('id')).padStart(2, '0');

        $characterName.text(name);
        $characterClass.text(characterClassData);
        $characterImg.attr('src', `/img/characters/artwork/strm_hero_book_${index}_01_0.png`);
        $characterImg.attr('alt', name);

        $characterCard.show();
    });

    $closeCardButton.on('click', function () {
        $characterCard.hide();
    });
});
