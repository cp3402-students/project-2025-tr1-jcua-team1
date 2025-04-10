# Site Documentation

## Table of Contents

1. [Front Page Management](#front-page-management)
    * [Hero Section](#hero-section)
    * [Image Carousel Section](#image-carousel-section)
    * [Featured Home Posts](#featured-home-posts)
    * [Header Customisation](#header-customisation)
2. [Enhanced Color Selection Tools](#enhanced-color-selection-tools)
3. [Adding New Content](#adding-new-content)
    * [Pages](#pages)
    * [Posts](#posts)
    * [Calendar of Events (if applicable)](#calendar-of-events-if-applicable)
4. [Footer Customisation](#footer-customisation)
5. [Page Customisation](#page-customisation)
    * [Global Page Settings](#global-page-settings)
    * [Individual Page Settings](#individual-page-settings)
6. [Blog Post Customisation](#blog-post-customisation)
    * [Global Blog Post Settings](#global-blog-post-settings)
    * [Individual Post Settings](#individual-post-settings)
7. [Archive Customisation (Categories, Tags, Dates)](#archive-customisation-categories-tags-dates)
8. [404 Error Page Customisation](#404-error-page-customisation)
9. [Sidebar Customisation](#sidebar-customisation)
10. [Widget Areas](#widget-areas)
11. [Color Scheme Customisation](#color-scheme-customisation)
12. [WPForms Registration Form](#wpforms-registration-form)
13. [The Events Calendar Plugin](#the-events-calendar-plugin)

## Front Page Management

The front page of the website has been designed to be easily customisable without needing to edit code. Here's some detail on how to manage each section:

### Hero Section

The top section of the homepage (hero section) can be fully customised through the WordPress Customiser:

1. Go to **Appearance → Customize → Homepage Settings**
2. Here you can modify:
   - **Hero Heading**: The main title displayed on the homepage.
   - **Hero Text**: The descriptive paragraph below the heading.
   - **Hero Background Image**: Upload an image to use as the background (takes priority over the background colour).
   - **Background Image Overlay**: Adjust the darkness of the overlay on the background image.
   - **Hero Background Colour**: Change the background colour (used when no image is set).
   - **Hero Text Colour**: Change the colour of all text in the hero section.
   - **Header Alignment**: Align the hero heading text (left, centre, or right).
   - **Text Alignment**: Align text left, centre or right.
   - **Hero Section Width**: Adjust the width of the content area (50–100%).
   - **Hero Button Text**: The text displayed on the call-to-action button.
   - **Hero Button URL**: Where the button links to (can be an internal page or external URL).
   - **Hero Foreground Image**: Upload an image to display as a content element within the hero section, separate from the background.
   - **Hero Image Position**: Choose whether to display the foreground image above or below the text content.
   - **Hero Image Max Width (%)**: Set the maximum width of the foreground image as a percentage of the hero section width.
3. Changes will be visible in the preview and will go live when you click "Publish".

### Image Carousel Section

The homepage has the option to display an image carousel:

1. Go to **Appearance → Customize → Homepage Settings**
2. Scroll down to the **Image Carousel Settings** section
3. Here you can modify:
   - **Enable Image Carousel**: Toggle to show or hide the carousel on the homepage.
   - **Carousel Position**: Choose whether to display the carousel above or below the hero section.
   - **Carousel Width (%)**: Set the width of the carousel container (50-100%).
   - **Show Image Captions**: Choose whether to display captions below carousel images.
   - **Carousel Speed (ms)**: Control the timing between slide transitions (in milliseconds).
   - **Carousel Image Height**: Choose how to normalize image heights (Auto, Fixed Height, Maintain Aspect Ratio, or Cover/Crop).
   - **Carousel Container Height (%)**: Adjust the overall height of the carousel container.
   - **Fixed Image Height (px)**: Set an exact height for all carousel images (when Fixed Height is selected).
   - **Image Aspect Ratio**: Choose the aspect ratio for images (when Maintain Aspect Ratio is selected).
4. You can add up to 5 images to the carousel, each with:
   - An uploaded image.
   - An optional caption.
   - An optional link URL.
5. Changes will be visible in the preview and will go live when you click "Publish"

### Featured Home Posts

The middle section of the homepage displays posts from the **home** category. These settings are now located within the **Homepage Settings** in the WordPress Customiser:

1. Go to **Appearance → Customize → Homepage Settings**
2. Scroll down to the **Home Posts Display Options** section.
3. Here you can modify:
   - **Enable Links to Posts**: Choose whether the post titles and thumbnails link to the single post view.
   - **Home Post Width (%)**: Adjust the width of each post in the grid (50-100%).
   - **Post Title Alignment**: Align the post titles (left, centre, or right).
   - **Post Heading Size**: Choose the HTML heading tag size for post titles (H2, H3, H4, or H5).
   - **Show Post Titles**: Toggle the visibility of post titles.
   - **Post Text Alignment**: Align the post excerpts (left, centre, right, or justify).
   - **Show Post Meta Information**: Toggle the visibility of post meta data (date, author, categories, etc.).
   - **Post Content Display**: Choose to display excerpt only or full content for homepage posts.
   - **Content Headings Alignment**: Set alignment for headings inside post content.
   - **Order Posts By**: Control how posts are ordered (publication date, last modified date, title, custom order, comment count, or random).
   - **Order Direction**: Choose between ascending (A-Z, oldest to newest) or descending (Z-A, newest to oldest) order.
   - **Show Sticky Posts First**: Option to always display sticky posts at the top of the list regardless of other sorting.
4. **Adding content to this section**:
   - Create a new post by going to **Posts → Add New**.
   - Write your content and add a featured image.
   - Assign the post to the **home** category.
   - Publish the post.
   - To make a post "sticky" (always appear at top when that option is enabled), check the "Stick this post to the front page" box in the Publish panel.
5. **Important notes**:
   - The homepage displays up to six most recent posts from the **home** category.
   - Featured images are highly recommended for visual appeal.
   - Use the excerpt field for a custom summary (otherwise WordPress will use the first section of your content).
   - Using the "Custom Order" option in "Order Posts By" requires you to set the "Order" value in each post's "Page Attributes" box.

### Header Customisation

Your website header has been integrated with several customisation options to help you maintain a consistent and appealing look across your site. You can modify these options via the WordPress Customiser:

1. Go to **Appearance → Customize → Header Settings**
2. You can update the following:
   - **Header Background Colour**: Set the background colour of the header.
   - **Header Text Colour**: Change the colour of the site title and description.
   - **Header Padding (Height)**: Adjust the top and bottom padding of the header.
   - **Header Text Alignment**: Choose whether the text is aligned left, centre or right.
   - **Header Link Font Size**: Change the size (in pixels) of the navigation link text.
   - **Header Link Colour**: Set the colour of the navigation links.
   - **Navigation Background Colour**: Set the background colour of the navigation menu.
   - **Navigation Link Hover Colour**: Set the colour of the navigation links when hovered over.
   - **Navigation Link Spacing**: Adjust the spacing between navigation links (in pixels).
3. Any changes made here will update the header appearance instantly in the preview. Click "Publish" to apply your changes.

## Enhanced Color Selection Tools

Throughout the Customizer, you'll find an enhanced color selection interface that allows you to:

1. **Select Theme Colors**: Choose from predefined theme colors that maintain a consistent design
2. **Use Custom Colors**: Select your own custom colors using the color picker
3. **Apply CSS Variables**: Use theme color variables like `--color-primary` or `--color-accent`

This enhanced color selection is available in various sections including:
- Homepage Settings (Hero Background, Text Colors).
- Page Settings (Content Background, Text, Link Colors).
- Header and Footer Settings.

To use the enhanced color selection:
1. Click on a color setting field
2. Select from the "Theme Colors" dropdown or use the color picker
3. Changes will be visible in the preview immediately

## Adding New Content

### Pages

Pages are used for static content such as the About page, Contact page or any other information pages that will not change frequently.

- To add a page, go to **Pages → Add New**
- Enter your content and use the available meta boxes to Customize the layout if needed (for example, overriding default page settings via **Page Settings** in the right sidebar).
- When saving, choose whether to display the page title or use any custom layout options provided.

### Posts

Posts are intended for regularly updated content such as blog entries or news updates.

- To add a post, go to **Posts → Add New**
- Write your content, and add a featured image if required
- Ensure you assign the post to the **home** category if you want it to appear in the featured home posts section.
- Publish the post to see it appear on the homepage (up to six recent posts will be shown).

### Calendar of Events (if applicable)

If your website utilises an events calendar plugin:

- The events will usually be managed within a dedicated **Events** post type or via a calendar interface provided by the plugin.
- Consult the plugin's own documentation for details on how to add, edit and delete events.
- Typically, events can be viewed and managed by going to the **Events** section in your WordPress dashboard.

## Footer Customisation

The website footer can be fully customised through the WordPress Customiser:

1. Go to **Appearance → Customize → Footer Settings**
2. Here you can modify:
   - **Footer Text**: Change the copyright text or add custom content.
   - **Footer Background Colour**: Change the background colour of the footer.
   - **Footer Text Colour**: Change the colour of all text in the footer.
   - **Footer Padding**: Adjust the height of the footer by increasing or decreasing padding.
   - **Footer Text Alignment**: Align text left, centre or right.
3. Changes will be visible in the preview and will go live when you click "Publish"

## Page Customisation

Individual pages can be customised both globally and on a per-page basis:

### Global Page Settings

These settings apply to all pages by default:

1. Go to **Appearance → Customize → Page Template Settings**
2. Here you can modify:
   - **Default Page Layout**: Choose between with sidebar, full width, or narrow content.
   - **Show Page Title**: Toggle the visibility of page titles.
   - **Page Content Background**: Set the background colour for page content.
   - **Content Padding**: Adjust the space around the page content.
   - **Page Text Color**: Choose the color for page text content.
   - **Page Heading Color**: Set the color for page headings.
   - **Page Link Color**: Set the color for links within page content.
   - **Featured Image Display**: Choose how featured images appear (banner, above content, background or hidden).
   - **Default Heading Alignment**: Set text alignment for all headings (left, centre or right).
   - **Default Body Text Alignment**: Set text alignment for all body text (left, centre, right or justify).
3. Changes will be visible in the preview and will go live when you click "Publish"

### Individual Page Settings

For each specific page, you can override the global defaults:

1. Edit any page in WordPress
2. Look for the **Page Settings** box in the right sidebar
3. Here you can Customize:
   - **Page Layout**: Override the default layout for this specific page.
   - **Show Page Title**: Choose whether to display the page title.
   - **Heading Alignment**: Set a different alignment for all headings on this page.
   - **Body Text Alignment**: Set a different alignment for all body text on this page.
4. These settings will only affect the individual page you are editing. Select "Theme Default" for any option to revert to the global setting.

## Blog Post Customisation

Blog posts can be customised both globally and on a per-post basis:

### Global Blog Post Settings

These settings apply to all blog posts by default:

1. Go to **Appearance → Customize → Blog Post Settings**
2. Here you can modify:
   - **Default Post Layout**: Choose between with sidebar, full width, or narrow content.
   - **Featured Image Display**: Choose how featured images appear (banner, above content, background or hidden).
   - **Post Content Background**: Set the background colour for post content.
   - **Content Padding**: Adjust the space around post content.
   - **Show Post Meta Information**: Toggle the visibility of post meta data (date, author, categories, etc.).
   - **Heading Alignment**: Set text alignment for all headings (left, centre or right).
   - **Text Alignment**: Set text alignment for all body text (left, centre, right or justify).
3. Changes will be visible in the preview and will go live when you click "Publish"

### Individual Post Settings

For each specific post, you can override the global defaults:

1. Edit any post in WordPress
2. Look for the **Post Style Settings** box in the right sidebar
3. Here you can customise:
   - **Show Post Meta Information**: Choose whether to display the post meta information.
   - **Heading Alignment**: Set a different alignment for all headings on this post.
   - **Text Alignment**: Set a different alignment for all body text on this post.
4. These settings will only affect the individual post you are editing. Select "Theme Default" for any option to revert to the global setting.

## Archive Customisation (Categories, Tags, Dates)

Archive pages (like category listings, tag pages, and date-based archives) can be customised to control their layout and appearance:

1.  Go to **Appearance → Customize → Archive Settings**
2.  Here you can modify:
    -   **Archive Layout**: Choose between a standard list, a grid layout, or a full-width display (no sidebar).
    -   **Pagination Style**: Select either simple "Next/Previous" links or numbered pagination.
    -   **Show Post Excerpts**: Toggle whether to display excerpts (summaries) of posts in the archive listings.
3.  Changes will be visible in the preview and will go live when you click "Publish".

## 404 Error Page Customisation

The 404 error page can be customised through the WordPress Customiser:

1. Go to **Appearance → Customize → 404 Page Options**
2. Here you can modify:
   - **404 Page Title**: Change the main title displayed on the 404 page.
   - **404 Page Message**: Change the descriptive message displayed on the 404 page.
   - **Show Search Form**: Toggle the visibility of the search form.
   - **Show Helpful Widgets**: Toggle the visibility of relevant widgets (Recent Posts, Categories, Tag Cloud).
   - **Text Alignment**: Choose whether the title and message text are aligned left, centre or right.
3. Changes will be visible in the preview and will go live when you click "Publish".

## Sidebar Customisation

Your website features dynamic sidebars that can be customised using widgets. You can manage these sidebars via the WordPress admin area:

1.  Go to **Appearance → Widgets**
2.  You will see several available sidebars:
    -   **Main Sidebar**: This sidebar appears on most pages of your site.
    -   **Blog Sidebar**: This sidebar appears on the blog index and archive pages.
    -   **Post Sidebar**: This sidebar appears on individual blog post pages.
    -   **Page Sidebar**: This sidebar appears on static pages.
    -   **Shop Sidebar**: This sidebar appears on WooCommerce shop pages (if WooCommerce is installed).
    -   **Footer 1, Footer 2, Footer 3**: These sidebars appear in the footer of your site, arranged in three columns.
3.  To add content to a sidebar, simply drag and drop widgets from the left-hand side into the desired sidebar.
4.  To configure a widget, click the arrow to expand its settings.
5.  Changes are saved automatically.

## Widget Areas

Your theme includes several widget areas, allowing you to add dynamic content to different parts of your website:

1.  **Main Sidebar**: The primary sidebar, displayed on most pages.
2.  **Blog Sidebar**: Displayed on the blog index and archive pages.
3.  **Post Sidebar**: Displayed on individual blog posts.
4.  **Page Sidebar**: Displayed on static pages.
5.  **Shop Sidebar**: Displayed on WooCommerce shop pages (if WooCommerce is active).
6.  **Footer 1**: First column of the footer widget area.
7.  **Footer 2**: Second column of the footer widget area.
8.  **Footer 3**: Third column of the footer widget area.

## Color Scheme Customisation

Your website's color scheme can be customised through the WordPress Customiser:

1. Go to **Appearance → Customize → Color Scheme**
2. Here you can modify:
   - **Primary Color**: The main brand color used for key elements.
   - **Secondary Color**: A complementary color for visual variety.
   - **Accent Color**: Used for highlights and calls to action.
   - **Background Color**: The main background color for the site.
   - **Text Color**: The default color for text content.
3. Changes will be visible in the preview and will go live when you click "Publish".
4. These colors are available throughout the theme as CSS variables, making color selection consistent across the site.

## WPForms Registration Form

Your website uses the WPForms plugin for the creation of the registration form and this can be customised through the form editor:

1. Go to **WPforms → All Forms → Registration Form**
2. Here you can modify:
   - **Form Fields**: Add and remove form fields.
   - **Form Field Options**: Adjust how each form field behaves (e.g. accepted input, label).

## The Events Calendar Plugin

Your website uses the The Events Calendar plugin for creating and managing upcoming events:

1. Go to **Events → Add New Event**
2. Here you can create a new event and modify the details. You can also mark the event as featured.
---

This guide is intended to help you maintain the site without having to edit code. For any additional changes beyond the provided customiser settings, please contact your theme developer.