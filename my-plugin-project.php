<?php
/*
 * Plugin Name:       Remove Toolbar Frontend
 * Description:       This plugin removes the toolbar from the frontend.
 * Author:            Dexter Gal
 */

 /* Disable WordPress Admin Bar for all users */
add_filter( 'show_admin_bar', '__return_false' );