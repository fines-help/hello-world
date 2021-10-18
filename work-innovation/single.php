<?php //閲覧履歴に書込
db_history();?>

<?php get_header(); ?>

<!-- [[ PAGE-HEADING-AREA ]] -->
<?php get_template_part('inc/page','heading'); ?>
<!-- / [[ PAGE-HEADING-AREA ]] -->


<!-- [[ BREAD-CRUMBS-AREA ]] -->
<?php get_template_part('inc/bread','crumbs'); ?>
<!-- / [[ BREAD-CRUMBS-AREA ]] -->


<!-- [[ CONTENT-AREA ]] -->
<div class="l-contents">

<!-- [ MAIN ] -->
<div class="l-main">
<main>
<div class="qa-article-page">

<?php if ( have_posts() ) : ?>

<?php remove_filter('the_content', 'wpautop'); ?>

<article class="entry-article">
<?php while ( have_posts() ) : the_post(); ?>

<header class="entry-header">
<div class="entry-meta">
  <time class="entry-date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d');?></time>
  <p class="entry-cat">
  <?php
  $cats = get_the_category();
  foreach( $cats as $cat ) {
  echo '<a href="'.get_category_link( $cat->term_id ).'">'.$cat->cat_name.'</a>';
  }
  ?></p>
</div>

<h1 class="entry-title"><?php the_title(); ?></h1>
<!-- / .entry-header --></header>

<div class="entry-detail">
<div class="wysiwyg">

<?php the_content(); ?>

<!-- / .wysiwyg --></div>
<!-- / .entry-detail --></div>

<?php endwhile; ?>

<!-- / .entry-article --></article>
<?php endif; ?>


<p class="back-to-button"><a href="<?php echo esc_url( home_url( '/news/' ) ); ?>" class="btn btn-b">一覧へ戻る<svg viewBox="0 0 22.002 21.998" class="arrow-left"><use xlink:href="#ico-arrow-left"></use></svg></a></p>


<!-- / .qa-article-page --></div>
</main>
<!-- / .l-main --></div>
<!-- / [ MAIN ] -->


<!-- [ SUB ] -->
<?php get_sidebar(); ?>
<!-- / [ SUB ] -->


<!-- /.l-contents --></div>
<!-- / [[ CONTENT-AREA ]] -->



<?php get_footer(); ?>
