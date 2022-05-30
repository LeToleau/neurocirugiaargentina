<?php

/**
 * Class to add support to BARBA JS
 */
class SpaSettings
{
   function __construct()
   {
      add_action('rest_api_init', array($this, 'forceReloadEndpoint'));
      add_action('rest_api_init', array($this, 'reloadScripts'));
   }

   function forceReloadEndpoint()
   {
      register_rest_route('spa-settings/v1', 'forced-pages', array(
         'methods' => 'GET',
         'callback' => array($this, 'forceReloadReturn')
      ));
   }

   function forceReloadReturn()
   {
      $selectedPages = get_field('force_reload_pages', 'option');
      $forceUrls = [];
      foreach ($selectedPages as $post) {
         array_push($forceUrls, get_permalink($post));
      }

      return $forceUrls;
   }

   function reloadScripts()
   {
      register_rest_route('spa-settings/v1', 'scripts', array(
         'methods' => 'GET',
         'callback' => array($this, 'getHeadAndFooterScripts')
      ));
   }

   function getHeadAndFooterScripts()
   {
   
      ob_start(); // start capturing output.
      do_action('wp_footer');
      $footer = ob_get_contents(); // the actions output will now be stored in the variable as a string!
      ob_end_clean(); // never forget this or you will keep capturing output.

      ob_start(); // start capturing output.
      do_action('wp_head');
      $head = ob_get_contents(); // the actions output will now be stored in the variable as a string!
      ob_end_clean(); // never forget this or you will keep capturing output.

      return array(
         'head' => $head,
         'footer' => $footer
      );
   }
}
