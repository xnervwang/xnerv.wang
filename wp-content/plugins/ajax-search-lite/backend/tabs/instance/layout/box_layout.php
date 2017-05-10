<div class="item"><?php
    $o = new wpdreamsTextSmall("box_width", __("Search Box width", "ajax-search-lite"), $sd['box_width']);
    $params[$o->getName()] = $o->getData();
    ?>
    <p class="descMsg"><?php echo __("Include the unit as well, example: 10px or 1em or 90%", "ajax-search-lite"); ?></p>
</div>
<div class="item">
    <?php
    $option_name = "box_margin";
    $option_desc = __("Search box margin", "ajax-search-lite");
    $option_expl = __("Include the unit as well, example: 10px or 1em or 90%", "ajax-search-lite");
    $o = new wpdreamsFour($option_name, $option_desc,
        array(
            "desc" => $option_expl,
            "value" => $sd[$option_name]
        )
    );
    $params[$o->getName()] = $o->getData();
    ?>
</div>