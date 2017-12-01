<?php
// Register and load the widget
function hapje_load_list_widget()
{
    register_widget('hapje_widget_list');
}

add_action('widgets_init', 'hapje_load_list_widget');

// Creating the widget
class hapje_widget_list extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'hapje_widget_list',
            __('Laatste posts', 'hapje-2017'),
            array('description' => __('Laatste posts', 'hapje-2017'),)
        );
    }

    public function widget($args, $instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = false;
        }
        echo $args['before_widget'];
        if ($title) {
            ?><h3 class="widget-title"><?php echo $title; ?></h3><?php
        }
        wp_reset_query();
        $post_query = new WP_Query([
            'posts_per_page' => 5,
        ]);

        if ($post_query->have_posts()) {
            while ($post_query->have_posts()) {
                $post_query->the_post();
                $thumbnail = get_the_post_thumbnail_url();
                if (!$thumbnail) {
                    $thumbnail = get_stylesheet_directory_uri() . '/img/sprite.jpg';
                }
                ?>

                <div class="py-1 row">
                    <div class="col-sm-3 col-12">
                        <a href="<?php echo get_the_permalink(); ?>" class="hapje-row-img"
                           style="background-image: url(<?php echo $thumbnail; ?>)">
                        </a>
                    </div>
                    <div class="col-sm-9 col-12">
                        <h4 class="entry-title">
                            <a href="<?php echo get_the_permalink(); ?>">
                                <?php echo the_title(); ?>
                            </a>
                        </h4>
                        <?php the_taxonomies(); ?>
                    </div>
                </div>

                <?php
            }
        }
        echo '<br>';
        wp_reset_query();
        wp_reset_postdata();
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Titel', 'hapje-2017');
        }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
} // Class restaurant_widget ends here