// Function to toggle the visibility of the sidebar
function toggleSidebar() {
    const sidebarElement = document.getElementById('sidebar');
    const mainContentElement = document.querySelector('main');

    // Toggle the 'collapsed' class on the sidebar
    sidebarElement.classList.toggle('collapsed');

    // Adjust the margin of the main content based on the sidebar's state
    if (sidebarElement.classList.contains('collapsed')) {
        mainContentElement.style.marginLeft = '60px'; // Adjust margin when sidebar is collapsed
    } else {
        mainContentElement.style.marginLeft = '300px'; // Reset margin when sidebar is expanded
    }
}

// Function to toggle the search bar
function toggleSearch() {
    const searchContainer = document.getElementById('searchContainer');
    const searchInput = document.getElementById('searchInput');
    const searchToggle = document.getElementById('searchToggle');

    // Toggle the 'expanded' class on the search container
    searchContainer.classList.toggle('expanded');

    // Clear the input and focus if expanding
    if (searchContainer.classList.contains('expanded')) {
        searchInput.disabled = false;
        searchInput.focus();
        searchToggle.textContent = '✖'; // Change to X when expanded
    } else {
        searchInput.value = ''; // Clear input when closing
        searchInput.disabled = true; // Disable input
        searchToggle.textContent = '🔍'; // Change back to lens when collapsed
    }
}


// Event listener for the sidebar toggle button
document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.querySelector('.nav-toggle');
    toggleButton.addEventListener('click', toggleSidebar);

    const searchToggle = document.getElementById('searchToggle');
    searchToggle.addEventListener('click', toggleSearch);
});
