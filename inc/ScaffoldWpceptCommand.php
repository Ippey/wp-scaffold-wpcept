<?php

namespace WP_CLI;
use WP_CLI;
use WP_CLI\Process;
use WP_CLI\Utils;

class ScaffoldWpceptCommand
{
    /**
     * generate files needed for wpcept
     *
     * ## OPTIONS
     *
     * [--default-url=<url>]
     * : set the url of acceptance.suite.yml
     * ---
     * default: http://localhost
     * ---
     *
     * [--admin-user-name=<adminUserName>]
     * : admin User of WordPress
     *
     * [--admin-password=<adminPassword>]
     * : admin password of WordPress
     *
     * [--admin-path=<adminPath>]
     * : Path for administrator's page
     * ---
     * default: /wp-admin
     * ---
     *
     * ---
     * default: success
     * options:
     *   - success
     *   - error
     * ---
     *
     * ## EXAMPLES
     *
     *     wp scaffold wpcept
     *
     */
    public function wpcept( $args, $assoc_args ) {

        if ( ! empty( $assoc_args['dir'] ) ) {
            $test_dir = $assoc_args['dir'] . '/tests/';
        } else {
            $test_dir = './tests/';
        }
        $package_root = dirname( dirname( __FILE__ ) );
        $template_path = $package_root . '/templates/';
        $acceptance_path = $test_dir . 'acceptance.suite.yml';

        $result = exec ('which composer');
        if (empty($result)) {
            WP_CLI::error("not found composer.");
        }

        $defaults = array(
            'default-url' => 'http://localhost',
            'admin-user-name' => '',
            'admn-password' => '',
            'admin-path' => '/wp-admin'
        );
        $assoc_args = array_merge($defaults, $assoc_args);

        exec('composer require lucatume/wp-browser --dev');
        exec('vendor/bin/wpcept bootstrap');

        file_put_contents(
            $acceptance_path,
            Utils\mustache_render( "{$template_path}/acceptance.suite.yml.mustache", $assoc_args ));

        exec('vendor/bin/wpcept build');

        WP_CLI::success("Created files for wpcept.");
    }
}