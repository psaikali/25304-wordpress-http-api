<?php
/**
 * Plugin Name: Mosaika — Faire des appels HTTP avec WordPress grâce à wp_remote_request()
 * Description: Exemple de code accompagnant l'article de blog expliquant comment faire des appels HTTP avec WordPress.
 * Author: Pierre Saïkali
 * Author URI: https://mosaika.fr/fonctions-http-api-wordpress/
 * Version: 1.0.0
 */

namespace Mosaika\Remote_Requests;

defined( 'ABSPATH' ) || exit;

define( 'MSK_HTTP_API_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Chargement des fichiers vitaux de cette extension.
 *
 * @return void
 */
function require_files() {
	require_once MSK_HTTP_API_DIR . '/src/api.php';
	require_once MSK_HTTP_API_DIR . '/src/shortcode.php';
	require_once MSK_HTTP_API_DIR . '/src/utils.php';
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\\require_files' );
