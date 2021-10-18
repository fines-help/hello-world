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
<div class="seminar-archive-page">


<ul class="seminar-archive">

<?php if ( have_posts() ) : ?>
<?php while(have_posts()): the_post(); ?>

<li>
<a href="<?php the_permalink(); ?>">
<?php
$block = get_field('block');
if( $block === 'free' ):
?>
<span></span>
<?php else: ?>
<span></span>
<?php endif; ?>
<div class="seminar-archive-image">
  <?php the_post_thumbnail( 'thumbnailseminer' ); ?>
</div>
<div class="seminar-archive-body">
  <p class="seminar-date">開催 : <?php
  $date = get_field('date');
  dateonly( $date ) ; ?></span>
  <?php
  weekformat($date); ?></p>
  <p class="seminar-cat"><span><?php
      $terms = get_the_terms($post->ID,'seminar_cat');
      foreach( $terms as $term ) {
    echo $term->name;
  }?></span></p>
  <h3 class="seminar-title"><?php the_title(); ?></h3>
</div>
</a>
</li>

<?php endwhile; ?>

<!-- / .seminar-archive --></ul>


<div class="archive-nav">
<!--
!!! 開発者確認用コメント !!!
the_posts_pagination での実装を想定
-->

<?php the_posts_pagination(
  array(
      'mid_size' => 1,
      'prev_text' => '次へ',
      'next_text' => '前へ',
      'screen_reader_text' => '投稿ナビゲーション',
  )
);?>

<!-- /.archive-nav --></div>

<?php endif; ?>

<!-- / .seminar-archive-page --></div>
</main>
<!-- / .l-main --></div>
<!-- / [ MAIN ] -->


<!-- [ SUB ] -->
<?php get_sidebar(); ?>
<!-- / [ SUB ] -->

<!-- /.l-contents --></div>
<!-- / [[ CONTENT-AREA ]] -->


<?php get_footer(); ?>
