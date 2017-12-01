<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
$container = get_theme_mod('understrap_container_type');
?>

<div class="bg-dark text-white">
    <?php get_sidebar('footerfull'); ?>
    <div class="wrapper py-3" id="wrapper-footer">
        <div class="<?php echo esc_attr($container); ?>">
            <div class="row">
                <div class="col-md-12">
                    <footer class="site-footer" id="colophon">
                        <div id="site-info">
                            &copy; <?php echo strftime("%Y"); ?>
                            <a href="<?php echo esc_url(__('http://dimme.nl/', 'hapje-2017')); ?>" class="text-white" title="<?php esc_attr_e('dimme.nl', 'hapje-2017'); ?>" rel="generator"><?php printf(__('Verzorgd door %s.', 'hapje-2017'), 'dimme.nl'); ?></a>
                            -
                            <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home" class="text-white">
                                <?php bloginfo('name'); ?>
                            </a>
                        </div><!-- #site-generator -->
                    </footer><!-- #colophon -->
                </div><!--col end -->
            </div><!-- row end -->
        </div><!-- container end -->
    </div><!-- wrapper end -->
</div>
</div><!-- #wrapper we need this extra closing tag here -->
</div><!-- #page we need this extra closing tag here -->
<?php wp_footer(); ?>
</body>
</html>

