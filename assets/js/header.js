document.addEventListener('DOMContentLoaded', function () {
    const burgerMenu = document.querySelector('.burger-menu');
    const mainNavigation = document.querySelector('.main-navigation');
    const menuItems = document.querySelectorAll('.nav-menu .menu-item-has-children');

    // Toggle mobile menu
    burgerMenu.addEventListener('click', function () {
        burgerMenu.classList.toggle('active');
        mainNavigation.classList.toggle('active');
    });

    // Handle submenu toggles on mobile
    menuItems.forEach(function (menuItem) {
        const link = menuItem.querySelector('a');
        const subMenu = menuItem.querySelector('.sub-menu');

        link.addEventListener('click', function (e) {
            if (window.innerWidth <= 992) {
                e.preventDefault();

                // Check if we're clicking on a second-level or third-level menu
                const isSubMenu = menuItem.parentElement.classList.contains('sub-menu');
                const isOpen = menuItem.classList.contains('open');

                // Close all other submenus if it's a second-level menu
                if (!isSubMenu) {
                    document.querySelectorAll('.nav-menu .menu-item-has-children').forEach(function (item) {
                        if (item !== menuItem) {
                            item.classList.remove('open');
                            const otherSubMenu = item.querySelector('.sub-menu');
                            if (otherSubMenu) {
                                otherSubMenu.style.display = 'none';
                            }
                        }
                    });
                }

                // Toggle the current submenu
                if (!isOpen) {
                    menuItem.classList.add('open');
                    subMenu.style.display = 'block';
                } else {
                    menuItem.classList.remove('open');
                    subMenu.style.display = 'none';
                }
            }
        });
    });
});

// HEader search

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('#s');
    const searchResultsContainer = document.querySelector('#ajax-search-results');
    const loadingSpinner = document.querySelector('#loading-spinner');
    const headerSearch = document.querySelector('.header-search');
    const searchForm = document.querySelector('.header-search form');
    const searchIcon = document.querySelector('#searchsubmit'); // The search button with the icon

    // Handle collapsible search on mobile
    searchIcon.addEventListener('click', function (e) {
        if (window.innerWidth <= 992) { // Trigger only on mobile sizes
            // e.preventDefault(); // Prevent form submission on click
            headerSearch.classList.add('expanded');
            searchInput.focus(); // Focus the input when expanded
        }
    });

    // Close search when clicked outside
    document.addEventListener('click', function (e) {
        if (!headerSearch.contains(e.target) && window.innerWidth <= 992) {
            headerSearch.classList.remove('expanded');
            searchResultsContainer.innerHTML = ''; // Clear search results
        }
    });

    // Handle AJAX search
    if (searchInput && searchResultsContainer) {
        let debounceTimer; // Timer for debouncing

        searchInput.addEventListener('input', function () {
            const query = this.value.trim();

            if (query.length > 2) { // Only trigger search after 3 characters
                // Clear the previous debounce timer
                clearTimeout(debounceTimer);

                // Set a new debounce timer to limit AJAX requests
                debounceTimer = setTimeout(() => {
                    const data = new FormData();
                    data.append('action', 'ajax_live_search');
                    data.append('query', query);

                    // Show the loading spinner
                    loadingSpinner.style.display = 'block';

                    // Perform the AJAX fetch call
                    fetch('http://101.guru/wp-admin/admin-ajax.php', {
                        method: 'POST',
                        body: data,
                    })
                        .then(response => response.text())
                        .then(results => {
                            // Hide the loading spinner and show results only if results exist
                            loadingSpinner.style.display = 'none';

                            // Check if results are empty and then display accordingly
                            if (results.trim() === '') {
                                searchResultsContainer.innerHTML = '<ul><li style="color: white;">No results found</li></ul>';
                            } else {
                                searchResultsContainer.innerHTML = results;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            // Hide the loading spinner in case of error
                            loadingSpinner.style.display = 'none';
                            searchResultsContainer.innerHTML = '<ul><li style="color: white;">Error occurred</li></ul>';
                        });
                }, 300); // Adjust debounce time as needed
            } else {
                // Clear results if input is less than 3 characters and hide the spinner
                searchResultsContainer.innerHTML = '';
                loadingSpinner.style.display = 'none';
            }
        });
    }
});
