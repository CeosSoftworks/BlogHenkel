<?php
$query = new WP_Query(array('posts_per_page' => 1, 'offset' => 6));

if($query->have_posts()) {
  while($query->have_posts()) {
    $query->the_post();
    get_template_part('php/post', 'resume');
  }
} else {
  get_template_part('php/post', 'empty');
}