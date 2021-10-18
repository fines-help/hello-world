<?php get_header(); ?>


<!-- [[ CONTENT-AREA ]] -->
<!-- [ MAIN ] -->
<div class="l-main">
<main>

<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>

<?php remove_filter('the_content', 'wpautop'); ?>
<?php the_content(); ?>

<?php endwhile;?>
<?php else : ?>

<!-- 記事がない場合はここに書いたものが表示される -->

<?php endif; ?>


</main>
<!-- / .l-main --></div>
<!-- / [ MAIN ] -->
<!-- / [[ CONTENT-AREA ]] -->


<?php get_footer(); ?>
