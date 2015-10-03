<?php
/**
 * Loop que recupera o quarto ultimo post publicado no website para exibição
 * na página inicial.
 */

$query = new WP_Query(array('posts_per_page' => 1, 'offset' => 3));

if($query->have_posts()) {
  while($query->have_posts()) {
    $query->the_post();
    get_template_part('php/post', 'resume');
  }
} else {
  get_template_part('php/post', 'empty');
}