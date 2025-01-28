(function($) {
    $.fn.updateProgressBar = function(checkboxClass) {
        const totalCheckboxes = $(checkboxClass).length; // Total number of checkboxes
        const checkedCheckboxes = $(`${checkboxClass}:checked`).length; // Number of checked checkboxes

        // Calculate the progress percentage
        const progress = Math.round(totalCheckboxes > 0 ? (checkedCheckboxes / totalCheckboxes) * 100 : 0);

        // Update the progress bar width and label text
        $("#progress-bar").css("width", `${progress}%`);
        $(".progress-label").text(`${progress}% Complete`); // Show progress percentage as text
    };
})(jQuery);
