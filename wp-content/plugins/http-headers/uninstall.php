<?php
// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

$options = array(
	'hh_x_frame_options',
	'hh_x_frame_options_value',
	'hh_x_frame_options_domain',
	'hh_x_xxs_protection',
	'hh_x_xxs_protection_value',
	'hh_x_content_type_options',
	'hh_x_content_type_options_value',
	'hh_strict_transport_security',
	'hh_strict_transport_security_value', //obsolete
	'hh_strict_transport_security_max_age',
	'hh_strict_transport_security_sub_domains',
	'hh_strict_transport_security_preload',
	'hh_public_key_pins',
	'hh_public_key_pins_sha256_1',
	'hh_public_key_pins_sha256_2',
	'hh_public_key_pins_max_age',
	'hh_public_key_pins_sub_domains',
	'hh_public_key_pins_report_uri',
	'hh_x_ua_compatible',
	'hh_x_ua_compatible_value',
	'hh_p3p',
	'hh_p3p_value',
	'hh_referrer_policy',
	'hh_referrer_policy_value',
	'hh_access_control_allow_origin',
	'hh_access_control_allow_origin_value',
	'hh_access_control_allow_origin_url',
	'hh_access_control_allow_credentials',
	'hh_access_control_allow_credentials_value',
	'hh_access_control_allow_methods',
	'hh_access_control_allow_methods_value',
	'hh_access_control_allow_headers',
	'hh_access_control_allow_headers_value',
	'hh_access_control_expose_headers',
	'hh_access_control_expose_headers_value',
	'hh_access_control_max_age',
	'hh_access_control_max_age_value',
);

foreach ($options as $option)
{
	delete_option( $option );
}