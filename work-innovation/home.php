<?php get_header(); ?>


<!-- [ MAIN ] -->
<main>
<div class="main">

<h1 class="ttlA">■導線確認用 home.php</h1>

<pre style="background: red;color:#fff;padding: 10px;font-size:2.0rem;margin: 0 0 20px;">
この home.php はあくまでも各ページの表示確認用であり、
原則、トップページ自体は固定ページのフロントページとして登録する事。
</pre>

<h2 class="ttlB">■記事一覧</h2>
<ul class="listLinkA">
<?php while ( have_posts() ) : the_post(); ?>
<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php endwhile; ?>
</ul>

<h2 class="ttlB">■カスタム投稿</h2>
<ul class="listLinkA">
  <?php
  $args = array(
  'post_type' => 'media-post',
  );
  $the_query = new WP_Query($args);
  if ( $the_query->have_posts()) :?>
    <?php while ( $the_query->have_posts()) : $the_query->the_post();?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
    <?php endwhile;?>
  <?php endif; wp_reset_postdata();?>
</ul>


<h2 class="ttlB">■月別アーカイブ</h2>
<ul class="listLinkA">
<?php wp_get_archives('type=monthly'); ?>
</ul>

<h2 class="ttlB">■カテゴリーアーカイブ</h2>
<ul class="listLinkA">
<?php wp_list_categories('title_li='); ?>
</ul>


<!-- #main --></div>
</main>
<!-- / [ MAIN ] -->


<?php get_sidebar(); ?>


<?php get_footer(); ?>
