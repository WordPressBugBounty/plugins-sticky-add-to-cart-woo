<?php

/**
 * Analytics for Sticky Add to Cart.
 *
 * @link       https://solbox.dev/
 * @since      1.1.0
 *
 * @package    Wsatc
 * @subpackage Wsatc/admin
 */

/**
 * * The analytics-specific functionality of the plugin.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.1.0
 * @package    Wsatc
 * @subpackage Wsatc/admin
 * @author     Solution Box <solutionboxdev@gmail.com>
 */
class Wsatc_Analytics {


	public static $_instance;

	/**
	 * Define the analytics functionality.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

			add_action( 'wp_ajax_wsatc_pro_analytics', array( $this, 'set_analytics_data' ) );
			add_action( 'wp_ajax_nopriv_wsatc_pro_analytics', array( $this, 'set_analytics_data' ) );

		add_action( 'wsatc_analytics_header', array( $this, 'stats_counter' ), 11 );
	}

	/**
	 * Get || Making a Single Instance of Analytics
	 *
	 * @return self
	 */
	public static function get_instance() {
		if ( self::$_instance === null ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}


	/**
	 * Setting the analytics data.
	 *
	 * @since 1.3.0
	 * @return void
	 */
	public function set_analytics_data() {
		/**
		 * Verify the Nonce
		 */
		$nonce_key = isset( $_POST['nonce_key'] ) ? $_POST['nonce_key'] : 'wsatc_nonce';
		check_ajax_referer( $nonce_key, 'security' );

		if ( ! isset( $_POST['post_id'] ) ) {
			return;
		}

		$should_count = true;

		apply_filters( 'wsatc_analytics_count_user', $should_count );

		if ( false === $should_count ) {
			wp_die();
		}

		$exclude_bot_analytics = apply_filters( 'wsatc_exclude_bot_analytics', true );

		if ( $exclude_bot_analytics ) {
				/**
				 * Inspired from WP-Postviews for
				 * this piece of code.
				 */
				$bots      = array(
					'Google Bot'    => 'google',
					'MSN'           => 'msnbot',
					'Alex'          => 'ia_archiver',
					'Lycos'         => 'lycos',
					'Ask Jeeves'    => 'jeeves',
					'Altavista'     => 'scooter',
					'AllTheWeb'     => 'fast-webcrawler',
					'Inktomi'       => 'slurp@inktomi',
					'Turnitin.com'  => 'turnitinbot',
					'Technorati'    => 'technorati',
					'Yahoo'         => 'yahoo',
					'Findexa'       => 'findexa',
					'NextLinks'     => 'findlinks',
					'Gais'          => 'gaisbo',
					'WiseNut'       => 'zyborg',
					'WhoisSource'   => 'surveybot',
					'Bloglines'     => 'bloglines',
					'BlogSearch'    => 'blogsearch',
					'PubSub'        => 'pubsub',
					'Syndic8'       => 'syndic8',
					'RadioUserland' => 'userland',
					'Gigabot'       => 'gigabot',
					'Become.com'    => 'become.com',
					'Baidu'         => 'baiduspider',
					'so.com'        => '360spider',
					'Sogou'         => 'spider',
					'soso.com'      => 'sosospider',
					'Yandex'        => 'yandex',
				);
				$useragent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : '';
				foreach ( $bots as $name => $lookfor ) {
					if ( ! empty( $useragent ) && ( false !== stripos( $useragent, $lookfor ) ) ) {
							$should_count = false;
							break;
					}
				}
		}

		if ( false === $should_count ) {
			wp_die();
		}

		/**
		 * Save Impressions
		 */
		$post_id = intval( $_POST['post_id'] );

		/**
		 * For Per Click Data
		 */
		$todays_date = date( 'd-m-Y', time() );
		$event_type  = isset( $_POST['event_type'] ) ? $_POST['event_type'] : '';
		if ( 'click' == $event_type ) {
				$clicks = get_post_meta( $post_id, '_sc_meta_clicks', true );
			if ( $clicks === null ) {
				add_post_meta( $post_id, '_sc_meta_clicks', 1 );
			} else {
				update_post_meta( $post_id, '_sc_meta_clicks', ++$clicks );
			}
			// For Impression.
			$impressions = get_post_meta( $post_id, '_sc_meta_impression_per_day', true );
			if ( empty( $impressions ) ) {
				$impressions                           = array();
				$impressions[ $todays_date ]['clicks'] = 1;
				add_post_meta( $post_id, '_sc_meta_impression_per_day', $impressions );
			} else {
				if ( isset( $impressions[ $todays_date ] ) ) {
					$clicks_data                           = isset( $impressions[ $todays_date ]['clicks'] ) ? ++$impressions[ $todays_date ]['clicks'] : 1;
					$impressions[ $todays_date ]['clicks'] = $clicks_data;
				} else {
					$impressions[ $todays_date ]['clicks'] = 1;
				}
					update_post_meta( $post_id, '_sc_meta_impression_per_day', $impressions );
			}
				wp_send_json_success();
		}

		$views = get_post_meta( $post_id, '_sc_meta_views', true );
		if ( $views === null ) {
				add_post_meta( $post_id, '_sc_meta_views', 1 );
		} else {
				update_post_meta( $post_id, '_sc_meta_views', ++$views );
		}

		// For Impression.
		$impressions = get_post_meta( $post_id, '_sc_meta_impression_per_day', true );
		if ( empty( $impressions ) ) {
				$impressions                                = array();
				$impressions[ $todays_date ]['impressions'] = 1;
				add_post_meta( $post_id, '_sc_meta_impression_per_day', $impressions );
		} else {
			if ( isset( $impressions[ $todays_date ] ) ) {
					$impressions_data                           = isset( $impressions[ $todays_date ]['impressions'] ) ? ++$impressions[ $todays_date ]['impressions'] : 1;
					$impressions[ $todays_date ]['impressions'] = $impressions_data;
			} else {
					$impressions[ $todays_date ]['impressions'] = 1;
			}
				update_post_meta( $post_id, '_sc_meta_impression_per_day', $impressions );
		}
		wp_send_json_success();
	}
}
Wsatc_Analytics::get_instance();
