Feature: Scaffold wpcept commands

  Scenario: Scaffold a wpcept command
    Given a WP install

    When I run `wp scaffold wpcept `
    Then STDOUT should contain:
      """
      Success: Created files for wpcept.
      """
    And the vendor/bin/wpcept file should exist
    And the tests/acceptance.suite.yml file should exist
