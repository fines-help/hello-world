<?php
// 最初の先頭固定表示の投稿を取得しますが、もしなければ最新の投稿を取得します
$sticky = get_option( 'sticky_posts' );
$args = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'posts_per_page' => 1,
  'post__in' => $sticky,
  'ignore_sticky_posts' => 1,
);
$the_query = new WP_Query( $args );
?>
<?php if ( $the_query->have_posts() ) : ?>
<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

<article class="recent-news">
<time class="news-date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
<h3 class="news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
</article>

<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
<?php else : ?>

<article class="recent-news">
<h3 class="home-news-title">最新のお知らせはありません</h3>
</article>

<?php endif; ?>

<p class="home-news-more"><a href="<?php echo esc_url( home_url( '/news/' ) ); ?>" class="btn btn-a">もっとみる<svg viewBox="0 0 22.002 21.998" class="arrow-right"><use xlink:href="#ico-arrow-right"></use></svg></a></p>