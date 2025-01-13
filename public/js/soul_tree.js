$(document).ready(function () {
    const $rows = $(".soul-tree-row");
    const $card = $("#soul-tree-card");
    const $closeCardBtn = $("#close-card");

    // Handle row click event to show the soul tree details card
    $rows.on("click", function (event) {
        // Prevent opening the card when the checkbox is clicked
        if ($(event.target).is("input")) {
            return;
        }

        $("#soul-tree-name").text($(this).data("name"));
        $("#soul-tree-img").attr("src", "/img/ouroboros/" + $(this).data("character") + ".png");
        $("#soul-tree-effect").text($(this).data("effect"));
        $("#soul-tree-character").text($(this).data("character"));
        $card.show();
    });

    // Close the soul tree details card
    $closeCardBtn.on("click", function () {
        $card.hide();
    });

    // Handle checkbox change event for soul tree
    $(".soul-tree-checkbox").on("change", function (event) {
        event.stopPropagation(); // Prevent the row click event from firing

        const soulTreeId = $(this).data("id");
        const field = "checked"; // The field is always 'checked'
        const value = $(this).prop("checked") ? 1 : 0;

        const formData = new FormData();
        formData.append("field", field);
        formData.append("value", value);
        formData.append("_csrf_token", csrfToken); // Include CSRF token for security

        $.ajax({
            url: `/update-soul-status/${soulTreeId}`,
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
    const totalSoulTrees = $(".soul-tree-checkbox").length;
    const checkedSoulTrees = $(".soul-tree-checkbox:checked").length;

    const progress = Math.round(totalSoulTrees > 0 ? (checkedSoulTrees / totalSoulTrees) * 100 : 0);

    $("#progress-bar").css("width", `${progress}%`);
    $(".progress-label").text(`${progress.toFixed(0)}% Complete`);
}
