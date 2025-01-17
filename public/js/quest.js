$(document).ready(function () {
    const $rows = $(".quest-row");
    const $card = $("#quest-card");
    const $closeCardBtn = $("#close-card");
    const $overlay = $("<div class='overlay'></div>").appendTo("body"); // Add overlay dynamically


    // Handle row click event to show the quest details card
    $rows.on("click", function (event) {
        // Prevent opening the card when the checkbox is clicked
        if ($(event.target).is("input")) {
            return;
        }

        $("#quest-name").text($(this).data("name"));
        $("#quest-region").text($(this).data("region"));
        $("#quest-type").text($(this).data("type"));
        $("#quest-level").text($(this).data("level"));
        $("#quest-summary").text($(this).data("summary"));
        $("#quest-giver").text($(this).data("giver"));
        $("#quest-prerequisites").text($(this).data("prerequisites"));
        $("#quest-rewards").text($(this).data("rewards"));
        $("#quest-chapter").text($(this).data("chapter"));
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

    // Handle checkbox change event
    $(".quest-checkbox").on("change", function (event) {
        event.stopPropagation(); // Prevent the row click event from firing

        const questId = $(this).data("id");
        const field = "checked"; // The field is always 'checked'
        const value = $(this).prop("checked") ? 1 : 0;

        const formData = new FormData();
        formData.append("field", field);
        formData.append("value", value);
        formData.append("_csrf_token", csrfToken); // Include CSRF token for security

        $.ajax({
            url: `/update-quest-status/${questId}`,
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
            },
            error: function () {
                alert("An error occurred while updating the status.");
                $(this).prop("checked", !$(this).prop("checked")); // Revert checkbox state on error
            }
        });
    });

    // Initialize progress bar
    updateProgressBar();
});

// Update the progress bar based on checked checkboxes
function updateProgressBar() {
    const totalQuests = $(".quest-checkbox").length;
    const checkedQuests = $(".quest-checkbox:checked").length;

    const progress = Math.round(totalQuests > 0 ? (checkedQuests / totalQuests) * 100 : 0);

    $("#progress-bar").css("width", `${progress}%`);
    $(".progress-label").text(`${progress.toFixed(0)}% Complete`);
}
