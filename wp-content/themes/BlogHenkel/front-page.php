<?php get_header() ?>

<section id="home-top" class="container-fluid">
  <div class="inner padding-y-0 padding-x-10px"><?php get_template_part('php/loop', 'frontpage-top') ?></div>
</section>

<section id="home-slider-wrap" class="container-fluid">
  <div class="inner padding-y-0 padding-x-10px"><?php get_template_part('php/loop', 'frontpage-slider') ?></div>
</section>

<section id="home-body" class="container-fluid">
  <div class="col-md-5">
    <div class="inner padding-y-0 padding-x-10px"><?php get_template_part('php/loop', 'frontpage') ?></div>
  </div>
  <div class="col-md-3">
    <div class="inner padding-y-0 padding-x-10px"><?php get_template_part('php/boxed-links') ?></div>
  </div>
  <div class="col-md-4">
    <div class="inner padding-y-0 padding-x-10px">
      <div id="banner-wrap"><img src="<?= get_template_directory_uri() ?>/imgs/banner.png" style="width: 100%"></div>
      <div id="page-support">
        <img src="<?= get_template_directory_uri() ?>/imgs/clipart-support-henkel.png">
      </div>
    </div>
  </div>
</section>

<?php get_footer() ?>