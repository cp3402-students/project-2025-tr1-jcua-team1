# Team1Theme Documentation

## Theme Overview

Team1Theme is a custom WordPress theme designed to provide a flexible foundation with easy customisation through the WordPress Customiser. The theme is built on the Underscores (_s) starter theme with significant enhancements for customisation and user experience.

## Theme Structure

The theme follows standard WordPress theme organisation with these key components:

```
project-2025-tr1-jcua-team1/
├── inc/                      # Helper functions and customiser settings
│   ├── custom-header.php     # Custom header implementation
│   ├── customizer.php        # Theme customiser settings
│   ├── template-functions.php # Theme enhancement functions
│   ├── template-tags.php     # Template helper functions
│   └── jetpack.php           # Jetpack compatibility
├── js/                       # JavaScript files
│   ├── customizer.js         # Customiser live preview
│   └── navigation.js         # Navigation functionality
├── template-parts/           # Reusable template components
│   ├── content.php           # Standard post content template
│   ├── content-page.php      # Page content template
│   ├── content-search.php    # Search results content template
│   └── content-none.php      # "No content found" template
├── front-page.php            # Homepage template
├── style.css                 # Main stylesheet
└── functions.php             # Theme functions and setup
```

## Key Features

### 1. Customiser Options

The theme includes extensive WordPress Customiser integration:

- **Logo Options**: Customise logo size and appearance
- **Homepage Settings**: Control the hero section, featured content, and layout
- **Footer Settings**: Configure footer text, colours, and padding

### 2. Front Page Template

A flexible front page template (`front-page.php`) with:

- **Hero Section**: Fully customisable with heading, text, background image/colour, and button
- **Home Category Posts**: Displays posts from the "home" category in a grid layout
- **Features Section**: Placeholder for additional homepage content

### 3. Header & Navigation

- **Custom Header**: Adaptable header with logo support
- **Responsive Navigation**: Mobile-friendly menu system
- **Logo Placeholder**: Automatic fallback to site title when no logo is set

### 4. Footer

- **Customisable Footer**: Change text, colours, padding, and alignment through the Customiser

## Design System

### Colour Scheme

The theme uses CSS variables (defined in `style.css`) for consistent theming:

```css
// filepath: /Users/josh/Desktop/nw-wp/themes/project-2025-tr1-jcua-team1/style.css
/* Variables */
:root {
	--color-primary: #4169e1; /* Royal Blue */
	--color-secondary: #800080; /* Purple */
	--color-accent: #191970; /* Midnight Blue */
	--color-background: #fff; /* White */
	--color-text: black; /* Black */
	--color-border: #ccc; /* Light Gray */
	--color-highlight: #fff9c0; /* Light Yellow */
	--color-header: pink;
	// ...existing code...
}
```

To modify the colour scheme, edit these variables in `style.css`.

### Typography

The theme uses a system font stack for optimal performance and consistent appearance:

```css
// filepath: /Users/josh/Desktop/nw-wp/themes/project-2025-tr1-jcua-team1/style.css
body,
button,
input,
select,
optgroup,
textarea {
	color: #404040;
	font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
	font-size: 1rem;
	line-height: 1.5;
}
// ...existing code...
```

### Layout Variables

Key dimensions are defined as variables:

```css
// filepath: /Users/josh/Desktop/nw-wp/themes/project-2025-tr1-jcua-team1/style.css
:root {
	// ...existing code...
	--font-size-header: 1.8rem;
	--min-header-height: 100px;
	--max-header-height: 250px;
	--max-header-width: 250px;
	--nav-links-gap: 15px;
	--header-min-gap: 10px;
    --header-max-gap: 50px;
}
```

## Development Guidelines

### 1. Adding New Template Parts

To create a new content template:

1. Add a new file in `template-parts/` named `content-{type}.php`
2. Reference it in your templates using:

```php
// filepath: /Users/josh/Desktop/nw-wp/themes/project-2025-tr1-jcua-team1/index.php
// ...existing code...
get_template_part('template-parts/content', get_post_type());
// ...existing code...
```

### 2. Customiser Modifications

To add new customiser settings:

1. Extend the customiser registration functions in `inc/customizer.php`:

```php
// filepath: /Users/josh/Desktop/nw-wp/themes/project-2025-tr1-jcua-team1/inc/customizer.php
// ...existing code...
function my_new_customizer_section($wp_customize) {
    // Add a new section
    $wp_customize->add_section('my_new_section', array(
        'title'    => __('My New Section', 'team1theme'),
        'priority' => 30,
    ));
    
    // Add a setting
    $wp_customize->add_setting('my_new_setting', array(
        'default'           => 'Default value',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    // Add a control
    $wp_customize->add_control('my_new_setting', array(
        'label'    => __('My New Setting', 'team1theme'),
        'section'  => 'my_new_section',
        'type'     => 'text',
    ));
}
add_action('customize_register', 'my_new_customizer_section');
```

2. For live preview, add corresponding JavaScript in `js/customizer.js`:

```javascript
// filepath: /Users/josh/Desktop/nw-wp/themes/project-2025-tr1-jcua-team1/js/customizer.js
// ...existing code...
wp.customize('my_new_setting', function(value) {
    value.bind(function(to) {
        $('.my-element').text(to);
    });
});
// ...existing code...
```

### 3. Adding Custom Page Templates

1. Create a new template file in the theme root:

```php
// filepath: /Users/josh/Desktop/nw-wp/themes/project-2025-tr1-jcua-team1/template-custom.php
<?php
/**
 * Template Name: Custom Template
 *
 * @package Team1Theme
 */

get_header();
?>

<main id="primary" class="site-main custom-template">
    <?php
    while (have_posts()) :
        the_post();
        get_template_part('template-parts/content', 'page');
    endwhile;
    ?>
</main>

<?php
get_footer();
```

### 4. CSS Organisation

The theme's CSS is organised by component in `style.css`:

```css
// filepath: /Users/josh/Desktop/nw-wp/themes/project-2025-tr1-jcua-team1/style.css
/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
# Generic
	- Normalize
	- Box sizing
# Base
	- Typography
	- Elements
	- Links
	- Forms
## Layouts
# Components
	- Navigation
	- Posts and pages
	- Comments
	- Widgets
	- Media
	- Captions
	- Galleries
# plugins
	- Jetpack infinite scroll
# Utilities
	- Accessibility
	- Alignments
# Custom Team1Theme
	- Custom Header
	- Custom Logo
--------------------------------------------------------------*/
// ...existing code...
```

When adding new styles, follow this organisation pattern.

### 5. Custom Logo

The theme supports custom logos with specific dimensions. To modify logo behaviour:

1. Edit the `add_theme_support('custom-logo')` parameters in `functions.php`:

```php
// filepath: /Users/josh/Desktop/nw-wp/themes/project-2025-tr1-jcua-team1/functions.php
// ...existing code...
add_theme_support(
    'custom-logo',
    array(
        'height'      => 100,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => false,
    )
);
// ...existing code...
```

2. Adjust the logo CSS variables in `style.css`
3. Modify the logo display in `header.php`

## Important Files to Edit

When customising the theme, focus on these key files:

- **style.css**: For styling changes and CSS variables
- **front-page.php**: For homepage layout modifications
- **inc/customizer.php**: For adding customisation options
- **functions.php**: For adding features and functionality
- **template-parts/*.php**: For content display modifications

## Additional Resources

- See `documentation/site.md` for content management instructions
- See `documentation/deployment.md` for development and deployment workflows

## Credits

This theme is built upon Underscores (https://underscores.me/) with significant enhancements for customisation and user experience.
