<?php
/**
 * Loop de finalidade geral.
 */

if(have_posts()) {
  while(have_posts()) {
    the_post();
    get_template_part('php/post', 'resume');
  }
  the_posts_pagination();
} else {
  get_template_part('php/post', 'empty');
}