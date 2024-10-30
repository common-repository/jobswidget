<?php
/*
function jobs_widget_admin_head() {
    //empty function (earlier styles were added, if in the admin area, now there is no
    if (!isset($_GET['page']))
        return;
    //if (strpos($_GET['page'], 'jobs-widget/') === 0) {
    //    echo '<link type="text/css" rel="stylesheet" href="' . plugins_url('admin.css', __FILE__) . '">';
    //}
}
add_action('admin_print_styles', 'jobs_widget_admin_head');
*/

if ( ! defined( 'ABSPATH' ) ) { 
    exit; 
}  

function jobs_widget_admin_menu() {
    // add options.php if in admin panel
    add_options_page('Jobs Widget', 'Jobs Widget', 'manage_options', 'jobs-widget/options.php');
}
add_action('admin_menu', 'jobs_widget_admin_menu');
