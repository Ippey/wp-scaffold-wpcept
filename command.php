<?php

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

require_once __DIR__ . '/inc/ScaffoldWpceptCommand.php';

WP_CLI::add_command( 'scaffold wpcept', array( 'WP_CLI\ScaffoldWpceptCommand', 'wpcept' ) );
