<?php

/**
 * @package JET WP Custom Blog Title
 * @version 1.0
 */
/*
Plugin Name: JET WP Custom Blog Title
Description: Makes Posts Page use actual Title (because it's stupid that it doesn't)
Author: Jonathan Tweedy
Version: 1.0
Author URI: http://jonathantweedy.com
*/


$page_for_posts = get_option( 'page_for_posts' );
$this_page_uri = str_replace("/", "", $_SERVER['REDIRECT_URL']);
$posts_page_uri = get_page_uri($page_for_posts);
$on_posts_page = ($this_page_uri==$posts_page_uri);
$on_team_page = ($this_page_uri=="team");

if ($on_posts_page) {
    add_filter("the_title", function($title, $id) {
        global $page_for_posts;
        $pageTitle = get_post_field( "post_title", $page_for_posts );
        return $title . "
<script>
window.addEventListener('load', () => {
    // .blog .page-title span
    document.querySelector('.blog .page-title span').innerHTML = '" . addslashes($pageTitle) . "';
});
</script>
        ";
    }, 1, 2);


}



/*
if ($on_posts_page || $on_team_page) {
    print get_post();
    print "<hr />";
    die;
}
*/

?>