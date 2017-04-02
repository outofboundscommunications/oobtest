<?php
/**
 * WordPress AJAX Process Execution.
 *
 * @package WordPress
 * @subpackage Administration
 *
 * @link https://codex.wordpress.org/AJAX_in_Plugins
 */

/**
 * Executing AJAX process.
 *
 * @since 2.1.0
 */
define( 'DOING_AJAX', true );
if ( ! defined( 'WP_ADMIN' ) ) {
	define( 'WP_ADMIN', true );
}
/** Load WordPress Bootstrap */
require_once( dirname( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) ) . '/wp-load.php' );

define('WP_USE_THEMES', false);

/** Allow for cross-domain requests (from the front end). */
send_origin_headers();

// Require an action parameter
if ( empty( $_REQUEST['action'] ) )
	die( '0' );

/** Load WordPress Administration APIs */
// require_once( ABSPATH . 'wp-admin/includes/admin.php' );

/** Load Ajax Handlers for WordPress Core */
// require_once( ABSPATH . 'wp-admin/includes/ajax-actions.php' );

@header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
@header( 'X-Robots-Tag: noindex' );

if ( is_user_logged_in() ) {
	/**
	 * Fires authenticated AJAX actions for logged-in users.
	 *
	 * The dynamic portion of the hook name, `$_REQUEST['action']`,
	 * refers to the name of the AJAX action callback being fired.
	 *
	 * @since 2.1.0
	 */
	do_action( 'wp_ajax_' . $_REQUEST['action'] );
} else {
	/**
	 * Fires non-authenticated AJAX actions for logged-out users.
	 *
	 * The dynamic portion of the hook name, `$_REQUEST['action']`,
	 * refers to the name of the AJAX action callback being fired.
	 *
	 * @since 2.8.0
	 */
	do_action( 'wp_ajax_nopriv_' . $_REQUEST['action'] );
}
// Default status
die( '0' );
