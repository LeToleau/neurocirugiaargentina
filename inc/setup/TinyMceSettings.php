<?php
/**
 * Class to keep track of hooks and filters for Page Editor (Tiny MCE)
 */

class TinyMceSettings
{
    function __construct()
    {
        add_action('admin_init', array($this, 'removeEditor'));
        //add_filter('tiny_mce_before_init', array($this, 'customColors'));
    }

    /**
     * Remove editor from pages
     */
    function removeEditor()
    {
        remove_post_type_support('page', 'editor');
    }

    /**
     * Custom Colors for text edit (apply also for wysiwyg acf)
     */
    function customColors($init)
    {
        $custom_colours = '
            "9CCFFF", "Light Blue",
            "A0EADE", "Light Green"
        ';

        // build colour grid default+custom colors
        $init['textcolor_map'] = '[' . $custom_colours . ']';

        // change the number of rows in the grid if the number of colors changes
        // 8 swatches per row
        $init['textcolor_rows'] = 1;

        return $init;
    }
}
