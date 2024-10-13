# Casino Reviews WordPress Theme

This repository contains a custom WordPress theme designed specifically for a casino reviews website. The theme is built using custom CSS for styling and utilizes the **ACF Pro (Advanced Custom Fields)** plugin for flexible and dynamic content management.

## Features

- **Custom Casino Review Pages**: The theme provides a layout optimized for displaying detailed casino reviews, including ratings, features, and pros/cons.
- **ACF Pro Integration**: Using ACF Pro, custom fields are created for ease of updating casino details, images, and reviews dynamically.
- **Responsive Design**: The theme is fully responsive, ensuring an optimal experience across devices including desktop, tablet, and mobile.
- **Custom CSS Styling**: The theme is styled using CSS, providing a sleek, modern, and user-friendly design.

## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/ultrapanam/101guru.git
2. **Upload the theme:**

3. **Zip the theme folder.**
Upload it via WordPress Admin → Appearance → Themes → Add New.
4. **Activate ACF Pro:**
Install and activate the ACF Pro plugin.

## SCSS Structure

The SCSS files are organized in a modular fashion for better maintainability:

- **Components**: Each component has its own SCSS file (e.g., `header.scss`, `footer.scss`, `buttons.scss`), allowing for isolated styling.
- **Utilities**: Utility SCSS files contain helper classes and mixins (e.g., `variables.scss`, `mixins.scss`, `functions.scss`).
- **Theme SCSS**: Contains global styling and theme-specific styles (e.g., `theme.scss`).

All SCSS files are compiled into a single `style.css` file used by the theme.
Modify the CSS in the theme’s style.css file for customizations as needed.

## Customize CSS:
Edit respective file to edit component styles.

## Theme Customization
Casino Reviews: Custom post types can be created for casino reviews, with fields for descriptions, ratings, and more via ACF Pro.
CSS Styling: Modify the theme’s theme.scss for personalized styles, colors, and layouts.

## Prerequisites
WordPress version `6.0 or higher`.
`ACF Pro Plugin` installed and activated.
Basic knowledge of WordPress theme management and CSS for customizations.
