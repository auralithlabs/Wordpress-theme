<?php
/**
 * The template for displaying all pages
 *
 * @package AuraLith_Labs
 */

get_header(); ?>

<main id="main" class="site-main">
    
    <?php while (have_posts()) : the_post(); ?>
        
        <article id="page-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
            
            <?php if (has_post_thumbnail()) : ?>
                <div class="page-hero">
                    <?php the_post_thumbnail('auralith-hero', array('class' => 'page-hero-image')); ?>
                    <div class="page-hero-overlay"></div>
                    <div class="page-hero-content">
                        <h1 class="page-title"><?php the_title(); ?></h1>
                    </div>
                </div>
            <?php else : ?>
                <div class="page-header">
                    <div class="container">
                        <h1 class="page-title"><?php the_title(); ?></h1>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="container">
                <div class="entry-content">
                    <?php
                    the_content();
                    
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'auralith-labs'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>
            </div>
            
        </article>
        
    <?php endwhile; ?>
    
</main>

<?php get_footer(); ?>