$(document).ready(function () {
    // Dynamically create and append an overlay element to the body
    const $overlay = $("<div class='overlay'></div>").appendTo("body");

    // Get the close button and the unique monster card element
    const $closeCardBtn = $("#close-card");
    const $card = $("#unique-monster-card");

    // Select all rows representing unique monsters
    const $rows = $(".unique-monster-row");

    // Handle click events on unique monster rows
    $rows.on("click", function (event) {
        // Prevent action if the click is on a checkbox
        if ($(event.target).is("input")) {
            return; // Exit the function if a checkbox is clicked
        }

        // Populate the unique monster card with data from the clicked row
        $("#unique-monster-name").text($(this).data("name")); // Monster name
        $("#unique-monster-area").text($(this).data("area")); // Area of the monster
        $("#unique-monster-location").text($(this).data("location")); // Specific location
        $("#unique-monster-level").text($(this).data("level")); // Level of the monster
        $("#unique-monster-soulhacker-ability").text($(this).data("soulhackerAbility")); // Soulhacker ability

        // Show the card and overlay
        $card.show();
        $overlay.show();
    });

    // Close the unique monster card when clicking the close button
    $closeCardBtn.on("click", function () {
        $card.hide(); // Hide the card
        $overlay.hide(); // Hide the overlay
    });

    // Close the unique monster card when clicking the overlay
    $overlay.on("click", function () {
        $card.hide(); // Hide the card
        $(this).hide(); // Hide the overlay
    });

    // Handle checkbox state change for unique monsters
    $(".unique-monster-checkbox").on("change", function (event) {
        // Prevent the row click event from firing
        event.stopPropagation();
        $.fn.updateProgressBar(".unique-monster-checkbox");

        // Retrieve data about the specific checkbox and its monster
        const uniqueMonsterId = $(this).data("id"); // Monster ID
        const field = $(this).data("attribute"); // Field/attribute to update (e.g., "checked")
        const value = $(this).prop("checked") ? 1 : 0; // Checked state (1 or 0)

        // Prepare form data for the AJAX request
        const formData = new FormData();
        formData.append("field", field); // Append the field
        formData.append("value", value); // Append the new value
        formData.append("_csrf_token", csrfToken); // Append the CSRF token for security

        // Send an AJAX request to update the unique monster's status
        $.ajax({
            url: `/update-monster-status/${uniqueMonsterId}`, // API endpoint for updating status
            method: "POST", // HTTP method
            data: formData, // Form data to send
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting content type
            success: function (data) {
                if (!data.success) {
                    // Handle failure: Alert the user and revert the checkbox state
                    alert(data.error || "Failed to update status");
                    $(this).prop("checked", !$(this).prop("checked")); // Revert checkbox state
                }
            },
        });
    });
});
