<?php
/**
 * Plugin Name: Mezu
 * Plugin URI:  https://github.com/trsenna/mezu
 * Author:      Thiago Senna
 * Author URI:  http://thremes.com.br
 * Description: The Mezu WordPress plugin provides an opinionated bootstrap for themes.
 * Version:     0.1.0
 *
 * @package   Mezu
 * @author    Thiago Senna <thiago@thremes.com.br>
 * @copyright Copyright (c) 2019, Thiago Senna
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

define( 'MEZU_PLUGIN', true );
define( 'MEZU_PLUGIN_FILE', __FILE__ );
define( 'MEZU_PLUGIN_VERSION', get_file_data( __FILE__, [ 'Version' ] )[ 0 ] );

# ------------------------------------------------------------------------------
# Lorem ipsum dolor sit amet.
# ------------------------------------------------------------------------------
#
# Suspendisse sodales ipsum non justo imperdiet, ut lacinia erat
# cursus. Vestibulum dictum nisi ligula, in dictum justo pulvinar quis.
#

add_action( 'mezu/autoload/loader', function ( \Composer\Autoload\ClassLoader $loader ) {

    $loader->setPsr4( 'App\\Parent\\', get_parent_theme_file_path( 'includes/src' ) );
    $loader->setPsr4( 'App\\Theme\\', get_theme_file_path( 'includes/src' ) );

} );

# ------------------------------------------------------------------------------
# Lorem ipsum dolor sit amet.
# ------------------------------------------------------------------------------
#
# Suspendisse sodales ipsum non justo imperdiet, ut lacinia erat
# cursus. Vestibulum dictum nisi ligula, in dictum justo pulvinar quis.
#

add_action( 'mezu/autoload', function () {

    \Composer\Autoload\includeFile( __DIR__ . '/includes/functions-helpers.php' );

} );

# ------------------------------------------------------------------------------
# Lorem ipsum dolor sit amet.
# ------------------------------------------------------------------------------
#
# Suspendisse sodales ipsum non justo imperdiet, ut lacinia erat
# cursus. Vestibulum dictum nisi ligula, in dictum justo pulvinar quis.
#

add_action( 'mezu/autoload', function () {

    $loader = new \Composer\Autoload\ClassLoader();
    do_action( 'mezu/autoload/loader', $loader );
    $loader->register();

} );

# ------------------------------------------------------------------------------
# Lorem ipsum dolor sit amet.
# ------------------------------------------------------------------------------
#
# Suspendisse sodales ipsum non justo imperdiet, ut lacinia erat
# cursus. Vestibulum dictum nisi ligula, in dictum justo pulvinar quis.
#

add_action( 'mezu/autoload', function () {

    $files = apply_filters( 'mezu/autoload/files', [] );
    foreach ( $files as $file ) {
        \Composer\Autoload\includeFile( $file );
    }

} );

# ------------------------------------------------------------------------------
# Lorem ipsum dolor sit amet.
# ------------------------------------------------------------------------------
#
# Suspendisse sodales ipsum non justo imperdiet, ut lacinia erat
# cursus. Vestibulum dictum nisi ligula, in dictum justo pulvinar quis.
#

$run = function () {

    if ( !defined( 'APP_THEME' ) ) return;
    if ( !defined( 'APP_THEME_FILE' ) ) return;

    if ( defined( 'MEZU_BOOTSTRAPPED' ) ) {
        return;
    }

    if ( defined( 'DALEN_PLUGIN' ) && DALEN_PLUGIN ) {

        do_action( 'mezu/autoload' );
        do_action( 'mezu/bootstrap', \Mezu\theme() );
        \Mezu\theme()->run();

        define( 'MEZU_BOOTSTRAPPED', true );
    }

};

add_action( 'mezu/run', $run, PHP_INT_MIN );
add_action( 'dalen/bootstrap/genesis', $run, PHP_INT_MIN );
add_action( 'dalen/bootstrap/theme', $run, PHP_INT_MIN );
