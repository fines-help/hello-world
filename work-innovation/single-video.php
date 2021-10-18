<?php //閲覧履歴に書込
db_history();?>

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
<div class="video-article-page">

<article class="entry-article">

<div class="entry-head-row">

<header class="entry-header">
<?php if( has_post_thumbnail() ): ?>
<div class="entry-thumb">
  <?php the_post_thumbnail( 'large' ); ?>
</div>
<?php else : ?>
<div class="entry-thumb">
  <img src="<?php echo get_theme_file_uri( '/assets/img/common/ph_noimage_03.png' ); ?>" alt="" width="400" height="225">
</div>
<?php endif; ?>

<div class="entry-meta">
  <time class="entry-date" datetime="<?php the_time('Y-m-d');?>"><?php the_time('Y.m.d');?></time>
  <p class="entry-cat">
    <?php
      $terms = get_the_terms($post->ID,'video_cat');
      foreach( $terms as $term ) {
    echo '<a href="'.get_term_link($term->slug, 'video_cat').'">'.$term->name.'</a>';
  }?></p>
  <p class="entry-tag">
    <?php
      $tags = get_the_terms($post->ID,'video_tag');
      foreach( $tags as $tag ) {
    echo '<a href="'.get_term_link($tag->slug, 'video_tag').'">'.'#'.$tag->name.'</a>';
  }?></p>

</div>
<!-- / .entry-header --></header>

<?php while ( have_posts() ) : the_post(); ?>

<?php remove_filter('the_content', 'wpautop'); ?>

<?php 
//会員レベルごとの部分保護設定
$block = get_field('block');

//video
$embed = wp_oembed_get( get_field('youtube_url') );
$loop = strstr($embed, '/embed/');
$loop = str_replace('/embed/','',$loop );
$loop = str_replace('?feature=oembed" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>','',$loop );
$loop = "loop=1&playlist=".$loop;
$embed = str_replace("feature=oembed",$loop,$embed);
$video = "<div class='video-player'>".$embed."<!-- / .video-player --></div>";


//見れない場合表示
$member = "
<!--
<div class='video-player is-disable'>
<p class='balloon'>この動画は無料会員登録で視聴いただけます。</p>
<p class='label'>
<span class='icon'><img src='".get_stylesheet_directory_uri()."/assets/img/video/ico_video_.svg' alt=' width='100' height='100'></span>
<i class='las la-lock'></i>会員限定
</p>
</div>
-->

<div class='membership-info'>

<h2 class='membership-info-heading'>この解説動画を閲覧するには<br class='br-sp'>会員登録が必要です。</h2>

<!--
<h2 class='membership-info-heading'>保育イノベーション<br class='br-sp'>会員になると…</h2>
<ol class='membership-info-feature'>
<li>すべての<em>書式テンプレート</em>を<em>ダウンロードし放題！</em></li>
<li>すべての<em>解説動画</em>が<em>見放題！</em><small class='note'>＊1</small></li>
<li>すべての<em>会員相談ひろば</em>が読み放題！</li>
<li><em>オンラインセミナー</em>を<em>無料</em>または<em>会員価格にて視聴可能！</em><small class='note'>＊2</small></li>
</ol>
<ol class='membership-info-note'>
<li>フリープランでも一部閲覧可能な動画がございます。</li>
<li>プランによって変動します。プレミアムプラン…無料、スタンダードプラン…会員価格、ライトプラン…一部のみ視聴可能、会員価格、フリープラン…一部のみ視聴可能、一般価格</li>
</ol>
-->

<div class='membership-info-button'>
<!-- <a href='/plan/' class='btn btn-c'>料金プラン<svg viewBox='0 0 22.002 21.998' class='arrow-right'><use xlink:href='#ico-arrow-right'></use></svg></a> -->
<!-- <a href='/maypage/rank/' class='btn btn-c'>有料プランご利用<svg viewBox='0 0 22.002 21.998' class='arrow-right'><use xlink:href='#ico-arrow-right'></use></svg></a> -->
<a href='/signup/' class='btn btn-c'>無料会員登録<svg viewBox='0 0 22.002 21.998' class='arrow-right'><use xlink:href='#ico-arrow-right'></use></svg></a>
<a href='/login/' class='btn btn-c'>ログイン<svg viewBox='0 0 22.002 21.998' class='arrow-right'><use xlink:href='#ico-arrow-right'></use></svg></a>
</div>
<!-- /.membership-info --></div>";
;
 ?>


<div class="entry-body">
<h1 class="entry-title"><?php the_title(); ?></h1>

<div class="entry-content">

<div class="wysiwyg">
<p><?php the_field('text_top');?></p>
<!-- / .wysiwyg --></div>

<dl class="dl-label">
  <dt>再生時間</dt>
  <dd><?php the_field('time'); ?></dd>
  <dt>対象者</dt>
  <dd><?php the_field('target'); ?></dd>
  <dt>運営形態</dt>
  <dd><?php the_field('form'); ?></dd>
  <dt>難易度</dt>
  <dd><?php the_field('difficulty'); ?></dd>
</dl>
<!-- / .entry-content --></div>

<!-- / .entry-body --></div>
<!-- / .entry-head-row --></div>


<?php

//全会員閲覧
if($block == "guest"){
  echo $video;
}elseif( $block == "free" ){
  echo do_shortcode('[swpm_protected custom_msg="'.$member.'"]' . $video . '[/swpm_protected]');
}elseif( $block == "light" ){
  //ライトプラン以上
  echo do_shortcode('[swpm_protected for="2-3-4-6" custom_msg="'.$member.'"]' . $video . '[/swpm_protected]');
}elseif( $block == "standard" ){
  //スタンダードプラン以上
  echo do_shortcode('[swpm_protected for="2-3-6" custom_msg="'.$member.'"]' . $video . '[/swpm_protected]');
}elseif( $block == "premium" ){
  //プレミアム
  echo do_shortcode('[swpm_protected for="2-6" custom_msg="'.$member.'"]' . $video .  '[/swpm_protected]');
}
?>

<?php if( get_field('text_detail') ): ?>
<div class="entry-detail">
<p class="ttl-e">詳細説明</p>
<div class="wysiwyg">
<?php the_field('text_detail'); ?>
<!-- / .wysiwyg --></div>
<!-- / .entry-detail --></div>
<?php endif; ?>

<div class="entry-detail">
<p class="ttl-e">解説動画について</p>
<p>通常3,980円（税込円4,378円）ライトプランから見られる動画を、HPリリース記念として、今だけ会員限定で全て無料配信しています。<br>
2021年12月31日までの期間限定サービスとなりますので、このチャンスにぜひ会員登録をお願いします。会員登録は<a href="<?php echo esc_url( home_url( '/signup/' ) ); ?>">こちら</a></p>
<!-- / .entry-detail --></div>


<?php endwhile; ?>

<!-- / .entry-article --></article>

<?php if(SwpmMemberUtils::is_member_logged_in()): ?>
<div class="membership-info">
<p class="lead">※オープン記念として2021年12月31日までは会員登録のみですべてのコンテンツが無料でご利用になれます。<br>(2022年1月1日からは有料会員の方でないとご利用いただけなくなります。)<br>有料会員についての詳細は料金プランをご参照ください。</p>

<div class="membership-info-button">
<a href="<?php echo esc_url( home_url( '/plan/' ) ); ?>" class="btn btn-c">料金プラン<svg viewBox="0 0 22.002 21.998" class="arrow-right"><use xlink:href="#ico-arrow-right"></use></svg></a>
</div>
<!-- /.membership-info --></div>
<?php endif; ?>


<p class="back-to-button"><a href="<?php echo esc_url( home_url( '/contents/video/' ) ); ?>" class="btn btn-b">一覧へ戻る<svg viewBox="0 0 22.002 21.998" class="arrow-left"><use xlink:href="#ico-arrow-left"></use></svg></a></p>


<!-- / .video-article-page --></div>
</main>
<!-- / .l-main --></div>
<!-- / [ MAIN ] -->


<!-- [ SUB ] -->
<?php get_sidebar(); ?>
<!-- / [ SUB ] -->


<!-- /.l-contents --></div>
<!-- / [[ CONTENT-AREA ]] -->



<?php get_footer(); ?>
