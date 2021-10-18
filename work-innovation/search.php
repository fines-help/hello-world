<?php
  // 絞り込みの値をGET
  $post_type = $_GET['post_type'];
  $s = $_GET['s'];
?>
<?php get_header(); ?>


<!-- [[ PAGE-HEADING-AREA ]] -->
<div class="page-heading">
<h1 class="page-heading-text">
<small class="font-en">SEARCH</small>
検索
</h1>
<!-- / .page-heading --></div>
<!-- / [[ PAGE-HEADING-AREA ]] -->


<!-- [[ BREAD-CRUMBS-AREA ]] -->
<?php get_template_part('inc/bread','crumbs'); ?>
<!-- / [[ BREAD-CRUMBS-AREA ]] -->


<!-- [[ CONTENT-AREA ]] -->
<div class="l-contents">

<!-- [ MAIN ] -->
<div class="l-main">
<main>
<div class="search-result-page">


<p class="search-result-lead">検索するカテゴリーとキーワードを入力し、検索ボタンをクリックしてください。</p>


<form method="get" id="refine-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
<div class="refine-search">
<div class="refine-search-select">
  <label for="refine-search-selector">カテゴリー</label>
  <select id="refine-search-selector" name="post_type" class="mod-select">
  <option value="">すべてのカテゴリー</option>
  <option value="column" <?php if( !empty( $post_type ) && $post_type === 'column' ){ echo 'selected'; } ?>>コラム</option>
  <option value="qa" <?php if( !empty( $post_type ) && $post_type === 'qa' ){ echo 'selected'; } ?>>会員相談ひろば</option>
  <option value="doc" <?php if( !empty( $post_type ) && $post_type === 'doc' ){ echo 'selected'; } ?>>書式テンプレート</option>
  <option value="video" <?php if( !empty( $post_type ) && $post_type === 'video' ){ echo 'selected'; } ?>>解説動画</option>
  <option value="seminar" <?php if( !empty( $post_type ) && $post_type === 'seminar' ){ echo 'selected'; } ?>>オンラインセミナー</option>
  </select>
</div>
<div class="refine-search-keyword">
  <label for="refine-search-form">キーワード</label>
  <input type="search" id="refine-search-form" class="mod-input-text" value="<?php echo get_search_query(); ?>" name="s">
</div>
<div class="refine-search-button">
  <button type="submit" class="btn btn-a">検索<i class="las la-search"></i></button>
</div>
<!-- / .refine-search --></div>
</form>

<?php
$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
if ( empty( $post_type ) ) {
  $args = array(
    'paged' => $paged,
    'post_type' => array( 'column', 'qa', 'doc', 'video', 'seminar' ),
    's' => $s,
    'post_status' => 'publish',
    //'posts_per_page' => 1
  );
} else {
  $args = array(
    'paged' => $paged,
    'post_type' => $post_type,
    's' => $s,
    'post_status' => 'publish',
    //'posts_per_page' => 1
  );
}
$the_query = new WP_Query( $args );
?>

<?php if ( $the_query->have_posts() ) : ?>
<ul class="search-result">
<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

<li>
<a href="<?php the_permalink(); ?>">
<p class="entry-post-type">
<span><?php
  $post_type = get_post_type( get_the_ID() );
  $post_type_obj = get_post_type_object( $post_type );
  echo $post_type_obj->labels->singular_name;
?></span>
</p>
<div class="entry-body">
<time class="entry-date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
<h2 class="entry-title"><?php the_title(); ?></h2>
</div>
</a>
</li>

<?php endwhile;?>
</ul>


<div class="archive-nav">
<?php
$GLOBALS['wp_query']->max_num_pages = $the_query->max_num_pages;
the_posts_pagination(
  array(
    'mid_size' => 1,
    'prev_text' => '前へ',
    'next_text' => '次へ'
  )
);
?>
<!-- /.archive-nav --></div>

<?php wp_reset_postdata(); ?>
<?php else : ?>

<div class="entry-none">
<p>検索条件と一致するコンテンツが見つかりませんでした。<br>条件を変更して再検索してください。</p>
<!-- / .entry-none --></div>

<?php endif; ?>


<!-- / .search-result-page --></div>
</main>
<!-- / .l-main --></div>
<!-- / [ MAIN ] -->

<!-- / .l-contents --></div>
<!-- / [[ CONTENT-AREA ]] -->


<?php get_footer(); ?>
