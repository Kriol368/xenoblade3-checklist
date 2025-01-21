$(document).ready(function () {
    // Caching DOM elements for better performance
    const classRows = $(".character-class-row"); // Rows containing character class data
    const card = $("#character-class-card"); // The card where character class details will be displayed
    const closeCardBtn = $("#close-card"); // Close button for the character class card
    const overlay = $("<div class='overlay'></div>").appendTo("body"); // Dynamically add the overlay to the body

    // Elements inside the card to display the class details
    const className = $("#class-name");
    const imgIndex = $("#img-index");
    const classWeapon = $("#class-weapon");
    const classNation = $("#class-nation");
    const classOffense = $("#class-offense");
    const classDefense = $("#class-defense");
    const classHealing = $("#class-healing");
    const classDifficulty = $("#class-difficulty");

    // Handle row click event to display class details in the card
    classRows.on("click", function (event) {
        // Prevent the row click event from triggering if clicking on a checkbox (input)
        if ($(event.target).is("input")) {
            return;
        }

        // Retrieve data attributes from the clicked row (character class data)
        const name = $(this).data("name");
        const weapon = $(this).data("weapon");
        const nation = $(this).data("nation");
        const offense = $(this).data("offense");
        const defense = $(this).data("defense");
        const healing = $(this).data("healing");
        const difficulty = $(this).data("difficulty");
        const imgIndexPath = $(this).data("imgIndex");

        // Set the values inside the card with the fetched data
        className.text(name);
        imgIndex.attr("src", `/img/characters/smol/${imgIndexPath}.png`).attr("alt", name); // Set image source and alt text
        classWeapon.text(weapon || "N/A"); // Default to "N/A" if no value
        classNation.text(nation || "N/A");
        classOffense.text(offense || "N/A");
        classDefense.text(defense || "N/A");
        classHealing.text(healing || "N/A");
        classDifficulty.text(difficulty || "N/A");

        // Show the card and overlay when a class row is clicked
        card.show();
        overlay.show();
    });

    // Event handler to close the card when the close button is clicked
    closeCardBtn.on("click", function () {
        card.hide(); // Hide the class card
        overlay.hide(); // Hide the overlay
    });

    // Event handler to close the card when clicking outside the card (on the overlay)
    overlay.on("click", function () {
        card.hide(); // Hide the class card
        $(this).hide(); // Hide the overlay
    });

    // Handle checkbox change event for character checkboxes
    $(".character-checkbox").on("change", function (event) {
        event.stopPropagation(); // Prevent the row click event when changing checkbox state
        updateProgressBar(); // Update the progress bar after success

        // Retrieve character ID and checkbox data attributes
        const characterId = $(this).data("id");
        const field = $(this).data("attribute");
        const value = $(this).prop("checked") ? 1 : 0; // Set value to 1 if checked, else 0

        // Create FormData object to send data via AJAX
        const formData = new FormData();
        formData.append("field", field);
        formData.append("value", value);
        formData.append("_csrf_token", csrfToken); // Include CSRF token for security

        // Send the AJAX request to update the character's status
        $.ajax({
            url: `/update-character-status/${characterId}`, // URL for the AJAX request
            method: "POST", // POST method to send data
            data: formData, // Form data to send
            processData: false, // Do not process the data as a string
            contentType: false, // Do not set content type (for FormData)
            success: function (data) {
                // If the request is successful
                if (!data.success) {
                    alert(data.error || "Failed to update status"); // Show error message
                    $(this).prop("checked", !$(this).prop("checked")); // Revert checkbox state
                }
            },
        });
    });

    // Initialize the progress bar when the page loads
    updateProgressBar();
});

// Function to update the progress bar based on the number of checked checkboxes
function updateProgressBar() {
    const totalCheckboxes = $(".character-checkbox").length; // Total number of checkboxes
    const checkedCheckboxes = $(".character-checkbox:checked").length; // Number of checked checkboxes

    // Calculate the progress percentage
    const progress = Math.round(totalCheckboxes > 0 ? (checkedCheckboxes / totalCheckboxes) * 100 : 0);

    // Update the progress bar width and label text
    $("#progress-bar").css("width", `${progress}%`);
    $(".progress-label").text(`${progress}% Complete`); // Show progress percentage as text
}
