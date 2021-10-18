<?php
$args = array(
  'post_type' => 'seminar',
  'post_status' => 'publish',
  'posts_per_page' => 3
);
$the_query = new WP_Query( $args );
?>
<?php if ( $the_query->have_posts() ) : ?>
<ul class="seminar-archive">
<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
<li>
<a href="<?php the_permalink(); ?>">
<?php if( has_post_thumbnail() ): ?>
<div class="seminar-archive-image"><?php the_post_thumbnail( 'thumbnailseminer' ); ?></div>
<?php else : ?>
<div class="seminar-archive-image"><img src="<?php echo get_theme_file_uri( '/assets/img/common/ph_noimage_02.png' ); ?>" alt="" width="300" height="147"></div>
<?php endif; ?>
<div class="seminar-archive-body">
  <p class="seminar-date">開催 : <span class="date">
  <?php
  $date = get_field('date'); 
  dateonly( $date ) ;
  ?></span>
  <?php
  weekformat($date);
  ?></p>
  <p class="seminar-cat"><span><?php
  $terms = get_the_terms( $post->ID, 'seminar_cat' );
  foreach( $terms as $term ) {
    echo $term->name;
  }
  ?></span></p>
  <h3 class="seminar-title"><?php the_title(); ?></h3>
</div>
</a>
</li>
<?php endwhile;?>
<!-- / .seminar-archive --></ul>

<p class="home-seminar-more"><a href="<?php echo esc_url( home_url( '/contents/seminar/' ) ); ?>" class="btn btn-a">もっとみる<svg viewBox="0 0 22.002 21.998" class="arrow-right"><use xlink:href="#ico-arrow-right"></use></svg></a></p>

<?php wp_reset_postdata(); ?>
<?php else : ?>

<div class="entry-none">
<p>記事が見つかりませんでした。</p>
</div>

<?php endif; ?>