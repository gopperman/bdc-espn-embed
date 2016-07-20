<?php
/**
 * Plugin Name: BDC Espn Embed
 * Plugin URI: http://www.boston.com
 * Description: Allow authors to embed Espn videos into pages / posts
 * Version: 0.1.0
 * Author: Greg Opperman
 * Author URI: http://www.boston.com
 *
 * @package bdc.espn-embed
 * @version 0.1.0
 * @author Greg Opperman <gregory.opperman@globe.com>
 */

define( 'BDC_ESPN_EMBED_REGEX', '#^https?://(www.)?espn\.go\.com/video/clip\?id=[0-9]*#' );

class BDC_Espn_Embed {
	/**
	 * Set up the default handlers for embedding
	*/
	function __construct() {

		// Example URL: http://cinesport.boston.com/boston-globe-sports/manning-reflects-win-over-brady-pats/
		wp_embed_register_handler( 'espn', BDC_ESPN_EMBED_REGEX, array( $this, 'espn_embed_handler' ) );

		add_shortcode( 'espn', array( $this, 'espn_shortcode_handler' ) );
	}

	function espn_embed_handler( $matches, $attr, $url ) {
		$id = str_replace( 'http://espn.go.com/video/clip?id=', '', $url );

		$embed = '<div class="content-media__video"><script src="http://player.espn.com/player.js?playerBrandingId=4ef8000cbaf34c1687a7d9a26fe0e89e&adSetCode=91cDU6NuXTGKz3OdjOxFdAgJVtQcKJnI&pcode=1kNG061cgaoolOncv54OAO1ceO-I&width=576&height=324&externalId=espn:';

		// Add the ID and parameters
		// We can't use async or defer because the ESPN script will append the video to the end of the document
		$embed .= $id . '&thruParam_espn-ui[autoPlay]=false&thruParam_espn-ui[playRelatedExternally]=true"></script></div>';

		return $embed;
	}

	function espn_shortcode_handler( $atts ) {
		global $wp_embed;
		if ( empty( $atts['url'] ) ) {
			return;
		}
		if ( ! preg_match( BDC_ESPN_EMBED_REGEX, $atts['url'] ) ) {
			return;
		}
		return $wp_embed->shortcode( $atts, $atts['url'] );
	}
}

new BDC_ESPN_Embed;


