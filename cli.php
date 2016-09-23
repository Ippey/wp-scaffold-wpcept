<?php
/**
 * WP-CLI wp plugins-api command
 *
 * @subpackage commands/community
 * @maintainer Takayuki Miyauchi
 */
if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
    return;
}

class WP_CLI_Wpcept extends WP_CLI_Command {

    /**
     * Install wpcept and generate bootstrap.
     *
     * ## OPTIONS
     *
     * <author>
     * : A plugin author's name of wordpress.org
     *
     * [--format=<format>]
     * : Accepted values: table, csv, json, count, ids. Default: table
     *
     * ## EXAMPLES
     *
     *    wp wpcept
     *
     */
    public function __invoke ($args, $assoc_args) {
        $result = exec ('which composer');
        if (empty($result)) {
            WP_CLI::error("not found composer.");
        }

        exec('composer require-dev "lucatume/wp-browser"');
        exec('vendor/bin/wpcept bootstrap');
        WP_CLI::success($args[0]);
    }
}

 WP_CLI::add_command( 'wpcept', 'WP_CLI_Wpcept' );
