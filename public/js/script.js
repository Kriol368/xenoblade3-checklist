// Function to toggle the visibility of the sidebar
function toggleSidebar() {
    // Get the sidebar element by its ID
    const sidebarElement = document.getElementById('sidebar');
    // Get the main content element to adjust its margin when the sidebar changes
    const mainContentElement = document.querySelector('main');

    // Toggle the 'collapsed' class on the sidebar element
    sidebarElement.classList.toggle('collapsed');

    // Check if the sidebar is collapsed or expanded
    if (sidebarElement.classList.contains('collapsed')) {
        // When collapsed, adjust the margin of the main content to make space for the smaller sidebar
        mainContentElement.style.marginLeft = '60px'; // Set a smaller margin for collapsed sidebar
    } else {
        // When expanded, reset the margin to accommodate the full-size sidebar
        mainContentElement.style.marginLeft = '300px'; // Set a larger margin for expanded sidebar
    }
}

// Function to toggle the search bar visibility and state
function toggleSearch() {
    // Get the search container element (the div that holds the search bar)
    const searchContainer = document.querySelector('header .search');
    // Get the search input field where the user types the query
    const searchInput = document.getElementById('searchInput');
    // Get the search toggle button (the magnifying glass or cross icon)
    const searchToggle = document.getElementById('searchToggle');

    // Toggle the 'expanded' class on the search container to show or hide the search bar
    searchContainer.classList.toggle('expanded');

    // Check if the search container is expanded
    if (searchContainer.classList.contains('expanded')) {
        // If expanded, enable the search input and focus on it so the user can start typing
        searchInput.disabled = false; // Enable the input field
        searchInput.focus(); // Set focus to the input field
        searchToggle.textContent = '✖'; // Change the icon to a cross (to close the search bar)
    } else {
        // If collapsed, clear the input field and disable it
        searchInput.value = ''; // Clear the input value
        searchInput.disabled = true; // Disable the input field
        searchToggle.textContent = '🔍'; // Change the icon back to the magnifying glass
    }
}

// Event listener for the sidebar toggle button
document.addEventListener('DOMContentLoaded', () => {
    // Get the sidebar toggle button by its class
    const toggleButton = document.querySelector('.nav-toggle');
    // Add a click event listener to the toggle button, which will call the toggleSidebar function
    toggleButton.addEventListener('click', toggleSidebar);

    // Get the search toggle button (the search icon)
    const searchToggle = document.getElementById('searchToggle');
    // Add a click event listener to the search toggle button, which will call the toggleSearch function
    searchToggle.addEventListener('click', toggleSearch);
});
