<?php
/**
 * The template for displaying all single posts
 *
 * @package AuraLith_Labs
 */

get_header(); ?>

<main id="main" class="site-main">
    
    <?php while (have_posts()) : the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
            
            <?php if (has_post_thumbnail()) : ?>
                <div class="post-hero">
                    <?php the_post_thumbnail('auralith-hero', array('class' => 'post-hero-image')); ?>
                    <div class="post-hero-overlay"></div>
                </div>
            <?php endif; ?>
            
            <div class="container">
                <header class="entry-header">
                    <div class="entry-meta">
                        <span class="posted-on"><?php echo get_the_date('F j, Y'); ?></span>
                        <?php
                        $categories = get_the_category();
                        if ($categories) : ?>
                            <span class="cat-links">
                                <?php foreach ($categories as $category) : ?>
                                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo esc_html($category->name); ?></a>
                                <?php endforeach; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    
                    <?php if (has_excerpt()) : ?>
                        <div class="entry-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                </header>
                
                <div class="entry-content">
                    <?php
                    the_content();
                    
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'auralith-labs'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>
                
                <footer class="entry-footer">
                    <?php
                    $tags = get_the_tags();
                    if ($tags) : ?>
                        <div class="tag-links">
                            <span class="tags-label">Tagged:</span>
                            <?php foreach ($tags as $tag) : ?>
                                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" rel="tag"><?php echo esc_html($tag->name); ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="post-navigation">
                        <?php
                        the_post_navigation(array(
                            'prev_text' => '<span class="nav-subtitle">Previous:</span> <span class="nav-title">%title</span>',
                            'next_text' => '<span class="nav-subtitle">Next:</span> <span class="nav-title">%title</span>',
                        ));
                        ?>
                    </div>
                </footer>
            </div>
            
        </article>
        
        <?php
        // Related Posts
        $related_args = array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'post__not_in'   => array(get_the_ID()),
            'orderby'        => 'rand',
        );
        
        $categories = get_the_category();
        if ($categories) {
            $category_ids = array();
            foreach ($categories as $category) {
                $category_ids[] = $category->term_id;
            }
            $related_args['category__in'] = $category_ids;
        }
        
        $related_posts = new WP_Query($related_args);
        
        if ($related_posts->have_posts()) : ?>
            <section class="related-posts content-section">
                <div class="container">
                    <h2 class="text-center">Continue Your Journey</h2>
                    
                    <div class="blog-grid">
                        <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                            <article class="blog-card">
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
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>
                </div>
            </section>
        <?php endif;
        wp_reset_postdata(); ?>
        
    <?php endwhile; ?>
    
</main>

<?php get_footer(); ?>