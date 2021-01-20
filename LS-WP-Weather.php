<?php
    /*	
        Plugin Name: LS WP Weather	
		Description: Shows Weather
		Author: Lightning Soft
		Text Domain: ls_wp
		License: GPL2
	*/

	define('LS_WP_WEATHER_PAGE', basename( __DIR__ ));

	register_activation_hook(__FILE__,'ls_wp_weather');
	
 	function ls_wp_weather(){
		wp_clear_scheduled_hook('ls_wp_update_weather');
		wp_schedule_event( time(), 'daily ','ls_wp_update_weather');
		ls_wp_loading_weather();
	}

	add_action('ls_wp_update_weather', 'ls_wp_loading_weather');

	function ls_wp_loading_weather(){
		$url = 'https://api.darksky.net/forecast/81b61e0936068afa7f3b5d5443c9f690/55.773202,27.072710?lang=ru&exclude=minutely,hourly,flags,alerts&units=auto';
		$response = wp_remote_get($url);
		$responseBody = wp_remote_retrieve_body($response);
		$weather = json_decode($responseBody, true);
		update_option('ls_wp_weather_data', $weather);
	}
	
	add_action( 'admin_menu', function(){
	        add_menu_page(
            'LS WP weather',
            'LS WP weather',
            'manage_options',
			LS_WP_WEATHER_PAGE . '/LS-WP-WEATHER-PAGE.php',
            '',
            plugins_url( 'image/menu-icon.svg', __FILE__ ),
            84
		);
	});
?>