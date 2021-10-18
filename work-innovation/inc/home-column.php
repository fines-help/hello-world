<?php
$args = array(
  'post_type' => 'column',
  'post_status' => 'publish',
  'posts_per_page' => 4
);
$the_query = new WP_Query( $args );
?>
<?php if ( $the_query->have_posts() ) : ?>
<ul class="column-archive">
<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
<li>
<a href="<?php the_permalink(); ?>">
<?php if( has_post_thumbnail() ): ?>
<div class="column-archive-image"><?php the_post_thumbnail( 'thumbnailsquare' ); ?></div>
<?php else : ?>
<div class="column-archive-image"><img src="<?php echo get_theme_file_uri( '/assets/img/common/ph_noimage_01.png' ); ?>" alt="" width="100" height="100"></div>
<?php endif; ?>
<div class="column-archive-body">
  <div class="column-archive-meta">
  <time class="column-date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
  <p class="column-cat"><span><?php
  $terms = get_the_terms( $post->ID, 'column_cat' );
  foreach( $terms as $term ) {
    echo $term->name;
  }
  ?></span></p>
  </div>
  <h3 class="column-title"><?php the_title(); ?></h3>
</div>
</a>
</li>
<?php endwhile;?>
<!-- / .column-archive --></ul>

<p class="home-seminar-more"><a href="<?php echo esc_url( home_url( '/contents/column/' ) ); ?>" class="btn btn-a">もっとみる<svg viewBox="0 0 22.002 21.998" class="arrow-right"><use xlink:href="#ico-arrow-right"></use></svg></a></p>

<?php wp_reset_postdata(); ?>
<?php else : ?>

<div class="entry-none">
<p>記事が見つかりませんでした。</p>
</div>

<?php endif; ?>