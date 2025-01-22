$(document).ready(function () {
    // Define constants for the necessary elements
    const $rows = $(".quest-row"); // Select all the quest rows (each representing a quest)
    const $card = $("#quest-card"); // Select the quest detail card
    const $closeCardBtn = $("#close-card"); // Select the close button on the card
    const $overlay = $("<div class='overlay'></div>").appendTo("body"); // Create and append an overlay dynamically to the body

    // Event listener for clicking a quest row to show the quest details card
    $rows.on("click", function (event) {
        // Prevent opening the card if the checkbox is clicked
        if ($(event.target).is("input")) {
            return;
        }

        // Populate the quest card with details from the clicked row using the data attributes
        $("#quest-name").text($(this).data("name")); // Display the quest name
        $("#quest-region").text($(this).data("region")); // Display the quest region
        $("#quest-type").text($(this).data("type")); // Display the quest type
        $("#quest-level").text($(this).data("level")); // Display the quest level
        $("#quest-summary").text($(this).data("summary")); // Display the quest summary
        $("#quest-giver").text($(this).data("giver")); // Display the quest giver
        $("#quest-prerequisites").text($(this).data("prerequisites")); // Display quest prerequisites
        $("#quest-rewards").text($(this).data("rewards")); // Display the quest rewards
        $("#quest-chapter").text($(this).data("chapter")); // Display the quest chapter

        // Show the quest card and the overlay
        $card.show();
        $overlay.show();
    });

    // Event listener to close the quest card when the close button is clicked
    $closeCardBtn.on("click", function () {
        // Hide the card and overlay
        $card.hide();
        $overlay.hide();
    });

    // Event listener to close the quest card when clicking outside of the card (on the overlay)
    $overlay.on("click", function () {
        // Hide the card and overlay when the overlay is clicked
        $card.hide();
        $(this).hide();
    });

    // Event listener to handle the checkbox change (when quest completion is marked)
    $(".quest-checkbox").on("change", function (event) {
        // Prevent the row click event from firing when a checkbox is clicked
        event.stopPropagation();
        updateProgressBar(); // Update progress bar if status is updated successfully

        // Get the quest ID and determine whether the checkbox is checked or not
        const questId = $(this).data("id");
        const field = "checked"; // Always updating the 'checked' field
        const value = $(this).prop("checked") ? 1 : 0; // Set value to 1 if checked, 0 if unchecked

        // Create a FormData object to send the updated status
        const formData = new FormData();
        formData.append("field", field); // Append the field name ('checked')
        formData.append("value", value); // Append the value (1 or 0)
        formData.append("_csrf_token", csrfToken); // Append CSRF token for security

        // Send an AJAX request to update the quest status on the server
        $.ajax({
            url: `/update-quest-status/${questId}`, // Server endpoint for updating quest status
            method: "POST", // HTTP method (POST)
            data: formData, // Send the form data
            processData: false, // Do not process the data (FormData does it automatically)
            contentType: false, // Do not set content type (FormData will handle it)
            success: function (data) {
                // If the server responds successfully
                if (!data.success) {
                    alert(data.error || "Failed to update status"); // Alert if there was an error
                    $(this).prop("checked", !$(this).prop("checked")); // Revert checkbox state on failure
                }
            },
        });
    });

});

// Function to update the progress bar based on the checked checkboxes
function updateProgressBar() {
    // Get the total number of quest checkboxes and the number of checked quests
    const totalQuests = $(".quest-checkbox").length;
    const checkedQuests = $(".quest-checkbox:checked").length;

    // Calculate the progress percentage
    const progress = Math.round(totalQuests > 0 ? (checkedQuests / totalQuests) * 100 : 0);

    // Update the progress bar width and label with the progress percentage
    $("#progress-bar").css("width", `${progress}%`);
    $(".progress-label").text(`${progress.toFixed(0)}% Complete`);
}
