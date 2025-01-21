$(document).ready(function () {
    // Dynamically create and append an overlay element to the body
    const $overlay = $("<div class='overlay'></div>").appendTo("body");

    // Get the close button and the soul tree card element
    const $closeCardBtn = $("#close-card");
    const $card = $("#soul-tree-card");

    // Event listener for clicks on soul tree rows
    $(".soul-tree-row").on("click", function (event) {
        // Prevent opening the card when a checkbox is clicked
        if ($(event.target).is("input")) {
            return; // Skip opening the card if the target is a checkbox
        }

        // Retrieve data attributes from the clicked row
        const name = $(this).data("name"); // Soul tree name
        const character = $(this).data("character"); // Character associated with the soul tree
        const effect = $(this).data("effect"); // Effect of the soul tree
        const imgPath = `/img/ouroboros/${character}.png`; // Image path for the character

        // Populate the soul tree card with the extracted data
        $("#soul-tree-name").text(name); // Set the soul tree name in the card
        $("#soul-tree-img").attr("src", imgPath); // Set the image source for the soul tree
        $("#soul-tree-effect").text(effect); // Set the soul tree effect description
        $("#soul-tree-character").text(character); // Set the character's name

        // Show the soul tree card and overlay
        $card.show();
        $overlay.show();
    });

    // Event listener for the close button on the card
    $closeCardBtn.on("click", function () {
        // Hide the soul tree card and overlay when the close button is clicked
        $card.hide();
        $overlay.hide();
    });

    // Event listener for the overlay click to close the card
    $overlay.on("click", function () {
        // Hide the soul tree card and the overlay when the overlay is clicked
        $card.hide();
        $(this).hide(); // Hide the overlay
    });

    // Event listener for changes in checkbox state for soul tree
    $(".soul-tree-checkbox").on("change", function (event) {
        // Prevent the row click event from firing when the checkbox is clicked
        event.stopPropagation();

        // Get the ID of the soul tree and the checked status
        const soulTreeId = $(this).data("id");
        const field = "checked"; // The field to update (always 'checked')
        const value = $(this).prop("checked") ? 1 : 0; // 1 if checked, 0 if unchecked

        // Prepare form data to be sent in the AJAX request
        const formData = new FormData();
        formData.append("field", field); // Append the field
        formData.append("value", value); // Append the value (checked state)
        formData.append("_csrf_token", csrfToken); // Append CSRF token for security

        // Send an AJAX request to update the soul tree status
        $.ajax({
            url: `/update-soul-status/${soulTreeId}`,
            method: "POST",
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting content type
            success: function (data) {
                if (!data.success) {
                    // If the request was not successful, alert the user and revert the checkbox
                    alert(data.error || "Failed to update status");
                    $(this).prop("checked", !$(this).prop("checked")); // Revert the checkbox state
                } else {
                    updateProgressBar(); // Update the progress bar if the status was successfully updated
                }
            },
            error: function () {
                // If the request failed, alert the user and revert the checkbox
                alert("An error occurred while updating the status.");
                $(this).prop("checked", !$(this).prop("checked")); // Revert the checkbox state
            }
        });
    });

});

// Function to update the progress bar based on checked checkboxes
function updateProgressBar() {
    // Get the total number of soul tree checkboxes
    const totalSoulTrees = $(".soul-tree-checkbox").length;

    // Get the number of checked soul tree checkboxes
    const checkedSoulTrees = $(".soul-tree-checkbox:checked").length;

    // Calculate the percentage of checked soul trees
    const progress = Math.round(totalSoulTrees > 0 ? (checkedSoulTrees / totalSoulTrees) * 100 : 0);

    // Update the progress bar width and label text
    $("#progress-bar").css("width", `${progress}%`);
    $(".progress-label").text(`${progress.toFixed(0)}% Complete`);
}
