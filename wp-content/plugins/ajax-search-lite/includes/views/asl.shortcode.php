<?php
    $id = self::$instanceCount;
    $real_id = self::$instanceCount;

    if ( isset($style['_fo']) && !isset($style['_fo']['categoryset']) )
        $style['_fo']['categoryset'] = array();
?>
<div id='ajaxsearchlite<?php echo self::$instanceCount; ?>' class="wpdreams_asl_container">
<div class="probox">

    <?php do_action('asl_layout_before_magnifier', $id); ?>

    <div class='promagnifier'>
        <?php do_action('asl_layout_in_magnifier', $id); ?>
        <div class='innericon'>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
                <path id="magnifier-2-icon" d="M460.355,421.59L353.844,315.078c20.041-27.553,31.885-61.437,31.885-98.037
                    C385.729,124.934,310.793,50,218.686,50C126.58,50,51.645,124.934,51.645,217.041c0,92.106,74.936,167.041,167.041,167.041
                    c34.912,0,67.352-10.773,94.184-29.158L419.945,462L460.355,421.59z M100.631,217.041c0-65.096,52.959-118.056,118.055-118.056
                    c65.098,0,118.057,52.959,118.057,118.056c0,65.096-52.959,118.056-118.057,118.056C153.59,335.097,100.631,282.137,100.631,217.041
                    z"/>
            </svg>
        </div>
    </div>

    <?php do_action('asl_layout_after_magnifier', $id); ?>

    <?php do_action('asl_layout_before_settings', $id); ?>

    <div class='prosettings' <?php echo($settingsHidden ? "style='display:none;'" : ""); ?> data-opened=0>
        <?php do_action('asl_layout_in_settings', $id); ?>
        <div class='innericon'>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
                <polygon id="arrow-25-icon" transform = "rotate(90 256 256)" points="142.332,104.886 197.48,50 402.5,256 197.48,462 142.332,407.113 292.727,256 "/>
            </svg>
        </div>
    </div>

    <?php do_action('asl_layout_after_settings', $id); ?>

    <?php do_action('asl_layout_before_input', $id); ?>

    <div class='proinput'>
        <form autocomplete="off">
            <input type='search' class='orig' name='phrase' placeholder='<?php echo asl_icl_t( "Search bar placeholder text", w_isset_def($style['defaultsearchtext'], '') ); ?>' value='<?php echo get_search_query(); ?>' autocomplete="off"/>
            <input type='text' class='autocomplete' name='phrase' value='' autocomplete="off"/>
            <span class='loading'></span>
            <input type='submit' style='width:0; height: 0; visibility: hidden;'>
        </form>
    </div>

    <?php do_action('asl_layout_after_input', $id); ?>

    <?php do_action('asl_layout_before_loading', $id); ?>

    <div class='proloading'>

        <div class="asl_loader"><div class="asl_loader-inner asl_simple-circle"></div></div>

        <?php do_action('asl_layout_in_loading', $id); ?>
    </div>

    <?php if ($style['show_close_icon']): ?>
        <div class='proclose'>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                 y="0px"
                 width="512px" height="512px" viewBox="0 0 512 512" enable-background="new 0 0 512 512"
                 xml:space="preserve">
            <polygon id="x-mark-icon"
                     points="438.393,374.595 319.757,255.977 438.378,137.348 374.595,73.607 255.995,192.225 137.375,73.622 73.607,137.352 192.246,255.983 73.622,374.625 137.352,438.393 256.002,319.734 374.652,438.378 "/>
        </svg>
        </div>
    <?php endif; ?>

    <?php do_action('asl_layout_after_loading', $id); ?>

</div>
</div>

<?php
// Search redirection, memorize general options
if ( isset($style['_fo']) ) {
    $_checked = array(
        "set_exactonly" => isset($style['_fo']["set_exactonly"]) ? ' checked="checked"' : "",
        "set_intitle" => isset($style['_fo']["set_intitle"]) ? ' checked="checked"' : "",
        "set_incontent" => isset($style['_fo']["set_incontent"]) ? ' checked="checked"' : "",
        "set_inexcerpt" => isset($style['_fo']["set_inexcerpt"]) ? ' checked="checked"' : "",
        "set_inposts" => isset($style['_fo']["set_inposts"]) ? ' checked="checked"' : "",
        "set_inpages" => isset($style['_fo']["set_inpages"]) ? ' checked="checked"' : "",
    );
} else {
    $_checked = array(
        "set_exactonly" => $style['exactonly'] == 1 ? ' checked="checked"' : "",
        "set_intitle" => $style['searchintitle'] == 1 ? ' checked="checked"' : "",
        "set_incontent" => $style['searchincontent'] == 1 ? ' checked="checked"' : "",
        "set_inexcerpt" => $style['searchinexcerpt'] == 1 ? ' checked="checked"' : "",
        "set_inposts" => $style['searchinposts'] == 1 ? ' checked="checked"' : "",
        "set_inpages" => $style['searchinpages'] == 1 ? ' checked="checked"' : "",
    );
}

if ( function_exists('qtranxf_getLanguage') ) {
    $qtr_lg = qtranxf_getLanguage();
} else if ( function_exists('qtrans_getLanguage') ) {
    $qtr_lg = qtrans_getLanguage();
} else {
    $qtr_lg = 0;
}
?>

<div id='ajaxsearchlitesettings<?php echo $id; ?>' class="searchsettings wpdreams_asl_settings">
    <form name='options' autocomplete='off'>

        <?php do_action('asl_layout_in_form', $id); ?>

        <?php do_action('asl_layout_settings_before_first_item', $id); ?>
        <fieldset class="asl_sett_scroll">
            <div class="option hiddend">
                <input type='hidden' name='qtranslate_lang' id='qtranslate_lang'
                       value='<?php echo $qtr_lg; ?>'/>
            </div>

	        <?php if (defined('ICL_LANGUAGE_CODE')
	                  && ICL_LANGUAGE_CODE != ''
	                  && defined('ICL_SITEPRESS_VERSION')
	        ): ?>
		        <div class="option hiddend">
			        <input type='hidden' name='wpml_lang'
			               value='<?php echo ICL_LANGUAGE_CODE; ?>'/>
		        </div>
	        <?php endif; ?>

            <?php if ( function_exists("pll_current_language") ): ?>
                <div class="option hiddend">
                    <input type='hidden' name='polylang_lang'
                           value='<?php echo pll_current_language(); ?>'/>
                </div>
            <?php endif; ?>

            <div class="asl_option<?php echo(($style['showexactmatches'] != 1) ? " hiddend" : ""); ?>">
                <div class="option">
                    <input type="checkbox" value="checked" id="set_exactonly<?php echo $id; ?>"
                           name="set_exactonly" <?php echo $_checked["set_exactonly"]; ?>/>
                    <label for="set_exactonly<?php echo $id; ?>"></label>
                </div>
                <div class="label">
                    <?php echo asl_icl_t('Exact matches filter', $style['exactmatchestext']); ?>
                </div>
            </div>
            <div class="asl_option<?php echo(($style['showsearchintitle'] != 1) ? " hiddend" : ""); ?>">
                <div class="option">
                    <input type="checkbox" value="None" id="set_intitle<?php echo $id; ?>"
                           name="set_intitle" <?php echo $_checked["set_intitle"]; ?>/>
                    <label for="set_intitle<?php echo $id; ?>"></label>
                </div>
                <div class="label">
                    <?php echo asl_icl_t('Search in title filter', $style['searchintitletext']); ?>
                </div>
            </div>
            <div class="asl_option<?php echo(($style['showsearchincontent'] != 1) ? " hiddend" : ""); ?>">
                <div class="option">
                    <input type="checkbox" value="None" id="set_incontent<?php echo $id; ?>"
                           name="set_incontent" <?php echo $_checked["set_incontent"]; ?>/>
                    <label for="set_incontent<?php echo $id; ?>"></label>
                </div>
                <div class="label">
                    <?php echo asl_icl_t('Search in content filter', $style['searchincontenttext']); ?>
                </div>
            </div>
            <div class="option hiddend">
                <input type="checkbox" value="None" id="set_inexcerpt<?php echo $id; ?>"
                       name="set_inexcerpt" <?php echo $_checked["set_inexcerpt"]; ?>/>
                <label for="set_inexcerpt<?php echo $id; ?>"></label>
            </div>

            <div class="asl_option<?php echo(($style['showsearchinposts'] != 1) ? " hiddend" : ""); ?>">
                <div class="option">
                    <input type="checkbox" value="None" id="set_inposts<?php echo $id; ?>"
                           name="set_inposts" <?php echo $_checked["set_inposts"]; ?>/>
                    <label for="set_inposts<?php echo $id; ?>"></label>
                </div>
                <div class="label">
                    <?php echo asl_icl_t('Search in posts filter', $style['searchinpoststext']); ?>
                </div>
            </div>
            <div class="asl_option<?php echo(($style['showsearchinpages'] != 1) ? " hiddend" : ""); ?>">
                <div class="option">
                    <input type="checkbox" value="None" id="set_inpages<?php echo $id; ?>"
                           name="set_inpages" <?php echo $_checked["set_inpages"]; ?>/>
                    <label for="set_inpages<?php echo $id; ?>"></label>
                </div>
                <div class="label">
                    <?php echo asl_icl_t('Search in pages filter', $style['searchinpagestext']); ?>
                </div>
            </div>
            <?php

            $types = get_post_types(array(
                '_builtin' => false
            ));
            $i = 1;
            if (!isset($style['selected-customtypes']) || !is_array($style['selected-customtypes']))
                $style['selected-customtypes'] = array();
            if (!isset($style['selected-showcustomtypes']) || !is_array($style['selected-showcustomtypes']))
                $style['selected-showcustomtypes'] = array();
            $flat_show_customtypes = array();

            foreach ($style['selected-showcustomtypes'] as $k => $v) {
                $selected = in_array($v[0], $style['selected-customtypes']);
                $hidden = "";
                $flat_show_customtypes[] = $v[0];
                ?>
                <div class="asl_option">
                    <div class="option">
                        <input type="checkbox" value="<?php echo $v[0]; ?>"
                               id="<?php echo $id; ?>customset_<?php echo $id . $i; ?>"
                               name="customset[]" <?php echo(($selected) ? 'checked="checked"' : ''); ?>/>
                        <label for="<?php echo $id; ?>customset_<?php echo $id . $i; ?>"></label>
                    </div>
                    <div class="label">
                        <?php echo asl_icl_t('Search filter for post type: ' . $v[1], $v[1]); ?>
                    </div>
                </div>
                <?php
                $i++;
            }
            ?>
        </fieldset>
        <?php
        $hidden_types = array();
        $hidden_types = array_diff($style['selected-customtypes'], $flat_show_customtypes);

        foreach ($hidden_types as $k => $v) {
            ?>
            <div class="option hiddend">
                <input type="checkbox" value="<?php echo $v; ?>"
                       id="<?php echo $id; ?>customset_<?php echo $id . $i; ?>"
                       name="customset[]" checked="checked"/>
                <label for="<?php echo $id; ?>customset_<?php echo $id . $i; ?>"></label>
            </div>
            <div class="label hiddend"></div>

            <?php
            $i++;
        }
        ?>
        <?php
        /* Category and term filters */
        if ($style['showsearchincategories']) {
        ?>

        <fieldset>
            <?php if ($style['exsearchincategoriestext'] != ""): ?>
                <legend><?php echo asl_icl_t("Categories filter box text", $style['exsearchincategoriestext']); ?></legend>
            <?php endif; ?>
            <div class='categoryfilter asl_sett_scroll'>
                <?php

                /* Categories */
                if (!isset($style['selected-exsearchincategories']) || !is_array($style['selected-exsearchincategories']))
                    $style['selected-exsearchincategories'] = array();
                if (!isset($style['selected-excludecategories']) || !is_array($style['selected-excludecategories']))
                    $style['selected-excludecategories'] = array();
                $_all_cat = get_terms('category', array('fields'=>'ids'));
                $_needed_cat = array_diff($_all_cat, $style['selected-exsearchincategories']);
                foreach ($_needed_cat as $k => $v) {
                    if ( isset($style['_fo']) )
                        $selected = in_array( $v, $style['_fo']['categoryset'] );
                    else
                        $selected = ! in_array( $v, $style['selected-excludecategories'] );
                    $cat = get_category($v);
                    $val = $cat->name;
                    $hidden = (($style['showsearchincategories']) == 0 ? " hiddend" : "");
                    if ($style['showuncategorised'] == 0 && $v == 1) {
                        $hidden = ' hiddend';
                    }
                    ?>
                    <div class="asl_option<?php echo $hidden; ?>">
                        <div class="option">
                            <input type="checkbox" value="<?php echo $v; ?>"
                                   id="<?php echo $id; ?>categoryset_<?php echo $v; ?>"
                                   name="categoryset[]" <?php echo(($selected) ? 'checked="checked"' : ''); ?>/>
                            <label for="<?php echo $id; ?>categoryset_<?php echo $v; ?>"></label>
                        </div>
                        <div class="label">
                            <?php echo asl_icl_t('Search filter for category: ' . $val, $val); ?>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </fieldset>
        <?php
        }
        ?>
    </form>
</div>

<div id='ajaxsearchliteres<?php echo $id; ?>' class='<?php echo $style['resultstype']; ?> wpdreams_asl_results'>

    <?php do_action('asl_layout_before_results', $id); ?>

    <div class="results">

        <?php do_action('asl_layout_before_first_result', $id); ?>

            <div class="resdrg">
            </div>

        <?php do_action('asl_layout_after_last_result', $id); ?>

    </div>

    <?php do_action('asl_layout_after_results', $id); ?>

    <?php if ($style['showmoreresults'] == 1): ?>
        <?php do_action('asl_layout_before_showmore', $id); ?>
        <p class='showmore'>
            <a><?php echo $style['showmoreresultstext']; ?></a>
        </p>
    <?php do_action('asl_layout_after_showmore', $id); ?>
    <?php endif; ?>

</div>

<?php if (self::$instanceCount<2): ?>
    <div id="asl_hidden_data">
        <svg style="position:absolute" height="0" width="0">
            <filter id="aslblur">
                <feGaussianBlur in="SourceGraphic" stdDeviation="4"/>
            </filter>
        </svg>
        <svg style="position:absolute" height="0" width="0">
            <filter id="no_aslblur"></filter>
        </svg>

    </div>
<?php endif; ?>

<?php
    $ana_options = get_option('asl_analytics');
    $scope = "asljQuery";
?>
<?php ob_start(); ?>
{
    "homeurl": "<?php echo function_exists("pll_home_url") ? @pll_home_url() : home_url("/"); ?>",
    "resultstype": "vertical",
    "resultsposition": "hover",
    "itemscount": <?php echo ((isset($style['itemscount']) && $style['itemscount']!="")?$style['itemscount']:"10"); ?>,
    "imagewidth": <?php echo ((isset($style['settings-imagesettings']['width']))?$style['settings-imagesettings']['width']:"70"); ?>,
    "imageheight": <?php echo ((isset($style['settings-imagesettings']['height']))?$style['settings-imagesettings']['height']:"70"); ?>,
    "resultitemheight": "<?php echo ((isset($style['resultitemheight']) && $style['resultitemheight']!="")?$style['resultitemheight']:"70"); ?>",
    "showauthor": <?php echo ((isset($style['showauthor']) && $style['showauthor']!="")?$style['showauthor']:"1"); ?>,
    "showdate": <?php echo ((isset($style['showdate']) && $style['showdate']!="")?$style['showdate']:"1"); ?>,
    "showdescription": <?php echo ((isset($style['showdescription']) && $style['showdescription']!="")?$style['showdescription']:"1"); ?>,
    "charcount":  <?php echo ((isset($style['charcount']) && $style['charcount']!="")?$style['charcount']:"3"); ?>,
    "noresultstext": "<?php echo ((isset($style['noresultstext']) && $style['noresultstext']!="")?$style['noresultstext']:"3"); ?>",
    "didyoumeantext": "<?php echo ((isset($style['didyoumeantext']) && $style['didyoumeantext']!="")?$style['didyoumeantext']:"3"); ?>",
    "defaultImage": "<?php echo w_isset_def($style['image_default'], "")==""?ASL_URL."img/default.jpg":$style['image_default']; ?>",
    "highlight": <?php echo $style['kw_highlight']; ?>,
    "highlightwholewords": <?php echo $style['kw_highlight_whole_words']; ?>,
    "scrollToResults": <?php echo w_isset_def($style['scroll_to_results'], 1); ?>,
    "resultareaclickable": <?php echo ((isset($style['resultareaclickable']) && $style['resultareaclickable']!="")?$style['resultareaclickable']:0); ?>,
    "defaultsearchtext": "<?php echo ((isset($style['defaultsearchtext']) && $style['defaultsearchtext']!="")?$style['defaultsearchtext']:""); ?>",
    "autocomplete": {
        "enabled" : <?php echo w_isset_def($style['autocomplete'], 1); ?>,
        "lang" : "<?php echo w_isset_def($style['kw_google_lang'], 'en'); ?>"
    },
    "triggerontype": <?php echo ((isset($style['triggerontype']) && $style['triggerontype']!="")?$style['triggerontype']:1); ?>,
    "triggeronclick": <?php echo ((isset($style['triggeronclick']) && $style['triggeronclick']!="")?$style['triggeronclick']:1); ?>,
    "redirectonclick": <?php echo ((isset($style['redirectonclick']) && $style['redirectonclick']!="")?$style['redirectonclick']:0); ?>,
    "trigger_on_facet_change": <?php echo w_isset_def($style['trigger_on_facet_change'], 0); ?>,
    "settingsimagepos": "<?php echo w_isset_def($style['theme'], 'classic-blue')=='classic-blue'?'left':'right'; ?>",
    "hresultanimation": "fx-none",
    "vresultanimation": "fx-none",
    "hresulthidedesc": "<?php echo ((isset($style['hhidedesc']) && $style['hhidedesc']!="")?$style['hhidedesc']:1); ?>",
    "prescontainerheight": "<?php echo ((isset($style['prescontainerheight']) && $style['prescontainerheight']!="")?$style['prescontainerheight']:"400px"); ?>",
    "pshowsubtitle": "<?php echo ((isset($style['pshowsubtitle']) && $style['pshowsubtitle']!="")?$style['pshowsubtitle']:0); ?>",
    "pshowdesc": "<?php echo ((isset($style['pshowdesc']) && $style['pshowdesc']!="")?$style['pshowdesc']:1); ?>",
    "closeOnDocClick": <?php echo w_isset_def($style['close_on_document_click'], 1); ?>,
    "iifNoImage": "<?php echo w_isset_def($style['i_ifnoimage'], 'description'); ?>",
    "iiRows": <?php echo w_isset_def($style['i_rows'], 2); ?>,
    "iitemsWidth": <?php echo w_isset_def($style['i_item_width'], 200); ?>,
    "iitemsHeight": <?php echo w_isset_def($style['i_item_height'], 200); ?>,
    "iishowOverlay": <?php echo w_isset_def($style['i_overlay'], 1); ?>,
    "iiblurOverlay": <?php echo w_isset_def($style['i_overlay_blur'], 1); ?>,
    "iihideContent": <?php echo w_isset_def($style['i_hide_content'], 1); ?>,
    "iianimation": "<?php echo w_isset_def($style['i_animation'], 1); ?>",
    "analytics": <?php echo w_isset_def($ana_options['analytics'], 0); ?>,
    "analyticsString": "<?php echo w_isset_def($ana_options['analytics_string'], ""); ?>",
    "redirectonclick": <?php echo $style['redirectonclick']; ?>,
    "redirectClickTo": "<?php echo $style['redirect_click_to']; ?>",
    "redirect_on_enter": <?php echo $style['redirect_on_enter']; ?>,
    "redirectEnterTo": "<?php echo $style['redirect_enter_to']; ?>",
    "redirect_url": "<?php echo apply_filters( "asl_redirect_url", $style['custom_redirect_url']); ?>",
    "overridewpdefault": <?php echo $style['override_default_results']; ?>,
    "override_method": "<?php echo $style['override_method']; ?>"
}
<?php $_asl_script_out = ob_get_clean(); ?>
<?php if (wd_asl()->o['asl_compatibility']['js_init'] == "blocking"): ?>
<script type="text/javascript">
/* <![CDATA[ */
if ( typeof ASL_INSTANCES == "undefined" )
    var ASL_INSTANCES = {};
ASL_INSTANCES['<?php echo $id; ?>'] = <?php echo $_asl_script_out; ?>;
/* ]]> */
</script>
<?php else: ?>
<div class="asl_init_data wpdreams_asl_data_ct" style="display:none !important;" id="asl_init_id_<?php echo $id; ?>" data-asldata="<?php echo base64_encode($_asl_script_out); ?>"></div>
<?php endif; ?>