$(document).ready(function () {
    const rows = $(".gauntlet-emblem-row");
    const card = $("#gauntlet-emblem-card");
    const closeCardBtn = $("#close-card");

    // Open card on row click
    rows.on("click", function (event) {
        if ($(event.target).is("input")) {
            return;
        }
        $("#gauntlet-emblem-name").text($(this).data("name"));
        $("#gauntlet-emblem-rarity").text($(this).data("rarity"));
        $("#gauntlet-emblem-description").text($(this).data("description"));
        $("#gauntlet-emblem-effects").text($(this).data("effects"));
        $("#gauntlet-emblem-img").attr("src", "/img/gauntlet/" + $(this).data("imgIndex") + ".png");
        card.show();
    });

    // Close card
    closeCardBtn.on("click", function () {
        card.hide();
    });

    // Handle checkbox change
    $(".gauntlet-emblem-checkbox").on("change", function (event) {
        event.stopPropagation(); // Prevent triggering row click
        const gauntletEmblemId = $(this).data("id");
        const field = "checked"; // Field is always 'checked'
        const value = $(this).prop("checked") ? 1 : 0;

        const formData = new FormData();
        formData.append("field", field);
        formData.append("value", value);
        formData.append("_csrf_token", csrfToken); // CSRF token for security

        $.ajax({
            url: `/update-emblem-status/${gauntletEmblemId}`,
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (!data.success) {
                    alert(data.error || "Failed to update status");
                    $(this).prop("checked", !$(this).prop("checked")); // Revert checkbox state on failure
                } else {
                    updateProgressBar(); // Update progress bar on success
                }
            }.bind(this),
            error: function () {
                alert("An error occurred while updating the status.");
                $(this).prop("checked", !$(this).prop("checked")); // Revert checkbox state on error
            }.bind(this)
        });
    });
});

function updateProgressBar() {
    const totalGauntletEmblems = $(".gauntlet-emblem-checkbox").length;
    const checkedGauntletEmblems = $(".gauntlet-emblem-checkbox:checked").length;
    const progress = Math.round(
        totalGauntletEmblems > 0 ? (checkedGauntletEmblems / totalGauntletEmblems) * 100 : 0 );

    $("#progress-bar").css("width", `${progress}%`);
    $(".progress-label").text(`${progress}% Complete`);
}
