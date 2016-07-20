<?php
namespace Plugin_Espn_Embed;

class BDC_Espn_Embed_Integration_Test extends \WP_UnitTestCase {
	/**
	 * Test that the shortcode exists using WordPress's `shortcode_exists`
	 */
	function test_shortcode_added() {
		$this->assertTrue( shortcode_exists( 'espn' ) );
	}
}
