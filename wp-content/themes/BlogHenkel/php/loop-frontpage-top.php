<?php
$psQuery = new WP_Query(array('posts_per_page' => 3, 'offset' => 3));
?>
<div id="frontpage-top-posts" class="container-fluid">
  <?php 
  if($psQuery->have_posts()) {
    while($psQuery->have_posts()) {
      $psQuery->the_post();
      get_template_part('php/post', 'mini');
    }
    wp_reset_query();
  }
  ?>
</div>