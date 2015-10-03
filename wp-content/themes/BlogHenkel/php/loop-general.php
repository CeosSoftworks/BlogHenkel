<?php
/**
 * Loop de finalidade geral.
 * NÃO FINALIZADO
 */

if(have_posts()) {
  the_post();
  get_template_part('php/post', 'single');
} else {
  get_template_part('php/post', 'empty');
}