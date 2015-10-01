<?php require_once('php/walker-sidebar.php') ?>
<section id="site-menu" class="col-md-2 desktop">
  <div class="inner padding-y-0 padding-x-10px padding-right-0">
    <header id="site-header">
      <h1 id="site-branding">
        <div id="site-logo-wrap aligncenter">
          <a href="<?= home_url() ?>">
            <img id="site-logo" src="<?= get_template_directory_uri() ?>/imgs/logo.png">
          </a>
        </div>
      </h1>
      <div id="site-social-links" class="aligncenter container-fluid padding-x-0">
        <span class="social-link-wrap col-xs-3 no-padding"><div class="padding-x-5px"><a href="#"><img src="<?= get_template_directory_uri() ?>/imgs/icon-facebook.png"></a></div></span>
        <span class="social-link-wrap col-xs-3 no-padding"><div class="padding-x-5px"><a href="#"><img src="<?= get_template_directory_uri() ?>/imgs/icon-gplus.png"></a></div></span>
        <span class="social-link-wrap col-xs-3 no-padding"><div class="padding-x-5px"><a href="#"><img src="<?= get_template_directory_uri() ?>/imgs/icon-youtube.png"></a></div></span>
        <span class="social-link-wrap col-xs-3 no-padding"><div class="padding-x-5px"><a href="#"><img src="<?= get_template_directory_uri() ?>/imgs/icon-twitter.png"></a></div></span>
      </div>
      <div id="site-langs" class="aligncenter container-fluid padding-x-0 padding-top-20px">
        <span class="lang-link-wrap col-xs-3 no-padding"><a href="#"><div class="padding-x-5px"><img src="<?= get_template_directory_uri() ?>/imgs/icon-brazil.png"></a></div></span>
        <span class="lang-link-wrap col-xs-3 no-padding"><a href="#"><div class="padding-x-5px"><img src="<?= get_template_directory_uri() ?>/imgs/icon-argentina.png"></a></div></span>
        <span class="lang-link-wrap col-xs-3 no-padding"><a href="#"><div class="padding-x-5px"><img src="<?= get_template_directory_uri() ?>/imgs/icon-chile.png"></a></div></span>
      </div>
      <div id="site-search"><?php get_search_form() ?></div>
    </header>
    <div id="sidebar-content" class="padding-top-20px">
      <?php wp_list_categories(array(
          'title_li' => __('Mais neste blog'),
          'hide_empty' => false,
          'walker' => new WalkerSidebar()
      )) ?>
    </div>
  </div>
</section>