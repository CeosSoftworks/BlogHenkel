<?php
/**
 * Exibição padrão de postagens.
 */
?>
<article id="post-<?php the_ID() ?>" <?php post_class() ?>>
  <header class="post-header">
    <div class="post-header-img" style="background-image: url(<?= getPostFeaturedImageUrl(get_the_ID()) ?>)"></div>
    <div class="inner">
      <h1><?php the_title() ?></h1>
    </div>
  </header>
  <section class="post-content">
    <div class="inner"><?php the_content() ?></div>
  </section>
</article>