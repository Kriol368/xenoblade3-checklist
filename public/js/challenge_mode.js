$(document).ready(function () {
    const $rows = $(".challenge-mode-row");
    const $card = $("#challenge-mode-card");
    const $closeCardBtn = $("#close-card");
    const $overlay = $("<div class='overlay'></div>").appendTo("body"); // Add overlay dynamically

    // Open card on row click
    $rows.on("click", function (event) {
        if ($(event.target).is("input")) {
            return;
        }
        const $row = $(this);
        $("#challenge-mode-name").text($row.data("name"));
        $("#challenge-mode-difficulty").text($row.data("difficulty"));
        $("#challenge-mode-waves").text($row.data("waves"));
        $("#challenge-mode-levelRestriction").text($row.data("levelRestriction"));
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

    // Handle checkbox changes
    $(".challenge-mode-checkbox").on("change", function (event) {
        event.stopPropagation();

        const challengeModeId = $(this).data("id");
        const field = $(this).data("attribute");
        const value = $(this).prop("checked") ? 1 : 0;

        const formData = new FormData();
        formData.append("field", field);
        formData.append("value", value);
        formData.append("_csrf_token", csrfToken);

        $.ajax({
            url: `/update-challenge-status/${challengeModeId}`,
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (!data.success) {
                    alert(data.error || "Failed to update status");
                    $(this).prop("checked", !$(this).prop("checked"));
                } else {
                    updateProgressBar();
                }
            },
            error: function () {
                alert("An error occurred while updating the status.");
                $(this).prop("checked", !$(this).prop("checked"));
            }
        });
    });

    updateProgressBar(); // Initialize progress bar
});

// Function to update the progress bar
function updateProgressBar() {
    const totalCheckboxes = $(".challenge-mode-checkbox").length;
    const checkedCheckboxes = $(".challenge-mode-checkbox:checked").length;

    const progress = Math.round(totalCheckboxes > 0 ? (checkedCheckboxes / totalCheckboxes) * 100 : 0);

    $("#progress-bar").css("width", `${progress}%`);
    $(".progress-label").text(`${progress.toFixed(0)}% Complete`);
}
