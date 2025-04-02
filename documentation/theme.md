# Team1Theme Documentation

## Theme Overview

Team1Theme is a custom WordPress theme designed to provide a flexible foundation with extensive customisation options via the WordPress Customiser. Built on the Underscores (_s) starter theme, it incorporates enhancements for front page management, header, footer, page customisation and more.

## Theme Structure

The theme follows a standard WordPress organisation with these key components:

```
project-2025-tr1-jcua-team1/
├── inc/                      # Helper functions and customiser settings
│   ├── custom-header.php     # Custom header implementation
│   ├── customizer.php        # General customiser settings
│   ├── page-customizer.php   # Page-specific customiser settings
│   ├── page-meta-boxes.php   # Per-page customisation options
│   ├── post-meta-boxes.php   # Per-post customisation options
│   ├── template-functions.php# Theme enhancement functions
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
├── style.css                 # Main stylesheet including CSS variables
└── functions.php             # Theme functions and setup
```

## Key Features

### 1. Customiser Options

The theme integrates extensively with the WordPress Customiser. Key settings include:

- **Logo Options**: Customise logo size, appearance, and fallback (site title when not set).
- **Homepage Settings**: Manage the hero section, featured content, and layout.
- **Header Settings**: Options for background colour, text colour, padding, text alignment, plus settings for header link font size and header link colour.
- **Footer Settings**: Configure footer text, colours, padding, and alignment.
- **Page Template Settings**: Control layouts, featured images, and text formatting on a global or per-page basis.
- **Blog Post Settings**: Control layouts, featured images, meta information display, and text formatting on a global or per-post basis.
- **Archive Settings**: Customise archive pages (categories, tags, dates, and authors) with options for layout, pagination style, and whether to display post excerpts.
- **404 Page Options**: Customise the 404 error page with options for title, message, search form visibility, helpful widgets, and text alignment.

### 2. Archive Customisation

The archive template (`archive.php`) has been enhanced to support custom layouts and styles for category, tag, date, and author archives. Key features include:

- **Custom Layouts**: Choose between a standard list, grid layout, or full-width display (no sidebar).
- **Pagination Options**: Select between simple "Next/Previous" links or numbered pagination.
- **Post Excerpts**: Toggle whether to display excerpts (summaries) of posts in archive listings.
- **Category-Specific Template**: A dedicated `content-category.php` template is used for category archives, allowing for unique styling and layout.

These settings can be managed via **Appearance → Customise → Archive Settings**.

### 3. Front Page Template

The front page (`front-page.php`) is designed for flexibility:
- **Hero Section**: Fully customisable with heading, text, background image/colour, overlay, button text, and URL.
- **Home Category Posts**: Displays up to six most recent posts from the **home** category in a grid layout.
- **Features Section**: Placeholder area for additional content.

### 4. Header & Navigation

- **Custom Header**: Supports custom background, text colours, padding, and text alignment.
- **Header Link Settings**: The header includes customiser settings to adjust the navigation link font size and colour.
- **Navigation Background and Link Colours**: The navigation menu's background and link colours can be customised via the Customiser.
- **Navigation Link Spacing**: Adjust the spacing between navigation links using the Customiser.
- **Responsive Navigation**: Mobile-friendly menu system with a clear fallback (site title) if no logo is set.

### 5. Footer

- **Customisable Footer**: Allows custom text, colours, padding, and alignment via the Customiser.

### 6. Page and Post Customisation System

- **Global Settings**: Manage site-wide defaults through the Customiser.
- **Per-Page and Per-Post Overrides**: Use meta boxes on individual pages or posts to override global settings.
- **Flexible Layout Options**: Choose from various layouts (with sidebar, full width, narrow content) as well as individual text alignment options.

### 7. 404 Error Page

- **Customisable 404 Page**: Allows customisation of the title, message, search form visibility, helpful widgets, and text alignment via the Customiser.

### 8. Dynamic Sidebars

- **Multiple Widget Areas**: The theme includes several widget areas, allowing you to add dynamic content to different parts of your website. These include the Main Sidebar, Blog Sidebar, Post Sidebar, Page Sidebar, Shop Sidebar (if WooCommerce is active), and three Footer widget areas.
- **Context-Specific Sidebars**: Different sidebars are displayed based on the page context (e.g., blog pages, single posts, static pages).
- **Customisable via Widgets**: Sidebars can be easily customised by adding, removing, and configuring widgets via **Appearance → Widgets** in the WordPress admin area.

## Design System

### Colour Scheme

The theme utilises CSS variables (defined in `style.css`) to provide a consistent colour system across the site. For example:

```css
// filepath: themes/project-2025-tr1-jcua-team1/style.css
:root {
    --color-primary: #4169e1;      /* Royal Blue */
    --color-secondary: #800080;    /* Purple */
    --color-accent: #191970;       /* Midnight Blue */
    --color-background: #fff;      /* White */
    --color-text: black;           /* Black */
    --color-border: #ccc;          /* Light Gray */
    --color-highlight: #fff9c0;    /* Light Yellow */
    --color-header: pink;          /* Header background colour */
    // ...existing code...
}
```

### Typography

A system font stack is used for fast performance and consistent appearance:

```css
// filepath: themes/project-2025-tr1-jcua-team1/style.css
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
```

### Layout Variables

Key dimensions and layout properties are managed with CSS variables:

```css
// filepath: themes/project-2025-tr1-jcua-team1/style.css
:root {
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

### Working with the Customiser

- **Configuration**: Customiser settings are registered in `inc/customizer.php`, `inc/page-customizer.php` and additional settings in `functions.php`.
- **Live Preview**: The JavaScript file `js/customizer.js` supports live previewing of changes.
- **Extending Settings**: To add new options (for example, for header or footer customisation), follow the pattern in the existing customiser registration functions.

### File Organisation

Focus on the following key files when making theme changes:
- **style.css**: For all CSS changes and modification of CSS variables.
- **functions.php**: For theme setup and functionality.
- **inc/customizer.php**: For adding and modifying customiser settings.
- **front-page.php**: For homepage layout updates.
- **template-parts/**: For content display modifications.
- **header.php & footer.php**: For structural and display changes in these sections.

### Design Decisions

- **Modularity**: The theme splits functionality across multiple files (template-parts, inc, js) to keep the code modular and maintainable.
- **Customisability**: Nearly every visible element – from header links to layout spacing and blog post appearance – can be modified using the WordPress Customiser, reducing the need for direct code changes.
- **Responsive Design**: The header and navigation systems are designed to be responsive, ensuring a consistent experience across devices.
- **Accessibility**: Care has been taken to include accessible elements, such as skip links and proper heading structures.

## Additional Resources

- Refer to `documentation/site.md` for content management instructions.
- Consult `documentation/deployment.md` for guidance on development and deployment workflows.
- For further assistance with CSS variables or Customiser integration, review the comments in `style.css` and `inc/customizer.php`.

## Credits

Team1Theme is built upon the Underscores starter theme (https://underscores.me/) with significant customisations for enhanced flexibility and user experience. For any additional development queries or enhancements, please contact the theme developer.
