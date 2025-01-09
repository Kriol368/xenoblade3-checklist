$(document).ready(function () {
    const $rows = $(".unique-monster-row");
    const $card = $("#unique-monster-card");
    const $closeCardBtn = $("#close-card");

    // Handle row click event to show the unique monster details card
    $rows.on("click", function (event) {
        // Prevent the row click from triggering when clicking on the checkbox
        if ($(event.target).is("input")) {
            return; // Stops the event from propagating to the row click handler
        }

        $("#unique-monster-name").text($(this).data("name"));
        $("#unique-monster-area").text($(this).data("area"));
        $("#unique-monster-location").text($(this).data("location"));
        $("#unique-monster-level").text($(this).data("level"));
        $("#unique-monster-soulhacker-ability").text($(this).data("soulhackerAbility"));
        $card.show();
    });

    // Close the unique monster details card
    $closeCardBtn.on("click", function () {
        $card.hide();
    });

    // Handle checkbox change event for each unique monster
    $(".unique-monster-checkbox").on("change", function (event) {
        event.stopPropagation(); // Prevent the row click event from firing

        const uniqueMonsterId = $(this).data("id");
        const field = $(this).data("attribute");
        const value = $(this).prop("checked") ? 1 : 0;

        const formData = new FormData();
        formData.append("field", field);
        formData.append("value", value);
        formData.append("_csrf_token", csrfToken); // Include CSRF token for security

        $.ajax({
            url: `/update-monster-status/${uniqueMonsterId}`,
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
    const totalCheckboxes = $(".unique-monster-checkbox").length;
    const checkedCheckboxes = $(".unique-monster-checkbox:checked").length;

    const progress = Math.round(totalCheckboxes > 0 ? (checkedCheckboxes / totalCheckboxes) * 100 : 0);

    $("#progress-bar").css("width", `${progress}%`);
    $(".progress-label").text(`${progress.toFixed(0)}% Complete`);
}
