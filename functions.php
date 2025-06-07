<?php
/**
 * AuraLith Labs Theme Functions
 *
 * @package AuraLith_Labs
 */

// Theme Setup
function auralith_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('customize-selective-refresh-widgets');
    
    // Register menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'auralith-labs'),
        'footer'  => __('Footer Menu', 'auralith-labs'),
    ));
}
add_action('after_setup_theme', 'auralith_theme_setup');

// Enqueue scripts and styles
function auralith_scripts() {
    // Google Fonts
    wp_enqueue_style('auralith-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@300;400;500&display=swap', array(), null);
    
    // Theme styles
    wp_enqueue_style('auralith-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Theme scripts
    wp_enqueue_script('auralith-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('auralith-main', 'auralith_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('auralith-nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'auralith_scripts');

// Custom Post Types
function auralith_register_post_types() {
    // Rituals Post Type
    register_post_type('ritual', array(
        'labels' => array(
            'name'          => __('Rituals', 'auralith-labs'),
            'singular_name' => __('Ritual', 'auralith-labs'),
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-heart',
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite'      => array('slug' => 'rituals'),
    ));
    
    // Style Guide Post Type
    register_post_type('style_guide', array(
        'labels' => array(
            'name'          => __('Style Guides', 'auralith-labs'),
            'singular_name' => __('Style Guide', 'auralith-labs'),
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-art',
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite'      => array('slug' => 'style'),
    ));
}
add_action('init', 'auralith_register_post_types');

// Custom Taxonomies
function auralith_register_taxonomies() {
    // Ritual Categories
    register_taxonomy('ritual_category', 'ritual', array(
        'labels' => array(
            'name'          => __('Ritual Categories', 'auralith-labs'),
            'singular_name' => __('Ritual Category', 'auralith-labs'),
        ),
        'hierarchical' => true,
        'rewrite'      => array('slug' => 'ritual-category'),
    ));
    
    // Style Categories
    register_taxonomy('style_category', 'style_guide', array(
        'labels' => array(
            'name'          => __('Style Categories', 'auralith-labs'),
            'singular_name' => __('Style Category', 'auralith-labs'),
        ),
        'hierarchical' => true,
        'rewrite'      => array('slug' => 'style-category'),
    ));
}
add_action('init', 'auralith_register_taxonomies');

// Customizer
function auralith_customize_register($wp_customize) {
    // Brand Section
    $wp_customize->add_section('auralith_brand', array(
        'title'    => __('Brand Settings', 'auralith-labs'),
        'priority' => 30,
    ));
    
    // Tagline
    $wp_customize->add_setting('auralith_tagline', array(
        'default'           => 'Beauty in structure. Power in becoming.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('auralith_tagline', array(
        'label'   => __('Brand Tagline', 'auralith-labs'),
        'section' => 'auralith_brand',
        'type'    => 'text',
    ));
    
    // Social Media Section
    $wp_customize->add_section('auralith_social', array(
        'title'    => __('Social Media', 'auralith-labs'),
        'priority' => 40,
    ));
    
    // Social links
    $social_networks = array('instagram', 'pinterest', 'linkedin', 'youtube');
    
    foreach ($social_networks as $network) {
        $wp_customize->add_setting('auralith_' . $network . '_url', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control('auralith_' . $network . '_url', array(
            'label'   => ucfirst($network) . ' URL',
            'section' => 'auralith_social',
            'type'    => 'url',
        ));
    }
}
add_action('customize_register', 'auralith_customize_register');

// Widget Areas
function auralith_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'auralith-labs'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here.', 'auralith-labs'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'auralith-labs'),
        'id'            => 'footer-widgets',
        'description'   => __('Footer widget area', 'auralith-labs'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'auralith_widgets_init');

// Custom Walker for Main Navigation
class Auralith_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= $indent . '<li' . $id . $class_names .'>';
        
        $attributes = ! empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) .'"' : '';
        $attributes .= ! empty($item->target) ? ' target="' . esc_attr($item->target) .'"' : '';
        $attributes .= ! empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) .'"' : '';
        $attributes .= ! empty($item->url) ? ' href="' . esc_attr($item->url) .'"' : '';
        
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

// AJAX Load More Posts
function auralith_load_more_posts() {
    check_ajax_referer('auralith-nonce', 'nonce');
    
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : 'post';
    
    $args = array(
        'post_type'      => $post_type,
        'posts_per_page' => 6,
        'paged'          => $paged,
    );
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', get_post_type());
        }
        wp_reset_postdata();
    }
    
    wp_die();
}
add_action('wp_ajax_auralith_load_more', 'auralith_load_more_posts');
add_action('wp_ajax_nopriv_auralith_load_more', 'auralith_load_more_posts');

// Custom Excerpt Length
function auralith_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'auralith_excerpt_length');

// Custom Excerpt More
function auralith_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'auralith_excerpt_more');

// Add custom image sizes
add_image_size('auralith-blog-thumb', 600, 400, true);
add_image_size('auralith-hero', 1920, 1080, true);
add_image_size('auralith-square', 600, 600, true);

// Security headers
function auralith_security_headers() {
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: SAMEORIGIN");
    header("X-XSS-Protection: 1; mode=block");
}
add_action('send_headers', 'auralith_security_headers');

// Clean up WordPress head
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');