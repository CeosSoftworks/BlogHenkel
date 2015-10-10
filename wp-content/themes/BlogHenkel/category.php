<?php get_header() ?>

<section id="category-top" class="container-fluid">
  <div class="page-top container-fluid padding-10px margin-10px">
    <div class="col-md-8">
      <?php get_template_part('php/category', 'header') ?>
    </div>
    <div class="col-md-4">
      <div class="">
        <div id="banner-wrap"><img src="<?= get_template_directory_uri() ?>/imgs/banner.png" style="width: 100%"></div>
      </div> 
    </div>
  </div>
</section>

<section id="page-body" class="container-fluid">

  <?php
  /**
   * Caso a diretiva 'view-all' naõ esteja definida, a página principal da
   * categoria é exibida. Caso esteja, uma lista com todos os posts na
   * categoria é exibida ao usuário. Atenção ao começo e final da condicional.
   */
  ?>
  <?php if(!isset($_GET['view-all'])) : ?>
  
    <div class="col-md-8">
      <div class="inner padding-y-0 padding-x-10px">
        <div id="cat-most-read-post">
          <?php $mostViewed = get_cat_most_viewed_obj(get_query_var('cat')) ?>
          <?php if($mostViewed) : ?>
            <div class="post-wrap">
              <h4 class="post-cat"><?= __('Mais lido') ?></h4>
              <a class="post-resume-link" href="<?= get_the_permalink($mostViewed[0]->ID) ?>">
                <article id="post-<?= $mostViewed[0]->ID ?>" <?php post_class('row vertical-middle', $mostViewed[0]->ID) ?>>  
                  <div class="post-header-img col-sm-6" title="<?= $mostViewed[0]->post_title ?>" style="background-image: url(<?= getPostFeaturedImageUrl($mostViewed[0]->ID) ?>)"></div>
                  <div class="post-content-wrap col-sm-6">
                    <div class="centralizer">
                      <header class="post-header">
                        <div class="inner">
                          <h1 class="post-title"><?= $mostViewed[0]->post_title ?></h1>
                        </div>
                      </header>
                      <section class="post-content">
                        <div class="inner">
                          <?= wp_trim_words($mostViewed[0]->post_content, 18) ?>
                        </div>
                      </section>
                    </div>
                    <div class="jumplink-wrap">
                      <span class="jumplink" title="<?= __('Clique para continuar lendo') ?>">
                        <img src="<?= get_template_directory_uri() ?>/imgs/icon-button.png">
                      </span>
                    </div>
                  </div>
                </article>
              </a>
            </div>
          <?php else : ?>
            <?php get_template_part('post', 'empty'); ?>
          <?php endif ?>
        </div>

        <div id="cat-most-recent-post">
          <?php
          $catQuery = new WP_Query(array(
            'posts_per_page' => 1,
            'cat' => get_query_var('cat')
          ));
          ?>
          <?php if($catQuery->have_posts()) : $catQuery->the_post() ?>
            <div class="post-wrap">
              <h4 class="post-cat"><?= __('Mais recente') ?></h4>
              <a class="post-resume-link" href="<?php the_permalink() ?>">
                <article id="post-<?php the_ID() ?>" <?php post_class('row vertical-middle') ?>>  
                  <div class="post-header-img col-sm-6" title="<?php the_title() ?>" style="background-image: url(<?= getPostFeaturedImageUrl(get_the_ID()) ?>)"></div>
                  <div class="post-content-wrap col-sm-6">
                    <div class="centralizer">
                      <header class="post-header">
                        <div class="inner">
                          <h1 class="post-title"><?php the_title() ?></h1>
                        </div>
                      </header>
                      <section class="post-content">
                        <div class="inner">
                          <?= wp_trim_words(get_the_content(), 18) ?>
                        </div>
                      </section>
                    </div>
                    <div class="jumplink-wrap">
                      <span class="jumplink" title="<?= __('Clique para continuar lendo') ?>">
                        <img src="<?= get_template_directory_uri() ?>/imgs/icon-button.png">
                      </span>
                    </div>
                  </div>
                </article>
              </a>
            </div>
          <?php else : ?>
            <?php get_template_part('post', 'empty'); ?>
          <?php endif ?>
        </div>
      </div>
    </div>
  
  <?php else : ?>
  
    <div class="col-md-8">
      <div class="inner padding-y-0 padding-x-10px">
        <?php get_template_part('php/loop', 'general'); ?>
      </div>
    </div>

  <?php endif ?>
  
  <div class="col-md-4">
    <div class="inner padding-y-0 padding-x-10px">
      <?php get_template_part('php/category', 'view-all'); ?>
    </div>
  </div>
</section>

<?php get_footer() ?>