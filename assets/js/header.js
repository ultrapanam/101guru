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

                    fetch('https://yazevn.com/wp-admin/admin-ajax.php', {

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



                                // Get the 'See all results...' button from the AJAX search results

                                const seeAllResultsButton = document.getElementById('searchSubmitAjax');



                                // Get the search form

                                const searchForm = document.getElementById('searchform');



                                // Get the search input field

                                const searchInput = document.querySelector('#s');



                                // Add a click event listener to the button

                                if (seeAllResultsButton) {

                                    seeAllResultsButton.addEventListener('click', function (event) {

                                        event.preventDefault(); // Prevent the default button action

                                        // Set the search input value to the current input value

                                        const searchQuery = searchInput.value;

                                        console.log('test!');



                                        // Check if there's a search query, then submit the form

                                        if (searchQuery.trim() !== '') {

                                            searchForm.submit(); // Trigger form submission

                                        } else {

                                            alert('Please enter a search term.');

                                        }

                                    });

                                }

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





document.addEventListener('DOMContentLoaded', function () {

    // Get the search form and input field

    const searchForm = document.querySelector('#searchform');

    const searchInput = document.querySelector('#s');

    const searchButton = document.querySelector('#searchsubmit');



    // Disable the button initially if the input is empty or less than 3 characters

    function toggleButtonState() {

        const queryLength = searchInput.value.trim().length;

        if (queryLength < 3) {

            searchButton.disabled = true; // Disable the button

            searchButton.style.opacity = '0.5'; // Optionally style to show it's inactive

        } else {

            searchButton.disabled = false; // Enable the button

            searchButton.style.opacity = '1'; // Restore opacity

        }

    }



    // Run the check on page load and on input change

    toggleButtonState(); // Initial check on page load

    searchInput.addEventListener('input', toggleButtonState); // Check on input change



    // Handle the 'See all results...' button in the AJAX search results

    const seeAllResultsButton = document.querySelector('#ajax-search-results button#searchsubmit');

    if (seeAllResultsButton) {

        seeAllResultsButton.addEventListener('click', function (event) {

            event.preventDefault(); // Prevent the default button action

            const searchQuery = searchInput.value.trim();



            // Only submit the form if the search input has 3 or more characters

            if (searchQuery.length >= 3) {

                searchForm.submit();

            } else {

                alert('Please enter at least 3 characters.');

            }

        });

    }

});


// Add blinking message to the tab when user hides the tab and navigates to another
const originalTitle = document.title;
let blinkInterval = null;
let blinkState = false;

function startBlinkingTitle() {
    blinkInterval = setInterval(() => {
        document.title = blinkState ? acfBlinkMessage : originalTitle;
        blinkState = !blinkState;
    }, 1000);
}


function stopBlinkingTitle() {
    clearInterval(blinkInterval);
    document.title = originalTitle;
    blinkState = false;
}

document.addEventListener('visibilitychange', function () {
    if (document.hidden) {
        startBlinkingTitle();
    } else {
        stopBlinkingTitle();
    }
});

