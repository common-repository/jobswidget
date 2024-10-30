<?php

/*
  Plugin Name: Jobs Widget
  Plugin URI: http://app.jobswidget.me
  Description: Include Jobs Widget on page content.
  Version: 1.0
  Author: JobsWidget
  Author URI: http://app.jobswidget.me
 */


if ( ! defined( 'ABSPATH' ) ) { 
    exit; 
}  

// if from admin, then connect admin.php file
if (is_admin()) {
    include dirname(__FILE__) . '/admin.php';
} else {
    // otherwise, we write a function
    function jobs_widget_call($attrs, $content = null) { 
	$id_value = '';
	$result_value = '';
        // we get the id of the company to select specific vacancies
	foreach ($attrs as $key => $value) {
	    if ($key == 'id') {
	        $temp_value = sanitize_key($value);
		    if (strlen($temp_value) == 36) {
		        $result_value = $temp_value;
		    }
                   // $value = strip_tags($value);
            }
	}
        // write id to variable
	$id_value = $result_value;
        if ($id_value != '') {
            //insert a div with a specific id in order to place a widget with company vacancies in this place
	    $buffer = "<div id='hr_services'></div>";
            // register the js file to add its contents later
	    wp_enqueue_script( 'jobs_widget', dirname(__FILE__) . '/includes/js/jobs-widget/index.js', array(), null, false);
            // js file contents
            $inc_text_js = "(function () {
                                window.HRS_ID = '" . $id_value . "';
                                let hrs = document.createElement('script');
                                hrs.type = 'text/javascript';
                                hrs.async = true;
                                hrs.src = 'https://app.jobswidget.me/static/js/embed.js';
                                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hrs);
                        })();";
            // add content to our js file
	    wp_add_inline_script("jobs_widget", $inc_text_js);
	}
	else {
	    // if ID is not validated, return an error message
	    $buffer = '<div style="color: #880000; border: 3px solid red; text-align: center;">*******Invalid ID*******</div>';
	}
	// return the $ buffer variable
        return $buffer;
    }

    // Add the ability to insert a widget on the Jobs_Widjet shortcode. 
    // if in the content there is a construction [Jobs_Widget '...'], then instead of this construction a widget with vacancies is inserted
    add_shortcode('Jobs_Widget', 'jobs_widget_call');
}
