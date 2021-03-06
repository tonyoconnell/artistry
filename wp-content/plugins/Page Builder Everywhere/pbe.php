<?php

/*
Plugin Name: Page Builder Everywhere
Plugin URI: https://divi.space/product/page-builder-everywhere-header-footer-sidebar-editor/
Description: Use the Divi Page Builder to create custom headers, footers and sidebars.
Version: 2.0
Author: Stephen James
Author URI: https://divi.space
License: GPL v3 or later
*/

if ( ! defined( 'ABSPATH' ) ) exit;

include dirname( __FILE__ ) . '/widget-mods/widget-conditions.php';

include dirname( __FILE__ ) . '/parts/layout-widget.php';

include dirname( __FILE__ ) . '/parts/new-widget-areas.php';

include dirname( __FILE__ ) . '/parts/push-widgets.php';

include dirname( __FILE__ ) . '/parts/pbe-customizer.php';

/*

-------------------- INSTALLATION ---------------------

1. Install Plugin as normal
2. Head to the widgets page where you'll find new areas for the header and footer.
3. Add the custom 'Divi Layout' widget to any of the new areas and assign a layout to it.
4. Click on the 'where?' button to add conditional logic to your layout such as only applying
above header areas on the home page or on certain categories.
5. For more info, visit https://divi.space/knowledge-base/page-builder-everywhere/

-------------------- LICENSE --------------------

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

For more information, see http://www.gnu.org/licenses/

-------------------- ACKNOWLEDGEMENTS --------------------

Certain aspects of Page Builder Everywhere are built using code found in the following freely available resources:

1. Pippin's simple widget template - https://pippinsplugins.com/simple-wordpress-widget-template/
2. WYSIWYG Widget Blocks - https://wordpress.org/plugins/wysiwyg-widgets/
3. https://wordpress.org/plugins/widget-visibility-without-jetpack/

*/
function pbe_customizer_shortcut_admin_bar() {
    
    if ( ! current_user_can( 'customize' ) ) {
        return;
    }
    
    global $wp_admin_bar;
    
    $current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
    $customize_url = admin_url( 'customize.php?autofocus[panel]=pbe_customizer_options' ); // Direct to Customizer Panel

    $wp_admin_bar->add_menu( array(
            'parent' => 'appearance',
            'id'     => 'launch_pbe',
            'title'  => esc_html__( 'PBE Customizer' ),
            'href'   => $customize_url,
        ) );
    
}

add_action( 'admin_bar_menu', 'pbe_customizer_shortcut_admin_bar', 998 );

// ------------------------------------------------------------- //

function pbe_css_edits() {

$fix_logo = get_option( 'fix_logo_size' );
$hide_main_header = get_option( 'hide_main_header' );
$hide_above_header_scroll = get_option( 'hide_above_header' );
$hide_bottom_footer = get_option( 'hide_bottom_footer' );

if ( $fix_logo == true ) {
    ?>
    <style type="text/css">
    #logo {
        vertical-align: bottom;
        max-height: 52px;
        margin-bottom: 14px;
    }  
    </style>
    <?php
}

if ( $hide_above_header_scroll == true ) {
    ?>
    <style type="text/css">
    #main-header.et-fixed-header #pbe-above-header-wa-wrap {
        display: none;
    }
    </style>
    <?php
}

if ( $hide_bottom_footer == true ) {
    ?>
    <style type="text/css">
    #footer-bottom {
        display: none;
    }
    #pbe-footer-wa-wrap {
        top: 0 !important;
    }
    </style>
    <?php
}

if ( $hide_main_header == true ) {
    ?>
    <style type="text/css">
    #main-header .container {
        display: none;
    }
    </style>
    <?php
}
?>

<style type="text/css">

/** PBE CSS **/

#pbe-above-content-wa-wrap .et_pb_widget {
    display: block;
    width: 100%;
    position: relative;
    margin-top: -15px;
    margin-bottom: 50px;
}

#pbe-above-content-wa-wrap .et_pb_section {
    z-index: 99;
}

#pbe-below-content-wa-wrap .et_pb_widget {
    display: block;
    width: 100%;
    position: relative;
    margin-top: -15px;
}

#pbe-below-content-wa-wrap .et_pb_section {
    z-index: 99;
}

#main-header .et_pb_widget {
    width: 100%;
}

#main-header .et_pb_widget p {
    padding-bottom: 0;
}

#pbe-above-header-wa .widget-conditional-inner {
    background: #fff;
    padding: 0;
    border: none;
}

#pbe-above-header-wa select {
    background: #f1f1f1;
    box-shadow: none;
    border-radius: 3px;
    height: 40px;
    padding-left: 10px;
    padding-right: 10px;
    border: none;
}

#pbe-footer-wa-wrap .et_pb_widget {
    width: 100%;
    display: block;
}

.page-container form input[type=text] {
    display: block;
    margin-bottom: 20px;
    width: 100%;
    background: #f1f1f1;
    padding: 10px 20px;
    box-shadow: none;
    border: none;
    font-weight: 700;
}

.page-container form p {
    font-size: 14px;
}

.page-container form {
    padding: 10px 20px;
}

#pbe-footer-wa-wrap {
    position: relative;
    top: -15px;
}

</style>
    <?php
}
add_action( 'wp_head', 'pbe_css_edits');
?>