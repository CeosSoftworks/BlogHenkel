<?php
/**
 * Exibe os posts mais recentes de uma categoria, com um link acima destes
 * posts para que o usuário possa acessar todos os posts da categoria.
 */

$cvaQuery = new WP_Query(array(
  'cat' => get_query_var('cat'),
  'posts_per_page' => 6
));

echo "<h4><a href=\"\">" . __('Todos os posts deste canal') . ":</a></h4>";

if($cvaQuery->have_posts()) {
  while($cvaQuery->have_posts()) {
    $cvaQuery->the_post();
    get_template_part('php/post', 'mini');
  }
}

wp_reset_postdata();