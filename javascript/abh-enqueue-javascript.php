<?php
function abh_load_post_scripts($hook) {
 
 	// Test to see if user is on the post, or post-new page, if they are not, Abort!
	if( $hook != 'post-new.php' && $hook != 'post.php' ) { return; }

 	// If user is on the post or post-new page, load these JavaScript files!
 	wp_enqueue_script('jquery');
	wp_enqueue_script( 'abh-custom-js', plugins_url( 'javascript/abh-post-javascript.js' , dirname(__FILE__) ) );
}
add_action('admin_enqueue_scripts', 'abh_load_post_scripts');