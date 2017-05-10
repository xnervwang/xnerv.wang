<?php 
$bools = array(0 => 'Off', 1 => 'On');
?>
<div class="wrap">
	<h1>HTTP Headers</h1>

	<section class="hh-panel">
		<h2>Security Headers</h2>

		<form method="post" action="options.php">
		    <?php settings_fields( 'http-headers-group' ); ?>
		    <?php do_settings_sections( 'http-headers-group' ); ?>
		    <table class="form-table hh-table">
			<tbody>
		        <tr valign="top">
					<th scope="row">X-Frame-Options
						<p class="description">This header can be used to indicate whether or not a browser should be allowed to render a page in a &lt;frame&gt;, &lt;iframe&gt; or &lt;object&gt; . Use this to avoid clickjacking attacks.</p>
					</th>
					<td>
			       		<fieldset>
			        		<legend class="screen-reader-text">X-Frame-Options</legend>
				        <?php
				        $x_frame_options = get_option('hh_x_frame_options', 0);
				        foreach ($bools as $k => $v)
				        {
				        	?><p><label><input type="radio" class="http-header" name="hh_x_frame_options" value="<?php echo $k; ?>"<?php checked($x_frame_options, $k, true); ?> /> <?php echo $v; ?></label></p><?php
				        }
				        ?>
			        	</fieldset>
			        </td>
		        	<td>
		        		<select name="hh_x_frame_options_value" class="http-header-value"<?php disabled($x_frame_options, 0); ?>>
						<?php
						$items = array('deny', 'sameorigin', 'allow-from');
						$x_frame_options_value = get_option('hh_x_frame_options_value');
						foreach ($items as $item) {
							?><option value="<?php echo $item; ?>"<?php selected($x_frame_options_value, $item); ?>><?php echo $item; ?></option><?php
						}
						?>		
						</select>
						<input type="text" name="hh_x_frame_options_domain" placeholder="Domain" value="<?php echo esc_attr(get_option('hh_x_frame_options_domain')); ?>"<?php echo $x_frame_options == 1 && $x_frame_options_value == 'allow-from' ? NULL : ' disabled="disabled" style="display: none"'; ?> />
					</td>
		        </tr>
		         
		        <tr valign="top">
		        <th scope="row">X-XSS-Protection
		        	<p class="description">This header enables the Cross-site scripting (XSS) filter built into most recent web browsers. It's usually enabled by default anyway, so the role of this header is to re-enable the filter for this particular website if it was disabled by the user. </p>
		        </th>
		        <td>
		       		<fieldset>
		        		<legend class="screen-reader-text">X-XSS-Protection</legend>
			        <?php
			        $x_xxs_protection = get_option('hh_x_xxs_protection', 0);
			        foreach ($bools as $k => $v)
			        {
			        	?><p><label><input type="radio" class="http-header" name="hh_x_xxs_protection" value="<?php echo $k; ?>"<?php checked($x_xxs_protection, $k, true); ?> /> <?php echo $v; ?></label></p><?php
			        }
			        ?>
		        	</fieldset>
		        </td>
		        <td>
		        	<select name="hh_x_xxs_protection_value" class="http-header-value"<?php disabled($x_xxs_protection, 0); ?>>
					<?php
					$items = array('0', '1', '1; mode=block');
					$x_xxs_protection_value = get_option('hh_x_xxs_protection_value');
					foreach ($items as $item) {
						?><option value="<?php echo $item; ?>"<?php selected($x_xxs_protection_value, $item); ?>><?php echo $item; ?></option><?php
					}
					?>
					</select>
				</td>
		        </tr>
		        
		        <tr valign="top">
		        <th scope="row">X-Content-Type-Options
		        	<p class="description">Prevents Internet Explorer and Google Chrome from MIME-sniffing a response away from the declared content-type. This also applies to Google Chrome, when downloading extensions. This reduces exposure to drive-by download attacks and sites serving user uploaded content that, by clever naming, could be treated by MSIE as executable or dynamic HTML files.</p>
		        </th>
		        <td>
		       		<fieldset>
		        		<legend class="screen-reader-text">X-Content-Type-Options</legend>
			        <?php
			        $x_content_type_options = get_option('hh_x_content_type_options', 0);
			        foreach ($bools as $k => $v)
			        {
			        	?><p><label><input type="radio" class="http-header" name="hh_x_content_type_options" value="<?php echo $k; ?>"<?php checked($x_content_type_options, $k); ?> /> <?php echo $v; ?></label></p><?php
			        }
			        ?>
		        	</fieldset>
		        </td>
				<td>
					<select name="hh_x_content_type_options_value" class="http-header-value"<?php disabled($x_content_type_options, 0); ?>>
					<?php
					$items = array('nosniff');
					$x_content_type_options_value = get_option('hh_x_content_type_options_value');
					foreach ($items as $item) {
						?><option value="<?php echo $item; ?>"<?php selected($x_content_type_options_value, $item); ?>><?php echo $item; ?></option><?php
					}
					?>
					</select>
				</td>
		        </tr>
		
				<tr valign="top">
		        <th scope="row">Strict-Transport-Security
		        	<p class="description">HTTP Strict-Transport-Security (HSTS) enforces secure (HTTP over SSL/TLS) connections to the server. This reduces impact of bugs in web applications leaking session data through cookies and external links and defends against Man-in-the-middle attacks. HSTS also disables the ability for user's to ignore SSL negotiation warnings.</p>
		        </th>
		        <td>
		       		<fieldset>
		        		<legend class="screen-reader-text">Strict-Transport-Security</legend>
			        <?php
			        $strict_transport_security = get_option('hh_strict_transport_security', 0);
			        foreach ($bools as $k => $v)
			        {
			        	?><p><label><input type="radio" class="http-header" name="hh_strict_transport_security" value="<?php echo $k; ?>"<?php checked($strict_transport_security, $k, true); ?> /> <?php echo $v; ?></label></p><?php
			        }
			        ?>
		        	</fieldset>
		        </td>
				<td>
					<table>
						<tr>
							<td>max-age:</td>
							<td><select name="hh_strict_transport_security_max_age" class="http-header-value"<?php disabled($strict_transport_security, 0); ?>>
							<?php
							$items = array('0' => '0 (Delete entire HSTS Policy)', '3600' => '1 hour', '86400' => '1 day', '604800' => '7 days', '2592000' => '30 days', '5184000' => '60 days', '7776000' => '90 days', '31536000' => '1 year', '63072000' => '2 years');
							$strict_transport_security_max_age = get_option('hh_strict_transport_security_max_age');
							foreach ($items as $key => $item) {
								?><option value="<?php echo $key; ?>"<?php selected($strict_transport_security_max_age, $key); ?>><?php echo $item; ?></option><?php
							}
							?>
							</select></td>
						</tr>
						<tr>
							<td>includeSubDomains:</td>
							<td><input type="checkbox" class="http-header-value" name="hh_strict_transport_security_sub_domains" value="1"<?php checked(get_option('hh_strict_transport_security_sub_domains'), 1, true); ?><?php disabled($strict_transport_security, 0); ?> /></td>
						</tr>
						<tr>
							<td>preload:</td>
							<td><input type="checkbox" class="http-header-value" name="hh_strict_transport_security_preload" value="1"<?php checked(get_option('hh_strict_transport_security_preload'), 1, true); ?><?php disabled($strict_transport_security, 0); ?> /></td>
						</tr>
					</table>
				</td>
		        </tr>
		        
		        <tr valign="top">
		        <th scope="row">Public-Key-Pins
		        	<p class="description">HTTP Public Key Pinning (HPKP) is a security mechanism which allows HTTPS websites to resist impersonation by attackers using mis-issued or otherwise fraudulent certificates.</p>
		        </th>
		        <td>
		       		<fieldset>
		        		<legend class="screen-reader-text">Public-Key-Pins</legend>
			        <?php
			        $public_key_pins = get_option('hh_public_key_pins', 0);
			        foreach ($bools as $k => $v)
			        {
			        	?><p><label><input type="radio" class="http-header" name="hh_public_key_pins" value="<?php echo $k; ?>"<?php checked($public_key_pins, $k, true); ?> /> <?php echo $v; ?></label></p><?php
			        }
			        ?>
		        	</fieldset>
		        </td>
				<td>
					<table>
						<tr>
							<td>pin-sha256:</td>
							<td><input type="text" class="http-header-value" name="hh_public_key_pins_sha256_1" value="<?php echo esc_attr(get_option('hh_public_key_pins_sha256_1')); ?>" placeholder="d6qzRu9zOECb90Uez27xWltNsj0e1Md7GkYYkVoZWmM="<?php disabled($public_key_pins, 0); ?> /></td>
						</tr>
						<tr>
							<td>pin-sha256:<br>(backup key)</td>
							<td><input type="text" class="http-header-value" name="hh_public_key_pins_sha256_2" value="<?php echo esc_attr(get_option('hh_public_key_pins_sha256_2')); ?>" placeholder="E9CZ9INDbd+2eRQozYqqbQ2yXLVKB9+xcprMF+44U1g="<?php disabled($public_key_pins, 0); ?> /></td>
						</tr>
						<tr>
							<td>max-age:</td>
							<td><select class="http-header-value" name="hh_public_key_pins_max_age"<?php disabled($public_key_pins, 0); ?>>
							<?php 
							$items = array('3600' => '1 hour', '86400' => '1 day', '604800' => '7 days', '2592000' => '30 days', '5184000' => '60 days', '7776000' => '90 days', '31536000' => '1 year');
							$public_key_pins_max_age = get_option('hh_public_key_pins_max_age');
							foreach ($items as $key => $item) {
								?><option value="<?php echo $key; ?>"<?php selected($public_key_pins_max_age, $key); ?>><?php echo $item; ?></option><?php
							}
							?>
							</select></td>
						</tr>
						<tr>
							<td>includeSubDomains:</td>
							<td><input type="checkbox" class="http-header-value" name="hh_public_key_pins_sub_domains" value="1"<?php checked(get_option('hh_public_key_pins_sub_domains'), 1, true); ?><?php disabled($public_key_pins, 0); ?> /></td>
						</tr>
						<tr>
							<td>report-uri:</td>
							<td><input type="text" class="http-header-value" name="hh_public_key_pins_report_uri" value="<?php echo esc_attr(get_option('hh_public_key_pins_report_uri')); ?>" placeholder="http://example.com/pkp-report"<?php disabled($public_key_pins, 0); ?> /></td>
						</tr>
					</table>
				</td>
		        </tr>
		        
		        <tr valign="top">
		        <th scope="row">X-UA-Compatible
		        	<p class="description">In some cases, it might be necessary to restrict a webpage to a document mode supported by an older version of Windows Internet Explorer. Here we look at the x-ua-compatible header, which allows a webpage to be displayed as if it were viewed by an earlier version of the browser.</p>
		        </th>
		        <td>
		       		<fieldset>
		        		<legend class="screen-reader-text">X-UA-Compatible</legend>
			        <?php
			        $x_ua_compatible = get_option('hh_x_ua_compatible', 0);
			        foreach ($bools as $k => $v)
			        {
			        	?><p><label><input type="radio" class="http-header" name="hh_x_ua_compatible" value="<?php echo $k; ?>"<?php checked($x_ua_compatible, $k, true); ?> /> <?php echo $v; ?></label></p><?php
			        }
			        ?>
		        	</fieldset>
		        </td>
				<td>
					<select name="hh_x_ua_compatible_value" class="http-header-value"<?php disabled($x_ua_compatible, 0); ?>>
					<?php
					$items = array('IE=7', 'IE=8', 'IE=9', 'IE=10', 'IE=edge', 'IE=edge,chrome=1');
					$x_ua_compatible_value = get_option('hh_x_ua_compatible_value');
					foreach ($items as $item) {
						?><option value="<?php echo $item; ?>"<?php selected($x_ua_compatible_value, $item); ?>><?php echo $item; ?></option><?php
					}
					?>
					</select>
				</td>
		        </tr>
		        
		        <tr valign="top">
			        <th scope="row">P3P
			        	<p class="description">The Platform for Privacy Preferences Project (P3P) is a protocol allowing websites to declare their intended use of information they collect about web browser users.</p>
			        </th>
			        <td>
			       		<fieldset>
			        		<legend class="screen-reader-text">P3P</legend>
				        <?php
				        $p3p = get_option('hh_p3p', 0);
				        foreach ($bools as $k => $v)
				        {
				        	?><p><label><input type="radio" class="http-header" name="hh_p3p" value="<?php echo $k; ?>"<?php checked($p3p, $k); ?> /> <?php echo $v; ?></label></p><?php
				        }
				        ?>
			        	</fieldset>
			        </td>
					<td>
					<?php 
					$p3p_value = get_option('hh_p3p_value');
					if (!$p3p_value)
					{
						$p3p_value = array();
					}
					$in_creq = array('ADM', 'DEV', 'TAI', 'PSA', 'PSD', 'IVA', 'IVD', 'CON', 'HIS', 'TEL', 'OTP', 'DEL', 'SAM', 'UNR', 'PUB', 'OTR',);
					$creq = array('a', 'i', 'o');
					?>
					<table>
						<tbody>
							<tr>
								<td>Compact ACCESS</td>
								<td class="hh-td-inner">
									<table><tbody><tr><?php
									$items = array('NOI', 'ALL', 'CAO', 'IDC', 'OTI', 'NON');
									foreach ($items as $i => $item) {
										if ($i > 0 && $i % 4 === 0) {
											?></tr><tr><?php
										}
										?><td><label><input type="checkbox" class="http-header-value" name="hh_p3p_value[<?php echo $item; ?>]" value="1"<?php echo !array_key_exists($item, $p3p_value) ? NULL : ' checked="checked"'; ?><?php disabled($p3p, 0); ?> /> <?php echo $item; ?></label></td><?php
									}
									?></tr></tbody></table>
								</td>
							</tr>
							<tr>
								<td>Compact DISPUTES</td>
								<td class="hh-td-inner">
									<table><tbody><tr><?php
									$items = array('DSP');
									foreach ($items as $i => $item) {
										if ($i > 0 && $i % 4 === 0) {
											?></tr><tr><?php
										}
										?><td><label><input type="checkbox" class="http-header-value" name="hh_p3p_value[<?php echo $item; ?>]" value="1"<?php echo !array_key_exists($item, $p3p_value) ? NULL : ' checked="checked"'; ?><?php disabled($p3p, 0); ?> /> <?php echo $item; ?></label></td><?php
									}
									?></tr></tbody></table>
								</td>
							</tr>
							<tr>
								<td>Compact REMEDIES</td>
								<td class="hh-td-inner">
									<table><tbody><tr><?php
									$items = array('COR', 'MON', 'LAW');
									foreach ($items as $i => $item) {
										if ($i > 0 && $i % 4 === 0) {
											?></tr><tr><?php
										}
										?><td><label><input type="checkbox" class="http-header-value" name="hh_p3p_value[<?php echo $item; ?>]" value="1"<?php echo !array_key_exists($item, $p3p_value) ? NULL : ' checked="checked"'; ?><?php disabled($p3p, 0); ?> /> <?php echo $item; ?></label></td><?php
									}
									?></tr></tbody></table>
								</td>
							</tr>
							<tr>
								<td>Compact NON-IDENTIFIABLE</td>
								<td class="hh-td-inner">
									<table><tbody><tr><?php
									$items = array('NID');
									foreach ($items as $i => $item) {
										if ($i > 0 && $i % 4 === 0) {
											?></tr><tr><?php
										}
										?><td><label><input type="checkbox" class="http-header-value" name="hh_p3p_value[<?php echo $item; ?>]" value="1"<?php echo !array_key_exists($item, $p3p_value) ? NULL : ' checked="checked"'; ?><?php disabled($p3p, 0); ?> /> <?php echo $item; ?></label></td><?php
									}
									?></tr></tbody></table>
								</td>
							</tr>
							<tr>
								<td>Compact PURPOSE</td>
								<td class="hh-td-inner">
									<table><tbody><tr><?php
									$items = array('CUR', 'ADM', 'DEV', 'TAI', 'PSA', 'PSD', 'IVA', 'IVD', 'CON', 'HIS', 'TEL', 'OTP');
									foreach ($items as $i => $item) {
										if ($i > 0 && $i % 4 === 0) {
											?></tr><tr><?php
										}
										?><td><label><input type="checkbox" class="http-header-value" name="hh_p3p_value[<?php echo $item; ?>]" value="1"<?php echo !array_key_exists($item, $p3p_value) ? NULL : ' checked="checked"'; ?><?php disabled($p3p, 0); ?> /> <?php echo $item; ?></label></td><?php
									}
									?></tr></tbody></table>
								</td>
							</tr>
							<tr>
								<td>Compact RECIPIENT</td>
								<td class="hh-td-inner">
									<table><tbody><tr><?php
									$items = array('OUR', 'DEL', 'SAM', 'UNR', 'PUB', 'OTR');
									foreach ($items as $i => $item) {
										if ($i > 0 && $i % 4 === 0) {
											?></tr><tr><?php
										}
										?><td><label><input type="checkbox" class="http-header-value" name="hh_p3p_value[<?php echo $item; ?>]" value="1"<?php echo !array_key_exists($item, $p3p_value) ? NULL : ' checked="checked"'; ?><?php disabled($p3p, 0); ?> /> <?php echo $item; ?></label></td><?php
									}
									?></tr></tbody></table>
								</td>
							</tr>
							<tr>
								<td>Compact RETENTION</td>
								<td class="hh-td-inner">
									<table><tbody><tr><?php
									$items = array('NOR', 'STP', 'LEG', 'BUS', 'IND');
									foreach ($items as $i => $item) {
										if ($i > 0 && $i % 4 === 0) {
											?></tr><tr><?php
										}
										?><td><label><input type="checkbox" class="http-header-value" name="hh_p3p_value[<?php echo $item; ?>]" value="1"<?php echo !array_key_exists($item, $p3p_value) ? NULL : ' checked="checked"'; ?><?php disabled($p3p, 0); ?> /> <?php echo $item; ?></label></td><?php
									}
									?></tr></tbody></table>
								</td>
							</tr>
							<tr>
								<td>Compact CATEGORIES</td>
								<td class="hh-td-inner">
									<table><tbody><tr><?php
									$items = array('PHY', 'ONL', 'UNI', 'PUR', 'FIN', 'COM', 'NAV', 'INT', 'DEM', 'CNT', 'STA', 'POL', 'HEA', 'PRE', 'LOC', 'GOV', 'OTC');
									foreach ($items as $i => $item) {
										if ($i > 0 && $i % 4 === 0) {
											?></tr><tr><?php
										}
										?><td><label><input type="checkbox" class="http-header-value" name="hh_p3p_value[<?php echo $item; ?>]" value="1"<?php echo !array_key_exists($item, $p3p_value) ? NULL : ' checked="checked"'; ?><?php disabled($p3p, 0); ?> /> <?php echo $item; ?></label></td><?php
									}
									?></tr></tbody></table>
								</td>
							</tr>
							<tr>
								<td>Compact TEST</td>
								<td class="hh-td-inner">
									<table><tbody><tr><?php
									$items = array('TST');
									foreach ($items as $i => $item) {
										if ($i > 0 && $i % 4 === 0) {
											?></tr><tr><?php
										}
										?><td><label><input type="checkbox" class="http-header-value" name="hh_p3p_value[<?php echo $item; ?>]" value="1"<?php echo !array_key_exists($item, $p3p_value) ? NULL : ' checked="checked"'; ?><?php disabled($p3p, 0); ?> /> <?php echo $item; ?></label></td><?php
									}
									?></tr></tbody></table>
								</td>
							</tr>
						</tbody>
					</table>
					
					</td>
		        </tr>
		        
		        <tr valign="top">
					<th scope="row">Referrer-Policy
						<p class="description">The Referrer-Policy HTTP header governs which referrer information, sent in the Referer header, should be included with requests made.</p>
					</th>
					<td>
			       		<fieldset>
			        		<legend class="screen-reader-text">Referrer-Policy</legend>
				        <?php
				        $referrer_policy = get_option('hh_referrer_policy', 0);
				        foreach ($bools as $k => $v)
				        {
				        	?><p><label><input type="radio" class="http-header" name="hh_referrer_policy" value="<?php echo $k; ?>"<?php checked($referrer_policy, $k, true); ?> /> <?php echo $v; ?></label></p><?php
				        }
				        ?>
			        	</fieldset>
			        </td>
		        	<td>
		        		<select name="hh_referrer_policy_value" class="http-header-value"<?php disabled($referrer_policy, 0); ?>>
						<?php
						$items = array("", "no-referrer", "no-referrer-when-downgrade", "same-origin", "origin", "strict-origin", "origin-when-cross-origin", "strict-origin-when-cross-origin", "unsafe-url");
						$referrer_policy_value = get_option('hh_referrer_policy_value');
						foreach ($items as $item) {
							?><option value="<?php echo $item; ?>"<?php selected($referrer_policy_value, $item); ?>><?php echo !empty($item) ? $item : '(empty string)'; ?></option><?php
						}
						?>		
						</select>
					</td>
		        </tr>
				</tbody>
		    </table>
		    
		    <?php submit_button(); ?>
		
		</form>
	</section>
	
	<section class="hh-panel">
		<h2>Cross-domain headers</h2>

		<form method="post" action="options.php">
		    <?php settings_fields('http-headers-cors'); ?>
		    <?php do_settings_sections('http-headers-cors'); ?>
		    <table class="form-table hh-table">
			<tbody>
		        <tr>
			        <th scope="row">Access-Control-Allow-Origin
			        	<p class="description">The Access-Control-Allow-Origin header indicates whether a resource can be shared.</p>
			        </th>
			        <td>
			        	<fieldset>
			        		<legend class="screen-reader-text">Access-Control-Allow-Credentials</legend>
				        <?php
				        $access_control_allow_origin = get_option('hh_access_control_allow_origin', 0);
				        foreach ($bools as $k => $v)
				        {
				        	?><p><label><input type="radio" class="http-header" name="hh_access_control_allow_origin" value="<?php echo $k; ?>"<?php checked($access_control_allow_origin, $k); ?> /> <?php echo $v; ?></label></p><?php
				        }
				        ?>
			        	</fieldset>
			        </td>
					<td>
						<select name="hh_access_control_allow_origin_value" class="http-header-value"<?php disabled($access_control_allow_origin, 0); ?>>
						<?php
						$items = array('*', 'HTTP_ORIGIN', 'origin');
						$access_control_allow_origin_value = get_option('hh_access_control_allow_origin_value');
						foreach ($items as $item) {
							?><option value="<?php echo $item; ?>"<?php selected($access_control_allow_origin_value, $item); ?>><?php echo $item; ?></option><?php
						}
						?>
						</select>
						<input type="text" name="hh_access_control_allow_origin_url" placeholder="http://domain.com" value="<?php echo esc_attr(get_option('hh_access_control_allow_origin_url')); ?>"<?php echo $access_control_allow_origin == 1 && $access_control_allow_origin_value == 'origin' ? NULL : ' disabled="disabled" style="display: none"'; ?> />
					</td>
		        </tr>
		        
		        <tr>
			        <th scope="row">Access-Control-Allow-Credentials
			        	<p class="description">The Access-Control-Allow-Credentials header indicates whether the response to request can be exposed when the credentials flag is true.</p>
			        </th>
			        <td>
			        	<fieldset>
			        		<legend class="screen-reader-text">Access-Control-Allow-Credentials</legend>
				        <?php
				        $access_control_allow_credentials = get_option('hh_access_control_allow_credentials', 0);
				        foreach ($bools as $k => $v)
				        {
				        	?><p><label><input type="radio" class="http-header" name="hh_access_control_allow_credentials" value="<?php echo $k; ?>"<?php checked($access_control_allow_credentials, $k); ?> /> <?php echo $v; ?></label></p><?php
				        }
				        ?>
			        	</fieldset>
			        </td>
					<td>
						<select name="hh_access_control_allow_credentials_value" class="http-header-value"<?php disabled($access_control_allow_credentials, 0); ?>>
						<?php
						$items = array('true', 'false');
						$access_control_allow_credentials_value = get_option('hh_access_control_allow_credentials_value');
						foreach ($items as $item) {
							?><option value="<?php echo $item; ?>"<?php selected($access_control_allow_credentials_value, $item); ?>><?php echo $item; ?></option><?php
						}
						?>
						</select>
					</td>
		        </tr>
		        
		        <tr>
			        <th scope="row">Access-Control-Expose-Headers
			        	<p class="description">The Access-Control-Expose-Headers response header brings information about headers that browsers could allow accessing.</p>
			        </th>
			        <td>
			        	<fieldset>
			        		<legend class="screen-reader-text">Access-Control-Expose-Headers</legend>
				        <?php
				        $access_control_expose_headers = get_option('hh_access_control_expose_headers', 0);
				        foreach ($bools as $k => $v)
				        {
				        	?><p><label><input type="radio" class="http-header" name="hh_access_control_expose_headers" value="<?php echo $k; ?>"<?php checked($access_control_expose_headers, $k); ?> /> <?php echo $v; ?></label></p><?php
				        }
				        ?>
			        	</fieldset>
			        </td>
					<td>
					<table><tbody><tr>
					<?php
					$items = array('Accept', 'Accept-Charset', 'Accept-Encoding', 'Accept-Language', 'Accept-Datetime', 'Authorization', 'Cache-Control', 'Connection', 'Permanent', 'Cookie', 'Content-Length', 'Content-MD5', 'Content-Type', 'Date', 'Expect', 'Forwarded', 'From', 'Host', 'Permanent', 'If-Match', 'If-Modified-Since', 'If-None-Match', 'If-Range', 'If-Unmodified-Since', 'Max-Forwards', 'Origin', 'Pragma', 'Proxy-Authorization', 'Range', 'Referer', 'TE', 'User-Agent', 'Upgrade', 'Via', 'Warning', 'X-Requested-With', 'DNT', 'X-Forwarded-For', 'X-Forwarded-Host', 'X-Forwarded-Proto', 'Front-End-Https', 'X-Http-Method-Override', 'X-ATT-DeviceId', 'X-Wap-Profile', 'Proxy-Connection', 'X-UIDH', 'X-Csrf-Token', 'X-PINGOTHER');
					$access_control_expose_headers_value = get_option('hh_access_control_expose_headers_value');
					if (!$access_control_expose_headers_value)
					{
						$access_control_expose_headers_value = array();
					}
					foreach ($items as $i => $item) {
						if ($i % 3 === 0) {
							?></tr><tr><?php
												}
						?><td><label><input type="checkbox" class="http-header-value" name="hh_access_control_expose_headers_value[<?php echo $item; ?>]" value="1"<?php echo !array_key_exists($item, $access_control_expose_headers_value) ? NULL : ' checked="checked"'; ?><?php disabled($access_control_expose_headers, 0); ?> /> <?php echo $item; ?></label></td><?php
					}
					?>
					</tr></tbody></table>
					</td>
		        </tr>
		        
		        <tr>
			        <th scope="row">Access-Control-Max-Age
			        	<p class="description">The Access-Control-Max-Age header indicates how much time, the result of a preflight request, can be cached.</p>
			        </th>
			        <td>
			        	<fieldset>
			        		<legend class="screen-reader-text">Access-Control-Max-Age</legend>
				        <?php
				        $access_control_max_age = get_option('hh_access_control_max_age', 0);
				        foreach ($bools as $k => $v)
				        {
				        	?><p><label><input type="radio" class="http-header" name="hh_access_control_max_age" value="<?php echo $k; ?>"<?php checked($access_control_max_age, $k); ?> /> <?php echo $v; ?></label></p><?php
				        }
				        ?>
			        	</fieldset>
			        </td>
					<td>
						<input type="text" name="hh_access_control_max_age_value" class="http-header-value" value="<?php echo esc_attr(get_option('hh_access_control_max_age_value')); ?>"<?php disabled($access_control_max_age, 0); ?>>
					</td>
		        </tr>
		        
		        <tr>
			        <th scope="row">Access-Control-Allow-Methods
			        	<p class="description">The Access-Control-Allow-Methods header is returned by the server in a response to a preflight request and informs the browser about the HTTP methods that can be used in the actual request.</p>
			        </th>
			        <td>
			        	<fieldset>
			        		<legend class="screen-reader-text">Access-Control-Allow-Methods</legend>
				        <?php
				        $access_control_allow_methods = get_option('hh_access_control_allow_methods', 0);
				        foreach ($bools as $k => $v)
				        {
				        	?><p><label><input type="radio" class="http-header" name="hh_access_control_allow_methods" value="<?php echo $k; ?>"<?php checked($access_control_allow_methods, $k); ?> /> <?php echo $v; ?></label></p><?php
				        }
				        ?>
			        	</fieldset>
			        </td>
					<td>
					<?php
					$items = array('GET', 'POST', 'OPTIONS', 'HEAD', 'PUT', 'DELETE', 'TRACE', 'CONNECT', 'PATCH');
					$access_control_allow_methods_value = get_option('hh_access_control_allow_methods_value');
					if (!$access_control_allow_methods_value)
					{
						$access_control_allow_methods_value = array();
					}
					foreach ($items as $item)
					{
						?><p><label><input type="checkbox" class="http-header-value" name="hh_access_control_allow_methods_value[<?php echo $item; ?>]" value="1"<?php echo !array_key_exists($item, $access_control_allow_methods_value) ? NULL : ' checked="checked"'; ?><?php disabled($access_control_allow_methods, 0); ?> /> <?php echo $item; ?></label></p><?php
					}
					?>
					</td>
		        </tr>
		        
		        <tr>
			        <th scope="row">Access-Control-Allow-Headers
			        	<p class="description">The Access-Control-Allow-Headers header is returned by the server in a response to a preflight request and informs the browser about the HTTP headers that can be used in the actual request.</p>
			        </th>
			        <td>
			       		<fieldset>
			        		<legend class="screen-reader-text">Access-Control-Allow-Credentials</legend>
				        <?php
				        $access_control_allow_headers = get_option('hh_access_control_allow_headers', 0);
				        foreach ($bools as $k => $v)
				        {
				        	?><p><label><input type="radio" class="http-header" name="hh_access_control_allow_headers" value="<?php echo $k; ?>"<?php checked($access_control_allow_headers, $k); ?> /> <?php echo $v; ?></label></p><?php
				        }
				        ?>
			        	</fieldset>
			        </td>
					<td>
					<table><tbody><tr>
					<?php
					$items = array('Accept', 'Accept-Charset', 'Accept-Encoding', 'Accept-Language', 'Accept-Datetime', 'Authorization', 'Cache-Control', 'Connection', 'Permanent', 'Cookie', 'Content-Length', 'Content-MD5', 'Content-Type', 'Date', 'Expect', 'Forwarded', 'From', 'Host', 'Permanent', 'If-Match', 'If-Modified-Since', 'If-None-Match', 'If-Range', 'If-Unmodified-Since', 'Max-Forwards', 'Origin', 'Pragma', 'Proxy-Authorization', 'Range', 'Referer', 'TE', 'User-Agent', 'Upgrade', 'Via', 'Warning', 'X-Requested-With', 'DNT', 'X-Forwarded-For', 'X-Forwarded-Host', 'X-Forwarded-Proto', 'Front-End-Https', 'X-Http-Method-Override', 'X-ATT-DeviceId', 'X-Wap-Profile', 'Proxy-Connection', 'X-UIDH', 'X-Csrf-Token', 'X-PINGOTHER');
					$access_control_allow_headers_value = get_option('hh_access_control_allow_headers_value');
					if (!$access_control_allow_headers_value)
					{
						$access_control_allow_headers_value = array();
					}
					foreach ($items as $i => $item) {
						if ($i % 3 === 0) {
							?></tr><tr><?php
						}
						?><td><label><input type="checkbox" class="http-header-value" name="hh_access_control_allow_headers_value[<?php echo $item; ?>]" value="1"<?php echo !array_key_exists($item, $access_control_allow_headers_value) ? NULL : ' checked="checked"'; ?><?php disabled($access_control_allow_headers, 0); ?> /> <?php echo $item; ?></label></td><?php
					}
					?>
					</tr></tbody></table>
					</td>
		        </tr>
				</tbody>
		    </table>
		    
		    <?php submit_button(); ?>
		
		</form>
	</section>
</div>