<?php 
if( is_tax( array('doc_cat','doc_tag' ) ) ){
  get_template_part('archive-doc');
}
elseif( is_tax( array('column_cat','column_tag' ) ) ){
  get_template_part('archive-column');
}
elseif( is_tax( 'seminar_cat' ) ){
  get_template_part('archive-seminar');
}
elseif( is_tax( array('video_cat','video_tag' ) ) ){
  get_template_part('archive-video');
}else{
//それ以外
?>

<?php get_header(); ?>

<!-- [[ PAGE-HEADING-AREA ]] -->
<?php get_template_part('inc/page','heading'); ?>
<!-- / [[ PAGE-HEADING-AREA ]] -->


<!-- [[ BREAD-CRUMBS-AREA ]] -->
<?php get_template_part('inc/bread','crumbs'); ?>
<!-- / [[ BREAD-CRUMBS-AREA ]] -->


<?php 
//会員相談ひろばの場合
$post_type = get_post_type();
if( $post_type == 'qa'):?>
<div class="l-container">
<section class="qa-collect">
<h2 class="qa-collect-heading">保育労務に関する質問を<br>募集しています。</h2>
<p class="qa-collect-lead">会員相談ひろばでは、会員の皆様から実際にいただいた疑問やご相談、お悩みをリアルタイムに回答しております。<br>
会員サイト内限定での回答となりますので、お気軽にお問い合わせください。</p>
<p class="qa-collect-button"><a href="<?php echo esc_url( home_url( '/mypage/qa-form/' ) ); ?>" class="btn btn-a">質問の投稿はこちらから<svg viewBox="0 0 22.002 21.998" class="arrow-right"><use xlink:href="#ico-arrow-right"></use></svg></a></p>
<!-- / .qa-collect --></section>
</div>
<?php endif; ?>

<!-- [[ CONTENT-AREA ]] -->
<div class="l-contents">

<!-- [ MAIN ] -->
<div class="l-main">
<main>
<div class="qa-archive-page">


<ul class="entry-archive-b">


<?php if ( have_posts() ) : ?>
<?php while(have_posts()): the_post(); ?>

<li>
<a href="<?php the_permalink(); ?>">
<div class="entry-header">
<div class="entry-meta">
  <time class="entry-date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
  <p class="entry-cat">
  <?php 
  if( $post_type == 'qa'){
      $terms = get_the_terms($post->ID,'qa_cat');
      foreach( $terms as $term ) {
        echo '<span>'.$term->name.'</span>';
      }
  }else{
    $cats = get_the_category();
    foreach( $cats as $cat ) {
    echo '<span>'.$cat->cat_name.'</span>';
    }
  }; ?>
  </p>

  <?php if( $post_type == 'qa'): ?>
  <p class="entry-tag">
    <?php
      $tags = get_the_terms($post->ID,'qa_tag');
      foreach( $tags as $tag ) {
    echo '<span>#'.$tag->name.'</span>';
  }?>
  </p>
  <?php endif; ?>

</div>
</div>
<h2 class="entry-title"><?php the_title(); ?></h2>
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


<?php 
//会員相談ひろばの場合
$post_type = get_post_type();
if( $post_type == 'qa'):?>

<?php if(SwpmMemberUtils::is_member_logged_in()): ?>
<div class="membership-info">
<p class="lead">※オープン記念として2021年12月31日までは会員登録のみですべてのコンテンツが無料でご利用になれます。<br>(2022年1月1日からは有料会員の方でないとご利用いただけなくなります。)<br>有料会員についての詳細は料金プランをご参照ください。</p>

<div class="membership-info-button">
<a href="<?php echo esc_url( home_url( '/plan/' ) ); ?>" class="btn btn-c">料金プラン<svg viewBox="0 0 22.002 21.998" class="arrow-right"><use xlink:href="#ico-arrow-right"></use></svg></a>
</div>
<!-- /.membership-info --></div>
<?php endif; ?>

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


<?php get_footer(); } ?>
