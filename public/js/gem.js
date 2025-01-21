$(document).ready(function () {
    // Define variables for elements used in the script
    const rows = $(".gem-row"); // Select all gem rows
    const card = $("#gem-card"); // Select the gem card element
    const closeCardBtn = $("#close-card"); // Select the close button of the card
    const overlay = $("<div class='overlay'></div>").appendTo("body"); // Create a dynamic overlay and append it to the body

    // Handle row click to show the gem details card
    rows.on("click", function (event) {
        // Ensure checkbox clicks don't trigger the row click event to open the card
        if ($(event.target).is("input[type='checkbox']")) {
            return; // If the target is a checkbox, don't open the card
        }

        // Populate the gem card with data from the clicked row's data attributes
        $("#gem-name").text($(this).data("name")); // Set gem name
        $("#gem-effect").text($(this).data("effect")); // Set gem effect
        $("#gem-type").text($(this).data("type")); // Set gem type

        // Show the gem card and overlay after populating data
        card.show();
        overlay.show();
    });

    // Close the card when the close button is clicked
    closeCardBtn.on("click", function () {
        card.hide(); // Hide the card
        overlay.hide(); // Hide the overlay
    });

    // Close the card when clicking outside of it (on the overlay)
    overlay.on("click", function () {
        card.hide(); // Hide the card
        $(this).hide(); // Hide the overlay
    });

    // Handle checkbox change event for each gem
    $(".gem-checkbox").on("change", function (event) {
        // Prevent the checkbox change event from triggering the row click event
        event.stopPropagation();
        updateProgressBar(); // Update the progress bar on success


        const gemId = $(this).data("id"); // Get the gem ID from the data attribute
        const field = "checked"; // Field name is always 'checked' for checkbox
        const value = $(this).prop("checked") ? 1 : 0; // If checked, set value to 1, else set to 0

        // Create a FormData object to send the data
        const formData = new FormData();
        formData.append("field", field); // Append field data
        formData.append("value", value); // Append value (1 or 0)
        formData.append("_csrf_token", csrfToken); // Append CSRF token for security

        // Make an AJAX POST request to update the gem's checked status
        $.ajax({
            url: `/update-gem-status/${gemId}`, // Send the request to this URL with the gem ID
            method: "POST", // Use POST method
            data: formData, // Send formData
            processData: false, // Don't process the data (for FormData)
            contentType: false, // Don't set contentType (for FormData)
            success: function (data) {
                // If the request is successful, check if the status update was successful
                if (!data.success) {
                    alert(data.error || "Failed to update status"); // Show error message if unsuccessful
                    $(this).prop("checked", !$(this).prop("checked")); // Revert checkbox state if error
                }
            }.bind(this), // Bind 'this' so the correct context is used in the success callback
        });
    });
});

// Function to update the progress bar based on checked checkboxes
function updateProgressBar() {
    // Get the total number of gem checkboxes and the number of checked ones
    const totalGems = $(".gem-checkbox").length;
    const checkedGems = $(".gem-checkbox:checked").length;

    // Calculate progress as a percentage
    const progress = Math.round(totalGems > 0 ? (checkedGems / totalGems) * 100 : 0);

    // Update the progress bar width and label text with the calculated progress
    $("#progress-bar").css("width", `${progress}%`);
    $(".progress-label").text(`${progress}% Complete`);
}
