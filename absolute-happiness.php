<?php
/**
 * @package   Absolute Happiness
 * @author    Eric Frisino <eric.frisino@gmail.com>
 * @license   GPL-2.0+
 * @link      http://ericfrisino.com
 * @copyright 2015 Eric Frisino
 *
 * @wordpress-plugin
 * Plugin Name:       Absolute Happiness
 * Plugin URI:        http://ericfrisino.com/absolute-happiness-wordpress-plugin/
 * Description:       A plugin aimed at helping you rewire how your brain to see the positive first.
 * Version:           1.0.0
 * Author:            Eric Frisino
 * Author URI:        http://ericrisino.com
 * Prefix:            abh
 * Text Domain:       abh_trans
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/ericfrisino/absolute-happiness
 */

/*----------------------------------------------------------------------------*
 * If this file is called directly, Bail!
 *----------------------------------------------------------------------------*/
if ( ! defined( 'WPINC' ) ) {	die; }

/*----------------------------------------------------------------------------*
 * Setup Custom Post Type Metadata
 *----------------------------------------------------------------------------*/
include_once('metadata/abh-metadata.php');

/*----------------------------------------------------------------------------*
 * Include the hooked functions that make this plugin possible.
 *----------------------------------------------------------------------------*/
// Display the content of the post correctly.
include_once('hooks/the_content.php');

// Email the recipient when publishing the post for the first time.
include_once('hooks/publish_post.php');

/*----------------------------------------------------------------------------*
 * Enqueue custom JavaScript
 *----------------------------------------------------------------------------*/
include_once('javascript/abh-enqueue-javascript.php');

/*----------------------------------------------------------------------------*
 * Enqueue custom StyleSheets
 *----------------------------------------------------------------------------*/
include_once('stylesheets/abh-enqueue-stylesheets.php');