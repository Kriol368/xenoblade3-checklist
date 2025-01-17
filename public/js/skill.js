$(document).ready(function () {
    const $overlay = $("<div class='overlay'></div>").appendTo("body"); // Add overlay dynamically
    const $closeCardBtn = $('#close-card');
    const $card = $('#skill-card');

    $('.skill-row').on('click', function () {
        const $row = $(this);

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
