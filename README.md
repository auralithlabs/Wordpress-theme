# AuraLith Labs WordPress Theme

A sophisticated WordPress theme embodying elevated digital mysticism and aesthetic automation for women building lives of depth, beauty, and direction.

## Theme Features

- **Custom Post Types**: Rituals and Style Guides
- **Responsive Design**: Mobile-first approach with elegant breakpoints
- **Custom Navigation Walker**: Enhanced menu styling
- **AJAX Load More**: Smooth content loading without page refresh
- **Customizer Options**: Brand tagline and social media links
- **SEO Optimized**: Clean, semantic HTML5 markup
- **Performance Focused**: Optimized assets and lazy loading

## Installation

1. Download the theme files
2. Create a folder named `auralith-labs` in your WordPress `wp-content/themes/` directory
3. Upload all theme files to this folder
4. Navigate to WordPress Admin > Appearance > Themes
5. Activate the AuraLith Labs theme

## File Structure

```
auralith-labs/
├── assets/
│   ├── css/
│   │   └── additional-styles.css
│   └── js/
│       └── main.js
├── template-parts/
│   └── content.php
├── style.css
├── functions.php
├── index.php
├── header.php
├── footer.php
├── single.php
├── page.php
├── archive.php
├── search.php
├── 404.php
└── README.md
```

## Required Plugins

While the theme works standalone, these plugins enhance functionality:

- **Advanced Custom Fields** (optional): For additional custom fields
- **Contact Form 7** (optional): For contact forms
- **Yoast SEO** (optional): Enhanced SEO capabilities

## Customization

### Colors
The theme uses CSS custom properties for easy color customization:

```css
--mine-shaft: #242424;    /* Primary dark */
--vista-white: #faf4f2;   /* Primary light */
--clam-shell: #cdaaa6;    /* Muted rose */
--brandy: #dbc090;        /* Warm gold */
--silver-sand: #c5c8cb;   /* Neutral gray */
--shady-lady: #a19fa0;    /* Warm gray */
--laser: #cfaf6e;         /* Gold accent */
--empress: #7c7375;       /* Muted purple */
--xanadu: #747c77;        /* Sage green */
```

### Typography
- Headings: Playfair Display (serif)
- Body: Inter (sans-serif)

### Menus
Register your menus in Appearance > Menus:
- Primary Menu: Main navigation
- Footer Menu: Footer links

## Custom Post Types

### Rituals
Share weekly practices and intentional living guides:
- URL: `/rituals/`
- Supports: Title, Editor, Thumbnail, Excerpt
- Custom taxonomy: Ritual Categories

### Style Guides
Curated style recommendations and aesthetic insights:
- URL: `/style/`
- Supports: Title, Editor, Thumbnail, Excerpt
- Custom taxonomy: Style Categories

## Theme Customizer

Access via Appearance > Customize:

1. **Brand Settings**
   - Brand Tagline

2. **Social Media**
   - Instagram URL
   - Pinterest URL
   - LinkedIn URL
   - YouTube URL

## Widget Areas

1. **Sidebar**: Standard blog sidebar
2. **Footer Widgets**: Footer content area

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

## Credits

- Fonts: Google Fonts (Playfair Display, Inter)
- Icons: Dashicons (WordPress native)
- JavaScript: jQuery (WordPress included)

## License

GPL v2 or later

---

**Note**: This theme intentionally avoids references to AI or automation in public-facing content, maintaining a human-first, aesthetically conscious brand voice.
