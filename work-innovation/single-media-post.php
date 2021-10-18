<?php get_header(); ?>


<!-- [ MAIN ] -->
<article>
<div class="main">
<?php while ( have_posts() ) : the_post(); ?>

<h1 class="ttlA"><?php the_title(); ?></h1>
<?php remove_filter('the_content', 'wpautop'); ?>

<?php 
//会員レベルごとの部分保護設定
$block = get_field('block');
//動画フィールド
$movie = get_field('movie');

//全会員閲覧
if( $block == "free" ){
  echo do_shortcode('[swpm_protected custom_msg="閲覧出来ません。会員レベルが足りないか会員登録をしてください。"]' . $movie . '[/swpm_protected]');
}elseif( $block == "light" ){
  //ライトプラン以上
  echo do_shortcode('[swpm_protected for = "2-3-4-6"　custom_msg="閲覧出来ません。会員レベルが足りないか会員登録をしてください。"]' . $movie . '[/swpm_protected]');
}elseif( $block == "standard" ){
  //スタンダードプラン以上
  echo do_shortcode('[swpm_protected for = "2-3-6"　custom_msg="閲覧出来ません。会員レベルが足りないか会員登録をしてください。"]' . $movie . '[/swpm_protected]');
}elseif( $block == "premium" ){
  //プレミアム
  echo do_shortcode('[swpm_protected for = "2-6"　custom_msg="閲覧出来ません。会員レベルが足りないか会員登録をしてください。"]' . $movie . '[/swpm_protected]');
}
?>

<?php endwhile; ?>
<!-- #main --></div>
</article>
<!-- / [ MAIN ] -->


<?php get_sidebar(); ?>


<?php get_footer(); ?>
