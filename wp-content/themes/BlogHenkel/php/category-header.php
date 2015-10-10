<?php
/**
 * Exibe a postagem destacadas da categoria no cabeçalho da página.
 */

$cfQuery = new WP_Query(array(
  'cat' => get_query_var('cat'),
  'posts_per_page' => 5,
  'featured' => true
));
?>
<div id="cat-header-feature" class="padding-right-20px">
  <div class="post-slider-treadmill-wrap">
    <div class="post-slider-treadmill">
      <?php 
      if($cfQuery->have_posts()) {
        while($cfQuery->have_posts()) :
          $cfQuery->the_post(); ?>
          
          <a href="<?php the_permalink() ?>" class="hentry-link">
            <div <?php post_class('cat-feature') ?>>
              <div class="inner">
                <div class="hentry-image" style="background-image: url(<?= getPostFeaturedImageUrl(get_the_ID()) ?>)"></div>
                <div class="hentry-title"><h4><?php the_title() ?></h4></div>
              </div>
            </div>
          </a>
        
        <?php endwhile;
        wp_reset_query();
      }
      ?>
    </div>
  </div>
  <script type="text/javascript">
    $('#cat-header-feature .post-slider-treadmill').slidesjs({
      width: 940,
      height: 190,
      play: {
        active: true,
        auto: true,
        interval: 5000,
        swap: true
      }
    });
  </script>
</div>