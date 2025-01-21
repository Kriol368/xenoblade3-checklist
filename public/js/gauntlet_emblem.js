$(document).ready(function () {
    // Cache DOM elements for gauntlet emblem rows and card
    const rows = $(".gauntlet-emblem-row");
    const $card = $("#gauntlet-emblem-card");
    const $closeCardBtn = $("#close-card");

    // Create and append the overlay to the body dynamically
    const $overlay = $("<div class='overlay'></div>").appendTo("body");

    // Event handler for opening the card when a gauntlet emblem row is clicked
    rows.on("click", function (event) {
        // Prevent opening the card if the click is on a checkbox input
        if ($(event.target).is("input")) {
            return;
        }

        // Get the data attributes from the clicked row and populate the card with them
        $("#gauntlet-emblem-name").text($(this).data("name"));
        $("#gauntlet-emblem-rarity").text($(this).data("rarity"));
        $("#gauntlet-emblem-description").text($(this).data("description"));
        $("#gauntlet-emblem-effects").text($(this).data("effects"));

        // Set the image source dynamically based on the data-imgIndex attribute
        $("#gauntlet-emblem-img").attr("src", "/img/gauntlet/" + $(this).data("imgIndex") + ".png");

        // Show the card and overlay
        $card.show();
        $overlay.show();
    });

    // Event handler for closing the card when the close button is clicked
    $closeCardBtn.on("click", function () {
        $card.hide(); // Hide the card
        $overlay.hide(); // Hide the overlay
    });

    // Event handler for closing the card when clicking outside the card (on the overlay)
    $overlay.on("click", function () {
        $card.hide(); // Hide the card
        $(this).hide(); // Hide the overlay
    });

    // Handle checkbox changes when a gauntlet emblem checkbox is toggled
    $(".gauntlet-emblem-checkbox").on("change", function (event) {
        // Prevent triggering the row click event when interacting with the checkbox
        event.stopPropagation();

        // Get the emblem's ID and create a FormData object for the AJAX request
        const gauntletEmblemId = $(this).data("id");
        const field = "checked"; // The field that is being updated is always 'checked'
        const value = $(this).prop("checked") ? 1 : 0; // Set value to 1 if checked, 0 if unchecked

        // Create FormData for the AJAX request
        const formData = new FormData();
        formData.append("field", field);
        formData.append("value", value);
        formData.append("_csrf_token", csrfToken); // Include the CSRF token for security

        // Send an AJAX request to update the emblem's status
        $.ajax({
            url: `/update-emblem-status/${gauntletEmblemId}`, // URL to update emblem status
            method: "POST", // Using POST method for sending the data
            data: formData, // Send the FormData object
            processData: false, // Prevent jQuery from processing the data (FormData handles it)
            contentType: false, // Prevent jQuery from setting content-type, let the browser handle it
            success: function (data) {
                if (!data.success) {
                    // If update failed, alert the user and revert the checkbox state
                    alert(data.error || "Failed to update status");
                    $(this).prop("checked", !$(this).prop("checked"));
                } else {
                    // If successful, update the progress bar
                    updateProgressBar();
                }
            }.bind(this), // Bind 'this' so it refers to the checkbox that triggered the event
            error: function () {
                // In case of error, alert the user and revert the checkbox state
                alert("An error occurred while updating the status.");
                $(this).prop("checked", !$(this).prop("checked"));
            }.bind(this) // Bind 'this' to ensure it's the checkbox
        });
    });
});

// Function to update the progress bar based on the checked gauntlet emblems
function updateProgressBar() {
    const totalGauntletEmblems = $(".gauntlet-emblem-checkbox").length; // Total number of checkboxes
    const checkedGauntletEmblems = $(".gauntlet-emblem-checkbox:checked").length; // Number of checked checkboxes

    // Calculate the progress percentage (rounding to the nearest whole number)
    const progress = Math.round(
        totalGauntletEmblems > 0 ? (checkedGauntletEmblems / totalGauntletEmblems) * 100 : 0
    );

    // Update the width of the progress bar and the progress label text
    $("#progress-bar").css("width", `${progress}%`);
    $(".progress-label").text(`${progress}% Complete`);
}
