<?php
/*
Plugin Name: HTTP Headers
Plugin URI: https://zinoui.com/blog/http-headers-for-wordpress
Description: This plugin adds CORS & security HTTP headers to your website. Improves your website overall security.
Version: 1.2.0
Author: Dimitar Ivanov
Author URI: https://zinoui.com
License: GPLv2 or later
Text Domain: http-headers
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/copyleft/gpl.html>.

Copyright (c) 2017 Zino UI
*/

if (get_option('hh_strict_transport_security_max_age') === false) {
	$value = get_option('hh_strict_transport_security_value');
	$max_age = preg_match('/max-age=(\d+)/', $value, $match) ? $match[1] : 0;
	$sub_domains = strpos($value, 'includeSubDomains') !== false ? 1 : 0;
	add_option('hh_strict_transport_security_max_age', $max_age, null, 'yes');
	add_option('hh_strict_transport_security_sub_domains', $sub_domains, null, 'yes');
	add_option('hh_strict_transport_security_preload', 0, null, 'yes');
}

if (get_option('hh_referrer_policy') === false) {
	add_option('hh_referrer_policy', 0, null, 'yes');
	add_option('hh_referrer_policy_value', null, null, 'yes');
}

function http_headers() {
	
	if (get_option('hh_x_frame_options') == 1) {
		$x_frame_options_value = strtoupper(get_option('hh_x_frame_options_value'));
		if ($x_frame_options_value == 'ALLOW-FROM') {
			$x_frame_options_value .= ' ' . get_option('hh_x_frame_options_domain');
		}
		header("X-Frame-Options: " . $x_frame_options_value);
	}
	if (get_option('hh_x_xxs_protection') == 1) {
		header("X-XSS-Protection: " . get_option('hh_x_xxs_protection_value'));
	}
	if (get_option('hh_x_content_type_options') == 1) {
		header("X-Content-Type-Options: " . get_option('hh_x_content_type_options_value'));
	}
	if (get_option('hh_strict_transport_security') == 1) {
		$hh_strict_transport_security = array();
		
		$hh_strict_transport_security_max_age = get_option('hh_strict_transport_security_max_age');
		if ($hh_strict_transport_security_max_age !== false)
		{
			$hh_strict_transport_security[] = sprintf('max-age=%u', get_option('hh_strict_transport_security_max_age'));
			if (get_option('hh_strict_transport_security_sub_domains'))
			{
				$hh_strict_transport_security[] = 'includeSubDomains';
			}
			if (get_option('hh_strict_transport_security_preload'))
			{
				$hh_strict_transport_security[] = 'preload';
			}
		} else {
			$hh_strict_transport_security = array(get_option('hh_strict_transport_security_value'));
		}
		header("Strict-Transport-Security: " . join('; ', $hh_strict_transport_security));
	}
	if (get_option('hh_x_ua_compatible') == 1) {
		header("X-UA-Compatible: " . get_option('hh_x_ua_compatible_value'));
	}
	if (get_option('hh_public_key_pins') == 1) {
		$public_key_pins_sha256_1 = get_option('hh_public_key_pins_sha256_1');
		$public_key_pins_sha256_2 = get_option('hh_public_key_pins_sha256_2');
		$public_key_pins_max_age = get_option('hh_public_key_pins_max_age');
		$public_key_pins_sub_domains = get_option('hh_public_key_pins_sub_domains');
		$public_key_pins_report_uri = get_option('hh_public_key_pins_report_uri');
		if (!empty($public_key_pins_sha256_1) && !empty($public_key_pins_sha256_2) && !empty($public_key_pins_max_age)) {
			
			$public_key_pins = array();
			$public_key_pins[] = sprintf('pin-sha256="%s"', $public_key_pins_sha256_1);
			$public_key_pins[] = sprintf('pin-sha256="%s"', $public_key_pins_sha256_2);
			$public_key_pins[] = sprintf("max-age=%u", $public_key_pins_max_age);
			if ($public_key_pins_sub_domains) {
				$public_key_pins[] = "includeSubDomains";
			}
			if (!empty($public_key_pins_report_uri)) {
				$public_key_pins[] = sprintf('report-uri="%s"', $public_key_pins_report_uri);
			}
			header(sprintf("Public-Key-Pins: %s", join('; ', $public_key_pins)));
		}
	}
	
	# TODO
	//header("Content-Security-Policy: default-src 'none'; script-src 'self'; connect-src 'self'; img-src 'self'; style-src 'self';");

	if (get_option('hh_access_control_allow_origin') == 1)
	{
		$value = get_option('hh_access_control_allow_origin_value');
		switch ($value)
		{
			case 'HTTP_ORIGIN':
				$value = @$_SERVER['HTTP_ORIGIN'];
				break;
			case 'origin':
				$value = get_option('hh_access_control_allow_origin_url');
				break;
		}
		if (!empty($value))
		{
			header("Access-Control-Allow-Origin: " . $value);
		}
	}
	if (get_option('hh_access_control_allow_credentials') == 1)
	{
		header("Access-Control-Allow-Credentials: " . get_option('hh_access_control_allow_credentials_value'));
	}
	if (get_option('hh_access_control_max_age') == 1)
	{
		$value = get_option('hh_access_control_max_age_value');
		if (!empty($value))
		{
			header("Access-Control-Max-Age: " . intval($value));
		}
	}
	if (get_option('hh_access_control_allow_methods') == 1)
	{
		$value = get_option('hh_access_control_allow_methods_value');
		if (!empty($value))
		{
			header("Access-Control-Allow-Methods: " . join(', ', array_keys($value)));
		}
	}
	if (get_option('hh_access_control_allow_headers') == 1)
	{
		$value = get_option('hh_access_control_allow_headers_value');
		if (!empty($value))
		{
			header("Access-Control-Allow-Headers: " . join(', ', array_keys($value)));
		}
	}
	if (get_option('hh_access_control_expose_headers') == 1)
	{
		$value = get_option('hh_access_control_expose_headers_value');
		if (!empty($value))
		{
			header("Access-Control-Expose-Headers: " . join(', ', array_keys($value)));
		}
	}
	if (get_option('hh_p3p') == 1)
	{
		$value = get_option('hh_p3p_value');
		if (!empty($value))
		{
			header('P3P: CP="' . join(' ', array_keys($value)) . '"');
		}
	}
	if (get_option('hh_referrer_policy') == 1) {
		header("Referrer-Policy: " . get_option('hh_referrer_policy_value'));
	}
}

function http_headers_admin_add_page() {
	add_options_page('HTTP Headers', 'HTTP Headers', 'manage_options', 'http-headers', 'http_headers_admin_page');
}

function http_headers_admin() {
	register_setting('http-headers-group', 'hh_x_frame_options');
	register_setting('http-headers-group', 'hh_x_frame_options_value');
	register_setting('http-headers-group', 'hh_x_frame_options_domain');
	register_setting('http-headers-group', 'hh_x_xxs_protection');
	register_setting('http-headers-group', 'hh_x_xxs_protection_value');
	register_setting('http-headers-group', 'hh_x_content_type_options');
	register_setting('http-headers-group', 'hh_x_content_type_options_value');
	register_setting('http-headers-group', 'hh_strict_transport_security');
	register_setting('http-headers-group', 'hh_strict_transport_security_value'); //obsolete
	register_setting('http-headers-group', 'hh_strict_transport_security_max_age');
	register_setting('http-headers-group', 'hh_strict_transport_security_sub_domains');
	register_setting('http-headers-group', 'hh_strict_transport_security_preload');
	register_setting('http-headers-group', 'hh_public_key_pins');
	register_setting('http-headers-group', 'hh_public_key_pins_sha256_1');
	register_setting('http-headers-group', 'hh_public_key_pins_sha256_2');
	register_setting('http-headers-group', 'hh_public_key_pins_max_age');
	register_setting('http-headers-group', 'hh_public_key_pins_sub_domains');
	register_setting('http-headers-group', 'hh_public_key_pins_report_uri');
	register_setting('http-headers-group', 'hh_x_ua_compatible');
	register_setting('http-headers-group', 'hh_x_ua_compatible_value');
	register_setting('http-headers-group', 'hh_p3p');
	register_setting('http-headers-group', 'hh_p3p_value');
	register_setting('http-headers-group', 'hh_referrer_policy');
	register_setting('http-headers-group', 'hh_referrer_policy_value');
	register_setting('http-headers-cors', 'hh_access_control_allow_origin');
	register_setting('http-headers-cors', 'hh_access_control_allow_origin_value');
	register_setting('http-headers-cors', 'hh_access_control_allow_origin_url');
	register_setting('http-headers-cors', 'hh_access_control_allow_credentials');
	register_setting('http-headers-cors', 'hh_access_control_allow_credentials_value');
	register_setting('http-headers-cors', 'hh_access_control_allow_methods');
	register_setting('http-headers-cors', 'hh_access_control_allow_methods_value');
	register_setting('http-headers-cors', 'hh_access_control_allow_headers');
	register_setting('http-headers-cors', 'hh_access_control_allow_headers_value');
	register_setting('http-headers-cors', 'hh_access_control_expose_headers');
	register_setting('http-headers-cors', 'hh_access_control_expose_headers_value');
	register_setting('http-headers-cors', 'hh_access_control_max_age');
	register_setting('http-headers-cors', 'hh_access_control_max_age_value');
}

function http_headers_enqueue($hook) {
    if ( 'http-headers.php' != $hook ) {
    	# FIXME
        //return;
    }

    wp_enqueue_script('http_headers_admin_scripts', plugin_dir_url( __FILE__ ) . 'assets/scripts.js');
    wp_enqueue_style('http_headers_admin_styles', plugin_dir_url( __FILE__ ) . 'assets/styles.css');
}


if ( is_admin() ){ // admin actions
	add_action('admin_menu', 'http_headers_admin_add_page');
	add_action('admin_init', 'http_headers_admin');
	add_action('admin_enqueue_scripts', 'http_headers_enqueue');
} else {
  // non-admin enqueues, actions, and filters
	add_action('send_headers', 'http_headers');
}

function http_headers_admin_page() {
	include 'views/admin.php';
}