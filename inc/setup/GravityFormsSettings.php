<?php

/**
 * This class allow gravity forms ajax works with spa 
 */

class GravityFormsSettings
{
    function __construct()
    {
        add_filter( 'gform_confirmation_anchor', '__return_false' );
    }
}
