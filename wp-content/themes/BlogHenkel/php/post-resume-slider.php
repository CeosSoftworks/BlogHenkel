<?php
/**
 * Exibição de post resumida, criada primariamente para uso pelo loop
 * de slider na página inicial do website.
 */

$categories = get_the_category();
?>
<div class="post-wrap">
  <h4 class="post-cat">
    <a href="<?= get_category_link($categories[0]->term_id) ?>" title="<?= $categories[0]->name ?>"><?= $categories[0]->name ?></a>
  </h4>
  
  <a href="<?php the_permalink() ?>">
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
              <?php the_excerpt() ?>
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