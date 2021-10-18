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
<div class="qa-article-page">

<?php if ( have_posts() ) : ?>

<?php 
//会員レベルごとの部分保護設定
$block = get_field('block');

//対象会員以外の内容
$member = "
<div class='membership-info'>
<h2 class='membership-info-heading'>この記事を閲覧するには<br class='br-sp'>会員登録が必要です。</h2>

<!-- 
<h2 class='membership-info-heading'>保育イノベーション<br class='br-sp'>会員になると…</h2>
<ol class='membership-info-feature'>
<li>すべての<em>書式テンプレート</em>を<em>ダウンロードし放題！</em></li>
<li>すべての<em>解説動画</em>が<em>見放題！</em><small class='note'>＊1</small>
</li>
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


//コンテンツ
$text_content = get_the_content();

$content = "<div class='entry-detail'>
<div class='wysiwyg'>".$text_content."<!-- / .wysiwyg --></div>
<!-- / .entry-detail --></div>";
?>


<?php remove_filter('the_content', 'wpautop'); ?>

<article class="entry-article">
<?php while ( have_posts() ) : the_post(); ?>

<header class="entry-header">
<div class="entry-meta">
  <time class="entry-date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d');?></time>
  <p class="entry-cat">
  <?php
    $terms = get_the_terms($post->ID,'qa_cat');
    foreach( $terms as $term ) {
      echo '<a href="'.get_term_link($term->slug, 'qa_cat').'">'.$term->name.'</a>';
    } ?>
  </p>
  <p class="entry-tag">
    <?php
      $tags = get_the_terms($post->ID,'qa_tag');
      foreach( $tags as $tag ) {
    echo '<a href="'.get_term_link($tag->slug, 'qa_tag').'">'.'#'.$tag->name.'</a>';
    }?>
  </p>
</div>

<h1 class="entry-title"><?php the_title(); ?></h1>
<!-- / .entry-header --></header>

<?php
//全会員閲覧
if($block == "guest"){
  echo $content;
}elseif( $block == "free" ){
  echo do_shortcode('[swpm_protected custom_msg="'.$member.'"]' . $content . '[/swpm_protected]');
}elseif( $block == "light" ){
  //ライトプラン以上
  echo do_shortcode('[swpm_protected for = "2-3-4-6" custom_msg="'.$member.'"]' . $content . '[/swpm_protected]');
}elseif( $block == "standard" ){
  //スタンダードプラン以上
  echo do_shortcode('[swpm_protected for = "2-3-6" custom_msg="'.$member.'"]' . $content . '[/swpm_protected]');
}elseif( $block == "premium" ){
  //プレミアム
  echo do_shortcode('[swpm_protected for = "2-6" custom_msg="'.$member.'"]' . $content .  '[/swpm_protected]');
}
?>


<?php endwhile; ?>

<!-- / .entry-article --></article>
<?php endif; ?>


<p class="back-to-button"><a href="<?php echo esc_url( home_url( '/contents/qa/' ) ); ?>" class="btn btn-b">一覧へ戻る<svg viewBox="0 0 22.002 21.998" class="arrow-left"><use xlink:href="#ico-arrow-left"></use></svg></a></p>


<!-- / .qa-article-page --></div>
</main>
<!-- / .l-main --></div>
<!-- / [ MAIN ] -->


<!-- [ SUB ] -->
<?php get_sidebar(); ?>
<!-- / [ SUB ] -->


<!-- /.l-contents --></div>
<!-- / [[ CONTENT-AREA ]] -->



<?php get_footer(); ?>
