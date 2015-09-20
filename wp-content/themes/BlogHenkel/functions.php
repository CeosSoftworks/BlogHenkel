<?php

/**
 * Adiciona links para os feeds RSS no <head> de posts e comentários.
 */

add_theme_support('automatic-feed-links');

/**
 * Indica ao Wordpress que o site não definirá uma tag <title> diretamente. Com
 * isso, o Wordpress deverá definir o valor mais adequado para cada página.
 */

add_theme_support('title_tag');

/**
 * Define o suporte a tags HTML5. Assim, elementos pré-definidos do Wordpress
 * utilizarão tags HTML5 ao invés de tags HTML4
 */

add_theme_support('html5');

/**
 * Adiciona o suporte de imagens destacadas ao tema
 */

add_theme_support('post-thumbnails');

/**
 * Registro da posição de menu de navegação do cabeçalho da página.
 */

register_nav_menus(array(
	'pg-header-nav' => __('Page header navigation', 'ceos')
));

/**
 * Enfileira os scrips e estilos CSS no carregamento da página.
 */

function enqueueScripts(){
	$templateDir = get_template_directory_uri();

	wp_enqueue_style('bootstrap', "{$templateDir}/css/bootstrap.min.css");
	wp_enqueue_style('main', "{$templateDir}/style.css");
	wp_enqueue_style('header', "{$templateDir}/css/header.css");


	wp_enqueue_script('bootstrap', "{$templateDir}/js/bootstrap.min.js");
	wp_enqueue_script('main', "{$templateDir}/js/main.js");
}

add_action('wp_enqueue_scripts', 'enqueueScripts');

/**
 * Outros scripts
 */

function getComposedSiteTitle($showDescription = true) {
  $siteDesc   = ($showDescription ? get_bloginfo('description') : '');
  $siteDesc   = (!empty($siteDesc) ? ' - ' . $siteDesc : $siteDesc);
  $siteTitle  = get_bloginfo('name');
  $pageTitle  = wp_title(' &raquo; ', false, 'right');
  
  if(is_home()) {
    $retVal = $siteTitle . $siteDesc;
  } else {
    $retVal = $pageTitle . $siteTitle . $siteDesc;
  }
  
  return $retVal;
}