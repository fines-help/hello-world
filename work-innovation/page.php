<?php get_header(); ?>

<!-- [[ BREAD-CRUMBS-AREA ]] -->
<?php get_template_part('inc/bread','crumbs'); ?>
<!-- / [[ BREAD-CRUMBS-AREA ]] -->


<?php while ( have_posts() ) : the_post(); ?>

<?php remove_filter('the_content', 'wpautop'); ?>
<?php the_content(); ?>

<?php endwhile; ?>


<?php get_footer(); ?>
