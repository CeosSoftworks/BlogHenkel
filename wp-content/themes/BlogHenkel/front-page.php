<?php get_header() ?>

<section id="home-top" class="container-fluid">
  <?php get_template_part('php/loop', 'frontpage-top') ?>
</section>

<section id="home-slider-wrap" class="container-fluid">
  <?php get_template_part('php/loop', 'frontpage-slider') ?>
</section>

<section id="home-body" class="container-fluid">
  <div class="col-md-5">
    <?php get_template_part('php/loop', 'frontpage') ?>
  </div>
  <div class="col-md-3">
    <?php get_template_part('php/boxed-links') ?>
  </div>
  <div class="col-md-4">
    Apoio
  </div>
</section>

<?php get_footer() ?>