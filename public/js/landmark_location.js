$(document).ready(function () {
    const $rows = $(".landmark-location-row");
    const $card = $("#landmark-location-card");
    const $closeCardBtn = $("#close-card");

    // Handle row click event to show the landmark location details card
    $rows.on("click", function (event) {
        // Prevent opening the card when the checkbox is clicked
        if ($(event.target).is("input")) {
            return;
        }

        $("#landmark-location-name").text($(this).data("name"));
        $("#landmark-location-type").text($(this).data("type"));
        $("#landmark-location-area").text($(this).data("area"));
        $("#landmark-location-region").text($(this).data("region"));
        $card.show();
    });

    // Close the landmark location details card
    $closeCardBtn.on("click", function () {
        $card.hide();
    });

    // Handle checkbox change event for landmark location
    $(".landmark-location-checkbox").on("change", function (event) {
        event.stopPropagation(); // Prevent the row click event from firing

        const landmarkLocationId = $(this).data("id");
        const field = "checked"; // The field is always 'checked'
        const value = $(this).prop("checked") ? 1 : 0;

        const formData = new FormData();
        formData.append("field", field);
        formData.append("value", value);
        formData.append("_csrf_token", csrfToken); // Include CSRF token for security

        $.ajax({
            url: `/update-landmark-status/${landmarkLocationId}`,
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
    const totalLandmarkLocations = $(".landmark-location-checkbox").length;
    const checkedLandmarkLocations = $(".landmark-location-checkbox:checked").length;

    const progress = Math.round(totalLandmarkLocations > 0 ? (checkedLandmarkLocations / totalLandmarkLocations) * 100 : 0);

    $("#progress-bar").css("width", `${progress}%`);
    $(".progress-label").text(`${progress.toFixed(0)}% Complete`);
}
