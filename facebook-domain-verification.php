<?php

/*
Plugin Name:  Facebook Domain Verification
Plugin URI:   https://genero.fi
Description:  Facebook Domain Verification field
Version:      1.0.0
Author:       Genero
Author URI:   https://genero.fi/
License:      MIT License
*/

namespace Genero\MuPlugins;

if (!is_blog_installed()) {
    return;
}


add_action('admin_init', function () {
    register_setting('general', 'facebook-domain-verification', 'esc_attr');
    add_settings_field(
        'facebook-domain-verification',
        __('Facebook Domain Verification'),
        function () {
            echo sprintf(
                '<input type="text" id="%s" name="%s" placeholder="%s" class="regular-text code" value="%s" />',
                'facebook-domain-verification',
                'facebook-domain-verification',
                str_repeat('-', 31),
                get_option('facebook-domain-verification')
            );
        },
        'general'
    );
});

add_action('wp_head', function () {
    if ($id = get_option('facebook-domain-verification')) {
        echo sprintf(
            '<meta name="facebook-domain-verification" content="%s" />',
            $id
        );
    }
}, 1);
