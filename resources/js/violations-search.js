// Debounce function to limit API calls
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Initialize search functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');
    
    console.log('Search input:', searchInput);
    console.log('Search form:', searchForm);
    
    // Auto-submit form on input
    if (searchInput && searchForm) {
        searchInput.addEventListener('input', debounce(function() {
            console.log('Submitting form...');
            searchForm.submit();
        }, 500));
    }
    
    // Clear search button
    document.body.addEventListener('click', function(e) {
        console.log('Click detected on:', e.target);
        
        if (e.target.id === 'clearSearch' || e.target.parentElement?.id === 'clearSearch') {
            console.log('Clear button clicked!');
            e.preventDefault();
            if (searchInput && searchForm) {
                searchInput.value = '';
                searchForm.submit();
            }
        }
    });
});