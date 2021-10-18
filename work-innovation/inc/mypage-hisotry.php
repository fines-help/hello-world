<?php
global $history;
$history = null;
$arr_history = null;
$userID = get_current_user_id();
$history = get_the_author_meta('user_history', $userID);
$arr_history = explode(',', $history);
?>

<?php if (!empty($history)) : ?>
  <?php
  $args = array(
    'post_type' => array('doc', 'seminar', 'column', 'qa', 'video'),
    'posts_per_page' => -1,
    'post__in' => $arr_history,
    'orderby' => 'post__in',
  );
  $the_query = new WP_Query($args);
  $found_posts = $the_query->found_posts; //全件の数取得
  if ($the_query->have_posts()) : ?>
    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
      <li style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
    <?php endwhile; ?>
  <?php endif;
  wp_reset_postdata(); ?>

<?php endif; ?>