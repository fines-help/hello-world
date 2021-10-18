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
<div class="format-archive-page">


<ul class="entry-archive-a">

<?php if ( have_posts() ) : ?>
<?php while(have_posts()): the_post(); ?>
<?php
    //ファイルフィールド
  $file = get_field('file');
  $size = $file["filesize"];
  $url = $file["url"];
?>

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
<div class="entry-thumb">
  <?php the_post_thumbnail('medium'); ?>
</div>
<div class="entry-meta">
  <p class="entry-cat">
    <?php
      $terms = get_the_terms($post->ID,'doc_cat');
      foreach( $terms as $term ): ?>
    <span>
    <?php echo $term->name; ?>
    </span>
    <?php endforeach; ?>
  </p>
  <p class="entry-tag">
    <span>
    <?php
      $tags = get_the_terms($post->ID,'doc_tag');
      foreach( $tags as $tag ) {
    echo '<span>#'.$tag->name.'</span>';
  }?></span></p>
</div>
</div>
<div class="entry-body">
  <h2 class="entry-title"><?php the_title(); ?></h2>
  <p>
    <?php
      $text = get_field( 'text-top' );
      mb_text_restriction( $text, 56);
     ?>
  </p>
  <dl class="dl-label">
  <dt>形式</dt>
  <dd><?php
  $type = wp_check_filetype( $url , null);
  echo $type["ext"];
  ?>
  </dd>
  <dt>サイズ</dt>
  <dd><?php echo size_format($size); ?></dd>
  <dt>更新</dt>
  <dd><?php the_modified_date('Y.m.d');?></dd>
  </dl>
</div>
</a>
</li>

<?php endwhile; ?>

<!-- / .entry-archive-a --></ul>


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

<!-- / .format-archive-page --></div>
</main>
<!-- / .l-main --></div>
<!-- / [ MAIN ] -->


<!-- [ SUB ] -->
<?php get_sidebar(); ?>
<!-- / [ SUB ] -->

<!-- /.l-contents --></div>
<!-- / [[ CONTENT-AREA ]] -->


<?php get_footer(); ?>
