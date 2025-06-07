<?php
/**
 * The template for displaying archive pages
 *
 * @package AuraLith_Labs
 */

get_header(); ?>

<main id="main" class="site-main">
    
    <div class="archive-header">
        <div class="container">
            <h1 class="archive-title">
                <?php
                if (is_category()) :
                    single_cat_title();
                elseif (is_tag()) :
                    single_tag_title();
                elseif (is_author()) :
                    the_author();
                elseif (is_day()) :
                    echo get_the_date();
                elseif (is_month()) :
                    echo get_the_date('F Y');
                elseif (is_year()) :
                    echo get_the_date('Y');
                elseif (is_tax()) :
                    single_term_title();
                else :
                    _e('Archives', 'auralith-labs');
                endif;
                ?>
            </h1>
            
            <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
        </div>
    </div>
    
    <section class="content-section">
        <div class="container">
            <?php if (have_posts()) : ?>
                
                <div class="blog-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        
                        <article class="blog-card fade-in">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('auralith-blog-thumb', array('class' => 'blog-image')); ?>
                                </a>
                            <?php endif; ?>
                            
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <?php echo get_the_date('F j, Y'); ?>
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
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php the_excerpt(); ?>
                                <a href="<?php the_permalink(); ?>" class="read-more">Continue Reading →</a>
                            </div>
                        </article>
                        
                    <?php endwhile; ?>
                </div>
                
                <div class="pagination">
                    <?php
                    echo paginate_links(array(
                        'prev_text' => '←',
                        'next_text' => '→',
                    ));
                    ?>
                </div>
                
            <?php else : ?>
                
                <div class="no-results">
                    <h2><?php _e('Nothing Found', 'auralith-labs'); ?></h2>
                    <p><?php _e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'auralith-labs'); ?></p>
                    <?php get_search_form(); ?>
                </div>
                
            <?php endif; ?>
        </div>
    </section>
    
</main>

<?php get_footer(); ?>