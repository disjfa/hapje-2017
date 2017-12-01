<?php
function hapje_2017_customize_register($wp_customize)
{
    /** @var WP_Customize_Manager $wp_customize */
    if (!isset($wp_customize)) {
        return;
    }

    /**
     * Add 'Thema options' Section.
     */
    $wp_customize->add_section(
    // $id
        'hapje_2017_section',
        // $args
        array(
            'title' => __('Thema options', 'hapje-2017'),
            'description' => __('Settings for the hapje theme', 'hapje-2017'),
        )
    );

    /**
     * Add 'Link facebook' Setting.
     */
    $wp_customize->add_setting('link_facebook', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh',
    ));

    /**
     * Add 'Link twitter' Setting.
     */
    $wp_customize->add_setting('link_twitter', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh',
    ));

    /**
     * Add 'Link facebook' Control.
     */
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'link_facebook', array(
        'label' => __('Link facebook', 'hapje-2017'),
        'section' => 'hapje_2017_section',
        'settings' => 'link_facebook',
    )));

    /**
     * Add 'Link twitter' Control.
     */
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'link_twitter', array(
        'label' => __('Link twitter', 'hapje-2017'),
        'section' => 'hapje_2017_section',
        'settings' => 'link_twitter',
    )));
}

add_action('customize_register', 'hapje_2017_customize_register');
