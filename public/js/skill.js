$(document).ready(function () {
    $('.skill-row').on('click', function () {
        const $row = $(this);
        const $skillCard = $('#skill-card');

        const name = $row.data('name');
        const skillClassData = $row.data('class');
        const effect = $row.data('effect');
        const masterLevel = $row.data('masterLevel');
        const imgIndex = $row.data('imgindex');

        $('#skill-name').text(name);
        $('#skill-class').text(skillClassData);
        $('#skill-effect').text(effect);
        $('#skill-master-level').text(masterLevel);
        $('#skill-img')
            .attr('src', `img/skills/icon_skill3_${imgIndex}.png`)
            .attr('alt', name);

        $skillCard.show();
    });

    $('#close-card').on('click', function () {
        $('#skill-card').hide();
    });
});
