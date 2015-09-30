<?php require_once('php/walker-sidebar.php') ?>
<section id="site-menu" class="col-md-2 desktop">
  <header id="site-header">
    <h1 id="site-branding">
      <div id="site-logo-wrap">
        <a href="<?= home_url() ?>">
          <img id="site-logo" src="<?= get_template_directory_uri() ?>/imgs/logo.png">
        </a>
      </div>
    </h1>
    <div id="site-social-links">
      <span class="social-link-wrap col-xs-3 no-padding"><a href="#"><img src="<?= get_template_directory_uri() ?>/imgs/icon-facebook.png"></a></span>
      <span class="social-link-wrap col-xs-3 no-padding"><a href="#"><img src="<?= get_template_directory_uri() ?>/imgs/icon-gplus.png"></a></span>
      <span class="social-link-wrap col-xs-3 no-padding"><a href="#"><img src="<?= get_template_directory_uri() ?>/imgs/icon-youtube.png"></a></span>
      <span class="social-link-wrap col-xs-3 no-padding"><a href="#"><img src="<?= get_template_directory_uri() ?>/imgs/icon-twitter.png"></a></span>
    </div>
    <div id="site-langs">
      <span class="lang-link-wrap col-xs-3 no-padding"><a href="#"><img src="<?= get_template_directory_uri() ?>/imgs/icon-brazil.png"></a></span>
      <span class="lang-link-wrap col-xs-3 no-padding"><a href="#"><img src="<?= get_template_directory_uri() ?>/imgs/icon-argentina.png"></a></span>
      <span class="lang-link-wrap col-xs-3 no-padding"><a href="#"><img src="<?= get_template_directory_uri() ?>/imgs/icon-chile.png"></a></span>
    </div>
    <div id="site-search"><?php get_search_form() ?></div>
  </header>
  <div id="sidebar-content">
    <?php wp_list_categories(array(
        'title_li' => __('Mais neste blog'),
        'hide_empty' => false,
        'walker' => new WalkerSidebar()
    )) ?>
  </div>
</section>