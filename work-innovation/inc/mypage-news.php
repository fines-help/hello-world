<?php
// 最初の先頭固定表示の投稿を取得しますが、もしなければ最新の投稿を取得します
$sticky = get_option('sticky_posts');
$args = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'category_name' => 'news',
);
$the_query = new WP_Query($args);
?>
<?php if ($the_query->have_posts()) : ?>
  <dl style="background-color: #FFF; overflow:scroll; height: 220px; overflow-x: hidden; overflow: hidden visible;" class="p-2.5 grid gap-4 grid-cols-5 w-full">
    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
      <dt class=" col-span-1">
        <div class="hidden
        sm:hidden
        md:block
        lg:block
        xl:block">
          <ul class="list-tags">
            <li style="margin-left: auto; margin-right: auto;"><?php the_tags('<p style="font-size: smaller;">','</p><p style="font-size: smaller;">', '</p>'); ?></li>
          </ul>
        </div>
        <div
        class="
          block
          sm:block
          md:hidden
          lg:hidden
          xl:hidden
        "
        >
        <?php the_tags('<p>', '</p>'); ?>
        </div>
      </dt>
      <dd class="col-span-4">
        <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
      </dd>
    <?php endwhile; ?>
  </dl>
  <?php wp_reset_postdata(); ?>
<?php else : ?>

  <article class="recent-news">
    <h3 class="home-news-title">最新のお知らせはありません</h3>
  </article>

<?php endif; ?>

<style>
  .news .ttl-a {
    background-color: #FFF;
  }
</style>