<?php
/**
 * @package 	Absolute Happiness
 * @author 		Eric Frisino <eric.frisino@gmail.com>
 * @copyright 2014 Eric Frisino
 * @license 	PL-2.0+
 * @version 	1.0
 * @uses  		Add custom meta data to the 'post' Post Type
 */

// Fire our meta box setup function on the post editor screen.
add_action( 'load-post.php', 'abh_custom_meta_setup' );
add_action( 'load-post-new.php', 'abh_custom_meta_setup' );

// Meta box setup function.
function abh_custom_meta_setup() {
	// Add meta boxes on the 'add_meta_boxes' hook.
	add_action( 'add_meta_boxes', 'abh_add_metabox' );

	// Save post meta on the 'save_post' hook.
	add_action( 'save_post', 'abh_save_meta', 1, 2 );
}

// Create one or more meta boxes to be displayed on the post editor screen.
function abh_add_metabox() {

	/**
	 * Custom Meta Information: 3 Daily Gratitudes
	 * meta:		abh-gratitude-one
	 * type:		Text Input
	 * use:			Lets user input their first daily gratitude.
	 * values:	Holds users first daily gratitude.
	 *
	 * meta:		abh-gratitude-two
	 * type:		Text Input
	 * use:			Lets user input their second daily gratitude.
	 * values:	Holds users second daily gratitude.
	 *
	 * meta:		abh-gratitude-three
	 * type:		Text Input
	 * use:			Lets user input their third daily gratitude.
	 * values:	Holds users third daily gratitude.
	 */
	add_meta_box( 
		'abh-gratitudes',																												// Unique ID
		__( '<span style="color:#333;">Three Gratitudes</span>', 'abh_trans' ),	// Title
		'abh_gratitudes',																												// Callback function
		'post',																																	// Post Type for this to appear on
		'normal',																																// Context
		'core'																																	// Priority
	);

	/**
	 * Custom Meta Information: 3 Daily Gratitudes
	 * meta:		abh-journal
	 * type:		WYSIWYG
	 * use:			Lets user input their first daily gratitude.
	 * values:	Holds users first daily gratitude.
	 */
	add_meta_box( 
		'abh-journal',																																		// Unique ID
		__( '<span style="color:#333;">One Positive Experience</span>', 'abh_trans' ),		// Title
		'abh_journal',																																		// Callback function
		'post',																																						// Post Type for this to appear on
		'normal',																																					// Context
		'core'																																						// Priority
	);

	/**
	 * Custom Meta Information: Exercise
	 * meta:		abh-exercise-toggle
	 * type:		Checkbox
	 * use:			Lets user check off if they exercised today.
	 * values:	BOOL: 1 True - 0 False.
	 *
	 * meta:		abh-exercise-info
	 * type:		Textarea
	 * use:			Lets user input any positive information about their workout.
	 * values:	Holds users thoughts on their workout.
	 */
	add_meta_box( 
		'abh-exercise',																											// Unique ID
		__( '<span style="color:#333;">Exercise</span>', 'abh_trans' ),			// Title
		'abh_exercise',																											// Callback function
		'post',																															// Post Type for this to appear on
		'normal',																														// Context
		'core'																															// Priority
	);

	/**
	 * Custom Meta Information: Meditation
	 * meta:		abh-meditation-toggle
	 * type:		Checkbox
	 * use:			Lets user check off if they meditated today.
	 * values:	BOOL: 1 True - 0 False.
	 *
	 * meta:		abh-meditation-info
	 * type:		Textarea
	 * use:			Lets user input any positive information about their mediation.
	 * values:	Holds users thoughts on their mediation.
	 */
	add_meta_box( 
		'abh-meditation',																										// Unique ID
		__( '<span style="color:#333;">Meditation</span>', 'abh_trans' ),		// Title
		'abh_meditation',																										// Callback function
		'post',																															// Post Type for this to appear on
		'normal',																														// Context
		'core'																															// Priority
	);

	/**
	 * Custom Meta Information: Random Act of Kindness
	 * meta:		abh-meditation-toggle
	 * type:		Checkbox
	 * use:			Lets user check off if they meditated today.
	 * values:	BOOL: 1 True - 0 False.
	 *
	 * meta:		abh-meditation-info
	 * type:		Textarea
	 * use:			Lets user input any positive information about their mediation.
	 * values:	Holds users thoughts on their mediation.
	 */
	add_meta_box( 
		'abh-kindness',																																	    // Unique ID
		__( '<span style="color:#333;">Conscious Act of Kindness</span>', 'abh_trans' ),		// Title
		'abh_kindness',																																	    // Callback function
		'post',																																					    // Post Type for this to appear on
		'normal',																																				    // Context
		'core'																																					    // Priority
	);
}



/* Display the post meta box. */
function abh_gratitudes( $object, $box ) {
	global $post;
	wp_nonce_field( basename( __FILE__ ), 'abh_gratitudes_nonce' ); ?>

	<table width="100%">
		<tr>
			<td colspan="2"><p>Write three quick sentences about three things that you are great-full for today.</p></td>
		</tr>
		<tr>
			<th style="text-align: left; width:30px;"><label for="abh-gratitude-one">1: </label></th>
			<td><input type="text" id="abh-gratitude-one" name="abh-gratitude-one" style="width:100%;" value="<?php echo esc_attr( get_post_meta( $object->ID, 'abh-gratitude-one', true ) ); ?>" /></td>
		</tr>
		<tr>
			<th style="text-align: left; width:30px;"><label for="abh-gratitude-two">2: </label></th>
			<td><input type="text" id="abh-gratitude-two" name="abh-gratitude-two" style="width:100%;" value="<?php echo esc_attr( get_post_meta( $object->ID, 'abh-gratitude-two', true ) ); ?>" /></td>
		</tr>
		<tr>
			<th style="text-align: left; width:30px;"><label for="abh-gratitude-three">3: </label></th>
			<td><input type="text" id="abh-gratitude-three" name="abh-gratitude-three" style="width:100%;" value="<?php echo esc_attr( get_post_meta( $object->ID, 'abh-gratitude-three', true ) ); ?>" /></td>
		</tr>
	</table>
<?php }


function abh_journal( $object, $box ) {
	global $post;
	wp_nonce_field( basename( __FILE__ ), 'abh_journal_nonce' ); 
	//$journal = get_post_meta( $post->ID );

	$content = get_post_meta( $post->ID, 'abh_journal', true );
	$editor_id = 'abh_journal';
	$settings = array (
		'textarea_rows' => 10,
	);

	wp_editor( $content, $editor_id, $settings );?>
<?php }


function abh_exercise( $object, $box ) {
	global $post;
	wp_nonce_field( basename( __FILE__ ), 'abh_exercise_nonce' ); ?>

	<table width="100%">
		<tr>
			<td>
				<?php $abh_exercise_toggle = get_post_meta( $post->ID, 'abh-exercise-toggle', true ); ?>
				<label for="abh-exercise-toggle"><input type="checkbox" value="1" name="abh-exercise-toggle" id="abh-exercise-toggle" <?php checked( $abh_exercise_toggle ); ?> /> I exercised today!</label>
			</td>
		</tr>
		<tr>
			<td>
				<br />
				Write any notes about how great your workout was, or any goals or accomplishments you you achieved, or how you felt after.
			</td>
		</tr>
		<tr>
			<td>
				<textarea class="widefat" type="text" name="abh-exercise-info" id="abh-exercise-info" rows="7"><?php echo esc_attr( get_post_meta( $object->ID, 'abh-exercise-info', true ) ); ?></textarea>
			</td>
		</tr>
	</table>
<?php }


function abh_meditation( $object, $box ) {
	global $post;
	wp_nonce_field( basename( __FILE__ ), 'abh_meditation_nonce' ); ?>

	<table width="100%">
		<tr>
			<td>
				<?php $abh_meditation_toggle = get_post_meta( $post->ID, 'abh-meditation-toggle', true ); ?>
				<label for="abh-meditation-toggle"><input type="checkbox" value="1" name="abh-meditation-toggle" id="abh-meditation-toggle" <?php checked( $abh_meditation_toggle ); ?> /> I meditated today!</label>
			</td>
		</tr>
		<tr>
			<td>
				<br />
				Write any notes about how great your meditation was, or any goals or accomplishments you you achieved, or how you felt after.
			</td>
		</tr>
		<tr>
			<td>
				<textarea class="widefat" type="text" name="abh-meditation-info" id="abh-meditation-info" rows="7"><?php echo esc_attr( get_post_meta( $object->ID, 'abh-meditation-info', true ) ); ?></textarea>
			</td>
		</tr>
	</table>
<?php }


function abh_kindness( $object, $box ) {
	global $post;
	wp_nonce_field( basename( __FILE__ ), 'abh_kindness_nonce' ); ?>

	<p>
		Everyday you should commit a conscious act of kindness and make someone else's day better. There are two ways to do this, choose from the following or if you are feeling espically generous today, do both!
	</p>

	<table width="100%">
		<tr>
			<td valign="top" width="25">
				<?php $abh_kindness_email_toggle = get_post_meta( $post->ID, 'abh-kindness-email-toggle', true ); ?>
				<input type="checkbox" value="1" name="abh-kindness-email-toggle" id="abh-kindness-email-toggle" <?php checked( $abh_kindness_email_toggle ); ?> onclick="showEmailInfo()" />
			</td>
			<td><label for="abh-kindness-email-toggle">Write an email, praising or thanking someone in your social support network.</label></td>
		</tr>

		<tr id="abh-write-email-off">
			<td></td>
			<td>
				<hr class="abh-kindness-divider" />
			</td>
		</tr>

		<tr id="abh-write-email-on">
			<td></td>
			<td>
				<hr class="abh-kindness-divider" />
				<p>This email will be sent to the email address entered upon clicking the 'Publish' button. <em>For more information visit the help page</em></p>
				<table width="100%" class="abh-write-email">
					<tr>
						<td>
							<label for="abh-kindness-email-name">Recipient's Name:</label><br/>
							<input type="text" id="abh-kindness-email-name" name="abh-kindness-email-name" style="width:100%;" value="<?php echo esc_attr( get_post_meta( $object->ID, 'abh-kindness-email-name', true ) ); ?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="abh-kindness-email-address">Recipient's Email Address:</label><br/>
							<input type="text" id="abh-kindness-email-address" name="abh-kindness-email-address" style="width:100%;" value="<?php echo esc_attr( get_post_meta( $object->ID, 'abh-kindness-email-address', true ) ); ?>" />
						</td>
					</tr>
          <tr>
            <td>
              <label for="abh-kindness-email-subject">Email Subject:</label><br/>
              <input type="text" id="abh-kindness-email-subject" name="abh-kindness-email-subject" style="width:100%;" value="<?php echo esc_attr( get_post_meta( $object->ID, 'abh-kindness-email-subject', true ) ); ?>" />
            </td>
          </tr>
					<tr>
						<td>
							<label for="abh-kindness-email-content">Email Content:</label><br />
							<textarea class="widefat" type="text" name="abh-kindness-email-content" id="abh-kindness-email-content" rows="7"><?php echo esc_attr( get_post_meta( $object->ID, 'abh-kindness-email-content', true ) ); ?></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<?php $abh_kindness_email_show_everyone_toggle = get_post_meta( $post->ID, 'abh-kindness-email-show-everyone-toggle', true ); ?>
							<input type="checkbox" value="1" name="abh-kindness-email-show-everyone-toggle" id="abh-kindness-email-show-everyone-toggle" <?php checked( $abh_kindness_email_show_everyone_toggle ); ?> />
							<label for="abh-kindness-email-show-everyone-toggle">Would you like to show this email to viewers of your blog?</label>
						</td>
					</tr>
					<tr>
						<td><hr class="abh-kindness-divider" /></td>
					</tr>

				</table>
			</td>
		</tr>

		<tr>
			<td valign="top">
				<?php $abh_kindness_physical_toggle = get_post_meta( $post->ID, 'abh-kindness-physical-toggle', true ); ?>
				<input type="checkbox" value="1" name="abh-kindness-physical-toggle" id="abh-kindness-physical-toggle" <?php checked( $abh_kindness_physical_toggle ); ?> onclick="showPhysicalActInfo()" />
			</td>
			<td>
				<label for="abh-kindness-physical-toggle">Commit a conscious act of kindness in real life.<br /><em>Help someone out in an unexpected way, buy someone a coffee, or anything to make their day better.</em></label>
			</td>		
		</tr>

		<tr id="abh-commit-act-off">
			<td></td>
			<td>
				<table width="100%" class="abh-commit-act">
					<tr>
						<td>
							<hr class="abh-kindness-divider" />
						</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr id="abh-commit-act-on">
			<td></td>
			<td>
				<table width="100%" class="abh-commit-act">
					<tr>
						<td>
							<hr class="abh-kindness-divider" />
							<p><label for="abh-kindness-physical-act">Reflect on todays conscious act of kindness, what you did, for who, and how it made you and the recipient of your consciously positive act feel.</label></p>
							<textarea class="widefat" type="text" name="abh-kindness-physical-act" id="abh-kindness-physical-act" rows="7"><?php echo esc_attr( get_post_meta( $object->ID, 'abh-kindness-physical-act', true ) ); ?></textarea>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
<?php }




function abh_save_meta( $post_id, $post ) {

	/*----------------------------------------------------------------------------*
	 * Save all Content from the three gratuities metabox
	 *----------------------------------------------------------------------------*/
	// validate the request itself using the nonce we set up
	if( ! isset( $_POST['abh_gratitudes_nonce'] ) || ! wp_verify_nonce( $_POST['abh_gratitudes_nonce'], basename( __FILE__ ) ) ) {
		return $post->ID; }

	// bail out if running an autosave, ajax, cron, or revision
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post->ID; }
	if( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return $post->ID; }
	if( defined( 'DOING_CRON' ) && DOING_CRON ) {
		return $post->ID; }
	if( wp_is_post_revision( $post_id ) ) {
		return $post->ID; }

	// make sure the user is authorized
	if( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID; }

	// this request is validated, proceed to save
	if( isset( $_POST[ 'abh-gratitude-one' ] ) ) {
		// save the flag for this post
	  update_post_meta( $post_id, 'abh-gratitude-one', $_POST[ 'abh-gratitude-one' ] );
	} else {
		// clean up the database record
		delete_post_meta( $post->ID, 'abh-gratitude-one' );
	}

	// this request is validated, proceed to save
	if( isset( $_POST[ 'abh-gratitude-two' ] ) ) {
		// save the flag for this post
	  update_post_meta( $post_id, 'abh-gratitude-two', $_POST[ 'abh-gratitude-two' ] );
	} else {
		// clean up the database record
		delete_post_meta( $post->ID, 'abh-gratitude-two' );
	}

	// this request is validated, proceed to save
	if( isset( $_POST[ 'abh-gratitude-three' ] ) ) {
		// save the flag for this post
	  update_post_meta( $post_id, 'abh-gratitude-three', $_POST[ 'abh-gratitude-three' ] );
	} else {
		// clean up the database record
		delete_post_meta( $post->ID, 'abh-gratitude-three' );
	}




	/*----------------------------------------------------------------------------*
	 * Save all Content from the journal metabox
	 *----------------------------------------------------------------------------*/
	// validate the request itself using the nonce we set up
	if( ! isset( $_POST['abh_journal_nonce'] ) || ! wp_verify_nonce( $_POST['abh_journal_nonce'], basename( __FILE__ ) ) ) {
		return $post->ID; }

	// bail out if running an autosave, ajax, cron, or revision
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post->ID; }
	if( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return $post->ID; }
	if( defined( 'DOING_CRON' ) && DOING_CRON ) {
		return $post->ID; }
	if( wp_is_post_revision( $post_id ) ) {
		return $post->ID; }

	// make sure the user is authorized
	if( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID; }

	// this request is validated, proceed to save
	if( isset( $_POST[ 'abh_journal' ] ) ) {
		// save the flag for this post
	  update_post_meta( $post_id, 'abh_journal', $_POST[ 'abh_journal' ] );
	} else {
		// clean up the database record
		delete_post_meta( $post->ID, 'abh_journal' );
	}



	/*----------------------------------------------------------------------------*
	 * Save all Content from the Exercise Metabox
	 *----------------------------------------------------------------------------*/
	// validate the request itself using the nonce we set up
	if( ! isset( $_POST['abh_exercise_nonce'] ) || ! wp_verify_nonce( $_POST['abh_exercise_nonce'], basename( __FILE__ ) ) ) {
		return $post->ID; }

	// bail out if running an autosave, ajax, cron, or revision
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post->ID; }
	if( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return $post->ID; }
	if( defined( 'DOING_CRON' ) && DOING_CRON ) {
		return $post->ID; }
	if( wp_is_post_revision( $post_id ) ) {
		return $post->ID; }

	// make sure the user is authorized
	if( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID; }

	// this request is validated, proceed to save
	if( isset( $_POST[ 'abh-exercise-toggle' ] ) ) {
		// save the flag for this post
	  update_post_meta( $post_id, 'abh-exercise-toggle', $_POST[ 'abh-exercise-toggle' ] );
	} else {
		// clean up the database record
		delete_post_meta( $post->ID, 'abh-exercise-toggle' );
	}

	// this request is validated, proceed to save
	if( isset( $_POST[ 'abh-exercise-info' ] ) ) {
		// save the flag for this post
	  update_post_meta( $post_id, 'abh-exercise-info', $_POST[ 'abh-exercise-info' ] );
	} else {
		// clean up the database record
		delete_post_meta( $post->ID, 'abh-exercise-info' );
	}



	/*----------------------------------------------------------------------------*
	 * Save all Content from the Meditation Metabox
	 *----------------------------------------------------------------------------*/
	// validate the request itself using the nonce we set up
	if( ! isset( $_POST['abh_meditation_nonce'] ) || ! wp_verify_nonce( $_POST['abh_meditation_nonce'], basename( __FILE__ ) ) ) {
		return $post->ID; }

	// bail out if running an autosave, ajax, cron, or revision
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post->ID; }
	if( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return $post->ID; }
	if( defined( 'DOING_CRON' ) && DOING_CRON ) {
		return $post->ID; }
	if( wp_is_post_revision( $post_id ) ) {
		return $post->ID; }

	// make sure the user is authorized
	if( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID; }

	// this request is validated, proceed to save
	if( isset( $_POST[ 'abh-meditation-toggle' ] ) ) {
		// save the flag for this post
	  update_post_meta( $post_id, 'abh-meditation-toggle', $_POST[ 'abh-meditation-toggle' ] );
	} else {
		// clean up the database record
		delete_post_meta( $post->ID, 'abh-meditation-toggle' );
	}

	// this request is validated, proceed to save
	if( isset( $_POST[ 'abh-meditation-info' ] ) ) {
		// save the flag for this post
	  update_post_meta( $post_id, 'abh-meditation-info', $_POST[ 'abh-meditation-info' ] );
	} else {
		// clean up the database record
		delete_post_meta( $post->ID, 'abh-meditation-info' );
	}



	/*----------------------------------------------------------------------------*
	 * Save all Content from the Kindness Metabox
	 *----------------------------------------------------------------------------*/
	// validate the request itself using the nonce we set up
	if( ! isset( $_POST['abh_kindness_nonce'] ) || ! wp_verify_nonce( $_POST['abh_kindness_nonce'], basename( __FILE__ ) ) ) {
		return $post->ID; }

	// bail out if running an autosave, ajax, cron, or revision
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post->ID; }
	if( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return $post->ID; }
	if( defined( 'DOING_CRON' ) && DOING_CRON ) {
		return $post->ID; }
	if( wp_is_post_revision( $post_id ) ) {
		return $post->ID; }

	// make sure the user is authorized
	if( ! current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID; }

	// this request is validated, proceed to save
	if( isset( $_POST[ 'abh-kindness-email-toggle' ] ) ) {
		// save the flag for this post
	  update_post_meta( $post_id, 'abh-kindness-email-toggle', $_POST[ 'abh-kindness-email-toggle' ] );
	} else {
		// clean up the database record
		delete_post_meta( $post->ID, 'abh-kindness-email-toggle' );
	}

	// this request is validated, proceed to save
	if( isset( $_POST[ 'abh-kindness-email-name' ] ) ) {
		// save the flag for this post
	  update_post_meta( $post_id, 'abh-kindness-email-name', $_POST[ 'abh-kindness-email-name' ] );
	} else {
		// clean up the database record
		delete_post_meta( $post->ID, 'abh-kindness-email-name' );
	}

  // this request is validated, proceed to save
  if( isset( $_POST[ 'abh-kindness-email-address' ] ) ) {
    // save the flag for this post
    update_post_meta( $post_id, 'abh-kindness-email-address', $_POST[ 'abh-kindness-email-address' ] );
  } else {
    // clean up the database record
    delete_post_meta( $post->ID, 'abh-kindness-email-address' );
  }

  // this request is validated, proceed to save
  if( isset( $_POST[ 'abh-kindness-email-subject' ] ) ) {
    // save the flag for this post
    update_post_meta( $post_id, 'abh-kindness-email-subject', $_POST[ 'abh-kindness-email-subject' ] );
  } else {
    // clean up the database record
    delete_post_meta( $post->ID, 'abh-kindness-email-subject' );
  }

	// this request is validated, proceed to save
	if( isset( $_POST[ 'abh-kindness-email-content' ] ) ) {
		// save the flag for this post
	  update_post_meta( $post_id, 'abh-kindness-email-content', $_POST[ 'abh-kindness-email-content' ] );
	} else {
		// clean up the database record
		delete_post_meta( $post->ID, 'abh-kindness-email-content' );
	}

	// this request is validated, proceed to save
	if( isset( $_POST[ 'abh-kindness-email-show-everyone-toggle' ] ) ) {
		// save the flag for this post
	  update_post_meta( $post_id, 'abh-kindness-email-show-everyone-toggle', $_POST[ 'abh-kindness-email-show-everyone-toggle' ] );
	} else {
		// clean up the database record
		delete_post_meta( $post->ID, 'abh-kindness-email-show-everyone-toggle' );
	}

	// this request is validated, proceed to save
	if( isset( $_POST[ 'abh-kindness-physical-toggle' ] ) ) {
		// save the flag for this post
	  update_post_meta( $post_id, 'abh-kindness-physical-toggle', $_POST[ 'abh-kindness-physical-toggle' ] );
	} else {
		// clean up the database record
		delete_post_meta( $post->ID, 'abh-kindness-physical-toggle' );
	}

	// this request is validated, proceed to save
	if( isset( $_POST[ 'abh-kindness-physical-act' ] ) ) {
		// save the flag for this post
	  update_post_meta( $post_id, 'abh-kindness-physical-act', $_POST[ 'abh-kindness-physical-act' ] );
	} else {
		// clean up the database record
		delete_post_meta( $post->ID, 'abh-kindness-physical-act' );
	}

  return $post;
}