$(document).ready(function () {
    // Caching DOM elements for better performance
    const $rows = $(".challenge-mode-row"); // Rows containing challenge mode data
    const $card = $("#challenge-mode-card"); // The card where challenge mode details will be displayed
    const $closeCardBtn = $("#close-card"); // Close button for the challenge mode card
    const $overlay = $("<div class='overlay'></div>").appendTo("body"); // Dynamically add an overlay to the body

    // Event handler to open the card when a row is clicked
    $rows.on("click", function (event) {
        // If the click is on an input (checkbox), do not open the card
        if ($(event.target).is("input")) {
            return;
        }

        const $row = $(this); // The clicked row element
        // Setting the text/content of the card elements with data attributes from the clicked row
        $("#challenge-mode-name").text($row.data("name"));
        $("#challenge-mode-difficulty").text($row.data("difficulty"));
        $("#challenge-mode-waves").text($row.data("waves"));
        $("#challenge-mode-levelRestriction").text($row.data("levelRestriction"));

        // Display the card and overlay when a row is clicked
        $card.show();
        $overlay.show();
    });

    // Event handler to close the card when the close button is clicked
    $closeCardBtn.on("click", function () {
        $card.hide(); // Hide the challenge mode card
        $overlay.hide(); // Hide the overlay
    });

    // Event handler to close the card when clicking outside of it (on the overlay)
    $overlay.on("click", function () {
        $card.hide(); // Hide the challenge mode card
        $(this).hide(); // Hide the overlay
    });

    // Event handler for changes to the checkbox state (checked/unchecked)
    $(".challenge-mode-checkbox").on("change", function (event) {
        event.stopPropagation(); // Prevent the click event from bubbling up to parent elements

        // Get the challenge mode ID, field name, and checkbox state (checked or unchecked)
        const challengeModeId = $(this).data("id");
        const field = $(this).data("attribute");
        const value = $(this).prop("checked") ? 1 : 0; // If checked, value is 1; if unchecked, value is 0

        // Create FormData object to send data via AJAX
        const formData = new FormData();
        formData.append("field", field);
        formData.append("value", value);
        formData.append("_csrf_token", csrfToken); // Append CSRF token for security

        // Send the AJAX request to update the challenge mode status
        $.ajax({
            url: `/update-challenge-status/${challengeModeId}`, // URL for the AJAX request
            method: "POST", // POST method
            data: formData, // Send form data
            processData: false, // Do not process the data
            contentType: false, // Do not set content type (because we're sending FormData)
            success: function (data) {
                // If the request was successful
                if (!data.success) {
                    alert(data.error || "Failed to update status"); // Show error message
                    $(this).prop("checked", !$(this).prop("checked")); // Revert checkbox state
                } else {
                    updateProgressBar(); // Update the progress bar after success
                }
            },
            error: function () {
                // If there was an error during the AJAX request
                alert("An error occurred while updating the status.");
                $(this).prop("checked", !$(this).prop("checked")); // Revert checkbox state
            }
        });
    });

    updateProgressBar(); // Initialize the progress bar when the page loads
});

// Function to update the progress bar based on the checked checkboxes
function updateProgressBar() {
    const totalCheckboxes = $(".challenge-mode-checkbox").length; // Total number of checkboxes
    const checkedCheckboxes = $(".challenge-mode-checkbox:checked").length; // Number of checked checkboxes

    // Calculate the progress percentage
    const progress = Math.round(totalCheckboxes > 0 ? (checkedCheckboxes / totalCheckboxes) * 100 : 0);

    // Update the progress bar width and label text
    $("#progress-bar").css("width", `${progress}%`);
    $(".progress-label").text(`${progress.toFixed(0)}% Complete`); // Show percentage as text
}
