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
		$DAYS = ['вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб'];
		$url = 'https://api.darksky.net/forecast/81b61e0936068afa7f3b5d5443c9f690/55.773202,27.072710?lang=ru&exclude=minutely,hourly,flags,alerts&units=auto';
		$response = wp_remote_get($url);
		$responseBody = wp_remote_retrieve_body($response);
		$weather = json_decode($responseBody, true);
		$result  = [];
        if (!empty($weather) and isset($weather["daily"]) and isset($weather["daily"]["data"])) {

            $days   = $weather["daily"]["data"];
            $result = [
                'day'         => $DAYS[date('w', $days[1]["time"])],
                'temperature' => round($days[1]["temperatureMax"]),
                'icon'        => "https://darksky.net/images/weather-icons/" . $days[1]["icon"] . ".png",
                'description' => $days[1]["summary"],
                'firstDay'    => [
                    'day'  => $DAYS[date('w', $days[2]["time"])],
                    'icon' => "https://darksky.net/images/weather-icons/" . $days[2]["icon"] . ".png"
                ],
                'secondDay'   => [
                    'day'  => $DAYS[date('w', $days[3]["time"])],
                    'icon' => "https://darksky.net/images/weather-icons/" . $days[3]["icon"] . ".png"
                ],
                'thirdDay'    => [
                    'day'  => $DAYS[date('w', $days[4]["time"])],
                    'icon' => "https://darksky.net/images/weather-icons/" . $days[4]["icon"] . ".png"
                ]
            ];
        }
		update_option('ls_wp_weather_data', $result);
	}
	function get_weather(){
		return get_option('ls_wp_weather_data');

	}
	add_action( 'admin_menu', function(){
	        add_menu_page(
            'LS WP Weather',
            'LS WP Weather',
            'manage_options',
			LS_WP_WEATHER_PAGE . '/LS-WP-WEATHER-PAGE.php',
            '',
            plugins_url( 'image/menu-icon.svg', __FILE__ ),
            84
		);

	});
?>