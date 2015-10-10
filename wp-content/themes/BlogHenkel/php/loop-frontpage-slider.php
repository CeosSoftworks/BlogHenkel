<?php
/**
 * Exibição de post no slider da página inicial.
 * 
 * $psQuery armazena o query com os 3 primeiros posts a terem sido marcados como
 * destaque pelo administrador do site.
 * 
 * Para o slide foi utilizado o script jquery.slides dentro da pasta js.
 */

$psQuery = new WP_Query(array('posts_per_page' => 8, 'featured' => true));
?>
<div id="frontpage-posts-slider" class="posts-slider latest-posts">
  <div class="post-slider-treadmill-wrap">
    <div class="post-slider-treadmill">
      <?php 
      if($psQuery->have_posts()) {
        while($psQuery->have_posts()) {
          $psQuery->the_post();
          get_template_part('php/post', 'resume-slider');
        }
        wp_reset_query();
      }
      ?>
    </div>
  </div>
  <script type="text/javascript">
    $('#frontpage-posts-slider .post-slider-treadmill').slidesjs({
      width: 940,
      height: 320,
      play: {
        active: true,
        auto: true,
        interval: 8000,
        swap: true
      }
    });
  </script>
</div>