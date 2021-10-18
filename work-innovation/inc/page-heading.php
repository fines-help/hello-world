<?php
  $post_type = get_post_type();

  if( $post_type === 'doc' ) {
    $title_en = 'TEMPLATES';
    $title_jp = '書式テンプレート';
  }

  if( $post_type === 'seminar' ) {
    $title_en = 'SEMINAR';
    $title_jp = 'オンラインセミナー/研修';
  }

  if( $post_type === 'column' ) {
    $title_en = 'COLUMNS';
    $title_jp = 'コラム';
  }

  if( $post_type === 'qa' ) {
    $title_en = 'Q&A';
    $title_jp = '会員相談ひろば';
  }

  if( $post_type === 'video' ) {
    $title_en = 'VIDEO';
    $title_jp = '解説動画';
  }

  if( $post_type === 'post' ) {
    $title_en = 'NEWS';
    $title_jp = 'お知らせ';
  }

?>
<!-- [[ PAGE-HEADING-AREA ]] -->
<div class="page-heading">
<p class="page-heading-text">
<small class="font-en"><?php echo $title_en; ?></small>
<?php echo $title_jp; ?>
</p>
<!-- / .page-heading --></div>
<!-- / [[ PAGE-HEADING-AREA ]] -->
