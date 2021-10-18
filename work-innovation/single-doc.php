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
<div class="format-article-page">

<article class="entry-article">

<div class="entry-head-row">

<header class="entry-header">
<div class="entry-thumb">
  <?php the_post_thumbnail('medium'); ?>
</div>

<div class="entry-meta">
  <time class="entry-date" datetime="2020-10-13"><?php the_time('Y.m.d');?></time>
  <p class="entry-cat">
    <?php
      $terms = get_the_terms($post->ID,'doc_cat');
      foreach( $terms as $term ) {
    echo '<a href="'.get_term_link($term->slug, 'doc_cat').'">'.$term->name.'</a>';
  }?></p>
  <p class="entry-tag">
    <?php
      $tags = get_the_terms($post->ID,'doc_tag');
      foreach( $tags as $tag ) {
    echo '<a href="'.get_term_link($tag->slug, 'doc_tag').'">'.'#'.$tag->name.'</a>';
  }?></p>

</div>
<!-- / .entry-header --></header>

<?php 
//閲覧履歴に書込
db_history();

while ( have_posts() ) : the_post(); ?>

<?php remove_filter('the_content', 'wpautop'); ?>

<?php 
//会員レベルごとの部分保護設定
$block = get_field('block');
//ファイルフィールド
$file = get_field('file');

$size = $file["filesize"];
$url = $file["url"];
$download = "<div class='doc-download'>
<p class='doc-download-button'><a href='".$url."' class='btn btn-a'>ダウンロード<svg viewBox='0 0 22.002 21.998' class='arrow-right'><use xlink:href='#ico-arrow-right'></use></svg></a></p>
<!-- / .doc-download --></div>";

$member = "
<!-- <div class='doc-download is-disable'>
<p class='balloon'>このファイルは無料会員登録で<br class='br-sp'>ダウンロードいただけます。</p>
<p class='doc-download-button'><a href='#' class='btn btn-a'>ダウンロード<svg viewBox='0 0 22.002 21.998' class='arrow-right'><use xlink:href='#ico-arrow-right'></use></svg></a></p>
</div> -->


<div class='membership-info'>
<h2 class='membership-info-heading'>この書式ダウンロードには<br class='br-sp'>会員が必要です。</h2>

<!-- <h2 class='membership-info-heading'>保育イノベーション<br class='br-sp'>会員になると…</h2> 

<ol class='membership-info-feature'>
<li>すべての<em>書式テンプレート</em>を<em>ダウンロードし放題！</em></li>
<li>すべての<em>解説動画</em>が<em>見放題！</em><small class='note'>＊1</small></li>
<li>すべての<em>会員相談ひろば</em>が読み放題！</li>
<li><em>オンラインセミナー</em>を<em>無料</em>または<em>会員価格にて視聴可能！</em><small class='note'>＊2</small>
</li>
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


<div class="entry-body">
<h1 class="entry-title"><?php the_title(); ?></h1>

<div class="entry-content">

<div class="wysiwyg">
<p><?php the_field('text-top');?></p>
<!-- / .wysiwyg --></div>

<dl class="dl-label">
  <dt>形式</dt>
  <dd>
  <?php 
  $type = wp_check_filetype( $url , null);
  echo $type["ext"]; ?></dd>
  <dt>サイズ</dt>
  <dd><?php echo size_format($size); ?></dd>
  <dt>更新</dt>
  <dd><?php the_modified_date('Y.m.d');?></dd>
</dl>
<!-- / .entry-content --></div>

<!-- / .entry-body --></div>
<!-- / .entry-head-row --></div>


<?php
//全会員閲覧
if( $block == "guest" ){
  echo $download;
}elseif( $block == "free" ){
  echo do_shortcode('[swpm_protected custom_msg="'.$member.'"]' . $download . '[/swpm_protected]');
}elseif( $block == "light" ){
  //ライトプラン以上
  echo do_shortcode('[swpm_protected for = "2-3-4-6" custom_msg="'.$member.'"]' . $download . '[/swpm_protected]');
}elseif( $block == "standard" ){
  //スタンダードプラン以上
  echo do_shortcode('[swpm_protected for = "2-3-6" custom_msg="'.$member.'"]' . $download . '[/swpm_protected]');
}elseif( $block == "premium" ){
  //プレミアム
  echo do_shortcode('[swpm_protected for = "2-6" custom_msg="'.$member.'"]' . $download .  '[/swpm_protected]');
}
?>


<?php if( get_field('text-detail') ): ?>
<div class="entry-detail">
<p class="ttl-e">詳細説明</p>
<div class="wysiwyg">
<?php the_field('text-detail'); ?>

<!-- / .wysiwyg --></div>
<!-- / .entry-detail --></div>
<?php endif; ?>

<div class="entry-detail">
<p class="ttl-e">書式テンプレートについて</p>
<p>様々な場面で使用できる書式を取りそろえてます。<br>
監査に対応した書式では、虐待防止対応マニュアルをはじめ、プール・水遊びマニュアル、衛生管理マニュアル、備蓄品リスト等、監査に必要な25種類のマニュアルを無料でWord,Excel,PDF等の形式でダウンロードできます。是非ご活用ください。</p>
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


<p class="back-to-button"><a href="<?php echo esc_url( home_url( '/contents/doc/' ) ); ?>" class="btn btn-b">一覧へ戻る<svg viewBox="0 0 22.002 21.998" class="arrow-left"><use xlink:href="#ico-arrow-left"></use></svg></a></p>



<!-- / .format-article-page --></div>
</main>
<!-- / .l-main --></div>
<!-- / [ MAIN ] -->


<!-- [ SUB ] -->
<?php get_sidebar(); ?>
<!-- / [ SUB ] -->


<!-- /.l-contents --></div>
<!-- / [[ CONTENT-AREA ]] -->



<?php get_footer(); ?>
