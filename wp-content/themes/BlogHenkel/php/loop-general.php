<?php
/**
 * Loop de finalidade geral.
 */

if(have_posts()) {
  the_post();
  get_template_part('php/post', 'resume');
} else {
  get_template_part('php/post', 'empty');
}