<?php

function asl_do_init_options() {
    global $wd_asl;

    $wd_asl->options = array();
    $options = &$wd_asl->options;
    $wd_asl->o = &$wd_asl->options;

    /* Default caching options */
    $options = array();

    $options['asl_analytics_def'] = array(
        'analytics' => 0,
        'analytics_string' => "?ajax_search={asl_term}"
    );

    $options['asl_performance_def'] = array(
        'use_custom_ajax_handler' => 0,
        'image_cropping' => 0,
        'load_in_footer' => 1
    );

    /* Compatibility defaults */
    $options['asl_compatibility_def'] = array(
        // CSS JS
        'js_source' => "min",
        'js_init' => "dynamic",
        'load_mcustom_js' => 'yes',
        "detect_ajax" => 0,
        // DB
        'db_force_case' => 'none',
        'db_force_unicode' => 0,
        'db_force_utf8_like' => 0
    );


    /* Default new search options */

// General options
    $options['asl_defaults'] = array(
        'theme' => 'simple-red',
        'override_search_form' => 0,
        'override_woo_search_form' => 0,
        'keyword_logic' => "OR",
        'triggeronclick' => 1,
        'trigger_on_facet_change' => 1,
        'redirectonclick' => 0,
        'redirect_click_to' => 'results_page',
        'redirect_on_enter' => 0,
        'redirect_enter_to' => 'results_page',
        'custom_redirect_url' => '?s={phrase}',
        'triggerontype' => 1,
        'searchinposts' => 1,
        'searchinpages' => 1,
        'customtypes' => "",
        'searchintitle' => 1,
        'searchincontent' => 1,
        'searchinexcerpt' => 1,
        'search_in_permalinks' => 0,
        'search_all_cf' => 0,
        'customfields' => "",
        'override_default_results' => 0,
        'override_method' => 'get',

        'exactonly' => 0,
        'searchinterms' => 0,

        'charcount' => 0,
        'maxresults' => 10,
        'itemscount' => 4,
        'resultitemheight' => "70px",

        'orderby_primary' => 'relevance DESC',
        'orderby_secondary' => 'date DESC',

    // General/Image
        'show_images' => 1,
        'image_transparency' => 1,
        'image_bg_color' => "#FFFFFF",
        'image_width' => 70,
        'image_height' => 70,

        'image_crop_location' => 'c',
        'image_crop_location_selects' => array(
            array('option' => 'In the center', 'value' => 'c'),
            array('option' => 'Align top', 'value' => 't'),
            array('option' => 'Align top right', 'value' => 'tr'),
            array('option' => 'Align top left', 'value' => 'tl'),
            array('option' => 'Align bottom', 'value' => 'b'),
            array('option' => 'Align bottom right', 'value' => 'br'),
            array('option' => 'Align bottom left', 'value' => 'bl'),
            array('option' => 'Align left', 'value' => 'l'),
            array('option' => 'Align right', 'value' => 'r')
        ),

        'image_sources' => array(
            array('option' => 'Featured image', 'value' => 'featured'),
            array('option' => 'Post Content', 'value' => 'content'),
            array('option' => 'Post Excerpt', 'value' => 'excerpt'),
            array('option' => 'Custom field', 'value' => 'custom'),
            array('option' => 'Page Screenshot', 'value' => 'screenshot'),
            array('option' => 'Default image', 'value' => 'default'),
            array('option' => 'Disabled', 'value' => 'disabled')
        ),

        'image_source1' => 'featured',
        'image_source2' => 'content',
        'image_source3' => 'excerpt',
        'image_source4' => 'custom',
        'image_source5' => 'default',

        'image_default' => ASL_URL . "img/default.jpg",
        'image_source_featured' => 'original',
        'image_custom_field' => '',
        'use_timthumb' => 1,


        /* Frontend search settings Options */
        'show_frontend_search_settings' => 1,
        'showexactmatches' => 1,
        'showsearchinposts' => 1,
        'showsearchinpages' => 1,
        'showsearchintitle' => 1,
        'showsearchincontent' => 1,
        'showcustomtypes' => '',
        'showsearchincomments' => 1,
        'showsearchinexcerpt' => 1,
        'showsearchinbpusers' => 0,
        'showsearchinbpgroups' => 0,
        'showsearchinbpforums' => 0,

        'exactmatchestext' => "Exact matches only",
        'searchinpoststext' => "Search in posts",
        'searchinpagestext' => "Search in pages",
        'searchintitletext' => "Search in title",
        'searchincontenttext' => "Search in content",
        'searchincommentstext' => "Search in comments",
        'searchinexcerpttext' => "Search in excerpt",
        'searchinbpuserstext' => "Search in users",
        'searchinbpgroupstext' => "Search in groups",
        'searchinbpforumstext' => "Search in forums",

        'showsearchincategories' => 1,
        'showuncategorised' => 1,
        'exsearchincategories' => "",
        'exsearchincategoriesheight' => 200,
        'showsearchintaxonomies' => 1,
        'showterms' => "",
        'showseparatefilterboxes' => 1,
        'exsearchintaxonomiestext' => "Filter by",
        'exsearchincategoriestext' => "Filter by Categories",

        /* Layout Options */
        // Box layout
        'box_width' => "100%",
        'box_margin' => "||0px||0px||0px||0px||",
        // Results Layout
        'resultstype_def' => array(
            array('option' => 'Vertical Results', 'value' => 'vertical'),
            array('option' => 'Horizontal Results', 'value' => 'horizontal'),
            array('option' => 'Isotopic Results', 'value' => 'isotopic'),
            array('option' => 'Polaroid style Results', 'value' => 'polaroid')
        ),
        'resultstype' => 'vertical',
        'resultsposition_def' => array(
            array('option' => 'Hover - over content', 'value' => 'hover'),
            array('option' => 'Block - pushes content', 'value' => 'block')
        ),
        'resultsposition' => 'hover',
        'resultsmargintop' => '12px',

        'defaultsearchtext' => 'Search here..',
        'showmoreresults' => 0,
        'showmoreresultstext' => 'More results...',
        'showmorefont' => 'font-weight:normal;font-family:--g--Open Sans;color:rgba(5, 94, 148, 1);font-size:12px;line-height:15px;text-shadow:0px 0px 0px rgba(255, 255, 255, 0);',
        'scroll_to_results' => 0,
        'resultareaclickable' => 1,
        'close_on_document_click' => 1,
        'show_close_icon' => 1,
        'showauthor' => 0,
        'showdate' => 0,
        'showdescription' => 1,
        'descriptionlength' => 100,
        'description_context' => 0,
        'noresultstext' => "No results!",
        'didyoumeantext' => "Did you mean:",
        'kw_highlight' => 0,
        'kw_highlight_whole_words' => 1,
        'highlight_color' => "#d9312b",
        'highlight_bg_color' => "#eee",

        // General/Autocomplete/KW suggestions
        'autocomplete' => 1,

        'kw_suggestions' => 1,
        'kw_length' => 60,
        'kw_count' => 10,
        'kw_google_lang' => "en",
        'kw_exceptions' => "",

        /* Advanced Options */
        'shortcode_op' => 'remove',
        'striptagsexclude' => '',
        'runshortcode' => 1,
        'stripshortcode' => 0,
        'pageswithcategories' => 0,


        'titlefield' => 0,
        'titlefield_cf' => '',
        'descriptionfield' => 0,
        'descriptionfield_cf' => '',

        'excludecategories' => '',
        'excludeposts' => '',
        'exclude_term_ids' => '',

        'wpml_compatibility' => 1,
        'polylang_compatibility' => 1
    );
}

/**
 * Merge the default options with the stored options.
 */
function asl_parse_options() {
    foreach ( wd_asl()->o as $def_k => $o ) {
        if ( preg_match("/\_def$/", $def_k) ) {
            $ok = preg_replace("/\_def$/", '', $def_k);

            wd_asl()->o[$ok] = get_option($ok, wd_asl()->o[$def_k]);
            wd_asl()->o[$ok] = array_merge(wd_asl()->o[$def_k], wd_asl()->o[$ok]);
        }
    }
}

asl_do_init_options();
asl_parse_options();