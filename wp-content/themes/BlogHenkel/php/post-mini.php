<?php
/**
 * Resumo de post, exibindo apenas o nome da categoria a qual o post pertence
 * e o título da postagem.
 */

$categories = get_the_category();
?>
<div class="post-mini-wrap col-sm-4">
  <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
    <article id="post-<?php the_ID() ?>" <?php post_class('row vertical-middle') ?>>
      <div class="post-content-wrap post-header-img col-xs-4" style="background-image: url(<?= getPostFeaturedImageUrl(get_the_ID()) ?>)"></div>
      <div class="post-content-wrap col-xs-8">
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