<?php
/**
 * @package   Absolute Happiness
 * @author    Eric Frisino <eric.frisino@gmail.com>
 * @license   GPL-2.0+
 * @link      http://ericfrisino.com
 * @copyright 2015 Eric Frisino
 */


function abh_email_kindness_recipient( $ID, $post ) {
  if( $GLOBALS['_POST']['original_post_status'] != 'publish' ) {
	  // Get kindness email toggle post meta.
	  $abh_kindness_email_toggle = $GLOBALS['_POST']['abh-kindness-email-toggle'];
	  // If it is set to true, continue to email the recipient.
	  if ( $abh_kindness_email_toggle == 1 ) {
		  // Get recipients email name & address.
		  $abh_kindness_email_name    = isset( $GLOBALS['_POST']['abh-kindness-email-name'] ) ? wp_kses( $GLOBALS['_POST']['abh-kindness-email-name'], '', '' ) : null;
		  $abh_kindness_email_address = isset( $GLOBALS['_POST']['abh-kindness-email-address'] ) ? sanitize_email( $GLOBALS['_POST']['abh-kindness-email-address'], '', '' ) : null;

		  // Get email subject and content.
		  $abh_kindness_email_subject = isset( $GLOBALS['_POST']['abh-kindness-email-subject'] ) ? wp_kses( $GLOBALS['_POST']['abh-kindness-email-subject'], '', '' ) : null;
		  $abh_kindness_email_content = isset( $GLOBALS['_POST']['abh-kindness-email-content'] ) ? wp_kses( $GLOBALS['_POST']['abh-kindness-email-content'], '', '' ) : null;

		  // Get post author information.
		  $author       = $post->post_author; /* Returns Author's ID. */
		  $author_name  = get_the_author_meta( 'display_name', $author );
		  $author_email = get_the_author_meta( 'user_email', $author );

		  // Test to see if there is a subject set.
		  if ( empty( $abh_kindness_email_subject ) ) {
			  // If no subject is set, set a generic subject and allow user to change it with a shortcode.
			  $subject = apply_filters( 'abh_email_subject', 'Hello! from ' . $author_name );
		  } else {
			  $subject = $abh_kindness_email_subject;
		  }

		  // Set the message content.
		  $message = $abh_kindness_email_content;


		  // Set recipients name and email to he $to variable.
		  $to[] = sprintf( '%s <%s>', $abh_kindness_email_name, $abh_kindness_email_address );

		  // Set email headers.
		  $headers[] = sprintf( 'From: %s <%s>', $author_name, $author_email );
		  $headers[] = sprintf( 'Reply-to: %s <%s>', $author_name, $author_email );

		  // Send the email :)
		  wp_mail( $to, $subject, $message, $headers );
	  }
  }
}
add_action( 'publish_post', 'abh_email_kindness_recipient', 10, 2 );