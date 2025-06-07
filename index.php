<?php
/**
 * The main template file
 *
 * @package AuraLith_Labs
 */

get_header(); ?>

<main id="main" class="site-main">
    
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content fade-in">
            <h1 class="hero-title"><?php echo get_theme_mod('auralith_tagline', 'Beauty in structure. Power in becoming.'); ?></h1>
            <p class="hero-subtitle">For women building a life of depth, beauty, and direction.</p>
            <div class="hero-actions">
                <a href="#explore" class="btn btn-primary">Explore Rituals</a>
                <a href="#style" class="btn btn-secondary">Discover Style</a>
            </div>
        </div>
    </section>
    
    <!-- Introduction Section -->
    <section class="content-section">
        <div class="container">
            <div class="text-center fade-in">
                <h2>Where Intention Meets Elevation</h2>
                <p class="lead">AuraLith Labs is a curated space where aesthetic consciousness meets practical wisdom. We believe in the power of intentional living, where every choice is an opportunity to align with your highest self.</p>
            </div>
        </div>
    </section>
    
    <!-- Features Section -->
    <section id="explore" class="content-section" style="background: rgba(205, 170, 166, 0.1);">
        <div class="container">
            <h2 class="text-center fade-in">Cultivate Your Evolution</h2>
            
            <div class="feature-grid">
                <div class="feature-card fade-in">
                    <div class="feature-icon"></div>
                    <h3>Weekly Rituals</h3>
                    <p>Thoughtfully designed practices that anchor your days in intention and beauty.</p>
                </div>
                
                <div class="feature-card fade-in">
                    <div class="feature-icon"></div>
                    <h3>Style Curation</h3>
                    <p>Elevated recommendations that reflect depth, not trends. Style as signal, not performance.</p>
                </div>
                
                <div class="feature-card fade-in">
                    <div class="feature-icon"></div>
                    <h3>Digital Tools</h3>
                    <p>Minimalist resources designed to support your growth without overwhelming your process.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Recent Posts Section -->
    <section class="content-section">
        <div class="container">
            <h2 class="text-center fade-in">Latest Insights</h2>
            
            <div class="blog-grid">
                <?php
                $recent_posts = new WP_Query(array(
                    'post_type'      => 'post',
                    'posts_per_page' => 3,
                    'orderby'        => 'date',
                    'order'          => 'DESC'
                ));
                
                if ($recent_posts->have_posts()) :
                    while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                        
                        <article class="blog-card fade-in">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('auralith-blog-thumb', array('class' => 'blog-image')); ?>
                                </a>
                            <?php endif; ?>
                            
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <?php echo get_the_date('F j, Y'); ?>
                                </div>
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php the_excerpt(); ?>
                                <a href="<?php the_permalink(); ?>" class="read-more">Continue Reading →</a>
                            </div>
                        </article>
                        
                    <?php endwhile;
                    wp_reset_postdata();
                endif; ?>
            </div>
            
            <div class="text-center" style="margin-top: 3rem;">
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="btn