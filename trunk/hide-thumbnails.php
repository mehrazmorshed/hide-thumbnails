<?php

/*
 * Plugin Name:       Hide Thumbnails
 * Plugin URI:        https://wordpress.org/plugins/hide-thumbnails/
 * Description:       Hide Thumbnails from all posts
 * Version:           1.1
 * Tested Up to:      6.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Mehraz Morshed
 * Author URI:        https://profiles.wordpress.org/mehrazmorshed/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       hide-thumbnails
 * Domain Path:       /languages
 */

/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

if( ! defined( 'ABSPATH' ) ) {
    exit;
}

function hide_thumbnails_load_textdomain() {
    load_plugin_textdomain( 'hide-thumbnails', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
add_action( 'init', 'hide_thumbnails_load_textdomain' );

function hide_thumbnails() {
    return false;
}
add_filter( 'post_thumbnail_id', 'hide_thumbnails' );

function hide_thumbnails_activation_hook() {
    set_transient( 'hide-thumbnails-notification', true, 5 );
}
register_activation_hook( __FILE__, 'hide_thumbnails_activation_hook' );
 
function hide_thumbnails_activation_notification(){
    if( get_transient( 'hide-thumbnails-notification' ) ) {
        ?>
        <div class="updated notice is-dismissible">
            <p><?php esc_attr_e( 'Thank you for installing Hide Thumbnails!', 'hide-thumbnails' ); ?></p>
        </div>
        <?php
        delete_transient( 'hide-thumbnails-notification' );
    }
}
add_action( 'admin_notices', 'hide_thumbnails_activation_notification' );