<?php
/**
 * The template for displaying the footer
 *
 * @package AuraLith_Labs
 */
?>

    <footer id="colophon" class="site-footer">
        <div class="footer-content">
            <div class="footer-column">
                <h4>AuraLith Labs</h4>
                <p><?php echo get_theme_mod('auralith_tagline', 'Beauty in structure. Power in becoming.'); ?></p>
                <div class="social-links">
                    <?php
                    $social_networks = array('instagram', 'pinterest', 'linkedin', 'youtube');
                    foreach ($social_networks as $network) :
                        $url = get_theme_mod('auralith_' . $network . '_url');
                        if ($url) : ?>
                            <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer">
                                <?php echo ucfirst($network); ?>
                            </a>
                        <?php endif;
                    endforeach;
                    ?>
                </div>
            </div>
            
            <div class="footer-column">
                <h4>Explore</h4>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_id'        => 'footer-menu',
                    'depth'          => 1,
                    'fallback_cb'    => false,
                ));
                ?>
            </div>
            
            <div class="footer-column">
                <h4>Recent Rituals</h4>
                <ul>
                    <?php
                    $recent_rituals = new WP_Query(array(
                        'post_type'      => 'ritual',
                        'posts_per_page' => 3,
                    ));
                    
                    if ($recent_rituals->have_posts()) :
                        while ($recent_rituals->have_posts()) : $recent_rituals->the_post(); ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </ul>
            </div>
            
            <div class="footer-column">
                <h4>Stay Connected</h4>
                <p>Join our community of women cultivating lives of intention and beauty.</p>
                <form class="footer-newsletter" action="#" method="post">
                    <input type="email" name="email" placeholder="Your email" required>
                    <button type="submit">→</button>
                </form>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. For women building a life of depth, beauty, and direction.</p>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>