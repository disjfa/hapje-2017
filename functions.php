<?php

// Set the content width based on the theme's design and stylesheet.
if (!isset($content_width)) {
    $content_width = 1140; /* pixels */
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */

require get_stylesheet_directory() . '/inc/widgets.php';
require get_stylesheet_directory() . '/inc/widget-list.php';
require get_stylesheet_directory() . '/inc/hapje-2017-customizer.php';

add_filter('embed_oembed_html', function ($html, $url, $attr, $post_ID) {
    if (false !== stripos($html, '<iframe ') && false !== stripos($html, '.youtube.com/embed')) {
        $html = sprintf('<div class="embed-responsive embed-responsive-16by9">%s</div>', $html);
    }

    return $html;
}, 10, 4);


function understrap_remove_scripts()
{
    wp_dequeue_style('understrap-styles');
    wp_deregister_style('understrap-styles');

    wp_dequeue_script('understrap-scripts');
    wp_deregister_script('understrap-scripts');

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}

add_action('wp_enqueue_scripts', 'understrap_remove_scripts', 20);

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    // Get the theme data
    $the_theme = wp_get_theme();

    wp_enqueue_style('child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get('Version'));
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
    wp_enqueue_script('popper-scripts', get_template_directory_uri() . '/js/popper.min.js', array(), false);
    wp_enqueue_script('child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.js', array(), $the_theme->get('Version'), true);
}

if (!function_exists('understrap_all_excerpts_get_more_link')) {
    /**
     * Adds a custom read more link to all excerpts, manually or automatically generated
     *
     * @param string $post_excerpt Posts's excerpt.
     *
     * @return string
     */
    function understrap_all_excerpts_get_more_link($post_excerpt)
    {
        return $post_excerpt . '...<p><a class="btn btn-outline-primary understrap-read-more-link" href="' . get_permalink(get_the_ID()) . '">' . __('Read More...', 'understrap') . '</a></p>';
    }
}

if (!function_exists('understrap_setup')) :
    function hapje_2017_setup()
    {
        set_post_thumbnail_size(1200, 675, true);
        add_image_size('large', 1200, 675, true);
    }
endif;

add_action('after_setup_theme', 'hapje_2017_setup');

function hapje_2017_content_filter($content)
{
    if (get_post_type() != 'post') {
        return $content;
    };

    // Add a message when a post is older than a year, just to be sure.
    $offset = 365 * 60 * 60 * 24;
    if (get_post_time() < date('U') - $offset) {
        $content = '<div class="alert alert-warning">' . __('Let op, dit bericht is al meer dan een jaar oud, het kan nu aangepast zijn.', 'understrap') . '</div>' . $content;
    }

    return $content;
}

add_filter('the_content', 'hapje_2017_content_filter');