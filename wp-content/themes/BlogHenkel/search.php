<?php get_header() ?>

<section id="page-top" class="container-fluid">
  <div class="col-md-8">
    <div class="inner padding-y-0 padding-x-10px"><h1><?= __('Resultado da busca') ?></h1></div>
  </div>
  <div class="col-md-4">
    <div class="inner padding-y-0 padding-x-10px">
      <div id="banner-wrap"><img src="<?= get_template_directory_uri() ?>/imgs/banner.png" style="width: 100%"></div>
    </div> 
  </div>
</section>

<section id="page-body" class="container-fluid">
  <div class="col-md-8">
    <div class="inner padding-y-0 padding-x-10px"><?php get_template_part('php/loop', 'general') ?></div>
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