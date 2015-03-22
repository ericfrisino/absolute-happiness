<?php
/**
 * @package   Absolute Happiness
 * @author    Eric Frisino <eric.frisino@gmail.com>
 * @license   GPL-2.0+
 * @link      http://ericfrisino.com
 * @copyright 2015 Eric Frisino
 */


/**
 * this function gathers the custom content entered in
 * the post and displays it on the front end of the site.
 *
 * @var string  $abh_gratitude_one      Users first daily gratitude.
 * @var string  $abh_gratitude_two      Users second daily gratitude.
 * @var string  $abh_gratitude_three    Users third daily gratitude.
 *
 * @var string  $abh_journal            Users daily journal entry.
 *
 * @var bool    $abh_exercise_toggle    Did the user exercise today?
 * @var string  $abh_exercise_info      Any information the user wants to track about their exercise.
 *
 * @var bool    $abh_meditation_toggle  Did the user meditate today?
 * @var string  $abh_meditation_info    Any information the user wants to track about their meditation.
 *
 * @var bool    $abh_kindness_email_toggle                Does the user want to send an email today?
 * @var string  $abh_kindness_email_name                  Who the email being sent to.
 * @var string  $abh_kindness_email_content               The content of the email.
 * @var bool    $abh_kindness_email_show_everyone_toggle  Show the email on the front of the site?
 *                                                        If not, it defaults to show to the post author.
 *
 * @var bool    $abh_kindness_physical_toggle   Did the user commit a real life act of kindness?
 * @var string  $abh_kindness_physical_act      What did the user do? and any other information about it.
 */
function abh_insert_custom_post_meta() {

  // Call $post & $current_user global variables.
  global $post, $current_user;
  
  // Sanitize and populate all custom post meta
  $abh_gratitude_one = esc_html( get_post_meta( $post->ID, 'abh-gratitude-one', true ) );
  $abh_gratitude_two = esc_html( get_post_meta( $post->ID, 'abh-gratitude-two', true ) );
  $abh_gratitude_three = esc_html( get_post_meta( $post->ID, 'abh-gratitude-three', true ) );

  $abh_journal = wp_kses( get_post_meta( $post->ID, 'abh_journal', true ), '', '' );

  $abh_exercise_toggle = get_post_meta( $post->ID, 'abh-exercise-toggle', true );
  $abh_exercise_info = esc_textarea( get_post_meta( $post->ID, 'abh-exercise-info', true ) );

  $abh_meditation_toggle = get_post_meta( $post->ID, 'abh-meditation-toggle', true );
  $abh_meditation_info = esc_textarea( get_post_meta( $post->ID, 'abh-meditation-info', true ) );

  $abh_kindness_email_toggle = get_post_meta( $post->ID, 'abh-kindness-email-toggle', true );
  $abh_kindness_email_name = wp_kses( get_post_meta( $post->ID, 'abh-kindness-email-name', true ), '', '' );
  $abh_kindness_email_content = wp_kses( get_post_meta( $post->ID, 'abh-kindness-email-content', true ), '', '' );
  $abh_kindness_email_show_everyone_toggle = get_post_meta( $post->ID, 'abh-kindness-email-show-everyone-toggle', true );

  $abh_kindness_physical_toggle = get_post_meta( $post->ID, 'abh-kindness-physical-toggle', true );
  $abh_kindness_physical_act = esc_textarea( get_post_meta( $post->ID, 'abh-kindness-physical-act', true ) );?>


  <?php // Check to see if the user entered any gratitudes, if so print whatever was entered out in a list. ?>
  <?php if( !empty($abh_gratitude_one) || !empty($abh_gratitude_two) || !empty($abh_gratitude_three) ) : ?>
    <h2 class="abh-h2 abh-gratitudes"><?php _e('Things I am Grateful For Today', 'abh_trans') ?></h2>
    <ul>
      <?php if( !empty($abh_gratitude_one) ) : ?><li><?php echo $abh_gratitude_one; ?></li><?php endif; ?>
      <?php if( !empty($abh_gratitude_two) ) : ?><li><?php echo $abh_gratitude_two; ?></li><?php endif; ?>
      <?php if( !empty($abh_gratitude_three) ) : ?><li><?php echo $abh_gratitude_three; ?></li><?php endif; ?>
    </ul>
  <?php endif; ?>

  <?php // Check to see if the user journaled today, if so print out the entry. ?>
  <?php if( !empty($abh_journal) ) : ?>
    <h2 class="abh-h2 abh-positive-experience"><?php _e('Today\'s Positive Experience', 'abh_trans') ?></h2>
    <p><?php echo $abh_journal; ?></p>
  <?php endif; ?>

  <?php // Check to see if the user exercised today, if so print 'I Exercised!'. ?>
  <?php if( $abh_exercise_toggle == 1 ) : ?>
    <h2 class="abh-h2 abh-did-exercise"><?php _e('I Exercised!', 'abh_trans') ?></h2>
    <?php // Check to see if the user wrote anything about today's exercise, if so print out the entry. ?>
    <?php if( !empty($abh_exercise_info) ) : ?>
      <p><?php echo $abh_exercise_info; ?></p>
    <?php endif; ?>
    <?php // If the user did not exercise today, encourage them to do it tomorrow. ?>
  <?php else : ?>
    <h2 class="abh-h2 abh-didnt-exercise"><?php _e('I Didn\'t Exercise', 'abh_trans') ?></h2>
    <p><?php _e('That\'s ok! You will tomorrow!', 'abh_trans') ?></p>
  <?php endif; ?>

  <?php // Check to see if the user meditated today, if so print 'I Meditated!'. ?>
  <?php if( $abh_meditation_toggle == 1 ) : ?>
    <h2 class="abh-h2 abh-did-meditate"><?php _e('I Meditated!', 'abh_trans') ?></h2>
    <?php // Check to see if the user wrote anything about today's meditation, if so print out the entry. ?>
    <?php if( !empty($abh_meditation_info) ) : ?>
      <p><?php echo $abh_meditation_info; ?></p>
    <?php endif; ?>
  <?php // If the user did not meditate today, encourage them to do it now. ?>
  <?php else : ?>
    <h2  class="abh-h2 abh-didnt-meditate"><?php _e('I Didn\'t Meditate', 'abh_trans') ?></h2>
    <p>Quick do it now, it only takes 5 minutes.', 'abh_trans') ?></p>
  <?php endif; ?>

  <?php // Check to see if the user decided to write an email today, if so say 'I wrote [NAME IF EXISTS] an email today!' ?>
  <?php if( $abh_kindness_email_toggle == 1 ) : ?>
    <h2  class="abh-h2 abh-kindness-email"><?php _e('I wrote ', 'abh_trans') ?> <?php if( !empty($abh_kindness_email_name) ) : echo $abh_kindness_email_name; endif; ?> <?php _e('an email Today!', 'abh_trans') ?></h2>
    <?php // Check to see if the user wanted to let everyone see the email that they wrote, or if the current user is the author of the email, if so display the email. ?>
    <?php if( $abh_kindness_email_show_everyone_toggle == 1 || $post->post_author == $current_user->ID ) : ?>
      <p><?php echo $abh_kindness_email_content; ?></p>
    <?php endif; ?>
  <?php endif; ?>

  <?php // Check to see if the user decided to commit a real world act of kindness today, if so say 'I Committed a Conscious Act of Kindness!' and the entry. ?>
  <?php if( $abh_kindness_physical_toggle == 1 ) : ?>
    <h2 class="abh-h2 abh-kindness-act"><?php _e('I Committed a Conscious Act of Kindness!', 'abh_trans') ?></h2>
    <p><?php echo $abh_kindness_physical_act; ?></p>
  <?php endif; ?>

<?php }
add_filter( 'the_content', 'abh_insert_custom_post_meta' );