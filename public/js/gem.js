    $(document).ready(function () {
        const rows = $(".gem-row");
        const card = $("#gem-card");
        const closeCardBtn = $("#close-card");

        // Handle the row click event to show the details card
        rows.on("click", function (event) {
            // Ensure checkbox clicks don't trigger the row click
            if ($(event.target).is("input[type='checkbox']")) {
                return;
            }
            $("#gem-name").text($(this).data("name"));
            $("#gem-effect").text($(this).data("effect"));
            $("#gem-type").text($(this).data("type"));
            card.show();
        });

        // Close the detailed card when clicking the close button
        closeCardBtn.on("click", function () {
            card.hide();
        });

        // Handle checkbox change for each gem
        $(".gem-checkbox").on("change", function (event) {
            event.stopPropagation(); // Stop event from bubbling up to row click
            const gemId = $(this).data("id");
            const field = "checked"; // Field to update
            const value = $(this).prop("checked") ? 1 : 0; // 1 if checked, 0 if unchecked

            const formData = new FormData();
            formData.append("field", field);
            formData.append("value", value);
            formData.append("_csrf_token", csrfToken); // CSRF token for security

            $.ajax({
                url: `/update-gem-status/${gemId}`,
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
    });

    function updateProgressBar() {
        const totalGems = $(".gem-checkbox").length;
        const checkedGems = $(".gem-checkbox:checked").length;
        const progress = Math.round(totalGems > 0 ? (checkedGems / totalGems) * 100 : 0);

        $("#progress-bar").css("width", `${progress}%`);
        $(".progress-label").text(`${progress}% Complete`);
    }
