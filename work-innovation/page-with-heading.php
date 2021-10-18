<?php
/*
Template Name: ページ見出し帯付き
*/
?>
<?php get_header(); ?>


<?php 
  global $wp_query;
  $post_obj = $wp_query->get_queried_object();
  $slug = $post_obj->post_name;
  $title_en = strtoupper( $slug );

  if( is_page( 'about' ) ) {
    $title_en = 'FEATURES';
  } elseif ( is_page( 'guide' ) ) {
    $title_en = 'HOW TO USE';
  } elseif ( is_page( 'check' ) ) {
    $title_en = 'SELF CHECK';
  } elseif ( is_page( 'terms' ) ) {
    $title_en = 'TERMS OF USE';
  } elseif ( is_page( 'privacy' ) ) {
    $title_en = 'PRIVACY POLICY';
  } elseif ( is_page( 'law' ) ) {
    $title_en = 'SPECIFIED COMMERCIAL TRANSACTION ACT';
  }
?>
<!-- [[ PAGE-HEADING-AREA ]] -->
<div class="page-heading">
<h1 class="page-heading-text">
<small class="font-en"><?php echo esc_html( $title_en ); ?></small>
<?php the_title(); ?>
</h1>
<!-- / .page-heading --></div>
<!-- / [[ PAGE-HEADING-AREA ]] -->


<!-- [[ BREAD-CRUMBS-AREA ]] -->
<?php get_template_part('inc/bread','crumbs'); ?>
<!-- / [[ BREAD-CRUMBS-AREA ]] -->


<?php while ( have_posts() ) : the_post(); ?>

<?php remove_filter('the_content', 'wpautop'); ?>
<?php the_content(); ?>

<?php endwhile; ?>


<?php get_footer(); ?>
