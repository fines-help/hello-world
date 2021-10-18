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
<div class="video-archive-page">


<ul class="video-archive">

<?php if ( have_posts() ) : ?>
<?php while(have_posts()): the_post(); ?>


<li>
<a href="<?php the_permalink(); ?>">
<?php
$block = get_field('block');
if( $block === 'free' ):
?>
<span class="entry-type free">フリー会員以上</span>
<?php else: ?>
<span class="entry-type paid">有料会員限定</span>
<?php endif; ?>
<div class="entry-header">
<?php if( has_post_thumbnail() ): ?>
<div class="entry-thumb">
  <?php the_post_thumbnail( 'large' ); ?>
</div>
<?php else : ?>
<div class="entry-thumb">
  <img src="<?php echo get_theme_file_uri( '/assets/img/common/ph_noimage_03.png' ); ?>" alt="" width="500" height="281">
</div>
<?php endif; ?>
<div class="entry-meta">
  <p class="entry-cat">
    <?php
      $terms = get_the_terms($post->ID,'video_cat');
      foreach( $terms as $term ): ?>
    <span>
    <?php echo $term->name; ?>
    </span>
    <?php endforeach; ?>
  </p>
  <p class="entry-tag">
    <span>
    <?php
      $tags = get_the_terms($post->ID,'video_tag');
      foreach( $tags as $tag ) {
    echo '#'.$tag->name;
  }?></span></p>
</div>
</div>
<div class="entry-body">
  <h2 class="entry-title"><?php the_title(); ?></h2>
  <p class="entry-summary"><?php
  $text = get_field( 'text_top' );
  mb_text_restriction( $text, 56);
   ?></p>
  <dl class="dl-label pc-mode-horizontal">
  <dt>再生時間</dt>
  <dd><?php the_field('time'); ?></dd>
  <dt>対象者</dt>
  <dd><?php the_field('target'); ?></dd>
  <dt>運営形態</dt>
  <dd><?php the_field('form'); ?></dd>
  <dt>難易度</dt>
  <dd><?php the_field('difficulty'); ?></dd>
  </dl>
</div>
</a>
</li>

<?php endwhile; ?>

<!-- / .video-archive --></ul>


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

<!-- / .video-archive-page --></div>
</main>
<!-- / .l-main --></div>
<!-- / [ MAIN ] -->


<!-- [ SUB ] -->
<?php get_sidebar(); ?>
<!-- / [ SUB ] -->

<!-- /.l-contents --></div>
<!-- / [[ CONTENT-AREA ]] -->


<?php get_footer(); ?>
