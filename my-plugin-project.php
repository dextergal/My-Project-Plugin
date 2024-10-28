<?php
/*
 * Plugin Name:       Remove Toolbar Frontend
 * Description:       Handle the basics with this plugin.
 * Author:            Dexter Gal
 */

 /* Disable WordPress Admin Bar for all users */
add_filter( 'show_admin_bar', '__return_false' );