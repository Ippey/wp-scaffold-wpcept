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
     * [--URL=<URL>]
     * : set the url of acceptance.suite.yml
     *
     * [--adminUserName=<adminUserName>]
     * : admin User of WordPress
     *
     * [--adminPassword=<adminPassword>]
     * : admin password of WordPress
     *
     * [--adminPath=<adminPath>]
     * : Path for administrator's page
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
            'URL' => 'http://localhost',
            'adminUserName' => '',
            'adminPassword' => '',
            'adminPath' => '/wp-admin'
        );
        $assoc_args = array_merge($defaults, $assoc_args);

        exec('composer require lucatume/wp-browser --dev');
        exec('vendor/bin/wpcept bootstrap');

        file_put_contents(
            $acceptance_path,
            Utils\mustache_render( "{$template_path}/acceptance.suite.yml.mustache", $assoc_args ));

        WP_CLI::success("Created files for wpcept.");
    }
}