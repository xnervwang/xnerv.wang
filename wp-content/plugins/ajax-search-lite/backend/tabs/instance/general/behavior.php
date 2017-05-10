<div class="item">
    <?php
    $o = new wpdreamsCustomSelect("keyword_logic", __("Keyword (phrase) logic?", "ajax-search-lite"), array(
        'selects'=>array(
            array("option" => "OR", "value" => "OR"),
            array("option" => "AND", "value" => "AND")
        ),
        'value'=>$sd['keyword_logic']
    ));
    $params[$o->getName()] = $o->getData();
    ?>
    <div class="descMsg">This determines if the result should match either of the entered phrases (OR logic) or all of the entered phrases (AND logic).</div>
</div>
<div class="item">
    <?php
    $o = new wpdreamsYesNo("triggeronclick", __("Trigger search when clicking on search icon?", "ajax-search-lite"),
        $sd['triggeronclick']);
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $o = new wpdreamsYesNo("trigger_on_facet_change", __("Trigger search on facet change?", "ajax-search-lite"),
        $sd['trigger_on_facet_change']);
    $params[$o->getName()] = $o->getData();
    ?>
    <p class="descMsg"><?php echo __("Will trigger a search when the user clicks on a checkbox on the front-end.", "ajax-search-lite"); ?></p>
</div>
<div class="item">
    <?php
    $o = new wpdreamsYesNo("triggerontype", __("Trigger search when typing?", "ajax-search-lite"),
        $sd['triggerontype']);
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $o = new wpdreamsTextSmall("charcount", __("Minimal character count to trigger search", "ajax-search-lite"),
        $sd['charcount'], array(array("func" => "ctype_digit", "op" => "eq", "val" => true)));
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $o = new wpdreamsTextSmall("maxresults", __("Max. results", "ajax-search-lite"), $sd['maxresults'], array(array("func" => "ctype_digit", "op" => "eq", "val" => true)));
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $o = new wpdreamsYesNo("description_context", __("Display the description context?", "ajax-search-lite"),
        $sd['description_context']);
    $params[$o->getName()] = $o->getData();
    ?>
    <p class="descMsg"><?php __("Will display the description from around the search phrase, not from the beginning.", "ajax-search-lite"); ?></p>
</div>
<div class="item"><?php
    $o = new wpdreamsTextSmall("itemscount", __("Results box viewport (in item numbers)", "ajax-search-lite"), $sd['itemscount'], array(array("func" => "ctype_digit", "op" => "eq", "val" => true)));
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item item-flex-nogrow">
    <?php
    $o = new wpdreamsYesNo("redirectonclick", __("Redirect when clicking on search icon?", "ajax-search-lite"),
        $sd['redirectonclick']);
    $params[$o->getName()] = $o->getData();
    ?>
    <?php
    $o = new wpdreamsCustomSelect("redirect_click_to", __(" and redirect to", "ajax-search-lite"),
        array(
            'selects' => array(
                array("option" => __("Results page", "ajax-search-lite"), "value" => "results_page"),
                array("option" => __("Woocommerce results page", "ajax-search-lite"), "value" => "woo_results_page"),
                array("option" => __("First matching result", "ajax-search-lite"), "value" => "first_result"),
                array("option" => __("Custom URL", "ajax-search-lite"), "value" => "custom_url")
            ),
            'value' => $sd['redirect_click_to']
        ));
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item item-flex-nogrow item-conditional">
    <?php
    $o = new wpdreamsYesNo("redirect_on_enter", __("Redirect when hitting the return key?", "ajax-search-lite"),
        $sd['redirect_on_enter']);
    $params[$o->getName()] = $o->getData();
    ?>
    <?php
    $o = new wpdreamsCustomSelect("redirect_enter_to", __(" and redirect to", "ajax-search-lite"),
        array(
            'selects' => array(
                array("option" => __("Results page", "ajax-search-lite"), "value" => "results_page"),
                array("option" => __("Woocommerce results page", "ajax-search-lite"), "value" => "woo_results_page"),
                array("option" => __("First matching result", "ajax-search-lite"), "value" => "first_result"),
                array("option" => __("Custom URL", "ajax-search-lite"), "value" => "custom_url")
            ),
            'value' => $sd['redirect_enter_to']
        ));
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
    <?php
    $o = new wpdreamsText("custom_redirect_url", __("Custom redirect URL", "ajax-search-lite"), $sd['custom_redirect_url']);
    $params[$o->getName()] = $o->getData();
    ?>
    <p class="descMsg">You can use the <string>asl_redirect_url</string> filter to add more variables.</p>
</div>
<div class="item item-flex-nogrow" style="flex-wrap: wrap;">
    <?php
    $o = new wpdreamsYesNo("override_default_results", __("Override the default WordPress search results?", "ajax-search-lite"),
        $sd['override_default_results']);
    $params[$o->getName()] = $o->getData();
    ?>
    <?php
    $o = new wpdreamsCustomSelect("override_method", " method ", array(
        "selects" =>array(
            array("option" => "Post", "value" => "post"),
            array("option" => "Get", "value" => "get")
        ),
        "value" => $sd['override_method']
    ));
    $params[$o->getName()] = $o->getData();
    ?>
    <div class="descMsg" style="min-width: 100%;flex-wrap: wrap;flex-basis: auto;flex-grow: 1;box-sizing: border-box;"><?php echo __("Might not work with some Themes.", "ajax-search-lite"); ?></p>
</div>