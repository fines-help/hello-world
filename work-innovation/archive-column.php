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
<div class="column-archive-page">


<ul class="entry-archive-a">

<?php if ( have_posts() ) : ?>
<?php while(have_posts()): the_post(); ?>

<li>
<a href="<?php the_permalink(); ?>">
<div class="entry-header">
<div class="entry-thumb">
  <?php the_post_thumbnail( 'thumbnailseminer' ); ?>
</div>
<div class="entry-meta">
  <p class="entry-cat">
    <?php
      $terms = get_the_terms($post->ID,'column_cat');
      foreach( $terms as $term ): ?>
    <span>
    <?php echo $term->name; ?>
    </span>
    <?php endforeach; ?>
  </p>
  <p class="entry-tag">
    <?php
      $tags = get_the_terms($post->ID,'column_tag');
      foreach( $tags as $tag ) {
    echo '<span>#'.$tag->name.'</span>';
  }?></p>
</div>
</div>
<div class="entry-body">
  <h2 class="entry-title"><?php the_title(); ?></h2>
  <p>
    <?php 
      $text = get_field( 'text_top' );
      mb_text_restriction( $text, 56);
     ?>
  </p>
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


<?php if(SwpmMemberUtils::is_member_logged_in()): ?>
<div class="membership-info">
<p class="lead">※オープン記念として2021年12月31日までは会員登録のみですべてのコンテンツが無料でご利用になれます。<br>(2022年1月1日からは有料会員の方でないとご利用いただけなくなります。)<br>有料会員についての詳細は料金プランをご参照ください。</p>

<div class="membership-info-button">
<a href="<?php echo esc_url( home_url( '/plan/' ) ); ?>" class="btn btn-c">料金プラン<svg viewBox="0 0 22.002 21.998" class="arrow-right"><use xlink:href="#ico-arrow-right"></use></svg></a>
</div>
<!-- /.membership-info --></div>
<?php endif; ?>


<!-- / .column-archive-page --></div>
</main>
<!-- / .l-main --></div>
<!-- / [ MAIN ] -->


<!-- [ SUB ] -->
<?php get_sidebar(); ?>
<!-- / [ SUB ] -->

<!-- /.l-contents --></div>
<!-- / [[ CONTENT-AREA ]] -->


<?php get_footer(); ?>
