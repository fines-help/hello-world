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
<div class="seminar-article-page">

<article class="seminar-article">

<header class="seminar-header">
<div class="seminar-thumb">
  <?php the_post_thumbnail( 'thumbnailseminer' ); ?>
</div>


<div class="seminar-meta">
  <p class="seminar-date">開催 : <span class="date">
  <?php 
  $date = get_field('date'); 
  dateonly( $date ) ; ?></span>
  <?php 
  weekformat($date); ?></p>
  <p class="seminar-cat"><?php
      $terms = get_the_terms($post->ID,'seminar_cat');
      foreach( $terms as $term ) {
    echo '<a href="'.get_term_link($term->slug, 'seminar_cat').'">'.$term->name.'</a>';
  }?></p>
  <p class="seminar-tag">
    <?php
      $tags = get_the_terms($post->ID,'seminar_tag');
      foreach( $tags as $tag ) {
    echo '<a href="'.get_term_link($tag->slug, 'seminar_tag').'">'.'#'.$tag->name.'</a>';
    }?>
  </p>
</div>
<!-- / .seminar-header --></header>


<div class="seminar-body">
<h1 class="seminar-title"><?php the_title(); ?></h1>

<div class="seminar-content">

<div class="wysiwyg">
<p><?php the_field('text_top'); ?></p>
<!-- / .wysiwyg --></div>

<dl class="dl-label">
  <dt>詳細日時</dt>
  <dd><?php dateformat($date, 'jp'); ?>&nbsp;<?php the_field('detail_time'); ?></dd>
  <dt>会場</dt>
  <dd><?php the_field('place'); ?></dd>
  <dt>形式</dt>
  <dd><?php the_field('format'); ?></dd>
  <dt>講師</dt>
  <dd><?php the_field('teacher'); ?></dd>
</dl>

<div class="seminar-note">
<p><?php the_field('remarks'); ?></p>
</div>
<!-- / .seminar-content --></div>
<!-- / .seminar-body --></div>

<?php 
//会員レベルごとの部分保護設定
$block = get_field('block');
$url = get_field("url");

if( $url ){
//セミナーURLがある時
$seminar = "<div class='seminar-subscribe'>
<p class='seminar-subscribe-button'><a href='".$url."' class='btn btn-a' target='_blank' rel='noopener noreferrer'>セミナー申し込み<svg viewBox='0 0 22.002 21.998' class='arrow-right'><use xlink:href='#ico-arrow-right'></use></svg></a></p>
<!-- / .doc-subscribe --></div>";
}else{
//セミナーURLがない時
$seminar = "";
}

$member = "
<!--
<div class='seminar-subscribe is-disable'>
<p class='balloon'>このセミナーは無料会員登録で<br class='br-sp'>参加申し込みいただけます。</p>
<p class='seminar-subscribe-button'><a href='#' class='btn btn-a'>セミナー申し込み<svg viewBox='0 0 22.002 21.998' class='arrow-right'><use xlink:href='#ico-arrow-right'></use></svg></a></p>
</div>
-->


<div class='membership-info'>
<h2 class='membership-info-heading'>このセミナーへの申し込みには<br class='br-sp'>会員登録が必要です。</h2>

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
?>


<?php
//全会員閲覧
if($block == "guest"){
  echo $seminar;
}elseif( $block == "free" ){
  echo do_shortcode('[swpm_protected for="2-3-4-5-6" custom_msg="'.$member.'"]' . $seminar . '[/swpm_protected]');
}elseif( $block == "light" ){
  //ライトプラン以上
  echo do_shortcode('[swpm_protected for="2-3-4-6" custom_msg="'.$member.'"]' . $seminar . '[/swpm_protected]');
}elseif( $block == "standard" ){
  //スタンダードプラン以上
  echo do_shortcode('[swpm_protected for="2-3-6" custom_msg="'.$member.'"]' . $seminar . '[/swpm_protected]');
}elseif( $block == "premium" ){
  //プレミアム
  echo do_shortcode('[swpm_protected for="2-6" custom_msg="'.$member.'"]' . $seminar . '[/swpm_protected]');
}
?>



<?php if( get_field('text_detail') ): ?>
<div class="seminar-detail">
<p class="ttl-e">詳細説明</p>
<div class="wysiwyg">
<?php the_field('text_detail'); ?>
<!-- / .wysiwyg --></div>
<!-- / .seminar-detail --></div>
<?php endif; ?>

<!-- / .seminar-article --></article>

<?php if(SwpmMemberUtils::is_member_logged_in()): ?>
<div class="membership-info">
<p class="lead">※オープン記念として2021年12月31日までは会員登録のみですべてのコンテンツが無料でご利用になれます。<br>(2022年1月1日からは有料会員の方でないとご利用いただけなくなります。)<br>有料会員についての詳細は料金プランをご参照ください。</p>

<div class="membership-info-button">
<a href="<?php echo esc_url( home_url( '/plan/' ) ); ?>" class="btn btn-c">料金プラン<svg viewBox="0 0 22.002 21.998" class="arrow-right"><use xlink:href="#ico-arrow-right"></use></svg></a>
</div>
<!-- /.membership-info --></div>
<?php endif; ?>


<p class="back-to-button"><a href="<?php echo esc_url( home_url( '/contents/seminar/' ) ); ?>" class="btn btn-b">一覧へ戻る<svg viewBox="0 0 22.002 21.998" class="arrow-left"><use xlink:href="#ico-arrow-left"></use></svg></a></p>



<!-- / .seminar-article-page --></div>
</main>
<!-- / .l-main --></div>
<!-- / [ MAIN ] -->


<!-- [ SUB ] -->
<?php get_sidebar(); ?>
<!-- / [ SUB ] -->


<!-- /.l-contents --></div>
<!-- / [[ CONTENT-AREA ]] -->



<?php get_footer(); ?>
