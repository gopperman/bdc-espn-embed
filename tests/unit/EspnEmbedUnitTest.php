<?php
namespace Plugin_Espn_Embed;

class BDC_Espn_Embed_Unit_Test extends \WP_UnitTestCase {
	/**
	 * Store an instance of our plugin's object for testing direct calls to its
	 * methods
	 */
	private $bdc_espn_embed = null;

	/**
	 * Create an instance of our plugin's object
	 */
	public function setUp() {
		// before
		parent::setUp();

		$this->bdc_espn_embed = new \BDC_Espn_Embed;
	}

	/**
	 * Test that ESPN shortcode works.
	 */
	function test_espn_embed_shortcode_works() {
		$allowed_html = array(
			'div' => array(
				'class' => array(),
			),
		);
		$content = '[espn url="http://espn.go.com/video/clip?id=14500616"]';
		$output = wp_kses( do_shortcode( $content ), $allowed_html );
		// Just check that the video container gets inserted because of an url-encoding nightmare
		$this->assertEquals( '<div class="content-media__video"></div>', $output );

		// Bad URL should return nothing
		$content = '[espn url="https://boston.com"]';
		$output = do_shortcode( $content );
		$this->assertEquals( '', $output );
	}
}
