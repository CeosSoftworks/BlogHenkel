<!doctype html>
<html lang="<?= get_bloginfo('language') ?>">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?= getComposedSiteTitle() ?></title>
    <?php wp_head() ?>
    <script type="text/javascript">$ = jQuery</script>
  </head>
  <body <?php body_class() ?>>
    <div id="site-wrap" class="container-fluid">
      <div class="row">
        <?php get_sidebar() ?>
        <section id="site-body" class="col-md-10">