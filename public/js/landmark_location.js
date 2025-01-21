$(document).ready(function () {
    // Define constants for the necessary elements on the page
    const $rows = $(".landmark-location-row"); // Select all the rows that represent landmark locations
    const $card = $("#landmark-location-card"); // Select the card that will display landmark location details
    const $closeCardBtn = $("#close-card"); // Select the close button for the card
    const $overlay = $("<div class='overlay'></div>").appendTo("body"); // Create an overlay and append it to the body dynamically

    // Event listener for clicking a row to show the landmark location details card
    $rows.on("click", function (event) {
        // Prevent the card from opening if the checkbox is clicked
        if ($(event.target).is("input")) {
            return;
        }

        // Populate the card with the selected landmark's data
        $("#landmark-location-name").text($(this).data("name")); // Display the landmark's name
        $("#landmark-location-type").text($(this).data("type")); // Display the landmark's type
        $("#landmark-location-area").text($(this).data("area")); // Display the landmark's area
        $("#landmark-location-region").text($(this).data("region")); // Display the landmark's region

        // Show the card and the overlay
        $card.show();
        $overlay.show();
    });

    // Event listener to close the card when the close button is clicked
    $closeCardBtn.on("click", function () {
        // Hide the card and overlay
        $card.hide();
        $overlay.hide();
    });

    // Event listener to close the card when clicking outside the card (on the overlay)
    $overlay.on("click", function () {
        // Hide the card and overlay when the overlay is clicked
        $card.hide();
        $(this).hide();
    });

    // Handle checkbox change event for landmark location checkboxes
    $(".landmark-location-checkbox").on("change", function (event) {
        event.stopPropagation(); // Prevent the row click event from firing when the checkbox is clicked
        updateProgressBar(); // Update the progress bar on success

        // Get the landmark location ID and determine whether the checkbox is checked
        const landmarkLocationId = $(this).data("id");
        const field = "checked"; // The field name we are updating (always 'checked')
        const value = $(this).prop("checked") ? 1 : 0; // Set value to 1 if checked, 0 if unchecked

        // Prepare the data to send to the server (including CSRF token for security)
        const formData = new FormData();
        formData.append("field", field); // Append the field name
        formData.append("value", value); // Append the new value (1 or 0)
        formData.append("_csrf_token", csrfToken); // Append CSRF token to prevent CSRF attacks

        // Send the updated data to the server via an AJAX request
        $.ajax({
            url: `/update-landmark-status/${landmarkLocationId}`, // Server endpoint to update the status
            method: "POST", // HTTP method for the request
            data: formData, // Send the form data containing the status update
            processData: false, // Don't process data automatically (since we're using FormData)
            contentType: false, // Don't set content type (FormData will handle it)
            success: function (data) {
                // On success, check if the server responded with success
                if (!data.success) {
                    alert(data.error || "Failed to update status"); // Alert the user if there was an error
                    $(this).prop("checked", !$(this).prop("checked")); // Revert checkbox state on failure
                } else {
                }
            },
        });
    });

});

// Function to update the progress bar based on the checked checkboxes
function updateProgressBar() {
    // Get the total number of landmark location checkboxes and the number of checked checkboxes
    const totalLandmarkLocations = $(".landmark-location-checkbox").length;
    const checkedLandmarkLocations = $(".landmark-location-checkbox:checked").length;

    // Calculate the progress as a percentage
    const progress = Math.round(totalLandmarkLocations > 0 ? (checkedLandmarkLocations / totalLandmarkLocations) * 100 : 0);

    // Update the progress bar width and the progress label text
    $("#progress-bar").css("width", `${progress}%`);
    $(".progress-label").text(`${progress.toFixed(0)}% Complete`);
}
