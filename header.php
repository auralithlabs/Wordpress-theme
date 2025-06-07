<?php
/**
 * The header for our theme
 *
 * @package AuraLith_Labs
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'auralith-labs'); ?></a>
    
    <header id="masthead" class="site-header">
        <div class="header-inner">
            <div class="site-branding">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                        <?php bloginfo('name'); ?>
                    </a>
                <?php endif; ?>
            </div>
            
            <nav id="site-navigation" class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'walker'         => new Auralith_Walker_Nav_Menu(),
                    'fallback_cb'    => false,
                ));
                ?>
            </nav>
            
            <button class="mobile-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <span class="menu-toggle-icon"></span>
            </button>
        </div>
    </header>