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
