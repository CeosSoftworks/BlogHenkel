<?php
/**
 * Loop que recupera os três ultimos posts publicado no website.
 * 
 * Este script tem como intenção primária ser exibido na página inicial do site.
 */

$psQuery = new WP_Query(array('posts_per_page' => 3));
?>
<?php 
if($psQuery->have_posts()) {
  while($psQuery->have_posts()) {
    $psQuery->the_post();
    get_template_part('php/post', 'mini');
  }
  wp_reset_query();
}
?>