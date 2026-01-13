// Initialize search functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');
    const clearButton = document.getElementById('clearSearch');
    
    // Submit form 
    if (searchInput && searchForm) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchForm.submit();
            }
        });
    }
    
    // Clear search button
    if (clearButton) {
        clearButton.addEventListener('click', function(e) {
            e.preventDefault();
            if (searchInput && searchForm) {
                searchInput.value = '';
                searchForm.submit();
            }
        });
    }
});