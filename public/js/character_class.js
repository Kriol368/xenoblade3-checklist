$(document).ready(function () {
    const classRows = $(".character-class-row");
    const card = $("#character-class-card");
    const closeCardBtn = $("#close-card");
    const overlay = $("<div class='overlay'></div>").appendTo("body"); // Add overlay dynamically

    const className = $("#class-name");
    const imgIndex = $("#img-index");
    const classWeapon = $("#class-weapon");
    const classNation = $("#class-nation");
    const classOffense = $("#class-offense");
    const classDefense = $("#class-defense");
    const classHealing = $("#class-healing");
    const classDifficulty = $("#class-difficulty");

    // Handle row click event to show class details
    classRows.on("click", function (event) {
        // Prevent the row click from triggering when clicking on the checkbox
        if ($(event.target).is("input")) {
            return;
        }

        const name = $(this).data("name");
        const weapon = $(this).data("weapon");
        const nation = $(this).data("nation");
        const offense = $(this).data("offense");
        const defense = $(this).data("defense");
        const healing = $(this).data("healing");
        const difficulty = $(this).data("difficulty");
        const imgIndexPath = $(this).data("imgIndex");

        // Set values in the card
        className.text(name);
        imgIndex.attr("src", `/img/characters/smol/${imgIndexPath}.png`).attr("alt", name);
        classWeapon.text(weapon || "N/A");
        classNation.text(nation || "N/A");
        classOffense.text(offense || "N/A");
        classDefense.text(defense || "N/A");
        classHealing.text(healing || "N/A");
        classDifficulty.text(difficulty || "N/A");

        card.show();
        overlay.show();

    });


    // Close the card when clicking the close button
    closeCardBtn.on("click", function () {
        card.hide();
        overlay.hide();
    });

    // Close the card when clicking outside it
    overlay.on("click", function () {
        card.hide();
        $(this).hide();
    });

    // Handle checkbox change event for character checkboxes
    $(".character-checkbox").on("change", function (event) {
        event.stopPropagation(); // Prevent the row click event

        const characterId = $(this).data("id");
        const field = $(this).data("attribute");
        const value = $(this).prop("checked") ? 1 : 0;

        const formData = new FormData();
        formData.append("field", field);
        formData.append("value", value);
        formData.append("_csrf_token", csrfToken); // Include CSRF token

        $.ajax({
            url: `/update-character-status/${characterId}`,
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
    const totalCheckboxes = $(".character-checkbox").length;
    const checkedCheckboxes = $(".character-checkbox:checked").length;

    const progress = Math.round(totalCheckboxes > 0 ? (checkedCheckboxes / totalCheckboxes) * 100 : 0);

    $("#progress-bar").css("width", `${progress}%`);
    $(".progress-label").text(`${progress}% Complete`);
}
