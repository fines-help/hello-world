<?php //投稿タイプ別
  $post_type = get_post_type();

  if( $post_type == 'doc' ){
    $cat = 'doc_cat';
    $tag = 'doc_tag';
    $tag_list = 1; 
  }

  if( $post_type == 'column' ){
    $cat = 'column_cat';
    $tag = 'column_tag';
    $tag_list = 1; 
  }

  if( $post_type == 'qa' ){
    $cat = 'qa_cat';
    $tag = 'qa_tag';
    $tag_list = 1; 
  }

  if( $post_type == 'video' ){
    $cat = 'video_cat';
    $tag = 'video_tag';
    $tag_list = 1; 
  }

  if( $post_type == 'seminar' ){
    $cat = 'seminar_cat';
    $tag = 'seminar_tag';
    $tag_list = 1; 
  }

  if( $post_type == 'post' ){
    $cat = 'category';
    $tag = 'tag';
    $tag_list = 0; 
  }

?>


<div class="l-sub">

<aside class="sub-section">
<h2 class="ttl-e">カテゴリ</h2>
<ul id="js-wp-toggle" class="list-categories">
<!--
!!! 開発者確認用コメント !!!
wp_list_categories での実装を想定
-->
<?php // タームの一覧を表示
  $catlist = wp_list_categories(array(
    'taxonomy' => $cat,
    'title_li' => '',
  ));
  echo $catlist; // タームの一覧を表示
?>
</ul>
<!-- / .sub-section --></aside>

<?php 
if( $tag_list ): ?>
<aside class="sub-section">
<h2 class="ttl-e">タグ</h2>
<ul class="list-tags">
<?php
$terms = get_terms( $tag ); // タクソノミーの指定
foreach ($terms as $term) {
    echo '<li><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>';
}
?>
</ul>
<!-- / .sub-section --></aside>
<?php endif; ?>

<!-- /.l-sub --></div>
