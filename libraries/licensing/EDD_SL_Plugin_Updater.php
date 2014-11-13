<?php

// uncomment this line for testing
//set_site_transient( 'update_plugins', null );

/**
 * Allows plugins to use their own update API.
 *
 * @author Pippin Williamson
 * @version 1.2
 */
class PLP_SL_Plugin_Updater {
	private $api_url  = '';
	private $api_data = array();
	private $name     = '';
	private $slug     = '';
	private $do_check = false;

	/**
	 * Class constructor.
	 *
	 * @uses plugin_basename()
	 * @uses hook()
	 *
	 * @param string $_api_url The URL pointing to the custom API endpoint.
	 * @param string $_plugin_file Path to the plugin file.
	 * @param array $_api_data Optional data to send with API calls.
	 * @return void
	 */
	public function __construct( $current_version, $new_version) {


		$this->version = $current_version;
		$this->set_new_version = $new_version;

		$this->api_url  = "";
		$this->api_data = "";
		$this->name     = "";
		$this->slug     = "";

		// Set up hooks.
		$this->hook();
	}

	/**
	 * Set up WordPress filters to hook into WP's update process.
	 *
	 * @uses add_filter()
	 *
	 * @return void
	 */
	private function hook() {
		echo "asd";
		add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'pre_set_site_transient_update_plugins_filter' ) );
		add_filter( 'plugins_api', array( $this, 'plugins_api_filter' ), 10, 3 );
		add_filter( 'http_request_args', array( $this, 'http_request_args' ), 10, 2 );
	}

	/**
	 * Check for Updates at the defined API endpoint and modify the update array.
	 *
	 * This function dives into the update API just when WordPress creates its update array,
	 * then adds a custom API call and injects the custom plugin data retrieved from the API.
	 * It is reassembled from parts of the native WordPress plugin update code.
	 * See wp-includes/update.php line 121 for the original wp_update_plugins() function.
	 *
	 * @uses api_request()
	 *
	 * @param array $_transient_data Update array build by WordPress.
	 * @return array Modified update array with custom plugin data.
	 */
	function pre_set_site_transient_update_plugins_filter( $_transient_data ) {
		echo 1;
		$to_send = array( 'slug' => $this->slug );

		$api_response = $this->api_request( 'plugin_latest_version', $to_send );

		var_dump($this);
		if( version_compare( $this->version, $api_response->new_version, '<' ) ) {
			$_transient_data->response[$this->name] = $api_response;
		}
		return $_transient_data;
	}


	/**
	 * Updates information on the "View version x.x details" page with custom data.
	 *
	 * @uses api_request()
	 *
	 * @param mixed $_data
	 * @param string $_action
	 * @param object $_args
	 * @return object $_data
	 */
	function plugins_api_filter( $_data, $_action = '', $_args = null ) {
		echo 2;
		if ( ( $_action != 'plugin_information' ) || !isset( $_args->slug ) || ( $_args->slug != $this->slug ) ) return $_data;

		$to_send = array( 'slug' => $this->slug );

		$api_response = $this->api_request( 'plugin_information', $to_send );
		if ( false !== $api_response ) $_data = $api_response;

		return $_data;
	}


	/**
	 * Disable SSL verification in order to prevent download update failures
	 *
	 * @param array $args
	 * @param string $url
	 * @return object $array
	 */
	function http_request_args( $args, $url ) {
		echo 3;
		// If it is an https request and we are performing a package download, disable ssl verification
		if( strpos( $url, 'https://' ) !== false && strpos( $url, 'edd_action=package_download' ) ) {
			$args['sslverify'] = false;
		}
		return $args;
	}

	/**
	 * Calls the API and, if successfull, returns the object delivered by the API.
	 *
	 * @uses get_bloginfo()
	 * @uses wp_remote_post()
	 * @uses is_wp_error()
	 *
	 * @param string $_action The requested action.
	 * @param array $_data Parameters for the API action.
	 * @return false||object
	 */
	private function api_request( $_action, $_data ) {
		echo 4;

		global $wp_version;

		$this->new_version = $this->set_new_version;
		return;

		$data = array_merge( $this->api_data, $_data );

		if( $data['slug'] != $this->slug )
			return;

		if( empty( $data['license'] ) )
			return;

		$api_params = array(
			'edd_action' => 'get_version',
			'license'    => $data['license'],
			'name'       => $data['item_name'],
			'slug'       => $this->slug,
			'author'     => $data['author'],
			'url'        => home_url()
		);
		$request = wp_remote_post( $this->api_url, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );
        //var_dump($request);
		if ( ! is_wp_error( $request ) ):
			$request = json_decode( wp_remote_retrieve_body( $request ) );
			if( $request && isset( $request->sections ) )
				$request->sections = maybe_unserialize( $request->sections );
			return $request;
		else:
			return false;
		endif;
	}
}
