<?php

/**
 * Extend WordPress search to include custom fields
 *
 * https://adambalee.com
 */

class AcfSearchExtend
{
    function __construct()
    {
        //add_filter('posts_join', array($this, 'cf_search_join'));
        //add_filter('posts_where', array($this, 'cf_search_where'));
        //add_filter('posts_distinct', array($this, 'cf_search_distinct'));
    }

    /**
     * Join posts and postmeta tables
     *
     * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
     */
    function cf_search_join($join)
    {
        global $wpdb;
        $join .= ' LEFT JOIN ' . $wpdb->postmeta . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';

        return $join;
    }

    /**
     * Modify the search query with posts_where
     *
     * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
     */
    function cf_search_where($where)
    {
        global $pagenow, $wpdb;
        $where = preg_replace(
            "/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)",
            $where
        );

        return $where;
    }

    /**
     * Prevent duplicates
     *
     * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
     */
    function cf_search_distinct($where)
    {
        global $wpdb;
        return "DISTINCT";
    }
}
