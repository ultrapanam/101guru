<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php wp_head(); ?>

    <?php
        $logo = get_field( 'site_logo', 'option' );
    ?>
</head>
<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="header-container">
            <div class="logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php if ( $logo ) { 
                    echo generate_acf_image($logo, true);
                } else { ?>
                <p><?php bloginfo( 'name' ); ?></p>
                <?php } ?>
            </a>
            </div>
            <nav class="main-navigation">
                <?php wp_nav_menu( array(
                    'theme_location' => 'header-menu',
                    'container'      => false,
                    'menu_class'     => 'nav-menu',
                    'fallback_cb'    => false,
                ) ); ?>

            <!-- Add the search form here -->
            <div class="header-search">
                <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Search..." autocomplete="off">
                    <button type="submit" id="searchsubmit">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/search.svg" alt="Search Icon" class="search-icon">
                    </button>
                </form>
                <div id="ajax-search-results"></div> <!-- Ensure this element exists -->

                <!-- Add the spinner -->
                <div id="loading-spinner" style="display: none;">
                    <div class="spinner"></div>
                </div>
            </div>
            <div class="burger-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            </nav>
        </div>
    </header>

<script>
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
            e.preventDefault(); // Prevent form submission on click
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

    // Handle AJAX search as before
    if (searchInput && searchResultsContainer) {
        searchInput.addEventListener('input', function () {
            const query = this.value;

            if (query.length > 2) { // Only trigger search after 3 characters
                const data = new FormData();
                data.append('action', 'ajax_live_search');
                data.append('query', query);

                // Show the loading spinner
                loadingSpinner.style.display = 'block';

                fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                    method: 'POST',
                    body: data,
                })
                .then(response => response.text())
                .then(results => {
                    // Hide the loading spinner and show results
                    loadingSpinner.style.display = 'none';
                    searchResultsContainer.innerHTML = results;
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Hide the loading spinner in case of error
                    loadingSpinner.style.display = 'none';
                });
            } else {
                // Clear results if input is less than 3 characters and hide the spinner
                searchResultsContainer.innerHTML = '';
                loadingSpinner.style.display = 'none';
            }
        });
    }
});


</script>