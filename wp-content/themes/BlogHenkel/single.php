<?php get_header() ?>

<section id="category-top" class="container-fluid">
  <div class="page-top container-fluid padding-10px margin-10px">
    <div class="col-md-8">
      <div class="">
        Category
      </div>
    </div>
    <div class="col-md-4">
      <div class="">
        <div id="banner-wrap"><img src="<?= get_template_directory_uri() ?>/imgs/banner.png" style="width: 100%"></div>
      </div> 
    </div>
  </div>
</section>

<section id="page-body" class="container-fluid">
  <div class="col-md-8">
    <div class="inner padding-y-0 padding-x-10px">
      <div id="cat-most-recent-post">
        <?php get_template_part('php/loop', 'single'); ?>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="inner padding-y-0 padding-x-10px">
      <?php echo_crp() ?>
    </div>
  </div>
</section>

<?php get_footer() ?>