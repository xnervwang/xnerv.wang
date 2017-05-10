<?php
/*
Plugin Name: Multiple Domain Mapping on Single Site
Plugin URI:  https://wordpress.org/plugins/multiple-domain-mapping-on-single-site/
Description: Allows you to configure multiple domains to point to specific URLs in your blog or website. SEO: Different landingpages per domain.
Version:     0.1.2
Author:      Matthias Wagner
Author URI:  http://www.matthias-wagner.at
Text Domain: falke_mdm
Domain Path: /languages
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Multiple Domain Mapping on Single Site is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Multiple Domain Mapping on Single Site is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Multiple Domain Mapping on Single Site. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/


/*---------------------------------------------------------------------------------------------------------------------------
ROADMAP
+ Delete Mapping-Settings on Uninstall
+ Add German Translation
+ Attachment-Links / YOAST -> sometimes redirection loops, otherwise main domain redirection

~ Showcase (?)
~ Multiple Mappings per Domain, define Wildcard (Backward Compatibility?), Check with JS that no conflicts emerge
~ WooCommerce Compatibility?
~ Maybe add Punycode.js for convenient Umlaut-Input
~ Maybe re-enable JavaScript inputs for faster input of multiple Domains
---------------------------------------------------------------------------------------------------------------------------*/


/*---------------------------------------------------------------------------------------------------------------------------
 PLUGIN STARTUP
---------------------------------------------------------------------------------------------------------------------------*/

/**
 * fetch data from optionspage and populate $falke_mdm_domains and $falke_mdm_destinations arrays with it
 *
 * @since 0.0.1
 *
 */
$falke_mdm_settings_array = get_option('multidomainplugin_options');

$falke_mdm_domains = array();
$falke_mdm_destinations = array();
$falke_mdm_settings = array();
if($falke_mdm_settings_array != false){
	foreach($falke_mdm_settings_array as $key => $value){
		if(strpos($key, 'multidomainplugin_domain')===0){
			if($value != ''){
				$cnt = substr($key,24);
				$falke_mdm_domains[$cnt]=$value;
			}
		}else if(strpos($key, 'multidomainplugin_destination')===0){
			if($value != ''){
				$cnt = substr($key,29);
				
				if($falke_mdm_domains[$cnt]!=''){
					$falke_mdm_destinations[$cnt]=$value;
				}
			}
		}
	}
}

$falke_mdm_settings_tab2_array = get_option('multidomainplugin_tabsettings');
//falke_mdm_debug_dump($falke_mdm_settings_tab2_array, "md settingsarray");
$falke_mdm_tab2 = array();

if($falke_mdm_settings_tab2_array != false){
	foreach($falke_mdm_settings_tab2_array as $key => $value){
		//falke_mdm_debug_dump($key, "key");
		if($value != ''){
			$falke_mdm_tab2[$key] = $value;
		}
	}
}


/*---------------------------------------------------------------------------------------------------------------------------
URL operations
---------------------------------------------------------------------------------------------------------------------------*/

/**
 * checks if URL contains a Path from $falke_mdm_destinations, if so changes domain
 *
 * @since 0.0.1
 *
 * @global $falke_mdm_domains;
 * @global $falke_mdm_destinations
 *
 * @param string $old_url. the URL to check for matching Path	 
 * @return string
 *
 */
function falke_mdm_replace_landingurl($old_url){
	global $falke_mdm_domains;
	global $falke_mdm_destinations;
	$new_url = $old_url;
	$old_prot = substr( $old_url, 0, strpos( $old_url, '//' )+2);
	$old_domain_noprot = substr( $old_url, strpos( $old_url, '//' )+2);
	$old_domain = substr($old_domain_noprot, 0, strpos( $old_domain_noprot, '/' ));
	$old_uri = substr($old_domain_noprot, strpos( $old_domain_noprot, '/' ));
	
	foreach($falke_mdm_domains as $key => $val){
		if($falke_mdm_destinations[$key]){
			$pos = strpos($old_uri,$falke_mdm_destinations[$key]);
			if($pos !== false){
				//falke_mdm_debug_dump($pos,"pos");
				//falke_mdm_debug_dump(strlen($falke_mdm_destinations[$key]),"length");
				if(substr($old_uri,$pos+strlen($falke_mdm_destinations[$key]),1) == '/' || substr($old_uri,$pos+strlen($falke_mdm_destinations[$key]),1) == false){
					falke_mdm_debug_dump($falke_mdm_destinations[$key],"key");
					falke_mdm_debug_dump($old_uri,"olduri");
					falke_mdm_debug_dump($val,"val");
					falke_mdm_debug_dump(substr($old_uri,strpos($old_uri,$falke_mdm_destinations[$key])+strlen($falke_mdm_destinations[$key])),'+ this');
					$new_url = $val . substr($old_uri,strpos($old_uri,$falke_mdm_destinations[$key])+strlen($falke_mdm_destinations[$key]));
					
				}
			}
		}
	}
	falke_mdm_debug_dump($new_url,"new_url");
	return $new_url;	
}

/**
 * alters a request to a landingpage, to show the right content
 *
 * hooks into do_parse_request, checks for matching landingpagedomains and alters the $_SERVER['REQUEST_URI']
 * variable.
 *
 * @global $falke_mdm_domains;
 * @global $falke_mdm_destinations
 *
 * @since 0.0.1
 *
 * @see parse_request
 */
function falke_mdm_parse_request($parse, $instance, $extra_query_vars){
	global $falke_mdm_domains;
	global $falke_mdm_destinations;
	global $falke_mdm_tab2;
	
	//check if the compatibility option is set
	falke_mdm_debug_dump($falke_mdm_tab2["server_variable"], 'server-variable');
	if($falke_mdm_tab2["server_variable"] === "HTTP_HOST"){
		$domain = untrailingslashit(esc_url($_SERVER['HTTP_HOST']));
	}else{
		$domain = untrailingslashit(esc_url($_SERVER['SERVER_NAME']));
	}
	falke_mdm_debug_dump($domain, "domain");
	falke_mdm_debug_dump($_SERVER['REQUEST_URI'], "request uri");
	falke_mdm_debug_dump($landingpages, "landingp");
	
	if(in_array($domain, $falke_mdm_domains)){
		$pos = array_search($domain, $falke_mdm_domains);
		$_SERVER['REQUEST_URI'] = "/".trim($falke_mdm_destinations[$pos], "/").$_SERVER['REQUEST_URI'];
		
		//falke_mdm_debug_dump($_SERVER['REQUEST_URI'], "request uri changed");
	}
	//falke_mdm_debug_dump($domain,"domain");
	return $parse;
}
add_filter('do_parse_request','falke_mdm_parse_request',10, 3);


/*---------------------------------------------------------------------------------------------------------------------------
change various links in the page
---------------------------------------------------------------------------------------------------------------------------*/

/**
 * hooks into Menu generation, calls falke_mdm_replace_landingurl() for each URL
 *
 * @since 0.0.1
 * 
 * @see falke_mdm_replace_landingurl()
 *
 * @param array $items. the menu items
 * @return array $items. the menu items with changed URLs
 */
function falke_mdm_change_menu($items){
	foreach($items as $item){
		$item->url = falke_mdm_replace_landingurl($item->url);
	}
 	return $items;
}
add_filter('wp_nav_menu_objects', 'falke_mdm_change_menu');


/** 
 * filters various links (https://codex.wordpress.org/Plugin_API/Filter_Reference#Link_Filters)
 * calls falke_mdm_replace_landingurl() for each link
 *
 * @since 0.1.2
 *
 * @see get_permalink
 * 
**/
function falke_mdm_change_nav_link($permalink){
	return falke_mdm_replace_landingurl($permalink);
}
add_filter('attachment_link', 'falke_mdm_change_nav_link', 20);
add_filter('author_feed_link', 'falke_mdm_change_nav_link', 10);
add_filter('author_link', 'falke_mdm_change_nav_link', 10);
//get_comment_author_link 
//get_comment_author_url_link 
//comment_reply_link 				left out -> no change found out in testing
add_filter('day_link', 'falke_mdm_change_nav_link', 20);
add_filter('feed_link', 'falke_mdm_change_nav_link', 20);
add_filter('paginate_links', 'falke_mdm_change_nav_link', 10);
add_filter('post_link', 'falke_mdm_change_nav_link', 20);
add_filter('page_link', 'falke_mdm_change_nav_link', 20);
add_filter('post_type_link', 'falke_mdm_change_nav_link', 20);
add_filter('term_link', 'falke_mdm_change_nav_link', 10);
add_filter('month_link', 'falke_mdm_change_nav_link', 20);
add_filter('year_link', 'falke_mdm_change_nav_link', 20);


/*---------------------------------------------------------------------------------------------------------------------------
YOAST SEO CIMPATIBILITY
---------------------------------------------------------------------------------------------------------------------------*/
/** define the wpseo_sitemap_entry callback 
*	the $url at this point is already altered (the filter is used after falke_mdm_change_postnav_link)"
**/
function falke_mdm_xml_sitemap_post_url( $url, $post ) { 
	// add home url to the posturl, so YOAST will not handle the post like an external url
	$url = get_home_url() .'/\\'. falke_mdm_replace_landingurl($url);
	return $url;
}
add_filter('wpseo_xml_sitemap_post_url', 'falke_mdm_xml_sitemap_post_url', 0, 2);

function falke_mdm_filter_wpseo_sitemap_entry($url, $type, $post){
	if($type === 'post'){
		if(false !== strpos($url['loc'],'\\')){
			$tmp = explode('\\', $url['loc']);
			$url['loc'] = $tmp[1];
		}
	}
	return $url;
}
add_filter( 'wpseo_sitemap_entry', 'falke_mdm_filter_wpseo_sitemap_entry', 10, 3 );


/*---------------------------------------------------------------------------------------------------------------------------
 BACKEND STUFF
---------------------------------------------------------------------------------------------------------------------------*/

/**
 * create custom plugin settings menu
 *
 *@since 0.0.1
 *
 */
function falke_mdm_create_menu() {
	//create new top-level menu
	add_submenu_page('tools.php', 'Multiple Domain Mapping', 'Multidomain', 'administrator', __FILE__, 'falke_mdm_settings_page');
}
add_action('admin_menu', 'falke_mdm_create_menu');

/**
 * registers the settings
 *
 * @since 0.0.1
 *
 */
function falke_mdm_register_settings() {
	register_setting('multidomainplugin_options', 'multidomainplugin_options', 'falke_mdm_sanitize_setting');
	register_setting('multidomainplugin_tabsettings', 'multidomainplugin_tabsettings','falke_mdm_sanitize_tabsetting');
}
add_action( 'admin_init', 'falke_mdm_register_settings');

/**
 * sanitizes mappinginputs (tab1)
 *
 * @since 0.0.1
 *
 */
function falke_mdm_sanitize_setting($multidomainplugin_options) {  
	$new_input = array();
	foreach($multidomainplugin_options as $key => $value){
		if( isset( $multidomainplugin_options[$key] ) ){
			if(strpos($key, 'multidomainplugin_destination')===0 && strpos($value, '/')!==0){
					$value = "/".$value;
			}
			$new_input[$key] = untrailingslashit(esc_url(sanitize_text_field( $value )));
		}
	}
	return $new_input;
}

/**
 * sanitizes settinginputs (tab2)
 *
 * @since 0.0.1
 *
 */
function falke_mdm_sanitize_tabsetting($multidomainplugin_tabsettings) {  
	$new_input = array();
	foreach($multidomainplugin_tabsettings as $key => $value){
		if( isset( $multidomainplugin_tabsettings[$key] ) ){
			if($key === 'server_variable'){
				if($value === "SERVER_NAME" || $value === "HTTP_HOST"){
					$new_input[$key] = $value;
				}else{
					$new_input[$key] = "SERVER_NAME";
				}
			}
		}
	}
	falke_mdm_debug_dump($new_input,"newinput");
	return $new_input;
}

/**
 * generates the markup for the main_section
 *
 * @global $falke_mdm_domains;
 * @global $falke_mdm_destinations
 * @since 0.0.1
 *
 */
function falke_mdm_mapping_input() {
	global $falke_mdm_domains;
	global $falke_mdm_destinations;

	echo '<table border="0"><tr>';
		echo '<th>'.__('used domain', 'falke_mdm').'</th>';
		echo '<th></th>';
		echo '<th>'.__('original URI', 'falke_mdm').'</th>';
	echo "</tr>";

	$i = 0;
	foreach($falke_mdm_domains as $k => $v){
		if($v != ''){
			echo '<tr>';
			$tmpdom = $v;
			echo '<td><input style="width: 300px;" name="multidomainplugin_options[multidomainplugin_domain'.$k.']" type="text" value="'.$tmpdom.'" /></input></td>';
			echo '<td> <=> '.get_site_url().'</td>';
			if($falke_mdm_destinations[$k] !=''){
				$tmpdest = $falke_mdm_destinations[$k];
				echo '<td><input style="width: 300px;" name="multidomainplugin_options[multidomainplugin_destination'.$k.']" type="text" value="'.$tmpdest.'" /></input></td>';
			}
			echo '</tr>';
		}
		$i=$k+1;
	}
	echo '<tr>';
		echo '<td><input style="width: 300px;" name="multidomainplugin_options[multidomainplugin_domain'.$i.']" type="text" placeholder="'.__('http://www.example.com', 'falke_mdm').'" /></input></td>';
		echo '<td> <=> '.get_site_url().'</td>';
		echo '<td><input style="width: 300px;" name="multidomainplugin_options[multidomainplugin_destination'.$i.']" type="text" placeholder="'.__('/examplepage', 'falke_mdm').'" /></input></td>';
	echo '</tr></table>';
}

/**
 * generates the markup for the settings_section
 *
 * @global $falke_mdm_domains;
 * @global $falke_mdm_destinations
 * @since 0.0.1
 *
 */
function falke_mdm_settings_input() {
	global $falke_mdm_tab2;

	echo sprintf('<p><strong>%s: </strong>%s <a target="_blank" href="https://wordpress.org/support/topic/server_name-instead-of-http_host/">%s</a>.</p>',
		__('PHP SERVER-Variable', 'falke_mdm'),
		__('In some cases it is necessary to change the used variable, like reported', 'falke_mdm'),
		__('in this support-thread')
	);

	?>
	<div class="falke_mdm_input_wrap">
		<input id="falke_mdm_server_variable_1" name="multidomainplugin_tabsettings[server_variable]" type="radio" value="SERVER_NAME" <?php checked("SERVER_NAME", $falke_mdm_tab2["server_variable"]); checked("", $falke_mdm_tab2["server_variable"]); ?>/>
		<label for="falke_mdm_server_variable_1"><?php _e('$_SERVER["SERVER_NAME"] (default)', 'falke_mdm'); ?></label></br>
		<input id="falke_mdm_server_variable_2" name="multidomainplugin_tabsettings[server_variable]" type="radio" value="HTTP_HOST" <?php checked("HTTP_HOST", $falke_mdm_tab2["server_variable"]); ?>/>
		<label for="falke_mdm_server_variable_2"><?php _e('$_SERVER["HTTP_HOST"]', 'falke_mdm'); ?></label>
	</div>
<?php
}

/**
 * generates the markup for the Optionspage
 *
 * @since 0.0.1
 *
 */
function falke_mdm_settings_page() {

	//flush permalink structure on save
	if( isset($_GET['settings-updated'])){
		flush_rewrite_rules();
		falke_mdm_debug_dump($_GET['settings-updated'], 'flushed');
	}
	if( isset( $_GET[ 'tab' ] ) ) {
		$falke_mdm_active_tab = $_GET[ 'tab' ];
	}else{
		$falke_mdm_active_tab = 'mapping';
	}

	?>
	<h1><?php echo get_admin_page_title(); ?></h1>
	<h2 class="nav-tab-wrapper">
		<a href="<?php echo $_SERVER['REQUEST_URI']; ?>&amp;tab=mapping" class="nav-tab <?php echo $falke_mdm_active_tab == 'mapping' ? 'nav-tab-active ' : ''; ?>"><?php _e('Mappings', 'falke_mdm') ?></a>
		<a href="<?php echo $_SERVER['REQUEST_URI']; ?>&amp;tab=settings" class="nav-tab <?php echo $falke_mdm_active_tab == 'settings' ? 'nav-tab-active ' : ''; ?>"><?php _e('Settings', 'falke_mdm') ?></a>
	</h2>

	<form method="post" action="options.php">
	<?php
		if( $falke_mdm_active_tab == 'mapping' ) {
			add_settings_section('main_section', __('Define your mappings here:', 'falke_mdm'), 'falke_mdm_mapping_input', __FILE__);
			settings_fields( 'multidomainplugin_options' );
	
			echo sprintf('<p>%s <a href="https://wordpress.org/plugins/multiple-domain-mapping-on-single-site/installation/" target="_blank">%s</a>, <a href="https://wordpress.org/plugins/multiple-domain-mapping-on-single-site/faq/" target="_blank">%s</a> and <a href="https://wordpress.org/plugins/multiple-domain-mapping-on-single-site/screenshots/" target="_blank">%s</a>.</p>',
				__('Note: This plugin requires some important settings in your domains DNS entries and your hosting environment, it will not work "out-of-the-box". Please refer to the plugins', 'falke_mdm'),
				__('installation description', 'falke_mdm'),
				__('FAQ', 'falke_mdm'),
				__('demo settings', 'falke_mdm')
			);

			echo sprintf('<p>%s</p>',
				__('Note: Always declare more general URLs before more specific ones. For example, put "/examplesite" higher in the list than "/examplesite/examplearticle".', 'falke_mdm')
			);

			do_settings_sections( __FILE__ );
			submit_button();
					
		}else if($falke_mdm_active_tab == 'settings'){
			add_settings_section('settings_section', __('Choose your settings:', 'falke_mdm'), 'falke_mdm_settings_input', __FILE__);
			settings_fields( 'multidomainplugin_tabsettings' );
			do_settings_sections( __FILE__ );
			submit_button();
		}			
	?>
	</form>
	<?php
}


/*---------------------------------------------------------------------------------------------------------------------------
  DEBUG AND OTHER STUFF
---------------------------------------------------------------------------------------------------------------------------*/

/** 
 * prints debug output, without damaging the html
 * only used in development, otherwise returns true
 *
 * @since 0.0.1
 *
 * @param $var the variable to print
 * @param $name the name to print
 * 
 **/
function falke_mdm_debug_dump($var, $name = "") {

	return true;

	echo '<div style="background-color:#fff;color:#aaa;border:1px solid #f00; margin:15px; padding:5px;">';
	echo '<span style="color:#000">DEBUG: '. $name .'</span><pre>';
	var_dump($var);
	echo '</pre></div>';
}
?>