<?php
/**
 * Walker para o menu de categorias na barra lateral (desktop). Serve para
 * modificar como o menu é exibido e exibí-lo da forma que o cliente pediu.
 */

class WalkerSidebar extends Walker_Category {
  public function start_lvl(&$output, $depth = 0, $args = array()) {
    $output = '<nav>';
  }
  public function end_lvl(&$output, $depth = 0, $args = array()) {
    $output = '</nav>';
  }
  public function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0) {
    $link = get_category_link($category->term_id);
    $name = $category->name;
    $imgSrc = get_template_directory_uri() . '/imgs/icon-button.png';
    
    $output .= "<li>"
        . "<a href=\"{$link}\" title=\"{$name}\">"
            . "<span class=\"nav-cat-title\">{$name}</span>"
            . "<span class=\"nav-cat-img\"><img src=\"{$imgSrc}\"></span>"
        . "</a>"
      . "</li>";
  }
}