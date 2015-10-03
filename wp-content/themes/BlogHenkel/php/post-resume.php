<?php
/**
 * Resumo de post para uso geral. Não exibe a categoria a qual o post pertence.
 */

$categories = get_the_category();
?>
<div class="post-wrap">
  <a href="<?php the_permalink() ?>" class="post-resume-link">
    <article id="post-<?php the_ID() ?>" <?php post_class('row vertical-middle') ?>>  
      <div class="post-header-img col-sm-6" title="<?php the_title() ?>" style="background-image: url(<?= getPostFeaturedImageUrl(get_the_ID()) ?>)"></div>
      <div class="post-content-wrap col-sm-6">
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
        <div class="jumplink-wrap">
          <span class="jumplink" title="<?= __('Clique para continuar lendo') ?>">
            <img src="<?= get_template_directory_uri() ?>/imgs/icon-button.png">
          </span>
        </div>
      </div>
    </article>
  </a>
</div>