<?php
/*
 * Plugin Name: Dex Plugin
 * Plugin Name:       My Basics Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 */

 /* Disable WordPress Admin Bar for all users */
add_filter( 'show_admin_bar', '__return_false' );