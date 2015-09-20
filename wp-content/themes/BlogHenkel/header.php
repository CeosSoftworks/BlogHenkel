<!doctype html>
<html lang="<?= get_bloginfo('language') ?>">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?= getComposedSiteTitle() ?></title>
    <?php wp_head() ?>
  </head>
  <body <?php body_class() ?>>
