<?php
function abh_load_admin_post_styles($hook) {
 
 	// Test to see if user is on the post, or post-new page, if they are not, Abort!
	if( $hook != 'post-new.php' && $hook != 'post.php' ):
		return;
 	endif;

 	// If user is on the post or post-new page, load these JavaScript files!
	wp_enqueue_style( 'admin-post-styles', plugins_url( 'stylesheets/abh-admin-stylesheet.css' , dirname(__FILE__) ) );

}
add_action('admin_enqueue_scripts', 'abh_load_admin_post_styles');

function abh_load_front_end_post_styles($hook) {

 	// If user is on the post or post-new page, load these JavaScript files!
	wp_enqueue_style( 'admin-post-styles', plugins_url( 'stylesheets/abh-front-end-stylesheet.css' , dirname(__FILE__) ) );

}
add_action('wp_enqueue_scripts', 'abh_load_front_end_post_styles');