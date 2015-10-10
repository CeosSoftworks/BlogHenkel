<?php
/**
 * Exibe os posts mais recentes de uma categoria, com um link acima destes
 * posts para que o usuário possa acessar todos os posts da categoria.
 */

$cvaQuery = new WP_Query(array(
  'cat' => get_query_var('cat'),
  'posts_per_page' => 6
));

?>
<aside id="cat-view-all">
  <h6><a href="<?= get_category_link(get_query_var('cat')) ?>?view-all"><?= __('Todos os posts deste canal') ?>:</a></h6>
  <div class="inner clearfix">
    <?php if($cvaQuery->have_posts()) : ?>
      <?php while($cvaQuery->have_posts()) : $cvaQuery->the_post() ?>
        <div class="post-mini-wrap col-sm-6">
          <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
            <article id="post-<?php the_ID() ?>" <?php post_class('row vertical-middle') ?>>
              <div class="post-content-wrap post-header-img col-xs-5" style="background-image: url(<?= getPostFeaturedImageUrl(get_the_ID()) ?>)"></div>
              <div class="post-content-wrap col-xs-7">
                <header class="post-header">
                  <div class="inner">
                    <h4 class="post-cat"><?= $categories[0]->name ?></h4>
                    <h1 class="post-title"><?php the_title() ?></h1>
                  </div>
                </header>
              </div>
            </article>
          </a>
        </div>
      <?php endwhile ?>
    <?php endif ?>
    <?php wp_reset_postdata() ?>
  </div>
</aside>